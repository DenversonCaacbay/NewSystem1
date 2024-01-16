<?php
	// require the database connection
	require 'classes/conn.php';
	if(isset($_POST['search_brgyid'])){
		$keyword = $_POST['keyword'];
?>
<table class="table table-hover text-center table-bordered table-responsive" >

    <thead class="alert-info">
        
        <tr>
            <th> Resident ID </th>
            <th> Track ID </th>
            <th> Surname </th>
            <th> First Name </th>
            <th> Middle Name </th>
            <th> House No. </th>
            <th> Street </th>
            <th> Barangay </th>
            <th> Municipality </th>
            <th> Birth Date </th>
            <th> Birth Place </th>
            <th> Emergency Contact Person </th>
            <th> Emergency Contact Number </th>
            <th> Image </th>
            <th> Actions</th>

        </tr>
    </thead>

    <tbody> 
        <?php
            
            $stmnt = $conn->prepare("SELECT * FROM `tbl_brgyid` WHERE (`lname` LIKE '%$keyword%' or  `mi` LIKE '%$keyword%' or  `fname` LIKE '%$keyword%' 
                or  `id_resident` LIKE '%$keyword%' or  `houseno` LIKE '%$keyword%' or  `street` LIKE '%$keyword%'
                or `brgy` LIKE '%$keyword%' or `municipal` LIKE '%$keyword%' or `track_id` LIKE '%$keyword%') AND deleted_at IS NULL");
            $stmnt->execute();
            
            while($view = $stmnt->fetch()){
        ?>
            <tr>
                <td> <?= $view['id_resident'];?> </td> 
                <td> <?= $view['track_id'];?> </td> 
                <td> <?= $view['lname'];?> </td>
                <td> <?= $view['fname'];?> </td>
                <td> <?= $view['mi'];?> </td>
                <td> <?= $view['houseno'];?> </td>
                <td> <?= $view['street'];?> </td>
                <td> <?= $view['brgy'];?> </td>
                <td> <?= $view['municipal'];?> </td>
                <td> <?= $view['bdate'];?> </td>
                <td> <?= $view['bplace'];?> </td>
                <td> <?= $view['inc_lname'];?>, <?= $view['inc_fname'];?> </td>
                <td> <?= $view['inc_contact'];?> </td>
                <td>
                    <?php if (is_null($view['res_photo'])): ?>
                        <span>No Image Available</span>
                    <?php else: ?>
                        <button class="btn btn-success" data-toggle="modal" data-target="#imageModal<?= $view['id_brgyid'] ?>">View</button>
                
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
                <td>    
                    <form action="" method="post">
                        <a class="btn btn-success" target="blank" style="width: 90px; font-size: 17px; border-radius:30px; margin-bottom: 2px;" href="barangayid_form.php?id_resident=<?= $view['id_resident'];?>">Generate</a> 
                        <input type="hidden" name="id_brgyid" value="<?= $view['id_brgyid'];?>">
                        <button class="btn btn-danger" style="width: 90px; font-size: 17px; border-radius:30px;" type="submit" name="delete_brgyid"> Archive </button>
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
            <th> Track ID </th>
            <th> Full Name </th>
            <th> Address </th>
            <th> Birth Date </th>
            <th> Birth Place </th>
            <th> Emergency Contact Person </th>
            <th> Emergency Contact Number </th>
            <th> Image </th>
            <th> Actions</th>
        </tr>
    </thead>
    
    <tbody>
        <?php if(is_array($view)) {?>
            <?php foreach($view as $view) {?>
                <tr>
                    <td hidden> <?= $view['id_resident'];?> </td> 
                    <td> <?= $view['track_id'];?> </td> 
                    <td> <?= $view['lname'];?>, <?= $view['fname'];?> <?= $view['mi'];?> </td>
                    <td> <?= $view['houseno'];?>, <?= $view['street'];?>, <?= $view['brgy'];?>, <?= $view['municipal'];?></td>
                    <td> <?= $view['bdate'];?> </td>
                    <td> <?= $view['bplace'];?> </td>
                    <td> <?= $view['inc_lname'];?>, <?= $view['inc_fname'];?> </td>
                    <td> <?= $view['inc_contact'];?> </td>
                    <td>
                        <?php if (is_null($view['res_photo'])): ?>
                            <span>No Image Available</span>
                        <?php else: ?>
                            <button class="btn btn-success" data-toggle="modal" data-target="#imageModal<?= $view['id_brgyid'] ?>">View</button>
                    
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
                    <td width="20%">      
                        <form action="" method="post">
                            <a class="btn btn-success" target="blank"  href="barangayid_form.php?id_resident=<?= $view['id_resident'];?>">Generate</a> 
                            <input type="hidden" name="id_brgyid" value="<?= $view['id_brgyid'];?>">
                            <button class="btn btn-danger" type="submit" name="delete_brgyid" onclick="return confirm('Are you sure you want to archive this data?')"> Archive </button>
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