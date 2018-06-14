<?php
namespace Analogue\Deployer;

use PDO;

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('connection.php');

/**
 * @var PDO connection
 */

if(isset($_GET['t'])) {
  switch ($_GET['t']) {
    case 'servers':
      getServers();
      break;

    default:
      echo("invalid Request");
      die();
      break;
  }
}

function getServers()
{
  $con = new Connection();
  $db = $con->connect();

  $result = $con->execute($db, "SELECT * from servers");
  $json = array();
  $i = 0;
  try {
    foreach($result as $row) {
      $json[$i] = $row;
      $i++;
    }
    print_r(json_encode($json));
  } catch (\Exception $e) {
    echo("Could not get servers");
  }
}


?>
