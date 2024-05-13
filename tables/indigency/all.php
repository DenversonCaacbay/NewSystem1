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
            
            while($view_all = $stmnt->fetch()){
        ?>
 <tr>
                    <td> <?= $view_all['track_id'];?> </td> 
                    <td> <?= $view_all['lname'];?>, <?= $view_all['fname'];?> <?= $view_all['mi'];?></td>
                    <td> <?= $view_all['nationality'];?> </td>
                    <td> <?= $view_all['houseno'];?>, <?= $view_all['street'];?>, <?= $view_all['brgy'];?>, <?= $view_all['municipal'];?> </td>
                    <td> <?= $view_all['purpose'];?> </td>
                    <td> <?= $view_all['date'];?> </td>
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
        <?php if(is_array($view_all)) {?>
            <?php foreach($view_all as $view_all) {?>
                <tr>
                    <td> <?= $view_all['track_id'];?> </td> 
                    <td> <?= $view_all['lname'];?>, <?= $view_all['fname'];?> <?= $view_all['mi'];?></td>
                    <td> <?= $view_all['nationality'];?> </td>
                    <td> <?= $view_all['houseno'];?>, <?= $view_all['street'];?>, <?= $view_all['brgy'];?>, <?= $view_all['municipal'];?> </td>
                    <td> <?= $view_all['purpose'];?> </td>
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