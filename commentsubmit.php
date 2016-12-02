$post_id = $_POST["post_id"];
unset($_POST["post_id"]);
$msg = "post_id: $post_id\n";
$msg .= "date: " . date($DATE_FORMAT) . "\n";

foreach ($_POST as $key => $value) {
	if (strstr($value, "\n") != "") {
		// Value has newlines... need to indent them so the YAML
		// looks right
		$value = str_replace("\n", "\n  ", $value);
	}
	// It's easier just to single-quote everything than to try and work
	// out what might need quoting
	$value = "'" . str_replace("'", "''", $value) . "'";
	$msg .= "$key: $value\n";
}

if (mail($EMAIL_ADDRESS, $SUBJECT, $msg, "From: $EMAIL_ADDRESS"))
{
	include $COMMENT_RECEIVED;
}
else
{
	echo "There was a problem sending the comment. Please contact the site's owner.";
}
