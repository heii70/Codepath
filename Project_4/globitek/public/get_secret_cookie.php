<?php require_once('../private/initialize.php');

  const CIPHER_METHOD = 'AES-256-CBC';

  $signed_message = $_COOKIE['scrt'];

  //$pieces = explode('--', $signed_message);
  //$compromised_message = $pieces[0] . "--" . "altered";

  if(!signed_string_is_valid($signed_message))
    echo "Error with message encountered.";
  else
  { 
    $key = 'a1b2c3d4e5';

    $pieces = explode('--', $signed_message);
    $message = $pieces[0];

    // Needs a key of length 32 (256-bit)
    $key = str_pad($key, 32, '*');

    // Base64 decode before decrypting
    $iv_with_ciphertext = base64_decode($message);
    
    // Separate initialization vector and encrypted string
    $iv_length = openssl_cipher_iv_length(CIPHER_METHOD);
    $iv = substr($iv_with_ciphertext, 0, $iv_length);
    $ciphertext = substr($iv_with_ciphertext, $iv_length);

    // Decrypt
    $plaintext = openssl_decrypt($ciphertext, CIPHER_METHOD, $key, OPENSSL_RAW_DATA, $iv);

    echo $plaintext;
    // I have a secret to tell.
  }
?>