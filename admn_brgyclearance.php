<?php
    
    error_reporting(E_ALL ^ E_WARNING);
    ini_set('display_errors',0);
    require('classes/resident.class.php');
    $userdetails = $bmis->get_userdata();
    $bmis->validate_admin();
    $bmis->reject_clearance();
    $bmis->approved_clearance();
    $view = $bmis->view_clearance();
    $id_resident = $_GET['id_resident'];
    $resident = $residentbmis->get_single_certofres($id_resident);
   
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
                <h1 class="text-center mb-0">Pending Barangay Clearance Requests</h1>
            </div>
        </div>
    </div>

    <hr class="w-100">

    <div class="row"> 
        <div class="col">
        <form method="POST" action="">
                    <div class="input-icons d-flex">
                        <i class="fa fa-search icon"></i>
                        <input type="search" class="form-control search" name="keyword" style="border-radius: 30px;" value="" required=""/>
                        <button class="btn btn-success" name="search_clearance" style="width: 90px; font-size: 17px; border-radius:30px; margin-left:10px;">Search</button>
                        <a href="admn_brgyclearance.php" class="btn btn-info" style="width: 90px; font-size: 17px; border-radius:30px; margin-left:10px;">Reload</a>
                    </div>
                </form>
        </div>
    </div>

    <div class="row"> 
        <div class="col-md-12" style="height: 450px;overflow: auto;"> 
            <?php 
                include('tables/brgyclearance_pending.php');
            ?>
        </div>
    </div>
    
    <!-- /.container-fluid -->
    
</div>
<!-- End of Main Content -->


<?php 
    include('dashboard_sidebar_end.php');
?>

