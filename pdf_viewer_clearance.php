<?php
   error_reporting(E_ALL ^ E_WARNING);
   ini_set('display_errors',0);
   require('classes/resident.class.php');
   $userdetails = $bmis->get_userdata();
   $bmis->validate_admin();
   $bmis->create_announcement();
   $bmis->delete_announcement();
   $view = $bmis->view_announcement();
   $announcementcount = $bmis->count_announcement();

   $dt = new DateTime("now", new DateTimeZone('Asia/Manila'));
   $tm = new DateTime("now", new DateTimeZone('Asia/Manila'));
   $cdate = $dt->format('Y/m/d');   
   $ctime = $tm->format('H');

?>

<?php 
    include('dashboard_sidebar_start.php');
?>
<style>
    .container--viewer{
        height: 400px;
    }
    .viewer-text{
        font-size: 25px;
    }
    .form-control{
        width: 100%;
    }
    .viewer--img{
        width: 100px;
    }
</style>
 <script>
        window.onload = function() {
            // Get the req_id from the URL query parameters
            const urlParams = new URLSearchParams(window.location.search);
            const reqId = urlParams.get('id');
            
            // Set the PDF URL with the req_id
            const pdfUrl = "generatePdf/generate_residency.php?pdf=1&id=" + reqId;
            
            // Embed the PDF within the page
            document.getElementById('pdfContainer').innerHTML = '<embed src="' + pdfUrl + '" width="500px" height="400px" type="application/pdf" />';
        }
    </script>
    <div class="container-fluid container--viewer">
        <div class="d-flex justify-content-between">
            <h3 class="viewer-text">Barangay Residency PDF Viewer</h3>
            <a href="admn_certofres.php" class="btn btn-primary">Back</a>
            
        </div>
        
        <div class="d-flex justify-content-between">
            <div class="w-100 me-3">
                Resident<br>
                <div class="text-center"><img src="assets/default-thumbnail.jpg" alt="ID IMAGE" class="viewer--img"></div>
                
                <label class="mt-3">Name</label>
                <input type="text" class="form-control"/>
                <label class="mt-3">Address</label>
                <input type="text" class="form-control"/>
                <label class="mt-3">Birthdate</label>
                <input type="text" class="form-control"/>

                Contact Incase of Emergency:<br>
                <label class="mt-3">Name</label>
                <input type="text" class="form-control"/>
                <label class="mt-3">Contact Number</label>
                <input type="text" class="form-control"/>
                <label class="mt-3">Address</label>
                <input type="text" class="form-control"/>
            </div>
            <div class="mt-3">
                <div id="pdfContainer"></div>
                <button class="btn btn-primary mt-3" id="printButton">Print</button>
                <button class="btn btn-primary mt-3" id="markAsDoneButton" disabled>Mark As Done</button>
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
    
