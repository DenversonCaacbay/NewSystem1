
<?php
	// require the database connection
	require 'classes/conn.php';
	if(isset($_POST['search_certofindigency'])){
		$keyword = $_POST['keyword'];
?>
<table class="table table-hover text-center table-bordered" >

<thead class="alert-info sticky-top">
        <tr>
            <th class="bg text-light"> Date Requested </th>
            <th class="bg text-light"> Tracking ID </th>
            <th class="bg text-light"> Full Name </th>
            <th class="bg text-light"> Address </th>
            <th class="bg text-light"> Purpose </th>
            
            <th class="bg text-light"> Image </th>
            <th class="bg text-light"> Urgent </th>
            <th class="bg text-light"> Actions</th>
        </tr>
    </thead>

    <tbody>     
        <?php
            
            $stmnt = $conn->prepare("
            SELECT ind.*, r.email
            FROM tbl_indigency ind
            INNER JOIN tbl_resident r ON ind.id_resident = r.id_resident
            WHERE 
                (
                    ind.`lname` LIKE '%$keyword%' OR  
                    ind.`mi` LIKE '%$keyword%' OR  
                    ind.`fname` LIKE '%$keyword%' OR  
                    ind.`track_id` LIKE '%$keyword%'
                )
                AND ind.`form_status` ='Pending'
        ");
            $stmnt->execute();
            
            while($view = $stmnt->fetch()){
        ?>
                <tr>
                    <td> <?= date("F d, Y", strtotime($view['date'])); ?></td>
                    <td> <?= $view['track_id'];?> </td> 
                    <td> <?= $view['lname'];?>, <?= $view['fname'];?> <?= $view['mi'];?></td>
                    <td> <?= $view['houseno'];?>, <?= $view['street'];?>, <?= $view['brgy'];?>, <?= $view['municipal'];?> </td>
                    <td> <?= $view['purpose'];?> </td>
                    
                    <td>
                        <?php if (is_null($view['certofindigency_photo'])): ?>
                            <span>No Image Available</span>
                        <?php else: ?>
                            <a href="#" data-toggle="modal" data-target="#imageModal<?= $view['id_indigency'] ?>">
                                <img src="<?= $view['certofindigency_photo'] ?>" class="pending--img" alt="Modal Image">
                            </a>
                    
                            <div class="modal fade" id="imageModal<?= $view['id_indigency'] ?>" tabindex="-1" role="dialog" aria-labelledby="imageModalTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="imageModalTitle"><?= $view['fname'];?> <?= $view['lname'];?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <a href="<?= $view['certofindigency_photo'] ?>" target="_blank"><img src="<?= $view['certofindigency_photo'] ?>" class="img-fluid" alt="Modal Image"></a>
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
                            <!--<a class="btn btn-success" target="blank" style="width: 90px; font-size: 17px; border-radius:30px; margin-bottom: 2px;" href="indigency_form.php?id_resident=<?= $view['id_resident'];?>">Generate</a> -->
                            <!-- <a href="generatePdf/generate_indigency.php?pdf=1&id=<?= $view['id_indigency']; ?>" class="btn btn-primary" target='_blank'><i class="fas fa-print p-1"></i></a> -->
                            <input type="hidden" name="id_indigency" value="<?= $view['id_indigency'];?>">
                            <input type="hidden" name="email" value="<?= $view['email'];?>">
                            <!-- <button class="btn btn-primary" type="submit" name="approved_indigency" onclick="return confirm('Are you sure you want to approved this request?')"> Approve </button> -->
                            <div class="d-flex justify-content-center">
                                <a class="btn btn-primary btn--approve"  href="pdf_viewer_indigency.php?pdf=1&id=<?= $view['id_indigency'];?>">View</i></a>
                                <!-- <button class="btn btn-danger btn--decline" type="submit" name="reject_indigency" onclick="return confirm('Are you sure you want to decline this request?')"> Decline </button> -->
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

<table class="table table-hover text-center table-bordered">
    <thead class="alert-info sticky-top">
        <tr>
            <th class="bg text-light"> Date Requested </th>
            <th class="bg text-light"> Date Created </th>
            <th class="bg text-light"> Tracking ID </th>
            <th class="bg text-light"> Full Name </th>
            <th class="bg text-light"> Address </th>
            <th class="bg text-light"> Purpose </th>
            
            <th class="bg text-light"> Image </th>
            <th class="bg text-light"> Urgent </th>
            <th class="bg text-light"> Actions</th>
        </tr>
    </thead>
    
    <tbody>
        <?php if(is_array($view)) {?>
            <?php foreach($view as $view) {?>
                <tr>
                    <td> <?= date("F d, Y", strtotime($view['date'])); ?></td>
                    <td> <?= date("F d, Y - h:i:s A", strtotime($view['created_at'])); ?></td>
                    <td> <?= $view['track_id'];?> </td> 
                    <td> <?= $view['lname'];?>, <?= $view['fname'];?> <?= $view['mi'];?></td>
                    <td> <?= $view['houseno'];?>, <?= $view['street'];?>, <?= $view['brgy'];?>, <?= $view['municipal'];?> </td>
                    <td> <?= $view['purpose'];?> </td>
                    
                    <td>
                        <?php if (is_null($view['certofindigency_photo'])): ?>
                            <span>No Image Available</span>
                        <?php else: ?>
                            <a href="#" data-toggle="modal" data-target="#imageModal<?= $view['id_indigency'] ?>">
                                <img src="<?= $view['certofindigency_photo'] ?>" class="pending--img" alt="Modal Image">
                            </a>
                    
                            <div class="modal fade" id="imageModal<?= $view['id_indigency'] ?>" tabindex="-1" role="dialog" aria-labelledby="imageModalTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="imageModalTitle"><?= $view['fname'];?> <?= $view['lname'];?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <a href="<?= $view['certofindigency_photo'] ?>" target="_blank"><img src="<?= $view['certofindigency_photo'] ?>" class="img-fluid" alt="Modal Image"></a>
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
                            <!--<a class="btn btn-success" target="blank" style="width: 90px; font-size: 17px; border-radius:30px; margin-bottom: 2px;" href="indigency_form.php?id_resident=<?= $view['id_resident'];?>">Generate</a> -->
                            <!-- <a href="generatePdf/generate_indigency.php?pdf=1&id=<?= $view['id_indigency']; ?>" class="btn btn-primary" target='_blank'><i class="fas fa-print p-1"></i></a> -->
                            <input type="hidden" name="id_indigency" value="<?= $view['id_indigency'];?>">
                            <input type="hidden" name="email" value="<?= $view['email'];?>">
                            <!-- <button class="btn btn-primary" type="submit" name="approved_indigency" onclick="return confirm('Are you sure you want to approved this request?')"> Approve </button> -->
                            <div class="d-flex justify-content-center">
                                <a class="btn btn-primary btn--approve"  href="pdf_viewer_indigency.php?pdf=1&id=<?= $view['id_indigency'];?>">View</i></a>
                                <!-- <button class="btn btn-danger btn--decline" type="submit" name="reject_indigency" onclick="return confirm('Are you sure you want to decline this request?')"> Decline </button> -->
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

<?php
	}
$con = null;
?>