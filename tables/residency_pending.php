

<?php
	// require the database connection
	require 'classes/conn.php';
	if(isset($_POST['search_certofres'])){
		$keyword = $_POST['keyword'];
?>
<table class="table table-hover text-center table-bordered" >
    <thead class="alert-info sticky-top">
		<tr>
            <th hidden> Resident ID </th>
            <th class="bg text-light"> Date Requested </th>
            <th class="bg text-light"> Tracking ID </th>
            <th class="bg text-light"> Full Name </th>
            <th class="bg text-light"> Address </th>
            <th class="bg text-light"> Purpose </th>
            <th>Image</th>
            <th>Urgent</th>
            <th class="bg text-light"> Actions</th>
		</tr>
	</thead>

    <tbody>    
        <?php
           $stmnt = $conn->prepare("
           SELECT rc.*, r.email
           FROM tbl_rescert rc
           INNER JOIN tbl_resident r ON rc.id_resident = r.id_resident
           WHERE 
               (rc.`lname` LIKE '%$keyword%' OR rc.`mi` LIKE '%$keyword%' OR rc.`fname` LIKE '%$keyword%' 
               OR rc.`age` LIKE '%$keyword%' OR rc.`id_resident` LIKE '%$keyword%' OR rc.`nationality` LIKE '%$keyword%' 
               OR rc.`houseno` LIKE '%$keyword%' OR rc.`street` LIKE '%$keyword%' OR rc.`brgy` LIKE '%$keyword%' 
               OR rc.`municipal` LIKE '%$keyword%' OR rc.`date` LIKE '%$keyword%' OR rc.`purpose` LIKE '%$keyword%' 
               OR rc.`track_id` LIKE '%$keyword%') 
           AND rc.form_status='Pending'
       ");
            $stmnt->execute();
            
            while($view = $stmnt->fetch()){
        ?>
   <tr>
                        <td hidden> <?= $view['id_resident'];?> </td> 
                        <td> <?= $view['date'] ? date("F d, Y", strtotime($view['date'])) : "Walk in"; ?></td>
                        <td> <?= $view['track_id'];?> </td> 
                        <td> <?= $view['lname'];?>, <?= $view['fname'];?> <?= $view['mi'];?>  </td>
                        <td> <?= $view['houseno'];?>, <?= $view['street'];?>, <?= $view['brgy'];?>,<?= $view['municipal'];?> </td>
                        <td> <?= $view['purpose'];?> </td>
                        <td>
                            <?php if (is_null($view['certofres_photo'])): ?>
                                <span>No Image Available</span>
                            <?php else: ?>
                            <a href="#" data-toggle="modal" data-target="#imageModal<?= $view['id_rescert'] ?>">
                                <img src="<?= $view['certofres_photo'] ?>" class="pending--img" alt="Modal Image">
                            </a>
                            <div class="modal fade" id="imageModal<?= $view['id_rescert'] ?>" tabindex="-1" role="dialog" aria-labelledby="imageModalTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="imageModalTitle"><?= $view['fname'];?> <?= $view['lname'];?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <a href="<?= $view['certofres_photo'] ?>" target="_blank"><img src="<?= $view['certofres_photo'] ?>" class="img-fluid" alt="Modal Image"></a>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </td>
                        <td> <?= $view['is_urgent'] ?: "No" ;?> </td>
                        <td width="20%">    
                            <form action="" method="post">
                                <input type="hidden" name="id_rescert" value="<?= $view['id_rescert'];?>">
                                <input type="hidden" name="email" value="<?= $view['email'];?>">
                                <div class="d-flex justify-content-center">
                                    <a class="btn btn-primary btn--approve"  href="pdf_viewer_residency.php?pdf=1&id=<?= $view['id_rescert'];?>">View</i></a>
                                </div>
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

<table class="table table-hover text-center table-bordered responsive">
	<thead class="alert-info sticky-top">
		<tr>
            <th hidden> Resident ID </th>
            <th class="bg text-light"> Date Requested </th>
            <th class="bg text-light"> Date Created </th>
            <th class="bg text-light"> Tracking ID </th>
            <th class="bg text-light"> Full Name </th>
            <th class="bg text-light"> Address </th>
            <th class="bg text-light"> Purpose </th>
            <th>Image</th>
            <th>Urgent</th>
            <th class="bg text-light"> Actions</th>
		</tr>
	</thead>

		<tbody>
		    <?php if(is_array($view)) {?>
                <?php foreach($view as $view) {?>
                    <tr>
                        <td hidden> <?= $view['id_resident'];?> </td> 
                        <td> <?= $view['date'] ? date("F d, Y", strtotime($view['date'])) : "Walk in"; ?></td>
                        <td> <?= $view['created_at'] ? date("F d, Y - h:i:s A", strtotime($view['created_at'])) : "Walk in"; ?></td>
                        <td> <?= $view['track_id'];?> </td> 
                        <td> <?= $view['lname'];?>, <?= $view['fname'];?> <?= $view['mi'];?>  </td>
                        <td> <?= $view['houseno'];?>, <?= $view['street'];?>, <?= $view['brgy'];?>,<?= $view['municipal'];?> </td>
                        <td> <?= $view['purpose'];?> </td>
                        <td>
                            <?php if (is_null($view['certofres_photo'])): ?>
                                <span>No Image Available</span>
                            <?php else: ?>
                            <a href="#" data-toggle="modal" data-target="#imageModal<?= $view['id_rescert'] ?>">
                                <img src="<?= $view['certofres_photo'] ?>" class="pending--img" alt="Modal Image">
                            </a>
                            <div class="modal fade" id="imageModal<?= $view['id_rescert'] ?>" tabindex="-1" role="dialog" aria-labelledby="imageModalTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="imageModalTitle"><?= $view['fname'];?> <?= $view['lname'];?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <a href="<?= $view['certofres_photo'] ?>" target="_blank"><img src="<?= $view['certofres_photo'] ?>" class="img-fluid" alt="Modal Image"></a>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </td>
                        <td> <?= $view['is_urgent'] ?: "No" ;?> </td>
                        <td width="20%">    
                            <form action="" method="post">
                                <input type="hidden" name="id_rescert" value="<?= $view['id_rescert'];?>">
                                <input type="hidden" name="email" value="<?= $view['email'];?>">
                                <div class="d-flex justify-content-center">
                                    <a class="btn btn-primary btn--approve"  href="pdf_viewer_residency.php?pdf=1&id=<?= $view['id_rescert'];?>">View</i></a>
                                </div>
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