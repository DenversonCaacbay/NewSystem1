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
            
            while($view = $stmnt->fetch()){
        ?>
 <tr>
                    <td> <?= $view['track_id'];?> </td> 
                    <td> <?= $view['lname'];?>, <?= $view['fname'];?> <?= $view['mi'];?></td>
                    <td> <?= $view['nationality'];?> </td>
                    <td> <?= $view['houseno'];?>, <?= $view['street'];?>, <?= $view['brgy'];?>, <?= $view['municipal'];?> </td>
                    <td> <?= $view['purpose'];?> </td>
                    <td> <?= $view['date'];?> </td>
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
        <?php if(is_array($view)) {?>
            <?php foreach($view as $view) {?>
                <tr>
                    <td> <?= $view['track_id'];?> </td> 
                    <td> <?= $view['lname'];?>, <?= $view['fname'];?> <?= $view['mi'];?></td>
                    <td> <?= $view['nationality'];?> </td>
                    <td> <?= $view['houseno'];?>, <?= $view['street'];?>, <?= $view['brgy'];?>, <?= $view['municipal'];?> </td>
                    <td> <?= $view['purpose'];?> </td>
                    <td> <?= date('F d, Y', strtotime($view['date'])); ?> </td>
                    <td> <?= $view['staff'];?> </td>
                    <td> <?= $view['form_status'];?> </td>
                    <td> <?= date('F d, Y', strtotime($view['created_at'])); ?> </td>
                    
                    
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