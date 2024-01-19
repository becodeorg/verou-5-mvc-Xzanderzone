<?php

// This class will manage the connection to the database
// It will be passed on the other classes who need it
class DatabaseManager
{
  // These are private: only this class needs them
  private string $host;
  private string $user;
  private string $password;
  private string $dbname;
  // This one is public, so we can use it outside of this class
  public PDO $connection;

  public function __construct(string $host, string $user, string $password, string $dbname)
  {
    $this->host = $host;
    $this->user = $user;
    $this->password = $password;
    $this->dbname = $dbname;
  }

  public function connect(): void
  {
    // TODO: make the connection to the database
    try {
      $this->connection = new PDO("mysql://host={$this->host};port={3306};dbname={$this->dbname}", $this->user, $this->password);

      //mariadb://xzandersDB_solutionwe: 8998ac1f55702f22603eac35530ebe1c891dc450 @3mw.h.filess.io:3305/xzandersDB_solutionwe
      // $this->connection = new PDO("mysql://xzandersDB_solutionwe:8998ac1f55702f22603eac35530ebe1c891dc450@3mw.h.filess.io:3305/xzandersDB_solutionwe");
      // $this->connection = new PDO("mariadb://$this->user:$this->password@$this->host/$this->dbname");
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      // echo "connected successfully ";
    } catch (PDOException $e) {
      // $this->connection = null;
      echo "connection failed!" . $e->getMessage();
    }
  }
}