<?php
session_start();
date_default_timezone_set('Europe/Paris'); /*Sert à définir la référence temporelle: essentiel pour l'utilisation du type Temps*/


$pages=[['accueil','controllers/accueil.php'],['recherche', 'controllers/recherche.php'],['signup','controllers/signup.php'],['activation','controllers/activation.php'],['signin','controllers/signin.php'],['profil','controllers/profil.php'],['locate','controllers/locate.php'],['servicesMaps','controllers/servicesMaps.php'],['activationContributeur', 'controllers/activationContributeur.php'],['favoris','controllers/favoris.php'],['modifierServices', 'controllers/modifierServices.php'],['servicesAffiche','controllers/servicesAffiche.php'],['pageServiceAdmin','controllers/pageServiceAdminC.php'],['ajoutAdmin','controllers/ajoutAdmin.php'],['activationAdmin','controllers/activationAdmin.php'],['contact','controllers/contact.php'],['activationService','controllers/activationService.php'],['ajoutServices','controllers/ajoutServices']];

$pagesPlan=[['accueil','controllers/accueil.php'],['recherche', 'controllers/recherche.php'],['signup','controllers/signup.php'],['signin','controllers/signin.php'],['profil','controllers/profil.php'],['locate','controllers/locate.php'],['servicesMaps','controllers/servicesMaps.php'],['favoris','controllers/favoris.php'],['modifierServices', 'controllers/modifierServices.php'],['servicesAffiche','controllers/servicesAffiche.php'],['contact','controllers/contact.php'],['ajoutServices','controllers/ajoutServices'],['gestionSeances','controllers/gestionSeancesC.php']];

$sous_domaine = $_SERVER['PHP_SELF'];    // Emplacement de ce fichier sur le serveur
$liste = explode("/", $sous_domaine);
$sous_domaine = "";
for ($k = 0; $k < sizeof($liste)-1; $k++){
    $sous_domaine .= $liste[$k]."/";
}
$url = "http://".$_SERVER['HTTP_HOST'];

define('URL_SITE', $url);
define('SOUS_DOMAINE', $sous_domaine);

$langues = array(
    "AFRIKAANS" => 'af',
    "ALBANIAN" => 'sq',
    "AMHARIC" => 'am',
    "ARABIC" => 'ar',
    "ARMENIAN" => 'hy',
    "AZERBAIJANI" => 'az',
    "BASQUE" => 'eu',
    "BELARUSIAN" => 'be',
    "BENGALI" => 'bn',
    "BIHARI" => 'bh',
    "BULGARIAN" => 'bg',
    "BURMESE" => 'my',
    "CATALAN" => 'ca',
    "CHEROKEE" => 'chr',
    "CHINESE" => 'zh',
    "CHINESE_SIMPLIFIED" => 'zh-CN',
    "CHINESE_TRADITIONAL" => 'zh-TW',
    "CROATIAN" => 'hr',
    "CZECH" => 'cs',
    "DANISH" => 'da',
    "DHIVEHI" => 'dv',
    "DUTCH" => 'nl',
    "ENGLISH" => 'en',
    "ESPERANTO" => 'eo',
    "ESTONIAN" => 'et',
    "FILIPINO" => 'tl',
    "FINNISH" => 'fi',
    "FRENCH" => 'fr',
    "GALICIAN" => 'gl',
    "GEORGIAN" => 'ka',
    "GERMAN" => 'de',
    "GREEK" => 'el',
    "GUARANI" => 'gn',
    "GUJARATI" => 'gu',
    "HEBREW" => 'iw',
    "HINDI" => 'hi',
    "HUNGARIAN" => 'hu',
    "ICELANDIC" => 'is',
    "INDONESIAN" => 'id',
    "INUKTITUT" => 'iu',
    "ITALIAN" => 'it',
    "JAPANESE" => 'ja',
    "KANNADA" => 'kn',
    "KAZAKH" => 'kk',
    "KHMER" => 'km',
    "KOREAN" => 'ko',
    "KURDISH" => 'ku',
    "KYRGYZ" => 'ky',
    "LAOTHIAN" => 'lo',
    "LATVIAN" => 'lv',
    "LITHUANIAN" => 'lt',
    "MACEDONIAN" => 'mk',
    "MALAY" => 'ms',
    "MALAYALAM" => 'ml',
    "MALTESE" => 'mt',
    "MARATHI" => 'mr',
    "MONGOLIAN" => 'mn',
    "NEPALI" => 'ne',
    "NORWEGIAN" => 'no',
    "ORIYA" => 'or',
    "PASHTO" => 'ps',
    "PERSIAN" => 'fa',
    "POLISH" => 'pl',
    "PORTUGUESE" => 'pt-PT',
    "PUNJABI" => 'pa',
    "ROMANIAN" => 'ro',
    "RUSSIAN" => 'ru',
    "SANSKRIT" => 'sa',
    "SERBIAN" => 'sr',
    "SINDHI" => 'sd',
    "SINHALESE" => 'si',
    "SLOVAK" => 'sk',
    "SLOVENIAN" => 'sl',
    "SPANISH" => 'es',
    "SWAHILI" => 'sw',
    "SWEDISH" => 'sv',
    "TAJIK" => 'tg',
    "TAMIL" => 'ta',
    "TAGALOG" => 'tl',
    "TELUGU" => 'te',
    "THAI" => 'th',
    "TIBETAN" => 'bo',
    "TURKISH" => 'tr',
    "UKRAINIAN" => 'uk',
    "URDU" => 'ur',
    "UZBEK" => 'uz',
    "UIGHUR" => 'ug',
    "VIETNAMESE" => 'vi'
);
define('LANGUAGES', array_flip($langues));


require_once("models/SQLCo.php");
require_once("models/utilisateur.php");
require_once("models/services.php");
require_once("models/modifierServices.php");
require_once("controllers/functions.php");

if (!empty($_GET['page'])){
	$page = $_GET['page'];
}
if (empty($page)){
    $path = "controllers/accueil.php";
}
elseif ($page == "Accueil"){
    $path = "controllers/accueil.php";
}
elseif ($page == "recherche"){
    $path = "controllers/recherche.php";
}
elseif ($page == "signup"){
	if(!empty($_SESSION["idUtilisateur"])){
		$path = "controllers/profil.php";
	}
	else
    	$path = "controllers/signup.php";
}
elseif ($page == "activation"){
	$path = "controllers/activation.php";
}
elseif ($page == "signin"){
	if(!empty($_SESSION["idUtilisateur"])){
		$path = "controllers/profil.php";
	}
	else
    	$path = "controllers/signin.php";
}
elseif($page == "profil"){
    loginRequired($page);
    $path = "controllers/profil.php";
}
elseif ($page == "locate"){
    $path = "controllers/locate.php";
}
elseif ($page == "servicesMaps"){
    $path = "controllers/servicesMaps.php";
}
elseif ($page == "ajoutServices"){
    loginRequired($page);

	$path = "controllers/activationContributeur.php";

}
elseif ($page == "favoris"){
    loginRequired($page);
    $path = "controllers/favoris.php";
}
elseif ($page == "modifierServices"){

    	$path = "controllers/modifierServices.php";
}
elseif ($page == "servicesAffiche"){
    $path = "controllers/servicesAffiche.php";
}
elseif ($page == "logout"){
    $_SESSION = array();
    header("Location: ".SOUS_DOMAINE);
    exit();
}
elseif ($page == "tests"){
    $path = "controllers/tests.php";
}
elseif ($page == "descriptionService"){
    $path = "controllers/descriptionServiceC.php";
}
elseif ($page == "ajoutAdmin"){
    loginRequired($page);
    $path = "controllers/ajoutAdmin.php";
}
elseif ($page == "activationAdmin"){
    $path = "controllers/activationAdmin.php";
}
elseif ($page == "gestionSeances"){
    $path = "controllers/gestionSeancesC.php";
}
elseif ($page == "contact"){
    $path = "controllers/contact.php";
}
elseif ($page == "activationService"){
    $path = "controllers/activationService.php";
}
elseif ($page == "planDuSite"){
    $path = "controllers/planDuSite.php";
}
elseif ($page == "enSavoirPlus"){
    $path = "templates/enSavoirPlus.html";
}
elseif ($page == "FAQ"){
    $path = "templates/FAQbeau.html";
}
elseif ($page == "error404"){
    $path = "templates/error404.html";
}
elseif($page == "test"){
    $path = "test.php";
}
else{
    include("templates/".$page.".html");
}

include("gabarit.php");





