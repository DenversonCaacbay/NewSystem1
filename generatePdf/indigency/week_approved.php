<?php
session_start();

require_once '../pdf1.php';
require_once '../config.php';

$today = date('Y-m-d');
$startOfWeek = date('Y-m-d', strtotime('this week', strtotime($today)));
$endOfWeek = date('Y-m-d', strtotime('next week', strtotime($today)));


$query = "SELECT * FROM tbl_indigency WHERE (form_status ='Approved') AND date >= '$startOfWeek' AND date < '$endOfWeek'";
$result = $conn->query($query);

$html = '
<style>
#customers {
  font-family: DejaVu Sans, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
  font-size: 12px;
}


#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #309464;
  color: white;
}
#customers td.product-name {
  word-wrap: break-word;
  max-width: 150px; /* Set a maximum width to control line breaks */
}
</style>

<h1 style="text-align:center">Weekly Indigency Report</h1>
<h4>Week Generated:  '.date("F d, Y", strtotime($startOfWeek)).'  - '.date("F d, Y", strtotime($endOfWeek)).'</h4>
<h4>Document Type: Residency</h4>
';

// Count the number of rows
$rowCount = $result->num_rows;



$html .= '<table id="customers">';
$html .= '<tr>
<th width="20%">Tracking ID</th>
<th width="20%">Resident Name</th>
<th width="20%">Date Requested</th>
<th width="20%">Status</th>
<th width="20%">Staff</th>
<th width="20%">Date</th>
</tr>';
$totalSales = 0;
if ($rowCount > 0) {
  while ($row = $result->fetch_assoc()) {
    $html .= '<tr>';
    $html .= '<td>' . $row['track_id'] .  '</td>';
    $html .= '<td>' . $row['lname'] .  ', ' . $row['fname'] .  '</td>';
    $html .= '<td>' . date('F d,Y', strtotime($row['date'])) . '</td>';
    $html .= '<td>' . $row['form_status'] .  '</td>';
    $html .= '<td>' . $row['staff'] .  '</td>';
    $html .= '<td>' . date('F d,Y', strtotime($row['created_at'])) . '</td>';
    $html .= '</tr>';
  }
    // Display total sales row
} else {
  $html .= '<tr><td colspan="3">No report this week.</td></tr>';
}

$html .= '</table>';

$pdf = new Pdf();
$file_name = 'Weekly Report - Indigency -'.$today.'.pdf';
$pdf->loadHtml($html);
$pdf->setPaper('A4', 'portrait');
$pdf->render();
$pdf->stream($file_name, array("Attachment" => false));
?>
