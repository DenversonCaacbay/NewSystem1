<?php
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
    $id_user = $_GET['id_admin'];
    $staff = $staffbmis->get_single_staff($id_user);

    $staffbmis->update_staff_password();
?>

<?php 
    include('dashboard_sidebar_start.php');
?>
<link rel="stylesheet" href="css/table.css"/>
<!-- Begin Page Content -->

<div class="container-fluid page--container">
    <div class="d-flex justify-content-between mb-3">
        <h4 class="text-center mb-0">Update Staff Data</h4>
        <a href="admn_staff_crud.php" class="btn btn-primary">
            Back
        </a>
    </div>

    <div class="row mt-5">
        <div class="col-md-7">
            <div class="card"> 
                <div class="card-header bg text-white">Barangay Staff Data </div>
                <div class="card-body text-center"> 
                    <form method="post">
                        <div class="row">
                            <div class="col">
                                <label class="form-group"> Last Name:</label>
                                <input type="text" class="form-control text-center" name="lname" placeholder="Enter Last Name" value="<?= $staff['lname'];?>" required>
                            </div>
                            <div class="col">
                                <label class="form-group" >First Name: </label>
                                <input type="text" class="form-control text-center" name="fname" placeholder="Enter First Name" value="<?= $staff['fname'];?>" required>
                            </div>
                            <div class="col">
                                <label class="form-group"> Middle Name: </label>
                                <input type="text" class="form-control text-center" name="mi" maxlength="1" placeholder="Enter Middle Name" value="<?= $staff['mi'];?>" required>
                            </div>
                        </div>
                        
                        <div class="row" style="margin-top: 1.1em;">
                            <div class="col">
                                <label class="form-group">Email: </label>
                                <input type="email" class="form-control text-center" name="email"  placeholder="Enter Email" value="<?= $staff['email'];?>" required>
                            </div>

                            <!-- make this in dropdown form -->
                            <div class="col" hidden>
                                <label class="form-group">Role: </label>
                                <input type="text" class="form-control text-center" name="role"  placeholder="Enter Role" value="<?= $staff['role'];?>" readonly>
                            </div>
                        </div>
                        <div class="mt-4">
                            <!-- <a href="admn_staff_crud.php" class="btn btn-danger"> Back </a> -->
                            <button class="btn btn-primary w-100 p-2" type="submit" name="update_staff">Update</button>
                        </div>
                        
                    </form>         
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header bg text-light">Change Password</div>
                <div class="card-body">
                    <form method="post">
                        <input type="hidden" name="id_admin" value="<?= $staff['id_admin']; ?>"/>
                        <label>New Password</label>
                        <input type="password" name="new_password" id="password-field" class="form-control"/>
                        <label class="mt-3">Confirm New Password</label>
                        <input type="password" name="confirm_password" id="confirm-password-field" class="form-control"/>
                        <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" value="" id="show-password-checkbox">
                            <label class="form-check-label" for="show-password-checkbox">
                                Show Password
                            </label>
                        </div>
                        <button class="btn btn-primary w-100 p-2 mt-3" type="submit" name="update_staff_password">Update Password</button>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
    
    <br>
</div>

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
<!-- /.container-fluid -->

<!-- End of Main Content -->

<?php 
    include('dashboard_sidebar_end.php');
?>