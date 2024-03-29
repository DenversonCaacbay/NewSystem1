<?php
    
    error_reporting(E_ALL ^ E_WARNING);
    ini_set('display_errors',0);
    require('classes/resident.class.php');
    $userdetails = $bmis->get_userdata();
    $bmis->validate_admin();
    $bmis->delete_certofres();
    $view = $bmis->view_certofres_done();
    // $id_resident = $_GET['id_resident'];
    // $resident = $residentbmis->get_single_certofres($id_resident);
    // $resident = view_certofres();
   
?>

<?php 
    include('dashboard_sidebar_start.php');
?>

<style>
    .input-icons i {
        position: absolute;
    }
        
    .input-icons {
        width: 30%;
        margin-bottom: 10px;
        margin-left: 34%;
    }
        
    .icon {
        padding: 10px;
        min-width: 40px;
    }
    .form-control{
        text-align: center;
    }
</style>

<!-- Begin Page Content -->

<div class="container-fluid">

    <!-- Page Heading -->

    <div class="row"> 
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="text-center mb-0">List of Done Residency Requests</h1>
            <a href="admn_certofres.php" class="btn btn-primary">Back</a>
        </div>
    </div>
    </div>

    <hr>

    <div class="row">
        <div class="col">
            <form method="POST" action="">
                <div class="input-icons d-flex">
                    <i class="fa fa-search icon"></i>
                    <input type="search" class="form-control search" name="keyword" style="border-radius: 30px;" value="" required=""/>
                    <button class="btn btn-success" name="search_resident" style="width: 90px; font-size: 17px; border-radius:30px; margin-left:10px;">Search</button>
                    <a href="admn_resident_crud.php" class="btn btn-info" style="width: 90px; font-size: 17px; border-radius:30px; margin-left:10px;">Reload</a>
                </div>
			</form>
        </div>
    </div>


    <div class="row"> 
        <div class="col-md-12"> 
            <?php 
                include('tables/residency_pending.php');
            ?>
        </div>
    </div>
    
    <!-- /.container-fluid -->
    
</div>
<!-- End of Main Content -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/js/bootstrap-modalmanager.min.js" integrity="sha512-/HL24m2nmyI2+ccX+dSHphAHqLw60Oj5sK8jf59VWtFWZi9vx7jzoxbZmcBeeTeCUc7z1mTs3LfyXGuBU32t+w==" crossorigin="anonymous"></script>
<!-- responsive tags for screen compatibility -->
<meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no">
<!-- custom css --> 
<link href="../BarangaySystem/customcss/regiformstyle.css" rel="stylesheet" type="text/css">
<!-- bootstrap css --> 
<link href="../BarangaySystem/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"> 
<!-- fontawesome icons -->
<script src="https://kit.fontawesome.com/67a9b7069e.js" crossorigin="anonymous"></script>
<script src="../BarangaySystem/bootstrap/js/bootstrap.bundle.js" type="text/javascript"> </script>

<?php 
    // include('dashboard_sidebar_end.php');
?>
