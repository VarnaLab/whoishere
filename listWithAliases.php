<?php
  $data = array(); // TODO fetch the mac data and parse it.
  foreach($data as $entry) {
    $aliasFileName = dirname(__FILE__)."/data/".$entry['mac'];
    if(file_exists($aliasFileName))
      $entry['alias'] = file_get_contents($aliasFileName);
    else
      $entry['alias'] = "unknown";
  }
  echo json_encode($data);
?>