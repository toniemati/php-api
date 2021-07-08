<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
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

if (People::destroy()) {
  echo json_encode(['message' => 'Successfully deleted record']);
} else {
  echo json_encode(['message' => 'Delete operation failed']);
}