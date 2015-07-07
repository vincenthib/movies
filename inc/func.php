<?php

define('REMEMBER_ME_SECRET_KEY', 'grain de sable 2015');

function getUserToken() {
	$protocol = $_SERVER['REQUEST_SCHEME']; // Contient le protocole en cours http ou https

	// On définit l'empreinte de l'utilisateur, url en cours et user agent
	$footprints = $protocol.'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'].$_SERVER['HTTP_USER_AGENT'];

	// On crée un jeton qui contient la clé secrète concaténée avec l'empreinte de l'utilisateur
	$token = REMEMBER_ME_SECRET_KEY.$footprints;

	return $token;
}

function setRememberMe($user_id, $expiration) {

	$current_time = time(); // On définit le timestamp actuel

	$token = getUserToken();

	// On définit une chaîne qui contient nos infos en clair
	$user_data = $current_time.'.'.$user_id;

	// On crypte les informations en clair concaténées avec le jeton
	$crypted_token = hash('sha256', $token.$user_data);

	// On stock les infos en clair et les infos cryptées dans des cookies
	setcookie('rememberme_data', $user_data, $current_time + $expiration);
	setcookie('rememberme_token', $crypted_token, $current_time + $expiration);
}

function getRememberMe($expiration) {

	if (empty($_COOKIE['rememberme_data']) || empty($_COOKIE['rememberme_token'])) {
		return false;
	}

	$current_time = time(); // On définit le timestamp actuel

	$token = getUserToken();

	// On crypt les informations du cookie concaténées avec le jeton
	$crypted_token = hash('sha256', $token.$_COOKIE['rememberme_data']);

	// On vérifie que le jeton du cookie est égal au jeton crypté au dessus
	if(strcmp($_COOKIE['rememberme_token'], $crypted_token) !== 0) {
		return false;
	}

	// On récupère les infos du cookie dans 2 variables, correspondant aux 2 entrées du tableau renvoyé par explode
	list($user_time, $user_id) = explode('.', $_COOKIE['rememberme_data']);

	// On vérifie que le timestamp défini dans le cookie expire dans le futur et qu'il a été défini dans le passé
	if($user_time + $expiration > $current_time && $user_time < $current_time) {
		return $user_id;
	}
	return false;
}

// On définit des constantes pour associer un libellé lisible au chiffre correspond au statut (c'est comme un alias de notre chiffre)
define('STATUS_DEFAULT_USER', 0);
define('STATUS_CONTRIBUTOR_USER', 1);
define('STATUS_ADMIN_USER', 2);
define('STATUS_SUPER_ADMIN_USER', 3);

/*
	Fonction qui définit si une page est autorisée pour un statut donné

	@param $page string
	@param $status int
	@return boolean
*/
function isAllowedAccess($page, $status) {

	// On définit une liste de page avec le statut minimum pour y accèder
	$pages = array(
		'index.php' => STATUS_CONTRIBUTOR_USER,
		'movies.php' => STATUS_CONTRIBUTOR_USER,
		'update-movie.php' => STATUS_CONTRIBUTOR_USER,
		'update-user.php' => STATUS_ADMIN_USER,
		'stats.php' => STATUS_ADMIN_USER,
		'comments.php' => STATUS_ADMIN_USER,
		'messages.php' => STATUS_ADMIN_USER
	);

	// Si la page qu'on a passé en paramètre $page n'est pas dans le tableau, alors on autorise
	if (empty($pages[$page])) {
		return true;
	}

	// Si le statut passé en paramètre $status est supérieur ou égal au statut défini dans le tableau pour la page passé en paramètre $page, alors on autorise
	if ($status >= $pages[$page]) {
		return true;
	}
	// Sinon on n'autorise pas
	return false;
}

function getStatusLabel($status) {

	$status_labels = array(
		STATUS_DEFAULT_USER => 'Utilisateur',
		STATUS_CONTRIBUTOR_USER => 'Contributeur',
		STATUS_ADMIN_USER => 'Admin'
	);
	return $status_labels[$status];
}

function getStatusClass($status) {

	$status_classes = array(
		STATUS_DEFAULT_USER => 'default',
		STATUS_CONTRIBUTOR_USER => 'info',
		STATUS_ADMIN_USER => 'danger'
	);
	return $status_classes[$status];
}