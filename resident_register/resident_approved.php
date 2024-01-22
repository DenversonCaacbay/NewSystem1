<?php
	// require the database connection
	require 'classes/conn.php';
	if(isset($_POST['search_resident'])){
		$keyword = $_POST['keyword'];
?>
	<table class="table table-hover text-center table-bordered table-responsive" >

		<thead class="alert-info">
			<tr>
                
                
                <th width="20%"> Full Name </th>
                <th width="20%"> Email </th>
                <th width="5%"> Age </th>
                <th width="20%"> Address </th>
                <th width="20%"> Contact # </th>
                <th width="10%"> Verified </th>
                <th width="5%"> Actions</th>
			</tr>
		</thead>

		<tbody>       
			<?php
				
				$stmnt = $conn->prepare("SELECT * FROM `tbl_resident` WHERE `lname` LIKE '%$keyword%' or  `mi` LIKE '%$keyword%' or  `fname` LIKE '%$keyword%' 
				or  `age` LIKE '%$keyword%' or  `sex` LIKE '%$keyword%' or  `status` LIKE '%$keyword%' or  `address` LIKE '%$keyword%' or  `contact` LIKE '%$keyword%'
				or  `bdate` LIKE '%$keyword%' or  `bplace` LIKE '%$keyword%' or  `nationality` LIKE '%$keyword%' or  `family_role` LIKE '%$keyword%' or  `role` LIKE '%$keyword%' or  `email` LIKE '%$keyword%'");
				$stmnt->execute();
				
				while($view = $stmnt->fetch()){
			?>
                <tr>
                
                        
                        <td> <?= $view['lname'];?>, <?= $view['fname'];?> <?= $view['mi'];?> </td>
                        <td> <?= $view['email'];?> </td>
                        <td> <?= $view['age'];?> </td>
                        <td> <?= $view['houseno'];?>, <?= $view['street'];?>, <?= $view['brgy'];?> </td>
                        <td> <?= $view['contact'];?> </td>
                        <td> <?= $view['verified'];?> </td>
                        <td width="20%">    
                            <form action="" method="post">
                                <!-- <a href="update_resident_form.php?id_resident=<?= $view['id_resident'];?>" class="btn btn-success">  Update </a> -->
                                <input type="hidden" name="id_resident" value="<?= $view['id_resident'];?>">
                                <!-- <button class="btn btn-danger" type="submit" name="delete_resident" onclick="return confirm('Are you sure you want to archive this data?')"> Archive </button> -->
                                <a class="btn btn-primary" href="admn_view_approve_details.php?id_resident=<?= $view['id_resident'];?>" name=""> View </a>
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
<table class="table table-hover table-bordered text-center table-responsive">
<thead class="alert-info">
			<tr>
                <th width="20%"> Full Name </th>
                <th width="20%"> Email </th>
                <th width="5%"> Age </th>
                <th width="20%"> Address </th>
                <th width="20%"> Contact # </th>
                <th width="10%"> Verified </th>
                <th width="5%"> Actions</th>
			</tr>
		</thead>

		<tbody>
		    <?php if(is_array($view)) {?>
                <?php foreach($view as $view) {?>
                    <tr>
                        <td> <?= $view['lname'];?>, <?= $view['fname'];?> <?= $view['mi'];?> </td>
                        <td> <?= $view['email'];?> </td>
                        <td> <?= $view['age'];?> </td>
                        <td> <?= $view['houseno'];?>, <?= $view['street'];?>, <?= $view['brgy'];?> </td>
                        <td> <?= $view['contact'];?> </td>
                        <td> <?= $view['verified'];?> </td>
                        <td width="20%">    
                            <form action="" method="post">
                                <!-- <a href="update_resident_form.php?id_resident=<?= $view['id_resident'];?>" class="btn btn-success">  Update </a> -->
                                <input type="hidden" name="id_resident" value="<?= $view['id_resident'];?>">
                                <!-- <button class="btn btn-danger" type="submit" name="delete_resident" onclick="return confirm('Are you sure you want to archive this data?')"> Archive </button> -->
                                <a class="btn btn-primary" href="admn_view_approve_details.php?id_resident=<?= $view['id_resident'];?>" name=""> View </a>
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