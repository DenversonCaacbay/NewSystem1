<?php
   error_reporting(E_ALL ^ E_WARNING);
   ini_set('display_errors',1);
   require('classes/resident.class.php');
   $userdetails = $bmis->get_userdata();
   $bmis->validate_admin();
//    $bmis->create_announcement();
//    $bmis->delete_announcement();
//    $view = $bmis->view_announcement();
    $bmis->reject_bspermit();
    $bmis->approved_bspermit();

    $view = $residentbmis->view_single_bspermit();

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
            const pdfUrl = "generatePdf/generate_businesspermit.php?pdf=1&id=" + reqId;
            
            // Embed the PDF within the page
            document.getElementById('pdfContainer').innerHTML = '<embed src="' + pdfUrl + '" width="500px" height="500px" type="application/pdf" />';
        }
    </script>
    <div class="container-fluid container--viewer p-0">

        <div class="viewerTop sticky-top p-0">
            <form action="" method="post" class="p-2">
                <div class="d-flex justify-content-between">
                    <div class=" d-flex align-items-center">
                        <a href="admn_bspermit.php" class="btn btn-primary me-2"><i class="fas fa-arrow-left me-2"></i>Back</a>
                        <h5 class="viewer-text">Business Recommendation PDF Viewer</h5>
                    </div>
                    <div>
                        <input type="hidden" name="id_bspermit" value="<?= $view['id_bspermit'];?>">
                        <input type="hidden" name="email" value="<?= $view['email'];?>">
                        <input type="hidden" name="staff" value="<?= $userdetails['firstname']?> <?= $userdetails['surname']?> ">
                        <button class="btn btn-primary me-3" id="printButton">Print <i class="fas fa-print ms-1"></i></button>
                        <button class="btn btn-primary me-3" id="markAsDoneButton" type="submit" name="approved_bspermit" disabled> Mark As Done </button>
                        <button class="btn btn-danger" id="declineButton" name="reject_bspermit"> Decline <i class="fas fa-times"></i></button> 
                    </div>  
                </div>
            </form>
        </div>
        
        <div class="viewer-content d-flex justify-content-between">
        <div class="text-center m-5"><img src="assets/default-thumbnail.jpg" alt="ID IMAGE" class="viewer--img"></div>
            <div class="w-100 me-3">
                
                
                <label class="mt-3">Name</label>
                <input type="text" class="form-control" value="<?= $view['fname']." ".$view['lname'] ?>" readonly/>
                <label class="mt-3">Business Name: </label>
                <input type="text" class="form-control" value="<?= $view['bsname'] ?>"/>
                <label class="mt-3">Address</label>
                <textarea class="form-control" readonly><?= $view['houseno']." ".$view['street']." ".$view['brgy']." ".$view['municipal'] ?></textarea>                
s                <label class="mt-3">Business Industry</label>
                <input type="text" class="form-control" value="<?= $view['bsindustry'] ?>" readonly/>
                <label class="mt-3">Area of Establishment</label>
                <input type="text" class="form-control" value="<?= $view['aoe'] ?>" readonly/>
                <label class="mt-3">Urgent:</label>
                <textarea class="form-control" name="urgent" id="" cols="30" rows="5"readonly><?= $view['is_urgent'] ?></textarea>
            </div>
            <div class="mt-3">
                <div class="pdfContainerUI" id="pdfContainer"></div>
            </div>
        </div>
        
    </div>

    <script>
    document.getElementById('printButton').addEventListener('click', function() {
        // Get the req_id from the URL query parameters
        const urlParams = new URLSearchParams(window.location.search);
        const reqId = urlParams.get('id');
        
        // Set the PDF URL with the req_id
        const pdfUrl = "generatePdf/generate_businesspermit.php?pdf=1&id=" + reqId;
        
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
        link.download = 'Business-Recommendation.pdf'; // Set the filename for download
        link.style.display = 'none'; // Hide the link
        document.body.appendChild(link);
        link.click(); // Simulate a click on the link
        document.body.removeChild(link); // Clean up the DOM

        // Enable "Mark As Done" button
        document.getElementById('markAsDoneButton').disabled = false;
        document.getElementById('printButton').disabled = true;
    });

    // document.getElementById('markAsDoneButton').addEventListener('click', function() {
    //     // Perform actions when "Mark As Done" button is clicked
    //     alert('Mark As Done button clicked.');
    // });
</script>
    
