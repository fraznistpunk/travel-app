<?php
  include("../includes/config.php");
  include("../includes/classes/User.php");
  include("../includes/classes/Constants.php");
  if($_SESSION['loginstatus'] == "") {
    header("location:../login.php");
  }
  $cat = new User($cn);
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
                <form method="post">
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
                                    <h4 class="card-title card-title-dash">Update User</h4>
                                    <p class="card-subtitle card-subtitle-dash">Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
                                    <!-- <?php // echo $cat->getError(Constants::$UPDATE_FAIL); ?> -->
                                  </div>
                                </div>
                                 <div class="col-md-6 grid-margin stretch-card">
                                  <div class="card">
                                    <div class="card-body">
                                      <h4 class="card-title">Select user</h4>
                                      <div class="form-group">
                                        <label>Click below to select</label>
                                        <select name = "t1" class="js-example-basic-single w-100">
                                          <option value="">Please select an option</option>
                                          <?php
                                            $response = $cat->get_all_users();
                                            for($i = 0; $i < sizeof($response); $i++) {
                                              if(isset($_POST["show"]) && $response[$i][0] == $_POST["t1"]) {
                                                  echo '<option value="'.$response[$i][0].'" selected>'.$response[$i][1].'</option>';
                                              } else {
                                                  echo '<option value="'.$response[$i][0].'">'.$response[$i][1].'</option>';
                                              }
                                            }
                                        ?>
                                        </select>
                                        <button style="color:#FFF;" id="showFrm" type="submit" name = "show" class="btn btn-info btn-icon-text mt-3">
                                          <i class="ti-file btn-icon-prepend"></i>
                                          Show
                                        </button>
                                      </div>
                                      <?php
                                          if(isset($_POST["show"])) {
                                            $res = $cat->get_user($_POST["t1"]);
                                            $user_name = $res[1];
                                            $user_pass = $res[2];
                                            $user_type = $res[3];
                                          }
                                          if(isset($_POST["submt"])) {
                                            $res = $cat->update_user($_POST["t1"], $_POST["new_name"], $_POST['new_pass'],$_POST['new_t2']);
                                            if(!$res) {
                                              echo "<script>window.alert('There was some error in handling your request.')</script>";
                                            } else {
                                              echo "<script> window.alert('Updated successfully.');</script>";
                                              header("location: allusers.php");
                                            }
                                          }
                                        ?>
                                    <div class="displayFrm">
                                        
                                    </div>
                                      <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="new_name" class="form-control" value = "<?php if(isset($_POST['show'])) echo $user_name; ?>" placeholder="ex: johndoe">
                                      </div>
                                      <div class="form-group">
                                        <label>Password</label>
                                        <input type="text" name="new_pass" class="form-control" value = "<?php if(isset($_POST['show'])) echo $user_pass; ?>">
                                      </div>
                                      <div class="form-group">
                                        <label>Type</label>
                                        <select name="new_t2" class="js-example-basic-single w-100">
                                            <option value="">Please select a user type</option>
                                            <option value="admin" <?php echo ($user_type == 'admin' ? "selected": ""); ?> >Admin</option>
                                            <option value="general" <?php echo ($user_type == 'general' ? "selected": ""); ?>>General</option>
                                        </select>
                                      </div>
                                      <button style="color:#FFF;" type="submit" name = "submt" class="btn btn-info btn-icon-text mt-3">
                                        <i class="ti-file btn-icon-prepend"></i>
                                        Update user
                                      </button>
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
  <!-- End custom js for this page-->
</body>

</html>