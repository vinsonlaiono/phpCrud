<?php 
//delete method
    //store data in id variable
    include 'db.php';

    $id = $_GET['id'];

    $deletQuery = "DELETE FROM tasks WHERE tasks.id = '$id'";

    $query = $db->query($deletQuery);

    if($query){
        header('location: index.php');
    }

?>