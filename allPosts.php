<?php

    require "init.php";

    $postNum = $_POST["postNum"];
    $pageNum = $_POST["pageNum"];
    $category = $_POST["filter"];
    $offset = ($pageNum - 1)*$postNum;
    

    $categories = ["ios","android","ui"];

    if(in_array($category,$categories)){
        $sql = "SELECT p.id, p.authorid, ed.emp_name, p.title, p.metatitle, p.published_at, p.summary from post p, category c, post_category pc,employee_details ed WHERE p.id = pc.postid AND c.id = pc.catid and ed.empid = p.authorid and c.title LIKE '%$category%' limit $postNum offset $offset";
    } else {
        $sql = "select p.id, p.authorid, ed.emp_name, p.title, p.metatitle, p.published_at, p.summary FROM post p inner JOIN employee_details ed on ed.empid = p.authorid limit $postNum offset $offset";
    }
    $status = false;
    $count = 0;
    $data = array();

    
    $res = mysqli_query($con, $sql);

    $sql2  = "select COUNT(*) as total FROM post p inner JOIN employee_details ed on ed.empid = p.authorid";
    $res2 = mysqli_query($con,$sql2);
    $total = mysqli_fetch_assoc($res2);

    if($res){
        $status = true;

        while ($post = mysqli_fetch_assoc($res)) {   

            $data[$count++] = array(
                "id"=>$post["id"],
                "AID" => $post["authorid"],
                "emp_name" => $post["emp_name"],
                "title" => $post["title"],
                "metatitle" => $post["metatitle"],
                "published_at" => $post["published_at"],
                "summary" => $post["summary"]
            );
        }
    }

    echo json_encode(array("status"=>$status,"data"=>$data,"total"=>$total));
