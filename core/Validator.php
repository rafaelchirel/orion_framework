<?php
namespace Core;

class Validator
{
	public static function make(array $data, array $rules)
	{
		$errors = null;

		foreach ($rules as $ruleKey => $ruleValue) {

			foreach ($data as $dataKey => $dataValue) {
				if ($ruleKey == $dataKey) {

					$itemsValue = [];
					if (strpos($ruleValue, "|")) {
						$itemsValue = explode("|", $ruleValue);

						foreach ($itemsValue as $itemValue) {

							$items = [];
							if (strpos($itemValue, ":")) {
							$items = explode(":", $itemValue);

								switch ($items[0]) {
									case 'min':
										Rules::min($dataValue, $items[1], $ruleKey);
										break;

									case 'max':
										Rules::max($dataValue, $items[1], $ruleKey);
										break;

									case 'unique':
										Rules::unique($items[1], $items[2], $dataValue, $items[3], $ruleKey);
										break;
									
									default:
										# code...
										break;
								}
							} else {
								switch ($itemValue) {
									case 'required':
										Rules::required($dataValue, $ruleKey);
										break;

									case 'email':
										Rules::email($dataValue, $ruleKey);
										break;

									case 'float':
										Rules::float($dataValue, $ruleKey);
				                        break;

				                    case 'int':
				                    	Rules::int($dataValue, $ruleKey);
				                        break;
									
									default:
										//
										break;
								}
							}


						}

					}elseif (strpos($ruleValue, ":")) {
						$items = explode(":", $ruleValue);

						switch ($items[0]) {
							case 'min':
								Rules::min($dataValue, $items[1], $ruleKey);
								break;

							case 'max':
								Rules::max($dataValue, $items[1], $ruleKey);
								break;
							case 'unique':
								Rules::unique($items[1], $items[2], $dataValue, $items[3], $ruleKey);
								break;
							
							default:
								# code...
								break;
						}
					} else {
						switch ($ruleValue) {
							case 'required':
								Rules::required($dataValue, $ruleKey);
								break;

							case 'email':
								Rules::email($dataValue, $ruleKey);
								break;

							case 'float':
								Rules::float($dataValue, $ruleKey);
		                        break;

		                    case 'int':
		                        Rules::int($dataValue, $ruleKey);
		                        break;
							
							default:
								//
								break;
						}
					}
				}
			}
		}

		if (Rules::$errors) {
			Session::set('errors',Rules::$errors);
			Session::set('inputs', $data);
			return true;
		} else {
			Session::destroy(['errors', 'inputs']);
			return false;
		}
	}
}