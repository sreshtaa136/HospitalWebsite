<?php
session_start();

// PHP SCRIPT COMMON TO ALL PAGES 

$pidInput = "";
$dateInput = "";
$timeInput = "";
$reasonInput = "";
$pidError = "";
$dateError = "";
$timeError = "";
$reasonError = "";
$formSuccess = "";

$timeArray = array();
$selectedReason = "";
$advice = "";
$homeLink = "";

$usernameInput = "";
$passwordInput = "";
$confirmPasswordInput = "";
$fullnameInput = "";
$loginError = "";
$bookingTableColumnNames = array("SubmissionTime", "PatientId", "AppointmentDate", "Reason", "PreferredTimes");

// runs after form submission
if(count($_POST) > 0) {
    if(strcmp($pageTitle, "Booking") == 0) {
        bookingCheck();     // if booking form was submitted
    } elseif(strcmp($pageTitle, "Login") == 0) {
        loginCheck();       // if login form was submitted
    } elseif(strcmp($pageTitle, "Administration") == 0) {
        if(isset($_POST['logout'])) {
            logOut();       // if logout button was submitted
        } elseif(isset($_SESSION['user'])) {
            registerUser();     // if registration form was submitted
        } else {
            loginCheck();       // if login form was submitted
        }
    } 
} 

// logs out the current user
function logOut() {
    session_unset();
    session_destroy();
}

// registers new user
function registerUser() {
    $fullname = filter_var($_POST['fullname'], FILTER_SANITIZE_STRING);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $confirmPassword = filter_var($_POST['confirm-password'], FILTER_SANITIZE_STRING);
    $emptyInputs = false;
    $validUser = false;

    // checking if any inputs are empty
    if(empty($fullname)||empty($username)||empty($password)||empty($confirmPassword)) {
        $emptyInputs = true;
        $GLOBALS['loginError'] = 'ALL FIELDS MUST BE FILLED BEFORE SUBMITTING!';
    } else {
        // checking if user already exists
        if(!doesUserExist($username)) {
            // checking if password matches confirm-password
            if(strcmp($password, $confirmPassword) == 0) {
                // adding user 
                $validUser = true;
                $dataArray = array($username,$password);
                // appending data to accessattempts.txt
                $filename ="data/users.txt";
                $fp = fopen($filename, "a");
                flock($fp, LOCK_EX);
                fputcsv($fp, $dataArray);
                flock($fp, LOCK_UN);
                fclose($fp);
                $GLOBALS['formSuccess'] = 'USER ADDED SUCCESSFULLY!';
            } else {
                $GLOBALS['loginError'] = "Passwords don't match!";
            }
        } else {
            $GLOBALS['loginError'] = 'User already exists!';
        }
    }

    // retaining previously entered values
    if($emptyInputs || !$validUser) {
        $GLOBALS['fullnameInput'] = $fullname;
        $GLOBALS['usernameInput'] = $username;
        $GLOBALS['passwordInput'] = $password;
        $GLOBALS['confirmPasswordInput'] = $confirmPassword;
    } 
}

// validates inputs of login form
function loginCheck() {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $emptyInputs = false;
    $validCred = false;

    // checking if any inputs are empty
    if(empty($username)||empty($password)) {
        $emptyInputs = true;
        $GLOBALS['loginError'] = 'ALL FIELDS MUST BE FILLED BEFORE SUBMITTING!';
    } else {
        // checking if username and password
        // match the ones in users.txt
        $filename ="data/users.txt";
        $fp = fopen($filename, "r");
        flock($fp, LOCK_EX);
        while(!feof($fp)) {
            $row = fgetcsv($fp);
            if(!empty($row)) {
                if((strcmp($username, $row[0]) == 0) and 
                        (strcmp($password, $row[1]) == 0)) {
                    $validCred = true;
                    break;
                }
            }
        }
        flock($fp, LOCK_UN);
        fclose($fp);
    }

    // retaining previously entered values
    if($emptyInputs || !$validCred) {
        $GLOBALS['usernameInput'] = $username;
        $GLOBALS['passwordInput'] = $password;
    } 

    // if invalid credentials were entered
    if(!$emptyInputs and !$validCred) {
        $GLOBALS['loginError'] = "INVALID CREDENTIALS!";
        // getting current date and time
        $currDate = date("d-m-Y H:i:s");
        // adding data to an array
        $dataArray = array($currDate, $username);
        // appending data to accessattempts.txt
        $filename ="data/accessattempts.txt";
        $fp = fopen($filename, "a");
        flock($fp, LOCK_EX);
        fputcsv($fp, $dataArray);
        flock($fp, LOCK_UN);
        fclose($fp);
    } elseif(!$emptyInputs and $validCred) {
        // logging in user
        createBookingArray();  // creating data for bookings table
        $_SESSION['user']['username'] = $username;
        $_SESSION['login_time'] = time();
        header("Location: administration.php");
    }
}

// checks if user already exists 
function doesUserExist($username) {
    $exists = false;
    $filename ="data/users.txt";
    $fp = fopen($filename, "r");
    flock($fp, LOCK_EX);
    while(!feof($fp)) {
        $row = fgetcsv($fp);
        if(!empty($row)) {
            if(strcmp($username, $row[0]) == 0) {
                $exists = true;
                break;
            }
        }
    }
    flock($fp, LOCK_UN);
    fclose($fp);
    return $exists;
}

function createBookingArray() {
    // collecting booking details from appointments.txt
    $_SESSION['bookingArray'] = array();
    $filename ="data/appointments.txt";
    $fp = fopen($filename, "r");
    flock($fp, LOCK_EX);
    while(!feof($fp)) {
        $row = fgetcsv($fp);
        if(!empty($row)) {
            // converting user input string (appointment date) to date
            $dt = date_create($row[2]);
            // formatting appointment date into readable format
            $bookingDate = date_format($dt, "l,jS F Y");
            $row[2] = $bookingDate;
            // separating times with commas
            // so that it is more readable
            $times = $row[4];
            $times = explode(" ",$times);
            $times = join(", ",$times);
            $row[4] = $times;
            array_push($_SESSION['bookingArray'], $row);
        }
    }
    flock($fp, LOCK_UN);
    fclose($fp);
}

// validates inputs of booking form
function bookingCheck() {

    $check = true;
    $pid = filter_var($_POST['pid'], FILTER_SANITIZE_STRING);

    // checks if any input values are empty
    if(empty($pid)||empty($_POST['date'])||empty($_POST['time'])||empty($_POST['reason'])) {
        $check = false;
    } else {
        // checks if pid entered is valid
        if(!empty($pid) and !checkPid(strtoupper($pid))) {
            $check = false;
            $GLOBALS['pidError'] = 'Invalid Patient Id';
        }
    }

    // retaining previously entered values if any input values are empty
    // or if entered pid is invalid
    if(!$check) {
        $GLOBALS['pidInput']= $pid;
        $GLOBALS['dateInput']= $_POST['date'];
        $GLOBALS['reasonInput'] = $_POST['reason'];

        // retaining pillbox values
        if(!empty($_POST['time'])) {
            foreach($_POST['time'] as $time) {
                array_push($GLOBALS['timeArray'], $time);
            }
        }

        // retaining advice for the reason input
        if(!empty($_POST['reason'])) {
            $GLOBALS['selectedReason'] = $_POST['reason'];
            switch($_POST['reason']) {
                case "ChildhoodVaccinationShots":
                    $GLOBALS['advice'] = "Disclaimer: Multiple vaccines are normally administered in " . 
                                        "combination and may cause the child to be sluggish or feverous for 24 – 48 hours afterwards.";
                    break;
                case "InfluenzaShot":
                    $GLOBALS['advice'] = "Advice: The best time to get vaccinated is in April and May each year " .
                                        "for optimal protection over the winter months.";
                    break;
                case "CovidBoosterShot":
                    $GLOBALS['advice'] = "Advice: You are advised to have your third shot as soon as possible. " .
                                        "If you are over the age of 30, you are advised to have your fourth shot to protect against new variant strains.";
                    break;
                case "BloodTest":
                    $GLOBALS['advice'] = "Advice: Some tests require some fasting ahead of time. One of our staff " .
                                        "members will advise you on this prior to your appointment.";
                    break;
                case "":
                    $GLOBALS['advice'] = "";
                    break;
            }
        }

        // setting individual input errors for each field
        // if that field is left blank
        if(empty($_POST['date'])) {
            $GLOBALS['dateError'] = 'Field cannot be left blank';
        }
        if(empty($_POST['time'])) {
            $GLOBALS['timeError'] = 'Field cannot be left blank';
        }
        if(empty($_POST['reason'])) {
            $GLOBALS['reasonError'] = 'Field cannot be left blank';
        }
        if(empty($pid)) {
            $GLOBALS['pidError'] = 'Field cannot be left blank';
        }

    } else {
        // getting current date and time
        $currDate = date("d-m-Y H:i:s");
        // adding all booking data to an array
        $dataArray = array($currDate, $pid, $_POST['date'], $_POST['reason']);
        // converting booking time array to string
        $times = implode(" ", $_POST['time']);
        array_push($dataArray, $times);
        // appending data to appointments.txt
        $filename ="data/appointments.txt";
        $fp = fopen($filename, "a");
        flock($fp, LOCK_EX);
        fputcsv($fp, $dataArray);
        flock($fp, LOCK_UN);
        fclose($fp);
        createBookingArray();

        $GLOBALS['formSuccess'] = 'FORM SUBMITTED SUCCESSFULLY! '.
                        'Our office will be in touch with you between Monday and Friday before 5pm.';
        $GLOBALS['homeLink'] = 'Return to Home page';
    }
}

// function to validate patient id input
function checkPid($pid) {
    $alphabets = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O",
    "P","Q","R","S","T","U","V","W","X","Y","Z");
    // checking pattern first 
    $pattern = false;
    if(preg_match("/^[A-Z][A-Z]([0-9]){1,}[A-Z]$/", $pid)) {
        $pattern = true;
    }
    // checksum rule
    $checksum = false;
    if($pattern) {
        $dig_start_index = 2;
        $dig_length = strlen($pid) - 3;
        $digit_string = substr($pid, $dig_start_index, $dig_length);
        $dig_array = str_split($digit_string);
        $sum = 0;
        
        foreach($dig_array as $digit) {
            $sum += (int)$digit;
        }

        $remainder = $sum % 26;
        $last_char = substr($pid, -1);
        $index = $remainder - 1;
        if ($remainder == 0) {
            $index = 25;
        }

        if($alphabets[$index] == $last_char) {
            $checksum = true;
        } 
    } 

    if(!$checksum) {
        return false;
    }
    return true;
}

?>
