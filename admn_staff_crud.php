<?php
    ini_set('display_errors',0);
    error_reporting(E_ALL ^ E_WARNING);
    require('classes/staff.class.php');
    require('classes/resident.class.php');
    $userdetails = $bmis->get_userdata();
    $bmis->validate_admin();
    $view = $staffbmis->view_staff();
    $staffbmis->create_staff();
    $upstaff = $staffbmis->update_staff();
    $staffbmis->delete_staff();
    $staffcount = $staffbmis->count_staff();
    
?>

<?php 
    include('dashboard_sidebar_start.php');
?>
<!-- Begin Page Content -->

<div class="container-fluid">

    <!-- Page Heading -->

    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="text-center mb-0">Barangay Staff Data</h1>
            <button type="button" class="btn btn-primary ml-auto me-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add Staff
            </button>
            <div class="card border-left-primary shadow">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Number of Staff Registered</div>
                                <div class="h5 mb-0 font-weight-bold text-dark"><?= $staffcount?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-tie fa-2x text-dark"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Stafft</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="post" class="was-validated"> 
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label> Last Name: </label>
                                            <input type="text" class="form-control" name="lname" value="<?php echo isset($_POST['lname']) ? htmlspecialchars($_POST['lname']) : ''; ?>" placeholder="Enter Last Name" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                    
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="mtop" >First Name: </label>
                                            <input type="text" class="form-control" name="fname" value="<?php echo isset($_POST['fname']) ? htmlspecialchars($_POST['fname']) : ''; ?>" placeholder="Enter First Name" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col"> 
                                        <div class="form-group">
                                            <label class="mtop"> Middle Initial: </label>
                                            <input type="text" class="form-control" name="mi" maxlength="1" value="<?php echo isset($_POST['mi']) ? htmlspecialchars($_POST['mi']) : ''; ?>" placeholder="Enter Middle Initial" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row"> 
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Email: </label>
                                            <input type="email" class="form-control" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" placeholder="Enter Email" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                    
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Password:</label>
                                            <input type="password" class="form-control" id="password-field" name="password" placeholder="Enter Password" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label>Confirm Password:</label>
                                            <input type="password" class="form-control" id="password-field" name="confirm_password" placeholder="Enter Confirm Password" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                </div>


                                <input type="hidden" class="form-control" name="role" value="administrator">

                                <br>
                                <hr>

                                <button class="btn btn-primary w-100" type="submit" name="add_staff" style="border-radius:10px;"> Submit </button>  
                            </form>    
                        </div>
                    </div>
                </div>
            </div>
    <hr>

    <div class="row"> 
        <div class="col-md-12">
           <table class="table table-hover text-center table-bordered " id="dataTable" width="100%" cellspacing="0">
                <form action="" method="post">
                    <thead class="alert-info"> 
                        <tr>
                            <th> Actions </th>
                            <th> Email </th>
                            <th> Surname </th>
                            <th> First name </th>
                            <th> Middle Name </th>
                            <th> Role </th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if(is_array($view)) {?>
                            <?php foreach($view as $view) {?>
                                <tr>
                                    <td>    
                                        <form action="" method="post">
                                            <a href="update_staff_form.php?id_user=<?= $view['id_admin'];?>" class="btn btn-success"> Update </a>
                                            <input type="hidden" name="id_user" value="<?= $view['id_admin'];?>">
                                            <button class="btn btn-danger" type="submit" name="delete_staff" onclick="return confirm('Are you sure you want to archive this data?')"> Archive </button>
                                        </form>
                                    </td>
                                    <td> <?= $view['email'];?> </td>
                                    <td> <?= $view['lname'];?> </td>
                                    <td> <?= $view['fname'];?> </td>
                                    <td> <?= $view['mi'];?> </td>
                                    <td> <?= $view['role'];?> </td>
                                </tr>
                            <?php }?>
                        <?php } ?>
                    </tbody>
                </form>
            </table>
        </div>
    </div>
</div>

<!-- End of Main Content -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/js/bootstrap-modalmanager.min.js" integrity="sha512-/HL24m2nmyI2+ccX+dSHphAHqLw60Oj5sK8jf59VWtFWZi9vx7jzoxbZmcBeeTeCUc7z1mTs3LfyXGuBU32t+w==" crossorigin="anonymous"></script>
<!-- responsive tags for screen compatibility -->
<meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no">
<!-- custom css --> 
<link href="..//customcss/regiformstyle.css" rel="stylesheet" type="text/css">
<!-- bootstrap css --> 
<link href="..//bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"> 
<!-- fontawesome icons -->
<script src="https://kit.fontawesome.com/67a9b7069e.js" crossorigin="anonymous"></script>
<script src="..//bootstrap/js/bootstrap.bundle.js" type="text/javascript"> </script>

<?php 
    include('dashboard_sidebar_end.php');
?>