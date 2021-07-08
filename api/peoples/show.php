<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once '../../config/Database.php';
require_once '../../models/People.php';

if (!isset($_GET['id'])) {
  echo json_encode(['message' => 'Wrong ID']);
  exit();
}

$database = Database::connect();

People::connect($database);

People::$id = $_GET['id'];

$people = People::show();

echo json_encode($people);