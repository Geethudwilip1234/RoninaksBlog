<?php

    require "init.php";

    // $postNum = $_POST["postNum"];
    $limit = 9;
    $offset = 0;
    $sql = "";
    $totalPages = 0;
    $pageNum = $_POST["pageNum"];
    $category = $_POST["filter"];
    $status = false;
    
    
    

    $categories = ["ios","android","ui","Marketing","others"];

    if(in_array($category,$categories)){
        // $offset = ($pageNum - 1)*$limit;
        $sql = "SELECT p.id, p.authorid, ed.emp_name, p.title, p.metatitle, p.published_at, p.summary from post p, category c, post_category pc,employee_details ed WHERE p.id = pc.postid AND c.id = pc.catid and ed.empid = p.authorid and c.title = '%$category%' limit $limit offset $offset";
        $sql3  = "SELECT COUNT(*) FROM `Post_Category` pc INNER JOIN Category c ON pc.catid = c.id WHERE c.title = $category";  
        $res3 = mysqli_query($con,$sql3)or die( mysqli_error($con));
        $total = mysqli_fetch_array($res3);
        $totalPages = (ceil($total[0]/$limit));
        // echo json_encode(array("status"=>$status,"data"=>$data,"total"=>$totalPages,"offset"=>$offset,"category"=>$res3));

        


    } else {
        $offset = ($pageNum - 1)*$limit;
        $sql = "select p.id, p.authorid, ed.emp_name, p.title, p.metatitle, p.published_at, p.summary FROM post p inner JOIN employee_details ed on ed.empid = p.authorid limit $limit offset $offset";
        $sql2  = "select COUNT(*) FROM post";
        $res2 = mysqli_query($con,$sql2);
        $total = mysqli_fetch_array($res2);
        $totalPages = (ceil($total[0]/$limit));
    }
   
    $count = 0;
    $data = array();

    
    $res = mysqli_query($con, $sql);

    

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
                "summary" => $post["summary"],
                "category"=>$post["title"]

            
            );
        }
    }

    echo json_encode(array("status"=>$status,"data"=>$data,"total"=>$totalPages,"offset"=>$offset));
