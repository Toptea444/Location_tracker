<?php
require 'config.php';

// API URL and Key
$apiUrl = 'http://ip-api.com/json/';
$ip = $_POST['ip'] ?? $_SERVER['REMOTE_ADDR']; // Use submitted IP or user's IP

$response = file_get_contents($apiUrl . $ip);
$data = json_decode($response, true);

if ($data['status'] === 'success') {
    // Save data to database
    $stmt = $pdo->prepare("INSERT INTO ip_history (ip_address, country, region, city, latitude, longitude, isp, timezone)
                           VALUES (:ip, :country, :region, :city, :latitude, :longitude, :isp, :timezone)");
    $stmt->execute([
        ':ip' => $data['query'],
        ':country' => $data['country'],
        ':region' => $data['regionName'],
        ':city' => $data['city'],
        ':latitude' => $data['lat'],
        ':longitude' => $data['lon'],
        ':isp' => $data['isp'],
        ':timezone' => $data['timezone']
    ]);
    
    echo json_encode($data);
} else {
    echo json_encode(['error' => 'Unable to fetch location.']);
}
?>
