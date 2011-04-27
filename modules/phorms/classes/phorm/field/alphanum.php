<?php
/**
 * AlphaNumField
 * 
 * A text field that only accepts alpha (a-z) or numeric (0-9) characters.
 * @author Lété Thomas
 * @package Fields
 **/
class Phorm_Field_Alphanum extends Phorm_Field_Text
{
    /**
     * Validates that the value is alpha or numeric only.
     * @author Thomas Lété
     * @param string $value
     * @return null
     * @throws Phorm_Validation_Error
     **/
    public function validate($value)
    {
        parent::validate($value);
        if ( !preg_match('@^[a-z0-9]+$@i', $value) )
            throw new Phorm_Validation_Error($GLOBALS['phorms_tr']['alphanumfield_invalid']);
    }
}
