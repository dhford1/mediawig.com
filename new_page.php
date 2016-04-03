<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php
	// make sure the section id sent is an integer
	if (intval($_GET['sect']) == 0) {
		redirect_to('content.php');
	}

	include_once("includes/form_functions.php");

	// START FORM PROCESSING
	// only execute the form processing if the form has been submitted
	if (isset($_POST['submit'])) {
		// initialize an array to hold our errors
		$errors = array();
	
		// perform validations on the form data
		$required_fields = array('menu_name', 'position', 'visible', 'content');
		$errors = array_merge($errors, check_required_fields($required_fields, $_POST));
		
		$fields_with_lengths = array('menu_name' => 30);
		$errors = array_merge($errors, check_max_field_lengths($fields_with_lengths, $_POST));
		
		// clean up the form data before putting it in the database
		$section_id = mysql_prep($_GET['sect']);
		$menu_name = trim(mysql_prep($_POST['menu_name']));
		$position = mysql_prep($_POST['position']);
		$visible = mysql_prep($_POST['visible']);
		$content = mysql_prep($_POST['content']);
	
		// Database submission only proceeds if there were NO errors.
		if (empty($errors)) {
			$query = "INSERT INTO tblPages (
						menu_name, position, visible, content, section_id
					) VALUES (
						'{$menu_name}', {$position}, {$visible}, '{$content}', {$section_id}
					)";
			if ($result = mysql_query($query, $db_connect)) {
				// as is, $message will still be discarded on the redirect
				$message = "The page was successfully created.";
				// get the last id inserted over the current db connection
				$new_page_id = mysql_insert_id();
				redirect_to("content.php?page={$new_page_id}");
			} else {
				$message = "The page could not be created.";
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
      <?php echo adminnav($sel_section, $sel_page); ?>
      <?php include('includes/adminstaticnav.php'); ?>
    </div>
    <div id="idAdminMainRight">
      <h1>Admin <span class="clsDarkGrayText">Area</span></h1>
      <strong>Add New Page</strong> - <a href="content.php">Cancel</a>
      <?php if (!empty($message)) {echo "<p class=\"message\">" . $message . "</p>";} ?>
      <?php if (!empty($errors)) { display_errors($errors); } ?>
      <form action="new_page.php?sect=<?php echo $sel_section['id']; ?>" method="post">
        <?php $new_page = true; ?>
        <?php // this page is included by new_page.php and edit_page.php ?>
        <?php if (!isset($new_page)) {$new_page = false;} ?>
        <p>Page name: <input type="text" name="menu_name" value="New Page Name" id="menu_name" /></p>
         Position: <select name="position">
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
        <br /><br />
        <p>Visible: <input type="radio" name="visible" value="0"<?php if ($sel_page['visible'] == 0) { echo " checked"; } 	?> /> No &nbsp;
          <input type="radio" name="visible" value="1"<?php if ($sel_page['visible'] == 1) { echo " checked"; } 	?> /> Yes </p>
        <p>Content:<br /> <textarea class="ckeditor" id="editor1" name="content" rows="20" cols="80">Enter New Content Here</textarea>
        </p>
        <input type="submit" name="submit" value="Create Page" />
      </form>
      <br />
      <a href="edit_section.php?sect=<?php echo $sel_section['id']; ?>">Cancel</a><br />
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