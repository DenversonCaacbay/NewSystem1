<?php 

    require_once('main.class.php');

    // check if user is logged
    if(!is_null($_SESSION['userdata'])){
        if($user_role == 'administrator'){
            header('Location: admn_dashboard.php');
        }
        else if($user_role == 'staff'){
            header('Location: staff_dashboard.php');
        }
        else{
            header('Location: index.php');
        }  
    }

    class StaffClass extends BMISClass {

        /*
        //authentication method for residents to enter
        public function residentlogin() {
        if(isset($_POST['residentlogin'])) {

            $username = $_POST['email'];
            $password = $_POST['password']; 
        
            $connection = $this->openConn();
            $stmt = $connection->prepare("SELECT * FROM tbl_residents WHERE email = ? AND password = ?");
            $stmt->Execute([$username, $password]);
            $user = $stmt->fetch();
            $total = $stmt->rowCount();
            
                //calls the set_userdata function 
                if($total > 0) {
                    $this->set_userdata($user);
                    header('Location: resident_homepage.php');
                }
                
                else {
                    echo '<script>alert("Email or Password is Invalid")</script>';
                }
            }
        }
        */

    //------------------------------------- CRUD FUNCTIONS FOR STAFF -----------------------------------------------

    public function create_staff() {
        if(isset($_POST['add_staff'])) {
            $position = $_POST['position'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            $lname = ucwords(strtolower($_POST['lname'])); // Convert to uppercase
            $fname = ucwords(strtolower($_POST['fname'])); // Convert to uppercase
            $mi = strtoupper(substr($_POST['mi'], 0, 1)) . '.'; // Get first letter in uppercase and add '.'
            $role = $_POST['role'];
    
            // Check if the email already exists
            if ($this->check_staff($email) > 0 ) {
                // Email already exists
                echo "<script type='text/javascript'>alert('Email Account already exists');</script>";
                return;
            }
    
            // Check password length
            if (strlen($password) < 8) {
                // Password is too short, show an error message
                $messageError = "Password must be at least 8 characters long.";
                echo "<script type='text/javascript'>alert('$messageError');</script>";
                return;
            }
    
            // Check if the password and confirm password match
            if ($password !== $confirm_password) {
                $message = "Password and Confirm Password do not match";
                echo "<script type='text/javascript'>alert('$message');</script>";
                return;
            }
    
            $password_hash = password_hash($password, PASSWORD_BCRYPT);
    
            $connection = $this->openConn();
            $stmt = $connection->prepare("INSERT INTO tbl_admin (`position`, `email`,`password`,`lname`,`fname`, `mi`,`role`) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->Execute([$position, $email, $password_hash, $lname, $fname, $mi,$role]);
            $message2 = "New Staff Added";
            echo "<script type='text/javascript'>alert('$message2');</script>";
            header('refresh:1');
        }
    }


        public function view_staff(){

            $connection = $this->openConn();

            // $stmt = $connection->prepare("SELECT * from tbl_user");
            $stmt = $connection->prepare("SELECT * from tbl_admin");
            $stmt->execute();
            $view = $stmt->fetchAll();
            //$rows = $stmt->
            return $view;
           
        }

        public function view_single_staff(){

            $id_staff = $_GET['id_staff'];
            
            $connection = $this->openConn();
            $stmt = $connection->prepare("SELECT * FROM tbl_user where id_user = '$id_staff'");
            $stmt->execute();
            $view = $stmt->fetch(); 
            $total = $stmt->rowCount();
 
            //eto yung condition na i ch check kung may laman si products at i re return niya kapag meron
            if($total > 0 )  {
                return $view;
            }
            else{
                return false;
            }
        }

        public function update_staff() {
            if (isset($_POST['update_staff'])) {
                $id_user = $_GET['id_user'];
                $password = ($_POST['password']);
                $lname = ucfirst(strtolower($_POST['lname'])); // Convert to uppercase
                $fname = ucfirst(strtolower($_POST['fname'])); // Convert to uppercase
                $mi = strtoupper(substr($_POST['mi'], 0, 1)) . '.'; // Get first letter in uppercase and add '.'
                $role = $_POST['role'];
                $email = $_POST['email'];
                
                    $connection = $this->openConn();

                    // Check if the provided email matches the current user's email
                    $stmtEmailCheck = $connection->prepare("SELECT email FROM tbl_admin WHERE id_admin = ?");
                    $stmtEmailCheck->execute([$id_user]);
                    $currentUserEmail = $stmtEmailCheck->fetchColumn();

                    // checks if user changes email
                    if ($email !== $currentUserEmail) {
                        // Provided email is different, check for its existence
                        $stmtEmailExist = $connection->prepare("SELECT COUNT(*) FROM tbl_admin WHERE email = ?");
                        $stmtEmailExist->execute([$_POST['email']]);
                        $emailExists = $stmtEmailExist->fetchColumn();
            
                        if ($emailExists > 0) {
                            // Email already exists, show an error message
                            $messageError = "Email already exists. Please choose a different email.";
                            echo "<script type='text/javascript'>alert('$messageError');</script>";
                            header('refresh:0');
                            return;
                        }
                    }

                    $stmt = $connection->prepare(
                        "UPDATE tbl_admin SET lname = ?, fname = ?, mi = ?, role = ?, email = ? WHERE id_admin = ?");
                    $stmt->execute([$lname, $fname, $mi, $role, $email, $id_user]);

                    $message2 = "Staff Account Updated";
    
                    echo "<script type='text/javascript'>alert('$message2');</script>";
                    header('refresh:0');

            }
        }

        public function delete_staff(){

            $id_user = $_POST['id_user'];

            if(isset($_POST['delete_staff'])) {
                $connection = $this->openConn();
                // $stmt = $connection->prepare("DELETE FROM tbl_user where id_user = ?");
                $stmt = $connection->prepare("DELETE FROM tbl_admin where id_admin = ?");
                $stmt->execute([$id_user]);
                
                $message2 = "Staff Account Deleted";
                
                echo "<script type='text/javascript'>alert('$message2');</script>";
                 header('refresh:0');
            }
        }

    //--------------------------------------------- EXTRA FUNCTIONS FOR STAFF -------------------------------------------------

            public function get_single_staff($id_user){

                $id_user = $_GET['id_user'];
                
                $connection = $this->openConn();
                // $stmt = $connection->prepare("SELECT * FROM tbl_user where id_user = ?");
                $stmt = $connection->prepare("SELECT * FROM tbl_admin where id_admin = ?");
                $stmt->execute([$id_user]);
                $user = $stmt->fetch();
                $total = $stmt->rowCount();

                if($total > 0 )  {
                    return $user;
                }
                else{
                    return false;
                }
            }


        public function check_staff($id_user) {

            $connection = $this->openConn();
            $stmt = $connection->prepare("SELECT * FROM tbl_admin WHERE email = ?");
            $stmt->Execute([$id_user]);
            $total = $stmt->rowCount(); 

            return $total;
        }

        public function count_staff() {
            $connection = $this->openConn();

            // $stmt = $connection->prepare("SELECT COUNT(*) from tbl_user");
            $stmt = $connection->prepare("SELECT COUNT(*) from tbl_admin");
            $stmt->execute();
            $staffcount = $stmt->fetchColumn();

            return $staffcount;
        }



        // public function count_mstaff() {
        //     $connection = $this->openConn();

        //     $stmt = $connection->prepare("SELECT COUNT(*) from tbl_user where sex = 'male'");
        //     $stmt->execute();
        //     $staffcount = $stmt->fetchColumn();

        //     return $staffcount;
        // }

        // public function count_fstaff() {
        //     $connection = $this->openConn();

        //     $stmt = $connection->prepare("SELECT COUNT(*) from tbl_user where sex = 'female'");
        //     $stmt->execute();
        //     $staffcount = $stmt->fetchColumn();

        //     return $staffcount;
        // }


        //===================================== SCOPE CHANGED FEATURES =======================================

        public function view_staff_male(){
            $connection = $this->openConn();
            $stmt = $connection->prepare("SELECT * from tbl_user WHERE `sex` = 'Male'");
            $stmt->execute();   
            $view = $stmt->fetchAll();
            return $view;
        }
    
        public function view_staff_female(){
            $connection = $this->openConn();
            $stmt = $connection->prepare("SELECT * from tbl_user WHERE `sex` = 'Female'");
            $stmt->execute();
            $view = $stmt->fetchAll();
            return $view;
        }

    public function dashboard_weekly($category){
        $connection = $this->openConn();
        
        // get category input
        // $category = isset($_POST['category']) ? $_POST['category'] : 'all';
        
        $weeklyData = array();
    
        // Calculate today's date
        $today = new DateTime('today');
        $today = $today->modify('+1 day');
    
        // all
        // Iterate through each day within the date range starting from 6 days ago
        for ($currentDate = new DateTime('-6 days'); $currentDate <= $today; $currentDate->modify('+1 day')) {
            $currentDateString = $currentDate->format('Y-m-d');
            
            // Initialize variables for each table count
            $table1 = $table2 = $table3 = $table4 = $table5 = 0;
    
            // tbl_brgyid
            if ($category == 'all' || $category == 'brgyid') {
                $stmt1 = $connection->prepare("SELECT COUNT(*) as count FROM tbl_brgyid WHERE DATE(`created_at`) = :currentDate AND deleted_at IS NULL");
                $stmt1->bindParam(':currentDate', $currentDateString);
                $stmt1->execute();
                $table1 = $stmt1->fetchColumn();
            }
    
            // tbl_bspermit
            if ($category == 'all' || $category == 'bspermit') {
                $stmt2 = $connection->prepare("SELECT COUNT(*) as count FROM tbl_bspermit WHERE DATE(`created_at`) = :currentDate AND deleted_at IS NULL");
                $stmt2->bindParam(':currentDate', $currentDateString);
                $stmt2->execute();
                $table2 = $stmt2->fetchColumn(); 
            }
    
            // tbl_clearance
            if ($category == 'all' || $category == 'clearance') {
                $stmt3 = $connection->prepare("SELECT COUNT(*) as count FROM tbl_clearance WHERE DATE(`created_at`) = :currentDate AND deleted_at IS NULL");
                $stmt3->bindParam(':currentDate', $currentDateString);
                $stmt3->execute();
                $table3 = $stmt3->fetchColumn();
            }
            
            // tbl_indigency
            if ($category == 'all' || $category == 'indigency') {
                $stmt4 = $connection->prepare("SELECT COUNT(*) as count FROM tbl_indigency WHERE DATE(`created_at`) = :currentDate AND deleted_at IS NULL");
                $stmt4->bindParam(':currentDate', $currentDateString);
                $stmt4->execute();
                $table4 = $stmt4->fetchColumn();
            }
    
            // tbl_rescert
            if ($category == 'all' || $category == 'rescert') {
                $stmt5 = $connection->prepare("SELECT COUNT(*) as count FROM tbl_rescert WHERE DATE(`created_at`) = :currentDate AND deleted_at IS NULL");
                $stmt5->bindParam(':currentDate', $currentDateString);
                $stmt5->execute();
                $table5 = $stmt5->fetchColumn();
            }
    
            // // Combine the counts or use them as needed
            $formattedDate = $currentDate->format('M d,Y');
            $weeklyData[$formattedDate] = $table1 + $table2 + $table3 + $table4 + $table5;
        }
    
        return $weeklyData;
    }
    
    public function dashboard_monthly($category) {
        $connection = $this->openConn();
        
         // get category input
        // $category = isset($_POST['category']) ? $_POST['category'] : 'all';
        
        $yearlyData = array();
    
        // Get today's date
        $today = new DateTime('today');
        $currentYear = date('Y'); // Get the current year
        $currentDay = date('d');  // Get the current day
    
        // Iterate through each month within the date range of January to December
        for ($month = 1; $month <= 12; $month++) {
            $currentDateString = sprintf('%s-%02d-%02d', $currentYear, $month, $currentDay);
    
            // Initialize variables for each table count
            $table1 = $table2 = $table3 = $table4 = $table5 = 0;
    
            // tbl_brgyid
            if ($category == 'all' || $category == 'brgyid') {
                $stmt1 = $connection->prepare("
                    SELECT COUNT(*) as count 
                    FROM tbl_brgyid 
                    WHERE DATE(`created_at`) >= DATE_FORMAT(:currentDate, '%Y-%m-01') 
                    AND DATE(`created_at`) <= LAST_DAY(:currentDate) 
                    AND deleted_at IS NULL
                ");
                $stmt1->bindParam(':currentDate', $currentDateString);
                $stmt1->execute();
                $table1 = $stmt1->fetchColumn();
            }
    
            // tbl_bspermit
            if ($category == 'all' || $category == 'bspermit') {
                $stmt2 = $connection->prepare("
                    SELECT COUNT(*) as count 
                    FROM tbl_bspermit 
                    WHERE DATE(`created_at`) >= DATE_FORMAT(:currentDate, '%Y-%m-01') 
                    AND DATE(`created_at`) <= LAST_DAY(:currentDate) 
                    AND deleted_at IS NULL
                ");
                $stmt2->bindParam(':currentDate', $currentDateString);
                $stmt2->execute();
                $table2 = $stmt2->fetchColumn(); 
            }
    
            // tbl_clearance
            if ($category == 'all' || $category == 'clearance') {
                $stmt3 = $connection->prepare("
                    SELECT COUNT(*) as count 
                    FROM tbl_clearance 
                    WHERE DATE(`created_at`) >= DATE_FORMAT(:currentDate, '%Y-%m-01') 
                    AND DATE(`created_at`) <= LAST_DAY(:currentDate) 
                    AND deleted_at IS NULL
                ");
                $stmt3->bindParam(':currentDate', $currentDateString);
                $stmt3->execute();
                $table3 = $stmt3->fetchColumn();
            }
            
            // tbl_indigency
            if ($category == 'all' || $category == 'indigency') {
                $stmt4 = $connection->prepare("
                    SELECT COUNT(*) as count 
                    FROM tbl_indigency 
                    WHERE DATE(`created_at`) >= DATE_FORMAT(:currentDate, '%Y-%m-01') 
                    AND DATE(`created_at`) <= LAST_DAY(:currentDate) 
                    AND deleted_at IS NULL
                ");
                $stmt4->bindParam(':currentDate', $currentDateString);
                $stmt4->execute();
                $table4 = $stmt4->fetchColumn();
            }
            
            // tbl_rescert
            if ($category == 'all' || $category == 'rescert') {
                $stmt5 = $connection->prepare("
                    SELECT COUNT(*) as count 
                    FROM tbl_rescert 
                    WHERE DATE(`created_at`) >= DATE_FORMAT(:currentDate, '%Y-%m-01') 
                    AND DATE(`created_at`) <= LAST_DAY(:currentDate) 
                    AND deleted_at IS NULL
                ");
                $stmt5->bindParam(':currentDate', $currentDateString);
                $stmt5->execute();
                $table5 = $stmt5->fetchColumn();
            }
    
            // Combine the counts or use them as needed
            $formattedDate = (new DateTime($currentDateString))->format('M');
            $yearlyData[$formattedDate] = $table1 + $table2 + $table3 + $table4 + $table5;
        }
    
        return $yearlyData;
    }
    
    public function dashboard_quarterly($category) {
        $connection = $this->openConn();
        
        // get category input
        // $category = isset($_POST['category']) ? $_POST['category'] : 'all';
        
        $quarterlyData = array();
        
        // Get today's date
        $today = new DateTime('today');
        $currentYear = date('Y'); // Get the current year
        $currentDay = date('d');  // Get the current day
        
        // Iterate through each quarter within the date range of Q1 to Q4
        for ($quarter = 1; $quarter <= 4; $quarter++) {
            // Calculate the start and end dates of the quarter
            $startMonth = ($quarter - 1) * 3 + 1;
            $endMonth = $quarter * 3;
            $currentDateString = sprintf('%s-%02d-%02d', $currentYear, $startMonth, $currentDay);
            $endDateString = sprintf('%s-%02d-%02d', $currentYear, $endMonth, $currentDay);
            
            // Initialize variables for each table count
            $table1 = $table2 = $table3 = $table4 = $table5 = 0;
            
            // tbl_brgyid
            if ($category == 'all' || $category == 'brgyid') {
                $stmt1 = $connection->prepare("
                    SELECT COUNT(*) as count 
                    FROM tbl_brgyid 
                    WHERE DATE(`created_at`) >= DATE_FORMAT(:currentDate, '%Y-%m-01') 
                    AND DATE(`created_at`) <= LAST_DAY(:endDate) 
                    AND deleted_at IS NULL
                ");
                $stmt1->bindParam(':currentDate', $currentDateString);
                $stmt1->bindParam(':endDate', $endDateString);
                $stmt1->execute();
                $table1 = $stmt1->fetchColumn();
            }
    
            // tbl_bspermit
            if ($category == 'all' || $category == 'bspermit') {
                $stmt2 = $connection->prepare("
                    SELECT COUNT(*) as count 
                    FROM tbl_bspermit 
                    WHERE DATE(`created_at`) >= DATE_FORMAT(:currentDate, '%Y-%m-01') 
                    AND DATE(`created_at`) <= LAST_DAY(:endDate) 
                    AND deleted_at IS NULL
                ");
                $stmt2->bindParam(':currentDate', $currentDateString);
                $stmt2->bindParam(':endDate', $endDateString);
                $stmt2->execute();
                $table2 = $stmt2->fetchColumn(); 
            }
    
            // tbl_clearance
            if ($category == 'all' || $category == 'clearance') {
                $stmt3 = $connection->prepare("
                    SELECT COUNT(*) as count 
                    FROM tbl_clearance 
                    WHERE DATE(`created_at`) >= DATE_FORMAT(:currentDate, '%Y-%m-01') 
                    AND DATE(`created_at`) <= LAST_DAY(:endDate) 
                    AND deleted_at IS NULL
                ");
                $stmt3->bindParam(':currentDate', $currentDateString);
                $stmt3->bindParam(':endDate', $endDateString);
                $stmt3->execute();
                $table3 = $stmt3->fetchColumn();
            }
    
            // tbl_indigency
            if ($category == 'all' || $category == 'indigency') {
                $stmt4 = $connection->prepare("
                    SELECT COUNT(*) as count 
                    FROM tbl_indigency 
                    WHERE DATE(`created_at`) >= DATE_FORMAT(:currentDate, '%Y-%m-01') 
                    AND DATE(`created_at`) <= LAST_DAY(:endDate) 
                    AND deleted_at IS NULL
                ");
                $stmt4->bindParam(':currentDate', $currentDateString);
                $stmt4->bindParam(':endDate', $endDateString);
                $stmt4->execute();
                $table4 = $stmt4->fetchColumn();
            }
    
            // tbl_rescert
            if ($category == 'all' || $category == 'rescert') {
                $stmt5 = $connection->prepare("
                    SELECT COUNT(*) as count 
                    FROM tbl_rescert 
                    WHERE DATE(`created_at`) >= DATE_FORMAT(:currentDate, '%Y-%m-01') 
                    AND DATE(`created_at`) <= LAST_DAY(:endDate) 
                    AND deleted_at IS NULL
                ");
                $stmt5->bindParam(':currentDate', $currentDateString);
                $stmt5->bindParam(':endDate', $endDateString);
                $stmt5->execute();
                $table5 = $stmt5->fetchColumn();
            }
    
            // Combine the counts or use them as needed
            $formattedDate = sprintf('Quarter %d', $quarter);
            $quarterlyData[$formattedDate] = $table1 + $table2 + $table3 + $table4 + $table5;
        }
        
        return $quarterlyData;
    }



    }
    $staffbmis = new StaffClass();
?>