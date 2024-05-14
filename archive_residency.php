<?php
   error_reporting(E_ALL ^ E_WARNING);
   ini_set('display_errors',0);
   require('classes/resident.class.php');
   $userdetails = $bmis->get_userdata();
   $bmis->validate_admin();
   $view_all = $bmis->view_certofres_done_all();
   $view_approved = $bmis->view_certofres_done_approved();
   $view_declined = $bmis->view_certofres_done_declined();
//    $bmis->create_announcement();
//    $bmis->delete_announcement();
//    $view = $bmis->view_announcement();
//    $announcementcount = $bmis->count_announcement();

    // $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
    // $limit = 5;
    // $offset = ($currentPage - 1) * $limit;

    // list($view, $moreRecords) = $residentbmis->view_certofres_done($limit, $offset);


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
/* Style the tab */
.tab {
  overflow: hidden;
  background-color: #309464;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 10px 16px;
  transition: 0.3s;
  font-size: 14px;
  color: #fff;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #fff;
  color: #309464;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #fff;
  color: #309464;
  border: #309463 2px solid;
}

/* Style the tab content */
.tabcontent {
  display: none;
  /* padding: 6px 12px; */
  /* border: 1px solid #ccc; */
  /* border-top: none; */
}
</style>

<!-- Begin Page Content -->

<div class="container-fluid page--container">

    <!-- Page Heading -->

    <div class="row">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex align-items-center">
                <a href="admn_request_archives.php" class="btn btn-primary">Back</a>
                <h4 class="ms-2 mt-2">Archives Residency</h4>
            </div>
            <div class="tab">
                <button class="tablinks" onclick="openCity(event, 'London')">All</button>
                <button class="tablinks" onclick="openCity(event, 'Paris')">Approved</button>
                <button class="tablinks" onclick="openCity(event, 'Tokyo')">Declined</button>
            </div>
        </div>
    </div>
    

    <!-- Tab content -->
    <div id="London" class="tabcontent">
        <div class="row"> 
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-7">
                    <form id="pdfForm" method="post" action="generatepdf/random/request_residency.php" target="_blank" style="display: inline-block; margin-right: 10px;">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group" style="margin-bottom: 5px;">
                                    <label for="fromDate" style="display: block;">From Date:</label>
                                    <input type="date" class="form-control" id="fromDate" name="fromDate" required>
                                </div>
                            </div>
                            <div class="col-md-5">
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
                            <option value="generatePdf/residency/daily.php">Daily</option>
                            <option value="generatePdf/residency/week.php">Weekly</option>
                            <option value="generatePdf/residency/month.php">Monthly</option>
                            <option value="generatePdf/residency/year.php">Yearly</option>
                        </select>
                    </div>  
                </div>
            </div>
        </div>


        <div class="row"> 
            <div class="col"> 
                <div class="card">
                    <?php 
                        // include('tables/residency_done.php');
                        include('tables/residency/all.php');
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div id="Paris" class="tabcontent">
    <div class="row"> 
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-7">
                    <form id="pdfFormApproved" method="post" action="generatepdf/random/residency/approved.php" target="_blank" style="display: inline-block; margin-right: 10px;">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group" style="margin-bottom: 5px;">
                                    <label for="fromDate" style="display: block;">From Date:</label>
                                    <input type="date" class="form-control" id="appFrom_date" name="fromDate" required>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group" style="margin-bottom: 5px;">
                                    <label for="toDate" style="display: block;">To Date:</label>
                                    <input type="date" class="form-control" id="appTo_date" name="toDate" required>
                                </div>
                            </div>
                            <div class="col-md-2"><button type="button" class="btn btn-primary p-2" style="margin-top:33px" onclick="validateDatesApproved()" id="pdfLink"><i class="fas fa-print"></i></button></div>
                        </div>
                    </form>

                    <script>
                        function validateDatesApproved() {
                            var startDate1 = document.getElementById('appFrom_date').value;
                            var endDate1 = document.getElementById('appTo_date').value;
                            if (startDate1 === "" || endDate1 === "") {
                                alert("Please select both start and end dates.");
                            } else {
                                // Perform other actions or submit the form
                                var form1 = document.getElementById('pdfFormApproved');
                                form1.submit();
                            }
                        }
                    </script>
                    </div>
                    <div class="col-md-5">
                        Select Pdf Generate
                        <select class="form-select mt-2" id="pdfGenerateSelect1">
                            <option value="">View Options</option>
                            <option value="generatePdf/residency/daily_approved.php">Daily</option>
                            <option value="generatePdf/residency/week_approved.php">Weekly</option>
                            <option value="generatePdf/residency/month_approved.php">Monthly</option>
                            <option value="generatePdf/residency/year_approved.php">Yearly</option>
                        </select>
                    </div>  
                </div>
            </div>
        </div>
        <div class="row"> 
            <div class="col"> 
                <div class="card">
                    <?php 
                        // include('tables/residency_done.php');
                        include('tables/residency/approved.php');
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div id="Tokyo" class="tabcontent">
    <div class="row"> 
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-7">
                    <form id="pdfFormDeclined" method="post" action="generatepdf/random/residency/declined.php" target="_blank" style="display: inline-block; margin-right: 10px;">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group" style="margin-bottom: 5px;">
                                    <label for="fromDate" style="display: block;">From Date:</label>
                                    <input type="date" class="form-control" id="fromDate2" name="fromDate" required>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group" style="margin-bottom: 5px;">
                                    <label for="toDate" style="display: block;">To Date:</label>
                                    <input type="date" class="form-control" id="toDate2" name="toDate" required>
                                </div>
                            </div>
                            <div class="col-md-2"><button type="button" class="btn btn-primary p-2" style="margin-top:33px" onclick="validateDatesDeclined()" id="pdfLink"><i class="fas fa-print"></i></button></div>
                        </div>
                    </form>

                    <script>
                        function validateDatesDeclined() {
                            var startDate = document.getElementById('fromDate2').value;
                            var endDate = document.getElementById('toDate2').value;
                            if (startDate === "" || endDate === "") {
                                alert("Please select both start and end dates.");
                            } else {
                                // Perform other actions or submit the form
                                var form = document.getElementById('pdfFormDeclined');
                                form.submit();
                            }
                        }
                    </script>
                    </div>
                    <div class="col-md-5">
                        Select Pdf Generate
                        <select class="form-select mt-2" id="pdfGenerateSelect2">
                            <option value="">View Options</option>
                            <option value="generatePdf/residency/daily_declined.php">Daily</option>
                            <option value="generatePdf/residency/week_declined.php">Weekly</option>
                            <option value="generatePdf/residency/month_declined.php">Monthly</option>
                            <option value="generatePdf/residency/year_declined.php">Yearly</option>
                        </select>
                    </div>  
                </div>
            </div>
        </div>
        <div class="row"> 
            <div class="col"> 
                <div class="card">
                    <?php 
                        // include('tables/residency_done.php');
                        include('tables/residency/declined.php');
                    ?>
                </div>
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

<script>
    // Add event listener to the select element
    document.getElementById("pdfGenerateSelect").addEventListener("change", function() {
        // Redirect to the selected option's value
        window.open(this.value, "_blank");
    });
</script>
<script>
    // Add event listener to the select element
    document.getElementById("pdfGenerateSelect1").addEventListener("change", function() {
        // Redirect to the selected option's value
        window.open(this.value, "_blank");
    });
</script>
<script>
    // Add event listener to the select element
    document.getElementById("pdfGenerateSelect2").addEventListener("change", function() {
        // Redirect to the selected option's value
        window.open(this.value, "_blank");
    });
</script>
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
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Simulate a click on the first tab button to open it by default
document.getElementsByClassName("tablinks")[0].click();
</script>
<?php 
    include('dashboard_sidebar_end.php');
?>
