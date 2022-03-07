<?php
    include("../../includes/config.php");
    include("../../includes/classes/Query.php");
    $qry = new Query($cn);
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST['id']) && $_POST['type'] == 1) {
            $id = $_POST['id'];
            $res = $qry->set_approve($id);
            if($res) {
                echo "Approved";
            } else {
                echo "Failed: ".$res;
            }
        } else if($_POST['type'] == 0) {
            $id = $_POST['id'];
            $res = $qry->set_pending($id);
            if($res) {
                echo "Pending";
            } else {
                echo "Failed: ".$res;
            }
        }
    } else header("location: ../../");
?>