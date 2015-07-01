<?php if(!defined('RESTRICTED'))exit('No direct script access.');

class Database
{
    public $pdo;
    public $stmt;

    public function __construct( $host, $user, $password, $database )
    {
        $dsn = 'mysql:host='.$host.';dbname='.$database;

        try {
            $this->pdo = new PDO( $dsn, $user, $password );
        } catch( PDOException $e ) {
            echo 'Connection failed: ' . $e->getMessage();
            exit();
        }

        $this->pdo->query("SET NAMES 'utf8'");
        $this->pdo->query("SET CHARACTER SET 'utf8'");
        $this->pdo->query('SET character_set_connection=utf8');
        $this->pdo->query('SET character_set_client=utf8');
        $this->pdo->query('SET character_set_results=utf8');
    }

    public function create( $table, $data )
    {
        $sql  = "INSERT INTO ". $table;
        $sql .= " (`".implode("`, `", array_keys($data))."`)";
        $sql .= " VALUES (:".implode(", :", array_keys($data)).")";

        $this->stmt = $this->pdo->prepare( $sql );

        foreach( $data as $k => $v )
            $this->stmt->bindValue(":$k", $v);

        $this->stmt->execute();

        return $this->stmt->rowCount() > 0 ? true : false;
    }

    public function read( $table, $fields, $where_data = null )
    {
        $this->_prepareRead( $table, $fields, $where_data );

        if( $this->stmt->rowCount() > 0 ) {
            while( $r = $this->stmt->fetch(PDO::FETCH_ASSOC) )
                $res[] = $r;

            return $res;
        }

        return false;
    }

    public function readOne( $table, $fields, $where_data = null )
    {
        $this->_prepareRead( $table, $fields, $where_data );

        if( $this->stmt->rowCount() > 0 )
            return $this->stmt->fetch(PDO::FETCH_ASSOC);

        return false;
    }

    public function readOneVal( $table, $fields, $where_data = null )
    {
        $this->_prepareRead( $table, $fields, $where_data );

        if( $this->stmt->rowCount() > 0 )
            return $this->stmt->fetchColumn();

        return false;
    }

    public function select( $sql, $values = null )
    {
        $this->_prepareSelect( $sql, $values );

        if( $this->stmt->rowCount() > 0 ) {
            while( $r = $this->stmt->fetch(PDO::FETCH_ASSOC) )
                $res[] = $r;

            return $res;
        }

        return false;
    }

    public function selectOne( $sql, $values = null )
    {
        $this->_prepareSelect( $sql, $values );

        if( $this->stmt->rowCount() > 0 )
            return $this->stmt->fetch(PDO::FETCH_ASSOC);

        return false;
    }

    public function selectOneVal( $sql, $values = null )
    {
        $this->_prepareSelect( $sql, $values );

        if( $this->stmt->rowCount() > 0 )
            return $this->stmt->fetchColumn();

        return false;
    }

    public function update( $table, $set_data, $where_data = null )
    {
        $sql  = "UPDATE ". $table ." SET ";

        foreach( array_keys($set_data) as $k )
            $sql .= $k ." = :". $k .", ";

        $sql = substr($sql, 0, -2);

        if( $where_data !== null ) {
            $sql .= " WHERE ";

            foreach( array_keys($where_data) as $k )
                $sql .= $k ." = :". $k ." AND ";

            $sql = substr($sql, 0, -5);
        }

        $this->stmt = $this->pdo->prepare( $sql );

        foreach( $set_data as $k => $v )
            $this->stmt->bindValue(":$k", $v);

        foreach( $where_data as $k => $v )
            $this->stmt->bindValue(":$k", $v);

        $this->stmt->execute();

        return $this->stmt->rowCount() > 0 ? true : false;
    }

    public function delete( $table, $where_data = null )
    {
        $sql = "DELETE FROM ". $table;

        if( $where_data !== null ) {
            $sql .= " WHERE ";

            foreach( array_keys($where_data) as $k )
                $sql .= $k ." = :". $k ." AND ";

            $sql = substr($sql, 0, -5);
        }

        $this->stmt = $this->pdo->prepare( $sql );

        if( $where_data !== null ) {
            foreach( $where_data as $k => $v )
                $this->stmt->bindValue(":$k", $v);
        }

        $this->stmt->execute();

        return $this->stmt->rowCount() > 0 ? true : false;
    }


    private function _prepareRead( $table, $fields, $where_data = null )
    {
        $sql  = "SELECT ";

        if( is_array($fields) )
            $sql .= implode(", ", array_values($fields));
        else
            $sql .= $fields;

        $sql .= " FROM " . $table;

        if( $where_data !== null ) {
            $sql .= " WHERE ";

            foreach( array_keys($where_data) as $k )
                $sql .= $k ." = :". $k ." AND ";

            $sql = substr($sql, 0, -5);
        }

        $this->stmt = $this->pdo->prepare( $sql );

        if( $where_data !== null ) {
            foreach( $where_data as $k => $v )
                $this->stmt->bindValue(":$k", $v);
        }

        $this->stmt->execute();
    }

    private function _prepareSelect( $sql, $values = null )
    {
        $this->stmt = $this->pdo->prepare( $sql );

        if( $values !== null )
            $this->stmt->execute( $values );
        else
            $this->stmt->execute();
    }
}