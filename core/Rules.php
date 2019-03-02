<?php
namespace Core;

abstract Class Rules {

	public static $errors = null;

	public static function min($dataValue, $items, $ruleKey)
	{
		if (strlen($dataValue) < $items) 
			self::$errors[$ruleKey] = "Campo {$ruleKey} debe tener un minimo de {$items} caracteres.";
	}

	public static function max($dataValue, $items, $ruleKey)
	{
		if (strlen($dataValue) > $items) 
			self::$errors[$ruleKey] = "Campo {$ruleKey} debe tener un maximo de {$items} caracteres.";
	}
	
	public static function unique($models, $campo, $value, $idUpdate, $ruleKey)
	{
		$objModel = "\\App\\Models\\" . ucwords($models);
		$model = new $objModel;
		$find = $model->where($campo, $value)->first();
		if (!empty($find->email)) {
			if (isset($idUpdate) && $find->id == $idUpdate) {
				//
			} else {
				self::$errors[$ruleKey] = "Campo {$ruleKey} se encuentra registrado, indique uno diferente.";
			}
		}
	}

	public static function email($email, $ruleKey)
	{
		if (!filter_var($email, FILTER_VALIDATE_EMAIL))
			self::$errors[$ruleKey] = "Campo {$ruleKey} no es un email.";
	}

	public static function required($input, $ruleKey)
	{
		if ($input == ' ' || empty($input)) 
			self::$errors[$ruleKey] = "Campo {$ruleKey} debe ser requerido";
	}

	public static function float($input, $ruleKey)
	{
		if (!filter_var($input, FILTER_VALIDATE_FLOAT))
			self::$errors[$ruleKey] = "Campo {$ruleKey} debe contener número decimal.";
	}

	public static function int($input, $ruleKey)
	{
		if (!filter_var($input, FILTER_VALIDATE_INT))
			self::$errors[$ruleKey] = "Campo {$ruleKey} debe contener número entero.";
	}
}