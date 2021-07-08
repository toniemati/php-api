<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once '../../config/Database.php';
require_once '../../models/People.php';

$database = Database::connect();

People::connect($database);

$peoples = People::index();

echo json_encode(['data' => $peoples]);