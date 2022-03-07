<?php
include("../../includes/config.php");
include("../../includes/classes/Catagory.php");
include("../../includes/classes/Package.php");
include("../../includes/classes/Constants.php");
$cat = new Catagory($cn);
$obj = new Package($cn);
if($_SERVER['REQUEST_METHOD'] == "POST") {
    if(isset($_POST['cat_val'])) {
        $response = $cat->get_subcat_with_parentid($_POST['cat_val']);
        $arr = array();
        for($i=0; $i < sizeof($response); $i++) {
            $data = array(
                "Subcatid" => $response[$i]['Subcatid'],
                "Subcatname" => $response[$i]['Subcatname']
            );
            array_push($arr, $data);
        }
        echo json_encode($arr);
    } else if(isset($_POST['name'])) {
        $packagename = $_POST['name'];
        $par_cat = $_POST['cat'];
        $sub_cat = $_POST['subcat'];
        $price = $_POST['price'];
        $desc = $_POST['desc'];
        $packagename = ucwords($packagename);
        $packagename = ucwords(strtolower($packagename));
        
        $image = $_FILES['file']['name'];
        $image2 = $_FILES['file2']['name'];
        $image3 = $_FILES['file3']['name'];

        if($_FILES["file"]["size"] > 500000 || $_FILES["file2"]["size"] > 500000 || $_FILES["file3"]["size"] > 500000) {
            echo json_encode(array("status" => "size_exceed"));
            exit();
	    } 
        if($image == $image2 || $image == $image3 || $image2 == $image3) {
            echo json_encode(array("status" => "repeated_image"));
            exit();
        }
        if (!file_exists('../../packimages')) {
            mkdir('../../packimages', 0777, true);
        }

        $location_to_upload = "../../packimages/".$image;
        $imageFileType = pathinfo($location_to_upload, PATHINFO_EXTENSION);
        $imageFileType = strtolower($imageFileType);

        $location_to_upload2 = "../../packimages/".$image2;
        $imageFileType2 = pathinfo($location_to_upload2, PATHINFO_EXTENSION);
        $imageFileType2 = strtolower($imageFileType2);

        $location_to_upload3 = "../../packimages/".$image3;
        $imageFileType3 = pathinfo($location_to_upload3, PATHINFO_EXTENSION);
        $imageFileType3 = strtolower($imageFileType3);

        /* Valid extensions */
        $valid_extensions = array("jpg","jpeg","png");
        $response = 0; $response2 = 0; $response3 = 0;
        if(in_array(strtolower($imageFileType), $valid_extensions) && in_array(strtolower($imageFileType2), $valid_extensions) && in_array(strtolower($imageFileType3), $valid_extensions)) {
            if(move_uploaded_file($_FILES['file']['tmp_name'], $location_to_upload)) {
                $response = 1;
            }
            if(move_uploaded_file($_FILES['file2']['tmp_name'], $location_to_upload2)) {
                $response2 = 1;
            }
            if(move_uploaded_file($_FILES['file3']['tmp_name'], $location_to_upload3)) {
                $response3 = 1;
            }
        }
        if($response) {
            $res = $obj->insert_package($packagename, $par_cat, $sub_cat, $price, $image, $image2, $image3, $desc);
            $arr = json_decode($res);
            $tmp = (object)$arr;
            if($tmp->status == "success") {
                echo json_encode(array("status" => "success"));
            } else if($tmp->status == "fail") {
                echo json_encode(array("status" => "fail", "error" => $tmp->code));
            } else {
                echo json_encode(array("status" => "already_exist"));
            }
        } else {
            echo json_encode(array("status" => "image_not_uploaded"));
        }
    } else if(isset($_POST['selected_users'])) {
        $sz = sizeof($_POST['selected_users']);
        $flag = true;
        $errcode = "";
        $arr = array();
        for ($i = 0; $i < $sz; $i++) {
            if ($_POST['selected_users'][$i] != "on") {
                // array_push($arr, $_POST['selected_users'][$i]);
                $res = $obj->delete_package($_POST['selected_users'][$i]);
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
            echo json_encode(array("status" => "success"));
        } else {
            echo json_encode(array("status" => "fail", "error" => $errcode));
        }
    }
} else header("location: ../package.php");
?>