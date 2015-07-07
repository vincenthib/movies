<?php

class Utils {

	public static function isDecimal($input){
	    return !(ctype_digit(strval($input)));
	}

	public static function cleanString($str, $delimiter='-') {
		$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
		$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
		$clean = strtolower(trim($clean, '-'));
		$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
		return $clean;
	}

	public static function getDuration($duration) {

		$hours = floor($duration / 60);
		$minutes = sprintf('%1$02d', $duration % 60);

		return $hours.'h'.$minutes.'min';
	}

	public static function getCamelCase($str) {
		return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $str))));
	}

	/*
		Fonction qui coupe une chaine en preservant les mots
		et ajoute une chaine à la fin du texte
	*/
	public static function cutString($text, $max_length = 0, $end = '...', $sep = '[@]') {

		// Si la variable $max_length est définie, supérieure à 0
		// Et que la longueur de la chaine $text est supérieure à $ max_length
		if ($max_length > 0 && strlen($text) > $max_length) {

			// On insère une chaine dans le texte tous les X caractères sans couper les mots
			$text = wordwrap($text, $max_length, $sep, true);
			// On découpe notre chaine en plusieurs bouts répartis dans un tableau
			$text = explode($sep, $text);

			// On retour le premier element du tableau concaténé avec la chaine $end
			return $text[0].$end;
		}

		// On retourne la chaine de départ telle quelle
		return $text;
	}

	public static function redirectJS($url, $delay = 1) {
		return '
		<script>
		setTimeout(function() {
			location.href = "'.$url.'";
		}, '.($delay * 1000).');
		</script>
		';
	}

	public static function getMonthLabel($month) {

		static $month_labels = array(
			'january' => 'janvier',
			'february' => 'février',
			'march' => 'mars',
			'april' => 'avril',
			'may' => 'mai',
			'june' => 'juin',
			'july' => 'juillet',
			'august' => 'août',
			'september' => 'septembre',
			'october' => 'octobre',
			'november' => 'novembre',
			'december' => 'décembre'
		);

		if (!isset($month_labels[$month])) {
			return $month;
		}
		return $month_labels[$month];
	}

	public static function displayList($list, $title = '', $url = '', $class = 'default') {

		// Si le tableau $list est vide
		if (empty($list)) {
			// On retourne une chaine vide
			return '';
		}

		// On remplit une variable avec le html
		$html = '<div class="panel panel-'.$class.'">
			<div class="panel-heading">'.$title.'</div>
			<div class="list-group">';

		// Pour chaque ligne du tableau $list
		foreach($list as $key => $row) {
			// On ajoute un lien à la variable $html
			$html .= '<a href="'.$url.'?id='.$row->id.'" class="list-group-item">'. ($key + 1).'. '.$row->title .'</a>';
		}

		// On finit de remplir $list avec les fermetures de balise
		$html .= '</div>
		</div>';

		// On renvoit le html au complet pour l'afficher
		return $html;
	}

}