<?php
session_start();
include("config.php");
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
};
?>
<h2>Update</h2>
<form action="userupdate.php" method="post">
    <input type="text" name="name" placeholder="name"><br>
    <input type="text" name="email" placeholder="E-mail"><br>
    <input type="number" name="age" placeholder="age"><br>
    <button type="submit">Update</button>
</form>
<?php
$id = $_GET["id"];
$stmt = $pdo->prepare("SELECT * FROM student WHERE id = :id");
$stmt->bindParam(":id", $id);
$stmt->execute();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["name"];
    $email = $_POST["email"];
    $age = $_POST["age"];

    try {
        $query = "UPDATE student SET name = :name, email = :email , age = :age WHERE id = :id";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":name", $username);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":age", $age);

        $stmt->execute();

        // header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        die("Query failde: " . $e->getMessage());
    }
}
