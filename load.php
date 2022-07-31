<?php

require "security.php";
try {

    $db = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBUSERNAME, PASSWORD);
} catch (PDOException $e) {
    echo "db connected error";
}
session_start();
function redirect($path)
{
    header("Location: " . $path);
    exit();
}

function get_projects()
{
    global $db;
    $query = "select * from project";
    $stmt = $db->query($query);
    $stmt->execute();
    $projects = $stmt->fetchAll();
    return $projects;

}

function get_user($id)
{
    global $db;
    $query = "select * from user where id = ? ";
    $stmt = $db->prepare($query);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result;
}

function get_product($id)
{
    global $db;
    $query = "select * from product where id =:id";
    $stmt = $db->prepare($query);
    $stmt->bindParam("id", $id);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    return $product;
}

function get_project($id)
{
    global $db;
    $query = "select * from project where id=:id";
    $stmt = $db->prepare($query);
    $stmt->bindParam("id", $id);
    $stmt->execute();
    $project = $stmt->fetch(PDO::FETCH_ASSOC);
    return $project;
}

function check_login()
{
    if (!isset($_SESSION['user_id'])) {
        redirect("login.php");
    }
}

function get_products($project_id)
{
    global $db;
    $query = " select name , id from product where project_id=:project_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam("project_id", $project_id);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function get_activities()
{
    global $db;
    $query = "select * from activity ";
    $stmt = $db->query($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;

}

function save_report($user_id, $project_id, $product_id, $activity_id, $normal_time, $extra_time, $time)
{
    global $db;
    $query = "insert into reports(user_id,project_id,product_id,activity_id,normal_time,extra_time,time) values (?,?,?,?,?,?,?)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(1, $user_id);
    $stmt->bindParam(2, $project_id);
    $stmt->bindParam(3, $product_id);
    $stmt->bindParam(4, $activity_id);
    $stmt->bindParam(5, $normal_time);
    $stmt->bindParam(6, $extra_time);
    $stmt->bindParam(7, $time);
    $stmt->execute();

}

if (isset($_SESSION['user_id'])) {
    $user = get_user($_SESSION['user_id']);
    $_SESSION['user'] = $user;
    if ($user === false) {
        unset($_SESSION['user_id']);
        redirect("login.php");
    }

}
