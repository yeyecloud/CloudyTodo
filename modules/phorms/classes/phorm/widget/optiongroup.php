<?php
/**
 * OptionGroupWidget
 * 
 * A compound widget made up of multiple CheckboxWidgets.
 * @author Jeff Ober
 * @package Widgets
 * @see CheckboxWidget
 **/
//class OptionGroupWidget extends PhormWidget
class Phorm_Widget_Optiongroup extends Phorm_Widget
{
    /**
     * The options for this field as an array of actual=>display values.
     **/
    private $options;
    
    /**
     * @author Jeff Ober
     * @param array $options the options as an array of actual=>display values
     * @return null
     **/
    public function __construct(array $options)
    {
        $this->options = $options;
    }
    
    /**
     * @author Jeff Ober
     * @param array $value an array of the field's values
     * @param array $attributes key=>value pairs corresponding to HTML attributes' name=>value 
     **/
    public function html($value, array $attributes=array())
    {
        if (is_null($value)) $value = array();
        
        foreach ($attributes as $key => $val)
            $attributes[$this->clean_string( $key )] = $this->clean_string( $val );
        
        return $this->serialize($value, $attributes);
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
        $html = "";
        foreach ($this->options as $actual => $display)
        {
            $option = new CheckboxWidget( in_array($actual, $value) );
            $html .= sprintf('%s %s', $this->clean_string($display), $option->html($actual, $attributes));
        }
        
        return $html;
    }
}
