<?php
   error_reporting(E_ALL ^ E_WARNING);
   ini_set('display_errors',0);
   require('classes/resident.class.php');
   $userdetails = $bmis->get_userdata();
   $bmis->validate_admin();
   $view = $bmis->view_brgyid_done();


?>

<?php 
    include('dashboard_sidebar_start.php');
?>
<link rel="stylesheet" href="css/table.css"/>
<style>

    .form-control{
        text-align: center;
    }
</style>

<!-- Begin Page Content -->

<div class="container-fluid page--container">

    <!-- Page Heading -->

    <div class="row">
        <div class="d-flex align-items-center mb-3">
            <h4 class="flex-grow-1">Archives Barangay ID</h4>
            <a href="admn_request_archives.php" class="btn btn-primary">Back</a>
        </div>
    </div>
      
    <div class="row mt-3"> 
            <!-- <div class="col">
                <form method="POST" action="" id="searchForm">
                    <div class="input-icons d-flex justify-content-between">
                    <div class="d-flex justify-content-between">
                        <select class="form-select search" name="form_status" id="formStatus" style="height:50px;" required="">
                            <option value="Approved">Approved</option>
                            <option value="Declined">Declined</option>
                        </select>
                        <button class="btn btn-success ms-2" name="search_brgyid">Search</button>
                        <a href="archive_brgyid.php" class="btn btn-info ms-2 me-5" style="font-size: 17px;width:200px;padding-top:10px;">View All</a>
                    </div>
                    <div>
                        Export Data By: 
                        <a class="btn btn-primary" target="_blank" href="generatePdf/brgyid/week.php">Daily</a>
                        <a class="btn btn-primary" target="_blank" href="generatePdf/brgyid/week.php">Weekly</a>
                        <a class="btn btn-primary" target="_blank" href="generatePdf/brgyid/month.php">Monthly</a>
                        <a class="btn btn-primary" target="_blank" href="generatePdf/brgyid/year.php">Yearly</a>
                    </div>    
                    
                    </div>
                </form>
            </div> -->
            <div class="row">
                 <div class="col-md-7">
                    <form id="pdfForm" method="post" action="generatepdf/random/services.php" style="display: inline-block; margin-right: 10px;">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group" style="margin-bottom: 5px;">
                                    <label for="fromDate" style="display: block;">From Date:</label>
                                    <input type="date" class="form-control" id="fromDate" name="fromDate" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" style="margin-bottom: 5px;">
                                    <label for="toDate" style="display: block;">To Date:</label>
                                    <input type="date" class="form-control" id="toDate" name="toDate" required>
                                </div>
                            </div>
                            <!-- <div class="col-md-1 mt-4"><button type="submit" class="btn btn-primary p-2 mt-3" id="generatePDF"><i class="fas fa-search"></i></button></div> -->            
                            <div class="col-md-2"><a href="#" class="btn btn-primary p-2" style="margin-top:33px" onclick="validateDates()" id="pdfLink"><i class="fas fa-print"></i></a></div>
                        </div>
                    </form> 
                </div>
                <div class="col-md-5">
                    Select Pdf Generate
                    <select class="form-select mt-2" id="pdfGenerateSelect">
                        <option value="generatePdf/residency/all.php">All</option>
                        <option value="generatePdf/residency/daily.php">Daily</option>
                        <option value="generatePdf/residency/week.php">Weekly</option>
                        <option value="generatePdf/residency/month.php">Monthly</option>
                        <option value="generatePdf/residency/year.php">Yearly</option>
                    </select>
                </div>  
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
                include('tables/brgyid_done.php');
            ?></div>
            <div class="pagination d-flex fixed-bottom mt-3 me-3">
                    <?php if ($currentPage > 1): ?>
                        <a class="btn btn-primary" href="?page=<?= $currentPage - 1 ?>">Prev</a>
                    <?php endif; ?>

                    <span class="current-page mt-1 me-3 ms-3">Page <?= $currentPage ?></span>

                    <?php if ($moreRecords): ?>
                        <a class="btn btn-primary me-2" href="?page=<?= $currentPage + 1 ?>">Next</a>
                    <?php endif; ?>
                </div>
            
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
