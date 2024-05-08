<?php

/**
 * Static class for validating variables
 *
 * @author Peter Donders
 * @version 1.0.0
 *
 * Changelog
 * 1.0.0
 * 		First version
 */

class Validator
{
    /**
	 * Check if a variable is a valid enumeration
	 * Validates true if $enum is within the list $allowedValues
	 *
	 * @param mixed $enum
	 * @param mixed $allowedValues
	 * @return bool
	 */
	public static function isEnum($enum, $allowedValues)
	{
		if (strlen($enum) && self::isArray($allowedValues) && in_array($enum, $allowedValues))
			return true;
		else
			return false;
	}

    /**
	 * Check if a variable is a valid MySQL ordering direction
	 * ("ASC" or "DESC")
	 *
	 * @param mixed $orderDir
	 * @return bool
	 */
	public static function isOrderDir($orderDir)
	{
		if (self::isString($orderDir))
		{
			$orderDir = strtoupper($orderDir);
			if ($orderDir === 'ASC' || $orderDir === 'DESC')
				return true;
		}
		return false;
	}

    /**
	 * Check if a variable is a valid array
	 *
	 * @param mixed $array
	 * @param bool $allowEmpty Validates true when the array is empty
	 * @return bool
	 */
	public static function isArray($array, $allowEmpty = true)
	{
		if (isset($array) && is_array($array) && ($allowEmpty || count($array) > 0))
			return true;
		else
			return false;
	}

    /**
	 * Check if a variable is a valid string
	 *
	 * @param mixed $string
	 * @param int $minLength Minimum length of the string (false or 0 if not applicable)
	 * @param int $maxLength Maximum length of the string (false of 0 if not applicable)
	 * @param bool $ignoreWhiteSpaces Trim whitespaces before checking the length of the string
	 * @return bool
	 */
	public static function isString($string, $minLength = 1, $maxLength = false, $ignoreWhiteSpaces = true)
	{
		if (!isset($string) || is_object($string) || is_null($string) || is_array($string))
			return false;

		if ($ignoreWhiteSpaces)
			$string = trim($string);

		if (self::isInt($minLength) && $minLength > 0 && strlen($string) < $minLength)
			return false;

		if (self::isInt($maxLength) && $maxLength > 0 && strlen($string) > $maxLength)
			return false;

		return true;
	}

    /**
	 * Check if the variable is a valid integer number
	 *
	 * @param mixed $int
	 * @return bool
	 */
	public static function isInt($int)
	{
		if (isset($int) && is_numeric($int) && ((int) $int) == $int)
			return true;
		else
			return false;
	}

	/**
	 * Check if the variable is a valid floating point number
	 *
	 * @param mixed $float
	 * @return bool
	 */
	public static function isFloat($float)
	{
		if (isset($float) && is_float($float) && ((float) $float) == $float)
			return true;
		else
			return false;
	}

	/**
	 * Check if an object is valid
	 *
	 * @param mixed $object
	 * @param mixed $type Validates if object is an instance of this class
	 * @return bool
	 */
	public static function isObject($object, $type = false)
	{
		if (isset($object) && is_object($object))
		{
			if(self::isString($type))
			{
				if(strtolower(get_class($object)) == strtolower($type))
					return true;
				else
					return false;
			}
			else
				return true;
		}
		else
			return false;
	}

}