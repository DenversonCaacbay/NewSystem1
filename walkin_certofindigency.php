<?php
    
    error_reporting(E_ALL ^ E_WARNING);
    ini_set('display_errors',0);
    require('classes/resident.class.php');
    $userdetails = $bmis->get_userdata();
    $bmis->validate_admin();
    $bmis->reject_rescert();
    $bmis->approved_rescert();
    $bmis->create_certofindigency();

    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
    $limit = 5;
    $offset = ($currentPage - 1) * $limit;

    list($view, $moreRecords) = $bmis->view_certofres($limit, $offset);
    
?>

<?php 
    include('dashboard_sidebar_start.php');
?>

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

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-flex justify-content-between mb-3">
        <h4 class="text-center mb-0">Walk'in Request</h4>
        <a href="admn_certofindigency.php" class="btn btn-primary">Back</a>
    </div>

    <div class="container">
        <div class="card p-3">
            <form method="post" enctype="multipart/form-data">
                <div class="row"> 
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lname">Last Name:</label>
                                <input name="lname" type="text" class="form-control" 
                                placeholder="Enter Last Name">
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="fname">First Name:</label>
                                <input name="fname" type="text" class="form-control" 
                                placeholder="Enter First Name">
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mi">Middle Name: </label>
                                <input name="mi" type="text" class="form-control" 
                                placeholder="Enter Middle Name">
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="mtop">Nationality: </label>
                                <input type="text" class="form-control" name="nationality"   
                                placeholder="Enter Nationality">
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
                                placeholder="Enter House No.">
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label> Street: </label>
                                <input type="text" class="form-control" name="street"  
                                placeholder="Enter Street"">
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
                                <label for="purposes" class="mtop">Purposes:</label>
                                <select class="form-control" name="purpose" onchange="checkOptions(this)" id="purposes" required>
                                    <option value="">Choose your Purposes</option>
                                    <option value="Job/Employment">Job/Employment</option>
                                    <option value="Business Establishment">Business Requirement</option>
                                    <option value="Financial Transaction">Financial Transaction</option>
                                    <option value="Scholarship">Scholarship</option>
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

                    <div class="form-group" id="otherDiv" style="display: none">
                        <input type="text" class="form-control mt-3" name="otherInput" id='otherInput' placeholder="Enter Other" style="display: none" />
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <div class="col-md-12">
                        <button name="create_certofindigency" type="submit" class="btn btn-primary mt-3 w-100 p-2">Create Request</button>
                    </div>
                </div>
            </form>
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
<link href="../BarangaySystem/customcss/regiformstyle.css" rel="stylesheet" type="text/css">
<!-- bootstrap css --> 
<link href="../BarangaySystem/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"> 
<!-- fontawesome icons -->
<script src="https://kit.fontawesome.com/67a9b7069e.js" crossorigin="anonymous"></script>
<script src="../BarangaySystem/bootstrap/js/bootstrap.bundle.js" type="text/javascript"> </script>

<?php 
    include('dashboard_sidebar_end.php');
?>
