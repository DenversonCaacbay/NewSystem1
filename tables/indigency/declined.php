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
            
            while($view_declined = $stmnt->fetch()){
        ?>
 <tr>
                    <td> <?= $view_declined['track_id'];?> </td> 
                    <td> <?= $view_declined['lname'];?>, <?= $view_declined['fname'];?> <?= $view_declined['mi'];?></td>
                    <td> <?= $view_declined['nationality'];?> </td>
                    <td> <?= $view_declined['houseno'];?>, <?= $view_declined['street'];?>, <?= $view_declined['brgy'];?>, <?= $view_declined['municipal'];?> </td>
                    <td> <?= $view_declined['purpose'];?> </td>
                    <td> <?= $view_declined['date'];?> </td>
                    <td> <?= $view_declined['form_status'];?> </td>
                    
                    
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
        <?php if(is_array($view_declined)) {?>
            <?php foreach($view_declined as $view_declined) {?>
                <tr>
                    <td> <?= $view_declined['track_id'];?> </td> 
                    <td> <?= $view_declined['lname'];?>, <?= $view_declined['fname'];?> <?= $view_declined['mi'];?></td>
                    <td> <?= $view_declined['nationality'];?> </td>
                    <td> <?= $view_declined['houseno'];?>, <?= $view_declined['street'];?>, <?= $view_declined['brgy'];?>, <?= $view_declined['municipal'];?> </td>
                    <td> <?= $view_declined['purpose'];?> </td>
                    <td> <?= date('F d, Y', strtotime($view_declined['date'])); ?> </td>
                    <td> <?= $view_declined['staff'];?> </td>
                    <td> <?= $view_declined['form_status'];?> </td>
                    <td> <?= date('F d, Y', strtotime($view_declined['created_at'])); ?> </td>
                    
                    
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