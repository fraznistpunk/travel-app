<?php
include("../../includes/config.php");
include("../../includes/classes/Catagory.php");
include("../../includes/classes/Constants.php");
$obj = new Catagory($cn);
if($_SERVER['REQUEST_METHOD'] == "POST") {
    if(isset($_POST['name'])) {
        $subcatname = $_POST['name'];
        $par_cat = $_POST['par_cat'];
        $desc = $_POST['desc'];
        $subcatname = ucwords($subcatname);
        $subcatname = ucwords(strtolower($subcatname));
        
        $image = $_FILES['file']['name'];
        
        if($_FILES["file"]["size"] > 500000){
            echo json_encode(array("status" => "size_exceed"));
            exit();
	    }
        if (!file_exists('../../subcatimages')) {
            mkdir('../../subcatimages', 0777, true);
        }
        $location_to_upload = "../../subcatimages/".$image;
        $imageFileType = pathinfo($location_to_upload, PATHINFO_EXTENSION);
        $imageFileType = strtolower($imageFileType);
        /* Valid extensions */
        $valid_extensions = array("jpg","jpeg","png");
        $response = 0;
        if(in_array(strtolower($imageFileType), $valid_extensions)) {
            if(move_uploaded_file($_FILES['file']['tmp_name'], $location_to_upload)){
                $response = 1;
            }
        }
        $res = $obj->insert_subcat($subcatname, $par_cat, $image, $desc);
        $arr = json_decode($res);
        $tmp = (object)$arr;
        if($tmp->status == "success") {
            echo json_encode(array(
                "status"=>"success",
            ));
        } else if($tmp->status == "fail") {
            echo json_encode(array(
                "status"=>"fail", 
                "error" => $tmp->code)
            );
        } else {
            echo json_encode(array("status"=>"already_exist"));
        }
    }
} else header("location: ../subcatagory.php");
?>