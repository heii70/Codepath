<?php

  // is_blank('abcd')
  function is_blank($value='') {
    // TODO
    return !isset($value) || trim($value) == '';
  }

  // has_length('abcd', ['min' => 3, 'max' => 5])
  function has_length($value, $options=array()) {
    // TODO
    $length = strlen($value);
    if(isset($options['max']) && ($length > $options['max'])) {
      return false;
    } elseif(isset($options['min']) && ($length < $options['min'])) {
      return false;
    } elseif(isset($options['exact']) && ($length != $options['exact'])) {
      return false;
    } else {
      return true;
    }
  }

  // has_valid_email_format('test@test.com')
  function has_valid_email_format($value) {
    // TODO
    $not_allowed = "!#$%^&*()+=/\{}[]|:;?<>~-,'";
    $result = false;

    for($i = 0; $i < strlen($value); $i++)
    {
      if($value[$i] == '@')
      {
        if($result == true)
        {
          $result = false; // Returns false if there are two '@'
          break;
        }
        else
          $result = true; // Result is set to true
      }

      for($j = 0; $j < strlen($not_allowed); $j++)
      {
        if($value[$i] == $not_allowed[$j])
        {
          $result = false; // Changes back to false if a non-valid character is encountered
          break;
        }
      }
    }
      
    return $result;
  }

  function has_valid_name_format($value) {
    $not_allowed = "!@#$%^&*()_+=/\{}[]|:;?<>~";

    for($i = 0; $i < strlen($value); $i++)
    {
      for($j = 0; $j < strlen($not_allowed); $j++)
      {
        if($value[$i] == $not_allowed[$j])
          return false;
      }
    }
    return true;

    /*if(preg_match('/\A[A-Za-z\s\-,\.\']+\Z/', $value))
      return true;
    else
      return false;*/
  }

  function has_valid_username_format($value) {
    $not_allowed = "!@#$%^&*()+=/\{}[]|:;?<>~-,'";

    for($i = 0; $i < strlen($value); $i++)
    {
      for($j = 0; $j < strlen($not_allowed); $j++)
      {
        if($value[$i] == $not_allowed[$j])
          return false;
      }
    }
    return true;
  }

  function is_unique_username($value) {
    $sql = "SELECT * FROM users WHERE username='$value'";
    global $db; // Uses connection $db set in the initialization file

    $result = db_query($db, $sql); // Query result
    $count = db_num_rows($result); // Number of username matches

    if($count > 0)
      return false;
    else
      return true;
  }
?>
