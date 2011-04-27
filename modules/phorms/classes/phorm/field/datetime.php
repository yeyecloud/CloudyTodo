<?php
/**
 * DateTimeField
 * 
 * A text field that accepts a variety of date/time formats (those accepted by
 * PHP's built-in strtotime.) Note that due to the reliance on strtotime, this
 * class has a serious memory leak in PHP 5.2.8 (I am unsure if it is present
 * as well in 5.2.9+.)
 * @author Jeff Ober
 * @package Fields
 **/
class Phorm_Field_Datetime extends Phorm_Field_Text
{
    /**
     * @author Jeff Ober
     * @param string $label the field's text label
     * @param array $validators a list of callbacks to validate the field data
     * @param array $attributes a list of key/value pairs representing HTML attributes
     **/
    public function __construct($label, array $validators=array(), array $attributes=array())
    {
    	$validators = $this->add_validator($validators, Phorm_Validation::Date());
        parent::__construct($label, 25, 100, $validators, $attributes);
    }
    
    /**
     * Validates that the value is parsable as a date/time value.
     * @author Jeff Ober
     * @param string $value
     * @return null
     * @throws Phorm_Validation_Error
     **/
    /*public function validate($value)
    {
        parent::validate($value);
		if(preg_match($GLOBALS['phorms_tr']['dateformat_validation'], $value))
			$value = preg_replace($GLOBALS['phorms_tr']['dateformat_validation'], $GLOBALS['phorms_tr']['dateformat_replace'], $value);
		if (!strtotime($value))
            throw new Phorm_Validation_Error($GLOBALS['phorms_tr']['datetimefield_badformat']);
    }*/
    
    /**
     * Imports the value and returns a unix timestamp (the number of seconds
     * since the epoch.)
     * @author Jeff Ober
     * @param string $value
     * @return int the date/time as a unix timestamp
     **/
    public function import_value($value)
    {
        $value = parent::import_value($value);
        // Convert the date in a correct format for strtotime
		if(preg_match($GLOBALS['phorms_tr']['dateformat_validation'], $value))
			$value = preg_replace($GLOBALS['phorms_tr']['dateformat_validation'], $GLOBALS['phorms_tr']['dateformat_replace'], $value);
        return strtotime($value);
    }
}
