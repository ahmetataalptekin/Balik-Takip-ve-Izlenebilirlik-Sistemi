<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *"); // Allow requests (optional)
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

// Read JSON data from request body
$input = json_decode(file_get_contents("php://input"), true);

$date = $input["date"] ?? null;
$region = $input["region"] ?? null;
$type = $input["type"] ?? null;
$port = $input["port"] ?? null;

// For now we just return the same data back to frontend
$response = [
    "status" => "success",
    "received" => [
        "date" => $date,
        "region" => $region,
        "type" => $type,
        "port" => $port
    ]
];

echo json_encode($response);
?>
