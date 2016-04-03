<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php find_selected_page();?>
<?php section_check();?>
<?php include("includes/header.php");?>
<body class="clsPublic" onload="javascript:getNewContent('cf.php');">
		<div id="panel" align="center">
			<form name="commentform" method="post" action="process.php" onsubmit="return fncValidateForm(this);" id="commentform">
				<input type="hidden" name="action" value="feedback">
				<div id="idAJAXcontent" style="padding-top:5px;">
					&nbsp;
				</div>
			</form>
		</div>
		<div style="background:url(/images/bg-full.jpg) no-repeat top center fixed;">
			<div id="idTop">
				<div id="idTopContainer" style="width:910px; margin-left:auto; margin-right:auto;">
					<div id="idLogo" class="clsLeft">
						<div>
							<a href="#" class="clsClearLinkUnderline"><img src="/images/logo-mediawig-reverse.gif" alt="" width="245" height="105" border="0"></a>
						</div>
					</div>
					<div class="clsRight" id="idTopNavHolder">
						<div id="idTopNav" class="clsAlignRight">
							<a href="#" class="btn-slide clsClearLinkUnderline"><img src="images/contact-tab.png" alt=""></a>
						</div><br class="clsClearBoth">
						<h1 class="clsPaddingTop10" style="color:#fff; font-size:15pt;">
							Media that will stick in your head.
						</h1>
					</div><br class="clsClearBoth">
				</div>
			</div>
			<div id="idContainer">
				<div id="idNavContainer">
					<div id="myslidemenu" class="jqueryslidemenu">
						<?php echo public_navigation($sel_section, $sel_page, $public = true) ?><br style="clear:left;">
					</div>
				</div>
				<div class="clsMain">
					<div id="idMainContentLeft" style="text-align:left;">
						<?php
						if (isset($_GET['thanks'])) {
							print "<div class=\"clsFormSent ui-corner-all\"><h2>Thank You!</h2>Your Message has been sent! Someone will back to you as soon as possible.</div><br /><br /><br /><br /><br />";
						}   
						else if (isset($_GET['error'])) {
							print "<div class=\"clsFormError ui-corner-all\"><h2>An Error Occured.</h2>For some reason you message failed to be sent. Please contact us at 919.760.3733</div><br /><br /><br /><br /><br />";
						}   
						else if ($sect <= 1) {
								include('slider.php');
						} 

						?><?php if ($sel_page) { 
								echo "<h1 class=\"clsMainContentHeader\">";
														echo htmlentities($sel_page['menu_name']);
														echo "</h1><br/>";
								echo "<div class=\"page-content\">"; 
														echo $sel_page['content']; 
														echo "</div>"; 
														} else { 
													 $welcome = get_default_page(1); 
														echo "<h1 class=\"clsMainContentHeader\">";
														echo $welcome['menu_name'];
														echo"</h1><br /><div class=\"page-content\">"; 
														echo $welcome['content'];
														echo "</div>"; }?>
					</div>
					<div class="clsSideBar">
						<?php include("includes/sidebar-social.php"); ?><br/>
						<img src="images/mw-illust-anime.gif" alt="" width="203" height="216" border="0"><br/>
						<?php include("includes/sidebar-twitter.php"); ?><br/>						
					</div>
					<div class="clsClearBoth">
						<!--.-->
					</div>
				</div>
			</div><?php include("includes/footer.php"); ?>
		</div><!-- Google Analytics --><script type="text/javascript">
var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-9394168-2']);
		_gaq.push(['_trackPageview']);

		(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
		</script><!-- Google Analytics -->
		<?php require("includes/close_connection.php"); ?>
	</body>
</html>
