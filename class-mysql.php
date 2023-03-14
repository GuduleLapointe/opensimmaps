<?php

/**
 * MysQL class used by OpenSimulator helper scripts.
 *
 * This is a little bit obsolete, it could be updated to use PDO classes,
 * but if it ain't broken, don't fix it.
 */

class DB {

	var $Host     = null;        // Hostname of our MySQL server
	var $Database = null;        // Logical database name on that server
	var $User     = null;        // Database user
	var $Password = null;        // Database user's password
	var $Link_ID  = null;        // Result of mysql_connect()/mysqli_connect()
	var $Query_ID = null;        // Result of most recent mysql_query()/mysqli_query()
	var $Record   = array();     // Current mysql_fetch_array()/mysqli_fetch_array() -result
	var $Row;                     // Current row number
	var $Errno = 0;           // Error state of query
	var $Error = '';

	var $UseMySQLi = false;
	var $Timeout;                 // not implement yet

	function __construct( $dbhost = null, $dbname = null, $dbuser = null, $dbpass = null, $usemysqli = true, $timeout = 60 ) {
		$this->Host     = $dbhost;
		$this->Database = $dbname;
		$this->User     = $dbuser;
		$this->Password = $dbpass;

		$this->UseMySQLi = $usemysqli;
		$this->Timeout   = $timeout;
		ini_set( 'mysql.connect_timeout', $timeout );
	}

	function set_DB( $dbhost, $dbname, $dbuser, $dbpass, $usemysqli = false ) {
		$this->Host      = $dbhost;
		$this->Database  = $dbname;
		$this->User      = $dbuser;
		$this->Password  = $dbpass;
		$this->UseMySQLi = $usemysqli;
	}

	function halt( $msg ) {
		echo "<b>DB ERROR   :</b> $msg<br />\n";
		echo "<b>MySQL ERROR:</b> $this->Error ($this->Errno)<br />\n";
		die( 'Session Halted.' );
	}

	function connect() {
		if ( $this->Link_ID == null ) {
			if ( $this->UseMySQLi !== true ) {
				$this->Link_ID = mysql_connect( $this->Host, $this->User, $this->Password );
				if ( ! $this->Link_ID ) {
					$this->Errno = 999;
					return;
				}
				mysql_set_charset( 'utf8' );
				$SelectResult = mysql_select_db( $this->Database, $this->Link_ID );
				if ( ! $SelectResult ) {
					$this->Errno   = mysql_errno( $this->Link_ID );
					$this->Error   = mysql_error( $this->Link_ID );
					$this->Link_ID = null;
					$this->halt( 'cannot select database <i>' . $this->Database . '</i>' );
				}
			} else {
				$this->Link_ID = mysqli_connect( $this->Host, $this->User, $this->Password, $this->Database );
				if ( ! $this->Link_ID ) {
					$this->Errno = 999;
					$this->Error = mysqli_connect_error();
					$this->halt( 'cannot select database <i>' . $this->Database . '</i>' );
				}
				mysqli_set_charset( $this->Link_ID, 'utf8' );
			}
		}
	}

	function escape( $String ) {
		$this->connect();

		if ( ! $this->UseMySQLi ) {
			return mysql_real_escape_string( $String );
		}
		return mysqli_real_escape_string( $this->Link_ID, $String );
	}

	function query( $Query_String ) {
		$this->connect();
		if ( $this->Errno != 0 ) {
			return 0;
		}

		if ( ! $this->UseMySQLi ) {
			$this->Query_ID = mysql_query( $Query_String, $this->Link_ID );
			$this->Errno    = mysql_errno( $this->Link_ID );
			$this->Error    = mysql_error( $this->Link_ID );
		} else {
			$this->Query_ID = mysqli_query( $this->Link_ID, $Query_String );
			$this->Errno    = mysqli_errno( $this->Link_ID );
			$this->Error    = mysqli_error( $this->Link_ID );
		}
		$this->Row = 0;
		if ( ! $this->Query_ID ) {
			$this->halt( 'Invalid SQL: ' . $Query_String );
		}
		return $this->Query_ID;
	}

	function next_record() {
		if ( ! $this->UseMySQLi ) {
			$this->Record = @mysql_fetch_array( $this->Query_ID );
			$this->Row   += 1;
			$this->Errno  = mysql_errno( $this->Link_ID );
			$this->Error  = mysql_error( $this->Link_ID );
			$stat         = is_array( $this->Record );
			if ( ! $stat ) {
				@mysql_free_result( $this->Query_ID );
				$this->Query_ID = null;
			}
		} else {
			$this->Record = @mysqli_fetch_array( $this->Query_ID );
			$this->Row   += 1;
			$this->Errno  = mysqli_errno( $this->Link_ID );
			$this->Error  = mysqli_error( $this->Link_ID );
			$stat         = is_array( $this->Record );
			if ( ! $stat ) {
				@mysqli_free_result( $this->Query_ID );
				$this->Query_ID = null;
			}
		}

		return $this->Record;
	}

}
