<?php
/**
 * PasswordField
 * 
 * A password field that uses a user-specified hash function to import values.
 * @author Jeff Ober
 * @package Fields
 **/
class Phorm_Field_Password extends Phorm_Field_Text
{
    /**
     * @author Jeff Ober
     * @param string $label the field's text label
     * @param int $size the field's size attribute
     * @param int $max_length the maximum size in characters
     * @param array $validators a list of callbacks to validate the field data
     * @param array $attributes a list of key/value pairs representing HTML attributes
     **/
    public function __construct($label, $size, $max_length, array $validators=array(), array $attributes=array())
    {
        parent::__construct($label,  $size, $max_length, $validators, $attributes);
    }
    
    /**
     * Returns a Phorm_Widget_Password.
     * @author Jeff Ober
     * @return Phorm_Widget_Password
     **/
    public function get_widget()
    {
        return new Phorm_Widget_Password();
    }
}
