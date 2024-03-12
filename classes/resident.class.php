
<head>
    <title> Barangay Santa Rita Management System </title>
        <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- put css/js here for clean look -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- responsive tags for screen compatibility -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- custom css --> 

    <!-- fontawesome icons --> 
    <script src="https://kit.fontawesome.com/67a9b7069e.js" crossorigin="anonymous"></script>
</head>
<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
    require_once('main.class.php');
    
    // // check if user is logged
    // if(!is_null($_SESSION['userdata'])){
    //     if($user_role == 'resident'){
    //         header('Location: resident_homepage.php');
    //     }
    //     else{
    //         header('Location: index.php');
    //     }
    // }

    class ResidentClass extends BMISClass {
        //------------------------------------ RESIDENT CRUD FUNCTIONS ----------------------------------------

        // Create Resident by admin or staff
        public function create_resident() {
            if(isset($_POST['add_resident'])) {
                $email = $_POST['email'];
                $password = ($_POST['password']);
                $confirm_password = ($_POST['confirm_password']);
                $lname = ucwords(strtolower($_POST['lname'])); // Convert to uppercase
                $fname = ucwords(strtolower($_POST['fname'])); // Convert to uppercase
                $mi = ucfirst(strtolower($_POST['mi']));
                $sex = $_POST['sex'];
                $status = $_POST['status'];
                $houseno = $_POST['houseno'];
                $purok = $_POST['purok'];
                $street = $_POST['street'];
                $brgy = $_POST['brgy'];
                $municipal = $_POST['municipal'];
                $address = isset($_POST['address']) ? $_POST['address'] : NULL;
                $contact = $_POST['contact'];
                $date_live = $_POST['date_live'];
        
                $bdate = $_POST['bdate'];
                $current_year = date("Y");
                $birth_year = date("Y", strtotime($bdate));
                $age = $current_year - $birth_year;
        
                $bplace = $_POST['bplace'];
                $nationality = $_POST['nationality'];
                $voter = $_POST['voter'];
                $familyrole = $_POST['family_role'];
                $role = $_POST['role'];

                $is_in_admin = $_POST['is_in_admin'] ?: "0";
                $is_verified = "Pending";

                if($is_in_admin == "1"){
                    $is_verified = "Yes";
                }
        
                // Check if user is 18
                if ($age < 18) {
                    $message = "Sorry, you are still underaged to register an account";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                    return false;
                }
        
                // Check if the password and confirm password match
                if ($password !== $confirm_password) {
                    $message = "Password and Confirm Password do not match";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                    return false;
                }
        
                // Check if the password is at least 8 characters long
                if (strlen($password) < 8) {
                    $message = "Password must be at least 8 characters long";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                    return false;
                }
        
                // Hash the password
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        
                $new_image = $_FILES['id_picture'];
        
                if (!empty($new_image['name'])) {
                    $target_dir = "uploads/residents_id/";
                    $file_extension = pathinfo($new_image['name'], PATHINFO_EXTENSION);
        
                    if (!is_dir($target_dir)) {
                        mkdir($target_dir, 0755, true);
                    }
        
                    $target_file = $target_dir . time() . '.' . $file_extension;
        
                    if (move_uploaded_file($new_image["tmp_name"], $target_file)) {
                        // proceed to create resident with image
                        $connection = $this->openConn();
                        $stmt = $connection->prepare("INSERT INTO tbl_resident (
                            `email`, `password`, `lname`, `fname`, `mi`, `age`, `sex`, `status`, `houseno`, 
                            `purok`, `street`, `brgy`, `municipal`, `address`, `contact`, `bdate`, 
                            `bplace`, `nationality`, `date_live`, `voter`, `family_role`, `role`, `valid_id_photo`,
                            `verified`
                        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            
                        $stmt->Execute([$email, $hashed_password, $lname, $fname, $mi, $age, $sex, $status, 
                        $houseno, $purok, $street, $brgy, $municipal, $address, $contact, $bdate, 
                        $bplace, $nationality, $date_live, $voter, $familyrole, $role, $target_file, $is_verified]);
        
                        $message2 = "Your account has been added. Please await approval from the administrator via email before logging in.";
                        echo "<script type='text/javascript'>alert('$message2');</script>";
        
                        if($is_in_admin == "1"){
                            echo '<script>window.location.replace("admn_resident_crud.php")</script>';
                        }else{
                            echo '<script>window.location.replace("index.php")</script>';
                        }
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
            }
        }

        public function email_checker() {
            $connection = $this->openConn();
            $email = isset($_POST['email']) ? $_POST['email'] : null; // Check if email is set
            
            if ($email) {
                // Check if the email already exists
                $stmt = $connection->prepare("SELECT * FROM tbl_resident WHERE email = :email");
                $stmt->bindParam(':email', $email);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
                if ($result) {
                    // Email already exists, show alert
                    echo "<script>alert('Email is already in use.');</script>";
                } else {
                    // Email doesn't exist, redirect to registration page with email as parameter
                    header("Location: resident_registration.php?email=" . urlencode($email));
                    exit();
                }
            } else {
                // Handle case where email is not set
                header("Location: your_form_page.php?error=email_not_provided");
                exit();
            }
        }
        
        

        public function view_resident(){
            $connection = $this->openConn();
            $stmt = $connection->prepare("SELECT * from tbl_resident WHERE verified ='Pending'");
            $stmt->execute();
            $view = $stmt->fetchAll();
            return $view;
        }


        public function view_single_resident() {
            $resident = $_GET['id_resident'];
        
            $connection = $this->openConn();
            $stmt = $connection->prepare("SELECT * FROM tbl_resident WHERE id_resident = ?");
            $stmt->execute([$resident]);
            $view = $stmt->fetch();
        
            return $view;
        }        

        public function view_approved_account(){
            $connection = $this->openConn();
            $stmt = $connection->prepare("SELECT * from tbl_resident WHERE verified ='Yes'");
            $stmt->execute();
            $view = $stmt->fetchAll();
            return $view;
        }
        public function view_rejected_account(){
            $connection = $this->openConn();
            $stmt = $connection->prepare("SELECT * from tbl_resident WHERE verified ='No'");
            $stmt->execute();
            $view = $stmt->fetchAll();
            return $view;
        }

        public function update_resident() {
            if (isset($_POST['update_resident'])) {
                $id_resident = $_GET['id_resident'];
                $email = $_POST['email'];
                $password = ($_POST['password']);
                $lname = $_POST['lname'];
                $fname = $_POST['fname'];
                $mi = $_POST['mi'];
                $age = $_POST['age'];
                $sex = $_POST['sex'];
                $status = $_POST['status'];
                $houseno = $_POST['houseno'];
                $street = $_POST['street'];
                $brgy = $_POST['brgy'];
                $municipal = $_POST['municipal'];
                $contact = $_POST['contact'];
                $bdate = $_POST['bdate'];
                $bplace = $_POST['bplace'];
                $nationality = $_POST['nationality'];
                $voter = $_POST['voter'];
                $familyrole = $_POST['family_role'];
                $role = $_POST['role'];
                $addedby = $_POST['addedby'];
        
                // Check if a new picture is uploaded
                $new_picture = $_FILES['resident_picture'];
                $target_dir = "uploads/resident_picture/";
        
                // Function to handle image upload
                function uploadImage($new_picture, $target_dir) {
                    // ... code for handling image upload (same as in the previous example)
                }
        
                // Check if a new picture is uploaded
                if (!empty($new_picture['name'])) {
                    $uploaded_file = uploadImage($new_picture, $target_dir);
        
                    if ($uploaded_file !== false) {
                        $connection = $this->openConn();
        
                        // Update the resident information including the new picture
                        $stmt = $connection->prepare("UPDATE tbl_resident SET `password` =?, `lname` =?, 
                        `fname` = ?, `mi` =?, `age` =?, `sex` =?, `status` =?, `email` =?, `houseno` =?, `street` =?,
                        `brgy` =?, `municipal` =?, `contact` =?,
                        `bdate` =?, `bplace` =?, `nationality` =?, `voter` =?, `family_role` =?, `role` =?, `addedby` =?, `res_photo` = ? WHERE `id_resident` = ?");
                        $stmt->execute([$password, $lname, $fname, $mi, $age, $sex, $status, $email, $houseno,
                        $street, $brgy, $municipal,
                        $contact, $bdate, $bplace, $nationality, $voter, $familyrole, $role, $addedby, $uploaded_file, $id_resident]);
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                        return;
                    }
                } else {
                    // Update resident information without changing the picture
                    $connection = $this->openConn();
                    $stmt = $connection->prepare("UPDATE tbl_resident SET `password` =?, `lname` =?, 
                    `fname` = ?, `mi` =?, `age` =?, `sex` =?, `status` =?, `email` =?, `houseno` =?, `street` =?,
                    `brgy` =?, `municipal` =?, `contact` =?,
                    `bdate` =?, `bplace` =?, `nationality` =?, `voter` =?, `family_role` =?, `role` =?, `addedby` =? WHERE `id_resident` = ?");
                    $stmt->execute([$password, $lname, $fname, $mi, $age, $sex, $status, $email, $houseno,
                    $street, $brgy, $municipal,
                    $contact, $bdate, $bplace, $nationality, $voter, $familyrole, $role, $addedby, $id_resident]);
                }
        
                $message2 = "Resident Data Updated";
                echo "<script type='text/javascript'>alert('$message2');</script>";
                header("refresh: 0");
            }
        }


        

        public function approve_resident() {
            $id_resident = $_POST['id_resident'];
            $email = $_POST['email'];
        
            if (isset($_POST['approve_resident'])) {
                $connection = $this->openConn();
                $stmt = $connection->prepare("UPDATE tbl_resident SET verified = 'Yes' WHERE id_resident = ?");
                $stmt->execute([$id_resident]);
        
                // Send email using PHPMailer
                $mail = new PHPMailer(true);
        
                try {
                    // Server settings
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';  // Replace with your SMTP server
                    $mail->SMTPAuth = true;
                    $mail->Username = 'olongapobarangaysantarita@gmail.com';  // Replace with your SMTP username
                    $mail->Password = 'bakb fdvi qrim htgj';  // Replace with your SMTP password
                    $mail->SMTPSecure = 'tls';  // Choose SSL or TLS
                    $mail->Port = 587;  // Adjust the port if necessary
        
                    // Recipients
                    $mail->setFrom('olongapobarangaysantarita@gmail.com', 'Barangay Sta. Rita');  // Replace with your email and name
                    $mail->addAddress($email);  // Email address of the resident
        
                    // Content
                    $mail->isHTML(true);
                    $mail->Subject = 'Account Verification';
                    $mail->Body = 'Your account has been verified. You can now login.';
        
                    $mail->send();
                    
                    $message2 = "Resident approved and email sent";
                } catch (Exception $e) {
                    $message2 = "Resident approved, but email could not be sent. Error: {$mail->ErrorInfo}";
                }
        
                echo "<script type='text/javascript'>alert('$message2');</script>";
                header("Refresh:0");
            }
        }
        

        public function decline_resident() {
            $id_resident = $_POST['id_resident'];
            $email = $_POST['email'];
        
            if (isset($_POST['decline_resident'])) {
                $connection = $this->openConn();
                $stmt = $connection->prepare("UPDATE tbl_resident SET verified = 'No' WHERE id_resident = ?");
                $stmt->execute([$id_resident]);
        
                // Send email using PHPMailer
                $mail = new PHPMailer(true);
        
                try {
                    // Server settings
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';  // Replace with your SMTP server
                    $mail->SMTPAuth = true;
                    $mail->Username = 'olongapobarangaysantarita@gmail.com';  // Replace with your SMTP username
                    $mail->Password = 'bakb fdvi qrim htgj';  // Replace with your SMTP password
                    $mail->SMTPSecure = 'tls';  // Choose SSL or TLS
                    $mail->Port = 587;  // Adjust the port if necessary
        
                    // Recipients
                    $mail->setFrom('olongapobarangaysantarita@gmail.com', 'Barangay Sta. Rita');  // Replace with your email and name
                    $mail->addAddress($email);  // Email address of the resident
        
                    // Content
                    $mail->isHTML(true);
                    $mail->Subject = 'Account Verification';
                    $mail->Body = 'Your account verification was not successful. Please enter the right information or you may contact olongapobarangaysantarita@gmail.com for further assistance.';
        
                    $mail->send();
                    
                    $message2 = "Resident Declined and email sent";
                } catch (Exception $e) {
                    $message2 = "Resident Declined, but email could not be sent. Error: {$mail->ErrorInfo}";
                }
        
                echo "<script type='text/javascript'>alert('$message2');</script>";
                header("Refresh:0");
            }
        }

        public function delete_resident(){
            $id_resident = $_POST['id_resident'];

            if(isset($_POST['delete_resident'])) {
                $connection = $this->openConn();
                $stmt = $connection->prepare("DELETE FROM tbl_resident where id_resident = ?");
                $stmt->execute([$id_resident]);

                $message2 = "Resident Data Deleted";
                
                echo "<script type='text/javascript'>alert('$message2');</script>";
                header("Refresh:0");
            }
        }

    //-------------------------------- EXTRA FUNCTIONS FOR RESIDENT CLASS ---------------------------------

    


    public function get_single_resident($id_resident){

        // $id_resident = $_POST['id_resident'];
        
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * FROM tbl_resident where id_resident = ?");
        $stmt->execute([$id_resident]);
        $resident = $stmt->fetch();
        $total = $stmt->rowCount();

        if($total > 0 )  {
            return $resident;
        }
        else{
            return false;
        }
    }
   
    public function check_resident($email) {

        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * FROM tbl_resident WHERE email = ?");
        $stmt->Execute([$email]);
        $total = $stmt->rowCount(); 

        return $total;
    }

    public function count_resident() {
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT COUNT(*) from tbl_resident WHERE verified = 'Yes'");
        $stmt->execute();
        $rescount = $stmt->fetchColumn();
        return $rescount;
    }
    public function count_registered_resident() {
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT COUNT(*) as count FROM tbl_resident WHERE verified ='Pending' ");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['count'];
    }
    public function count_residency() {
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT COUNT(*) as count FROM tbl_rescert WHERE form_status ='Pending' ");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['count'];
    }

    public function count_id() {
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT COUNT(*) as count FROM tbl_brgyid WHERE form_status ='Pending' ");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['count'];
    }
    public function count_bussiness() {
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT COUNT(*) as count FROM tbl_bspermit WHERE form_status ='Pending' ");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['count'];
    }
    public function count_clearance() {
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT COUNT(*) as count FROM tbl_clearance WHERE form_status ='Pending' ");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['count'];
    }
    public function count_indigency() {
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT COUNT(*) as count FROM tbl_indigency WHERE form_status ='Pending' ");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['count'];
    }

    public function check_household($lname, $mi) {
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * FROM tbl_resident WHERE lname = ? AND mi = ?");
        $stmt->Execute([$lname, $mi]);
        $total = $stmt->rowCount(); 
        return $total;
    }

    public function view_household_list() {
        $lname = $_POST['lname'];
        $mi = $_POST['mi'];

        if(isset($_POST['search_household'])) {
            $connection = $this->openConn();
            $stmt1 = $connection->prepare("SELECT * FROM `tbl_resident` WHERE `lname` LIKE '%$lname%' and  `mi` LIKE '%$mi%'");
            $stmt1->execute();
        }
    }

    public function count_male_resident() {
        $connection = $this->openConn();

        $stmt = $connection->prepare("SELECT COUNT(*) from tbl_resident where sex = 'male' AND verified = 'Yes' ");
        $stmt->execute();
        $rescount = $stmt->fetchColumn();

        return $rescount;
    }

    public function count_female_resident() {
        $connection = $this->openConn();

        $stmt = $connection->prepare("SELECT COUNT(*) from tbl_resident where sex = 'female' AND verified = 'Yes'");
        $stmt->execute();
        $rescount = $stmt->fetchColumn();

        return $rescount;
    }

    public function count_head_resident() {
        $connection = $this->openConn();
        
        $stmt = $connection->prepare("SELECT SUM(houseno_count) AS total_houseno_count
            FROM (
                SELECT COUNT(*) AS houseno_count
                FROM tbl_resident
                GROUP BY houseno
            ) AS counts;");
        // $stmt = $connection->prepare("SELECT COUNT(*) AS total_residents FROM tbl_resident WHERE verified = 'Yes'");
        // $stmt = $connection->prepare("SELECT COUNT(*) AS total_residents FROM tbl_resident WHERE verified = 'Yes'");
        // $stmt = $connection->prepare("SELECT COUNT(houseno) FROM tbl_resident GROUP BY houseno");
        // $stmt = $connection->prepare("SELECT COUNT(*) as count, lname FROM tbl_resident GROUP BY houseno, lname");
        // $stmt = $connection->prepare("SELECT SUM(count) as total_count FROM (SELECT COUNT(*) as count FROM tbl_resident GROUP BY houseno, lname) AS subquery");
        $stmt->execute();
        $rescount = $stmt->fetchColumn();

        return $rescount;
    }

    public function count_member_resident() {
        // $connection = $this->openConn();

        // $stmt = $connection->prepare("SELECT COUNT(*) from tbl_resident where family_role = 'Family Member'");
        // $stmt->execute();
        // $rescount = $stmt->fetchColumn();

        $rescount = 0;
        return $rescount;
    }

    public function profile_update() {
        $id_resident = $_GET['id_resident'];
        $age = $_POST['age'];
        $status = $_POST['status'];
        $address = isset($_POST['address']) ? $_POST['address'] : NULL;
        $purok = $_POST['purok'];
        $street = $_POST['street'];
        $contact = $_POST['contact'];

        if (isset($_POST['profile_update'])) {
           
            $connection = $this->openConn();
            $stmt = $connection->prepare("UPDATE tbl_resident SET  `age` = ?,  `status` = ?, 
            `address` = ?,  `purok` = ?, `street` = ?,`contact` = ? 
            WHERE id_resident = ?");
            $stmt->execute([ $age, $status, $address, $purok, $street,
            $contact, $id_resident]);
               
            $message2 = "Resident Profile Updated";
                
            echo "<script type='text/javascript'>alert('$message2');</script>";
            header("Refresh:0");

        }

    }
    // ------------------------------------ ARCHIVES COOUNT PER REQUEST ------------------------------------
    // Done
    public function count_clearance_approved() {
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT COUNT(*) from tbl_clearance WHERE form_status='Approved'");
        $stmt->execute();
        $rescount = $stmt->fetchColumn();
        return $rescount;
    }
    public function count_bspermit_approved() {
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT COUNT(*) from tbl_bspermit WHERE form_status='Approved'");
        $stmt->execute();
        $rescount = $stmt->fetchColumn();
        return $rescount;
    }
    public function count_indigency_approved() {
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT COUNT(*) from tbl_indigency WHERE form_status='Approved'");
        $stmt->execute();
        $rescount = $stmt->fetchColumn();
        return $rescount;
    }
    public function count_residency_approved() {
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT COUNT(*) from tbl_rescert WHERE form_status='Approved'");
        $stmt->execute();
        $rescount = $stmt->fetchColumn();
        return $rescount;
    }
    public function count_brgyid_approved() {
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT COUNT(*) from tbl_brgyid WHERE form_status='Approved'");
        $stmt->execute();
        $rescount = $stmt->fetchColumn();
        return $rescount;
    }
    // Decline
    public function count_clearance_decline() {
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT COUNT(*) from tbl_clearance WHERE form_status='Declined'");
        $stmt->execute();
        $rescount = $stmt->fetchColumn();
        return $rescount;
    }
    public function count_bspermit_decline() {
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT COUNT(*) from tbl_bspermit WHERE form_status='Declined'");
        $stmt->execute();
        $rescount = $stmt->fetchColumn();
        return $rescount;
    }
    public function count_indigency_decline() {
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT COUNT(*) from tbl_indigency WHERE form_status='Declined'");
        $stmt->execute();
        $rescount = $stmt->fetchColumn();
        return $rescount;
    }
    public function count_residency_decline() {
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT COUNT(*) from tbl_rescert WHERE form_status='Declined'");
        $stmt->execute();
        $rescount = $stmt->fetchColumn();
        return $rescount;
    }
    public function count_brgyid_decline() {
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT COUNT(*) from tbl_brgyid WHERE form_status='Declined'");
        $stmt->execute();
        $rescount = $stmt->fetchColumn();
        return $rescount;
    }
    

    //------------------------------------- RESIDENT FILTERING QUERIES --------------------------------------

    public function view_resident_minor(){
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * FROM tbl_resident WHERE `age` <= 17");
        $stmt->execute();
        $view = $stmt->fetchAll();
        return $view;
    }

    public function view_resident_adult(){
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * FROM tbl_resident WHERE `age` >= 18 AND `age` <= 59");
        $stmt->execute();
        $view = $stmt->fetchAll();
        return $view;
    }

    public function view_resident_senior(){
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * FROM tbl_resident WHERE `age` >= 60");
        $stmt->execute();
        $view = $stmt->fetchAll();
        return $view;
    }

    public function count_resident_senior() {
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT COUNT(*) FROM tbl_resident WHERE YEAR(CURDATE()) - YEAR(bdate) >= 60");
        $stmt->execute();
        $rescount = $stmt->fetchColumn();

        return $rescount;
    }





    //-------------------------------------- EXTRA FUNCTIONS ------------------------------------------------

    public function resident_changepass() {
        $id_resident = $_GET['id_resident'];
        
        $oldpassword = $_POST['oldpassword'];
        $newpassword = $_POST['newpassword'];
        $checkpassword = $_POST['confirm_password'];
    
        if (isset($_POST['resident_changepass'])) {
            // Check if the new password meets the minimum length requirement
            if (strlen($newpassword) < 8) {
                $message = "New Password must be at least 8 characters long";
                echo "<script type='text/javascript'>alert('$message');</script>";
                return;
            }
    
            $connection = $this->openConn();
            
            // Retrieve hashed password from the database
            $stmt = $connection->prepare("SELECT `password` FROM tbl_resident WHERE id_resident = ?");
            $stmt->execute([$id_resident]);
            $result = $stmt->fetch();
    
            // Check if old password is correct
            if (!$result || !password_verify($oldpassword, $result['password'])) {
                $message = "Old Password is Incorrect";
                echo "<script type='text/javascript'>alert('$message');</script>";
            } elseif ($newpassword != $checkpassword) {
                $message = "New Password and Verification Password do not Match";
                echo "<script type='text/javascript'>alert('$message');</script>";
            } else {
                // Hash the new password before updating the database
                $hashedPassword = password_hash($newpassword, PASSWORD_DEFAULT);
                $stmt = $connection->prepare("UPDATE tbl_resident SET password = ? WHERE id_resident = ?");
                $stmt->execute([$hashedPassword, $id_resident]);
    
                $message2 = "Password Updated";
                echo "<script type='text/javascript'>alert('$message2');</script>";
                header("refresh: 0");
            }
        }
    }
    
    
    





    //========================================== SCOPE CHANGED FUNCTIONS ===========================================

    public function view_resident_household(){
        $connection = $this->openConn();
            $stmt = $connection->prepare("SELECT 
                houseno, 
                COUNT(*) AS houseno_count,
                MAX(lname) AS lname,
                MAX(street) AS street,
                MAX(brgy) AS brgy,
                MAX(municipal) AS municipal
            FROM 
                tbl_resident
            GROUP BY 
                houseno;
            WHERE deleted_at IS NULL
            ");
        $stmt->execute();
        $view = $stmt->fetchAll();
        return $view;
    }

    public function view_resident_voters(){
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * from tbl_resident WHERE `voter` = 'Yes'");
        $stmt->execute();
        $view = $stmt->fetchAll();
        return $view;
    }

    public function view_resident_male(){
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * from tbl_resident WHERE `sex` = 'Male'");
        $stmt->execute();
        $view = $stmt->fetchAll();
        return $view;
    }

    public function view_resident_female(){
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * from tbl_resident WHERE `sex` = 'Female'");
        $stmt->execute();
        $view = $stmt->fetchAll();
        return $view;
    }

    public function count_voters() {
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT COUNT(*) from tbl_resident where `voter` = 'Yes' AND verified = 'Yes' ");
        $stmt->execute();
        $rescount = $stmt->fetchColumn();

        return $rescount;
    }


    
    

    public function search_admn_voter() {
        
        $search = $_GET['search'];

        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * from tbl_resident WHERE `fname` = '$search'");
        $stmt->execute();
        $view = $stmt->fetchAll();
        return $view;

            


            
        
        

    }








    }

    $residentbmis = new ResidentClass();
?>
        <!-- scripts -->
        <!-- purpose checker -->
        <script>
            var otherInput;
            function checkOptions(select) {
            otherInput = document.getElementById('otherInput');
            otherDiv = document.getElementById('otherDiv');

                if (select.options[select.selectedIndex].value == "Other") {
                    otherInput.style.display = 'block';
                    otherDiv.style.display = 'block';
                    otherInput.required = true;
                    
                }
                else {
                    otherInput.style.display = 'none';
                    otherDiv.style.display = 'none';
                    otherInput.value = '';
                    otherInput.required = false;
                }
            }
        </script>
        
        <!-- date checker -->
        <script>
            function checkDateValidity(dateInputId) {
                var dateInput = document.getElementById(dateInputId).value;
                var currentDate = new Date();
                var selectedDate = new Date(dateInput);

                // Check if the selected date is less than today's date
                if (selectedDate < currentDate) {
                    alert('Invalid date. Please select a date equal to or later than today.');
                    // Optionally, you can clear the input or perform any other actions here
                    document.getElementById(dateInputId).value = '';
                }
            }
        </script>
        
        <script>
            function checkBdate(dateInputId) {
                var dateInput = document.getElementById(dateInputId).value;
                var currentDate = new Date();
                var selectedDate = new Date(dateInput);
        
                // Calculate the date 18 years ago
                var eighteenYearsAgo = new Date();
                eighteenYearsAgo.setFullYear(currentDate.getFullYear() - 18);
        
                // Check if the selected date is less than 18 years ago
                if (selectedDate > eighteenYearsAgo) {
                    alert('Invalid date. You must be 18 years or older to register.');
                    // Optionally, you can clear the input or perform any other actions here
                    document.getElementById(dateInputId).value = '';
                }
            }
        </script>

        <!-- show img before uploading -->
        <script>
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#blah')
                            .attr('src', e.target.result)
                            .width(470)
                            .height(350);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>