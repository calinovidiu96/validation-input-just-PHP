<?php 
include("user.php");
include("session.php");


$user = new User();


$errors = array('name'=>'', 'mobile_number'=>'', 'promotional_code'=>'', 'GDPR'=>'', 'terms'=>'');
$success = array('success'=> '');
$error = false;
$error_promotional = false;
$code_check = '';



if(isset($_POST['store'])){
    if($user){
        // $user->name = $_POST['name'];
        // $user->mobile_number = $_POST['mobile_number'];
        // $user->promotional_code = $_POST['promotional_code'];
        // $user->GDPR = $_POST['GDPR'];
        // $user->terms = $_POST['terms'];

        if(empty($_POST['name'])){
            $errors['name'] = 'Your name is required </br>';
            $error = true;
        } else {
            $user->name = $_POST['name'];
        }

        if(empty($_POST['mobile_number'])){
            $errors['mobile_number'] = 'Your mobile number is required </br>';
            $error = true;
        } else {
            $user->mobile_number = $_POST['mobile_number'];
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
        }
        else{
            $user->promotional_code = $_POST['promotional_code'];
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


        $con = mysqli_connect("localhost", "root", "", "voxline2");
        $query = "SELECT * FROM users WHERE promotional_code = '".mysqli_real_escape_string($con, $_POST['promotional_code'])."'";

        $result = mysqli_query($con, $query);
        $row_count = mysqli_num_rows($result);


        if($row_count > 1){
            $code_check = "The promotional code is already registered. Please try another one.";
            $error = true;
        }





        
  

   
        if($error === false){
            $user->create();
            $success['success'] = 'Your promotional code had beed registered successfully';
        }


    }
};


?>



<div class="col-xl-12 col-lg-12">
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Insert your informations here:</h6>
      </div>

      <!-- Card Body -->
      <div class="card-body">
        <div class='text-success'> <?php echo $success['success']; ?> </div>
        <br>

        <form action="" method="post">
          <div class='form-group'>
              <label for="name">Your username:</label>
              <input type="text" name="name" class="form-control" value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>" />
              <div class="text-danger"><?php echo $errors['name']; ?></div>       
          </div>

          <div class='form-group'>
            <label for="mobile_number">Your mobile number:</label>
            <input type="number" name="mobile_number" class="form-control" value="<?php echo isset($_POST['mobile_number']) ? $_POST['mobile_number'] : '' ?>" />
            <div class="text-danger"><?php echo $errors['mobile_number']; ?></div> 
          </div>

          <div class='form-group'>
            <label for="promotional_code">Your promotional code:</label>
            <input type="text" name="promotional_code" class="form-control" value="<?php echo isset($_POST['promotional_code']) ? $_POST['promotional_code'] : '' ?>" />
            <div class="text-danger"><?php echo $errors['promotional_code']; ?></div> 
            <div class="text-danger"><?php echo $code_check; ?></div> 

        </div>

        <div class="form-group">
            <input name="GDPR" value="0" type="hidden">
            <input type="checkbox" name="GDPR" value="1">
            <label for="GDPR">GDPR accept</label><br>
            <div class="text-danger"><?php echo $errors['GDPR']; ?></div> 
        </div>

        <div class="form-group">
            <input name="terms" value="0" type="hidden">
            <input type="checkbox" name="terms" value="1">
            <label for="terms">Terms and conditions accept</label><br>
            <div class="text-danger"><?php echo $errors['terms']; ?></div> 
        </div>
        
        <div class='form-group'>
            <input type="submit" name="store" class="btn btn-primary ">
        </div>

        </form>
        
      </div>
    </div>
</div>
