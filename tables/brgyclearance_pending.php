
<?php
	// require the database connection
	require 'classes/conn.php';
	if(isset($_POST['search_clearance'])){
		$keyword = $_POST['keyword'];
?>

<table class="table table-hover text-center table-bordered" >
    <thead class="bg sticky-top">
        
    <tr>
            <th class="bg text-light"> Pick Up Date </th>
            <th class="bg text-light"> Tracking ID </th>
            <th class="bg text-light"> Full Name </th>
            <th class="bg text-light"> Purpose </th>
            <th class="bg text-light"> Address </th>
            <th class="bg text-light"> Urgent </th>
            <th class="bg text-light"> Actions</th>
        </tr>
    </thead>

    <tbody>
        <?php
            
            $stmnt = $conn->prepare("
            SELECT cl.*, r.email
            FROM tbl_clearance cl
            INNER JOIN tbl_resident r ON cl.id_resident = r.id_resident
            WHERE 
                (
                    cl.`lname` LIKE '%$keyword%' OR  
                    cl.`mi` LIKE '%$keyword%' OR  
                    cl.`fname` LIKE '%$keyword%' OR  
                    cl.`id_resident` LIKE '%$keyword%' OR  
                    cl.`houseno` LIKE '%$keyword%' OR  
                    cl.`street` LIKE '%$keyword%' OR  
                    cl.`brgy` LIKE '%$keyword%' OR  
                    cl.`municipal` LIKE '%$keyword%' OR  
                    cl.`status` LIKE '%$keyword%' OR  
                    cl.`track_id` LIKE '%$keyword%'
                )
                AND cl.`form_status` ='Pending'
        ");
            $stmnt->execute();
            
            while($view = $stmnt->fetch()){
        ?>
            <tr>
                    <td hidden> <?= $view['id_clearance'];?> </td> 
                    <td> <?= date("F d, Y", strtotime($view['date'])); ?></td>
                    <td> <?= $view['track_id'];?> </td> 
                    <td> <?= $view['lname'];?>, <?= $view['fname'];?> <?= $view['mi'];?></td>
                    <td> <?= $view['purpose'];?> </td>
                    <td> <?= $view['houseno'];?>, <?= $view['street'];?>,<?= $view['brgy'];?>,<?= $view['municipal'];?> </td>
                    <td> <?= $view['is_urgent'] ?: "No" ;?> </td>
                    <td width="20%">    
                        <form action="" method="post">
                            <!-- <a class="btn btn-success" target="blank" style="width: 90px; font-size: 17px; border-radius:30px; margin-bottom: 2px;" href="rescert_form.php?id_resident=<?= $view['id_resident'];?>">Generate</a>  -->
                            <a href="generatePdf/generate_clearance.php?pdf=1&id=<?= $view['id_resident']; ?>" class="btn btn-primary" target='_blank'><i class="fas fa-print p-1"></i></a>

                            <input type="hidden" name="id_clearance" value="<?= $view['id_clearance'];?>">
                            <input type="hidden" name="email" value="<?= $view['email'];?>">
                            <button class="btn btn-primary" type="submit" name="approved_clearance" onclick="return confirm('Are you sure you want to approved this request?')"> Approve </button>
                            <button class="btn btn-danger" type="submit" name="reject_clearance" onclick="return confirm('Are you sure you want to decline this request?')"> Decline </button>
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
            <th class="bg text-light"> Pick Up Date </th>
            <th class="bg text-light"> Tracking ID </th>
            <th class="bg text-light"> Full Name </th>
            <th class="bg text-light"> Birthdate </th>
            <th class="bg text-light"> Purpose </th>
            <th class="bg text-light"> Address </th>
            <th class="bg text-light"> Urgent </th>
            <th class="bg text-light"> Actions</th>
        </tr>
    </thead>

    <tbody>
        <?php if(is_array($view)) {?>
            <?php foreach($view as $view) {?>
                <tr>
                    <td hidden> <?= $view['id_clearance'];?> </td> 
                    <td> <?= date("F d, Y", strtotime($view['date'])); ?></td>
                    <td> <?= $view['track_id'];?> </td> 
                    <td> <?= $view['lname'];?>, <?= $view['fname'];?> <?= $view['mi'];?></td>
                    <td> <?= $view['bdate'];?></td>
                    <td> <?= $view['purpose'];?> </td>
                    <td> <?= $view['houseno'];?>, <?= $view['street'];?>,<?= $view['brgy'];?>,<?= $view['municipal'];?> </td>
                    <td> <?= $view['is_urgent'] ?: "No" ;?> </td>
                    <td width="20%">    
                        <form action="" method="post">
                            <!-- <a class="btn btn-success" target="blank" style="width: 90px; font-size: 17px; border-radius:30px; margin-bottom: 2px;" href="rescert_form.php?id_resident=<?= $view['id_resident'];?>">Generate</a>  -->
                            <!-- <a href="generatePdf/generate_clearance.php?pdf=1&id=<?= $view['id_clearance']; ?>" class="btn btn-primary" target='_blank'><i class="fas fa-print p-1"></i></a> -->

                            <input type="hidden" name="id_clearance" value="<?= $view['id_clearance'];?>">
                            <input type="hidden" name="email" value="<?= $view['email'];?>">
                            <!-- <button class="btn btn-primary" type="submit" name="approved_clearance" onclick="return confirm('Are you sure you want to approved this request?')"> Approve </button> -->
                            <div class="d-flex justify-content-center">
                                <a class="btn btn-primary btn--approve"  href="pdf_viewer_clearance.php?pdf=1&id=<?= $view['id_clearance'];?>">View</i></a>
                                <!-- <button class="btn btn-danger btn--decline" type="submit" name="reject_clearance" onclick="return confirm('Are you sure you want to decline this request?')"> Decline </button> -->
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
<script src="https://kit.fontawesome.com/67a9b7069e.js" crossorigin="anonymous"></script>
<script src="..//bootstrap/js/bootstrap.bundle.js" type="text/javascript"> </script>

<?php
	}
$con = null;
?>