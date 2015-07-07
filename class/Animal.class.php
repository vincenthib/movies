<?php

abstract class Animal {

	public function description() {
		echo 'Je suis un '.get_class($this).'<br>';
	}

}

class Chien extends Animal {

	private $_race;

	public function __construct($race) {
		$this->_race = $race;
	}

	public function setRace($race) {
		$this->_race = $race;
	}

	public function getRace() {
		return ucfirst($this->_race);
	}

	public function description() {
		parent::description();
		echo 'Je suis un '.$this->_race.'<br>';
	}

	public function __set($key, $value) {
		$method = 'set'.ucfirst($key); // setRace
		if (method_exists($this, $method)) {
			$this->$method($value);
		}
	}

	public function __get($key) {
		$method = 'get'.ucfirst($key); // getRace
		if (method_exists($this, $method)) {
			return $this->$method();
		}
	}

	public function __toString() {
		return var_export($this, true);
	}

}

$chien = new Chien('caniche');

function __autoload($class_name) {
    $class_path = 'class/'.$class_name.'.class.php';
    if (file_exists($class_path)) {
        include $class_path;
        return true;
    }
    // On peut soulever une exception si le fichier n'existe pas
}

$test = new Blabla();
