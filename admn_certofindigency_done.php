<?php
    
    error_reporting(E_ALL ^ E_WARNING);
    ini_set('display_errors',0);
    require('classes/resident.class.php');
    $userdetails = $bmis->get_userdata();
    $bmis->validate_admin();
    $bmis->delete_certofindigency();
    $view = $bmis->view_certofindigency();
    $id_resident = $_GET['id_resident'];
    $resident = $residentbmis->get_single_certofindigency($id_resident);
   
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
            <h1 class="text-center mb-0">List of Done Indigency Requests</h1>
            <a href="admn_certofindigency.php" class="btn btn-primary">Back</a>
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
                    <button class="btn btn-success" name="search_certofindigency" style="width: 90px; font-size: 17px; border-radius:30px; margin-left:10px;">Search</button>
                    <a href="admn_resident_crud.php" class="btn btn-info" style="width: 90px; font-size: 17px; border-radius:30px; margin-left:10px;">Reload</a>
                </div>
			</form>
            <br>
        </div>
    </div>

    <div class="row"> 
        <div class="col"> 
            <?php 
                include('tables/certofindigency_done.php');
            ?>
        </div>
    </div>
    
</div>
<!-- End of Main Content -->


<?php 
    include('dashboard_sidebar_end.php');
?>
