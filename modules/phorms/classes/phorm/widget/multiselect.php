<?php
/**
 * MultiSelectWidget
 * 
 * A select multiple widget.
 * @author Jeff Ober
 * @package Widgets
 **/
//class MultiSelectWidget extends PhormWidget
class Phorm_Widget_Multiselect extends Phorm_Widget
{
    /**
     * The choices for this field as an array of actual=>display values.
     **/
    private $choices;
    
    /**
     * @author Jeff Ober
     * @param array $choices the choices as an array of actual=>display values
     * @return null
     **/
    public function __construct(array $choices)
    {
        $this->choices = $choices;
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
     * @param array $value the form widget's values
     * @param array $attributes key=>value pairs corresponding to HTML attributes' name=>value
     * @return string the serialized HTML
     **/
    protected function serialize($value, array $attributes=array())
    {
        if (is_null($value))
            $value = array();
        
        if (!is_array($value))
            $value = array($value);
        
        $options = array();
        foreach($this->choices as $actual => $display)
        {
            $option_attributes = array('value' => $this->clean_string($actual));
            if (in_array($actual, $value)) $option_attributes['selected'] = 'selected';
            $options[] = sprintf('<option %s>%s</option>',
                $this->serialize_attributes($option_attributes),
                $this->clean_string($display));
        }
        
        return sprintf('<select multiple="multiple" %s>%s</select>',
            $this->serialize_attributes($attributes),
            implode($options));
    }
}
