<?php 
include("user.php");
include("session.php");


$user = new User();


$errors = array('name'=>'', 'mobile_number'=>'', 'promotional_code'=>'', 'GDPR'=>'', 'terms'=>'');
$success = array('success'=> '');
$error = false;
$code_check = '';
$con = mysqli_connect("localhost", "root", "", "voxline2");



if(isset($_POST['store'])){
    if($user){

        // Form validation

        if(empty($_POST['name'])){
            $errors['name'] = 'Your name is required </br>';
            $error = true;
        } else {
            $user->name = mysqli_real_escape_string($con,trim($_POST['name']));
        }

        if(empty($_POST['mobile_number'])){
            $errors['mobile_number'] = 'Your mobile number is required </br>';
            $error = true;
        } else {
            $user->mobile_number = mysqli_real_escape_string($con,trim($_POST['mobile_number']));
        }

        if(empty($_POST['promotional_code'])){
            $errors['promotional_code'] =  'Your promotional code is required </br>';
            $error = true;
        } else if (strlen($_POST['promotional_code']) < 8){
            $errors['promotional_code'] =  'Your promotional code need to be 8 characters. </br>';
            $error = true;
        } else if (strlen($_POST['promotional_code']) > 8){
            $errors['promotional_code'] =  'Your promotional code need to be 8 characters. </br>';
            $error = true;
        } else{
            $user->promotional_code = mysqli_real_escape_string($con,trim($_POST['promotional_code']));
        }

        if(empty($_POST['GDPR'])){
            $errors['GDPR'] =  'You need to accept GDPR</br>';
            $error = true;
        } else {
            $user->GDPR = $_POST['GDPR'];
        }

        if(empty($_POST['terms'])){
            $errors['terms'] =  'You need to accept terms </br>';
            $error = true;
        } else {
            $user->terms = $_POST['terms'];
        }

        // Check if promotional code is valid
        $query = "SELECT promotional_code FROM promotional_codes WHERE promotional_code = '".mysqli_real_escape_string($con, trim($_POST['promotional_code']))."'";
        $result = mysqli_query($con, $query);
        $row_count = mysqli_num_rows($result);

        if($row_count < 1){
            $code_check = "The promotional code is not valid. Please try another one.";
            $error = true;
        }

        // Unique promotional code validation    
        $query = "SELECT promotional_code FROM users WHERE promotional_code = '".mysqli_real_escape_string($con, trim($_POST['promotional_code']))."'";
        $result = mysqli_query($con, $query);
        $row_count = mysqli_num_rows($result);

        if($row_count >= 1){
            $code_check = "The promotional code is already registered. Please try another one.";
            $error = true;
        }


        // If errors doesn't exists, the user is stored
        if($error === false){
            $user->create();
            header('Location: success.php');

        }

    }
};


?>