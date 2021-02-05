<?php
/**
 * Theme storage manipulations
 *
 * @package WordPress
 * @subpackage VINCENTES
 * @since VINCENTES 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Get theme variable
if (!function_exists('vincentes_storage_get')) {
	function vincentes_storage_get($var_name, $default='') {
		global $VINCENTES_STORAGE;
		return isset($VINCENTES_STORAGE[$var_name]) ? $VINCENTES_STORAGE[$var_name] : $default;
	}
}

// Set theme variable
if (!function_exists('vincentes_storage_set')) {
	function vincentes_storage_set($var_name, $value) {
		global $VINCENTES_STORAGE;
		$VINCENTES_STORAGE[$var_name] = $value;
	}
}

// Check if theme variable is empty
if (!function_exists('vincentes_storage_empty')) {
	function vincentes_storage_empty($var_name, $key='', $key2='') {
		global $VINCENTES_STORAGE;
		if (!empty($key) && !empty($key2))
			return empty($VINCENTES_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return empty($VINCENTES_STORAGE[$var_name][$key]);
		else
			return empty($VINCENTES_STORAGE[$var_name]);
	}
}

// Check if theme variable is set
if (!function_exists('vincentes_storage_isset')) {
	function vincentes_storage_isset($var_name, $key='', $key2='') {
		global $VINCENTES_STORAGE;
		if (!empty($key) && !empty($key2))
			return isset($VINCENTES_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return isset($VINCENTES_STORAGE[$var_name][$key]);
		else
			return isset($VINCENTES_STORAGE[$var_name]);
	}
}

// Inc/Dec theme variable with specified value
if (!function_exists('vincentes_storage_inc')) {
	function vincentes_storage_inc($var_name, $value=1) {
		global $VINCENTES_STORAGE;
		if (empty($VINCENTES_STORAGE[$var_name])) $VINCENTES_STORAGE[$var_name] = 0;
		$VINCENTES_STORAGE[$var_name] += $value;
	}
}

// Concatenate theme variable with specified value
if (!function_exists('vincentes_storage_concat')) {
	function vincentes_storage_concat($var_name, $value) {
		global $VINCENTES_STORAGE;
		if (empty($VINCENTES_STORAGE[$var_name])) $VINCENTES_STORAGE[$var_name] = '';
		$VINCENTES_STORAGE[$var_name] .= $value;
	}
}

// Get array (one or two dim) element
if (!function_exists('vincentes_storage_get_array')) {
	function vincentes_storage_get_array($var_name, $key, $key2='', $default='') {
		global $VINCENTES_STORAGE;
		if (empty($key2))
			return !empty($var_name) && !empty($key) && isset($VINCENTES_STORAGE[$var_name][$key]) ? $VINCENTES_STORAGE[$var_name][$key] : $default;
		else
			return !empty($var_name) && !empty($key) && isset($VINCENTES_STORAGE[$var_name][$key][$key2]) ? $VINCENTES_STORAGE[$var_name][$key][$key2] : $default;
	}
}

// Set array element
if (!function_exists('vincentes_storage_set_array')) {
	function vincentes_storage_set_array($var_name, $key, $value) {
		global $VINCENTES_STORAGE;
		if (!isset($VINCENTES_STORAGE[$var_name])) $VINCENTES_STORAGE[$var_name] = array();
		if ($key==='')
			$VINCENTES_STORAGE[$var_name][] = $value;
		else
			$VINCENTES_STORAGE[$var_name][$key] = $value;
	}
}

// Set two-dim array element
if (!function_exists('vincentes_storage_set_array2')) {
	function vincentes_storage_set_array2($var_name, $key, $key2, $value) {
		global $VINCENTES_STORAGE;
		if (!isset($VINCENTES_STORAGE[$var_name])) $VINCENTES_STORAGE[$var_name] = array();
		if (!isset($VINCENTES_STORAGE[$var_name][$key])) $VINCENTES_STORAGE[$var_name][$key] = array();
		if ($key2==='')
			$VINCENTES_STORAGE[$var_name][$key][] = $value;
		else
			$VINCENTES_STORAGE[$var_name][$key][$key2] = $value;
	}
}

// Merge array elements
if (!function_exists('vincentes_storage_merge_array')) {
	function vincentes_storage_merge_array($var_name, $key, $value) {
		global $VINCENTES_STORAGE;
		if (!isset($VINCENTES_STORAGE[$var_name])) $VINCENTES_STORAGE[$var_name] = array();
		if ($key==='')
			$VINCENTES_STORAGE[$var_name] = array_merge($VINCENTES_STORAGE[$var_name], $value);
		else
			$VINCENTES_STORAGE[$var_name][$key] = array_merge($VINCENTES_STORAGE[$var_name][$key], $value);
	}
}

// Add array element after the key
if (!function_exists('vincentes_storage_set_array_after')) {
	function vincentes_storage_set_array_after($var_name, $after, $key, $value='') {
		global $VINCENTES_STORAGE;
		if (!isset($VINCENTES_STORAGE[$var_name])) $VINCENTES_STORAGE[$var_name] = array();
		if (is_array($key))
			vincentes_array_insert_after($VINCENTES_STORAGE[$var_name], $after, $key);
		else
			vincentes_array_insert_after($VINCENTES_STORAGE[$var_name], $after, array($key=>$value));
	}
}

// Add array element before the key
if (!function_exists('vincentes_storage_set_array_before')) {
	function vincentes_storage_set_array_before($var_name, $before, $key, $value='') {
		global $VINCENTES_STORAGE;
		if (!isset($VINCENTES_STORAGE[$var_name])) $VINCENTES_STORAGE[$var_name] = array();
		if (is_array($key))
			vincentes_array_insert_before($VINCENTES_STORAGE[$var_name], $before, $key);
		else
			vincentes_array_insert_before($VINCENTES_STORAGE[$var_name], $before, array($key=>$value));
	}
}

// Push element into array
if (!function_exists('vincentes_storage_push_array')) {
	function vincentes_storage_push_array($var_name, $key, $value) {
		global $VINCENTES_STORAGE;
		if (!isset($VINCENTES_STORAGE[$var_name])) $VINCENTES_STORAGE[$var_name] = array();
		if ($key==='')
			array_push($VINCENTES_STORAGE[$var_name], $value);
		else {
			if (!isset($VINCENTES_STORAGE[$var_name][$key])) $VINCENTES_STORAGE[$var_name][$key] = array();
			array_push($VINCENTES_STORAGE[$var_name][$key], $value);
		}
	}
}

// Pop element from array
if (!function_exists('vincentes_storage_pop_array')) {
	function vincentes_storage_pop_array($var_name, $key='', $defa='') {
		global $VINCENTES_STORAGE;
		$rez = $defa;
		if ($key==='') {
			if (isset($VINCENTES_STORAGE[$var_name]) && is_array($VINCENTES_STORAGE[$var_name]) && count($VINCENTES_STORAGE[$var_name]) > 0) 
				$rez = array_pop($VINCENTES_STORAGE[$var_name]);
		} else {
			if (isset($VINCENTES_STORAGE[$var_name][$key]) && is_array($VINCENTES_STORAGE[$var_name][$key]) && count($VINCENTES_STORAGE[$var_name][$key]) > 0) 
				$rez = array_pop($VINCENTES_STORAGE[$var_name][$key]);
		}
		return $rez;
	}
}

// Inc/Dec array element with specified value
if (!function_exists('vincentes_storage_inc_array')) {
	function vincentes_storage_inc_array($var_name, $key, $value=1) {
		global $VINCENTES_STORAGE;
		if (!isset($VINCENTES_STORAGE[$var_name])) $VINCENTES_STORAGE[$var_name] = array();
		if (empty($VINCENTES_STORAGE[$var_name][$key])) $VINCENTES_STORAGE[$var_name][$key] = 0;
		$VINCENTES_STORAGE[$var_name][$key] += $value;
	}
}

// Concatenate array element with specified value
if (!function_exists('vincentes_storage_concat_array')) {
	function vincentes_storage_concat_array($var_name, $key, $value) {
		global $VINCENTES_STORAGE;
		if (!isset($VINCENTES_STORAGE[$var_name])) $VINCENTES_STORAGE[$var_name] = array();
		if (empty($VINCENTES_STORAGE[$var_name][$key])) $VINCENTES_STORAGE[$var_name][$key] = '';
		$VINCENTES_STORAGE[$var_name][$key] .= $value;
	}
}

// Call object's method
if (!function_exists('vincentes_storage_call_obj_method')) {
	function vincentes_storage_call_obj_method($var_name, $method, $param=null) {
		global $VINCENTES_STORAGE;
		if ($param===null)
			return !empty($var_name) && !empty($method) && isset($VINCENTES_STORAGE[$var_name]) ? $VINCENTES_STORAGE[$var_name]->$method(): '';
		else
			return !empty($var_name) && !empty($method) && isset($VINCENTES_STORAGE[$var_name]) ? $VINCENTES_STORAGE[$var_name]->$method($param): '';
	}
}

// Get object's property
if (!function_exists('vincentes_storage_get_obj_property')) {
	function vincentes_storage_get_obj_property($var_name, $prop, $default='') {
		global $VINCENTES_STORAGE;
		return !empty($var_name) && !empty($prop) && isset($VINCENTES_STORAGE[$var_name]->$prop) ? $VINCENTES_STORAGE[$var_name]->$prop : $default;
	}
}
?>