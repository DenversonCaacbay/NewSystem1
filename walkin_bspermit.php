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

    $bmis->create_bspermit_walkin();

    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
    $limit = 5;
    $offset = ($currentPage - 1) * $limit;

    list($view, $moreRecords) = $bmis->view_certofres($limit, $offset);
    
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
        <a href="admn_bspermit.php" class="btn btn-primary">Back</a>
    </div>

    <div class="container">
        <div class="card p-3">
            <form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="row"> 
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lname" class="mtop">Last Name:</label>
                                <input name="lname" type="text" class="form-control" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="fname" class="mtop">First Name:</label>
                                <input name="fname" type="text" class="form-control" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="mi" class="mtop">Middle Name </label>
                                <input name="mi" type="text" class="form-control"  required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="bsname">Business Name:</label>
                                <input name="bsname" type="text" class="form-control" placeholder="Enter Business Name" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                    </div>
                    <div style="width: 100%; height:3px; background:#309464;margin-top:20px ;border-radius: 5px"></div>
                    <h6 class="mt-3 fw-bold">Business Address:</h6>
                    <div style="width: 140px; height:3px; background:#309464;margin: 0px 10px 10px 10px;border-radius: 5px"></div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label> Purok: </label>
                                <select id="purokDropdown" class="form-select" onchange="showStreets(this.value)" name="houseno" aria-label="Default select example" required>
                                    <option value="" selected>Select Purok</option>
                                    <option value="1A">1A</option>
                                    <option value="1B">1B</option>
                                    <option value="2">2</option>
                                    <option value="3A">3A</option>
                                    <option value="3B">3B</option>
                                    <option value="3C">3C</option>
                                    <option value="3E">3E</option>
                                    <option value="3F">3F</option>
                                    <option value="4A">4A</option>
                                    <option value="4B">4B</option>
                                    <option value="4C">4C</option>
                                    <option value="4D">4D</option>
                                    <option value="5A">5A</option>
                                    <option value="5A-1">5A-1</option>
                                    <option value="5B">5B</option>
                                    <option value="5C">5C</option>
                                    <option value="5D">5D</option>
                                    <option value="5E">5E</option>
                                    <option value="5F">5F</option>
                                    <option value="6A">6A</option>
                                    <option value="6AEXT">6AEXT</option>
                                    <option value="6B1">6B1</option>
                                    <option value="6B2">6B2</option>
                                    <option value="6C1">6C1</option>
                                    <option value="6C2">6C2</option>
                                    <option value="6D">6D</option>
                                    <option value="6E">6E</option>
                                    <option value="7">7</option>
                                </select>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label> Street: </label>
                                <select id="streetsDropdown" class="form-select" name="street" disabled required style="text-transform: none !important;">
                                    <option value="" disabled selected>Select Street</option>
                                </select>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label> Barangay: </label>
                                <input type="text" class="form-control" name="brgy"  placeholder="Enter Barangay" value="Sta.Rita"  readonly>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label> Municipality: </label>
                                <input type="text" class="form-control" name="municipal" placeholder="Enter Municipality" value="Olongapo"  readonly>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status" class="mtop">Business Industry:</label>
                                <select class="form-control" name="bsindustry" id="status" placeholder="Enter Status" required>
                                <option value="">Choose your Business Industry</option>
                                    <option value="Computer">Computer</option>
                                    <option value="Telecommunication">Telecommunication</option>
                                    <option value="Agriculture">Agriculture</option>
                                    <option value="Construction">Construction</option>
                                    <option value="Education">Education</option>
                                    <option value="Pharmaceutical">Pharmaceutical</option>
                                    <option value="Food">Food</option>
                                    <option value="HealthCare">HealthCare</option>
                                    <option value="Hospitality">Hospitality</option>
                                    <option value="Entertainment">Entertainment</option>
                                    <option value="News Media">News Media</option>
                                    <option value="Energy">Energy</option>
                                    <option value="Manufacturing">Manufacturing</option>
                                    <option value="Music">Music</option>
                                    <option value="Mining">Mining</option>
                                    <option value="WorldWide Web">WorldWide Web</option>
                                    <option value="Electronics">Electronics</option>
                                    <option value="Transport">Pharmaceutical</option>
                                    <option value="Transport">Aerospace</option>
                                </select>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="aoe" class="mtop">Area of Establishment (SqM): </label>
                                <input type="number" name="aoe" class="form-control" placeholder="Enter your AOE" required>
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
                    <div class="col-md-6 mt-3 d-none">
                        <label for="formGroupExampleInput" class="form-label">Urgent</label>
                        <input type="text" name="is_urgent" class="form-control" value="Walk In" id="formGroupExampleInput" placeholder="">
                    </div>
                    <div class="col-md-12">
                        <button name ="create_bspermit_walkin" type="submit" class="btn btn-primary mt-3 w-100 p-2">Create Request</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    
    <!-- /.container-fluid -->
    
</div>
<!-- End of Main Content -->

<script src="js/purok-street.js"></script>
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
