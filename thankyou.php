<html>
<head>
<title>Ashlee Caul - Form PHP Test - Thank you</title>
<style>
<!--
body {
  background-color: #bbddff;
	color: #999999;
	align: center;
	font-family: "Arial", Sans-serif
}
#div_form {
	background-color: #ffffff;
	align: center;
	width: 480px;
	height: 400px;
	padding: 10px;
}
h1 {
	color: #9999cc;
	text-shadow: #000000 2px 2px 2px;
}
-->
</style>
<?php
// link to database
$link = mysql_connect ("localhost", "<<myuser>>", "<<mypass>>") or die ('I cannot connect to the database because: ' . mysql_error());
mysql_select_db ("<<mydb>>");

foreach ($HTTP_POST_VARS as $key=>$value) {
	${$key} = mysql_real_escape_string("$value");
} # end foreach

$query = "INSERT INTO forms(names_first, names_last, message) VALUES('$names_first', '$names_last', '$message')";

// Run query.
$result = mysql_query($query, $link);
if (!$result) {
    die('Could not insert data:' . mysql_error());
} # end if


$query = "SELECT * FROM forms";
// Run query.
$result = mysql_query($query, $link);
if (!$result) {
    die('No results:' . mysql_error());
} # end if

$i = mysql_num_rows($result) - 1;
$mycatch = mysql_data_seek($result, $i);
if (!$mycatch) {
	echo "Can't get to the last row: " . mysql_error() . "\n";
} # end if

$myrow = mysql_fetch_assoc($result);

mysql_close($link);
?>
</head>
<body bgcolor="#bbddff">
<div id="div_form">
	<h1>MY FORM</h1>
	<hr>
	<p>Thanks for your message <? print $myrow['names_first'] ?> <? print $myrow['names_last'] ?>.</p>
</div>
</body>
</html>