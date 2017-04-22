<?php
require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to('index.php?id=' . u($territory['state_id']));
}
$territories_result = find_territory_by_id($_GET['id']);
// No loop, only one result
$territory = db_fetch_assoc($territories_result);

?>
<?php $page_title = 'Staff: Edit Territory ' . h($territory['name']); ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="<?php echo h("../states/show.php?id=" . u($territory['state_id'])); ?>">Back to State Details</a><br />

  <h1>Edit Territory: <?php echo h($territory['name']); ?></h1>

  <?php echo display_errors($errors); ?>

  <form action="<?php echo h("edit.php?id=" . u($territory['id'])); ?>" method="post">
    Name:<br />
    <input type="text" name="name" value="<?php echo h($territory['name']); ?>" /><br />
    State ID:<br />
    <input type="text" name="state_id" value="<?php echo h($territory['state_id']); ?>" readonly /><br />
    Position:<br />
    <input type="text" name="position" value="<?php echo h($territory['position']); ?>" /><br />
    <br />
    <input type="submit" name="submit" value="Create"  />
  </form>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
