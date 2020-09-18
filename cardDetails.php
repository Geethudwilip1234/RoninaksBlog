<?php
    require 'init.php';
    header("Content-Type: application/json; charset=UTF-8");
    $id = $_POST["authorid"];
    $sql = "SELECT 'id','title','metatitle','published_at' FROM 'Post' WHERE 'authorid'=$id";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($result);
    if($row){
        $cardDetails = array("id"=>$row["id"],"title"=>$row["title"],"metatitle"=>$row["metatitle"],"published_at"=>$row["published_at"]);
        $jsonData = json_encode($cardDetails);
        echo $jsonData;
	} else {
	    echo "0";
	}
?>



