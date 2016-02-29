<?php
require __dir__.'/../../config.php';
$pdo = new PDO('mysql:dbname='.$dbconfig['dbname'].';host=localhost;', $dbconfig['user_name'], $dbconfig['password'], [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION]);
