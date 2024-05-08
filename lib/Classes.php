<?php

/**
 * Static class to perform Class functions
 *
 * @author Peter Donders
 * @version 1.2.0
 *
 * Changelog
 * 1.2.0
 *		Added getClassMethodParameters method
 *		Added getClassMethodDocumentation method
 * 1.1.0
 *		Added getClassConstants method
 * 1.0.0
 * 		First version
 */
class Classes
{
	/**
	 * Private constructor to force this class to be static
	 *
	 */
	private function __construct()
	{
	}

	/**
	 * Get a constant from a class dynamicly
	 * This is a PHP < 5.3.0 workaround.
	 * As of PHP 5.3.0, it's possible to reference the class using a variable. The variable's value can not be a keyword (e.g. self, parent and static).
	 *
	 * @param string $class
	 * @param string $const
	 * @return mixed
	 */
	public static function getClassConst($class, $const)
	{
		return constant(sprintf('%s::%s', $class, $const));
	}

	/**
	 * Get a list of defined constants of a class
	 *
	 * @since 1.1.0
	 * @param string $class
	 * @param string $prefix
	 * @return mixed|false
	 */
	public static function getClassConstants($class, $prefix = "")
	{
		try
		{
			$reflect = new ReflectionClass($class);
		}
		catch (ReflectionException $e)
		{
			return false;
		}

		$consts = $reflect->getConstants();

		if (!strlen($prefix))
			return $consts;

		foreach ($consts as $const => $value)
			if (stripos($const, $prefix) !== 0)
				unset ($consts[$const]);

    	return $consts;
	}

	/**
	 * Get the parameters of a given class method
	 *
	 * @since 1.2.0
	 * @param string $className
	 * @param string $methodName
	 * @return mixed|false
	 */
	public static function getClassMethodParameters($className, $methodName)
	{
		try
		{
			$method = new ReflectionMethod($className, $methodName);
		}
		catch (ReflectionException $e)
		{
			return false;
		}
		$parameters = $method->getParameters();

		$return = array();
		foreach ($parameters as $parameter)
			$return[] = $parameter->name;

		return $return;
	}

	/**
	 * Get the documentation of a given class method
	 *
	 * @since 1.2.0
	 * @param string $className
	 * @param string $methodName
	 * @return string
	 */
	public static function getClassMethodDocumentation($className, $methodName)
	{
		try
		{
			$method = new ReflectionMethod($className, $methodName);
		}
		catch (ReflectionException $e)
		{
			return "";
		}

		$docs = $method->getDocComment();
		return str_replace(array("\t", "    "), array("",""), $docs);
	}
}
