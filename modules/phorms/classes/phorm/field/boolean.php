<?php
/**
 * BooleanField
 * 
 * A field representing a boolean choice using a checkbox field.
 * @author Jeff Ober
 * @package Fields
 **/
class Phorm_Field_Boolean extends Phorm_Field
{
    /**
     * True when the field is checked (true).
     **/
    private $checked;
    
    /**
     * @author Jeff Ober
     * @param string $label the field's text label
     * @param array $validators a list of callbacks to validate the field data
     * @param array $attributes a list of key/value pairs representing HTML attributes
     **/
    public function __construct($label, array $validators=array(), array $attributes=array())
    {
        parent::__construct($label, $validators, $attributes);
        parent::set_value('on');
        $this->checked = false;
    }
    
    /**
     * Sets the value of the field.
     * @author Jeff Ober
     * @param boolean $value
     * @return null
     **/
    public function set_value($value)
    {
        $this->checked = (boolean)$value;
    }
    
    /**
     * Returns true if the field is checked.
     * @author Jeff Ober
     * @return boolean
     **/
    public function get_value()
    {
        return $this->checked;
    }
    
    /**
     * Returns a new Phorm_Widget_Checkbox.
     * @author Jeff Ober
     * @return Phorm_Widget_Checkbox
     **/
    public function get_widget()
    {
        return new Phorm_Widget_Checkbox($this->checked);
    }
    
    /**
     * Returns null.
     * @author Jeff Ober
     * @return null
     **/
    public function validate($value)
    {
        return null;
    }
    
    /**
     * Returns true if the field was checked in the user-submitted data, false
     * otherwise.
     * @author Jeff Ober
     * @return boolean
     **/
    public function import_value($value)
    {
        return $this->checked;
    }
    
    /**
     * Returns the value.
     * @author Jeff Ober
     * @param string $value
     * @param string
     **/
    public function prepare_value($value)
    {
        return $value;
    }
}
