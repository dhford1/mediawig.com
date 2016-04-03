<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="description" content="" />
  <meta http-equiv="pragma" content="no-cache" />
  <meta name="revisit-after" content="15 days" />
  <meta name="robots" content="ALL" />
  <meta name="language" content="en-us" />
  <meta name="location" content="Raleigh, North Carolina" />
  <meta http-equiv="imagetoolbar" content="false" />
  <meta name="MSSmartTagsPreventParsing" content="true" />
  <meta name="copyright" content="Copyright 1996-<?php echo date("Y"); ?> MEDIAWIG" />
  <meta name="resource-type" content="document" />
  <link rel="Shortcut Icon" href="/favicon.ico">
<title>MEDIAWIG - <?php echo htmlentities($sel_page['menu_name']); ?></title>
<link href="/styles/styles.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="/jquery/jqueryslidemenu.css" />
<script type="text/javascript" src="/javascripts/functions.js"></script>
  <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.0/jquery.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script type="text/javascript" src="/jquery/jqueryslidemenu.js"></script>
<script type="text/javascript" src="/jquery/jquery.corner.js"></script>
<script type="text/javascript"> 
$(document).ready(function(){
	$('.clsFormSent').effect('bounce', { times: 6, distance: 20 }, 400);
	$('.clsFormError').effect('bounce', { times: 6, distance: 20 }, 400);
    $(".btn-slide").click(function(){
		$("#panel").slideToggle("slow");
		$(this).toggleClass("active"); return false;
  }); 
});
</script> 
</head>