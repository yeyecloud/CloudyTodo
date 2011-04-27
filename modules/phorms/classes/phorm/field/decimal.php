<?php
/**
 * DecimalField
 * 
 * A field that accepts only decimals of a specified precision.
 * @author Jeff Ober
 * @package Fields
 **/
class Phorm_Field_Decimal extends Phorm_Field
{
    /**
     * The maximum precision of the field's value.
     **/
    private $precision;
    
    /**
     * @author Jeff Ober
     * @param string $label the field's text label
     * @param int $precision the maximum number of decimals permitted
     * @param array $validators a list of callbacks to validate the field data
     * @param array $attributes a list of key/value pairs representing HTML attributes
     **/
    public function __construct($label, $precision, array $validators=array(), array $attributes=array())
    {
        $validators = $this->add_validator($validators, Phorm_Validation::Decimal());
        $attributes['size'] = 20;
        parent::__construct($label, $validators, $attributes);
        $this->precision = $precision;
    }
    
    /**
     * Returns a new Phorm_Widget_Char.
     * @author Jeff Ober
     * @return Phorm_Widget_Char
     **/
    public function get_widget()
    {
        return new Phorm_Widget_Char();
    }
    
    /**
     * Validates that the value is parsable as a float.
     * @author Jeff Ober
     * @param string value
     * @return null
     * @throws Phorm_Validation_Error
     **/
    /*public function validate($value)
    {
        if (!is_numeric($value))
            throw new Phorm_Validation_Error($GLOBALS['phorms_tr']['decimalfield_invalid']);
    }*/
    
    /**
     * Returns the parsed float, rounded to $this->precision digits.
     * @author Jeff Ober
     * @param string $value
     * @return float the parsed value
     **/
    public function import_value($value)
    {
        return round((float)(html_entity_decode($value)), $this->precision);
    }
}
