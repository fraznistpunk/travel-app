<?php
include("../includes/config.php");
include("../includes/classes/User.php");
include("../includes/classes/Constants.php");
if ($_SESSION['loginstatus'] == "" || $_SESSION["usertype"] != "admin") {
  header("location:login.php");
}
$cat = new User($cn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>MyTour | Users</title>
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
    .modal .modal-dialog .modal-content .modal-header {
      padding: 10px 26px;
    }

    .modal .modal-dialog .modal-content .modal-footer {
      padding: 2px 0px;
    }
    .badge-opacity-danger {
      background: #ffbcb6;
      color: #f73122;
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
                                    <h4 class="card-title card-title-dash">View Users</h4>
                                  </div>
                                  <div>
                                    <button class="btn btn-primary btn-lg text-white mb-0 me-0" data-toggle="modal" data-target="#exampleModalas" onclick="openmd()" type="button"><i class="mdi mdi-library-plus"></i>Add a user</button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModalas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add new user</h5>
                                            <button onclick="closemd()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                            <form class="forms-sample">
                                              <div class="form-group">
                                                <label for="inputUser">Username</label>
                                                <input type="email" class="form-control" id="inputUser" placeholder="ex: johndoe">
                                              </div>
                                              <div class="form-group">
                                                <label for="inputPass">Password</label>
                                                <input type="password" class="form-control" id="inputPass" placeholder="Password">
                                              </div>
                                              <div class="form-group">
                                                <label for="selectType">Type of User</label>
                                                <select class="form-control" id="selectType">
                                                  <option value="0">Please select an option</option>
                                                  <option value="1">Administrator</option>
                                                  <option value="2">General</option>
                                                </select>
                                              </div>
                                            </form>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" onclick="closemd()" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" id="addusersubmit" class="btn btn-primary" style="color:#FFF">Submit</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <a href="updateUser.php" class="btn btn-info btn-lg text-white mb-0 me-0" type="button"><i class="mdi mdi-lead-pencil"></i>Edit</a>
                                    <!-- <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>"> -->
                                    <button class="btn btn-danger btn-lg text-white mb-0 me-0" id="save_value" type="button" name="delmulbtn"><i class="mdi mdi-delete"></i>Delete selected</button>
                                  </div>
                                </div>
                                <div class="table-responsive">
                                  <table class="table table-hover" id="myTable">
                                    <thead>
                                      <tr>
                                        <th><input class="form-check-input" name="checkbox[]" type="checkbox" onchange="checkAll('myTable')"></th>
                                        <th>#</th>
                                        <th>Username</th>
                                        <th>Type(Admin / General)</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      $response = $cat->get_all_users();
                                      for ($i = 0; $i < sizeof($response); $i++) {
                                        for ($j = 0; $j < 4; $j++) {
                                          if ($j + 3 < 4) {
                                            echo '
                                                <tr>
                                                  <td><input class="form-check-input" name="checkbox[]" type="checkbox" value="' . $response[$i][$j] . '"></td>
                                                  <td><b>' . $response[$i][$j] . '</b></td>
                                                  <td>' . $response[$i][$j + 1] . '</td>
                                                  <td>' . ($response[$i][$j + 3] == "admin" ? '<span class="badge badge-opacity-danger">Administrator</span>' : '<span class="badge badge-opacity-primary">User</span>') . '</td>
                                                </tr>';
                                          }
                                        }
                                      }
                                      ?>
                                    </tbody>
                                    <!-- </form> -->
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
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="../js/jquery.cookie.js" type="text/javascript"></script>
  <script src="../js/dashboard.js"></script>
  <script src="../js/Chart.roundedBarCharts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
  <script src="common.js"></script>
  <script>
    $(document).ready(function() {
      $("#signout").on("click", function() {
        $.post('../logout.php', function(data) {
          if (data.status == "success") {
            window.location.replace("../");
          } else {
            window.alert("There was some error, please try again!!")
          }
        }, 'json');
      });

      // multiple select
      $(function() {
        $("#save_value").click(function() {
          var selected = new Array();
          $("#myTable input[type=checkbox]:checked").each(function() {
            selected.push(this.value);
          });
          if (selected.length > 0) {
            let x = confirm("Are you sure want to delete selected users?");
            if (x) {
              $.post('handlers/userhandler.php', {
                selected_users: selected
              }, function(data) {
                if (data.status == "success") {
                  window.alert("Deleted successfully.")
                  window.location.reload();
                } else window.alert("There was some error " + data.error);
              }, 'json');
            } else {
              $(":input", document.getElementById(myTable))
                .prop("checked", false)
                .prop("selected", false);
            }
          } else alert("Please select some users first");
        });
      });

      $("#addusersubmit").on("click", function(e) {
        e.preventDefault();
        let el = $(this);
        let n = $("#inputUser").val();
        let p = $("#inputPass").val();
        let typeUsr = $('#selectType').find(":selected").val();
        if (typeUsr == 0) alert("Please select an option for user type.");
        else {
          if (typeUsr == 1) typeUsr = "admin";
          else typeUsr = "general";
          $.post('handlers/userhandler.php', {
            name: n,
            pwd: p,
            type: typeUsr
          }, function(data) {
            if (data.status == "success") {
              closemd();
              window.alert("User added successfully");
              window.location.reload();
            } else if (data.status == "fail") {
              closemd();
              window.alert("There was some error: " + data.error);
            } else {
              window.alert("Username already exists, please try with unique username");
              // window.location.reload();
            }
          }, 'json');
        }
      });
      $('#myTable').DataTable();
    });
  </script>
  <!-- End custom js for this page-->
</body>

</html>