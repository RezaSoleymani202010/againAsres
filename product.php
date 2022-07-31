<?php
require "load.php";
check_login();
$project_id=$_POST['project_id'];
$products=get_products($project_id);
if (count($products)<1){
    redirect("panel.php");
}
?>

انتخاب محصول
<form action="open_activity.php" method="post">

    <select name="product_id" id="">
        <?php foreach ($products as $product){ ?>
        <option value="<?=$product['id']?>"><?=$product['name']?></option>
    <?php } ?>
    </select>
    <input type="submit" />
</form>
