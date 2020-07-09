<?php 
include('user_functions.php');
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
            <label for="GDPR">General Data Protection Regulation accept</label><br>
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

