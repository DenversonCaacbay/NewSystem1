<?php
   error_reporting(E_ALL ^ E_WARNING);
   ini_set('display_errors',0);
   require('classes/resident.class.php');
   $userdetails = $bmis->get_userdata();
   $bmis->validate_admin();
   $view = $bmis->view_bspermit_done();
//    $bmis->create_announcement();
//    $bmis->delete_announcement();
//    $view = $bmis->view_announcement();
//    $announcementcount = $bmis->count_announcement();


?>

<?php 
    include('dashboard_sidebar_start.php');
?>
<style>
    /*.input-icons i {*/
    /*    position: absolute;*/
    /*}*/
        
    /*.input-icons {*/
    /*    width: 30%;*/
    /*    margin-bottom: 10px;*/
    /*    margin-left: 34%;*/
    /*}*/
        
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
        <div class="d-flex align-items-center">
            <h1 class="flex-grow-1">Archives Business Recommendation</h1>
            <a href="admn_request_archives.php" class="btn btn-primary">Back</a>
        </div>
    </div>
      
    <div class="row mt-3"> 
    <div class="col">
            <form method="POST" action="" id="searchForm">
                <div class="input-icons d-flex">
                    <!-- Replace input with select dropdown -->
                    <select class="form-select search" name="form_status" id="formStatus" style="height:50px;" required="">
                        <option value="Approved">Approved</option>
                        <option value="Declined">Declined</option>
                    </select>
                    <button class="btn btn-success ms-2" name="search_bspermit">Search</button>
                    <a href="archive_bspermit.php" class="btn btn-info ms-2 me-5" style="font-size: 17px;width:200px;padding-top:10px;">View All</a>
                    Export Data By: 
                    <a class="btn btn-primary ms-2"  style="padding-top:13px; " target="_blank" href="generatePdf/bspermit/week.php">Week</a>
                    <a class="btn btn-primary ms-2"  style="padding-top:13px; " target="_blank" href="generatePdf/bspermit/month.php">Monthly</a>
                    <a class="btn btn-primary ms-2"  style="padding-top:13px; " target="_blank" href="generatePdf/bspermit/year.php">Yearly</a>
                </div>
            </form>
        </div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Retrieve the value from localStorage and set it as the selected value
    var formStatusDropdown = document.getElementById('formStatus');
    var savedFormStatus = localStorage.getItem('formStatus');
    if (savedFormStatus) {
        formStatusDropdown.value = savedFormStatus;
    }

    // Save the selected value to localStorage when the form is submitted
    document.getElementById('searchForm').addEventListener('submit', function () {
        var selectedFormStatus = formStatusDropdown.value;
        localStorage.setItem('formStatus', selectedFormStatus);
    });
});
</script>

    </div>


    <div class="row"> 
        <div class="col"> 
            <div class="card" style="height:450px; overflow: auto;">
            <?php 
                include('tables/bspermit_done.php');
            ?></div>
            
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

<script src="https://kit.fontawesome.com/67a9b7069e.js" crossorigin="anonymous"></script>
<script src="..//bootstrap/js/bootstrap.bundle.js" type="text/javascript"> </script>

<?php 
    include('dashboard_sidebar_end.php');
?>
