<?php
include_once '../../config/config.php';
include_once $serverPath . 'utils/connect.php';
require_once $serverPath . 'utils/generator/character.php';
createCharacter ();
$table = "character";
header ( "Location: " . $baseURL . "assets/characters/show.php?id=" . insertAndReturnId ( $table ) );
?>