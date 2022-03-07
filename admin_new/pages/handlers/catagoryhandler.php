<?php
include("../../includes/config.php");
include("../../includes/classes/Catagory.php");
include("../../includes/classes/Constants.php");
$obj = new Catagory($cn);
if($_SERVER['REQUEST_METHOD'] == "POST") {
    if(isset($_POST['name'])) {
        $catname = $_POST['name'];
        $catname = ucwords($catname);
        $catname = ucwords(strtolower($catname));
        $res = $obj->insert_cat($catname);
        $arr = json_decode($res);
        $tmp = (object)$arr;
        if($tmp->status == "success") {
            echo json_encode(array("status"=>"success"));
        } else if($tmp->status == "fail") {
            echo json_encode(array("status"=>"fail", "error" => $tmp->code));
        } else {
            echo json_encode(array("status"=>"cat_exist"));
        }
    }
} else header("location: ../catagory.php");
?>