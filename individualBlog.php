<?php

    require "init.php";
    $PID = $_POST["PID"];
    $sql = "SELECT p.id,p.authorid,ed.emp_name,p.title,p.published_at,p.content,c.title AS categories  FROM Post p, Employee_Details ed, Post_Category pc, Category c WHERE p.id = $PID AND c.id= pc.catid AND ed.empid = p.authorid";
    $status = false;
    $count = 0;
    $data = array();
    $res = mysqli_query($con, $sql);
    if($res){
        $status = true;

        while ($post = mysqli_fetch_assoc($res)) {   

            $data = array(
                "id"=>$post["id"],
                "AID" => $post["authorid"],
                "emp_name" => $post["emp_name"],
                "title" => $post["title"],
                "published_at" => $post["published_at"],
                "content" => $post["content"],
                "categories" =>$post["categories"]
            );
        }
    }

    echo $_POST['PID'];
    echo json_encode(array("status"=>$status,"data"=>$data));
 ?>
