<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="../index.php">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item nav-category">pages</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="menu-icon mdi mdi-account-circle-outline"></i>
              <span class="menu-title">User Pages</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="../pages/allusers.php"> All users </a></li>
                <li class="nav-item"> <a class="nav-link" href="../pages/package.php"> Packages </a></li>
                <li class="nav-item"> <a class="nav-link" href="../pages/catagory.php"> Catagories </a></li>
                <li class="nav-item"> <a class="nav-link" href="../pages/subcatagory.php"> Sub - catagories </a></li>
                <li class="nav-item"> <a class="nav-link" href="../pages/advertisement.php"> Advertisement </a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item nav-category">Queries</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#uqry" aria-expanded="false" aria-controls="uqry">
              <i class="menu-icon mdi mdi-account-circle-outline"></i>
              <span class="menu-title" >Feedback & Queries</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="uqry">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="../pages/query.php"> Queries </a></li>
              </ul>
            </div>
          </li>
        </ul>
      </nav>