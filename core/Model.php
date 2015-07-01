<?php if(!defined('RESTRICTED'))exit('No direct script access.');

abstract class Model
{
	protected static $db;

	public function __construct()
	{
		if( self::$db == null ) {
			self::$db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        }
	}

	public function lastId()
	{
		return self::$db->pdo->lastInsertId();
	}

    public function encrypt( $password )
    {
        // First it generates a salt already encrypted in md5
        $salt = md5(PW_SALT);
 
        // First encryption with crypt
        $password = crypt($password, $salt);
 
        // Second encryption with sha512 - 128 bits
        $password = hash('sha512', $password);
        
        // Returns a password with 128 bits
        return $password;
    }
}

 /**
  * Returns true or false
  * self::$db->create( $table, $data )
  *
  * Ex.: self::$db->create('teste', array('id' => NULL, 'name' => 'Lucas Caprio'));
  *
  *
  *
  * Returns an array with data colection
  * self::$db->read( $table, $fields, $where_data = null )
  * self::$db->select( $sql, $values = null )
  *
  * Ex.: self::$db->read('teste', array('id', 'name'), array('id' => 1));
  *		 self::$db->select("SELECT * FROM teste WHERE id = ? AND name = ?", array(1, 'Lucas Caprio'));
  *
  *
  *
  * Returns a data colection
  * self::$db->readOne( $table, $fields, $where_data = null )
  * self::$db->selectOne( $sql, $values = null )
  *
  * Ex.: self::$db->readOne('teste', array('id', 'name'), array('id' => 1));
  * 	 self::$db->selectOne("SELECT * FROM teste WHERE id = ? AND name = ?", array(1, 'Lucas Caprio'));
  *
  *
  *
  * Returns a data
  * self::$db->readOneVal( $table, $fields, $where_data = null )
  * self::$db->selectOneVal( $sql, $values = null )
  *
  * Ex.: self::$db->readOneVal('teste', array('name'), array('id' => 1));
  * 	 self::$db->selectOneVal("SELECT name FROM teste WHERE id = ?", array(1));
  *
  *
  *
  * Returns true or false
  * self::$db->update( $table, $set_data, $where_data = null )
  *
  * Ex.: self::$db->update('teste', array('name' => 'Lucas Fernandes Caprio'), array('id' => 1));
  *
  *
  *
  * Returns true or false
  * self::$db->delete( $table, $where_data = null )
  * 
  * Ex.: $db->delete('teste', array('id' => 1));
  *
  *
  *
  * NOTES
  * All the $where_data are with the clause AND;
  * There are two public variables: $pdo and $stmt;
 **/