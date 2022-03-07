<?php
session_start();
session_destroy();
if(isset($_SESSION)) echo json_encode(
    array(
        "status" => "success")
    );
else echo json_encode(
    array(
        "status" => "failed")
    );
die();
?>