<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once '../../config/Database.php';
require_once '../../models/People.php';

$database = Database::connect();

People::connect($database);

$data = json_decode(file_get_contents('php://input'));


People::$name = $data->name;
People::$lastname = $data->lastname;
People::$position = $data->position;

if (People::store()) {
  echo json_encode(['message' => 'Successfully stored record']);
} else {
  echo json_encode(['message' => 'Store operation failed']);
}