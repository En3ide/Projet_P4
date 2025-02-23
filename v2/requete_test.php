<?php
header('Content-Type: application/json');

//récupération des requêtes GET et POST
$request_data = [
    'GET' => $_GET,
    'POST' => $_POST,
    'RAW_BODY' => file_get_contents('php://input'), //pour JSON brut ou autres formats
    'HEADERS' => getallheaders(), //récupérer les headers de la requête
    'SERVER' => [
        'REQUEST_METHOD' => $_SERVER['REQUEST_METHOD'],
        'REQUEST_URI' => $_SERVER['REQUEST_URI'],
        'HTTP_REFERER' => $_SERVER['HTTP_REFERER'] ?? 'N/A',
        'HTTP_USER_AGENT' => $_SERVER['HTTP_USER_AGENT'],
        'REMOTE_ADDR' => $_SERVER['REMOTE_ADDR'],
    ]
];

// Afficher en JSON formaté
echo json_encode($request_data, JSON_PRETTY_PRINT);
?>
