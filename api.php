<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *"); // Allow requests (optional)
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

// Read JSON data from request body
$input = json_decode(file_get_contents("php://input"), true);

$fish_type = $input["fish_type"] ?? null;
$caught_way = $input["caught_way"] ?? null;
$caught_place = $input["caught_place"] ?? null;
$caught_date = $input["caught_date"] ?? null;
$ship_name = $input["ship_name"] ?? null;
$ship_id = $input["ship_id"] ?? null;
$port_date = $input["port_date"] ?? null;
$supplier_name = $input["supplier_name"] ?? null;
$supplier_id = $input["supplier_id"] ?? null;
$port_name = $input["port_name"] ?? null;


// For now we just return the same data back to frontend
$response = [
    "status" => "success",
    "received" => [
        "fish_type" => $fish_type,
        "caught_way" => $caught_way,
        "caught_place" => $caught_place,
        "caught_date" => $caught_date,
        "ship_name" => $ship_name,
        "ship_id" => $ship_id,
        "port_date" => $port_date,
        "supplier_name" => $supplier_name,
        "supplier_id" => $supplier_id,
        "port_name" => $port_name
    ]
];

echo json_encode($response);
?>
