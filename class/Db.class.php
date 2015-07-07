<?php

class Db extends PDO {

	const ENGINE = 'mysql';
	const HOST 	 = 'localhost';
	const USER   = 'root';
	const PASS   = '';
	const DB     = 'movies';

	private static $_db_options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
    );

	private static $instance;

	public function __construct($database) {
		parent::__construct(self::ENGINE.':dbname='.$database.";host=".self::HOST, self::USER, self::PASS, self::$_db_options);
    }

	public static function getInstance($database = null) {
		$database = !empty($database) ? $database : self::DB;
		if(!isset(self::$instance)) {
			self::$instance = new Db($database);
		}
		return self::$instance;
	}
}