<?php
	// require the database connection
	require 'classes/conn.php';
	if(isset($_POST['search_brgyid'])){
		$keyword = $_POST['keyword'];
?>
<table class="table table-hover text-center table-bordered">

    <thead class="alert-info">
        
    <tr>
            <th hidden> Resident ID </th>
            <th> Track ID </th>
            <th> Full Name </th>
            <th> Date </th>
            <th> Status </th>
        </tr>
    </thead>

    <tbody> 
        <?php
         $formStatus = $_POST['form_status'];
            
            $stmnt = $conn->prepare("SELECT * FROM `tbl_brgyid` WHERE (`lname` LIKE '%$keyword%' or  `mi` LIKE '%$keyword%' or  `fname` LIKE '%$keyword%' 
                or  `id_resident` LIKE '%$keyword%' or  `houseno` LIKE '%$keyword%' or  `street` LIKE '%$keyword%'
                or `brgy` LIKE '%$keyword%' or `municipal` LIKE '%$keyword%' or `track_id` LIKE '%$keyword%') AND `form_status` = '$formStatus'");
            $stmnt->execute();
            
            while($view_all = $stmnt->fetch()){
        ?>
<tr>
                    <td hidden> <?= $view_all['id_resident'];?> </td> 
                    <td> <?= $view_all['track_id'];?> </td> 
                    <td> <?= $view_all['lname'];?>, <?= $view_all['fname'];?> <?= $view_all['mi'];?> </td>
                    <td> <?= $view_all['created_at'];?> </td>
                    <td> <?= $view_all['form_status'];?> </td>
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

    <thead class="alert-info">
        <tr>
            <th hidden> Resident ID </th>
            <th> Track ID </th>
            <th> Full Name </th>
            <th> Date Requested</th>
            <th> Staff </th>
            <th> Status </th>
            <th> Date</th>
        </tr>
    </thead>
    
    <tbody>
        <?php if(is_array($view_all)) {?>
            <?php foreach($view_all as $view_all) {?>
                <tr>
                    <td hidden> <?= $view_all['id_resident'];?> </td> 
                    <td> <?= $view_all['track_id'];?> </td> 
                    <td> <?= $view_all['lname'];?>, <?= $view_all['fname'];?> <?= $view_all['mi'];?> </td>
                    <td> <?= date('F d, Y', strtotime($view_all['date'])); ?> </td>
                    <td> <?= $view_all['staff'];?> </td>
                    <td> <?= $view_all['form_status'];?> </td>
                    <td> <?= date('F d, Y', strtotime($view_all['created_at'])); ?> </td>
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