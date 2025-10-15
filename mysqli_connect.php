<?php
// public/mysqli_connect.php

// 1️⃣ Load configuration file from one folder above
$config = require __DIR__ . '/../config/config.php';

// 2️⃣ Connect to MySQL using MySQLi (procedural)
$conn = mysqli_connect(
    $config['db_host'],
    $config['db_user'],
    $config['db_pass'],
    $config['db_name'],
    $config['db_port']
);

// 3️⃣ Check connection
if (!$conn) {
    die('Database connection failed: ' . mysqli_connect_error());
}

echo "✅ Connection successful to database '{$config['db_name']}'<br>";

// 4️⃣ Set charset (always use utf8mb4)
mysqli_set_charset($conn, 'utf8mb4');

// 5️⃣ Example query (optional)
$query = "SHOW TABLES";
$result = mysqli_query($conn, $query);

if ($result) {
    echo "<b>Tables in database:</b><br>";
    while ($row = mysqli_fetch_array($result)) {
        echo $row[0] . "<br>";
    }
    mysqli_free_result($result);
} else {
    echo "No tables found or query failed: " . mysqli_error($conn);
}

// 6️⃣ Close connection
mysqli_close($conn);
