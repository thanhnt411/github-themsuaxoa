<?php
session_start();
include("config.php");
if (!isset($_SESSION["user"])) {
  header("Location: login.php");
  exit();
}
?>

<h2>Danh sách sinh viên</h2>
<p>Chào mừng <?php echo $_SESSION["user"]; ?> | <a href="logout.php">Đăng xuất</a></p>
<a href="useradd.php">Thêm sinh viên</a>
<table border="1" cellpadding="5">
  <tr>
    <td>ID</td>
    <td>Username</td>
    <td>Email</td>
    <td>Age</td>
    <td>Action</td>
  </tr>
  <?php
  $result = $pdo->query("SELECT * FROM student");
  foreach ($result as $row) {
    echo "<tr>
    <td>" . $row['id'] . "</td>
    <td>" . $row['name'] . "</td>
    <td>" . $row['email'] . "</td>
    <td>" . $row['age'] . "</td>
    <td>
      <a href='userupdate.php?id=" . $row['id'] . "'>UPDATE  |</a>  
      <a href='userdelete.php?id=" . $row['id'] . "' onclick='return confirm(\"DLETE?\")'>DELETE</a>  
    </td>
  </tr>";
  }
  ?>
</table>