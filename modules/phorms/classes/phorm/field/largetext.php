<?php
/**
 * LargeTextField
 * 
 * A large text field using a textarea tag.
 * @author Jeff Ober
 * @package Fields
 **/
class Phorm_Field_Largetext extends Phorm_Field
{
    /**
     * @author Jeff Ober
     * @param string $label the field's text label
     * @param int $rows the number of rows
     * @param int $cols the number of columns
     * @param array $validators a list of callbacks to validate the field data
     * @param array $attributes a list of key/value pairs representing HTML attributes
     **/
    public function __construct($label, $rows, $cols, array $validators=array(), array $attributes=array())
    {
        $attributes['cols'] = $cols;
        $attributes['rows'] = $rows;
        parent::__construct($label, $validators, $attributes);
    }
    
    /**
     * Returns a new Phorm_Widget_Text.
     * @author Jeff Ober
     * @return Phorm_Widget_Text
     **/
    protected function get_widget()
    {
        return new Phorm_Widget_Text();
    }
    
    /**
     * Returns null.
     * @author Jeff Ober
     * @return null
     **/
    protected function validate($value)
    {
        return true;
    }
    
    /**
     * Imports the value by decoding HTML entities.
     * @author Jeff Ober
     * @param string $value
     * @return string the decoded value
     **/
    public function import_value($value)
    {
        return html_entity_decode((string)$value);
    }
}
