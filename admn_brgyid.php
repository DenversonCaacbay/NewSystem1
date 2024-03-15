<?php
    
    error_reporting(E_ALL ^ E_WARNING);
    ini_set('display_errors',0);
    require('classes/resident.class.php');
    $userdetails = $bmis->get_userdata();
    $bmis->validate_admin();
    // $bmis->delete_brgyid();
    $bmis->reject_brgyid();
    $bmis->approved_brgyid();
    $view = $bmis->view_brgyid();
    $id_resident = $_GET['id_resident'];
    $resident = $residentbmis->get_single_certofres($id_resident);
   
?>

<?php 
    include('dashboard_sidebar_start.php');
?>

<style>
    .container--brgyid{
        height: 500px;
    }
    .input-icons i {
        position: absolute;
    }
        
    .input-icons {
        width: 30%;
        margin-bottom: 10px;
        /* margin-left: 34%; */
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

<div class="container-fluid container--brgyid">

    <!-- Page Heading -->

    <div class="row"> 
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="text-center mb-0 ">Pending Barangay ID Requests</h4>
                <!-- <a href="admn_bspermit_done.php" class="btn btn-primary">View Done</a> -->
            </div>
        </div>
    </div>
    <div class="row"> 
        <div class="col">
            <form method="POST" action="">
                    <div class="input-icons w-100 d-flex">
                        <i class="fa fa-search icon"></i>
                        <input type="search" class="form-control search" name="keyword" value="" required=""/>
                        <button class="btn btn-success ms-3" name="search_brgyid">Search</button>
                        <a href="admn_brgyid.php" class="btn btn-info ms-3" >Reload</a>
                    </div>
                </form>
        </div>
    </div>

    <div class="row"> 
        <div class="col-md-12" style="height: 400px;overflow: auto;"> 
            <?php 
                include('tables/brgyid_pending.php');
            ?>
        </div>
    </div>
    
    <!-- /.container-fluid -->
    
</div>
<!-- End of Main Content -->

<?php 
    include('dashboard_sidebar_end.php');
?>
