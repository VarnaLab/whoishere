<?php
require_once(dirname(__FILE__)."/config.php");

if (!function_exists("ssh2_connect")) die("function ssh2_connect doesn't exist");
// log in at server1.example.com on port 22
if(!($con = ssh2_connect("192.168.1.1", 22))){
    echo "fail: unable to establish connection\n";
} else {
    // try to authenticate with username root, password secretpassword
    if(!ssh2_auth_password($con, USER, PASSWORD)) {
        echo "fail: unable to authenticate\n";
    } else {
 
        // execute a command
        if (!($stream = ssh2_exec($con, "arp -a" ))) {
            echo "fail: unable to execute command\n";
        } else {
            // collect returning data from command
            stream_set_blocking($stream, true);
            $data = "";
            while ($buf = fread($stream,4096)) {
                $data .= $buf;
            }
            fclose($stream);
        }
    }
    echo json_encode(parse_arp_output($data));
}
function parse_arp_output($arp_out) {
	$lines = explode("\n", $arp_out);
	$parsed = array();
	foreach ($lines as $line) {
		$res = preg_match('~^(?P<network_name>[\w\-]*) \((?P<ip>[^ ]*)\) at (?P<mac_address>([0-9A-F]{2}:?){6})~', $line, $matches);
		if (!$res) {
			continue;
		}
		$parsed[] = array(
			'ip'=>$matches['ip'],
			'mac_address'=>$matches['mac_address'],
			'name'=>$matches['network_name']
		);
	}
	return $parsed;
}
?>
