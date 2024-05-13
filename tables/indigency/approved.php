<?php
	// require the database connection
	require 'classes/conn.php';
	if(isset($_POST['search_certofindigency'])){
		$keyword = $_POST['keyword'];
?>
<table class="table table-hover text-center table-bordered" >

    <thead class="alert-info">
    <tr>
            <th> Tracking ID </th>
            <th> Full Name </th>
            <th> Nationality </th>
            <th> Address </th>
            <th> Purpose </th>
            <th> Date </th>
            <th> Status </th>
        </tr>
    </thead>

    <tbody>     
        <?php
            $formStatus = $_POST['form_status'];
            $stmnt = $conn->prepare("SELECT * FROM `tbl_indigency` WHERE (`lname` LIKE '%$keyword%' or  `mi` LIKE '%$keyword%' or  `fname` LIKE '%$keyword%' or  `track_id` LIKE '%$keyword%') AND `form_status` = '$formStatus'");
            $stmnt->execute();
            
            while($view_approved = $stmnt->fetch()){
        ?>
 <tr>
                    <td> <?= $view_approved['track_id'];?> </td> 
                    <td> <?= $view_approved['lname'];?>, <?= $view_approved['fname'];?> <?= $view_approved['mi'];?></td>
                    <td> <?= $view_approved['nationality'];?> </td>
                    <td> <?= $view_approved['houseno'];?>, <?= $view_approved['street'];?>, <?= $view_approved['brgy'];?>, <?= $view_approved['municipal'];?> </td>
                    <td> <?= $view_approved['purpose'];?> </td>
                    <td> <?= $view_approved['date'];?> </td>
                    <td> <?= $view_approved['form_status'];?> </td>
                    
                    
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
            <th> Tracking ID </th>
            <th> Full Name </th>
            <th> Nationality </th>
            <th> Address </th>
            <th> Purpose </th>
            <th> Date Requested</th>
            <th> Staff </th>
            <th> Status </th>
            <th> Date </th>
        </tr>
    </thead>
    
    <tbody>
        <?php if(is_array($view_approved)) {?>
            <?php foreach($view_approved as $view_approved) {?>
                <tr>
                    <td> <?= $view_approved['track_id'];?> </td> 
                    <td> <?= $view_approved['lname'];?>, <?= $view_approved['fname'];?> <?= $view_approved['mi'];?></td>
                    <td> <?= $view_approved['nationality'];?> </td>
                    <td> <?= $view_approved['houseno'];?>, <?= $view_approved['street'];?>, <?= $view_approved['brgy'];?>, <?= $view_approved['municipal'];?> </td>
                    <td> <?= $view_approved['purpose'];?> </td>
                    <td> <?= date('F d, Y', strtotime($view_approved['date'])); ?> </td>
                    <td> <?= $view_approved['staff'];?> </td>
                    <td> <?= $view_approved['form_status'];?> </td>
                    <td> <?= date('F d, Y', strtotime($view_approved['created_at'])); ?> </td>
                    
                    
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