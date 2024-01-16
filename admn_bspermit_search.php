<?php
	// require the database connection
	require 'classes/conn.php';
	if(isset($_POST['search_bspermit'])){
		$keyword = $_POST['keyword'];
?>
	<table class="table table-hover text-center table-bordered table-responsive">

    <thead class="alert-info">
        <tr>
            <th> Resident ID </th>
            <th> Tracking ID </th>
            <th> Surname </th>
            <th> First Name </th>
            <th> Middle Name </th>
            <th> Business Name </th>
            <th> House No. </th>
            <th> Street </th>
            <th> Barangay </th>
            <th> Municipality </th>
            <th> Business Industry </th>
            <th> Area of Establishment </th>
            <th> Image</th>
            <th> Actions</th>
        </tr>
    </thead>

    <tbody>     
        <?php
            
        $stmnt = $conn->prepare("SELECT * FROM `tbl_bspermit` WHERE 
            (
                `lname` LIKE '%$keyword%' OR  
                `mi` LIKE '%$keyword%' OR  
                `fname` LIKE '%$keyword%' OR  
                `bsname` LIKE '%$keyword%' OR  
                `id_resident` LIKE '%$keyword%' OR  
                `houseno` LIKE '%$keyword%' OR  
                `street` LIKE '%$keyword%' OR  
                `brgy` LIKE '%$keyword%' OR  
                `municipal` LIKE '%$keyword%' OR  
                `bsindustry` LIKE '%$keyword%' OR  
                `aoe` LIKE '%$keyword%' OR
                `track_id` LIKE '%$keyword%'
            )
            AND `deleted_at` IS NULL");
            $stmnt->execute();
            
            while($view = $stmnt->fetch()){
        ?>
            <tr>
                <td> <?= $view['id_resident'];?> </td> 
                <td> <?= $view['track_id'];?> </td> 
                <td> <?= $view['lname'];?> </td>
                <td> <?= $view['fname'];?> </td>
                <td> <?= $view['mi'];?> </td>
                <td> <?= $view['bsname'];?> </td>
                <td> <?= $view['houseno'];?> </td>
                <td> <?= $view['street'];?> </td>
                <td> <?= $view['brgy'];?> </td>
                <td> <?= $view['municipal'];?> </td>
                <td> <?= $view['bsindustry'];?> </td>
                <td> <?= $view['aoe'];?> </td>
                <td>
                    <?php if (is_null($view['bspermit_photo'])): ?>
                        <span>No Image Available</span>
                    <?php else: ?>
                        <button class="btn btn-success" data-toggle="modal" data-target="#imageModal<?= $view['id_bspermit'] ?>">View</button>
                
                        <div class="modal fade" id="imageModal<?= $view['id_bspermit'] ?>" tabindex="-1" role="dialog" aria-labelledby="imageModalTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="imageModalTitle"><?= $view['fname'];?> <?= $view['lname'];?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <a href="<?= $view['bspermit_photo'] ?>" target="_blank"><img src="<?= $view['bspermit_photo'] ?>" class="img-fluid" alt="Modal Image"></a>
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
                        <!--<a class="btn btn-success" target="blank"  style="width: 90px; font-size: 17px; border-radius:30px; margin-bottom: 2px;" href="businesspermit_form.php?id_resident=<?= $view['id_resident'];?>">Generate</a> -->
                        <a href="generatePdf/generate_businesspermit.php?pdf=1&id=<?= $view['id_resident']; ?>" class="btn btn-success" style="width: 90px; font-size: 17px; border-radius:30px; margin-bottom: 2px;" target='_blank'>Generate</a>
                        <input type="hidden" name="id_bspermitid" value="<?= $view['id_bspermitid'];?>">
                        <button class="btn btn-danger" style="width: 90px; font-size: 17px; border-radius:30px;" type="submit" name="delete_bspermit" onclick="return confirm('Are you sure you want to archive this data?')"> Archive </button>
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
            <th> Business Name </th>
            <th> Address </th>
            <th> Business Industry </th>
            <th> Area of Establishment </th>
            <th> Image</th>
                        <th> Actions</th>
        </tr>
    </thead>

    <tbody>
        <?php if(is_array($view)) {?>
            <?php foreach($view as $view) {?>
                <tr>
                    <td hidden> <?= $view['id_resident'];?> </td> 
                    <td> <?= $view['track_id'];?> </td> 
                    <td> <?= $view['lname'];?>, <?= $view['fname'];?> <?= $view['mi'];?></td>
                    <td> <?= $view['bsname'];?> </td>
                    <td> <?= $view['houseno'];?>, <?= $view['street'];?>, <?= $view['brgy'];?>, <?= $view['municipal'];?></td>
                    <td> <?= $view['bsindustry'];?> </td>
                    <td> <?= $view['aoe'];?> </td>
                    <td>
                        <?php if (is_null($view['bspermit_photo'])): ?>
                            <span>No Image Available</span>
                        <?php else: ?>
                            <button class="btn btn-success" data-toggle="modal" data-target="#imageModal<?= $view['id_bspermit'] ?>">View</button>
                    
                            <div class="modal fade" id="imageModal<?= $view['id_bspermit'] ?>" tabindex="-1" role="dialog" aria-labelledby="imageModalTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="imageModalTitle"><?= $view['fname'];?> <?= $view['lname'];?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <a href="<?= $view['bspermit_photo'] ?>" target="_blank"><img src="<?= $view['bspermit_photo'] ?>" class="img-fluid" alt="Modal Image"></a>
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
                           <a href="generatePdf/generate_businesspermit.php?pdf=1&id=<?= $view['id_resident']; ?>" class="btn btn-success" target='_blank'>Generate</a>
                            <input type="hidden" name="id_bspermit" value="<?= $view['id_bspermit'];?>">
                            <button class="btn btn-danger" type="submit" name="delete_bspermit" onclick="return confirm('Are you sure you want to archive this data?')"> Archive </button>
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