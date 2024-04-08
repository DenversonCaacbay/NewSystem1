<?php
    
    error_reporting(E_ALL ^ E_WARNING);
    ini_set('display_errors',0);
    require('classes/resident.class.php');
    $userdetails = $bmis->get_userdata();
    $bmis->validate_admin();
    $bmis->reject_bspermit();
    $bmis->approved_bspermit();
    // $view = $bmis->view_bspermit();

    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
    $limit = 5;
    $offset = ($currentPage - 1) * $limit;

    list($view, $moreRecords) =  $bmis->view_bspermit($limit, $offset);

    $id_resident = $_GET['id_resident'];
    $resident = $residentbmis->get_single_bspermit($id_resident);
   
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

<div class="container-fluid">

    <!-- Page Heading -->

    <div class="d-flex justify-content-between mb-3">
        <h4 class="mb-0">Pending Business Recommendation Requests</h4>
        <a href="admn_certofres_walkin.php" class="btn btn-primary"><i class="fas fa-walking me-2"></i>For Walk'in </a>
    </div>
    <div class="row"> 
        <div class="col">
            <form method="POST" action="">
                    <div class="input-icons w-100 d-flex">
                        <i class="fa fa-search icon"></i>
                        <input type="search" class="form-control search" name="keyword" value="" required=""/>
                        <button class="btn btn-success ms-3" name="search_bspermit">Search</button>
                        <a href="admn_bspermit.php" class="btn btn-info ms-3">Reload</a>
                    </div>
                </form>
        </div>
    </div>

    <div class="row"> 
        <div class="col-md-12" style="height: 500px;overflow: auto;"> 
            <?php 
                include('tables/bspermit_pending.php');
            ?>
        </div>
        <div class="pagination d-flex justify-content-end">
            <?php if ($currentPage > 1): ?>
                <a class="btn btn-primary" href="?page=<?= $currentPage - 1 ?>">Prev</a>
            <?php endif; ?>

            <span class="current-page mt-1 me-3 ms-3">Page <?= $currentPage ?></span>

            <?php if ($moreRecords): ?>
                <a class="btn btn-primary" href="?page=<?= $currentPage + 1 ?>">Next</a>
            <?php endif; ?>
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
    include('dashboard_sidebar_end.php');
?>
