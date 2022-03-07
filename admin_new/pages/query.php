<?php
  $_SESSION['loginstatus'] = "Admin";
  if($_SESSION['loginstatus'] == "") {
    header("location:login.php");
  }
  include("../includes/config.php");
  include("../includes/classes/Query.php");
  include("../includes/classes/Constants.php");
  $cat = new Query($cn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>MyTour | Queries</title>
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
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="../css/datatablecustom.css">
  <style>
    .statusbuttons {
      color: #FFF !important;
      padding: 1em 2em !important;
    }
    .statusbuttons i {
      position: relative;
      top: 3px;
      font-size: 15px;
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
                                    <h4 class="card-title card-title-dash">View Catagories</h4>
                                  </div>
                                  <div>
                                    <button class="btn btn-primary btn-lg text-white mb-0 me-0" type="button"><i class="mdi mdi-library-plus"></i>Add new Catagory</button>
                                    <a href="updateCat.php" class="btn btn-info btn-lg text-white mb-0 me-0" type="button"><i class="mdi mdi-lead-pencil"></i>Edit</a>
                                    <a href="deleteCat.php" class="btn btn-danger btn-lg text-white mb-0 me-0" type="button"><i class="mdi mdi-delete"></i>Delete</a>
                                  </div>
                                </div>
                                <div class="table-responsive">
                                  <table class="table table-hover" id="myTable">
                                    <thead>
                                      <tr>
                                        <th>#</th>
                                        <th>Status</th>
                                        <th>Package Enquired for</th>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Days to stay</th>
                                        <th>Children</th>
                                        <th>Adults</th>
                                        <th>Message</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                          $response = $cat->get_all_enquiry();
                                          for($i = 0; $i < sizeof($response); $i++) {
                                            for($j = 0; $j < 11; $j++) {
                                              if($j+10 < 11) {
                                                echo '
                                                <tr>
                                                  <td><b>'.$response[$i][$j].'</b></td>
                                                  <td align="center">'.($response[$i][$j+10] == "Pending" ? '<button type="button" data-type="1" data-id="'.$response[$i][$j].'" class="btn statusbuttons pendingbtn btn-danger btn-icon-text" title="Click to change status"><i style="position: relative;top: 3px;font-size: 15px;" class="mdi mdi-clock-alert"></i>Pending</button>' : '<button type="button" data-type="0" data-id="'.$response[$i][$j].'" class="btn statusbuttons pendingbtn btn-success btn-icon-text"><i class="mdi mdi-check"></i>Approved</button>').'</td>
                                                  <td>'.$response[$i][$j+1].'</td>
                                                  <td>'.$response[$i][$j+2].'</td>
                                                  <td>'.$response[$i][$j+3].'</td>
                                                  <td>'.$response[$i][$j+4].'</td>
                                                  <td><a href="mailto:'.$response[$i][$j+5].'">'.$response[$i][$j+5].'</a></td>
                                                  <td>'.$response[$i][$j+6].'</td>
                                                  <td>'.$response[$i][$j+7].'</td>
                                                  <td>'.$response[$i][$j+8].'</td>
                                                  <td><span class="text-muted">'.$response[$i][$j+9].'</span></td>
                                                </tr>';
                                              }
                                            }
                                          }
                                        ?>
                                    </tbody>
                                  </table>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>

  <script>
    $(document).ready(function(){
      $(".pendingbtn").on("click", function() {
        let x = confirm("Are you sure want to change status?");
        if(x) {
          $.post("handlers/queryhandler.php", {id: $(this).data("id"),type: $(this).data("type")}, function(data) {
            if(data == "Approved") {
              window.location.reload();
            } else if(data == "Pending") {
              window.location.reload();
            } else {
              alert(data);
            }
          });
        }
      });
      $('#myTable').DataTable();
    });

  </script>
  <!-- End custom js for this page-->
</body>

</html>

