<?php
require "load.php";
$product_id=$_POST['product_id'];
$project_id=$_POST['project_id'];
$user_id=$_SESSION['user_id'];
$activities=get_activities();
if ($_POST['submit']) {
    foreach ($activities as $activity) {
        $extra_hours = $_POST['extra_hours'][$activity['id']];
        $extra_minutes = $_POST['extra_minutes'][$activity['id']];
        $normal_hours = $_POST['normal_hours'][$activity['id']];
        $normal_minutes = $_POST['normal_minutes'][$activity['id']];
        $time = time();
        $normal_time = $normal_hours . ":" . $normal_minutes;
        $extra_time = $extra_hours . ":" . $extra_minutes;
      $activity_id=  $activity['id'];
        save_report($user_id, $project_id, $product_id, $activity_id, $normal_time, $extra_time, $time);
    }
    echo "save successfully"    ;
}