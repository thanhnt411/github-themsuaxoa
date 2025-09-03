<?php
session_start();
include("config.php");
?>

<h2>Login</h2>
<form action="" method="post">
    <input type="text" name="username" placeholder="username"><br>
    <input type="password" name="pwd" placeholder="Password"><br>
    <button type="submit">Login</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];

    try {
        include "config.php";
        $query = "SELECT * FROM users WHERE username = :username AND pwd = :pwd;";
        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":pwd", $pwd);

        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $_SESSION["user"] = $username;
            header("Location: index.php");
            exit();
        } else {
            echo "Sai tài khoản hoặc mật khẩu";
        }
    } catch (PDOException $e) {
        die("Query failde: " . $e->getMessage());
    }
}
