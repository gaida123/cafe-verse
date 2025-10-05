<?php
include "db.php";

// Get user coordinates
$lat = $_GET['lat'];
$lng = $_GET['lng'];

// Your Geoapify API key
$apiKey = "6d94875ca9f64910be274f842bc12e73";

// Search radius (in meters) — e.g. 20 km
$radius = 20000;

// Geoapify Places API URL (search for cafes)
$url = "https://api.geoapify.com/v2/places?categories=catering.cafe&filter=circle:$lng,$lat,$radius&limit=20&apiKey=$apiKey";

// Fetch data from Geoapify
$response = file_get_contents($url);
$data = json_decode($response, true);

$cafes = [];

if (!empty($data['features'])) {
    foreach ($data['features'] as $place) {
        // Extract data safely
        $name = $place['properties']['name'] ?? "Unnamed Cafe";
        $address = $place['properties']['address_line2'] ?? "Unknown Address";
        $osm_id = $place['properties']['place_id'] ?? "";
        $lat_cafe = $place['geometry']['coordinates'][1];
        $lng_cafe = $place['geometry']['coordinates'][0];

        // Escape values for SQL
        $osm_id = mysqli_real_escape_string($conn, $osm_id);
        $name = mysqli_real_escape_string($conn, $name);
        $address = mysqli_real_escape_string($conn, $address);

        // Try inserting (ignore duplicates)
        $insert = "INSERT IGNORE INTO cafes (osm_id, name, address, lat, lng, created_at)
                   VALUES ('$osm_id', '$name', '$address', '$lat_cafe', '$lng_cafe', NOW())";
        mysqli_query($conn, $insert);

        // Get the ID: either the newly inserted or existing one
        $id = mysqli_insert_id($conn); // returns 0 if insert was ignored
        if ($id == 0) {
            // Fetch existing ID
            $res = mysqli_query($conn, "SELECT id FROM cafes WHERE osm_id='$osm_id' LIMIT 1");
            $row = mysqli_fetch_assoc($res);
            $id = $row['id'];
        }

        // Add to output list
        $cafes[] = [
            'id' => $id,
            'name' => $name,
            'address' => $address,
            'lat' => $lat_cafe,
            'lng' => $lng_cafe
        ];
    }
}

// Return JSON for frontend
header('Content-Type: application/json');
echo json_encode($cafes);
