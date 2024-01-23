<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Barangay Services & Healthcare System</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/67a9b7069e.js" crossorigin="anonymous"></script>
</head>

<style>
    .bg-primary{
        background: #309464 !important;
    }
    .btn-primary{
        background: #309464 !important;
    }
    .border-left-primary{
        border-left: 0.25rem solid #309464 !important;
    }
    .text-primary{
        color: #309464 !important;
    }
    .nav-link{
        color: #ffffff !important;
    }
    .sidebar-brand-text{
        color: #ffffff !important;
    }
</style>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="admn_dashboard.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    
                </div>
                <div class="sidebar-brand-text">Administrator Dashboard </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="admn_dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                User Management
            </div>

            <!-- Barangay Staff CRUD -->
            <!-- testing -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="admin_crud.php">
                    <i class="fas fa-user-tie"></i>
                    <span>Barangay Staffs</span></a>
            </li> -->
            <li class="nav-item">
                <a class="nav-link" href="admn_staff_crud.php">
                    <i class="fas fa-user-tie"></i>
                    <span>Barangay Staffs</span></a>
            </li>

            <!-- Resident CRUD -->
            <li class="nav-item">
                <a class="nav-link" href="admn_resident_crud.php">
                    <i class="fas fa-users"></i>
                    <span>Barangay Residents</span>
                    <?php $registered_users = $residentbmis->count_registered_resident(); ?>    
                    <?php if($registered_users > 0) : ?>
                        <span class="badge badge-danger" style="margin-left:20px;font-size:10px;"><?php echo $registered_users; ?></span>
                    <?php endif; ?>
                </a>
                    
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Barangay Services
            </div>

            <!-- Announcement Management -->
            <li class="nav-item">
                <a class="nav-link" href="admn_announcement_crud.php">
                    <i class="fas fa-bullhorn"></i>
                    <span>Announcements</span></a>
            </li>

            <!-- Certificate of Residency -->
            <li class="nav-item">
                <a class="nav-link" href="admn_certofres.php">
                    <i class="fas fa-file-word"></i>
                    <span>Certificate of Residency</span>
                    <?php $registered_users = $residentbmis->count_residency(); ?>    
                    <?php if($registered_users > 0) : ?>
                        <span class="badge badge-danger" style="margin-left:6px;font-size:10px;"><?php echo $registered_users; ?></span>
                    <?php endif; ?>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="admn_brgyid.php">
                    <i class="fas fa-id-card"></i>
                    <span>Barangay ID </span>
                    <?php $registered_users = $residentbmis->count_id(); ?>    
                    <?php if($registered_users > 0) : ?>
                        <span class="badge badge-danger" style="margin-left:70px;font-size:10px;"><?php echo $registered_users; ?></span>
                    <?php endif; ?></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="admn_bspermit.php">
                    <i class="fas fa-file-contract"></i>
                    <span>Business Recommend..</span>
                    <?php $registered_users = $residentbmis->count_bussiness(); ?>    
                    <?php if($registered_users > 0) : ?>
                        <span class="badge badge-danger" style="margin-left:9px;font-size:10px;"><?php echo $registered_users; ?></span>
                    <?php endif; ?></a>
            </li>



            <!-- Barangay Clearance -->
            <li class="nav-item">
                <a class="nav-link" href="admn_brgyclearance.php">
                    <i class="fas fa-file"></i>
                    <span>Barangay Clearance</span>
                    <?php $registered_users = $residentbmis->count_clearance(); ?>    
                    <?php if($registered_users > 0) : ?>
                        <span class="badge badge-danger" style="margin-left:27px;font-size:10px;"><?php echo $registered_users; ?></span>
                    <?php endif; ?></a>
            </li>

            <!-- Certificate of Indigency -->
            <li class="nav-item">
                <a class="nav-link" href="admn_certofindigency.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Certificate of Indigency</span>
                    <?php $registered_users = $residentbmis->count_indigency(); ?>    
                    <?php if($registered_users > 0) : ?>
                        <span class="badge badge-danger" style="margin-left:2px;font-size:10px;"><?php echo $registered_users; ?></span>
                    <?php endif; ?></a>
            </li>

            <!-- Complain Blotter Report -->
            <!--<li class="nav-item">-->
            <!--    <a class="nav-link" href="admn_blotterreport.php">-->
            <!--        <i class="fas fa-user-shield"></i>-->
            <!--        <span>Peace and Order Report</span></a>-->
            <!--</li>-->

            

            <!-- Divider -->
            <hr class="sidebar-divider d-none">
            <li class="nav-item">
                <a class="nav-link" href="admn_request_archives.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Archives</span></a>
            </li>

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

                        <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="logout.php" id="userDropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-800 small"><?= $userdetails['surname']?>, <?= $userdetails['firstname']?></span>
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-primary"></i>
                                </a>
                            </li>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-primary"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>

                
                <!-- End of Topbar -->