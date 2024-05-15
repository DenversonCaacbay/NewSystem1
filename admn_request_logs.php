<?php
    
    error_reporting(E_ALL ^ E_WARNING);
    ini_set('display_errors',0);
    require('classes/resident.class.php');
    $userdetails = $bmis->get_userdata();
    $bmis->validate_admin();
    $requests = $residentbmis->view_logs_in_process();
?>

<?php 
    include('dashboard_sidebar_start.php');
?>
<link rel="stylesheet" href="css/table.css"/>

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
    .pagination{
        margin-bottom: 20px;
        margin-right: 30px;
    }
    .nav-tray a{
        padding: 5px;
        color: #309464;
    }
    .nav-tray a:hover{
        background: #309464;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
    }
    .active{
        background: #309464;
        color: #fff !important;
        border-radius: 5px;
    }
</style>

<!-- Begin Page Content -->

<div class="container-fluid page--container">

    <!-- Page Heading -->

    <div class="d-flex justify-content-between mb-3">
        <h4 class="mb-0">Logs of Activity</h4>
        <div>
            <div class="nav-tray d-flex align-items-center">
                <a href="admn_request_logs.php" class="active ms-3">In-Process</a> <span class="ms-3">|</span>
                <a href="admn_request_logs_processed.php" class="ms-3">Processed</a> <span class="ms-3">|</span>
                <a href="admn_request_logs_processed_declined.php" class=" ms-3">Declined</a> <span class="ms-3">|</span>
                <a href="admn_request_logs_walkin.php" class="ms-3">Walk-in</a>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <label for="requestType">Select Request Type:</label>
            <select class="form-control" id="requestType">
                <option value="all">All Requests</option>
                <option value="brgyid">Barangay ID</option>
                <option value="bspermit">Business Recommendation</option>
                <option value="clearance">Barangay Clearance</option>
                <option value="indigency">Indigency</option>
                <option value="rescert">Residency</option>
            </select>
        </div>
    </div>
<div class="row mt-3">
    <table class="table" id="requestTable">
        <thead class="sticky-top">
            <tr>
                
                <th>Full Name | Staff</th>
                <th>Request Type</th>
                <th>Details</th>
                <th>Date</th>
                <th>Status</th>
                
            </tr>
        </thead>
        <tbody>
    <?php 
    // Check if requests are available and sort them by date in descending order
    if(is_array($requests)) {
        // Combine all request data into one array
        $all_requests = [];
        foreach($requests as $type => $request_data) {
            foreach ($request_data as $request) {
                $request['type'] = $type;
                $all_requests[] = $request;
            }
        }

        // Sort all requests by date in descending order
        usort($all_requests, function($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        });

        // Iterate over sorted requests and display them in a table
        foreach($all_requests as $request) {?>
            <tr data-type="<?= $request['type']; ?>">
                
                <td><?= $request['lname']; ?>, <?= $request['fname']; ?></td>
                <!-- <td><?= ucfirst($request['type']); ?></td> -->
                <td>
                    <?php 
                    // Display the full request type name
                    switch($request['type']) {
                        case 'brgyid':
                            echo "Barangay ID";
                            break;
                        case 'bspermit':
                            echo "Business Recommendation";
                            break;
                        case 'clearance':
                            echo "Barangay Clearance";
                            break;
                        case 'indigency':
                            echo "Certificate of Indigency";
                            break;
                        case 'rescert':
                            echo "Residency Certificate";
                            break;
                        default:
                            echo "Unknown";
                    }
                    ?>
                </td>
                <td>
                    <?php 
                    // Display request details based on request type
                    switch($request['type']) {
                        case 'brgyid':
                            echo "Street: " . $request['street'] . $request['brgy'];
                            break;
                        case 'bspermit':
                            echo "Business Name: " . $request['bsname'];
                            break;
                        case 'clearance':
                        case 'indigency':
                        case 'rescert':
                            echo "Purpose: " . $request['purpose'];
                            break;
                        default:
                            echo "Unknown";
                    }
                    ?>
                </td>
                
                <td><?= ucfirst(date("F d, Y", strtotime($request['created_at']))); ?></td>
                <td><?= $request['form_status'];?></td>
            </tr>
        <?php } ?>
    <?php } ?>
</tbody>

    </table>
</div>
    
    <!-- /.container-fluid -->
    <script>
    // Filter table data based on selected request type
    document.getElementById('requestType').addEventListener('change', function() {
        var requestType = this.value;
        var rows = document.querySelectorAll('#requestTable tbody tr');

        rows.forEach(function(row) {
            var type = row.getAttribute('data-type');
            if (requestType === 'all' || requestType === type) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
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
