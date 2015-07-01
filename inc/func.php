<?php

/*
	Fonction qui renvoie le chemin d'une cover de film
	ou de la cover par defaut
*/
function getCover($id = null) {

	// On défini le chemin de la cover par defaut
	$cover = 'img/cover.png';

	// Si la variable $id est définie et supérieure à 0
	if (!empty($id)) {
		// On défini le chemin de la cover d'un film à partir de son id
		$movie_cover = 'img/covers/'.$id.'.jpg';
		// Si le fichier existe sur le serveur
		if (file_exists($movie_cover)) {
			// On retourne le chemin de la cover du film
			return $movie_cover;
		}
	}
	// On retourne le chemin de la cover par defaut
	return $cover;
}

/*
	Fonction qui coupe une chaine en preservant les mots
	et ajoute une chaine à la fin du texte
*/
function cutString($text, $max_length = 0, $end = '...', $sep = '[@]') {

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