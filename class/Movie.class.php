<?php
class Movie {

	public $id;
	public $slug;
	public $title;
	public $year;
	public $genres;
	public $synopsis;
	public $directors;
	public $actors;
	public $writers;
	public $runtime;
	public $mpaa;
	public $rating;
	public $popularity;
	public $modified;
	public $created;
	public $poster_flag;
	public $cover;

	// Par défaut on défini l'argument $data facultatif et vide par défaut, ce qui permet de continuer à instancier l'objet avec new Movie() en utilisant les setters manuellement
    public function __construct($data = array())    {

        // Pour chaque élément du tableau $data
        foreach ($data as $key => $value) {
            // On défini une variable pour reconstituer le nom d'un setter avec la clé issue du tableau $data
            $method = Utils::getCamelCase('set'.ucfirst($key)); // Ex: setTitle

            // Si le setter existe dans la classe
            if (method_exists($this, $method)) {

                // On appelle le setter et on lui passe la valeur issue du tableau $data
                $this->$method($value); // Ex: $this->setTitle('Star Wars');
            }
        }
    }

    public function __set($key, $value) {
		$method = Utils::getCamelCase('set'.ucfirst($key)); // Ex: setTitle
		if (method_exists($this, $method)) {
			$this->$method($value);
		}
	}

	public function __get($key) {
		$method = Utils::getCamelCase('get'.ucfirst($key)); // Ex: getTitle
		if (method_exists($this, $method)) {
			return $this->$method();
		}
	}


	public static function _getList($result) {
		$movies = array();
		foreach($result as $movie) {
			$movies[] = new Movie($movie);
		}
		return $movies;
	}

	public static function getList($limit = 0, $order = '', $select_fields = '*') {

		$sql = 'SELECT '.$select_fields.' FROM movies ';

		if (!empty($order)) {
			$sql .= 'ORDER BY '.$order.' ';
		}

		$sql .= 'LIMIT :limit';

		$query = Db::getInstance()->prepare($sql);
		$query->bindValue('limit', $limit, PDO::PARAM_INT);
		$query->execute();
		$result = $query->fetchAll();

		return self::_getList($result);
	}

	public static function get($id) {
		$query = Db::getInstance()->prepare('SELECT * FROM movies WHERE id = :id');
		$query->bindValue(':id', $id, PDO::PARAM_INT);
		$query->execute();
		if ($query->rowCount() == 0) {
			throw new Exception("Movie not found from db with id = $id");
		}
		return new Movie($query->fetch());
	}

	public static function getRandom() {
		$result = self::getList(1, 'RAND()');
		return $result[0];
	}

	public function getId() {
		return $this->id;
	}
	public function getSlug() {
		return $this->slug;
	}
	public function getTitle() {
		return $this->title;
	}
	public function getYear() {
		return $this->year;
	}
	public function getGenres() {
		return $this->genres;
	}
	public function getSynopsis() {
		return $this->synopsis;
	}
	public function getDirectors() {
		return $this->directors;
	}
	public function getActors() {
		return $this->actors;
	}
	public function getWriters() {
		return $this->writers;
	}
	public function getRuntime() {
		return $this->runtime;
	}
	public function getMpaa() {
		return $this->mpaa;
	}
	public function getRating() {
		return $this->rating;
	}
	public function getPopularity() {
		return $this->popularity;
	}
	public function getModified() {
		return $this->modified;
	}
	public function getCreated() {
		return $this->created;
	}
	public function getPoster_flag() {
		return $this->poster_flag;
	}
	/*
	Fonction qui renvoie le chemin d'une cover de film
	ou de la cover par defaut
	*/
	public function getCover() {

		global $root_dir, $root_path;

		// On défini le chemin de la cover par defaut
		$cover = $root_path.'img/cover.png';

		// Si la variable $id est définie et supérieure à 0
		if (!empty($this->id)) {
			// On défini le chemin de la cover d'un film à partir de son id
			$movie_cover = 'img/covers/'.$this->id.'.jpg';

			// Si le fichier existe sur le serveur
			if (file_exists($root_dir.$movie_cover)) {
				// On retourne le chemin de la cover du film
				return $root_path.$movie_cover;
			}
		}
		// On retourne le chemin de la cover par defaut
		return $cover;
	}


	public function setId($id) {
		$this->id = $id;
	}
	public function setSlug($slug) {
		$this->slug = $slug;
	}
	public function setTitle($title) {
		$this->title = $title;
	}
	public function setYear($year) {
		$this->year = $year;
	}
	public function setGenres($genres) {
		$this->genres = $genres;
	}
	public function setSynopsis($synopsis) {
		$this->synopsis = $synopsis;
	}
	public function setDirectors($directors) {
		$this->directors = $directors;
	}
	public function setActors($actors) {
		$this->actors = $actors;
	}
	public function setWriters($writers) {
		$this->writers = $writers;
	}
	public function setRuntime($runtime) {
		$this->runtime = $runtime;
	}
	public function setMpaa($mpaa) {
		$this->mpaa = $mpaa;
	}
	public function setRating($rating) {
		$this->rating = $rating;
	}
	public function setPopularity($popularity) {
		$this->popularity = $popularity;
	}
	public function setModified($modified) {
		$this->modified = $modified;
	}
	public function setCreated($created) {
		$this->created = $created;
	}
	public function setPoster_flag($poster_flag) {
		$this->poster_flag = $poster_flag;
	}
	public function setCover($cover) {
		$this->cover = $cover;
	}

	/*

	*/
	public static function getSimilarMovies($movie, $type, $limit = 5, $sep = ', ') {

		// On rapatrie la connexion à la base de données
		$db = Db::getInstance();

		// On définie la liste des types autorisés
		static $types = array('genres', 'actors', 'directors', 'writers');

		// Si le type reçu en paramètre n'est pas dans la liste des types autorisés
		// OU que le type n'est pas présent en clé du tableau $movie
		if (!in_array($type, $types) || empty($movie->$type)) {
			return array();
		}

		// On explose la chaîne avec un séparateur et on répartit dans un tableau
		$items = explode($sep, $movie->$type);

		$filters = array();
		foreach($items as $item) {
			// Pour chaque élément dans $items, on ajoute un filtre pour le WHERE
			$filters[] = $type.' LIKE "%'.$item.'%"';
		}

		// On reconstitue la requête
		$sql = 'SELECT * FROM movies WHERE 1';
		// On recolle tous les éléments du tableau $filters sous forme de chaîne avec OR en séparateur
		$sql .= ' AND ('.implode(' OR ', $filters).')';
		// On exclue l'id du film reçu en paramètre, on mélange les résultats et on garde X résultats
		$sql .= ' AND id != :id ORDER BY RAND() LIMIT :limit';

		$query = $db->prepare($sql);
		$query->bindValue('id', $movie->id, PDO::PARAM_INT);
		$query->bindValue('limit', $limit, PDO::PARAM_INT);
		$query->execute();
		$result = $query->fetchAll();

		// On renvoie les résultats de la requête
		return self::_getList($result);;
	}

}