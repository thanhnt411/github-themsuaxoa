<?php
session_start();
include("config.php");
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}
?>
<h2>Add</h2>
<form action="useradd.php" method="post">
    <input type="text" name="name" placeholder="name"><br>
    <input type="text" name="email" placeholder="E-mail"><br>
    <input type="number" name="age" placeholder="Age"><br>
    <button type="submit">Add</button>
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["name"];
    $email = $_POST["email"];
    $age = $_POST["age"];

    try {
        include "config.php";
        $query = "INSERT INTO student (name, email, age) VALUES (:name, :email, :age);";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":name", $username);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":age", $age);

        $stmt->execute();

        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        die("Query failde: " . $e->getMessage());
    }
}
