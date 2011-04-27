<?php
/**
 * MultipleChoiceField
 * 
 * A compound field offering multiple choices as a select multiple tag.
 * @author Jeff Ober
 * @package Fields
 **/
class Phorm_Field_Multiplechoice extends Phorm_Field
{
    /**
     * Specifies that this field's name attribute must be post-fixed by [].
     **/
    public $multi_field = true;
    /**
     * Stores the field options as actual_value=>display_value.
     **/
    private $choices;
    
    /**
     * @author Jeff Ober
     * @param string $label the field's text label
     * @param array $choices a list of choices as actual_value=>display_value
     * @param array $validators a list of callbacks to validate the field data
     * @param array $attributes a list of key/value pairs representing HTML attributes
     **/
    public function __construct($label, array $choices, array $validators=array(), array $attributes=array())
    {
        parent::__construct($label, $validators, $attributes);
        $this->choices = $choices;
    }
    
    /**
     * Returns a new Phorm_Widget_Multiselect.
     * @author Jeff Ober
     * @return Phorm_Widget_Multiselect
     **/
    public function get_widget()
    {
        return new Phorm_Widget_Multiselect($this->choices);
    }
    
    /**
     * Validates that each of the selected choice exists in $this->choices.
     * @author Jeff Ober
     * @param array $value
     * @return null
     * @throws Phorm_Validation_Error
     * @see MultipleChoiceField::$choices
     **/
    public function validate($value)
    {
        if (!is_array($value))
            throw new Phorm_Validation_Error($GLOBALS['phorms_tr']['multiplechoicefield_badformat']);
        
        foreach ($value as $v)
            if (!in_array($v, array_keys($this->choices)))
                throw new Phorm_Validation_Error($GLOBALS['phorms_tr']['multiplechoicefield_badformat']);
    }
    
    /**
     * Imports the value as an array of the actual values (from $this->choices.)
     * @author Jeff Ober
     * @param array $value
     * @return array
     **/
    public function import_value($value)
    {
        if (is_array($value))
            foreach ($value as $key => &$val)
                $val = html_entity_decode($val);
        return $value;
    }
}
