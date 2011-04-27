<?php
/**
 * URLField
 * 
 * A text field that only accepts a reasonably-formatted URL. Supports HTTP(S)
 * and FTP. If a value is missing the HTTP(S)/FTP prefix, adds it to the final
 * value.
 * @author Jeff Ober
 * @package Fields
 **/
class Phorm_Field_Url extends Phorm_Field_Text
{
    /**
     * @author Thomas Lété
     * @param string $label the field's text label
     * @param int $max_digits the maximum number of digits permitted
     * @param array $validators a list of callbacks to validate the field data
     * @param array $attributes a list of key/value pairs representing HTML attributes
     **/
    public function __construct($label, $max_digits, array $validators=array(), array $attributes=array())
    {
		$validators = $this->add_validator($validators, Phorm_Validation::Url());
		parent::__construct($label, $validators, $attributes);
    }
    
    /**
     * Prepares the value by inserting http:// to the beginning if missing.
     * @author Jeff Ober
     * @param string $value
     * @return string
     **/
    public function prepare_value($value)
    {
        if (!empty($value) && !preg_match('@^(http|ftp)s?://@', $value))
            return sprintf('http://%s', $value);
        else
            return $value;
    }
    
    /**
     * Validates the the value is a valid URL (mostly).
     * @author Jeff Ober
     * @param string $value
     * @return null
     * @throws Phorm_Validation_Error
     **/
    /*public function validate($value)
    {
        parent::validate($value);
        if ( !preg_match('@^(http|ftp)s?://(\w+(:\w+)?\@)?(([-_\.a-zA-Z0-9]+)\.)+[-_\.a-zA-Z0-9]+(\w*)@', $value) )
            throw new Phorm_Validation_Error($GLOBALS['phorms_tr']['urlfield_invalid']);
    }*/
}
