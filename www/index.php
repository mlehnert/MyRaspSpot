<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="yes" name="apple-mobile-web-app-capable" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta content="minimum-scale=1.0, width=device-width, maximum-scale=0.6667, user-scalable=no" name="viewport" />
<link href="css/style.css" rel="stylesheet" media="screen" type="text/css" />
<script src="javascript/functions.js" type="text/javascript"></script>
<title>MyRaspSpot</title>
<meta content="keyword1,keyword2,keyword3" name="keywords" />
<meta content="Description of your page" name="description" />
</head>

<body>

<div id="topbar">
    <div id="title">
		MyRaspSpot</div>
</div>

<div id="tributton">
	<div class="links">
		<a id="pressed" href="#">Home</a><a href="connection.php">Connection</a><a href="preferences.php">Preferences</a> </div>
</div>


<div id="content">

<?php
$output = shell_exec("/usr/bin/piutils.sh status wlan1");
echo "<center>$output</center>";
$output = shell_exec("/usr/bin/piutils.sh clients wlan0");
echo "<br><br><center>$output</center>";
?>



</div>




<div id="footer">
	<!-- Support iWebKit by sending us traffic; please keep this footer on your page, consider it a thank you for my work :-) -->
	<a class="noeffect" href="http://snippetspace.com">iPhone site powered by iWebKit</a></div>

</body>

</html>
