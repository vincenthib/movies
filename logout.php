<?php
include_once 'header.php';

// On détruit toutes les variables dans $_SESSION
session_unset();

// On détruit la session côté serveur
session_destroy();

// On détruit le cookie de session côté client
setcookie(session_name(), false, 1, '/');

// On détruit les cookies du remember me
setcookie('rememberme_data', false, 1);
setcookie('rememberme_token', false, 1);

echo '<div class="alert alert-success" role="success">Déconnexion réussie</div>';
echo redirectJS('index.php', 2);

include_once 'footer.php';