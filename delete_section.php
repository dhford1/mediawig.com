<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php
	if (intval($_GET['sect']) == 0) {
		redirect_to("content.php");
	}
	
	$id = mysql_prep($_GET['sect']);
	
	if ($subject = get_section_by_id($id)) {
		
		$query = "DELETE FROM tblSections WHERE id = {$id} LIMIT 1";
		$result = mysql_query($query, $db_connect);
		if (mysql_affected_rows() == 1) {
			redirect_to("content.php");
		} else {
			// Deletion Failed
			echo "<p>Section deletion failed.</p>";
			echo "<p>" . mysql_error() . "</p>";
			echo "<a href=\"content.php\">Return to Admin Home</a>";
		}
	} else {
		// section didn't exist in database
		redirect_to("content.php");
	}
?>

<?php mysql_close($db_connect); ?>