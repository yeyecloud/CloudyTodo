<?php
/**
 * DropDownField
 * 
 * A field that presents a list of options as a drop-down.
 * @author Jeff Ober
 * @package Fields
 **/
class Phorm_Field_Dropdown extends Phorm_Field
{
    /**
     * An array storing the drop-down's choices.
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
     * Returns a new Phorm_Widget_Select.
     * @author Jeff Ober
     * @return Phorm_Widget_Select
     **/
    public function get_widget()
    {
        return new Phorm_Widget_Select($this->choices);
    }
    
    /**
     * Validates that $value is present in $this->choices.
     * @author Jeff Ober
     * @param string $value
     * @return null
     * @throws Phorm_Validation_Error
     * @see DropDownField::$choices
     **/
    public function validate($value)
    {
        if (!in_array($value, array_keys($this->choices)))
            throw new Phorm_Validation_Error($GLOBALS['phorms_tr']['dropdownfield_invalid']);
    }
    
    /**
     * Imports the value by decoding any HTML entities. Returns the "actual"
     * value of the option selected.
     * @author Jeff Ober
     * @param string $value
     * @return string the decoded string
     **/
    public function import_value($value)
    {
        return html_entity_decode((string)$value);
    }
}
