<?php
    
   error_reporting(E_ALL ^ E_WARNING);
   ini_set('display_errors',0);
   require('classes/resident.class.php');
   $userdetails = $bmis->get_userdata();
   $bmis->validate_admin();
//    $view = $residentbmis->view_resident();

   $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
   $limit = 5;
   $offset = ($currentPage - 1) * $limit;

   list($view, $moreRecords) = $residentbmis->view_resident($limit, $offset);


   $residentbmis->create_resident();
   $residentbmis->update_resident();
   $residentbmis->delete_resident();
   
   //    
   $residentbmis->approve_resident();
   $residentbmis->decline_resident();
// Not useable
//    $rescount = $residentbmis->count_resident();
//    $rescountm = $residentbmis->count_male_resident();
//    $rescountf = $residentbmis->count_female_resident();
//    $rescountfh = $residentbmis->count_head_resident();
//    $rescountfm = $residentbmis->count_member_resident();
   
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
        margin-bottom: 20px;
        margin-left: 0%;
    }
        
    .icon {
        padding: 10px;
        min-width: 40px;
    }

    .search{
        text-align: center;
    }
</style>

    <!-- Begin Page Content -->
    <div class="container-fluid page--container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="text-center mb-0 ms-2">Viewing Pending Accounts</h4>

            
            

            <button type="button" class="btn btn-primary ml-auto me-3" data-bs-toggle="modal" data-bs-target="#register">Register Resident</button>
            <?php $registered_users = $residentbmis->count_registered_resident(); ?>
                            
            <a href="admn_resident_approved.php" class="me-3">Approved Residents</a>
            <a class="me-3">/</a>
            <a href="admn_resident_disapproved.php" class="me-3">Declined Residents</a>
            <a class="me-3">/</a>
            <a href="admn_resident_banned.php">Banned Residents</a>
            
        </div>

        <!-- Page Heading -->
                    
        <!-- <div class="row"> 

            <div class="col-md-3"> 
                <div class="card border-left-primary shadow">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-color text-uppercase mb-1">
                                Number of Approved Residents</div>
                                    <div class="h5 mb-0 font-weight-bold text-dark"><?= $rescount ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-friends fa-2x text-dark"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3"> 
                <div class="card border-left-primary shadow">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-color text-uppercase mb-1">
                                Total Household Head</div>
                                    <div class="h5 mb-0 font-weight-bold text-dark"><?= $rescountfh ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-dark"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3"> 
                <div class="card border-left-primary shadow">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-color text-uppercase mb-1">
                                Total Male Residents</div>
                                    <div class="h5 mb-0 font-weight-bold text-dark"><?= $rescountm ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-male fa-2x text-dark"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3"> 
                <div class="card border-left-primary shadow">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-color text-uppercase mb-1">
                                Total Female Residents</div>
                                    <div class="h5 mb-0 font-weight-bold text-dark"><?= $rescountf ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-female fa-2x text-dark"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div> -->


        <div class="col-md-12 mt-4">
            <form method="POST" action="">
                <div class="input-icons w-100 d-flex">
                    <i class="fa fa-search icon"></i>
                    <input type="search" class="form-control search" name="keyword" value="" required=""/>
                    <button class="btn btn-success ms-3" name="search_resident">Search</button>
                    <a href="admn_resident_crud.php" class="btn btn-info ms-3">Reload</a>
                </div>
			</form>
            <div class="row ">
                <div class="col-md-12 page--table">
                    <?php 
        
                        include('resident_register/resident_pending.php');
                    ?>
                </div>
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
<!-- Modal for Registering Residents -->
    <div class="modal fade" id="register" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Register Resident</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form method="post" class="was-validated" enctype='multipart/form-data'> 
                        <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="mtop">Last Name: </label>
                                            <input type="text" class="form-control" name="lname" placeholder="Enter Last Name" value="<?php echo isset($_POST['lname']) ? htmlspecialchars($_POST['lname']) : ''; ?>" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label class="mtop">First Name: </label>
                                            <input type="text" class="form-control" name="fname" placeholder="Enter First Name" value="<?php echo isset($_POST['fname']) ? htmlspecialchars($_POST['fname']) : ''; ?>" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label class="mtop">Middle Name: </label>
                                            <input type="text" class="form-control" name="mi" placeholder="Enter Middle Name" value="<?php echo isset($_POST['mi']) ? htmlspecialchars($_POST['mi']) : ''; ?>" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="mtop">Contact Number:</label>
                                            <input type="tel" class="form-control" name="contact" maxlength="11" pattern="[0-9]{11}" placeholder="Enter Contact Number" value="<?php echo isset($_POST['contact']) ? htmlspecialchars($_POST['contact']) : ''; ?>" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label class="mtop">Email: </label>
                                            <input type="email" class="form-control" name="email" placeholder="Enter Email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row" hidden>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Password:</label>
                                            <input type="password" class="form-control" id="password-field" value="pass1234" name="password" placeholder="Enter Password" required>
                                            <!--<span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>-->
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label>Confirm Password:</label>
                                            <input type="password" class="form-control" id="confirm-password-field" value="pass1234" name="confirm_password" placeholder="Enter Confirm Password" required>
                                            <!--<span toggle="#confirm-password-field" class="fa fa-fw fa-eye field-icon toggle-confirm-password"></span>-->
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label> House No: </label>
                                            <input type="text" class="form-control" name="houseno" placeholder="Enter House No." value="<?php echo isset($_POST['houseno']) ? htmlspecialchars($_POST['houseno']) : ''; ?>" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label> Purok: </label>
                                            <select id="purokDropdown" class="form-select" onchange="showStreets(this.value)" name="purok" aria-label="Default select example" required>
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
                                    
                                    <div class="col">
                                        <div class="form-group">
                                            <label> Street: </label>
                                            <select id="streetsDropdown" class="form-select" name="street" disabled required style="text-transform: none !important;">
                                                <option value="" disabled selected>Select Street</option>
                                            </select>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label> Barangay: </label>
                                            <input type="text" class="form-control" name="brgy" placeholder="Enter Barangay" value="Sta.Rita" readonly>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label> Municipality: </label>
                                            <input type="text" class="form-control" name="municipal" placeholder="Enter Municipality" value="Olongapo City" readonly>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="mtop">Birth Date: </label>
                                            <input type="date" class="form-control" id="myDateInput" onchange="checkBdate('myDateInput')" name="bdate" value="<?php echo isset($_POST['bdate']) ? htmlspecialchars($_POST['bdate']) : ''; ?>" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label class="mtop">Birth Place </label>
                                            <input type="text" class="form-control" name="bplace" placeholder="Enter Birth Place" value="<?php echo isset($_POST['bplace']) ? htmlspecialchars($_POST['bplace']) : ''; ?>" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label class="mtop">Nationality: </label>
                                            <input type="text" class="form-control" name="nationality" placeholder="Enter Nationality" value="<?php echo isset($_POST['nationality']) ? htmlspecialchars($_POST['nationality']) : ''; ?>" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="formFile" class="form-label mt-1"  style="font-size:15px;">Valid ID with an address or any proof of billing. </label>
                                            <input class="form-control" type="file" id="formFile" name="id_picture" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-label mt-1">When did you live in this barangay? </label>
                                            <input type="date" class="form-control" id="myDateInput" onchange="checkBdate('myDateInput')" name="date_live" value="<?php echo isset($_POST['date_live']) ? htmlspecialchars($_POST['date_live']) : ''; ?>" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="mtop">Status: </label>
                                            <select class="form-control" name="status" id="status" required>
                                                <option value="" <?php echo empty($_POST['status']) ? 'selected' : ''; ?>>Choose your Status</option>
                                                <option value="Single">Single</option>
                                                <option value="Married">Married</option>
                                                <option value="Widowed">Widowed</option>
                                                <option value="Divorced">Divorced</option>
                                            </select>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label class="mtop">Sex</label>
                                            <select class="form-control" name="sex" id="sex" required>
                                                <option value="" <?php echo empty($_POST['sex']) ? 'selected' : ''; ?>>Choose your Sex</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col">
                                        <div class="form-group">
                                            <label class="mtop">Are you a registered voter? </label>
                                            <select class="form-control" name="voter" id="regvote" required>
                                                <option value="" <?php echo empty($_POST['voter']) ? 'selected' : ''; ?>>...</option>
                                                <option value="Yes" >Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label class="mtop">Are you head of the family? </label>
                                            <select class="form-control" name="family_role" id="famhead" required>
                                                <option value="" <?php echo empty($_POST['family_role']) ? 'selected' : ''; ?>>...</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <input type="hidden" class="form-control" name="role" value="resident">
                <input type="hidden" class="form-control" name="is_in_admin" value="1">
                            <button class="btn btn-primary" type="submit" name="add_resident"> Register </button>
                        </form>
            </div>
            </div>
        </div>
    </div>


    
    <!-- /.container-fluid -->
    
</div>
<!-- End of Main Content -->

<script src="js/password-match.js"></script>
<script src="js/purok-street.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/js/bootstrap-modalmanager.min.js" integrity="sha512-/HL24m2nmyI2+ccX+dSHphAHqLw60Oj5sK8jf59VWtFWZi9vx7jzoxbZmcBeeTeCUc7z1mTs3LfyXGuBU32t+w==" crossorigin="anonymous"></script>
<!-- responsive tags for screen compatibility -->
<meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no">
<!-- custom css --> 

<script src="https://kit.fontawesome.com/67a9b7069e.js" crossorigin="anonymous"></script>
<script src="../BarangaySystem/bootstrap/js/bootstrap.bundle.js" type="text/javascript"> </script>

<?php 
    include('dashboard_sidebar_end.php');
?>
