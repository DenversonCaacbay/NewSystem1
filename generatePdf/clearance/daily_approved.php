<?php
session_start();

require_once '../pdf1.php';
require_once '../config.php';

$today = date('Y-m-d');

$query = "SELECT * FROM tbl_clearance WHERE (form_status ='Approved') AND DATE(created_at) = '$today' ";
$stmt = $conn->prepare($query);
// $stmt->bind_param("s", $today);
$stmt->execute();
$result = $stmt->get_result();

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
<h1 style="text-align:center">Daily Barangay Clearance Report</h1>
<h4>Day Generated: ' . date("F d, Y", strtotime($today)) . '</h4>
<table id="customers">
  <tr>
    <th width="20%">Tracking ID</th>
    <th width="20%">Resident Name</th>
    <th width="20%">Date Requested</th>
    <th width="20%">Status</th>
    <th width="20%">Staff</th>
  </tr>';

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $html .= '<tr>';
    $html .= '<td>' . $row['track_id'] .  '</td>';
    $html .= '<td>' . $row['lname'] .  ', ' . $row['fname'] .  '</td>';
    $html .= '<td>' . date('F d, Y', strtotime($row['date'])) . '</td>';
    $html .= '<td>' . $row['form_status'] .  '</td>';
    $html .= '<td>' . $row['staff'] .  '</td>';
    $html .= '</tr>';
  }
} else {
  $html .= '<tr><td colspan="3">No report for today.</td></tr>';
}

$html .= '</table>';

$pdf = new Pdf();
$file_name = 'Daily Report - Barangay Clearance -' . $today . '.pdf';

$pdf->loadHtml($html);
$pdf->setPaper('A4', 'portrait');
$pdf->render();
$pdf->stream($file_name, array("Attachment" => false));
?>
