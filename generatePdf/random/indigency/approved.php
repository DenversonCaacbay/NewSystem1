<?php
require_once '../../../dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bmis";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the fromDate and toDate from the form
$fromDate = $_POST["fromDate"];
$toDate = $_POST["toDate"];

// SQL query to select records from tbl_rescert within the specified date range and with status Approved or Declined
$query = "SELECT * FROM tbl_indigency WHERE (form_status = 'Approved') AND date BETWEEN '$fromDate' AND '$toDate'";

// Execute the query
$result = $conn->query($query);

// Check if there are any records
if ($result->num_rows > 0) {
    // Fetch all records and store them in an array
    $records = array();
    while ($row = $result->fetch_assoc()) {
        $records[] = $row;
    }

    // Close connection
    $conn->close();

    // Generate PDF using DOMPDF
    $html = '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
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
        </style>          
    </head>
    <body>
        <h1 style="text-align:center">Indigency Request Report</h1>
        <h4>From: ' . date('F d, Y', strtotime($fromDate)) . '</h4>
        <h4>To:   	&nbsp;	&nbsp;	&nbsp;' .date('F d, Y', strtotime($toDate)). '</h4>    
        <table id="customers">
            <thead>
                <tr>
                    <th>Tracking ID</th>
                    <th>Resident Name</th>
                    <th>Date Requested</th>
                    <th>Status</th>
                    <th>Staff</th>
                </tr>
            </thead>
            <tbody>';
    foreach ($records as $record) {
        $html .= '<tr>';
        $html .= '<td>' . $record['track_id'] . '</td>';
        $html .= '<td>' . $record['lname'] . ', ' . $record['fname'] . '</td>';
        $html .= '<td>' . date('F d, Y', strtotime($record['date'])) . '</td>';
        $html .= '<td>' . $record['form_status'] . '</td>';
        $html .= '<td>' . $record['staff'] . '</td>';
        $html .= '</tr>';
    }
    $html .= '</tbody>
        </table>
    </body>
    </html>';

    $dompdf = new Dompdf();
    // $file_name = 'Barangay ID Request Report-From-' . date('F d, Y', strtotime($fromDate)) . 'To-' . date('F d, Y', strtotime($toDate)) .'.pdf';
    $file_name = 'Indigency_Request_Report-Approved_From_' . date('F_d_Y', strtotime($fromDate)) . '_To_' . date('F_d_Y', strtotime($toDate)) .'.pdf';


    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // Output the generated PDF
    // $dompdf->stream("tbl_rescert_records.pdf", array("Attachment" => false));
    $dompdf->stream($file_name, array("Attachment" => true));
} else {
    echo '<script>alert("No records found");</script>';

    // Close connection
    $conn->close();
}
?>
