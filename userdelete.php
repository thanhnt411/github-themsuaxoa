<?php
session_start();
include("config.php");
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

$id = $_GET["id"];
try {
    $query = "DELETE FROM student WHERE id = :id LIMIT 1";

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":id", $id);

    $stmt->execute();

    header("Location: index.php");
    exit();
} catch (PDOException $e) {
    die("Query failde: " . $e->getMessage());
}
