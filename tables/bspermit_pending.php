<?php
	// require the database connection
	require 'classes/conn.php';
	if(isset($_POST['search_bspermit'])){
		$keyword = $_POST['keyword'];
?>
	<table class="table table-hover text-center table-bordered responsive">

    <thead class="alert-info sticky-stop">
    <tr>
            <th hidden> Resident ID </th>
            <th class="bg text-light"> Pick Up Date </th>
            <th class="bg text-light"> Tracking ID </th>
            <th class="bg text-light"> Full Name </th>
            <th class="bg text-light"> Business Name </th>
            <th class="bg text-light"> Address </th>
            <th class="bg text-light"> Business Industry </th>
            <th class="bg text-light"> Area of Establishment </th>
            <th class="bg text-light"> Image</th>
            
                        <th class="bg text-light"> Actions</th>
        </tr>
    </thead>

    <tbody>     
        <?php
            
            $stmnt = $conn->prepare("
            SELECT bp.*, r.email
            FROM tbl_bspermit bp
            INNER JOIN tbl_resident r ON bp.id_resident = r.id_resident
            WHERE 
                (
                    bp.`lname` LIKE '%$keyword%' OR  
                    bp.`mi` LIKE '%$keyword%' OR  
                    bp.`fname` LIKE '%$keyword%' OR  
                    bp.`bsname` LIKE '%$keyword%' OR  
                    bp.`id_resident` LIKE '%$keyword%' OR  
                    bp.`houseno` LIKE '%$keyword%' OR  
                    bp.`street` LIKE '%$keyword%' OR  
                    bp.`brgy` LIKE '%$keyword%' OR  
                    bp.`municipal` LIKE '%$keyword%' OR  
                    bp.`bsindustry` LIKE '%$keyword%' OR  
                    bp.`aoe` LIKE '%$keyword%' OR
                    bp.`track_id` LIKE '%$keyword%'
                )
                AND bp.`form_status` ='Pending'
        ");
        $stmnt->execute();
        $result = $stmnt->fetchAll();
        
            $stmnt->execute();
            
            while($view = $stmnt->fetch()){
        ?>
            <tr>
                    <td hidden> <?= $view['id_resident'];?> </td> 
                    <td> <?= date("F d, Y", strtotime($view['date'])); ?></td>
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
                            <!-- <a class="btn btn-primary" data-toggle="modal" data-target="#imageModal<?= $view['id_bspermit'] ?>">View</a> -->
                            <a href="#" data-toggle="modal" data-target="#imageModal<?= $view['id_bspermit'] ?>">
                                <img src="<?= $view['bspermit_photo'] ?>" class="img-fluid" alt="Modal Image" width="80">
                            </a>
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
                           <a href="generatePdf/generate_businesspermit.php?pdf=1&id=<?= $view['id_resident']; ?>" class="btn btn-primary" target='_blank'><i class="fas fa-print p-1"></i></a>
                            <input type="hidden" name="id_bspermit" value="<?= $view['id_bspermit'];?>">
                            <input type="hidden" name="email" value="<?= $view['email'];?>">
                            <button class="btn btn-primary" type="submit" name="approved_bspermit" onclick="return confirm('Are you sure you want to approved this request?')"> Approve </button>
                            <button class="btn btn-danger" type="submit" name="reject_bspermit" onclick="return confirm('Are you sure you want to deline this request?')"> Decline </button>
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
            <th class="bg text-light"> Pick Up Date </th>
            <th class="bg text-light"> Tracking ID </th>
            <th class="bg text-light"> Full Name </th>
            <th class="bg text-light"> Business Name </th>
            <th class="bg text-light"> Address </th>
            <th class="bg text-light"> Business Industry </th>
            <th class="bg text-light"> Area of Establishment </th>
            <th class="bg text-light"> Image</th>
            <th class="bg text-light"> Actions</th>
        </tr>
    </thead>

    <tbody>
        <?php if(is_array($view)) {?>
            <?php foreach($view as $view) {?>
                <tr>
                    <td hidden> <?= $view['id_resident'];?> </td> 
                    <td> <?= date("F d, Y", strtotime($view['date'])); ?></td>
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
                            <!-- <a class="btn btn-primary" data-toggle="modal" data-target="#imageModal<?= $view['id_bspermit'] ?>">View</a> -->
                            <a href="#" data-toggle="modal" data-target="#imageModal<?= $view['id_bspermit'] ?>">
                                <img src="<?= $view['bspermit_photo'] ?>" class="img-fluid" alt="Modal Image" width="80">
                            </a>
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
                           <a href="generatePdf/generate_businesspermit.php?pdf=1&id=<?= $view['id_resident']; ?>" class="btn btn-primary" target='_blank'><i class="fas fa-print p-1"></i></a>
                            <input type="hidden" name="id_bspermit" value="<?= $view['id_bspermit'];?>">
                            <input type="hidden" name="email" value="<?= $view['email'];?>">
                            <button class="btn btn-primary" type="submit" name="approved_bspermit" onclick="return confirm('Are you sure you want to approved this request?')"> Approve </button>
                            <button class="btn btn-danger" type="submit" name="reject_bspermit" onclick="return confirm('Are you sure you want to deline this request?')"> Decline </button>
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