<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="description" content="MEDIAWIG is a VMware Authorised Consultancy that delivers a range of VMware based infrastructure solutions." />
<meta name="keywords" content="MEDIAWIG, VM Secured, virtualisation specialists, virtualization specialists, vmware specialists, vmware, vm ware, virtual servers, virtual desktop, vmware partner, microsoft contractors, microsoft specialists, microsoft gold partners,"/>
<meta http-equiv="pragma" content="no-cache" />
<meta name="revisit-after" content="15 days" />
<meta name="robots" content="ALL" />
<meta name="language" content="en-us" />
<meta name="location" content="UK" />
<meta http-equiv="imagetoolbar" content="false" />
<meta name="MSSmartTagsPreventParsing" content="true" />
<meta name="copyright" content="Copyright 2011 MEDIAWIG" />
<meta name="resource-type" content="document" />
<link rel="Shortcut Icon" href="/favicon.ico">
<title>MEDIAWIG Site Admin</title>
<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
<script src="/ckeditor/sample.js" type="text/javascript"></script>
<link href="/ckeditor/sample.css" rel="stylesheet" type="text/css" />
<link href="/styles/styles.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="/jquery/jqueryslidemenu.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
<script type="text/javascript" src="/jquery/jqueryslidemenu.js"></script>
<script type="text/javascript" src="/jquery/jquery.js"></script>
<script type="text/javascript" src="/jquery/jquery.corner.js"></script>
<script type="text/javascript" src="/javascript/functions.js"></script>
<script type="text/javascript">
$().ready(function() {
	$("#idAdminContainer").corner("cc:#dedede");
	$("#idAdminMainLeft").corner("cc:#fff");
	$("#idAdminMainRight").corner("cc:#fff");
});

CKEDITOR.on('instanceReady', function(ev)
    {
        var tags = ['p', 'ol', 'ul', 'li', 'h1', 'h2', 'h3', 'h4', 'textarea', 'div']; // etc.

        for (var key in tags) {
            ev.editor.dataProcessor.writer.setRules(tags[key],
                {
                    indent : false,
                    breakBeforeOpen : true,
                    breakAfterOpen : false,
                    breakBeforeClose : false,
                    breakAfterClose : true
                });
        }
    });
</script>

</head>