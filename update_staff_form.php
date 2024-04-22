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
    $id_user = $_GET['id_user'];
    $staff = $staffbmis->get_single_staff($id_user);
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
        <div class="col-md-2"></div>
        <div class="col-md-8">
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
        <div class="col-md-2"> </div>
    </div>
    
    <br>
</div>
<!-- /.container-fluid -->

<!-- End of Main Content -->

<?php 
    include('dashboard_sidebar_end.php');
?>