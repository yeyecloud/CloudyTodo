<?php
/**
 * CancelWidget
 * 
 * A reset button field.
 * @author Thomas Lété
 * @package Widgets
 **/
//class CancelWidget extends PhormWidget
class Phorm_Widget_Cancel extends Phorm_Widget
{
	/**
     * The "go back" url.
     **/
    private $url;
    
    /**
     * @author Thomas Lété
     * @param string $url to go on click.
     * @return null
     **/
    public function __construct(array $valid_mime_types)
    {
        $this->types = $valid_mime_types;
    }
	
    /**
     * Returns the button as serialized HTML.
     * @author Thomas Lété
     * @param mixed $value the form widget's value attribute
     * @param array $attributes key=>value pairs corresponding to HTML attributes' name=>value
     * @return string the serialized HTML
     **/
    protected function serialize($value, array $attributes=array())
    {
        $attributes['type'] = 'button';
		$attributes['onclick'] = 'window.location.href=\'' . str_replace("'", "\'", $this->url) . '\'';
        return parent::serialize($value, $attributes);
    }
}
