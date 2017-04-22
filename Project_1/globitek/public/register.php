<?php
  require_once('../private/initialize.php');

  // Set default values for all variables the page needs.

  // if this is a POST request, process the form
  // Hint: private/functions.php can help

  $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
  $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '';
  $email = isset($_POST['email']) ? $_POST['email'] : '';
  $username = isset($_POST['username']) ? $_POST['username'] : '';
  $created_at = date("Y-m-d H:i:s");

  if(is_post_request()) 
  {
    // Confirm that POST values are present before accessing them.

    // Perform Validations
    // Hint: Write these in private/validation_functions.php

    $error = array();

    if(!has_valid_name_format($firstname))
      array_push($error,"First Name has invalid characters");
    elseif(is_blank($firstname) || !has_length($firstname, ['min' => 2, 'max' => 255]))
      array_push($error,"First Name cannot be shorter than 2 characters or longer than 255 characters");

    if(!has_valid_name_format($lastname))
      array_push($error,"Last Name has invalid characters");
    elseif(is_blank($lastname) || !has_length($lastname, ['min' => 2, 'max' => 255]))
      array_push($error,"Last Name cannot be shorter than 2 characters or longer than 255 characters");

    if(is_blank($email) || !has_valid_email_format($email))
      array_push($error,"Email is not valid");
    elseif(!has_length($email, ['max' => 255]))
      array_push($error,"Email cannot be longer than 255 characters");

    if(!has_valid_username_format($username))
      array_push($error, "Username has invalid characters");
    elseif(is_blank($username) || !has_length($username, ['min' => 8, 'max' => 255]))
      array_push($error,"Username cannot be shorter than 8 characters or longer than 255 characters");
    elseif(!is_unique_username($username))
      array_push($error,"This username is already used");

    // if there were no errors, submit data to database

    // Validate all form entries are filled

    // Write SQL INSERT statement
    if(empty($error))
    {
      $sql = "INSERT INTO users ";
      $sql .= "(first_name, last_name, email, username, created_at) VALUES (";
      $sql .= "'" . escape($firstname) . "',";
      $sql .= "'" . escape($lastname) . "',"; 
      $sql .= "'" . escape($email) . "',";
      $sql .= "'" . escape($username) . "',";
      $sql .= "'" . $created_at . "'";
      $sql .= ");";

      // For INSERT statments, $result is just true/false
      $result = db_query($db, $sql);
      if($result) 
      {
        db_close($db);
        unset($db);
        redirect_to("registration_success.php");
        exit;
      }
      else 
      {
        // The SQL INSERT statement failed.
        // Just show the error, not the form
        echo db_error($db);
        db_close($db);
        unset($db);
        exit;
      }
    }
  }

?>

<?php $page_title = 'Register'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <h1>Register</h1>
  <p>Register to become a Globitek Partner.</p>

  <?php

    // TODO: display any form errors here
    // Hint: private/functions.php can help
    if(isset($error))   
      echo display_errors($error);  
  ?>

  <!-- TODO: HTML form goes here -->

  <form action="" method="post">
    First Name: <input type="text" name="firstname" value="<?php echo h($firstname); ?>">
    <br> <br>
    Last Name: <input type="text" name="lastname" value="<?php echo h($lastname); ?>">
    <br> <br>
    Email: <input type="text" name="email" value="<?php echo h($email); ?>">
    <br> <br>
    Username: <input type="text" name="username" value="<?php echo h($username); ?>">
    <br> <br>
    <input type="submit" name="submit" value="Submit">
  </form>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>