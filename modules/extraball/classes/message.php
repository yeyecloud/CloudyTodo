<?php defined('SYSPATH') or die('No direct script access.');

class Message {
	
	public static function confirmation($message)
	{
		$view = new View('message/confirmation');
		$view->message = $message;
		return $view;
	}
	
	public static function error($message)
	{
		$view = new View('message/error');
		$view->message = $message;
		return $view;
	}
	
	public static function warning($message)
	{
		$view = new View('message/warning');
		$view->message = $message;
		return $view;
	}
	
}