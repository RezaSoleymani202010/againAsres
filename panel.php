<?php
require "load.php";
check_login();

$projects=get_projects();
?>
<form action="product.php" method="post">
انتخاب پروژه
<select name="project_id" >

    <?php
    foreach ($projects as $project){
    ?>
    <option value="<?=$project['id']?>"><?=$project['name']?></option>
    <?php } ?>
</select>
    <input type="submit" name="submit">
</form>