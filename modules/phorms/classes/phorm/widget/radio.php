<?php
/**
 * RadioWidget
 * 
 * A radio button.
 * @author Jeff Ober
 * @package Widgets
 **/
//class RadioWidget extends PhormWidget
class Phorm_Widget_Radio extends Phorm_Widget
{
    /**
     * Stores whether or not the field is checked.
     **/
    private $checked;
    
    /**
     * @author Jeff Ober
     * @param boolean $checked whether the field is initially checked
     * @return null
     **/
    public function __construct($checked=false)
    {
        $this->checked = $checked;
    }
    
    /**
     * Returns the field as serialized HTML.
     * @author Jeff Ober
     * @param mixed $value the form widget's value attribute
     * @param array $attributes key=>value pairs corresponding to HTML attributes' name=>value
     * @return string the serialized HTML
     **/
    protected function serialize($value, array $attributes=array())
    {
        $attributes['type'] = 'radio';
        if ($this->checked) $attributes['checked'] = 'checked';
        return parent::serialize($value, $attributes);
    }
}
