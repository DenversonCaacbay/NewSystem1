<style>
    .table{
        width: 100%;
    }
    th{
        background: #309464 !important;
        color: #fff !important;
        font-size: 15px;
    }
    td{
        font-size: 15px;
        padding: auto;
    }
    .pending--img{
        width:50px;
        height:50px;
    }

    .btn--approve,
    .btn--decline{
        padding: 5px;
        width: 80px;
        text-align:center;
        margin: 5px;
        font-size: 13px;
    }

    @media screen and (max-width: 1420px) {
        th{
            font-size: 12px;
        }
        td{
            font-size: 12px;
        }
        .pending--img{
            width:30px;
            height:30px;
        }
        .btn-table{
            font-size: 15px;
            padding: 5px;
            margin:3px;
            width:25px;
        }
    }
</style>

<?php
	// require the database connection
	require 'classes/conn.php';
	if(isset($_POST['search_certofres'])){
		$keyword = $_POST['keyword'];
?>
<table class="table table-hover text-center table-bordered" >
    <thead class="alert-info">
        
    <tr>
                <th hidden> Resident ID </th>
                <th> Pick Up Date </th>
                <th> Tracking ID </th>
                <th> Full Name </th>
                <th> Address </th>
                <!-- <th> Date </th> -->
                <th> Purpose </th>
                <th> Actions</th>
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
                        <td> <?= date("F d, Y", strtotime($view['date'])); ?></td>
                        <td> <?= $view['track_id'];?> </td> 
                        <td> <?= $view['lname'];?>, <?= $view['fname'];?> <?= $view['mi'];?>  </td>
                        <td> <?= $view['houseno'];?>, <?= $view['street'];?>, <?= $view['brgy'];?>,<?= $view['municipal'];?> </td>
                       
                        <td> <?= $view['purpose'];?> </td>
                        <td width="20%">    
                            <form action="" method="post">
                                <!--<a class="btn btn-success" target="blank" style="width: 90px; font-size: 17px; border-radius:30px; margin-bottom: 2px;" href="rescert_form.php?id_resident=<?= $view['id_resident'];?>">Generate</a> -->
                                <a href="generatePdf/generate_residency.php?pdf=1&id=<?= $view['id_rescert']; ?>" class="btn btn-primary" target='_blank'><i class="fas fa-print p-1"></i></a>
                                <input type="hidden" name="id_rescert" value="<?= $view['id_rescert'];?>">
                                <input type="hidden" name="email" value="<?= $view['email'];?>">
                                <button class="btn btn-primary" type="submit" name="approved_rescert" onclick="return confirm('Are you sure you want to approved this request?')"> Approve </button>
                                <button class="btn btn-danger" type="submit" name="reject_rescert" onclick="return confirm('Are you sure you want to decline this request?')"> Decline </button>
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
                <th class="bg text-light"> Tracking ID </th>
                <th class="bg text-light"> Full Name </th>
                <th class="bg text-light"> Address </th>
                <th class="bg text-light"> Purpose </th>
                <th>Image</th>
                <th class="bg text-light"> Actions</th>
			</tr>
		</thead>

		<tbody>
		    <?php if(is_array($view)) {?>
                <?php foreach($view as $view) {?>
                    <tr>
                        <td hidden> <?= $view['id_resident'];?> </td> 
                        <td> <?= date("F d, Y", strtotime($view['created_at'])); ?></td>
                        <td> <?= $view['track_id'];?> </td> 
                        <td> <?= $view['lname'];?>, <?= $view['fname'];?> <?= $view['mi'];?>  </td>
                        <td> <?= $view['houseno'];?>, <?= $view['street'];?>, <?= $view['brgy'];?>,<?= $view['municipal'];?> </td>
                        
                        <td> <?= $view['purpose'];?> </td>
                        <td>
                        <?php if (is_null($view['certofres_photo'])): ?>
                            <span>No Image Available</span>
                        <?php else: ?>
                            <a href="#" data-toggle="modal" data-target="#imageModal<?= $view['id_rescert'] ?>">
                                <img src="<?= $view['certofres_photo'] ?>" class="img-fluid" alt="Modal Image" width="50">
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
                                <!--<a class="btn btn-success" target="blank" style="width: 90px; font-size: 17px; border-radius:30px; margin-bottom: 2px;" href="rescert_form.php?id_resident=<?= $view['id_resident'];?>">Generate</a> -->
                                <!-- <a href="generatePdf/generate_residency.php?pdf=1&id=<?= $view['id_rescert']; ?>" class="btn btn-primary" target='_blank'><i class="fas fa-print p-1"></i></a> -->
                                <input type="hidden" name="id_rescert" value="<?= $view['id_rescert'];?>">
                                <input type="hidden" name="email" value="<?= $view['email'];?>">
                                <!-- <button class="btn btn-primary" type="submit" name="approved_rescert" onclick="return confirm('Are you sure you want to approved this request?')"> Approve </button> -->
                                <a class="btn btn-primary btn--approve"  href="pdf_viewer_residency.php?pdf=1&id=<?= $view['id_rescert'];?>">View</i></a>
                                <button class="btn btn-danger  btn--decline" type="submit" name="reject_rescert" onclick="return confirm('Are you sure you want to decline this request?')"> Decline </button>
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