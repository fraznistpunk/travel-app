<?php
include 'admin_new/includes/config.php';
$data = "";
if(isset($_POST['qry'])) {
    $qry = $_POST["qry"];
    $query = mysqli_query($cn, "SELECT DISTINCT Cat_id, Cat_name FROM category WHERE Cat_name like '%".$qry."%'");
    if(mysqli_num_rows($query) >= 1) {
        while($res = mysqli_fetch_object($query)) {
            $data .= '<a href="subcat.php?catid='.$res->Cat_id.'">'.$res->Cat_name.'</a>';
        }
    }
    // echo $data;

    $query = mysqli_query($cn, "SELECT DISTINCT Title FROM `advertisement` WHERE Title like '%".$qry."%'");
    if(mysqli_num_rows($query) >= 1) {
        while($res = mysqli_fetch_object($query)) {
            $data .= '<a href="index.php#section-4">'.$res->Title.'</a>';
        }
    }
    // echo $data;

    $query = mysqli_query($cn, "SELECT DISTINCT Packid, Packname FROM `package` WHERE Packname like '%".$qry."%'");
    if(mysqli_num_rows($query) >= 1) {
        while($res = mysqli_fetch_object($query)) {
            $data .= '<a href="detail.php?pid='.$res->Packid.'">'.$res->Packname.'</a>';
        }
    }
    // echo $data;

    $query = mysqli_query($cn, "SELECT DISTINCT Subcatid, Subcatname FROM `subcategory` WHERE Subcatname like '%".$qry."%'");
    if(mysqli_num_rows($query) >= 1) {
        while($res = mysqli_fetch_object($query)) {
            $data .= '<a href="package.php?subcatid='.$res->Subcatid.'">'.$res->Subcatname.'</a>';
        }
    }
    if($data == "") {
        echo "<a href='javascript:void(0);'>No results found...</a>";
    } else {
        echo "<p>Results based on your search</p>".$data;
    }
}
?>