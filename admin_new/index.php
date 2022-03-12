<?php
  include("includes/config.php");
  include("includes/classes/Catagory.php");
  include("includes/classes/Package.php");
  include("includes/classes/Advertisement.php");
  include("includes/classes/User.php");
  include("includes/classes/Logger.php");
  include("includes/classes/Query.php");

  if($_SESSION['loginstatus'] == "") {
    header("location:login.php");
  }
  $catagory = new Catagory($cn);
  $package = new Package($cn);
  $advertisement = new Advertisement($cn);
  $user = new User($cn);
  $query = new Query($cn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>MyTour | Admin home</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/typicons/typicons.css">
  <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
  <style>
    .qrylist {
      text-align: -webkit-auto;
      word-spacing: 5px;
    }
  </style>
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.php -->
    <?php include "partials/_navbarindex.php" ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
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
        <div class="tab-content" id="setting-content">
          <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
            <div class="add-items d-flex px-3 mb-0">
              <form class="form w-100">
                <div class="form-group d-flex">
                  <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                  <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task">Add</button>
                </div>
              </form>
            </div>
            <div class="list-wrapper px-3">
              <ul class="d-flex flex-column-reverse todo-list">
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Team review meeting at 3.00 PM
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Prepare for presentation
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Resolve all the low priority tickets due today
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Schedule meeting for next week
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Project review
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
              </ul>
            </div>
            <h4 class="px-3 text-muted mt-5 fw-light mb-0">Events</h4>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="ti-control-record text-primary me-2"></i>
                <span>Feb 11 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Creating component page build a js</p>
              <p class="text-gray mb-0">The total number of sessions</p>
            </div>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="ti-control-record text-primary me-2"></i>
                <span>Feb 7 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
              <p class="text-gray mb-0 ">Call Sarah Graves</p>
            </div>
          </div>
          <!-- To do section tab ends -->
          <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
            <div class="d-flex align-items-center justify-content-between border-bottom">
              <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
              <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 fw-normal">See All</small>
            </div>
            <ul class="chat-list">
              <li class="list active">
                <div class="profile"><img src="images/faces/face1.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Thomas Douglas</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">19 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face2.jpg" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <div class="wrapper d-flex">
                    <p>Catherine</p>
                  </div>
                  <p>Away</p>
                </div>
                <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                <small class="text-muted my-auto">23 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face3.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Daniel Russell</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">14 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face4.jpg" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <p>James Richardson</p>
                  <p>Away</p>
                </div>
                <small class="text-muted my-auto">2 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face5.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Madeline Kennedy</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">5 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face6.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Sarah Graves</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">47 min</small>
              </li>
            </ul>
          </div>
          <!-- chat tab ends -->
        </div>
      </div>
      <!-- partial -->
      <!-- partial:partials/_sidebar.php -->
      <?php include "partials/_sidebarindex.php"; ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Home</a>
                    </li>
                  </ul>
                  <div>
                    <div class="btn-wrapper">
                      <a href="#" class="btn btn-otline-dark align-items-center"><i class="icon-share"></i> Share</a>
                      <a href="#" class="btn btn-otline-dark"><i class="icon-printer"></i> Print</a>
                      <a href="#" class="btn btn-primary text-white me-0"><i class="icon-download"></i> Export</a>
                    </div>
                  </div>
                </div>
                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">  
                    <div class="row">
                      <div class="col-lg-12 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="row">
                                  <div class="col-lg-3 d-flex flex-column">
                                    <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                                      <div class="card bg-primary card-rounded">
                                        <a href="pages/package.php" style="text-decoration:none;">
                                        <div class="card-body pb-0">
                                          <h4 class="card-title card-title-dash text-white mb-4">Packages</h4>
                                          <div class="row">
                                            <div class="col-sm-4">
                                              <p class="status-summary-ight-white mb-1">Total</p>
                                              <h2 class="text-info"><?=sizeof($package->get_all_packs());?></h2>
                                            </div>
                                            <div class="col-sm-8">
                                              <div class="status-summary-chart-wrapper pb-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                                <canvas id="status-summary" width="266" height="82" style="display: block; height: 66px; width: 213px;" class="chartjs-render-monitor"></canvas>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        </a>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-lg-3 d-flex flex-column">
                                    <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                                      <div class="card bg-danger card-rounded">
                                        <a href="pages/advertisement.php" style="text-decoration:none;">
                                        <div class="card-body pb-0">
                                          <h4 class="card-title card-title-dash text-white mb-4">Advertisements</h4>
                                          <div class="row">
                                            <div class="col-sm-4">
                                              <p class="status-summary-ight-white mb-1">Total</p>
                                              <h2 class="text-info"><?=sizeof($advertisement->get_all_advertisement());?></h2>
                                            </div>
                                            <div class="col-sm-8">
                                              <div class="status-summary-chart-wrapper pb-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                                <canvas id="status-summary2" width="266" height="82" style="display: block; height: 66px; width: 213px;" class="chartjs-render-monitor"></canvas>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        </a>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-lg-3 d-flex flex-column">
                                    <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                                      <div class="card bg-success card-rounded">
                                        <a href="pages/catagory.php" style="text-decoration:none;">
                                        <div class="card-body pb-0">
                                          <h4 class="card-title card-title-dash text-white mb-4">Catagories</h4>
                                          <div class="row">
                                            <div class="col-sm-4">
                                              <p class="status-summary-ight-white mb-1">Total</p>
                                              <h2 class="text-info"><?=sizeof($catagory->get_all_cat());?></h2>
                                            </div>
                                            <div class="col-sm-8">
                                              <div class="status-summary-chart-wrapper pb-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                                <canvas id="status-summary3" width="266" height="82" style="display: block; height: 66px; width: 213px;" class="chartjs-render-monitor"></canvas>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        </a>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-lg-3 d-flex flex-column">
                                    <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                                      <div class="card bg-warning card-rounded">
                                        <a href="pages/subcatagory.php" style="text-decoration:none;">
                                        <div class="card-body pb-0">
                                          <h4 class="card-title card-title-dash text-white mb-4">Subcatagories</h4>
                                          <div class="row">
                                            <div class="col-sm-4">
                                              <p class="status-summary-ight-white mb-1">Total</p>
                                              <h2 class="text-info"><?=sizeof($catagory->get_all_sub_cat());?></h2>
                                            </div>
                                            <div class="col-sm-8">
                                              <div class="status-summary-chart-wrapper pb-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                                <canvas id="status-summary4" width="266" height="82" style="display: block; height: 66px; width: 213px;" class="chartjs-render-monitor"></canvas>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        </a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-12 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-md-4 col-lg-4 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body card-rounded">
                                <h4 class="card-title  card-title-dash">Recent Events</h4>
                                <?php
                                  $log = new Logger($_SESSION["usertype"]);
                                  $log_res = $log->get_log();
                                  for($i = 0; $i < sizeof($log_res); $i++) {
                                    $var = json_decode($log_res[$i]); 
                                ?>
                                <div class="list align-items-center border-bottom py-2">
                                  <div class="wrapper w-100">
                                    <p class="font-weight-medium">
                                      Package creation
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                      <div class="d-flex align-items-center">
                                        <p class="mb-0 text-small text-muted"><?=$var->message.".";?></p>
                                      </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                      <div class="d-flex align-items-center">
                                        <i class="mdi mdi-calendar text-muted me-1"></i>
                                        <p class="mb-0 text-small text-muted"><?=$var->time;?></p>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <?php
                                  }
                                ?>
                                <div class="list align-items-center pt-3">
                                  <div class="wrapper w-100">
                                    <p class="mb-0">
                                      <a href="#" class="fw-bold text-primary">Show all <i class="mdi mdi-arrow-right ms-2"></i></a>
                                    </p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4 col-lg-4 grid-margin">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                  <h4 class="card-title card-title-dash">Activities</h4>
                                  <p class="mb-0">20 finished, 5 remaining</p>
                                </div>
                                <ul class="bullet-line-list">
                                  <li>
                                    <div class="d-flex justify-content-between">
                                      <div><span class="text-light-green">Ben Tossell</span> assign you a task</div>
                                      <p>Just now</p>
                                    </div>
                                  </li>
                                  <li>
                                    <div class="d-flex justify-content-between">
                                      <div><span class="text-light-green">Oliver Noah</span> assign you a task</div>
                                      <p>1h</p>
                                    </div>
                                  </li>
                                  <li>
                                    <div class="d-flex justify-content-between">
                                      <div><span class="text-light-green">Jack William</span> assign you a task</div>
                                      <p>1h</p>
                                    </div>
                                  </li>
                                  <li>
                                    <div class="d-flex justify-content-between">
                                      <div><span class="text-light-green">Leo Lucas</span> assign you a task</div>
                                      <p>1h</p>
                                    </div>
                                  </li>
                                  <li>
                                    <div class="d-flex justify-content-between">
                                      <div><span class="text-light-green">Thomas Henry</span> assign you a task</div>
                                      <p>1h</p>
                                    </div>
                                  </li>
                                  <li>
                                    <div class="d-flex justify-content-between">
                                      <div><span class="text-light-green">Ben Tossell</span> assign you a task</div>
                                      <p>1h</p>
                                    </div>
                                  </li>
                                  <li>
                                    <div class="d-flex justify-content-between">
                                      <div><span class="text-light-green">Ben Tossell</span> assign you a task</div>
                                      <p>1h</p>
                                    </div>
                                  </li>
                                </ul>
                                <div class="list align-items-center pt-3">
                                  <div class="wrapper w-100">
                                    <p class="mb-0">
                                      <a href="#" class="fw-bold text-primary">Show all <i class="mdi mdi-arrow-right ms-2"></i></a>
                                    </p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4 col-lg-4 grid-margin">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                  <h4 class="card-title card-title-dash">Queries</h4>
                                  <p class="mb-0">3 approved, 7 pending</p>
                                </div>
                                <ul class="bullet-line-list qrylist">
                                  <li>
                                    <div class="d-flex justify-content-between">
                                      <div><span class="text-light-green">user_name</span> queried for <span>package in afghanistan.</span></div>
                                      <p>Just now</p>
                                    </div>
                                  </li>
                                </ul>
                                <div class="list align-items-center pt-3">
                                  <div class="wrapper w-100">
                                    <p class="mb-0">
                                      <a href="#" class="fw-bold text-primary">Show all <i class="mdi mdi-arrow-right ms-2"></i></a>
                                    </p>
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
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.php -->
        <?php include "partials/_footerindex.php"; ?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <script src="vendors/progressbar.js/progressbar.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/jquery.cookie.js" type="text/javascript"></script>
  <script src="js/dashboard.js"></script>
  <script src="js/Chart.roundedBarCharts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      $("#signout").on("click", function() {
        $.post('logout.php', function(data) {
          if(data.status == "success") {
            // window.location.reload();
            location.replace("../");
          } else {
            window.alert("There was some error, please try again!!")
          }
        }, 'json');
      });
    });
  </script>
  <!-- End custom js for this page-->
</body>

</html>

