<?php
abstract class Phorm_Field
{
    /**
     * The field's text label.
     **/
    private $label;
    /**
     * Store's the field's value. Set during validation.
     **/
    private $value;
    /**
     * Array of callbacks used to validate field data. May be either a string
     * denoting a function or an array of array(instance, string method) to use
     * a class instance method.
     **/
    private $validators;
    /**
     * Associative array of key/value pairs representing HTML attributes of the field.
     **/
    private $attributes;
    /**
     * Array storing errors generated during field validation.
     **/
    private $errors;
    /**
     * Storage of the "cleaned" field value.
     **/
    private $imported;
    /**
     * Help text for the field. This is printed out with the field HTML.
     **/
    private $help_text = '';
    /**
     * If true, this field uses multiple field widgets.
     * @see widgets.php
     **/
    public $multi_field = false;
    /**
     * Stores the result of field validation to prevents double-validation.
     **/
    private $valid;
    
    /**
     * @author Jeff Ober
     * @param string $label the field's label
     * @param array $validators callbacks used to validate field data
     * @param array $attributes an assoc of key/value pairs representing HTML attributes
     * @return null
     **/
    public function __construct($label, array $validators=array(), array $attributes=array())
    {
		/*if(in_array(Phorm_Validation::Required(), $validators))
		{
		    if(!isset($attributes['class']))
		    {
		        $attributes['class'] = strtolower(substr(Phorm_Validation::Required(), 18));
		    }
		    else
		    {
		        $attributes['class'] .= ' ' . strtolower(substr(Phorm_Validation::Required(), 18));
		    }
		}*/
		foreach($validators as $v)
		{
			if(Phorm_Validation::is_builtin($v))
			{
				$name = call_user_func($v, true);
				if($name != '')
				{
					if(!isset($attributes['class']))
					{
						$attributes['class'] = $name;
					}
					else
					{
						$attributes['class'] .= ' ' . $name;
					}
				}
		    }
		}
        
        $this->label = (string)$label;
        $this->attributes = $attributes;
        $this->validators = $validators;
    }
    
    /**
     * Assigns help text to the field.
     * @author Jeff Ober
     * @param string $text the help text
     * @return null
     **/
    public function set_help_text($text)
    {
        $this->help_text = $text;
    }
    
    /**
     * Sets the value of the field.
     * @author Jeff Ober
     * @param mixed $value the field's value
     * @return null
     **/
    public function set_value($value)
    {
        $this->value = $value;
    }
    
    /**
     * Returns the "cleaned" value of the field.
     * @author Jeff Ober
     * @return mixed the field's "cleaned" value
     **/
    public function get_value()
    {
        return $this->imported;
    }
    
    /**
     * Sets an HTML attribute of the field.
     * @author Jeff Ober
     * @param string $key the attribute name
     * @param string $value the attribute's value
     * @return null
     **/
    public function set_attribute($key, $value)
    {
        $this->attributes[$key] = $value;
    }
    
    /**
     * Returns the value of an HTML attribute or null if not set.
     * @author Jeff Ober
     * @param string $key the attribute name to look up
     * @return string|null the attribute's value or null if not set
     **/
    public function get_attribute($key)
    {
        if (array_key_exists($key, $this->attributes))
            return $this->attributes[$key];
        return null;
    }
    
    /**
     * Returns a list of errors generated during validation. If the field is not
     * yet validated, returns null.
     * @author Jeff Ober
     * @return array|null
     **/
    public function get_errors()
    {
        return $this->errors;
    }
    
    /**
     * Adds a validator if not already there.
     * @author Thomas Lété
     * @return null
     **/
    public function add_validator($validators, $validator)
    {
        if(!in_array($validator, $validators))
        {
        	$validators[] = $validator;
        }
        return $validators;
    }
    
    /**
     * Returns an HTML string containing the field's help text.
     * @author Jeff Ober
     * @return string the HTML help text paragraph
     **/
    public function help_text()
    {
		if(!empty($this->help_text))
		{
			return sprintf(PHP_EOL . "\t" . '<span class="phorm_help">%s</span>', htmlentities($this->help_text));
		}
        else
        {
        	return '';
        }
    }
    
    /**
     * Returns the HTML field label.
     * @author Jeff Ober
     * @return string the HTML label tag
     **/
    public function label()
    {
        return sprintf('<label for="%s">%s</label>', (string)$this->get_attribute('id'), $this->label);
    }
    
    /**
     * Returns the field's tag as HTML.
     * @author Jeff Ober
     * @return string the field as HTML
     **/
    public function html()
    {
        $widget = $this->get_widget();
        $attr = $this->attributes;
        return $widget->html($this->value, $this->attributes);
    }
    
    /**
     * Returns the field's errors as an unordered list with the class "phorm_error".
     * @author Jeff Ober
     * @return string the field errors as an unordered list
     **/
    public function errors()
    {
        $elts = array();
        if (is_array($this->errors) && !empty($this->errors))
        {
            foreach ($this->errors as $valid => $error)
            	$elts[] = sprintf(PHP_EOL . "\t" . '<div class="validation-advice" htmlfor="%s" generated="true">%s</div>', (string)$this->get_attribute('id'), $error);
        }
        return implode(PHP_EOL, $elts);
    }
    
    /**
     * Serializes the field to HTML.
     * @author Jeff Ober
     * @return string the field's complete HTMl representation.
     **/
    public function __toString()
    {
        return $this->html() . $this->help_text() . $this->errors();
    }
    
    /**
     * On the first call, calls each validator on the field value, and returns
     * true if each returned successfully, false if any raised a
     * Phorm_Validation_Error. On subsequent calls, returns the same value as the
     * initial call. If $reprocess is set to true (default: false), will
     * call each of the validators again. Stores the "cleaned" value of the
     * field on success.
     * @author Jeff Ober
     * @param boolean $reprocess if true, ignores memoized result of initial call
     * @return boolean true if the field's value is valid
     * @see Phorm_Field::$valid,Phorm_Field::$imported,Phorm_Field::$validators,Phorm_Field::$errors
     **/
    public function is_valid($reprocess=false)
    {
        if ( $reprocess || is_null($this->valid) )
        {
            // Pre-process value
            $value = $this->prepare_value($this->value);

            $this->errors = array();
            $v = $this->validators;

            foreach($v as $f)
            {
                try { call_user_func($f, $value); }
                catch (Phorm_Validation_Error $e) { $this->errors[] = $e->getMessage(); }
            }
            
            if ( $value !== '' )
            {
                try { $this->validate($value); }
                catch (Phorm_Validation_Error $e) { $this->errors[] = $e->getMessage(); }
            }

            if ( $this->valid = empty($this->errors) )
                $this->imported = $this->import_value($value);
        }
        return $this->valid;
    }
    
    /**
     * Pre-processes a value for validation, handling magic quotes if used.
     * @author Jeff Ober
     * @param string $value the value from the form array
     * @return string the pre-processed value
     **/
    protected function prepare_value($value)
    {
        return ( get_magic_quotes_gpc() ) ? stripslashes($value) : $value;
    }
    
    /**
     * Defined in derived classes; must return an instance of PhormWidget.
     * @return PhormWidget the field's widget
     * @see PhormWidget
     **/
    abstract protected function get_widget();
    
    /**
     * Raises a Phorm_Validation_Error if $value is invalid.
     * @param string|mixed $value (may be mixed if prepare_value returns a non-string)
     * @throws Phorm_Validation_Error
     * @return null
     * @see Phorm_Validation_Error
     **/
    abstract protected function validate($value);
    
    /**
     * Returns the field's "imported" value, if any processing is required. For
     * example, this function may be used to convert a date/time field's string
     * into a unix timestamp or a numeric string into an integer or float.
     * @param string|mixed $value the pre-processed string value (or mixed if prepare_value returns a non-string)
     * @return mixed
     **/
    abstract public function import_value($value);
}
