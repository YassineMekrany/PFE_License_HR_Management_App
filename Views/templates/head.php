<?php include_once("Models/AnnonceManager.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>LPAIS</title>
    <script src="https://unpkg.com/react@17.0.2/umd/react.production.min.js"></script>
    <script src="https://unpkg.com/react-dom@17.0.2/umd/react-dom.production.min.js"></script>

    <!-- Fichiers CSS et JavaScript de Bootstrap -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" integrity="sha384-w1ccQeL+PKJOMRJo5mWT98c1z2HTVaxKgoaRbfpP6X9GH6hyq1fUbxjKg20V7N+h" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-FLM6x2Q7ff9XrXnsgLuV/ZIuxy5uei35zL5C5QZjErK6R8b6V9X6YUN3yVeiUvoj" crossorigin="anonymous"></script>

<!-- CSS de Bootstrap -->
<link rel="stylesheet" href="C:\Users\PC\Desktop\S6_SMI\PFE\fich_PHP\bootstrap-5.0.2-dist\css\bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

<!-- JS de Bootstrap -->
<script src="C:\Users\PC\Desktop\S6_SMI\PFE\fich_PHP\bootstrap-5.0.2-dist\js\bootstrap.bundle.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">

  
  <link rel="stylesheet" href="bootstrap.bundle.min.js / bootstrap.bundle.js">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="../Style_CSS/style1.css">
  <link rel="stylesheet" href="Public/style.css">

  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">

	 <!-- CSS de Bootstrap -->
	 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">

<!-- CSS de Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                
                </div>
                <div>LPAIS</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    <i class="fas fa-user"></i>
                    <span>Votre Espace</span>
                </a>
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">votre espace :</h6>
                        <a class="collapse-item" href="index.php?action=loginDoct">Espace Doctorant</a>
                        <a class="collapse-item" href="index.php?action=loginProf">Espace Professeur</a>
                        <a class="collapse-item" href="index.php?action=loginAdm">Espace Administration</a>
                    </div>
                </div>
            </li>

            
            <hr class="sidebar-divider">
            <?php if(isPreinscriptionActivated() Or isDemandeRejoindreProfActivated()){ ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-user"></i>
                    <span>Rejoindre au Labo</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Rejoindre au Labo :</h6>
                        <?php if(isPreinscriptionActivated()){ ?>
                        <a class="collapse-item" href="index.php?action=Preinscription">Comme Doctorant</a> <?php } ?>
                        <?php if(isDemandeRejoindreProfActivated()){ ?>
                        <a class="collapse-item" href="index.php?action=DemandeRejoindre">Comme Professeur</a> <?php } ?>
                    </div>
                </div>
            </li>
            <?php } else { ?> 
            <li class="nav-item">
                <a class="nav-link" href="index.php?action=NonRejoindre">
                <i class="fas fa-user"></i><span>Rejoindre au Labo</span></a>
            </li><?php } ?>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="index.php?action=Contacter">
                <i class="fas fa-envelope"></i><span>Contacter</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

    

            
        </ul>
					 
                    <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-search fa-fw"></i>
                </a>

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
        </ul>
        

    

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="#">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

 <!-- JS de Bootstrap -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>



<script src="bootstrap-5-admin-dashboard-template-main/js/bootstrap.bundle.min.js"></script>
  <script src="bootstrap-5-admin-dashboard-template-main/js/jquery-3.5.1.js"></script>
  <script src="bootstrap-5-admin-dashboard-template-main/js/jquery.dataTables.min.js"></script>
  <script src="bootstrap-5-admin-dashboard-template-main/js/dataTables.bootstrap5.min.js"></script>
  <script src="bootstrap-5-admin-dashboard-template-main/js/script.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>


</body>

</html>