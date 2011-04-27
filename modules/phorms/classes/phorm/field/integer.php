<?php
/**
 * IntegerField
 * 
 * A field that accepts only integers.
 * @author Jeff Ober
 * @package Fields
 **/
class Phorm_Field_Integer extends Phorm_Field
{
    /**
     * Stores the max number of digits permitted.
     **/
    private $max_digits;
    
    /**
     * @author Jeff Ober
     * @param string $label the field's text label
     * @param int $max_digits the maximum number of digits permitted
     * @param array $validators a list of callbacks to validate the field data
     * @param array $attributes a list of key/value pairs representing HTML attributes
     **/
    public function __construct($label, $max_digits, array $validators=array(), array $attributes=array())
    {
		$validators = $this->add_validator($validators, Phorm_Validation::Number());
		$attributes['size'] = 20;
        parent::__construct($label, $validators, $attributes);
        $this->max_digits = $max_digits;
    }
    
    /**
     * Returns a new Phorm_Widget_Char.
     * @author Jeff Ober
     * @return Phorm_Widget_Char
     **/
    public function get_widget()
    {
        return new Phorm_Widget_Char();
    }
    
    /**
     * Validates that the value is parsable as an integer and that it is fewer
     * than $this->max_digits digits.
     * @author Jeff Ober
     * @param string $value
     * @return null
     * @throws Phorm_Validation_Error
     **/
    public function validate($value)
    {
        //if (preg_match('/\D/', $value))
        //    throw new Phorm_Validation_Error(sprintf($GLOBALS['phorms_tr']['integerfield_notint'], $this->max_digits));
        if (strlen((string)$value) > $this->max_digits)
            throw new Phorm_Validation_Error(sprintf($GLOBALS['phorms_tr']['integerfield_sizelimit'], $this->max_digits));
    }
    
    /**
     * Parses the value as an integer.
     * @author Jeff Ober
     * @param string $value
     * @return int
     **/
    public function import_value($value)
    {
        return (int)(html_entity_decode((string)$value));
    }
}
