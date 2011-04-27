<?php
/**
 * ResetWidget
 * 
 * A reset button field.
 * @author Thomas Lété
 * @package Widgets
 **/
//class ResetWidget extends PhormWidget
class Phorm_Widget_Reset extends Phorm_Widget
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
        $attributes['type'] = 'reset';
        return parent::serialize($value, $attributes);
    }
}
