<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
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
<?php echo adminnav($sel_section, $sel_page); ?>
    <?php include('includes/adminstaticnav.php'); ?>
    </div>
    <div id="idAdminMainRight">
      <h1>Admin <span class="clsDarkGrayText">Area</span></h1>
       <strong>Add New Section</strong> - <a href="content.php">Cancel</a>
       <br /><br />
       <form action="create_section.php" method="post">
        <p>Section Name: <input type="text" name="menu_name" value="" id="menu_name" /></p>
        <p>Position: <select name="position">
        <?php 
								  $section_set = get_all_sections($public = false);
										$section_count = mysql_num_rows($section_set);
										//$section_count + 1 b/c we are adding a section
										for($count=1; $count <= $section_count+1; $count++){
											  echo "<option value=\"{$count}\">{$count}</option>";
											}
								?>
                       </select>
                       </p>
         <p>Visible: <input type="radio" name="visible" value="0" /> No &nbsp;
                     <input type="radio" name="visible" value="1" /> Yes
                     </p>
                     <input type="submit" value="Add Subject" />
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