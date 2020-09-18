<?php
    require 'init.php';
    header("Content-Type: application/json; charset=UTF-8");
    $sql = "SELECT 'empid','emp_name, FROM Employee_Details";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($result);
    if($row){
        $employeeData = array("empid"=>$row["empid"],"emp_name"=>$row["emp_name"]);
        $jsonData = json_encode($employeeData);
        echo $jsonData;
	} else {
	    echo "0";
	}
?>

<!-- <?php
//    require "init.php";
//    ini_set('display_errors', 1);
//    $success = "unsuccessful";
//    $sql_query ="select 'empid',`emp_name` from Employee_Details";
//    $result = mysqli_query($con, $sql_query);
//    $response = array();
//    $count = 0;
//    while($row = mysqli_fetch_array($result)){
//        $success = "successful";
//        $response[$count++] = array("empid"==>$row["empid"],"emp_name"=>$row["emp_name"]);
//    }
//    $result = array("success"=>$success, "result"=>$response);
//    echo json_encode(array("data"=>$result));
   

?> -->
