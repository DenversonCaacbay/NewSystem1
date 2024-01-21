<?php
	// require the database connection
	require 'classes/conn.php';
	if(isset($_POST['search_resident'])){
		$keyword = $_POST['keyword'];
?>
	<table class="table table-hover text-center table-bordered table-responsive" >

		<thead class="alert-info">
			<tr>
                <th> Actions</th>
                <th> Email </th>
                <th> Surname </th>
                <th> First name </th>
                <th> Middle name </th>
                <th> Age </th>
                <th> Sex </th>
                <th> Status </th>
                <th> House No.</th>
                <th> Street </th>
                <th> Barangay </th>
                <th> Contact # </th>
                <th> Birth date </th>
                <th> Birth place </th>
                <th> Nationality </th>
                <th> Family Head </th>
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
                    <td>    
                        <form action="" method="post">
                            <a href="update_resident_form.php?id_resident=<?= $view['id_resident'];?>" class="btn btn-success" style="width: 90px; font-size: 17px; border-radius:30px; margin-bottom: 2px;">  Update </a>
                            <input type="hidden" name="id_resident" value="<?= $view['id_resident'];?>">
                            <button class="btn btn-danger" type="submit" name="delete_resident" style="width: 90px; font-size: 17px; border-radius:30px;"> Archive </button>
                        </form>
                    </td>
                    <td> <?= $view['email'];?> </td>
                    <td> <?= $view['lname'];?> </td>
                    <td> <?= $view['fname'];?> </td>
                    <td> <?= $view['mi'];?> </td>
                    <td> <?= $view['age'];?> </td>
                    <td> <?= $view['sex'];?> </td>
                    <td> <?= $view['status'];?> </td>
                    <td> <?= $view['houseno'];?> </td>
                    <td> <?= $view['street'];?> </td>
                    <td> <?= $view['brgy'];?> </td>
                    <td> <?= $view['contact'];?> </td>
                    <td> <?= $view['bdate'];?> </td>
                    <td> <?= $view['bplace'];?> </td>
                    <td> <?= $view['nationality'];?> </td>
                    <td> <?= $view['family_role'];?> </td>
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
                <th> Actions</th>
                <th> Email </th>
                <th> Full Name </th>
                <th> Age </th>
                <th> Sex </th>
                <th> Civil Status </th>
                <th> Address </th>
                <th> Contact # </th>
                <th hidden> Birth date </th>
                <th hidden> Birth place </th>
                <th hidden> Nationality </th>
                <th hidden> Family Head </th>
                <th hidden> Registered Voter </th>
                <th hidden> Verified </th>
                <th> View </th>
			</tr>
		</thead>

		<tbody>
		    <?php if(is_array($view)) {?>
                <?php foreach($view as $view) {?>
                    <tr>                    
                        <td width="20%">    
                            <form action="" method="post">
                                <!-- <a href="update_resident_form.php?id_resident=<?= $view['id_resident'];?>" class="btn btn-success">  Update </a> -->
                                <input type="hidden" name="id_resident" value="<?= $view['id_resident'];?>">
                                <button class="btn btn-primary" type="submit" name="approve_resident" onclick="return confirm('Are you sure you want to approve this data?')"> Approve </button>
                                <button class="btn btn-danger" type="submit" name="decline_resident" onclick="return confirm('Are you sure you want to decline this data?')"> Decline </button>
                            </form>
                        </td>
                        <td> <?= $view['email'];?> </td>
                        <td> <?= $view['lname'];?>, <?= $view['fname'];?> <?= $view['mi'];?> </td>
                        <td> <?= $view['age'];?> </td>
                        <td> <?= $view['sex'];?> </td>
                        <td> <?= $view['status'];?> </td>
                        <td> <?= $view['houseno'];?>, <?= $view['street'];?>, <?= $view['brgy'];?> </td>
                        <td> <?= $view['contact'];?> </td>
                        <td hidden> <?= $view['bdate'];?> </td>
                        <td hidden> <?= $view['bplace'];?> </td>
                        <td hidden> <?= $view['nationality'];?> </td>
                        <td hidden> <?= $view['family_role'];?> </td>
                        <td hidden> <?= $view['voter'];?> </td>
                        <td hidden> <?= $view['verified'];?> </td>
                        <td><a class="btn btn-primary" href="admn_view_pending_details.php?id_resident=<?= $view['id_resident'];?>" name=""> View </a></td>
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


