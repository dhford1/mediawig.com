<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php
	include_once("includes/form_functions.php");
	
	// START FORM PROCESSING
	if (isset($_POST['submit'])) { // Form has been submitted.
		$errors = array();

		// perform validations on the form data
		$required_fields = array('username', 'password');
		$errors = array_merge($errors, check_required_fields($required_fields, $_POST));

		$fields_with_lengths = array('username' => 30, 'password' => 30);
		$errors = array_merge($errors, check_max_field_lengths($fields_with_lengths, $_POST));

		$username = trim(mysql_prep($_POST['username']));
		$password = trim(mysql_prep($_POST['password']));
		$hashed_password = sha1($password);

		if ( empty($errors) ) {
			$query = "INSERT INTO tblUsers (
							username, hashed_password
						) VALUES (
							'{$username}', '{$hashed_password}'
						)";
			$result =  mysql_query($query, $db_connect);
			if ($result) {
				$message = "The user was successfully created.";
			} else {
				$message = "The user could not be created.";
				$message .= "<br />" . mysql_error();
			}
		} else {
			if (count($errors) == 1) {
				$message = "There was 1 error in the form.";
			} else {
				$message = "There were " . count($errors) . " errors in the form.";
			}
		}
	} else { // Form has not been submitted.
		$username = "";
		$password = "";
	}
?>
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
      <h2>Create New User</h2>
       <?php if (!empty($message)) {echo "<p class=\"message\">" . $message . "</p>";} ?>
			<?php if (!empty($errors)) { display_errors($errors); } ?>
			<form action="new_user.php" method="post">
			<table>
				<tr>
					<td>Username:</td>
					<td><input type="text" name="username" maxlength="30" value="<?php echo htmlentities($username); ?>" /></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type="password" name="password" maxlength="30" value="<?php echo htmlentities($password); ?>" /></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" name="submit" value="Create user" /></td>
				</tr>
			</table>
			</form>
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