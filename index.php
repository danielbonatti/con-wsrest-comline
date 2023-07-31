<?php

$sUrl = $argv[1]; // Link
$sArq = $argv[2]; // Arquivo json em formato texto

// API endpoint URL
$url = $sUrl;

/* Read JSON data from the file
$jsonFile = __DIR__ . '/data.json';
$jsonData = file_get_contents($jsonFile);*/

// Read JSON data from the file
//$jsonData = json_decode($sArq,TRUE);
$jsonData = $sArq;

// Set the HTTP headers for the request
$headers = array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($jsonData)
);

// Initialize cURL session
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// Execute the cURL session
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
}

// Close cURL session
curl_close($ch);

// Process the API response
if ($response) {
    $responseData = json_decode($response, true);
    if ($responseData) {
        /*echo 'Request successful!' . PHP_EOL;
        echo 'Response:' . PHP_EOL;
        print_r($responseData);*/
        $json_data = json_encode($responseData, JSON_PARTIAL_OUTPUT_ON_ERROR);
        echo $json_data;
    } else {
        echo 'Invalid JSON response.' . PHP_EOL;
    }
} else {
    echo 'No response received from the API.' . PHP_EOL;
}
?>