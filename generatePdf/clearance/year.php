<?php
session_start();


// Create a new Dompdf instance
require_once '../pdf1.php';
require_once '../config.php';
// Fetch today's date
$today = date('Y-m-d');
$currentMonth = date('Y-m');



// Fetch data from the shop_inventory table based on today's date
$query = "SELECT * FROM tbl_clearance WHERE form_status='Approved' AND DATE_FORMAT(created_at, '%Y-%m') = '$currentMonth'";
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


<h1 style="text-align:center">Yearly Report</h1>
<h4>Year Generated:  '.date("Y", strtotime($today)).'</h4>
<h4>Document Type: Barangay Clearance</h4>

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
    $html .= '<td>' . date('F d,Y', strtotime($row['created_at'])) . '</td>';
    $html .= '</tr>';
  }
    // Display total sales row
} else {
  $html .= '<tr><td colspan="3">No report this year.</td></tr>';
}

$html .= '</table>';
// $pdf = new Pdf();

// Load the HTML into dompdf
$pdf = new Pdf();
// $dompdf->loadHtml(html_entity_decode($html));
//landscape orientation
 $file_name = 'Yearly Report -'.$today.'.pdf';
 $pdf->loadHtml($html);
 $pdf->setPaper('A4', 'portrait');
 $pdf->render();
 $pdf->stream($file_name, array("Attachment" => false));

// Output the generated PDF to the browser
// $dompdf->stream('daily_report.pdf');
?>
