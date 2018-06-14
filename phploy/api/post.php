<?php
namespace Analogue\Deployer;

use PDO;

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('connection.php');

$jsonresponse = array();

/**
 * @var PDO connection
 */

if(isset($_GET['t'])) {
  switch ($_GET['t']) {
    case 'newserver':
      newServer();
      break;

    default:
      setResponse("invalid");
      die();
      break;
  }
}

function newServer()
{

  if ((!isset($_POST['server-name'])) || ($_POST['server-name'] == "")) {
    setResponse("server-name");
  }
  if ((!isset($_POST['site-url'])) || ($_POST['site-url'] == "")) {
    setResponse("site-url");
  }
  if ((!isset($_POST['server-url'])) || ($_POST['server-url'] == "")) {
    setResponse("server-url");
  }
  if ((!isset($_POST['server-port'])) || ($_POST['server-port'] == "")) {
    setResponse("server-port");
  }
  if ((!isset($_POST['server-user'])) || ($_POST['server-user'] == "")) {
    setResponse("server-user");
  }
  if ((!isset($_POST['server-pass'])) || ($_POST['server-pass'] == "")) {
    setResponse("server-pass");
  }
  if ((!isset($_POST['core-branch'])) || ($_POST['core-branch'] == "")) {
    setResponse("core-branch");
  }
  if ((!isset($_POST['mod-branch'])) || ($_POST['mod-branch'] == "")) {
    setResponse("mod-branch");
  }
  $serverName = test_input($_POST['server-name']);
  $siteUrl = test_input($_POST['site-url']);
  $serverUrl = test_input($_POST['server-url']);
  $serverPort = (string)test_input($_POST['server-port']);
  $serverScheme = "ftp";
  $serverUser = test_input($_POST['server-user']);
  $serverPass = test_input($_POST['server-pass']);
  $coreBranch = test_input($_POST['core-branch']);
  $modBranch = test_input($_POST['mod-branch']);

  $now = (string)date('Y-m-d H:i:s');

  $con = new Connection();
  $db = $con->connect();
  try {
    $stmt = $db->prepare("INSERT INTO `servers` (`name`, `human_url`, `ftp_url`, `ftp_port`, `ftp_scheme`, `username`, `password`, `master_branch`, `modules_branch`, `created_at`, `updated_at`) VALUES (?,?,?,?,?,?,?,?,?,?,?)");

    $stmt->bindParam(1, $serverName);
    $stmt->bindParam(2, $siteUrl);
    $stmt->bindParam(3, $serverUrl);
    $stmt->bindParam(4, $serverPort);
    $stmt->bindParam(5, $serverScheme);
    $stmt->bindParam(6, $serverUser);
    $stmt->bindParam(7, $serverPass);
    $stmt->bindParam(8, $coreBranch);
    $stmt->bindParam(9, $modBranch);
    $stmt->bindParam(10, $now);
    $stmt->bindParam(11, $now);
    $stmt->execute();

    // $stmt->debugDumpParams();

    setResponse("ok", 1);
  }
  catch (\Exception $e) {
    setResponse("error in query: " + $e, 0);
  }
}

function setResponse($message='', $code=0)
{
  $jsonresponse['code'] = $code;
  $jsonresponse['message'] = $message;
  echo(json_encode($jsonresponse));
  exit();
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


?>
