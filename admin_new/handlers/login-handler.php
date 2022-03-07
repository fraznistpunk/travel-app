<?php
include("../includes/config.php");
include("../includes/classes/Account.php");
include("../includes/classes/Constants.php");
$account = new Account($cn);
if(isset($_POST['sbmt'])) {
    //Login button was pressed
    $username = $_POST['t1'];
    $password = $_POST['t2'];

    $result = $account->login($username, $password);
    if($result != "") {
        $_SESSION['userLoggedIn'] = $username;
        $_SESSION["usertype"]= $result[2];
        $_SESSION['loginstatus'] = "yes";
        header("Location: ../");
    } else {
        print_r($result);
    }
}
?>