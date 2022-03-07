<?php
  include("../includes/config.php");
  include("../includes/classes/Catagory.php");
  include("../includes/classes/Constants.php");
  if($_SESSION['loginstatus'] == "") {
    header("location:../login.php");
  }
  $cat = new Catagory($cn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>MyTour | Admin Catagories</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../vendors/feather/feather.css">
  <link rel="stylesheet" href="../vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../vendors/typicons/typicons.css">
  <link rel="stylesheet" href="../vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="../vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="../vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="../js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../images/favicon.png" />
  <style>
    textarea {
    height: auto !important;
    resize: none !important;
  }
  </style>
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.php -->
    <?php include "../partials/_navbar.php" ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.php -->
      <?php include "../partials/_settings-panel.php"; ?>
      <div id="right-sidebar" class="settings-panel">
        <i class="settings-close ti-close"></i>
        <ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="todo-tab" data-bs-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="chats-tab" data-bs-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
          </li>
        </ul>
      </div>
      <!-- partial -->
      <!-- partial:partials/_sidebar.php -->
      <?php include "../partials/_sidebar.php"; ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                    </li>
                  </ul>
                </div>
                <form method="post" enctype="multipart/form-data">
                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                    <div class="row">
                      <div class="col-lg-12 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                    <h4 class="card-title card-title-dash">Update Subcatagory</h4>
                                    <p class="card-subtitle card-subtitle-dash">Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
                                    <?php echo $cat->getError(Constants::$UPDATE_FAIL); ?>
                                  </div>
                                </div>
                                 <div class="col-md-6 grid-margin stretch-card">
                                  <div class="card">
                                    <div class="card-body">
                                      <h4 class="card-title">Select Catagory Name</h4>
                                      <div class="form-group">
                                        <label>Click below to select</label>
                                        <select name = "t1" class="form-control js-example-basic-single w-100">
                                          <option value="">Please select an option</option>
                                          <?php
                                            $response = $cat->get_all_sub_cat();
                                            for($i = 0; $i < sizeof($response); $i++) {
                                              if(isset($_POST["show"]) && $response[$i][0] == $_POST["t1"]) {
                                                  echo '<option value="'.$response[$i][0].'" selected>'.$response[$i][1].'</option>';
                                              } else {
                                                  echo '<option value="'.$response[$i][0].'">'.$response[$i][1].'</option>';
                                              }
                                            }
                                          ?>
                                        </select>
                                        <button style="color:#FFF;" type="submit" name = "show" class="btn btn-info btn-icon-text mt-3">
                                          <i class="ti-file btn-icon-prepend"></i>
                                          Show
                                        </button>
                                      </div>
                                      <?php
                                          if(isset($_POST["show"])) {
                                            $res = $cat->get_subcat_by_id($_POST["t1"]);
                                            $cat_name = $res[1];
                                            $par_cat = $res[2];
                                            $icon = $res[3];
                                            $desc = $res[4];
                                          }
                                          if(isset($_POST["submt"])) {
                                            $target_dir = "../subcatimages/";
	                                          $target_file = $target_dir.basename($_FILES["newIcon"]["name"]);
                                            if(move_uploaded_file($_FILES["newIcon"]["tmp_name"], $target_file)) {
                                              $res = $cat->set_subcat_by_id($_POST["t1"], $_POST["new_val"], $_POST["t2"], $_FILES["newIcon"]["name"], $_POST['newDesc']);
                                              if(!$res) {
                                                echo "<script>window.alert('There was some error in handling your request.')</script>";
                                              } else {
                                                header("location: subcatagory.php");
                                              }
                                            } else {
                                              echo "<script>window.alert('There was some in uploading file.')</script>";
                                            }
                                          }
                                        ?>
                                        <div class="mywrapper">
                                      <div class="form-group">
                                        <label>Subcatagory</label>
                                        <input type="text" name="new_val" class="form-control" value = "<?php if(isset($_POST['show'])) echo $cat_name; ?>" placeholder="ex: Los Angelas">
                                      </div>
                                      <div class="form-group">
                                        <label>Parent Catagory</label>
                                        <select name = "t2" class="form-control js-example-basic-single w-100">
                                            <option value="">Please select an option</option>
                                          <?php
                                            $response = $cat->get_all_cat();
                                            for($i = 0; $i < sizeof($response); $i++) {
                                              if(isset($_POST["show"]) && $response[$i][0] == $par_cat) {
                                                  echo '<option value="'.$response[$i][0].'" selected>'.$response[$i][1].'</option>';
                                              } else {
                                                  echo '<option value="'.$response[$i][0].'">'.$response[$i][1].'</option>';
                                              }
                                            }
                                          ?>
                                        </select>
                                      </div>
                                      <div class="form-group">
                                        <input class="form-control" type="file" name="newIcon"/>
                                      </div>
                                      <div class="form-group">
                                        <label>Description</label>
                                          <textarea id='newDesc' name="newDesc" class="form-control" rows="5"><?php echo $desc;?></textarea>
                                      </div>
                                      <button style="color:#FFF;" type="submit" name = "submt" class="btn btn-info btn-icon-text mt-3"><i class="mdi mdi-file-send"></i>Update subcatagory</button>
                                    </div>
                                          </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.php -->
        <?php include "../partials/_footer.php"; ?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <script>
    function logout() {
      $.post("logout.php", function() {
        location.reload();
      });
    }
  </script>
  <!-- plugins:js -->
  <script src="../vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="../vendors/chart.js/Chart.min.js"></script>
  <script src="../vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <script src="../vendors/progressbar.js/progressbar.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../js/off-canvas.js"></script>
  <script src="../js/hoverable-collapse.js"></script>
  <script src="../js/template.js"></script>
  <script src="../js/settings.js"></script>
  <script src="../js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="../js/jquery.cookie.js" type="text/javascript"></script>
  <script src="../js/dashboard.js"></script>
  <script src="../js/Chart.roundedBarCharts.js"></script>
  <script src="//cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
  <script>
    CKEDITOR.replace('newDesc', {
      width: "530px",
      height: "200px",
      // uiColor: '#9AB8F3'
    });
  </script>
  <!-- End custom js for this page-->
</body>

</html>

