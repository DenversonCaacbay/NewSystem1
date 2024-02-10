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
$validUntil = date("Y-m-d", strtotime($today . " +27 days")); // Add 30 days to today's date
// Print PDF if parameters are set
if (isset($_GET["pdf"]) && isset($_GET["id"])) {
    $output = '';
    $file_name = '';

    // Query to get clearance information
    $statement = $connect->prepare("SELECT * FROM tbl_bspermit WHERE id_resident = :id_resident LIMIT 1");
    $statement->execute(array(':id_resident' => $_GET["id"]));
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    // Check if clearance record exists
    if ($result) {
        // Start building HTML content
        $output .= '
        <!doctype html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Print Business Recommendation</title>
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
                    float: right;
               }
               .header {
                    text-align: center;
                    width: 100%;
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
        <body class="page-border">
        <div class="left">
        <img class="logo" src="data:image/jpeg;base64,' . $imageBase64_1 . '" alt="Image" width="120"/>
       <br>
        <h5 style="text-align:left;line-height:5px;margin-left:15px;">HONORABLE</h5>

        <h5 style="line-height:1px; letter-spacing: 2px;">ROWENA VILLANUEVA</h5>

        <h2 style="font-size: 30px;line-height:5px;letter-spacing: 8px;">CEREZO</h2>
        <h4 style="line-height:0px;">P U N O N G B A R A N G A Y</h4>
        <h4 style="line-height:15px;">HON. JOSHUA ABUYOT GARDON</h4>
        <h4 style="line-height:0px;">Barangay Kagawad</h4>
        <h4 style="line-height:15px;">HON. RONALD BERNARDINO</h4>
        <h4 style="line-height:0px;">GUEVARRA</h4>
        <h4 style="line-height:0px;">Barangay Kagawad</h4>
        <h4 style="line-height:0px;">HON. JOELITO TAGULAO</h4>
        <h4 style="line-height:0px;">CRUZ, JR.</h4>
        <h4 style="line-height:0px;">Barangay Kagawad</h4>
        <h4 style="line-height:15px;">HON. RAQUEL YABUT ATIENZA</h4>
        <h4 style="line-height:5px;">Barangay Kagawad</h4>
        <h4 style="line-height:15px;">HON. RODMAN ASUNCION BARROGA</h4>
        <h4 style="line-height:0px;">Barangay Kagawad</h4>
        <h4 style="line-height:20px;">HON DOLORES DE MESA VALDEZ</h4>
        <h4 style="line-height:0px;">Barangay Kagawad</h4>
        <h4 style="line-height:5px;">HON. JERRY CARPIO NIDOY</h4>
        <h4 style="line-height:0px;">Barangay Kagawad</h4>
        <h4 style="line-height:5px;">HON. PRECIOUS NINA OMEGA</h4>
        <h4 style="line-height:0px;">DELOS REYES</h4>
        <h4 style="line-height:0px;">SK Chairman</h4>
        <div class="social">
        Facebook Page - Barangay STA. RITA - OLONGAPO<br>
        LANDLINE # - 047 222 9225<br>
        FRADRU HOTLINE - 0931 833 0804<br>
        BPAT HOTLINE (SMART) - 0981 602 2965<br>
        BPAT HOTLINE (GLOBE) - 0945 664 9008<br>
        PNP STATION 5 - 047 222 0402<br>
        </div>
        <div class="pic">
        <img class="logo" src="data:image/jpeg;base64,' . $imageBase64_3 . '" alt="Image" width="150"/>
        </div>
        </div>
        <div class="right">
          <div class="header">
            <table width="100%">
              <td width="80%" align="center">
                  Republic of the Philippines<br>
                  CITY OF OLONGAPO<br>
                  BARANGAY STA. RITA<br>
                Horshoe Drive, Sta. Rita, Olongapo City<br>
                  <h3><u>OFFICE OF THE PUNONG BARANGAY</u></h3>
                  <h3>ENDORSEMENT</h3>
                  <h3>STR-BPI-2024-1988</h3>
              </td>
              <td width="20%" style="text-align:center"><img class="logo" src="data:image/jpeg;base64,' . $imageBase64_2 . '" alt="Image" width="80" /></td>
            </table>
          </div>
          <div style="text-align:center">
         <u style="font-size:18px;  font-weight: bold;">' . $result["bsname"] .'</u>  <br>
          (Business Name or Trade Company)<br><br>
         <u style="font-size:18px; font-weight: bold;"> ' . $result["houseno"] . ' ' . $result["street"] . ' '. $result["brgy"] .', Olongapo City</u><br>
          (Address)<br><br>
          <u style="font-size:18px; font-weight: bold;">' . $result["lname"] . ', ' . $result["fname"] . ' ' . $result["mi"] . '</u><br>
          (Operator/Manager)<br><br>
          <u style="font-size:18px; font-weight: bold;">' . $result["houseno"] . ' ' . $result["street"] . ' '. $result["brgy"] .', Olongapo City, Zambales<br>REGION 3 (CENTRAL LUZON)</u><br>
          (Address)<br>
          </div>

          <table width="100%">
            <td style="padding: 5px;">
              
              <h5> applying for the corresponding BUSINESS PERMIT that has been found to be:<br>
              __ COMPLIANT with the provisions of existing Barangay Ordinance, rules and regulations being enforced in this barangay;<br>
              __ NON-COMPLIANT with the provisions of existing Barangay Ordinance, rulend regulations being enforced in this barangay;<br><br>
              In view of the foregoing, this barangay, thru the undersigned.<br>
              __ Interposes NO OBJECTION for the issuance of the corresponding Mayor`s Permit being applied for.<br>
              __ Recommends for the NON-ISSUANCE of the corresponding Mayor`s Permit being applied for.<br>
              </h5>
              <table>

                  <br>
                  <br>
                  <br>

                  <table>
                    <tr><td style="font-size:13px;">DATE ISSUED: '.date("F d, Y", strtotime($today)).'</td></tr>
                    <tr><td style="font-size:13px;">VALID UNTIL: '. date("F d, Y", strtotime($validUntil)) . '</td></tr>
                    <tr><td style="font-size:13px;">DOCUMENT NO: '.$result["track_id"].'</td></tr>
                    
                  </table> 
              </table>
            </td>
            <td>
<br>
<br>
<br>
<br>
            </td>
            
          </table>
            
        </div>
            <!-- Your HTML content here -->
            
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
