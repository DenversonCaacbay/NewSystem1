
<?php
	// require the database connection
	require 'classes/conn.php';
	if(isset($_POST['search_resident'])){
		$keyword = $_POST['keyword'];
?>
	<table class="table table-hover text-center responsive table-bordered" >

		<thead class="alert-info sticky-top">
			<tr>
                <th width="20%"> Actions</th>
                <th width="20%"> Email </th>
                <th width="20%"> Full Name </th>
                <th width="5%"> Age </th>
                <!-- <th width="20%"> Address </th> -->
                <th width="10%"> Contact # </th>
                <th width="5%">Verification ID</th>
                <th width="5%"> View </th>
			</tr>
		</thead>

		<tbody>       
			<?php
				
				$stmnt = $conn->prepare("SELECT * FROM `tbl_resident` WHERE `lname` LIKE '%$keyword%' or  `mi` LIKE '%$keyword%' or  `fname` LIKE '%$keyword%' 
				or  `age` LIKE '%$keyword%' or  `sex` LIKE '%$keyword%' or  `status` LIKE '%$keyword%' or  `address` LIKE '%$keyword%' or  `contact` LIKE '%$keyword%'
				or  `bdate` LIKE '%$keyword%' or  `bplace` LIKE '%$keyword%' or  `nationality` LIKE '%$keyword%' or  `family_role` LIKE '%$keyword%' or  `role` LIKE '%$keyword%' or  `email` LIKE '%$keyword%' WHERE verified='Pending'");
				$stmnt->execute();
				
				while($view = $stmnt->fetch()){
			?>
                <tr>
                        <td> <?= $view['email'];?> </td>
                        <td> <?= $view['lname'];?>, <?= $view['fname'];?> <?= $view['mi'];?> </td>
                        <td> <?= $view['age'];?> </td>
                        <!-- <td style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 10ch;">
    <?= $view['houseno'];?>, <?= $view['street'];?>, <?= $view['brgy'];?>
</td> -->
                        <td> <?= $view['contact'];?> </td>
                        <td>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="openModal('<?= $view['valid_id_photo'] ?>', '<?= $view['lname'];?>', '<?= $view['fname'];?> <?= $view['mi'];?>')">
                                <img src="<?= $view['valid_id_photo'] ?>" class="pending--img" alt="Modal Image">
                            </a></td>
                        <td width="20%">    
                            <form action="" method="post">
                                <!-- <a href="update_resident_form.php?id_resident=<?= $view['id_resident'];?>" class="btn btn-success">  Update </a> -->
                                <input type="hidden" name="id_resident" value="<?= $view['id_resident'];?>">
                                <input type="hidden" name="email" value="<?= $view['email'];?>">
                                <a class="btn btn-table btn-primary" href="admn_view_pending_details.php?id_resident=<?= $view['id_resident'];?>" name=""> View </a>
                                <button class="btn btn-table btn-primary" type="submit" name="approve_resident" onclick="return confirm('Are you sure you want to approve this data?')"> Approve </button>
                                <button class="btn btn-table btn-danger" type="submit" name="decline_resident" onclick="return confirm('Are you sure you want to decline this data?')"> Decline </button>
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


<table class="table table-hover table-bordered text-center">
    <thead class="sticky-top">
		<tr>
            <th> Full Name </th>
            <th> Email </th>
            <th> Age </th>
            <th> Contact # </th>
            <th> Verification ID </th>
            <th> Actions</th>
		</tr>
	</thead>

		<tbody>
		    <?php if(is_array($view)) {?>
                <?php foreach($view as $view) {?>
                    <tr>                    
                        
                        
                        <td> <?= $view['lname'];?>, <?= $view['fname'];?> <?= $view['mi'];?> </td>
                        <td> <?= $view['email'];?> </td>
                        <td> <?= $view['age'];?> </td>
                        <!-- <td style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 10ch;">
                        <?= $view['houseno'];?>, <?= $view['street'];?>, <?= $view['brgy'];?>
                        </td> -->

                        <td> <?= $view['contact'];?> </td>
                        <td>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="openModal('<?= $view['valid_id_photo'] ?>', '<?= $view['lname'];?>', '<?= $view['fname'];?> <?= $view['mi'];?>')">
                                <img src="<?= $view['valid_id_photo'] ?>" class="pending--img" alt="Modal Image">
                            </a>
                        </td>
                        <td width="20%">    
                            <form action="" method="post">
                                <!-- <a href="update_resident_form.php?id_resident=<?= $view['id_resident'];?>" class="btn btn-success">  Update </a> -->
                                <input type="hidden" name="id_resident" value="<?= $view['id_resident'];?>">
                                <input type="hidden" name="email" value="<?= $view['email'];?>">
                                <a class="btn btn-primary" href="admn_view_pending_details.php?id_resident=<?= $view['id_resident'];?>" name=""> View </a>
                                <!-- <button class="btn btn-table btn-primary" type="submit" name="approve_resident" onclick="return confirm('Are you sure you want to approve this data?')"> <i class="fas fa-check"></i> </button>
                                <button class="btn btn-table btn-danger" type="submit" name="decline_resident" onclick="return confirm('Are you sure you want to decline this data?')"> <i class="fas fa-times"></i> </button> -->
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
<?php
	}
$con = null;
?>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"> Picture</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Modal image -->
                <img id="modalImage" class="img-fluid" alt="Modal Image" width="100%">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript function to open the modal, set the image source, and update the modal title
    function openModal(imageSrc, lname, fname) {
        console.log("Opening modal with image source and fullname:", imageSrc, lname, fname);

        // Assuming modalImage is the ID of your image element in the modal
        document.getElementById('modalImage').src = imageSrc;

        // Assuming modalTitle is the class of your modal title element
        document.querySelector('.modal-title').textContent = lname + ', ' + fname + '- Verification ID';
    }
</script>