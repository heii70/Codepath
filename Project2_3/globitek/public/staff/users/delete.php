<?php require_once('../../../private/initialize.php');

$id = $_GET['id'];
$user_result = find_user_by_id($id);
$user = db_fetch_assoc($user_result);

$page_title = 'Staff: Delete User ' . $user['first_name'] . " " . $user['last_name']; 
include(SHARED_PATH . '/header.php');

$errors = array();

if(is_post_request())
{
	if($_POST['ans'])
		$result = delete_user_by_id($id);

	if(!$result) 
    	$errors = $result;

	if(empty($errors))
		redirect_to('index.php');
}

?>

<div id="main-content">
	<?php 
	if(!empty($errors)) { echo display_errors($errors)."<br> <br>"; }

	echo "Are you sure you want to permantely delete the user: " . $user['first_name'] . " " . $user['last_name'] . "?";
	echo "<br> <br>";

	?>

	<form action="delete.php?id=<?php echo $_GET['id']; ?>" method="post">
    	Yes: <input type="radio" name="ans" value="1"><br />
    	No: <input type="radio" name="ans" value="0" checked><br />
    	<br />
    	<input type="submit" name="submit" value="Confirm" />
  	</form>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>