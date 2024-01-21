<?php
	// require the database connection
	require 'classes/conn.php';
	if(isset($_POST['search_certofres'])){
		$keyword = $_POST['keyword'];
?>
<table class="table table-hover text-center table-bordered table-responsive" >
    <thead class="alert-info">
        
    <tr>
        <th hidden> Resident ID </th>
        <th> Tracking ID </th>
        <th> Surname </th>
        <th> First Name </th>
        <th> Middle Name </th>
        <th> Age </th>
        <th> Nationality </th>
        <th> House Number </th>
        <th> Street </th>
        <th> Barangay </th>
        <th> Municipality </th>
        <th>Image</th>
        <th> Date </th>
        <th> Purpose </th>
        <th> Actions</th>
    </tr>
    </thead>

    <tbody>    
        <?php
            $stmnt = $conn->prepare("SELECT * FROM `tbl_rescert` WHERE 
                (`lname` LIKE '%$keyword%' or  `mi` LIKE '%$keyword%' or  `fname` LIKE '%$keyword%' 
                or `age` LIKE '%$keyword%' or  `id_resident` LIKE '%$keyword%' or  `nationality` LIKE '%$keyword%' 
                or  `houseno` LIKE '%$keyword%' or `street` LIKE '%$keyword%' or `brgy` LIKE '%$keyword%' 
                or `municipal` LIKE '%$keyword%' or `date` LIKE '%$keyword%' or `purpose` LIKE '%$keyword%' 
                or `track_id` LIKE '%$keyword%') AND deleted_at IS NULL");
            $stmnt->execute();
            
            while($view = $stmnt->fetch()){
        ?>
            <tr>
                <td hidden> <?= $view['id_resident'];?> </td> 
                <td> <?= $view['track_id'];?> </td> 
                <td> <?= $view['lname'];?> </td>
                <td> <?= $view['fname'];?> </td>
                <td> <?= $view['mi'];?> </td>
                <td> <?= $view['age'];?> </td>
                <td> <?= $view['nationality'];?> </td>
                <td> <?= $view['houseno'];?> </td>
                <td> <?= $view['street'];?> </td>
                <td> <?= $view['brgy'];?> </td>
                <td> <?= $view['municipal'];?> </td>
                <td>
                    <!-- checks photo exist -->
                    <?php if (is_null($view['certofres_photo'])): ?>
                        <span>No Image Available</span>
                    <?php else: ?>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#imageModal<?= $view['id_rescert']; ?>">View</button>
                
                        <!-- The Modal -->
                        <div class="modal fade" id="imageModal<?= $view['id_rescert']; ?>" tabindex="-1" role="dialog" aria-labelledby="imageModalTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="imageModalTitle"><?= $view['fname'];?> <?= $view['lname'];?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                
                                    <!-- Modal Body -->
                                    <div class="modal-body">
                                         <a href="<?= $view['certofres_photo'] ?>" target="_blank"><img src="<?php echo $view['certofres_photo']; ?>" class="img-fluid" alt="Modal Image"></a>
                                    </div>
                
                                    <!-- Modal Footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </td>
                <td> <?= $view['date'];?> </td>
                <td> <?= $view['purpose'];?> </td>
                <td>    
                    <form action="" method="post">
                        <!--<a class="btn btn-success" target="blank" style="width: 90px; font-size: 17px; border-radius:30px; margin-bottom: 2px;" href="rescert_form.php?id_resident=<?= $view['id_resident'];?>">Generate</a> -->
                        <a href="generatePdf/generate_residency.php?pdf=1&id=<?= $view['id_resident']; ?>" class="btn btn-success" style="width: 90px; font-size: 17px; border-radius:30px; margin-bottom: 2px;" target='_blank'>Generate</a>
                        <input type="hidden" name="id_rescert" value="<?= $view['id_rescert'];?>">
                        <button class="btn btn-danger" style="width: 90px; font-size: 17px; border-radius:30px;" type="submit" name="delete_certofres" onclick="return confirm('Are you sure you want to archive this data?')"> Archive </button>
                    </form>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>

</table>

<?php		
	}else{
?>

<table class="table table-hover text-center table-bordered table-responsive">
		<thead class="alert-info">
			<tr>
                <th hidden> Resident ID </th>
                <th> Tracking ID </th>
                <th> Full Name </th>
                <th> Age </th>
                <th> Nationality </th>
                <th> Address </th>
                <th>Image</th>
                <th> Date </th>
                <th> Purpose </th>
                <th> Actions</th>
			</tr>
		</thead>

		<tbody>
		    <?php if(is_array($view)) {?>
                <?php foreach($view as $view) {?>
                    <tr>
                        <td hidden> <?= $view['id_resident'];?> </td> 
                        <td> <?= $view['track_id'];?> </td> 
                        <td> <?= $view['lname'];?>, <?= $view['fname'];?> <?= $view['mi'];?>  </td>
                        <td> <?= $view['age'];?> </td>
                        <td> <?= $view['nationality'];?> </td>
                        <td> <?= $view['houseno'];?>, <?= $view['street'];?>, <?= $view['brgy'];?>,<?= $view['municipal'];?> </td>
                        <td>
                            <!-- checks photo exist -->
                            <?php if (is_null($view['certofres_photo'])): ?>
                                <span>No Image Available</span>
                            <?php else: ?>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#imageModal<?= $view['id_rescert']; ?>">View</button>
                        
                                <!-- The Modal -->
                                <div class="modal fade" id="imageModal<?= $view['id_rescert']; ?>" tabindex="-1" role="dialog" aria-labelledby="imageModalTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                        
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="imageModalTitle"><?= $view['fname'];?> <?= $view['lname'];?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                        
                                            <!-- Modal Body -->
                                            <div class="modal-body">
                                                <a href="<?= $view['certofres_photo'] ?>" target="_blank"><img src="<?php echo $view['certofres_photo']; ?>" class="img-fluid" alt="Modal Image"></a>
                                            </div>
                        
                                            <!-- Modal Footer -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                        
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td> <?= $view['date'];?> </td>
                        <td> <?= $view['purpose'];?> </td>
                        <td width="20%">    
                            <form action="" method="post">
                                <!--<a class="btn btn-success" target="blank" style="width: 90px; font-size: 17px; border-radius:30px; margin-bottom: 2px;" href="rescert_form.php?id_resident=<?= $view['id_resident'];?>">Generate</a> -->
                                <a href="generatePdf/generate_residency.php?pdf=1&id=<?= $view['id_resident']; ?>" class="btn btn-success" target='_blank'>Generate</a>
                                <input type="hidden" name="id_rescert" value="<?= $view['id_rescert'];?>">
                                <button class="btn btn-danger" type="submit" name="delete_certofres" onclick="return confirm('Are you sure you want to archive this data?')"> Archive </button>
                            </form>
                        </td>
                    </tr>
                <?php
                    }
                ?>
			<?php
				}
			?>
		</tbody>

	</table>

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
	}
$con = null;
?>