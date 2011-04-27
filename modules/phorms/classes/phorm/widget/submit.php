<?php
/**
 * SubmitWidget
 * 
 * A submit button field.
 * @author Thomas Lété
 * @package Widgets
 **/
//class SubmitWidget extends PhormWidget
class Phorm_Widget_Submit extends Phorm_Widget
{
    /**
     * Returns the button as serialized HTML.
     * @author Thomas Lété
     * @param mixed $value the form widget's value attribute
     * @param array $attributes key=>value pairs corresponding to HTML attributes' name=>value
     * @return string the serialized HTML
     **/
    protected function serialize($value, array $attributes=array())
    {
        $attributes['type'] = 'submit';
        return parent::serialize($value, $attributes);
    }
}
