<?php
header('Content-Type: application/json');
ini_set('max_execution_time', 300);

if ((isset($_POST['host'])) && (isset($_POST['port'])) && (isset($_POST['user'])) && (isset($_POST['pass'])) && (isset($_POST['type']))) {
    $host = $_POST['host'];
    $port = $_POST['port'];
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $type = $_POST['type'];
    $options = "";
    if (isset($_POST['options'])) {
      $options = $_POST['options'];
    }

    $cmd = ("cd ../repo && git checkout " . $type . " && git pull 2>&1");
    shell_exec($cmd);

    putenv('PHPLOY_PORT=' . $port);
    putenv('PHPLOY_HOST=' . $host);
    putenv('PHPLOY_USER=' . $user);
    putenv('PHPLOY_PASS=' . $pass);

    $cmd = ("phploy -w " . $options . " -s ". $type);

    $output = shell_exec($cmd);
    $output = str_replace(array("\r", "\n"), '', $output);

    echo $output;
} else {
  $jsonResponse = array();
  $jsonResponse['message'] = "invalid request";
  $jsonResponse = str_replace(array("\r", "\n"), '', $jsonResponse);
  echo json_encode($jsonResponse, JSON_FORCE_OBJECT);
}
?>
