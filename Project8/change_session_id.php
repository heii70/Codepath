<?php
require_once('../private/initialize.php');

if(is_post_request())
{
	unset($_COOKIE['PHPSESSID']);
	setcookie('PHPSESSID', $_POST['new_session'], -1, '/');
	session_id($_POST['new_session']);
}
?>

<div>

<form action="" method="post">
    Current Session ID:<br />
    <input type="text" name="current_session" value="<?php echo session_id(); ?>" readonly /><br />
    New Session ID:<br />
    <input type="text" name="new_session" value="<?php echo session_id(); ?>" /><br />
    <br />
    <input type="submit" name="submit" value="Set"  />
  </form>

</div> 