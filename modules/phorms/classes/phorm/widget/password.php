<?php
/**
 * PasswordWidget
 * 
 * A password field.
 * @author Jeff Ober
 * @package Widgets
 **/
//class PasswordWidget extends PhormWidget
class Phorm_Widget_Password extends Phorm_Widget
{
    /**
     * Returns the field as serialized HTML.
     * @author Jeff Ober
     * @param mixed $value the form widget's value attribute
     * @param array $attributes key=>value pairs corresponding to HTML attributes' name=>value
     * @return string the serialized HTML
     **/
    protected function serialize($value, array $attributes=array())
    {
        $attributes['type'] = 'password';
        return parent::serialize($value, $attributes);
    }
}
