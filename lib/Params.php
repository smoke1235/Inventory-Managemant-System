<?php

/**
 * Component that gives a single entrypoint to GET/POST/COOKIE parameters
 *
 * @author Peter Donders
 * @version 1.0.0
 *
 * Changelog
 * 1.0.0
 * 		First version
 */
class Params {

	protected static $instance;

	/**
	 * Internal list of parameters
	 *
	 * @var mixed
	 */
	protected $params = array();

	/**
	 * Constructor, initializes the parameters from GPC
	 *
	 */
	protected function __construct() {
		// Initialize params
		if (is_array($_REQUEST) && count($_REQUEST)) {
			$this->params = $_REQUEST;
        }
	}

	/**
	 * Get a parameter
	 *
	 * @param string $key
	 * @param mixed $default Returned when requested param is not set
	 * @return mixed
	 */
	public function get($key, $default = null) {
		if(isset($this->params[$key]))
			return $this->params[$key];
		else
			return $default;
	}

	/**
	 * Set a parameter
	 *
	 * @param string $key
	 * @param mixed $value
	 */
	public function set($key, $value) {
		$this->params[$key] = $value;
	}

	/**
	 * Clear a parameter
	 *
	 * @param string $key
	 */
	public function reset($key) {
		if (isset($this->params[$key]))
			unset($this->params[$key]);
	}

	/**
	 * Get a parameter and clear it
	 *
	 * @param string $key
	 * @param mixed $default
	 * @return mixed
	 */
	public function flush($key, $default = null) {
		$value = $this->get($key, $default);
		$this->reset($key);
		return $value;
	}

	/**
	 * Initialize the component
	 *
	 * @param Cms &$cms
	 * @param mixed $params
	 */
	public static function loadParams() {
    
        if (!isset(self::$instance)) {
			self::$instance = new self();
		}
		
		return self::$instance;
	}
}
