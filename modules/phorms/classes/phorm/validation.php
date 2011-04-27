<?php

/**
 * Phorm_Validation
 *
 * Validation class to provide built-in validation methods.
 * 
 * @author Thomas Lété
 * @package Phorm
 * @see Phorm
 **/
 
class Phorm_Validation
{
    public static function Required($value = false)
	{
		if($value === true)
		{
			return 'required';
		}
		elseif($value === false)
		{
			return 'Phorm_Validation::Required';
		}
		else
		{
			if ($value == '' || is_null($value))
				throw new Phorm_Validation_Error($GLOBALS['phorms_tr']['validation_required']);
		}
	}
	
    public static function DateNotInPast($value = false)
	{
		if($value === true)
		{
			return '';
		}
		elseif($value === false)
		{
			return 'Phorm_Validation::DateNotInPast';
		}
		elseif($value !== '')
		{
			if ($value < time())
				throw new Phorm_Validation_Error($GLOBALS['phorms_tr']['validation_date_in_past']);
		}
	}
	
    public static function Number($value = false)
	{
		if($value === true)
		{
			return 'digits';
		}
		elseif($value === false)
		{
			return 'Phorm_Validation::Number';
		}
		elseif($value !== '')
		{
		    if (preg_match('/\D/', $value))
		        throw new Phorm_Validation_Error(sprintf($GLOBALS['phorms_tr']['integerfield_notint'], $this->max_digits));
		}
	}
	
    public static function Decimal($value = false)
	{
		if($value === true)
		{
			return 'numberDE';
		}
		elseif($value === false)
		{
			return 'Phorm_Validation::Decimal';
		}
		elseif($value !== '')
		{
		    if (!is_numeric($value))
		        throw new Phorm_Validation_Error($GLOBALS['phorms_tr']['decimalfield_invalid']);
		}
	}
	
    public static function Url($value = false)
	{
		if($value === true)
		{
			return 'url';
		}
		elseif($value === false)
		{
			return 'Phorm_Validation::Url';
		}
		elseif($value !== '')
		{
		    if ( !preg_match('@^(http|ftp)s?://(\w+(:\w+)?\@)?(([-_\.a-zA-Z0-9]+)\.)+[-_\.a-zA-Z0-9]+(\w*)@', $value) )
		        throw new Phorm_Validation_Error($GLOBALS['phorms_tr']['urlfield_invalid']);
		}
	}
	
    public static function Email($value = false)
	{
		if($value === true)
		{
			return 'email';
		}
		elseif($value === false)
		{
			return 'Phorm_Validation::Email';
		}
		elseif($value !== '')
		{
		    if ( !preg_match('@^([-_\.a-zA-Z0-9]+)\@(([-_\.a-zA-Z0-9]+)\.)+[-_\.a-zA-Z0-9]+$@', $value) )
		        throw new Phorm_Validation_Error($GLOBALS['phorms_tr']['emailfield_invalid']);
		}
	}
	
    public static function Date($value = false)
	{
		if($value === true)
		{
			return 'date';
		}
		elseif($value === false)
		{
			return 'Phorm_Validation::Date';
		}
		elseif($value !== '')
		{
			if(preg_match($GLOBALS['phorms_tr']['dateformat_validation'], $value))
				$value = preg_replace($GLOBALS['phorms_tr']['dateformat_validation'], $GLOBALS['phorms_tr']['dateformat_replace'], $value);
			if (!strtotime($value))
		        throw new Phorm_Validation_Error($GLOBALS['phorms_tr']['datetimefield_badformat']);
		}
	}

	public static function is_builtin($function)
	{
		return strstr($function, get_class());
	}
	
}
