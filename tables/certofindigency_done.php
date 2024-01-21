<?php
	// require the database connection
	require 'classes/conn.php';
	if(isset($_POST['search_certofindigency'])){
		$keyword = $_POST['keyword'];
?>
<table class="table table-hover text-center table-bordered table-responsive" >

    <thead class="alert-info">
        <tr>
            <th> Resident ID </th>
            <th> Tracking ID </th>
            <th> Surname </th>
            <th> First Name </th>
            <th> Middle Name </th>
            <th> Nationality </th>
            <th> House Number </th>
            <th> Street </th>
            <th> Barangay </th>
            <th> Municipality </th>
            <th> Purpose </th>
            <th> Date </th>
            <th> Image </th>
                        <th> Actions</th>
        </tr>
    </thead>

    <tbody>     
        <?php
            
            $stmnt = $conn->prepare("SELECT * FROM `tbl_indigency` WHERE (`lname` LIKE '%$keyword%' or  `mi` LIKE '%$keyword%' or  `fname` LIKE '%$keyword%' or  `track_id` LIKE '%$keyword%')AND deleted_at IS NULL");
            $stmnt->execute();
            
            while($view = $stmnt->fetch()){
        ?>
            <tr>
                <td> <?= $view['id_indigency'];?> </td> 
                <td> <?= $view['track_id'];?> </td> 
                <td> <?= $view['lname'];?> </td>
                <td> <?= $view['fname'];?> </td>
                <td> <?= $view['mi'];?> </td>
                <td> <?= $view['nationality'];?> </td>
                <td> <?= $view['houseno'];?> </td>
                <td> <?= $view['street'];?> </td>
                <td> <?= $view['brgy'];?> </td>
                <td> <?= $view['municipal'];?> </td>
                <td> <?= $view['purpose'];?> </td>
                <td> <?= $view['date'];?> </td>
                <td>
                    <?php if (is_null($view['certofindigency_photo'])): ?>
                        <span>No Image Available</span>
                    <?php else: ?>
                        <button class="btn btn-success" data-toggle="modal" data-target="#imageModal<?= $view['id_certofindigency'] ?>">View</button>
                
                        <div class="modal fade" id="imageModal<?= $view['id_certofindigency'] ?>" tabindex="-1" role="dialog" aria-labelledby="imageModalTitle" aria-hidden="true">
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
                <td>    
                    <form action="" method="post">
                        <!--<a class="btn btn-success" target="blank" style="width: 90px; font-size: 17px; border-radius:30px; margin-bottom: 2px;" href="indigency_form.php?id_resident=<?= $view['id_resident'];?>">Generate</a> -->
                        <a href="generatePdf/generate_indigency.php?pdf=1&id=<?= $view['id_resident']; ?>" class="btn btn-success" style="width: 90px; font-size: 17px; border-radius:30px; margin-bottom: 2px;" target='_blank'>Generate</a>
                        <input type="hidden" name="id_indigency" value="<?= $view['id_indigency'];?>">
                        <button class="btn btn-danger" style="width: 90px; font-size: 17px; border-radius:30px;" type="submit" name="delete_certofindigency" onclick="return confirm('Are you sure you want to archive this data?')"> Archive </button>
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
            <th> Resident ID </th>
            <th> Tracking ID </th>
            <th> Full Name </th>
            <th> Nationality </th>
            <th> Address </th>
            <th> Purpose </th>
            <th> Date </th>
            <th> Image </th>
            <th> Actions</th>
        </tr>
    </thead>
    
    <tbody>
        <?php if(is_array($view)) {?>
            <?php foreach($view as $view) {?>
                <tr>
                    <td> <?= $view['id_indigency'];?> </td> 
                    <td> <?= $view['track_id'];?> </td> 
                    <td> <?= $view['lname'];?>, <?= $view['fname'];?> <?= $view['mi'];?></td>
                    <td> <?= $view['nationality'];?> </td>
                    <td> <?= $view['houseno'];?>, <?= $view['street'];?>, <?= $view['brgy'];?>, <?= $view['municipal'];?> </td>
                    <td> <?= $view['purpose'];?> </td>
                    <td> <?= $view['date'];?> </td>
                    <td>
                        <?php if (is_null($view['certofindigency_photo'])): ?>
                            <span>No Image Available</span>
                        <?php else: ?>
                            <button class="btn btn-success" data-toggle="modal" data-target="#imageModal<?= $view['id_indigency'] ?>">View</button>
                    
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
                    <td width="20%">    
                        <form action="" method="post">
                            <!--<a class="btn btn-success" target="blank" style="width: 90px; font-size: 17px; border-radius:30px; margin-bottom: 2px;" href="indigency_form.php?id_resident=<?= $view['id_resident'];?>">Generate</a> -->
                            <a href="generatePdf/generate_indigency.php?pdf=1&id=<?= $view['id_resident']; ?>" class="btn btn-success" target='_blank'>Generate</a>
                            <input type="hidden" name="id_indigency" value="<?= $view['id_indigency'];?>">
                            <button class="btn btn-danger" type="submit" name="delete_certofindigency" onclick="return confirm('Are you sure you want to archive this data?')"> Archive </button>
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