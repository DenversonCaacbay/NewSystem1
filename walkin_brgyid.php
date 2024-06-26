<?php
    
    error_reporting(E_ALL ^ E_WARNING);
    ini_set('display_errors',0);
    require('classes/resident.class.php');
    $userdetails = $bmis->get_userdata();
    $bmis->validate_admin();
    $bmis->reject_rescert();
    $bmis->approved_rescert();
    $bmis->create_brgyid_walkin();
    // $view = $bmis->view_certofres();
    // $id_resident = $_GET['id_resident'];
    // $resident = $residentbmis->get_single_certofres($id_resident);
    // $resident = view_certofres();

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
        <a href="admn_brgyid.php" class="btn btn-primary">Back</a>
    </div>

    <div class="container">
        <div class="card p-3">
            <form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-4">
                        <label for="formGroupExampleInput" class="form-label">First Name</label>
                        <input type="text" name="fname" class="form-control" id="formGroupExampleInput" required />
                    </div>
                    <div class="col-md-4">
                        <label for="formGroupExampleInput" class="form-label">Middle Name</label>
                        <input type="text" name="mi" class="form-control" id="formGroupExampleInput" placeholder="" required />
                    </div>
                    <div class="col-md-4">
                        <label for="formGroupExampleInput" class="form-label">Last Name</label>
                        <input type="text" name="lname" class="form-control" id="formGroupExampleInput" placeholder="" required />
                    </div>

                    <div class="col-md-6 mt-3">
                        <div class="form-group">
                            <label for="Date"class="mtop">Date of Birth </label>
                            <input name="bdate" id="myDateInput" onchange="checkBdate('myDateInput')" type="date" class="form-control" required />
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                    </div>

                    <div class="col-md-6 mt-3">
                        <div class="form-group">
                            <label class="mtop">Birth Place </label>
                            <input type="text" class="form-control" name="bplace"  
                            placeholder="Enter Birth Place" required />
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                    </div>  

                    <!-- Address -->
                    <div class="col-md-3 mt-3">
                        <label for="formGroupExampleInput" class="form-label">House No:</label>
                        <input type="text" name="houseno" class="form-control" id="formGroupExampleInput" placeholder="" required />
                    </div>
                    <div class="col-md-3 mt-3">
                        <label for="formGroupExampleInput" class="form-label">Street</label>
                        <input type="text" name="street" class="form-control" id="formGroupExampleInput" placeholder="" required />
                    </div>
                    <div class="col-md-3 mt-3">
                        <label for="formGroupExampleInput" class="form-label">Barangay</label>
                        <input type="text" name="brgy" class="form-control" id="formGroupExampleInput" value="Sta. Rita" placeholder="" readonly>
                    </div>
                    <div class="col-md-3 mt-3">
                        <label for="formGroupExampleInput" class="form-label">Municipality</label>
                        <input type="text" name="municipality" class="form-control" id="formGroupExampleInput" value="Olongapo City" placeholder="" readonly>
                    </div>
                    
                    <div class="col-md-12 mt-3">
                        <label for="formGroupExampleInput"  id="purpose" class="form-label">Purpose:</label>
                        <select name="purpose" class="form-select" onchange="checkOptions(this)">
                            <option>Choose Purpose</option>
                            <option>Job / Employment</option>
                            <option>Business Establishment</option>
                            <option>Financial Transaction</option>
                            <option>Certify that you are living in a certain barangay</option>
                            <option value="Other">Other</option>
                        </select>
                        <div class="form-group" id="otherDiv" style="display: none">
                            <input type="text" class="form-control mt-3" name="otherInput" id='otherInput' placeholder="Enter Other" style="display: none" />
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                    </div>

                    <div style="width: 100%; height:3px; background:#309464;margin-top:20px ;border-radius: 5px"></div>
                    <h6 class="mt-3 fw-bold">In Case of Emergency :</h6>
                    <div style="width: 170px; height:3px; background:#309464;margin: 0px 10px 10px 10px;border-radius: 5px"></div>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="fname">First Name:</label>
                                <input name="inc_fname" type="text" class="form-control" placeholder="Enter First Name" required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mi" class="mtop">Middle Name </label>
                                <input name="inc_mi" type="text" class="form-control" placeholder="Enter Middle Name" required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lname">Last Name:</label>
                                <input name="inc_lname" type="text" class="form-control" placeholder="Enter Last Name" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">            
                                <label for="cno">Contact Number:</label>
                                <input name="inc_contact" type="text" maxlength="11" class="form-control" pattern="[0-9]{11}" placeholder="Enter Contact Number" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label> House No: </label>
                                <input type="text" class="form-control" name="inc_houseno"  placeholder="Enter House No." required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label> Street: </label>
                                <input type="text" class="form-control" name="inc_street"  placeholder="Enter Street" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label> Barangay: </label>
                                <input type="text" class="form-control" name="inc_brgy"  placeholder="Enter Barangay" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label> Municipality: </label>
                                <input type="text" class="form-control" name="inc_municipal" placeholder="Enter Municipality" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3 d-none">
                            <label for="formGroupExampleInput" class="form-label">Date: </label>
                            <input type="date" name="date" class="form-control" id="formGroupExampleInput" value="<?php echo date('Y-m-d'); ?>">
                        </div>
                        <div class="col-md-6 mt-3 d-none">
                            <label for="formGroupExampleInput" class="form-label">Urgent</label>
                            <input type="text" name="is_urgent" class="form-control" value="Walk In" id="formGroupExampleInput" placeholder="">
                        </div>
                    
                    <div class="col-md-12">
                        <button name="create_brgyid_walkin" type="submit" class="btn btn-primary mt-3 w-100 p-2">Create Request</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    
    <!-- /.container-fluid -->
    
</div>
<!-- End of Main Content -->

<script src="js/bdate-checker.js" type="text/javascript"> </script>
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
