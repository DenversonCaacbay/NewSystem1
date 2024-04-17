<?php
    
    error_reporting(E_ALL ^ E_WARNING);
    ini_set('display_errors',0);
    require('classes/resident.class.php');
    $userdetails = $bmis->get_userdata();
    $bmis->validate_admin();
    $bmis->reject_indigency();
    $bmis->approved_indigency();
    // $view = $bmis->view_certofindigency();

    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
    $limit = 5;
    $offset = ($currentPage - 1) * $limit;

    list($view, $moreRecords) =  $bmis->view_certofindigency($limit, $offset);

    $id_resident = $_GET['id_resident'];
    $resident = $residentbmis->get_single_certofindigency($id_resident);
   
?>

<?php 
    include('dashboard_sidebar_start.php');
?>
<link rel="stylesheet" href="css/table.css"/>
<style>
    /* .page--container{
        height: 75vh;
    } */
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
<div class="container-fluid page--container">

    <!-- Page Heading -->

    <div class="d-flex justify-content-between mb-3">
        <h4 class="mb-0">Pending Indigency Requests</h4>
        <a href="admn_certofres_walkin.php" class="btn btn-primary"><i class="fas fa-walking me-2"></i>For Walk'in </a>
    </div>

    <div class="row"> 
        <div class="col">
        <form method="POST" action="">
                <div class="input-icons w-100 d-flex">
                    <i class="fa fa-search icon"></i>
                    <input type="search" class="form-control search" name="keyword" value="" required=""/>
                    <button class="btn btn-success ms-3" name="search_certofindigency" >Search</button>
                    <a href="admn_certofindigency.php" class="btn btn-info ms-3">Reload</a>
                </div>
			</form>
        </div>
    </div>

    <div class="row"> 
        <div class="col-md-12 page--table"> 
            <?php 
                include('tables/certofindigency_pending.php');
            ?>
        </div>
        <div class="pagination d-flex fixed-bottom mt-3 me-3">
            <?php if ($currentPage > 1): ?>
                <a class="btn btn-primary" href="?page=<?= $currentPage - 1 ?>">Prev</a>
            <?php endif; ?>

            <span class="current-page mt-1 me-3 ms-3">Page <?= $currentPage ?></span>

            <?php if ($moreRecords): ?>
                <a class="btn btn-primary" href="?page=<?= $currentPage + 1 ?>">Next</a>
            <?php endif; ?>
        </div>
    </div>
    
</div>
<!-- End of Main Content -->


<?php 
    include('dashboard_sidebar_end.php');
?>
