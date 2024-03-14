<?php
    error_reporting(E_ALL ^ E_WARNING);
    include('classes/staff.class.php');
    include('classes/resident.class.php');

    $userdetails = $bmis->get_userdata();
    $bmis->validate_admin();

    $rescount = $residentbmis->count_resident();
    $rescountm = $residentbmis->count_male_resident();
    $rescountf = $residentbmis->count_female_resident();
    $rescountfh = $residentbmis->count_head_resident();
    $rescountfm = $residentbmis->count_member_resident();
    $rescountvoter = $residentbmis->count_voters();
    $rescountsenior = $residentbmis->count_resident_senior();
    $staffcount = $staffbmis->count_staff();
?>

<link rel="stylesheet" href="css/dashboard.css" />

<?php 
    include('dashboard_sidebar_start.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid dashboard--container">

<!-- Page Heading -->


    <div class="row"> 
        <div class="col-md-4">
            <h4> Barangay Resident Data </h4>
            <br>
            <div class="card border-left-primary shadow">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-color text-uppercase mb-1">
                                TOTAL REGISTERED BARANGAY RESIDENTS</div>
                                <div class="h5 mb-0 font-weight-bold text-dark"><?= $rescount?></div>
                                <br>
                                <a href="admn_table_totalres.php"> View Records </a>
                        </div>
                        <div class="col-auto">
                            <span style="color: #309464;"> 
                                <i class="fas fa-user-friends fa-2x text-color "></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">  
            <br>
            <div class="card border-left-primary shadow card-upper-space">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-color text-uppercase mb-1">
                            TOTAL REGISTERED HOUSEHOLD COUNT</div>
                                <div class="h5 mb-0 font-weight-bold text-dark"><?= $rescountfh?></div>
                                <br>
                                <a href="admn_table_totalhouse.php"> View Records </a>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-home fa-2x text-color"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4"> 
            <br>
            <div class="card border-left-primary shadow card-upper-space">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-color text-uppercase mb-1">
                                Total Registered Voters </div>
                                <div class="h5 mb-0 font-weight-bold text-dark"><?= $rescountvoter?></div>
                                <br>
                                <a href="admn_table_voters.php"> View Records </a>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-tie fa-2x text-color"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>

    <div class="row"> 
        <div class="col-md-4">  
            <div class="card border-left-primary shadow card-upper-space">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-color text-uppercase mb-1">
                            TOTAL REGISTERED MALE RESIDENTS</div>
                                <div class="h5 mb-0 font-weight-bold text-dark"><?= $rescountm?></div>
                                <br>
                                <a href="admn_table_maleres.php"> View Records </a>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-male fa-2x text-color"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">  
            <div class="card border-left-primary shadow card-upper-space">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-color text-uppercase mb-1">
                            TOTAL REGISTERED FEMALE RESIDENTS</div>
                                <div class="h5 mb-0 font-weight-bold text-dark"><?= $rescountf?></div>
                                <br>
                                <a href="admn_table_femaleres.php"> View Records </a>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-female fa-2x text-color"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-4"> 
            <div class="card border-left-primary shadow card-upper-space">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-color text-uppercase mb-1">
                            TOTAL REGISTERED SENIOR RESIDENTS</div>
                                <div class="h5 mb-0 font-weight-bold text-dark"><?= $rescountsenior?></div>
                                <br>
                                <a href="admn_table_senior.php"> View Records </a>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-blind fa-2x text-color"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <br>
    <hr>
    <br>

    <h4 class="text-center"> Report </h4>
    <div class="row">
        <div class="col text-center">
        <form method="POST">
            <select name="selected_category" class="form-select" id="categorySelect">
                <option selected  <?php echo ($_POST['selected_category'] ?? '') == 'all' ? 'selected' : ''; ?> value="all">All</option>
                <option <?php echo ($_POST['selected_category'] ?? '') == 'brgyid' ? 'selected' : ''; ?> value="brgyid">Barangay ID</option>
                <option <?php echo ($_POST['selected_category'] ?? '') == 'bspermit' ? 'selected' : ''; ?> value="bspermit">Business Recommendation</option>
                <option <?php echo ($_POST['selected_category'] ?? '') == 'clearance' ? 'selected' : ''; ?> value="clearance">Barangay Clearance</option>
                <option <?php echo ($_POST['selected_category'] ?? '') == 'indigency' ? 'selected' : ''; ?> value="indigency">Certificate of Indigency</option>
                <option <?php echo ($_POST['selected_category'] ?? '') == 'rescert' ? 'selected' : ''; ?> value="rescert">Certificate of Residency</option>
            </select>
            <input type="submit" class="btn btn-success" name="get_category" style="display: none;">
            </form>
        </div>
    </div>
    
    <div class="row"> 
        <div class="col">
            <div>
              <canvas id="lineChart"></canvas>
            </div>
        </div>
        
        <div class="col">
            <div>
              <canvas id="lineChart2"></canvas>
            </div>
        </div>
        
        
    <!--<div class="col-md-4">-->
    <!--    <h4> Barangay Staff Data </h4> -->
    <!--    <br>-->
    <!--    <div class="card border-left-info shadow">-->
    <!--            <div class="card-body">-->
    <!--                <div class="row no-gutters align-items-center">-->
    <!--                    <div class="col mr-2">-->
    <!--                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">-->
    <!--                            Total Barangay Staffs</div>-->
    <!--                            <div class="h5 mb-0 font-weight-bold text-dark"><?= $staffcount?></div>-->
    <!--                            <br>-->
    <!--                            <a href="admn_table_totalstaff.php"> View Records </a>-->
    <!--                    </div>-->
    <!--                    <div class="col-auto">-->
    <!--                        <i class="fas fa-user-friends fa-2x text-dark"></i>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    

    </div>
    
    <div class="row">
        <div class="col">
            <div>
              <canvas style="height:100% !important;" id="myChart3"></canvas>
            </div>
        </div>
    </div><br>

<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<br>
<br>

<?php
        $selectedCategory = isset($_POST['selected_category']) ? $_POST['selected_category'] : 'all';
        
        $weekly = (array) $staffbmis->dashboard_weekly($selectedCategory);
        $monthly = (array) $staffbmis->dashboard_monthly($selectedCategory);
        $quarterly = (array) $staffbmis->dashboard_quarterly($selectedCategory);
        
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["get_category"])) {
    
        // Assuming your class is instantiated as $yourClass
        $weekly = (array) $staffbmis->dashboard_weekly($selectedCategory);
        $monthly = (array) $staffbmis->dashboard_monthly($selectedCategory);
        $quarterly = (array) $staffbmis->dashboard_quarterly($selectedCategory);
    
        // // Print or use the result in your frontend
        // print_r($result);
    }
?>

<!-- charts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- weekly -->
<?php 
    $weekly_labels = json_encode(array_keys($weekly));
    $weekly_data = json_encode(array_values($weekly));
?>
<script>
    var weekly_labels = <?php echo $weekly_labels; ?>;
    var weekly_data = <?php echo $weekly_data; ?>;
</script>

<script>
// Get the canvas element
var ctx1 = document.getElementById('lineChart').getContext('2d');

// Create the line chart
var myLineChart = new Chart(ctx1, {
    type: 'line',
    data: {
        labels: weekly_labels,
        datasets: [{
            label: 'Weekly',
            data: weekly_data,
            borderColor: 'rgba(48,148,100,255)',
            backgroundColor: "rgba(164,204,172, 0.8)",
            borderWidth: 2, // Line width
            fill: false // Don't fill the area under the line
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false,
             },
             title: {
               display: true,
               text: 'Weekly',
               position: 'top',
            }
        },
        scales: {
            x: {
                type: 'category',
                title: {
                    display: true,
                    // text: 'Weekly'
                }
            },
            y: {
                // beginAtZero: true,
                title: {
                    display: true,
                    text: 'Value'
                }
            }
        }
    }
});
</script>


<!-- monthly -->
<?php 
    $monthly_labels = json_encode(array_keys($monthly));
    $monthly_data = json_encode(array_values($monthly));
?>
<script>
    // Static data for the chart
    var monthly_labels = <?php echo $monthly_labels; ?>;
    var monthly_data = <?php echo $monthly_data; ?>;
</script>

<script>
// Get the canvas element
var ctx2 = document.getElementById('lineChart2').getContext('2d');

// Create the line chart
var myLineChart = new Chart(ctx2, {
    type: 'line',
    data: {
        labels: monthly_labels,
        datasets: [{
            label: 'Monthly',
            data: monthly_data,
            borderColor: 'rgba(48,148,100,255)',
            backgroundColor: "rgba(164,204,172, 0.8)",
            borderWidth: 2, 
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false,
             },
             title: {
               display: true,
               text: 'Monthly',
               position: 'top',
            }
        },
        scales: {
            x: {
                type: 'category',
                title: {
                    display: true,
                    // text: 'Monthly'
                }
            },
            y: {
                // beginAtZero: true,
                title: {
                    display: true,
                    text: 'Value'
                }
            }
        }
    }
});
</script>

<!-- quarterly -->
<?php 
    // $quarterly = (array) $staffbmis->dashboard_quarterly();
    $quarterly_labels = json_encode(array_keys($quarterly));
    $quarterly_data = json_encode(array_values($quarterly));
    // echo print_r($quarterly); 
?>

<script>
    // Static data for the chart
    var quarterly_labels = <?php echo $quarterly_labels; ?>;
    var quarterly_data = <?php echo $quarterly_data; ?>;
</script>
<script>
  const ctx3 = document.getElementById('myChart3');

  new Chart(ctx3, {
    type: 'bar',
    data: {
      labels: quarterly_labels,
      datasets: [{
        label: 'Quarter',
        data: quarterly_data,
            borderColor: 'rgba(48,148,100,255)',
            backgroundColor: "rgba(164,204,172, 0.8)",
            borderWidth: 2, 
      }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false,
             },
             title: {
               display: true,
               text: 'Quarterly',
               position: 'top',
            }
        },
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function(){
        // Attach a change event listener to the select element
        $('#categorySelect').change(function(){
            // Trigger a click event on the submit button
            $('input[name="get_category"]').click();
        });
    });
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/js/bootstrap-modalmanager.min.js" integrity="sha512-/HL24m2nmyI2+ccX+dSHphAHqLw60Oj5sK8jf59VWtFWZi9vx7jzoxbZmcBeeTeCUc7z1mTs3LfyXGuBU32t+w==" crossorigin="anonymous"></script>
<!-- responsive tags for screen compatibility -->
<meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no">
<!-- custom css --> 
<script src="https://kit.fontawesome.com/67a9b7069e.js" crossorigin="anonymous"></script>
<script src="bootstrap/js/bootstrap.bundle.js" type="text/javascript"> </script>
                
<?php 
    include('dashboard_sidebar_end.php');
?>