<?php
$connect = mysqli_connect("localhost", "root", "", "voting");

if ($connect) {
    echo "Connected!";
} else {
    echo "Not connected!";
    die("Connection failed: " . mysqli_connect_error());
}
?>;
