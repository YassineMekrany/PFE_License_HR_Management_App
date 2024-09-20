
<br><br><br><br><br><br><br><br>
<!-- CSS de Bootstrap -->

<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
</button>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
<button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
</button>


<h2>Laboratoire de Physique Appliquée, Informatique et Statistique</h2>




<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">

    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
    <li class="nav-item dropdown no-arrow d-sm-none">
        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-search fa-fw"></i>
        </a>
        <!-- Dropdown - Messages -->
        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
            aria-labelledby="searchDropdown">
            <form class="form-inline mr-auto w-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small"
                        placeholder="Search for..." aria-label="Search"
                        aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </li>

    
    <i class="bi bi-list mobile-nav-toggle"></i>
    <!-- Nav Item - Messages -->
    

    <div class="topbar-divider d-none d-sm-block"></div>

</ul>

</nav>
<!-- End of Topbar -->
<br>
<!-- Begin Page Content -->
<div class="container-fluid">



<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-8 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Doctorants</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $Doct ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-8 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Professeurs</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $Prof ?></div>
                    </div>
                    <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-8 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Articles Publiées</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $Pub ?></div>
                    </div>
                    <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div style="background-color:white;">
<h1 style="color:red;">Dernières Actualités</h1>
<?php foreach ($getDernNews as $news) {  
            if($news["id_an"] == 1 or $news["id_an"] == 2 or $news["id_an"] == 3) { ?>
                <p style="color:green;"><?= $news['message'] ." </br><small style='color:blue;'>   entre  ".$news['date_deb']."  et  ".$news['date_lim'] ?></small> </p>
                <?php }
            else { ?>
                <p style="color:green;"><?= $news['message'] ." </br><small style='color:blue;'>  Le ".$news['date_lim'] ?></small> </p>
            <?php } } ?>
</div>
<?php if(count($AllAnnonce) > 5){ ?>
<a href="index.php?action=TouteAnnonce">Afficher Plus</a><?php } ?>

</body>

</html>
