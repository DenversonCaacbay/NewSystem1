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
<link rel="stylesheet" href="css/table.css"/>
<!-- Begin Page Content -->

<div class="container-fluid page--container">

    <!-- Page Heading -->

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="text-center mb-0">Barangay Staff Data</h4>
        <button type="button" class="btn btn-primary ml-auto"  data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add Staff
        </button>
    </div>
    <!-- Modal Add Staff -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Staff</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="post" class="was-validated" autocomplete="off"> 
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label>Select Position:</label>
                                        <select class="form-select" name="position" required>
                                            <option></option>
                                            <option value="Secretary">Secretary</option>
                                            <option value="Kagawad">Kagawad</option>
                                        </select>
                                    </div>
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
                                            <input type="email" class="form-control" id="email" name="email" value="" placeholder="Enter Email" autocomplete="false" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                    
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Password:</label>
                                            <input type="password" class="form-control" id="password-field" name="password" placeholder="Enter Password" autocomplete="new-password" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label>Confirm Password:</label>
                                            <input type="password" class="form-control" id="confirm-password-field" name="confirm_password" placeholder="Enter Confirm Password"  required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Password do not match.</div>
                                        </div>
                                        <div class="form-check" style="margin-left: 34%">
                                            <input class="form-check-input" type="checkbox" value="" id="show-password-checkbox">
                                            <label class="form-check-label" for="show-password-checkbox">
                                                Show Password
                                            </label>
                                        </div>
                                    </div>
                                </div>


                                <input type="hidden" class="form-control" name="role" value="administrator">

                                <button class="btn btn-primary w-100 mt-3 p-2" type="submit" name="add_staff" id="submit-button" style="border-radius:10px;" disabled> Submit </button>  
                            </form>    
                        </div>
                    </div>
                </div>
            </div>

    <div class="row"> 
        <div class="col-md-12">
           <table class="table table-hover text-center table-bordered " id="dataTable" width="100%" cellspacing="0">
                <form action="" method="post">
                    <thead class="alert-info"> 
                        <tr>
                            <th> Position </th>
                            <th> Email </th>
                            <th> Surname </th>
                            <th> First name </th>
                            <th> Middle Name </th>
                            <th hidden> Role </th>
                            <th> Status </th>
                            <th> Actions </th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if(is_array($view)) {?>
                            <?php foreach($view as $viewItem) {?>
                                <tr>
                                    <td><?= $viewItem['position'];?></td>
                                    <td><?= $viewItem['email'];?></td>
                                    <td><?= $viewItem['lname'];?></td>
                                    <td><?= $viewItem['fname'];?></td>
                                    <td><?= $viewItem['mi'];?></td>
                                    <td hidden><?= $viewItem['role'];?></td>
                                    <td><?= $viewItem['status'];?></td>
                                    <td>    
                                        <form action="" method="post">
                                            <a href="update_staff_form.php?id_user=<?= $viewItem['id_admin'];?>" class="btn btn-primary">Update</a>
                                            <input type="hidden" name="id_user" value="<?= $viewItem['id_admin'];?>">
                                            <?php if ($viewItem['status'] == 'active') {?>
                                                <button class="btn btn-danger" type="submit" name="deactivate_staff" onclick="return confirm('Are you sure you want to Deactivate this Account?')">Deactivate</button>
                                            <?php } elseif ($viewItem['status'] == 'deactivate') {?>
                                                <button class="btn btn-primary" type="submit" name="activate_staff" onclick="return confirm('Are you sure you want to Activate this Account?')">Activate</button>
                                            <?php } ?>
                                        </form>
                                    </td>
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
<script>
    window.onload = function() {
        document.getElementById("email").value = "";
        document.getElementById("password-field").value = "";
        // Repeat for other form fields if needed
    }
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const passwordField = document.getElementById("password-field");
        const confirmPasswordField = document.getElementById("confirm-password-field");
        const showPasswordCheckbox = document.getElementById("show-password-checkbox");
        const submitButton = document.getElementById("submit-button");

        function togglePasswordVisibility() {
            const type = showPasswordCheckbox.checked ? 'text' : 'password';
            passwordField.type = type;
            confirmPasswordField.type = type;
        }

        showPasswordCheckbox.addEventListener('change', togglePasswordVisibility);

        function checkPasswords() {
            if (passwordField.value === confirmPasswordField.value) {
                confirmPasswordField.setCustomValidity('');
                submitButton.disabled = false;
            } else {
                confirmPasswordField.setCustomValidity('Passwords do not match.');
                submitButton.disabled = true;
            }
        }

        passwordField.addEventListener("keyup", checkPasswords);
        confirmPasswordField.addEventListener("keyup", checkPasswords);
    });
</script>


<script src="js/password-match.js"></script>

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