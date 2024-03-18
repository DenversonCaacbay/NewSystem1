<?php
   error_reporting(E_ALL ^ E_WARNING);
   ini_set('display_errors',0);
   require('classes/resident.class.php');
   $userdetails = $bmis->get_userdata();
   $bmis->validate_admin();
   $view = $bmis->view_clearance_done();


?>

<?php 
    include('dashboard_sidebar_start.php');
?>
<style>s
        
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
        <div class="d-flex align-items-center mb-3">
            <h4 class="flex-grow-1">Archives Barangay Clearance</h4>
            <a href="admn_request_archives.php" class="btn btn-primary">Back</a>
        </div>
    </div>
      
    <div class="row"> 
    <div class="col">
            <form method="POST" action="" id="searchForm">
                <div class="input-icons d-flex justify-content-between">
                    <div class="d-flex justify-content-between">
                         <select class="form-select search" name="form_status" id="formStatus" style="height:50px;" required="">
                        <option value="Approved">Approved</option>
                        <option value="Declined">Declined</option>
                        </select>
                        <button class="btn btn-success ms-2" name="search_clearance">Search</button>
                        <a href="archive_clearance.php" class="btn btn-info ms-2 me-5" style="font-size: 17px;width:200px;padding-top:10px;">View All</a>
                    </div>
                    <!-- Replace input with select dropdown -->
                   <div>
                    Export Data By:
                    <a class="btn btn-primary " target="_blank" href="generatePdf/clearance/week.php">Daily</a> 
                    <a class="btn btn-primary " target="_blank" href="generatePdf/clearance/week.php">Weekly</a>
                    <a class="btn btn-primary " target="_blank" href="generatePdf/clearance/month.php">Monthly</a>
                    <a class="btn btn-primary " target="_blank" href="generatePdf/clearance/year.php">Yearly</a>
                   </div>
                   
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
                include('tables/brgyclearance_done.php');
            ?></div>
            
        </div>
    </div>
    <br><br>



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
