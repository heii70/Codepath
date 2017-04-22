<?php

  require_once('../private/initialize.php');

  $message = '';
  $hash_method_encode = isset($_POST['encode_algorithm']) ? $_POST['encode_algorithm'] : '';
  $hash_method_decode = isset($_POST['decode_algorithm']) ? $_POST['decode_algorithm'] : '';
  $checksum = '';
 
  if(isset($_POST['submit'])) {
    
    if($_POST['submit'] == "Create") {
      // This is a create checksum request
      $message = isset($_POST['message']) ? $_POST['message'] : nil;
      $checksum = generate_checksum($message,$hash_method_encode);
    }
    else {
      // This is a verify checksum request
      $message = isset($_POST['message']) ? $_POST['message'] : nil;
      $checksum = isset($_POST['checksum']) ? $_POST['checksum'] : nil;
      $result = verify_checksum($message, $checksum, $hash_method_decode);
      $result_text = $result == 1 ? 'Valid' : 'Not valid';
    }
  }

?>

<!doctype html>

<html lang="en">
  <head>
    <title>Symmetric Encryption: Create/Verify Checksum</title>
    <meta charset="utf-8">
    <meta name="description" content="">
    <link rel="stylesheet" media="all" href="includes/styles.css" />
  </head>
  <body>
    
    <a href="index.php">Main menu</a>
    <br/>

    <h1>Symmetric Encryption</h1>
    
    <div id="encoder">
      <h2>Create Checksum</h2>

      <form action="" method="post">
      	<div>
          <label for="encode_algorithm">Algorithm</label>
      	  <select name="encode_algorithm">
           	  <option value="md5" <?php if($hash_method_encode == 'md5') { echo "selected"; } ?>>MD5</option>
              <option value="sha1" <?php if($hash_method_encode == 'sha1') { echo "selected"; } ?>>SHA1</option>
              <option value="crc32" <?php if($hash_method_encode == 'crc32') { echo "selected"; } ?>>CRC32</option>
          </select>
        </div>
        <div>
          <label for="message">Message</label>
          <textarea name="message"><?php echo h($message); ?></textarea>
        </div>
        <div>
          <input type="submit" name="submit" value="Create">
        </div>
      </form>
    
      <div class="result"><?php echo h($checksum); ?></div>
      <div style="clear:both;"></div>
    </div>
    
    <hr />
    
    <div id="decoder">
      <h2>Verify Checksum</h2>

      <form action="" method="post">
      	<div>
          <label for="decode_algorithm">Algorithm</label>
      	  <select name="decode_algorithm">
           	  <option value="md5" <?php if($hash_method_decode == 'md5') { echo "selected"; } ?>>MD5</option>
              <option value="sha1" <?php if($hash_method_decode == 'sha1') { echo "selected"; } ?>>SHA1</option>
              <option value="crc32" <?php if($hash_method_decode == 'crc32') { echo "selected"; } ?>>CRC32</option>
          </select>
        </div>
        <div>
          <label for="message">Message</label>
          <textarea name="message"><?php echo h($message); ?></textarea>
        </div>
        <div>
          <label for="checksum">Checksum</label>
          <textarea name="checksum"><?php echo h($checksum); ?></textarea>
        </div>
        <div>
          <input type="submit" name="submit" value="Verify">
        </div>
      </form>

      <div class="result"><?php echo h($result_text); ?></div>
      <div style="clear:both;"></div>
    </div>
    
  </body>
</html>