<?php
include("../../includes/config.php");
include("../../includes/classes/Advertisement.php");
include("../../includes/classes/Constants.php");
include("../../includes/classes/Logger.php");
$log = new Logger($_SESSION["usertype"]);
$obj = new Advertisement($cn);
if($_SERVER['REQUEST_METHOD'] == "POST") {
    if(isset($_POST['name'])) {
        $subcatname = $_POST['name'];
        $company = $_POST['company'];
        $desc = $_POST['desc'];
        $subcatname = ucwords($subcatname);
        $subcatname = ucwords(strtolower($subcatname));
        
        $image = $_FILES['file']['name'];
        
        if($_FILES["file"]["size"] > 500000){
            echo json_encode(array("status" => "size_exceed"));
            exit();
	    }
        if (!file_exists('../../addverimages')) {
            mkdir('../../addverimages', 0777, true);
        }
        $location_to_upload = "../../addverimages/".$image;
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
        $res = $obj->insert_adv($subcatname, $company, $image, $desc);
        
        $arr = json_decode($res);
        $tmp = (object)$arr;
        if($tmp->status == "success") {
            $log->log_action('insert', $_SESSION["usertype"], 'advertisement');
            echo json_encode(array("status"=>"success"));
        } else if($tmp->status == "fail") {
            echo json_encode(array("status"=>"fail", "error" => $tmp->code));
        } else {
            echo json_encode(array("status"=>"already_exist"));
        }
    } else if(isset($_POST['selected_users'])) {
        $sz = sizeof($_POST['selected_users']);
        $flag = true;
        $errcode = "";
        $arr = array();
        for ($i = 0; $i < $sz; $i++) {
            if ($_POST['selected_users'][$i] != "on") {
                // array_push($arr, $_POST['selected_users'][$i]);
                $res = $obj->delete_ad($_POST['selected_users'][$i]);
                $trr = json_decode($res);
                $tmp = (object)$trr;
                if ($tmp->status == "fail") {
                    $flag = false;
                    $errcode = $tmp->code;
                    break;
                }
            }
        }
        if($flag) {
            $log->log_action('delete_multiple', $_SESSION["usertype"], $sz.' advertisement(s).');
            echo json_encode(array("status" => "success"));
        } else {
            echo json_encode(array("status" => "fail", "error" => $errcode));
        }
    }
} else header("location: ../subcatagory.php");
?>