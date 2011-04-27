<?php
/**
 * EmailField
 * 
 * A text field that only accepts a valid email address.
 * @author Jeff Ober
 * @package Fields
 **/
class Phorm_Field_Email extends Phorm_Field_Text
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
	    $validators = $this->add_validator($validators, Phorm_Validation::Email());
		parent::__construct($label, $validators, $attributes);
    }
    
    /**
     * Validates that the value is a valid email address.
     * @author Jeff Ober
     * @param string $value
     * @return null
     * @throws Phorm_Validation_Error
     **/
    /*public function validate($value)
    {
        parent::validate($value);
        if ( !preg_match('@^([-_\.a-zA-Z0-9]+)\@(([-_\.a-zA-Z0-9]+)\.)+[-_\.a-zA-Z0-9]+$@', $value) )
            throw new Phorm_Validation_Error($GLOBALS['phorms_tr']['emailfield_invalid']);
    }*/
}
