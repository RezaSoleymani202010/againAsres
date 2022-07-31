<?php
require "load.php";
if (isset($_POST['user_name'],$_POST['password'])) {
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    var_dump($password);
    //global $db;
    $query = "select id from user where password = ? and(email= ? or user_name= ?)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(1, $password);
    $stmt->bindParam(2, $user_name);
    $stmt->bindParam(3, $user_name);
    $stmt->execute();
    $result = $stmt->fetch();
    if ($result == false) {
        exit("ERRRRRRO");
    } else {
        $_SESSION['user_id'] = $result['id'];
        redirect("panel.php");
    }
}
?>

<form method="post" action="">
    userName or email
    <input name="user_name" type="text"><br>
   Password
    <input name="password" type="text"><br>
    <input type="submit" name="submit">
</form>
