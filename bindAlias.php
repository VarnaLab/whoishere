<?php
if (!isset($_REQUEST['mac'])) {
	exit("No mac address supplied");
}
$mac = $_REQUEST['mac'];
function is_valid_mac($mac) {
	return preg_match('~^[A-F0-9\-:]*$~', $mac);
}
if (!is_valid_mac($mac)) {
	exit("invalid mac address supplied");
}
file_put_contents(dirname(__FILE__) . "/data/" . $_REQUEST['mac'], $_REQUEST['alias']);
?>