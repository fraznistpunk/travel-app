<?php
include("../includes/config.php");
include("../includes/classes/Package.php");
include("../includes/classes/Catagory.php");
include("../includes/classes/Constants.php");
if($_SESSION['loginstatus'] == "" || $_SESSION["usertype"] != "admin") {
  header("location:login.php");
}
$pack = new Package($cn);
$cat = new Catagory($cn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>MyTour | Packages</title>
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
  .more{
    display: none;
  }
  textarea {
    width: 100% !important;
    padding: 0.4375rem 0.75rem;
    border: 0;
    outline: 1px solid #dee2e6;
    border-radius: 4px;
    resize: none;
  }
  textarea#inputDesc:focus {
    border: 1px solid #86b7fe !important;
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
                                  <h4 class="card-title card-title-dash">View Packages</h4>
                                </div>
                                <div>
                                  <button class="btn btn-primary btn-lg text-white mb-0 me-0" data-toggle="modal" data-target="#exampleModalas" onclick="openmd()" type="button"><i class="mdi mdi-library-plus"></i>Add new Package</button>
                                  <!-- Modal -->
                                  <div class="modal fade" id="exampleModalas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Add new package</h5>
                                          <button onclick="closemd()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                          <form class="forms-sample" id="modal-form">
                                            <div class="form-group">
                                              <label for="inputUser">Package</label>
                                              <input type="text" class="form-control" id="inputPack" placeholder="ex: johndoe">
                                            </div>
                                            <div class="form-group">
                                              <?php $res = $cat->get_all_cat();?>
                                              <label for="selectType">Catagory</label>
                                              <select class="form-control" id="selectType">
                                                <option value="">Please select a catagory</option>
                                                <?php
                                                  for($i = 0; $i < sizeof($res); $i++) {
                                                    for($j = 0; $j < 2; $j++) {
                                                      if($j+1 < 2) {
                                                        echo '<option value="'.$res[$i][$j].'">'.$res[$i][$j+1].'</option>';
                                                      }
                                                    }
                                                  }
                                                ?>
                                              </select>
                                            </div>
                                            <div class="form-group">
                                              <?php $res = $cat->get_all_sub_cat();?>
                                              <label for="selectType">Subcatagory</label>
                                              <select class="form-control" id="selectType2">
                                                <option value="">Please select a subcatagory</option>
                                              </select>
                                            </div>
                                            <div class="form-group">
                                              <label for="inputUser">Price</label>
                                              <input type="number" class="form-control" id="inputPrice">
                                            </div>
                                            <div class="form-group">
                                              <input accept="image/*" type="file" class="form-control" name="iconImage" id="iconImage">
                                            </div>
                                            <div class="form-group">
                                              <input accept="image/*" type="file" class="form-control" name="iconImage2" id="iconImage2">
                                            </div>
                                            <div class="form-group">
                                              <input accept="image/*" type="file" class="form-control" name="iconImage3" id="iconImage3">
                                            </div>
                                            <div class="form-group">
                                              <textarea name="desc" id="inputDesc" rows="5"></textarea>
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
                                  <a href="updatePackage.php" class="btn btn-info btn-lg text-white mb-0 me-0" type="button"><i class="mdi mdi-lead-pencil"></i>Edit</a>
                                  <button class="btn btn-danger btn-lg text-white mb-0 me-0" id="save_value" type="button" name="delmulbtn"><i class="mdi mdi-delete"></i>Delete selected</button>
                                </div>
                              </div>
                              <div class="table-responsive">
                                <table class="table table-hover" id="myTable">
                                  <thead>
                                    <tr>
                                      <th><input class="form-check-input" name="checkbox[]" type="checkbox" onchange="checkAll('myTable')"></th>
                                      <th>#</th>
                                      <th>Name</th>
                                      <th>Catagory</th>
                                      <th>Subcatagory</th>
                                      <th>Price</th>
                                      <th>Icon</th>
                                      <th>Icon</th>
                                      <th>Icon</th>
                                      <th>Description</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                        function readMoreHelper1($story_desc, $chars = 60) {
                                          if(strlen($story_desc) < 35) return $story_desc;
                                          $story_desc = substr($story_desc,0,$chars);
                                          $story_desc = substr($story_desc,0, strlen($story_desc));  
                                          $story_desc = $story_desc;
                                          return $story_desc;  
                                        }
                                        function readMoreHelper2($story_desc, $chars = 60) {
                                          if(strlen($story_desc) < 35) return $story_desc;
                                          $story_desc = substr($story_desc,$chars, strlen($story_desc));    
                                          $story_desc = $story_desc;
                                          return $story_desc;  
                                        } 
                                        $response = $pack->get_all_packs();
                                        for($i = 0; $i < sizeof($response); $i++) {
                                          for($j = 0; $j < 9; $j++) {
                                            if($j+8 < 9) {
                                              if($cat->get_subcatname_by_id($response[$i][$j+3]) == "") $subcat = "NO CAT SPECIFIED";
                                              else $subcat = $cat->get_subcatname_by_id($response[$i][$j+3]);
                                              echo '
                                              <tr>
                                                <td><input class="form-check-input" name="checkbox[]" type="checkbox" value="' . $response[$i][$j] . '"></td>
                                                <td><b>'.$response[$i][$j].'</b></td>
                                                <td><b>'.$response[$i][$j+1]. '</b></td>
                                                <td><span class="badge badge-opacity-warning">'.$cat->get_catname_by_id($response[$i][$j+2]). '</span></td>
                                                <td>';
                                                if($cat->get_subcatname_by_id($response[$i][$j+3]) == "") {
                                                  echo '<i><span class="text-muted">_NOT SPECIFIED_</span></i>';
                                                } else {
                                                  echo '<span class="badge badge-opacity-success">'.$cat->get_subcatname_by_id($response[$i][$j+3]).'</span>';
                                                }
                                                echo '</td>
                                                <td>₹ '.number_format($response[$i][$j+4], 0, '.', ',').'/-</td>
                                                <td><img src="../packimages/'.$response[$i][$j+5].'"></td>
                                                <td><img src="../packimages/'.$response[$i][$j+6].'"></td>
                                                <td><img src="../packimages/'.$response[$i][$j+7].'"></td>
                                                <td>';
                                                $resdesc = htmlspecialchars_decode($response[$i][$j+8]);
                                                  echo '
                                                  <div class="wrap">
                                                    <div class="post"><div class="text-muted">
                                                    '.readMoreHelper1($resdesc).'</div>
                                                    <div class="more text-muted">'.readMoreHelper2($resdesc).'</div>
                                                    <a style="cursor:pointer" class="read">read more</a>
                                                  </div>
                                                  </div>
                                                  ';
                                          echo '</td>
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
<script src="../vendors/sweetalert/sweetalert.min.js"></script>
<script src="../vendors/jquery.avgrund/jquery.avgrund.min.js"></script>
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
<script src="common.js"></script>
<script src="../js/alerts.js"></script>

<script>
  $('#selectType').change(function() {
    $("#selectType2").empty();
    $("#selectType2").append("<option value='"+0+"'>Please select a subcatagory</option>");
    $.post('handlers/packageHandler.php', {cat_val: $(this).val()}, function(data) {
      for(let i = 0; i < data.length; i++){
        var id = data[i]['Subcatid'];
        var name = data[i]['Subcatname'];
        $("#selectType2").append("<option value='"+id+"'>"+name+"</option>");
      }
    }, 'json');
  });

  $(document).ready(function(){
    $(".read").click(function(){
      $(this).prev().toggle();
      $(this).siblings('.dots').toggle();
      if($(this).text()=='read more'){
        $(this).text('read less');
      }
      else{
        $(this).text('read more');
      }
    });

    // multiple select
      $(function() {
        $("#save_value").click(function() {
          var selected = new Array();
          $("#myTable input[type=checkbox]:checked").each(function() {
            selected.push(this.value);
          });
          if (selected.length > 0) {
            let x = confirm("Are you sure want to delete selected advertisement(s)?");
            if (x) {
              $.post('handlers/packageHandler.php', {
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
          } else {
            alert("Please select some package(s) first");
          }
        });
      });

    $("#addusersubmit").on("click", function(e) {
      e.preventDefault();
      let el = $(this);
      var fd = new FormData(document.getElementById("modal-form"));
      var file1 = $('#iconImage')[0].files[0];
      var file2 = $('#iconImage2')[0].files[0];
      var file3 = $('#iconImage3')[0].files[0];
      fd.append('file', file1);
      fd.append('file2', file2);
      fd.append('file3', file3);
      fd.append('name', $("#inputPack").val());
      fd.append('cat', $('#selectType option:selected').val());
      fd.append('subcat', $('#selectType2 option:selected').val());
      fd.append('price', $("#inputPrice").val());
      fd.append('desc', $("#inputDesc").val());
      $.ajax({
        url: 'handlers/packageHandler.php',
        type: 'POST',
        data: fd,
        dataType: 'JSON',
        contentType: false,
        processData: false,
        success: function(response) {
          if(response.status == "success") {
            showSwal('auto-close-success');
            window.location.reload();
          } else if(response.status == "fail") {
            closemd('#modal-form');
            window.alert("There was some error: "+response.error);
          } else if(response.status == "size_exceed" || response.status == "image_not_uploaded") {
            window.alert("Image is too large.");
            closemd('#modal-form');
          } else if(response.status == "repeated_image") {
            window.alert("Same images are uploaded. Try again");
            // closemd('#modal-form');
          } else {
            window.alert("Package already exists, please try again.");
            closemd('#modal-form');
          }
        }
      });
    });

    // Data table
    $('#myTable').DataTable();
  });

</script>
<!-- End custom js for this page-->
</body>

</html>

