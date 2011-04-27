<?php
/**
 * PhormWidget
 * 
 * The base class of all HTML form widgets.
 * @author Jeff Ober
 * @package Widgets
 **/
class Phorm_Widget
{
    /**
     * Serializes an array of key=>value pairs as an HTML attributes string.
     * @author Jeff Ober
     * @param array $attributes key=>value pairs corresponding to HTML attributes' name=>value
     * @return string the serialized HTML
     **/
    protected function serialize_attributes(array $attributes=array())
    {
        $attr = array();
        foreach($attributes as $key => $val)
            $attr[] = sprintf('%s="%s"', $key, $val);
        return implode(' ', $attr);
    }
    
    /**
     * Serializes the widget as an HTML form input.
     * @author Jeff Ober
     * @param string $value the form widget's value
     * @param array $attributes key=>value pairs corresponding to HTML attributes' name=>value
     * @return string the serialized HTML
     **/
    protected function serialize($value, array $attributes=array())
    {
        return sprintf('<input %s value="%s" />', $this->serialize_attributes($attributes), $value);
    }
    
    /**
     * Casts a value to a string and encodes it for HTML output.
     * @author Jeff Ober
     * @param mixed $str
     * @return a decoded string
     **/
    protected function clean_string($str)
    {
        return htmlentities((string)$str, ENT_COMPAT, 'UTF-8');
    }
    
    /**
     * Returns the field as serialized HTML.
     * @author Jeff Ober
     * @param mixed $value the form widget's value attribute
     * @param array $attributes key=>value pairs corresponding to HTML attributes' name=>value
     * @return string the serialized HTML
     **/
    public function html($value, array $attributes=array())
    {
        $value = $this->clean_string( $value );
        foreach ($attributes as $key => $val)
            $attributes[$this->clean_string( $key )] = $this->clean_string( $val );
        return $this->serialize($value, $attributes);
    }
}
