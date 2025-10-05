<?php
include "db.php";

$lat = $_GET['lat'];
$lng = $_GET['lng'];

$apiKey = "6d94875ca9f64910be274f842bc12e73";
$url = "https://api.geoapify.com/v2/places?categories=catering.cafe&filter=circle:$lng,$lat,3000&bias=proximity:$lng,$lat&limit=20&apiKey=$apiKey";
$response = file_get_contents($url);
$data = json_decode($response, true);

// Save cafes to local DB (avoid duplicates)
foreach ($data['features'] as $feature) {
  $osm_id = $feature['properties']['place_id'];
  $name = $conn->real_escape_string($feature['properties']['name']);
  $address = $conn->real_escape_string($feature['properties']['address_line1']);
  $lat = $feature['geometry']['coordinates'][1];
  $lng = $feature['geometry']['coordinates'][0];

  $conn->query("INSERT IGNORE INTO cafes (osm_id, name, address, lat, lng) VALUES ('$osm_id', '$name', '$address', '$lat', '$lng')");
}

echo json_encode($data);
?>
