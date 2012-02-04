<?php
require_once(dirname(__FILE__)."/classes/DataFetcher.php");
$fetcher = new DataFetcher();
echo json_encode($fetcher->fetchAll());
?>