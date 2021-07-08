<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once '../../config/Database.php';
require_once '../../models/People.php';

if (!isset($_GET['id'])) {
  echo json_encode(['message' => 'Wrong ID']);
  exit();
}

$database = Database::connect();

People::connect($database);

$data = json_decode(file_get_contents('php://input'));

People::$id = htmlspecialchars($_GET['id']);

$people = People::show();

People::$name = $data->name ?? $people['name'];
People::$lastname = $data->lastname ?? $people['lastname'];
People::$position = $data->position ?? $people['position'];
People::$updated_at = date('Y-m-d H:i:s');

if (People::update()) {
  echo json_encode(['message' => 'Successfully updated record']);
} else {
  echo json_encode(['message' => 'Update operation failed']);
}