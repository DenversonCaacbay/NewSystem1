<?php
   error_reporting(E_ALL ^ E_WARNING);
   ini_set('display_errors',0);
   require('classes/resident.class.php');
   $userdetails = $bmis->get_userdata();
   $bmis->validate_admin();
//    $view = $bmis->view_certofres_done();
//    $bmis->create_announcement();
//    $bmis->delete_announcement();
//    $view = $bmis->view_announcement();
//    $announcementcount = $bmis->count_announcement();

    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
    $limit = 5;
    $offset = ($currentPage - 1) * $limit;

    list($view, $moreRecords) = $residentbmis->view_certofres_done($limit, $offset);


?>

<?php 
    include('dashboard_sidebar_start.php');
?>
<link rel="stylesheet" href="css/table.css"/>
<style>
    /*.input-icons i {*/
    /*    position: absolute;*/
    /*}*/
        
    /*.input-icons {*/
    /*    width: 30%;*/
    /*    margin-bottom: 10px;*/
    /*    margin-left: 34%;*/
    /*}*/
    .btn-export{
        text-decoration:none;
        background:  #309464 !important;
        margin-left: 5px;
        padding: 10px;
        border-radius:5px;
        color: #fff;
        
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

    <div class="row">
        <div class="d-flex align-items-center mb-3">
            <h4 class="flex-grow-1">Archives Residency</h4>
            <a href="admn_request_archives.php" class="btn btn-primary">Back</a>
        </div>
    </div>
      
    <div class="row"> 
        <div class="col-md-12">
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

<!-- For Redirecting to PDF's -->

<script>
    // Add event listener to the select element
    document.getElementById("pdfGenerateSelect").addEventListener("change", function() {
        // Redirect to the selected option's value
        window.open(this.value, "_blank");
    });
</script>

    </div>


    <div class="row"> 
        <div class="col"> 
            <div class="card">
            <?php 
                include('tables/residency_done.php');
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
