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
    <?php echo adminnav($sel_section, $sel_page, $public = false); ?>
    <?php include('includes/adminstaticnav.php'); ?>
    </div>
    <div id="idAdminMainRight">
      <h1>Admin <span class="clsDarkGrayText">Area</span></h1>
<?php if (!is_null($sel_page)) { // page selected ?>
         <div class="clsRight"><a href="edit_page.php?page=<?php echo urlencode($sel_page['id']); ?>">Click here to edit <?php echo $sel_page['menu_name']; ?> page content</a></div>
			      <h2><?php echo $sel_page['menu_name']; ?></h2>
         <br />
			         <div class="page-content">
				        <?php echo $sel_page['content']; ?>
			         </div><br />            
			<br /><br />
<?php } elseif (!is_null($sel_section)) { // section selected ?>
			      <h2>Add/Edit <?php echo $sel_section['menu_name']; ?></h2>
<?php } else { // nothing selected ?>
			  <h2>Select a section or page to edit</h2>
<?php } ?>
      <p class="clsSectionBreak">&nbsp;</p>
      
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