<?php

/**
 * Deployer, A web deployment tool for servers, based on PHPloy
 *
 * @author Bram Korsten <exentory@gmail.com>
 *
 * @link https://github.com/banago/PHPloy
 * @licence MIT Licence
 *
 * @version 1.0.0
 */

namespace Analogue\Deployer;

use PDO;

class Connection {

  /**
   * @var string
   */
  protected $version = '1.0.0';
  /**
   * @var string
   */
  protected $server = 'localhost';
  /**
   * @var string
   */
  protected $database = 'deploy';
  /**
   * @var string
   */
  protected $username = 'root';
  /**
   * @var string
   */
  protected $password = '';

  /**
   * @var PDO
   */
  protected $db;

  public function connect()
  {
    try {
        $this->db = new PDO('mysql:host=localhost;dbname=deploy', $this->username, $this->password);
        return $this->db;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
  }

  public function disconnect()
  {
    $this->db = null;
  }

  public function execute($db, $query)
  {
    try {
      return $db->query($query);
    } catch (\PDOException $e) {
      print "Error!: " . $e->getMessage() . "<br/>";
    }

  }
}
