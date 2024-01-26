<?php

// Include necessary files and configurations here
require_once 'pdf.php';
include('database_connection.php');

// Image paths
$imagePath = '../images/santaritalogo.png';
$imagePath1 = '../images/rnplogo.png';
$imagePath2 = '../images/rowenacerezo2.png';
// $imagePath2 = '../images/rowenacerezo.png';


// Read image data
$imageData = file_get_contents($imagePath);
$imageData1 = file_get_contents($imagePath1);
$imageData2 = file_get_contents($imagePath2);

// Encode image data to base64
$imageBase64_1 = base64_encode($imageData);
$imageBase64_2 = base64_encode($imageData1);
$imageBase64_3 = base64_encode($imageData2);

// Current date
$today = date('F d, Y');
$validUntil = date("Y-m-d", strtotime($today . " +365 days")); // Add 30 days to today's date

// Print PDF if parameters are set
if (isset($_GET["pdf"]) && isset($_GET["id"])) {
    $output = '';
    $file_name = '';

    // Query to get clearance information
    $statement = $connect->prepare("SELECT * FROM tbl_brgyid WHERE id_brgyid = :id_brgyid LIMIT 1");
    $statement->execute(array(':id_brgyid' => $_GET["id"]));
    $result = $statement->fetch(PDO::FETCH_ASSOC);

  // Assuming the path is stored in the database

    // Check if clearance record exists
        if ($result) {
        // Read image file and convert to base64
        
        // Start building HTML content
        $output .= '
        <!doctype html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Print Clearance</title>
            <style type="text/css">
               .left {
                    width: 31%;
                    background: #fc4f2a;
                    text-align: center;
                    float: left;
               }
               .social {
                    background: #fff;
                    color: 000;
                    font-size: 12px;
                    line-height: 12px;
               }
               .pic {
                    background: #fc4f2a;
               }

               .right {
                    width: 67%;
                    float: left;
               }
               .header {
                    text-align: center;
                    width: 100%;
                    background: #fc4f2a;
                    padding: 10px;
               }
              .header1 {
                text-align: center;
                width: 100%;
                background: #fc4f2a;
                padding: 10px;
           }
               .sig1 {
                    margin-top: 50%;
               }
               .sig2 {
                    float: right;
               }
               h4{
                font-size:14px;
               }
            </style>
        </head>
       <br>
        </div>
        <div class="right">
          <div class="header">
            <table width="100%">
              <td> <img class="logo" src="data:image/jpeg;base64,'  . $imageBase64_1 . '" alt="Image" width="80"/></td>
              <td width="80%" align="center">
                  Republic of the Philippines<br>
                  Province of Zambales<br>
                  City of Olongapo<br>
                  BARANGAY STA. RITA<br>
                  <h3>Resident Identification Card</h3>
              </td>
              <td width="20%" style="text-align:center"><img class="logo" src="data:image/jpeg;base64,' . $imageBase64_2 . '" alt="Image" width="80" /></td>
            </table>
          </div>

          <table width="100%">
            <td width="39%" style="padding:10px;">
              <div style="height: 70px; width: 150px;height: 150px; border: 1px solid #000;"></div>
              <div style="text-align:center;font-size: 12px;">RES-037107015-'.$result["track_id"].'</div>

            </td>
            <td width="64%" style="padding: 5px;">
              <table style="text-align:center">
                  <tr>
                      <td><b>' . $result["fname"] . ' ' . $result["mi"] . ' ' . $result["lname"] . '</b><br>Name</td>
                  </tr>
                  <tr>
                      <td><b> ' . $result["street"] . ' STA. RITA, OLONGAPO CITY</b><br>Address</td>
                  </tr>
                  <tr>
                    <td><b>' . date('F d, Y', strtotime($result["bdate"])) . '</b><br>Date of Birth</td>
                  </tr>
                  <tr>
                    <td>______________________<br>Signature</td>
                  </tr>
              </table>
            </td>
          </table>

          <div class="header1">
            <table width="100%" style="text-align:center;background:#ffffff;border-radius:10px;">
               <tr>
                <td><b>Tin NO.</b><br>N/A</td>
                <td><b>GSIS/SSS NO.</b><br>N/A</td>
                <td><b>PHILHEALTH NO.</b><br>N/A</td>
               </tr>
               <tr>
                <td><b>PAGIBIG NO.</b><br>N/A</td>
                <td><b>VOTERS ID</b><br>N/A</td>
                <td><b>PRECINCT NO.</b><br>N/A</td>
               </tr>
               <tr>
                <td><b>BLOOD TYPE</b><br>N/A</td>
                <td><b></b></td>
                <td><b>ORGAIN DONOR</b><br>N/A</td>
               </tr>
            </table>
            <table width="100%" style="text-align:center">
            <th width="50%">In case of Emergency, Please Notify:<br>' . $result["inc_lname"] . ', ' . $result["inc_fname"] . ' ' . $result["inc_mi"] . '<br>' . $result["inc_contact"] . '<<th>
            <th width="0%">      <th>
            <th width="50%">Valid Until:<br>'.date('F d, Y', strtotime($validUntil)).'<th>
            </table>
            <br>
            <div width="100%"><b>HON ROWENA V. CEREZO</b><br>Punong Barangay</div>
            <br>
            <div width="100%">Barangay Comprehensive Management Platform (BCMP)</div>
            <br>

          </div>      
        </div>   
      </body>
    </html>';

        // Instantiate PDF class
        $pdf = new Pdf();
        // Generate PDF
        $file_name = 'Clearance-' . $result["id_resident"] . '.pdf';
        $pdf->loadHtml($output);

        // Set page margins
        // $pdf->set_option('margin-top', '5mm');
        // $pdf->set_option('margin-right', '5mm');
        // $pdf->set_option('margin-bottom', '5mm');
        // $pdf->set_option('margin-left', 'mm');

        $pdf->setPaper('A4', 'portrait');
        $pdf->render();

        // Output the generated PDF
        $pdf->stream($file_name, array("Attachment" => false));
    } else {
        // Handle case when no clearance record is found
        echo "Clearance record not found.";
    }
}
?>
