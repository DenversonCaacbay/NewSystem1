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
            
            while($view = $stmnt->fetch()){
        ?>
<tr>
                    <td hidden> <?= $view['id_resident'];?> </td> 
                    <td> <?= $view['track_id'];?> </td> 
                    <td> <?= $view['lname'];?>, <?= $view['fname'];?> <?= $view['mi'];?> </td>
                    <td> <?= $view['created_at'];?> </td>
                    <td> <?= $view['form_status'];?> </td>
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
            <th> Date </th>
            <th> Status </th>
        </tr>
    </thead>
    
    <tbody>
        <?php if(is_array($view)) {?>
            <?php foreach($view as $view) {?>
                <tr>
                    <td hidden> <?= $view['id_resident'];?> </td> 
                    <td> <?= $view['track_id'];?> </td> 
                    <td> <?= $view['lname'];?>, <?= $view['fname'];?> <?= $view['mi'];?> </td>
                    <td> <?= $view['created_at'];?> </td>
                    <td> <?= $view['form_status'];?> </td>
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