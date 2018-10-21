<?php 
    include db.php;

    if(isset($_POST['update'])){
        $name = $_POST['task'];
        
        $query = UPDATE `tasks` SET `name` = 'clean all rooms' WHERE `tasks`.`id` = 1;

        $val = $db->query($query);

        if($val){
            header('location: index.php');
        }
    }

?>