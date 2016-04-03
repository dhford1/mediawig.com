<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php
	// make sure the section id sent is an integer
	if (intval($_GET['page']) == 0) {
		redirect_to('content.php');
	}
  include_once("includes/form_functions.php");

	// START FORM PROCESSING
	// only execute the form processing if the form has been submitted
	if (isset($_POST['submit'])) {
		// initialize an array to hold our errors--
		$errors = array();
	
		// perform validations on the form data
		$required_fields = array('menu_name', 'position', 'content');
		$errors = array_merge($errors, check_required_fields($required_fields));
		
		$fields_with_lengths = array('menu_name' => 30);
		$errors = array_merge($errors, check_max_field_lengths($fields_with_lengths));
		
		// clean up the form data before putting it in the database
		$id = mysql_prep($_GET['page']);
		$menu_name = trim(mysql_prep($_POST['menu_name']));
		$position = mysql_prep($_POST['position']);
		$visible = mysql_prep($_POST['visible']);
		$content = mysql_prep($_POST['content']);
	
		// Database submission only proceeds if there were NO errors.
		if (empty($errors)) {
			$query = 	"UPDATE tblPages SET 
							menu_name = '{$menu_name}',
							position = {$position}, 
							visible = {$visible},
							content = '{$content}'
						WHERE id = {$id}";
			$result = mysql_query($query);
			// test to see if the update occurred
			if (mysql_affected_rows() == 1) {
				// Success!
				$message = "The page was successfully updated.";
			} else {
				$message = "The page could not be updated.";
				$message .= "<br />" . mysql_error();
			}
		} else {
			if (count($errors) == 1) {
				$message = "There was 1 error in the form.";
			} else {
				$message = "There were " . count($errors) . " errors in the form.";
			}
		}
		// END FORM PROCESSING
	}
?>
<?php find_selected_page(); ?>
<?php include("includes/admin-head.php"); ?>
<body id="idAdminArea">
<div id="idAdminContainer" style="background-color:#FFFFFF;">
  <?php include('includes/admin-banner.php'); ?>
  <div class="clsClearBoth"><!--.--></div>
  <div class="clsAdminMain">
    <div id="idAdminMainLeft">
      <h1>Admin <span class="clsDarkGrayText">Nav</span></h1>
      <br />
      <?php echo adminnav($sel_section, $sel_page, $public = false); ?>
      <?php include('includes/adminstaticnav.php'); ?>
    </div>
    <div id="idAdminMainRight">
      <h1>Admin <span class="clsDarkGrayText">Area</span></h1>
      <h2>Edit page: <?php echo $sel_page['menu_name']; ?></h2>
      <?php if (!empty($message)) {echo "<p class=\"message\">" . $message . "</p>";} ?>
      <?php if (!empty($errors)) { display_errors($errors); } ?>
      <form action="edit_page.php?page=<?php echo $sel_page['id']; ?>" method="post">
        <?php // this page is included by new_page.php and edit_page.php ?>
        <?php if (!isset($new_page)) {$new_page = false;} ?>
        <br />
        <p>Page name:
          <input type="text" name="menu_name" value="<?php echo htmlentities($sel_page['menu_name']); ?>" id="menu_name" />
        </p>
        <p>Position:
          <select name="position">
<?php
							if (!$new_page) {
								$page_set = get_pages_for_section($sel_page['section_id']);
								$page_count = mysql_num_rows($page_set);
							} else {
								$page_set = get_pages_for_section($sel_section['id']);
								$page_count = mysql_num_rows($page_set) + 1;
							}
							for ($count=1; $count <= $page_count; $count++) {
								echo "<option value=\"{$count}\"";
								if ($sel_page['position'] == $count) { echo " selected"; }
								echo ">{$count}</option>";
							}
?>
          </select>
        </p>
        <p>Visible:
          <input type="radio" name="visible" value="0"<?php if ($sel_page['visible'] == 0) { echo " checked"; } ?> />
          No
          &nbsp;
          <input type="radio" name="visible" value="1"<?php if ($sel_page['visible'] == 1) { echo " checked"; } ?> />
          Yes </p>
        <p>Content:</p>
          <textarea class="ckeditor" id="editor1" name="content" rows="20" cols="80"><?php echo htmlentities($sel_page['content']); ?></textarea><br/><br/>
        
        <input type="submit" name="submit" value="Update Page" />
        &nbsp;&nbsp; <a href="delete_page.php?page=<?php echo $sel_page['id']; ?>" onClick="return confirm('Are you sure you want to delete this page?');">Delete page</a>
      </form>
      <br />
      <a href="content.php?page=<?php echo $sel_page['id']; ?>">Cancel</a><br />
    </div>
    <div class="clsClearBoth"> 
      <!--.--> 
    </div>
  </div>
</div>
<?php include('includes/admin-footer.php'); ?>
<br />
<br />
&nbsp;
</body>
</html>
<?php require("includes/close_connection.php"); ?>