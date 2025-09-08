<?php
// file: profile.php
require "security.php";
$decoded = validateJWT();

// query user data
$profile = array(
    'id' => $decoded->user,
    'name' => 'Louis Armstrong',
    'email' => 'louis@gmail.com',
    'phone' => '998888888',
    'admin' => true
);
echo json_encode($profile);