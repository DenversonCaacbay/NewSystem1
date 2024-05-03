<?php
   error_reporting(E_ALL ^ E_WARNING);
   ini_set('display_errors',0);
   require('classes/resident.class.php');
   $userdetails = $bmis->get_userdata();
   $bmis->validate_admin();
//    $bmis->create_announcement();
//    $bmis->delete_announcement();
//    $view = $bmis->view_announcement();
   $view = $residentbmis->view_single_brgyid();
   
   $announcementcount = $bmis->count_announcement();

   $dt = new DateTime("now", new DateTimeZone('Asia/Manila'));
   $tm = new DateTime("now", new DateTimeZone('Asia/Manila'));
   $cdate = $dt->format('Y/m/d');   
   $ctime = $tm->format('H');

?>

<link rel="stylesheet" href="css/pdf_viewer.css"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
 <script>
        window.onload = function() {
            // Get the req_id from the URL query parameters
            const urlParams = new URLSearchParams(window.location.search);
            const reqId = urlParams.get('id');
            
            // Set the PDF URL with the req_id
            const pdfUrl = "generatePdf/generate_brgyid.php?pdf=1&id=" + reqId;
            
            // Embed the PDF within the page
            document.getElementById('pdfContainer').innerHTML = '<embed src="' + pdfUrl + '" type="application/pdf" />';
        }
    </script>
    <div class="container-fluid container--viewer p-0">
        <div class="viewerTop d-flex sticky-top justify-content-between">
            <div class="d-flex align-items-center">
                <a href="admn_brgyid.php" class="btn btn-primary me-2"><i class="fas fa-arrow-left me-2"></i>Back</a>
                <h3 class="viewer-text">Barangay ID PDF Viewer</h3>
            </div>
            <div class="d-flex">
                <button class="btn btn-primary me-3" id="printButton">Print <i class="fas fa-print ms-1"></i></button>
                <button class="btn btn-primary me-3" id="markAsDoneButton" disabled>Mark As Done <i class="fas fa-check"></i></button>
                <button class="btn btn-danger"> Decline <i class="fas fa-times"></i></button>
            </div>
            
        </div>
        
        <div class="viewer-content d-flex justify-content-between">
        <div class="text-center m-5"><img src="assets/default-thumbnail.jpg" alt="ID IMAGE" class="viewer--img"></div>
            <div class="w-100 me-3">
                
                <label class="mt-3">Name: </label>
                <input type="text" class="form-control" value="<?= $view['fname']." ".$view['lname'] ?>" readonly />
                <label class="mt-3">Address: </label>
                <textarea class="form-control" readonly><?= $view['houseno']." ".$view['street']." ".$view['brgy']." ".$view['municipal'] ?></textarea>                
                <label class="mt-3">Birthdate: </label>
                <input type="text" class="form-control" value="<?= $view['bdate']?>" readonly />
                <p class="fw-bold mt-3">Contact in Case of Emergency: </p>
                <label class="">Name</label>
                <input type="text" value="<?= $view['inc_fname']." ".$view['inc_fname'] ?>" class="form-control" readonly/>
                <label class="mt-3">Contact Number</label>
                <input type="text" class="form-control" value="<?= $view['inc_contact'] ?>" readonly/>
                <label class="mt-3">Urgent:</label>
                <textarea class="form-control" name="urgent" id="" cols="30" rows="5"readonly><?= $view['is_urgent'] ?></textarea>
            </div>
            <div class="mt-3">
                <div class="pdfContainerUI" id="pdfContainer"></div>
                <!-- <button class="btn btn-primary mt-3" id="printButton">Print</button>
                <button class="btn btn-primary mt-3" id="markAsDoneButton" disabled>Mark As Done</button> -->
            </div>
        </div>
        
    </div>

    <script>
    document.getElementById('printButton').addEventListener('click', function() {
        // Get the req_id from the URL query parameters
        const urlParams = new URLSearchParams(window.location.search);
        const reqId = urlParams.get('id');
        
        // Set the PDF URL with the req_id
        const pdfUrl = "generatePdf/generate_brgyid.php?pdf=1&id=" + reqId;
        
        // Open the PDF in a new tab/window for printing
        const printWindow = window.open(pdfUrl, '_blank');
        
        // Function to initiate print after the PDF loads
        const printAfterLoad = function() {
            printWindow.print();
        };

        // Wait for the PDF to load, then trigger the print dialog
        if (printWindow === null) {
            alert('Please allow pop-ups for this site to print the PDF.');
        } else {
            if (printWindow.document.readyState === 'complete') {
                printAfterLoad();
            } else {
                printWindow.onload = printAfterLoad;
            }
        }

        // Directly initiate download
        const link = document.createElement('a');
        link.href = pdfUrl;
        link.download = 'barangay_id.pdf'; // Set the filename for download
        link.style.display = 'none'; // Hide the link
        document.body.appendChild(link);
        link.click(); // Simulate a click on the link
        document.body.removeChild(link); // Clean up the DOM

        // Enable "Mark As Done" button
        document.getElementById('markAsDoneButton').disabled = false;
        document.getElementById('printButton').disabled = true;
    });

    document.getElementById('markAsDoneButton').addEventListener('click', function() {
        // Perform actions when "Mark As Done" button is clicked
        alert('Mark As Done button clicked.');
    });
</script>
    
