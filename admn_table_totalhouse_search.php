<?php
	// require the database connection
	require 'classes/conn.php';
	if(isset($_POST['search_household'])){
		$keyword = $_POST['keyword'];
?>

<table class="table table-hover table-bordered table-responsive text-center" >
	<thead class="alert-info">
		<tr>
			<th> Family Surname </th>
			<th> House no. </th>
			<th> Street </th>
			<th> Barangay</th>  
			<th> Municipality </th> 
			<th> Total </th>
		</tr>
	</thead>

	<tbody>
		<?php
			
			$stmnt = $conn->prepare("SELECT 
					sub.* 
				FROM (
					SELECT 
						houseno, 
						COUNT(*) AS houseno_count,
						MAX(lname) AS lname,
						MAX(street) AS street,
						MAX(brgy) AS brgy,
						MAX(municipal) AS municipal
					FROM 
						tbl_resident
					GROUP BY 
						houseno
				) AS sub
				WHERE 
					sub.lname LIKE '%$keyword%'
					OR sub.street LIKE '%$keyword%'
					OR sub.brgy LIKE '%$keyword%'
					OR sub.municipal LIKE '%$keyword%';
		");
			$stmnt->execute();
			
			while($view = $stmnt->fetch()){
		?>
			<tr>
				<td> <?= $view['lname'];?> </td>
				<td> <?= $view['houseno'];?> </td>
				<td> <?= $view['street'];?> </td>
				<td> <?= $view['brgy'];?> </td>
				<td> <?= $view['municipal'];?> </td>
				<td> <?= $view['houseno_count'];?> </td>
			</tr>
		<?php
		}
		?>
	</tbody>
</table>

<?php		
	}else{
?>

<table class="table table-hover table-bordered table-responsive text-center">
	<thead class="alert-info">
		<tr>
			<th> Family Surname </th>
			<th> House no. </th>
			<th> Street </th>
			<th> Barangay</th>  
			<th> Municipality </th> 
			<th> Total </th>
		</tr>
	</thead>

	<tbody>
		<?php if(is_array($view)) {?>
			<?php foreach($view as $view) {?>
				<tr>
					<td> <?= $view['lname'];?> </td>
					<td> <?= $view['houseno'];?> </td>
					<td> <?= $view['street'];?> </td>
					<td> <?= $view['brgy'];?> </td>
					<td> <?= $view['municipal'];?> </td>
					<td> <?= $view['houseno_count'];?> </td>
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
<meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no">
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