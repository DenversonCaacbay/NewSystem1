
<?php
	// require the database connection
	require 'classes/conn.php';
	if(isset($_POST['search_brgyid'])){
		$keyword = $_POST['keyword'];
?>
<table class="table table-hover text-center table-bordered" >

<thead class="bg-primary sticky-top">
        <tr>
            <th hidden> Resident ID </th>
            <th class="text-light"> Date Requested </th>
            <th class="text-light"> Track ID </th>
            <th class="text-light"> Full Name </th>
            <th hidden class="bg text-light"> Address </th>
            <th hidden class="bg text-light"> Birth Date </th>
            <th hidden class="bg text-light"> Emergency Contact Person </th>
            <th hidden class="bg text-light"> Emergency Contact Number </th>
            
            <th class="text-light"> Image </th>
            <th class="text-light"> Urgent </th>
            <th class="text-light"> Actions</th>
        </tr>
    </thead>

    <tbody> 
        <?php
            $stmnt = $conn->prepare("
            SELECT bi.*, r.email
            FROM tbl_brgyid bi
            INNER JOIN tbl_resident r ON bi.id_resident = r.id_resident
            WHERE 
                (bi.`lname` LIKE '%$keyword%' OR bi.`mi` LIKE '%$keyword%' OR bi.`fname` LIKE '%$keyword%' 
                OR bi.`id_resident` LIKE '%$keyword%' OR bi.`houseno` LIKE '%$keyword%' 
                OR bi.`street` LIKE '%$keyword%' OR bi.`brgy` LIKE '%$keyword%' 
                OR bi.`municipal` LIKE '%$keyword%' OR bi.`track_id` LIKE '%$keyword%') 
            AND bi.form_status ='Pending'
        ");
            $stmnt->execute();
            
            while($view = $stmnt->fetch()){
        ?>
                <tr>
                    <td hidden> <?= $view['id_resident'];?> </td> 
                    <td > <?= $view['date'] ? date("F d, Y", strtotime($view['date'])) : "Walk in"; ?></td>
                    <td> <?= $view['track_id'];?> </td> 
                    <td> <?= $view['lname'];?>, <?= $view['fname'];?> <?= $view['mi'];?> </td>
                    <td hidden> <?= $view['houseno'];?>, <?= $view['street'];?>, <?= $view['brgy'];?>, <?= $view['municipal'];?></td>
                    <td hidden> <?= $view['bdate'];?> </td>
                    <td hidden> <?= $view['inc_lname'];?>, <?= $view['inc_fname'];?> </td>
                    <td hidden> <?= $view['inc_contact'];?> </td>
                    
                    <td>
                        <?php if (is_null($view['res_photo'])): ?>
                            <span>No Image Available</span>
                        <?php else: ?>
                            <a href="#" data-toggle="modal" data-target="#imageModal<?= $view['id_brgyid'] ?>">
                                <img src="<?= $view['res_photo'] ?>" class="img--td" alt="Modal Image" width="50" height="50">
                            </a>
                    
                            <div class="modal fade" id="imageModal<?= $view['id_brgyid'] ?>" tabindex="-1" role="dialog" aria-labelledby="imageModalTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="imageModalTitle"><?= $view['fname'];?> <?= $view['lname'];?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <a href="<?= $view['res_photo'] ?>" target="_blank"><img src="<?= $view['res_photo'] ?>" class="img-fluid" alt="Modal Image"></a>
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
                    <!-- <td> <?= $view['form_status'];?> </td> -->
                    <td width="20%">      
                        <form action="" method="post">
                            <input type="hidden" name="id_brgyid" value="<?= $view['id_brgyid'];?>">
                            <input type="hidden" name="email" value="<?= $view['email'];?>">
                            <div class="d-flex justify-content-center">
                                <a class="btn btn-primary btn--approve"  href="pdf_viewer_id.php?pdf=1&id=<?= $view['id_brgyid'];?>">View</i></a>
                                <!-- <button class="btn btn-danger btn--decline" type="submit" name="reject_brgyid" onclick="return confirm('Are you sure you want to decline <?= $view['lname'];?>, <?= $view['fname'];?> <?= $view['mi'];?> Request?')"> Decline </button> -->
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
    <thead class="bg-primary sticky-top">
        <tr>
            <th hidden> Resident ID </th>
            <th class="text-light"> Date Requested </th>
            <th class="text-light"> Track ID </th>
            <th class="text-light"> Full Name </th>
            <th hidden class="bg text-light"> Address </th>
            <th hidden class="bg text-light"> Birth Date </th>
            <th hidden class="bg text-light"> Emergency Contact Person </th>
            <th hidden class="bg text-light"> Emergency Contact Number </th>
            
            <th class="text-light"> Image </th>
            <th class="text-light"> Urgent </th>
            <th class="text-light"> Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php if(is_array($view)) {?>
        <?php foreach($view as $viewItem) {?>
            <tr>
                <td hidden> <?= $viewItem['id_resident'];?> </td> 
                <td > <?= $viewItem['date'] ? date("F d, Y", strtotime($viewItem['date'])) : "Walk in"; ?></td>
                <td> <?= $viewItem['track_id'];?> </td> 
                <td> <?= $viewItem['lname'];?>, <?= $viewItem['fname'];?> <?= $viewItem['mi'];?> </td>
                <td hidden> <?= $viewItem['houseno'];?>, <?= $viewItem['street'];?>, <?= $viewItem['brgy'];?>, <?= $viewItem['municipal'];?></td>
                <td hidden> <?= $viewItem['bdate'];?> </td>
                <td hidden> <?= $viewItem['inc_lname'];?>, <?= $viewItem['inc_fname'];?> </td>
                <td hidden> <?= $viewItem['inc_contact'];?> </td>
                
                <td>
                    <?php if (is_null($viewItem['res_photo'])): ?>
                        <span>No Image Available</span>
                    <?php else: ?>
                        <a href="#" data-toggle="modal" data-target="#imageModal<?= $viewItem['id_brgyid'] ?>">
                            <img src="<?= $viewItem['res_photo'] ?>" class="img--td" alt="Modal Image" width="50" height="50">
                        </a>
                
                        <div class="modal fade" id="imageModal<?= $viewItem['id_brgyid'] ?>" tabindex="-1" role="dialog" aria-labelledby="imageModalTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="imageModalTitle"><?= $viewItem['fname'];?> <?= $viewItem['lname'];?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <a href="<?= $viewItem['res_photo'] ?>" target="_blank"><img src="<?= $viewItem['res_photo'] ?>" class="img-fluid" alt="Modal Image"></a>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </td>
                <td> <?= $viewItem['is_urgent'] ? : "No" ;?> </td>
                <td width="20%">      
                    <form action="" method="post">
                        <input type="hidden" name="id_brgyid" value="<?= $viewItem['id_brgyid'];?>">
                        <input type="hidden" name="email" value="<?= $viewItem['email'];?>">
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-primary btn--approve"  href="pdf_viewer_id.php?pdf=1&id=<?= $viewItem['id_brgyid'];?>">View</a>
                        </div>
                    </form>
                </td>
            </tr>
        <?php } ?>
    <?php } ?>
</tbody>


</table>


<?php
	}
$con = null;
?>
