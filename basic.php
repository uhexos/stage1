<?php
$server = "localhost";
$user = "uhexos";
$password = "strongpassword";
$database = "fruitdb";

$connection = new mysqli($server, $user, $password);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
} 

$sql = "CREATE DATABASE fruitDB";
if ($connection->query($sql) === TRUE) {
    echo "Database created successfully"."<br>";
} else {
    echo "Error creating database: " . $connection->error."<br>";
}

// Create new connection
$connection = mysqli_connect($server, $user, $password,$database);

// sql to create table
$complexquery = "CREATE TABLE MyFruits (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
FruitType VARCHAR(30) NOT NULL,
FruitTaste VARCHAR(30) NOT NULL,
FruitQuantity INT NOT NULL,
DatePurchased TIMESTAMP
)";

if ($connection->query($complexquery) === TRUE) {
    echo "Table Fruits created successfully<br> ";
} else {
    echo "Error creating table:  " . $connection->error."<br>";
}

$entry = "INSERT INTO myfruits (fruittype,fruittaste,fruitquantity) 
VALUES ('orange','sweet','50'),('lemon','sour','10'),('banana','sweet','15')";

if ($connection->multi_query($entry) === TRUE) {
    echo "New records created successfully<br>";
} else {
    echo "Error: " . $connection->error."<br>";
}

$command = "SELECT id, fruittype,fruittaste,fruitquantity FROM MYFRUITS";
$output = $connection->query($command);

if ($command === TRUE) {echo "columns selected<br>";}
if ($output->num_rows > 0) {
    // output data of each row
    while($row = $output->fetch_assoc()) {
        echo "id: " . $row["id"]. " Name: " . $row["fruittype"]. " Taste: " . $row["fruittaste"]. " Quantity: ".$row["fruitquantity"]. "<br>";
    }
} else {
    echo "0 results";
}

?>