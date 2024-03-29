
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
	if(isset($_POST['search_certofindigency'])){
		$keyword = $_POST['keyword'];
?>
<table class="table table-hover text-center table-bordered" >

    <thead class="alert-info sticky-top">
    <tr>
            <th class="bg text-light"> Pick Up Date </th>
            <th class="bg text-light"> Tracking ID </th>
            <th class="bg text-light"> Full Name </th>
            <th class="bg text-light"> Address </th>
            <th class="bg text-light"> Purpose </th>
            <th class="bg text-light"> Image </th>
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
                    <td> <?= date("F d, Y", strtotime($view['date'])); ?></td>
                    <td>
                        <?php if (is_null($view['certofindigency_photo'])): ?>
                            <span>No Image Available</span>
                        <?php else: ?>
                            <a href="#" data-toggle="modal" data-target="#imageModal<?= $view['id_indigency'] ?>">
                                <img src="<?= $view['certofindigency_photo'] ?>" class="img-fluid" alt="Modal Image" width="50">
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
                    <td width="20%">    
                        <form action="" method="post">
                            <!--<a class="btn btn-success" target="blank" style="width: 90px; font-size: 17px; border-radius:30px; margin-bottom: 2px;" href="indigency_form.php?id_resident=<?= $view['id_resident'];?>">Generate</a> -->
                            <!-- <a href="generatePdf/generate_indigency.php?pdf=1&id=<?= $view['id_indigency']; ?>" class="btn btn-primary" target='_blank'><i class="fas fa-print p-1"></i></a> -->
                            <input type="hidden" name="id_indigency" value="<?= $view['id_indigency'];?>">
                            <input type="hidden" name="email" value="<?= $view['email'];?>">
                            <!-- <button class="btn btn-primary" type="submit" name="approved_indigency" onclick="return confirm('Are you sure you want to approved this request?')"> Approve </button> -->
                            <a class="btn btn-primary btn--approve"  href="pdf_viewer_indigency.php?pdf=1&id=<?= $view['id_indigency'];?>">View</i></a>
                            <button class="btn btn-danger btn-decline" type="submit" name="reject_indigency" onclick="return confirm('Are you sure you want to decline this request?')"> Decline </button>
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
            <th class="bg text-light"> Address </th>
            <th class="bg text-light"> Purpose </th>
            <th class="bg text-light"> Image </th>
            <th class="bg text-light"> Actions</th>
        </tr>
    </thead>
    
    <tbody>
        <?php if(is_array($view)) {?>
            <?php foreach($view as $view) {?>
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
                                <img src="<?= $view['certofindigency_photo'] ?>" class="img-fluid" alt="Modal Image" width="50">
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
                    <td width="20%">    
                        <form action="" method="post">
                            <!--<a class="btn btn-success" target="blank" style="width: 90px; font-size: 17px; border-radius:30px; margin-bottom: 2px;" href="indigency_form.php?id_resident=<?= $view['id_resident'];?>">Generate</a> -->
                            <!-- <a href="generatePdf/generate_indigency.php?pdf=1&id=<?= $view['id_indigency']; ?>" class="btn btn-primary" target='_blank'><i class="fas fa-print p-1"></i></a> -->
                            <input type="hidden" name="id_indigency" value="<?= $view['id_indigency'];?>">
                            <input type="hidden" name="email" value="<?= $view['email'];?>">
                            <!-- <button class="btn btn-primary" type="submit" name="approved_indigency" onclick="return confirm('Are you sure you want to approved this request?')"> Approve </button> -->
                            <a class="btn btn-primary btn--approve"  href="pdf_viewer_indigency.php?pdf=1&id=<?= $view['id_indigency'];?>">View</i></a>
                            <button class="btn btn-danger btn--decline" type="submit" name="reject_indigency" onclick="return confirm('Are you sure you want to decline this request?')"> Decline </button>
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