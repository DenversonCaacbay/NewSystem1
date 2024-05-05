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
<link rel="stylesheet" href="css/table.css"/>
<style>
        
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
            <h4 class="flex-grow-1">Archives Barangay Clearance</h4>
            <a href="admn_request_archives.php" class="btn btn-primary">Back</a>
        </div>
    </div>
      
    <div class="row"> 
        <div class="col-md-12">
            <div class="row">
                 <div class="col-md-7">
                 <form id="pdfForm" method="post" action="generatepdf/random/request_clearance.php" target="_blank" style="display: inline-block; margin-right: 10px;">
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
                        <div class="col-md-2"><button type="button" class="btn btn-primary p-2" style="margin-top:33px" onclick="validateDates()" id="pdfLink"><i class="fas fa-print"></i></button></div>
                    </div>
                </form>

                <script>
                    function validateDates() {
                        var startDate = document.getElementById('fromDate').value;
                        var endDate = document.getElementById('toDate').value;
                        if (startDate === "" || endDate === "") {
                            alert("Please select both start and end dates.");
                        } else {
                            // Perform other actions or submit the form
                            var form = document.getElementById('pdfForm');
                            form.submit();
                        }
                    }
                </script>
                </div>
                <div class="col-md-5">
                    Select Pdf Generate
                    <select class="form-select mt-2" id="pdfGenerateSelect">
                        <option value="">View Options</option>
                        <option value="generatePdf/clearance/daily.php">Daily</option>
                        <option value="generatePdf/clearance/week.php">Weekly</option>
                        <option value="generatePdf/clearance/month.php">Monthly</option>
                        <option value="generatePdf/clearance/year.php">Yearly</option>
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
