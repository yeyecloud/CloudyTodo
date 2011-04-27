<?php
/**
 * TextWidget
 * 
 * A textarea.
 * @author Jeff Ober
 * @package Widgets
 **/
//class TextWidget extends PhormWidget
class Phorm_Widget_Text extends Phorm_Widget
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
        return sprintf('<textarea %s>%s</textarea>', $this->serialize_attributes($attributes), $value);
    }
}
