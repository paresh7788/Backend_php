<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

$server="localhost";
$user="root";
$password="";
$db="demo";


$con = mysqli_connect($server,$user,$password,$db);


if($con){
	?>
	<script>
		console.log("connection sucessful , ready to register");
	</script>
	<?php
}
else{
	?>
	<script>
		alert(" no connection ");
	</script>
	<?php

}

$method = $_SERVER['REQUEST_METHOD'];
// echo "test----".$method; die;

switch($method){

case "GET":
    $alluser = mysqli_query($con,"SELECT * FROM test");
    if(mysqli_num_rows($alluser) > 0){
        while($row = mysqli_fetch_array($alluser)){
            $json_array["userdata"][]=array("id"=>$row['id'],"username"=>$row['username'],"email"=>$row['email']);
        }
        echo json_encode($json_array['userdata']);
        return;
    }else{
        echo json_encode(["result"=>"please check the data"]);
        return;

    }


    break;

    case "POST":
        $userpostdata = json_decode(file_get_contents("php://input"));
        echo "success data";
        print_r($userpostdata);die;

        $alluser = mysqli_query($con,"INSERT INTO test ( 'username','email','choice,'phoneno')
        VALUES (?)");
        if($alluser==true){

            echo json_encode(["result"=>"Your response has been recorded ,our team will contact you soon!"]);
            return;
        }
            
        
            



    break;

}


?>