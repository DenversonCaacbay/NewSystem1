<?php
    
    error_reporting(E_ALL ^ E_WARNING);
    ini_set('display_errors',1);
    require('classes/resident.class.php');
    $userdetails = $bmis->get_userdata();
    $bmis->validate_admin();
    $bmis->reject_rescert();
    $bmis->approved_rescert();
    // $view = $bmis->view_certofres();
    // $id_resident = $_GET['id_resident'];
    // $resident = $residentbmis->get_single_certofres($id_resident);
    // $resident = view_certofres();
    $bmis->create_brgyclearance_walkin();

    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
    $limit = 5;
    $offset = ($currentPage - 1) * $limit;

    // list($view, $moreRecords) = $bmis->view_clearance($limit, $offset);
    
?>

<?php 
    include('dashboard_sidebar_start.php');
?>
<link rel="stylesheet" href="css/table.css"/>
<style>
    .container--residency{
        height: 500px;
    }
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
        <h4 class="text-center mb-0">Walk'in Request Form</h4>
        <a href="admn_brgyclearance.php" class="btn btn-primary">Back</a>
    </div>

    <div class="container">
        <div class="card p-3">
            <form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="row"> 
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lname">Last Name:</label>
                                <input name="lname" type="text" class="form-control" 
                                placeholder="Enter Last Name" value="">
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="fname">First Name:</label>
                                <input name="fname" type="text" class="form-control" 
                                placeholder="Enter First Name" value="">
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mi">Middle Name </label>
                                <input name="mi" type="text" class="form-control" 
                                placeholder="Enter Middle Name" value="">
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="mi">Birthdate </label>
                                <input name="bdate" id="myDateInput" onchange="checkBdate('myDateInput')" type="date" class="form-control" required />
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>

                        </div>

                        <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="purposes">Purposes:</label>
                                <select class="form-control" name="purpose" onchange="checkOptions(this)" id="purposes" placeholder="Enter Status" required>
                                    <option value="">Choose your Purpose</option>
                                    <option value="Job Requirement">Job Requirement</option>
                                    <option value="Open a Bank Account">Open a Bank Account</option>
                                    <option value="NBI Clearance">NBI Clearance</option>
                                    <option value="Police Clearance">Police Clearance</option>
                                    <option value="Postal ID">Postal ID</option>
                                    <option value="UMID Card">UMID Card</option>
                                    <option value="Driver's License">Driver's License</option>
                                    <option value="Business Requirement">Business Requirement</option>
                                    <option value="Philhealth">Philhealth</option>
                                    <option value="Other">Other</option>
                                </select>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>

                            <!-- other -->
                            <div class="form-group" id="otherDiv" style="display: none">
                                <input type="text" class="form-control" name="otherInput" id='otherInput' placeholder="Enter Other" style="display: none" />
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                        </div>

                        <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label> House No: </label>
                                <input type="text" class="form-control" name="houseno"  
                                placeholder="Enter House No." value="" >
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label> Street: </label>
                                <input type="text" class="form-control" name="street"  
                                placeholder="Enter Street" value="">
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label> Barangay: </label>
                                <input type="text" class="form-control" name="brgy"  
                                placeholder="Enter Barangay" value="Sta.Rita" readonly>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label> Municipality: </label>
                                <input type="text" class="form-control" name="municipal" 
                                placeholder="Enter Municipality" value="Olongapo" readonly>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                        </div>

                        <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="status">Civil Status:</label>
                                <select class="form-control" name="status" id="status" placeholder="Enter Status" required>
                                <option value="">Choose your Status</option>
                                <option value="Single">Single</option>
                                    <option value="In a relationship">In a relationship</option>
                                    <option value="Engaged">Engaged</option>
                                    <option value="Married">Married</option>
                                    <option value="Widowed">Widowed</option>
                                    <option value="Divorces">Divorced</option>
                                </select>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-3 d-none">
                        <label for="formGroupExampleInput" class="form-label">Urgent</label>
                        <input type="text" name="is_urgent" class="form-control" value="Walk In" id="formGroupExampleInput" placeholder="">
                    </div>
                    <!-- <div class="form-group" id="otherDiv" style="display: none">
                        <input type="text" class="form-control mt-3" name="otherInput" id='otherInput' placeholder="Enter Other" style="display: none" />
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div> -->
                    <div class="col-md-12">
                        <button name="create_brgyclearance_walkin" type="submit" class="btn btn-primary mt-3 w-100 p-2">Create Request</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    
    <!-- /.container-fluid -->
    
</div>
<!-- End of Main Content -->

<script src="js/bdate-checker.js"></script>
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
