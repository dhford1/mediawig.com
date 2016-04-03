<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php 
  If (intval($_GET['sect']) == 0){
			   redirect_to("content.php");
			}

// Form Validation

if (isset($_POST['submit'])){
			
	$errors = array();
	$required_fields = array('menu_name', 'position');
	foreach($required_fields as $fieldname) {
		if (!isset($_POST[$fieldname]) || empty($_POST[$fieldname])) {
			$errors[] = $fieldname;
		}
	}
	
	$fields_with_lengths = array('menu_name' => 30);
 			foreach($fields_with_lengths as $fieldname => $maxlength ) {
				if (strlen(trim(mysql_prep($_POST[$fieldname]))) > $maxlength) { $errors[] = $fieldname; }
	}
	
	if (empty($errors)) {
	// Perform Update
				$id = mysql_prep($_GET['sect']);
				$menu_name = mysql_prep($_POST['menu_name']);
				$position = mysql_prep($_POST['position']);
				$visible = mysql_prep($_POST['visible']);
				
			 $query = "UPDATE tblSections SET
				             menu_name = '{$menu_name}',
																	position  =  {$position},
																	visible   =  {$visible}
													 WHERE id = {$id}";
				$result = mysql_query($query, $db_connect);
											   if (mysql_affected_rows() == 1) {
																		// success
																		$message = "The section was successfully updated!";
														} else {
																		// failed
																		$message = "The section update failed.";
																		$message .= "<br/>" . mysql_error();
			     						}
				
          } else {
		         // errors occurred
											$message = "There were " . count($errors) . " error(s) in the form";
    }
	
} // ending bracket of if (isset($_POST['submit']))

?>
<?php find_selected_page();?>
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
      <strong>Edit Section</strong> - <?php echo $sel_section['menu_name']; ?> - <a href="content.php">Cancel</a> <br />
      <br />
      <?php if(!empty($message)) {echo "<p class=\"alert\">" . $message . "</p>";} ?>
      <?php
			// output a list of the fields that had errors
			if (!empty($errors)) {
				echo "<p class=\"errors\">";
				echo "Please review the following fields:<br />";
				foreach($errors as $error) {
					echo " - " . $error . "<br />";
				}
				echo "</p>";
			}
			?>
      <form action="edit_section.php?sect=<?php echo urlencode($sel_section['id']); ?>" method="post">
        <p>Section Name:
          <input type="text" name="menu_name" value="<?php echo $sel_section['menu_name']; ?>" id="menu_name" />
        </p>
        <p>Position:
          <select name="position">
            <?php 
								  $section_set = get_all_sections($public = false);
										$section_count = mysql_num_rows($section_set);
										//$section_count + 1 b/c we are adding a section
										for($count=1; $count <= $section_count+1; $count++){
											  echo "<option value=\"{$count}\"";
													if ($sel_section['position'] == $count) {
														  echo " selected";
														}
													echo ">{$count}</option>";
											}
								?>
          </select>
        </p>
        <p>Visible:
          <input name="visible" type="radio" value="0"<?php if ($sel_section['visible'] == 0) {echo " checked";}?> />
          No &nbsp;
          <input type="radio" name="visible" value="1"<?php if ($sel_section['visible'] == 1) {echo " checked";}?> />
          Yes </p>
        <input type="submit" value="Edit Section" name="submit" />
        &nbsp;&nbsp; <a href="delete_section.php?sect=<?php echo urlencode($sel_section['id']); ?>" onClick="return confirm('Are you sure?');">Delete Section</a>
      </form>
      
      <br />
			<a href="content.php">Cancel</a>
			<div style="margin-top: 2em; border-top: 1px solid #000000;"></div>
				<h3>Pages in this section:</h3>
				<ul>
<?php 
	$section_pages = get_pages_for_section($sel_section['id']);
	while($page = mysql_fetch_array($section_pages)) {
		echo "<li><a href=\"content.php?page={$page['id']}\">
		{$page['menu_name']}</a></li>";
	}
?>
				</ul>
				<br />
				+ <a href="new_page.php?sect=<?php echo $sel_section['id']; ?>">Add a new page to this section</a>
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