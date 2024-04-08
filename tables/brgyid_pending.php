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
    .img--td{
        width:50px;
        height: 50px;
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
	if(isset($_POST['search_brgyid'])){
		$keyword = $_POST['keyword'];
?>
<table class="table table-hover text-center table-bordered" >

    <thead class="alert-info">
         
    <tr>
            <th hidden> Resident ID </th>
            <th> Pick Up Date</th>
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
                    <td> <?= date("F d, Y", strtotime($view['date'])); ?></td>
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
                            <a href="#" data-toggle="modal" data-target="#imageModal<?= $view['id_brgyid'] ?>">
                                <img src="<?= $view['res_photo'] ?>" class="img-fluid" alt="Modal Image" width="80">
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
                    <td width="20%">      
                        <form action="" method="post">
                            <!-- <a class="btn btn-primary" target="blank"  href="barangayid_form.php?id_resident=<?= $view['id_resident'];?>"><i class="fas fa-print p-1"></i></a>  -->
                            <input type="hidden" name="id_brgyid" value="<?= $view['id_brgyid'];?>">
                            <input type="hidden" name="email" value="<?= $view['email'];?>">
                            <!-- <a href="generatePdf/generate_brgyid.php?pdf=1&id=<?= $view['id_brgyid']; ?>" class="btn btn-primary" target='_blank'><i class="fas fa-print p-1"></i></a> -->
                            <a  href="../pdf_viewer.php?pdf=1&id=<?= $view['id_brgyid'];?>"  target='_blank'><i class="fas fa-print p-1"></i></a>
                            <button class="btn btn-primary" type="submit" name="approved_brgyid" onclick="return confirm('Are you sure you want to approved this request?')"> Approve </button>
                            <button class="btn btn-danger" type="submit" name="reject_brgyid" onclick="return confirm('Are you sure you want to decline this data?')"> Decline </button>
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

<table class="table table-hover ">
    <thead class="bg-primary sticky-top">
        <tr>
            <th hidden> Resident ID </th>
            <th class="bg text-light"> Date Requested </th>
            <th class="bg text-light"> Track ID </th>
            <th class="bg text-light"> Full Name </th>
            <th hidden class="bg text-light"> Address </th>
            <th hidden class="bg text-light"> Birth Date </th>
            <th hidden class="bg text-light"> Emergency Contact Person </th>
            <th hidden class="bg text-light"> Emergency Contact Number </th>
            <th class="bg text-light"> Image </th>
            <th class="bg text-light"> Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if(is_array($view)) {?>
            <?php foreach($view as $view) {?>
                <tr>
                    <td hidden> <?= $view['id_resident'];?> </td> 
                    <td > <?= date("F d, Y", strtotime($view['date'])); ?></td>
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
                    <td width="20%">      
                        <form action="" method="post">
                            <input type="hidden" name="id_brgyid" value="<?= $view['id_brgyid'];?>">
                            <input type="hidden" name="email" value="<?= $view['email'];?>">
                            <a class="btn btn-primary btn--approve"  href="pdf_viewer_id.php?pdf=1&id=<?= $view['id_brgyid'];?>">View</i></a>
                            <button class="btn btn-danger btn--decline" type="submit" name="reject_brgyid" onclick="return confirm('Are you sure you want to decline <?= $view['lname'];?>, <?= $view['fname'];?> <?= $view['mi'];?> Request?')"> Decline </button>
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
