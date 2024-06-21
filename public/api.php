<?php

header('Content-Type: application/json');

$data = [
    'message' => 'hello'
];

echo json_encode($data);

?>