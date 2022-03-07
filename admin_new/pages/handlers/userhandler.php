<?php
include("../../includes/config.php");
include("../../includes/classes/User.php");
include("../../includes/classes/Constants.php");
include("../../includes/classes/Logger.php");
$obj = new User($cn);
$log = new Logger($_SESSION["usertype"]);
if($_SERVER['REQUEST_METHOD'] == "POST") {
    if(isset($_POST['name']) && isset($_POST['pwd']) && isset($_POST['type'])) {
        $username = $_POST['name'];
        $username = ucwords($username);
        $username = ucwords(strtolower($username));
        $pwd = $_POST['pwd'];
        $tp = $_POST['type'];
        $res = $obj->insert_user($username, $pwd, $tp);
        $arr = json_decode($res);
        $tmp = (object)$arr;
        $log->log_action('insert', $username, 'user');
        if($tmp->status == "success") {
            echo json_encode(array("status"=>"success"));
        } else if($tmp->status == "fail"){
            echo json_encode(array("status"=>"fail", "error" => $tmp->code));
        } else {
            echo json_encode(array("status"=>"user_exist"));
        }
    } else if(isset($_POST['selected_users'])) {
        $sz = sizeof($_POST['selected_users']);
        $flag = true;
        $errcode = "";
        $arr = array();
        for($i = 0; $i < $sz; $i++) {
            if($_POST['selected_users'][$i] != "on") {
                // array_push($arr, $_POST['selected_users'][$i]);
                $res = $obj->delete_user($_POST['selected_users'][$i]);
                $trr = json_decode($res);
                $tmp = (object)$trr;
                if($tmp->status == "fail") {
                    $flag = false;
                    $errcode = $tmp->code;
                    break;
                }
            }
        }
        if($flag) {
            echo json_encode(array("status"=>"success"));
        } else {
            echo json_encode(array("status"=>"fail", "error" => $errcode));   
        }
    }
} else header("location: ../allusers.php");
?>