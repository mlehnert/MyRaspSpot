<?php
// Datum aus Vergangenheit
header("Expires: Mon, 12 Jul 1995 05:00:00 GMT");
// Immer geändert 
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
header("Cache-Control: no-store, no-cache, must-revalidate");
// Speziell für MSIE 5 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="yes" name="apple-mobile-web-app-capable" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta content="minimum-scale=1.0, width=device-width, maximum-scale=0.6667, user-scalable=no" name="viewport" />
<meta http-equiv="Cache-Control" content="post-check=0">
<meta http-equiv="Cache-Control" content="pre-check=0">
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
		<a href="index.php">Home</a><a id="pressed">Connection</a><a href="preferences.php">Preferences</a> </div>
</div>
<script language="JavaScript">
<?php
$wanwkey = htmlspecialchars($_POST["wanwlkey"]);
$wanwlan = htmlspecialchars($_POST["wlan"]);

if(isset($wanwlan) && !empty($wanwlan))
{
exec('sudo /usr/bin/piutils.sh setwanwlan "'.$wanwlan.'" \'"'.$wanwkey.'"\'');
}
#echo "<script language="JavaScript">";
#echo "alert("SSID=ssi");";
#echo "</script>";
?>
</script>

<div id="content">
<form method="post">

<span class="graytitle">WLAN in Range</span>
<ul class="pageitem">
<?php
passthru('sudo /usr/bin/piutils.sh scanwlan wlan1');
?>
</ul>
<br>
<span class="graytitle">WAN-Site WLAN Password</span>
<ul class="pageitem">
<li class="bigfield">
<input name="wanwlkey" placeholder="Password" type="password" value="
<?php
passthru('sudo /usr/bin/piutils.sh wanwkey get');
?>
">
</li></ul><br><br><br>
<ul class="pageitem"><li class="button">
<input name="Submit" type="submit" value="Submit config" /></li></ul> 
</form>

</div>




<div id="footer">
	<center>Reload Page for WLAN rescan</center>
	<!-- Support iWebKit by sending us traffic; please keep this footer on your page, consider it a thank you for my work :-) -->
	<a class="noeffect" href="http://snippetspace.com">iPhone site powered by iWebKit</a></div>

</body>

</html>
