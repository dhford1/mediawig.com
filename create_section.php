<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php
$errors = array();
	
	// Form Validation
	$required_fields = array('menu_name', 'position', 'visible');
	foreach($required_fields as $fieldname) {
		if (!isset($_POST[$fieldname]) || empty($_POST[$fieldname])) {
			$errors[] = $fieldname;
		}
	}
	
	$fields_with_lengths = array('menu_name' => 30);
	foreach($fields_with_lengths as $fieldname => $maxlength ) {
		if (strlen(trim(mysql_prep($_POST[$fieldname]))) > $maxlength) { $errors[] = $fieldname; }
	}
	
	if (!empty($errors)) {
		redirect_to("new_section.php");
	}
?>

<?php
   $menu_name = mysql_prep($_POST['menu_name']);
			$position = mysql_prep($_POST['position']);
			$visible = mysql_prep($_POST['visible']);
?>

<?php
   $query = "INSERT INTO tblSections (
			          menu_name, position, visible
          		) VALUES (
												   '{$menu_name}',{$position},{$visible}
												)";
												if(mysql_query($query, $db_connect)){
													//Success!
													header("Location: content.php");
													exit;
													} else {
														//Display Error
														echo "<p>Section creation failed.</p>";
														echo "<p>" . mysql_error() . "</p>";
														}
?>

<?php require("includes/close_connection.php"); ?>