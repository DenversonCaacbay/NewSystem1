<?php
	// require the database connection
	require 'classes/conn.php';
	if(isset($_POST['search_bspermit'])){
		$keyword = $_POST['keyword'];
?>
	<table class="table table-hover text-center table-bordered">

    <thead class="alert-info">
        <tr>
            <th hidden> Resident ID </th>
            <th> Tracking ID </th>
            <th> Full Name </th>
            <th> Business Name </th>
            <th> Address </th>
            <th> Business Industry </th>
            <th> Area of Establishment </th>
            <th> Staff</th>
            <th> Status</th>
        </tr>
    </thead>

    <tbody>     
        <?php

        $formStatus = $_POST['form_status'];
            
        $stmnt = $conn->prepare("SELECT * FROM `tbl_bspermit` WHERE 
            (
                `lname` LIKE '%$keyword%' OR  
                `mi` LIKE '%$keyword%' OR  
                `fname` LIKE '%$keyword%' OR  
                `bsname` LIKE '%$keyword%' OR  
                `id_resident` LIKE '%$keyword%' OR  
                `houseno` LIKE '%$keyword%' OR  
                `street` LIKE '%$keyword%' OR  
                `brgy` LIKE '%$keyword%' OR  
                `municipal` LIKE '%$keyword%' OR  
                `bsindustry` LIKE '%$keyword%' OR  
                `aoe` LIKE '%$keyword%' OR
                `track_id` LIKE '%$keyword%'
            )
            AND `form_status` = '$formStatus'");
            $stmnt->execute();
            
            while($view_all = $stmnt->fetch()){
        ?>
<tr>
                    <td hidden> <?= $view_all['id_resident'];?> </td> 
                    <td> <?= $view_all['track_id'];?> </td> 
                    <td> <?= $view_all['lname'];?>, <?= $view_all['fname'];?> <?= $view_all['mi'];?></td>
                    <td> <?= $view_all['bsname'];?> </td>
                    <td> <?= $view_all['houseno'];?>, <?= $view_all['street'];?>, <?= $view_all['brgy'];?>, <?= $view_all['municipal'];?></td>
                    <td> <?= $view_all['bsindustry'];?> </td>
                    <td> <?= $view_all['aoe'];?> </td>
                    <td> <?= $view_all['staff'];?> </td>
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
            <th> Tracking ID </th>
            <th> Full Name </th>
            <th> Date Requested</th>
            <th> Business Name </th>
            <th> Address </th>
            <th> Business Industry </th>
            <th> Area of Establishment </th>
            <th> Staff</th>
            <th> Status</th>
            <th> Date</th>
        </tr>
    </thead>

    <tbody>
        <?php if(is_array($view_all)) {?>
            <?php foreach($view_all as $view_all) {?>
                <tr>
                    <td hidden> <?= $view_all['id_resident'];?> </td> 
                    <td> <?= $view_all['track_id'];?> </td> 
                    <td> <?= $view_all['lname'];?>, <?= $view_all['fname'];?> <?= $view_all['mi'];?></td>
                    <td> <?= date('F d, Y', strtotime($view_all['date'])); ?> </td>
                    <td> <?= $view_all['bsname'];?> </td>
                    <td> <?= $view_all['houseno'];?>, <?= $view_all['street'];?>, <?= $view_all['brgy'];?>, <?= $view_all['municipal'];?></td>
                    <td> <?= $view_all['bsindustry'];?> </td>
                    <td> <?= $view_all['aoe'];?> </td>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/js/bootstrap-modalmanager.min.js" integrity="sha512-/HL24m2nmyI2+ccX+dSHphAHqLw60Oj5sK8jf59VWtFWZi9vx7jzoxbZmcBeeTeCUc7z1mTs3LfyXGuBU32t+w==" crossorigin="anonymous"></script>
<!-- responsive tags for screen compatibility -->
<meta name="view_allport" content="width=device-width, initial-scale=1 shrink-to-fit=no">
<!-- custom css --> 
<link href="../BarangaySystem/customcss/regiformstyle.css" rel="stylesheet" type="text/css">
<!-- bootstrap css --> 
<link href="../BarangaySystem/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"> 
<!-- fontawesome icons -->
<script src="https://kit.fontawesome.com/67a9b7069e.js" crossorigin="anonymous"></script>
<script src="../BarangaySystem/bootstrap/js/bootstrap.bundle.js" type="text/javascript"> </script>

<?php
	}
$con = null;
?>