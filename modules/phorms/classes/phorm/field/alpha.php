<?php
/**
 * AlphaField
 * 
 * A text field that only accepts alpha (a-zA-Z) characters.
 * @author Lété Thomas
 * @package Fields
 **/
class Phorm_Field_Alpha extends Phorm_Field_Text
{
    /**
     * Validates that the value is alpha only.
     * @author Thomas Lété
     * @param string $value
     * @return null
     * @throws Phorm_Validation_Error
     **/
    public function validate($value)
    {
        parent::validate($value);
        if ( !preg_match('@^[a-z]+$@i', $value) )
            throw new Phorm_Validation_Error($GLOBALS['phorms_tr']['alphafield_invalid']);
    }
}
