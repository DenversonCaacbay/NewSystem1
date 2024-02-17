<?php
session_start();

require_once '../pdf1.php';
require_once '../config.php';

$today = date('Y-m-d');
$currentMonth = date('Y-m');

$query = "SELECT * FROM tbl_rescert WHERE form_status='Approved' AND  DATE_FORMAT(date, '%Y-%m') = '$currentMonth'";
$result = $conn->query($query);

// Generate the report HTML
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
<h1 style="text-align:center">Monthly Report</h1>
<h4>Month Generated:  '.date("F, Y", strtotime($today)).'</h4>
<h4>Document Type: Residency</h4>

';
$rowCount = $result->num_rows;



$html .= '<table id="customers">';
$html .= '<tr>
<th width="20%">Tracking ID</th>
<th width="40%">Resident Name</th>
<th width="40%">Pick Up Date</th>
</tr>';
$totalSales = 0;
if ($rowCount > 0) {
  while ($row = $result->fetch_assoc()) {
    $html .= '<tr>';
    $html .= '<td>' . $row['track_id'] .  '</td>';
    $html .= '<td>' . $row['lname'] .  ', ' . $row['fname'] .  '</td>';
    $html .= '<td>' . date('F d,Y', strtotime($row['date'])) . '</td>';
    $html .= '</tr>';
  }
    // Display total sales row
} else {
  $html .= '<tr><td colspan="3">No report this month.</td></tr>';
}

$html .= '</table>';

$pdf = new Pdf();

 $file_name = 'Monthly Report -'.$today.'.pdf';
 $pdf->loadHtml($html);
 $pdf->setPaper('A4', 'portrait');
 $pdf->render();
 $pdf->stream($file_name, array("Attachment" => false));

?>
