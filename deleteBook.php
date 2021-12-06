<?php
include('includes/dbConnection.php');
$deleteQuery = "DELETE FROM phpProject.books WHERE id={$_GET['id']}";

if ($conn->query($deleteQuery) === TRUE) {
    header("Location: http://localhost/PHPBeginnerProject/");
    die();
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
