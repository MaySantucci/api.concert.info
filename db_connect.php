<?php
// A class file to connect to DB_DATABASE
class DB_CONNECT {
  //constructor
  function _construct() {
    //connecting to database
    $this->connect();
  }

  //destructor
  function _destructor() {
    //closing db connection
    $this->close();
  }

  //Function to connect with database
  function connect() {
    //import database connection variables
    require_once _DIR_ . '/db_config.php';

    //Connecting to mysql db
    $con = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD) or die (mysql_error());
    //Selecting database
    $db = mysql_select_db(DB_DATABASE) or die(mysql_error()) or die(mysql_error());

        // returing connection cursor
        return $con;
    }

    /**
     * Function to close db connection
     */
    function close() {
        // closing db connection
        mysql_close();
    }

}
  

?>
