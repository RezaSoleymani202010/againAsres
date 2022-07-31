<?php
require "load.php";
check_login();
if (!isset($_POST['product_id'])){
    redirect("panel.php");
}
$product_id=$_POST['product_id'];
$product_name=get_product($product_id)['name'];
$activities=get_activities();
$project_id=get_product($product_id)['project_id'];
$project_name=get_project($project_id)['name'];
$p=get_product($product_id)['name'];
echo $project_name;
echo "<br>";
echo  $product_name;
echo "<br>";

foreach ($activities as $activity) {

echo $activity['name']."<br>";
}
?>
<br><br>
<br>
<br>
<br>
<br>

<span>extra_____________________normal</span><br>
    <form action="report.php" method="post">
<?php foreach ($activities as $activity){ ?>
<select name="extra_hours[<?=$activity['id']?>]" id="">
    <?php for ($i=0;$i<9;$i++) {?>
    <option value="<?=$i?>"><?=$i."h"?></option>
    <?php }?>
</select>
<select name="extra_minutes[<?=$activity['id']?>]" id="">
    <?php for ($i=0;$i<60;$i+=5) {?>
        <option value="<?=$i?>"><?=$i."m"?></option>
    <?php }?>
</select>
<label><?=$activity['name']?></label>

<select name="normal_hours[<?=$activity['id']?>]" id="">
    <?php for ($i=0;$i<9;$i++) {?>
        <option value="<?=$i?>"><?=$i."h"?></option>
    <?php }?>
</select>
<select name="normal_minutes[<?=$activity['id']?>]" id="">
    <?php for ($i=0;$i<60;$i+=5) {?>
        <option value="<?=$i?>"><?=$i."m"?></option>
    <?php }?>
</select><br>

<?php } ?>
        <input name="product_id" type="hidden" value="<?=$product_id?>">
        <input name="project_id" type="hidden" value="<?=$project_id?>">

        <br><input type="submit" name="submit"/>
    </form>