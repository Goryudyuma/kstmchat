<?php
require __dir__.'/../../PASS.php';
$pdo = new PDO('mysql:dbname=chat;host=localhost;', $pass[0], $pass[1], [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION]);
