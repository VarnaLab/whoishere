<?php
  header("Access-Control-Allow-Origin: *");
  require_once(dirname(__FILE__)."/classes/DataFetcher.php");
  $fetcher = new DataFetcher();
  $data = $fetcher->fetchAll();
  $ip=$_SERVER['REMOTE_ADDR'];
  foreach($data as $entry) {
    if($entry['ip'] == $ip) {
      echo json_encode($entry);
      exit();
    }
  }
  echo "not found";
?>