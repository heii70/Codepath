<?php

  // is_blank('abcd')
  function is_blank($value='') {
    return !isset($value) || trim($value) == '';
  }

  // has_length('abcd', ['min' => 3, 'max' => 5])
  function has_length($value, $options=array()) {
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
    // Function can be improved later to check for
    // more than just '@'.
    if(preg_match('/\A[A-Za-z0-9\@\._-]+\Z/', $value))
      return true;
    else
      return false;

    //return strpos($value, '@') !== false;
  }

  function has_valid_username_format($value) {

    if(preg_match('/\A[A-Za-z0-9\_\.]+\Z/', $value))
        return true;
    else
        return false;
  }

  function has_valid_phone_format($value) {

    if(preg_match('/\A[0-9\s\()\-]+\Z/', $value))
        return true;
    else
        return false;
  }
  
  // Custom Validations

  function has_valid_name_format($value) {

    if(preg_match('/\A[A-Za-z\-\s]+\Z/', $value))
        return true;
    else
        return false;
  }

  function is_alphabetic($value) {

    if(preg_match('/\A[A-Z]+\Z/', $value))
        return true;
    else
        return false;
  }

  function is_unique_username($value) {
    $sql = "SELECT * FROM users WHERE ";
    $sql .= "username='" . escape($value) . "'";
    global $db; // Uses connection $db set in the initialization file

    $result = db_query($db, $sql); // Query result
    $count = db_num_rows($result); // Number of username matches

    if($count > 0)
      return false;
    else
      return true;
  }

?>
