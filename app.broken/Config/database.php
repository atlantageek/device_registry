<?php
/* SVN FILE: $Id: database.php,v 1.2 2006/12/08 18:58:31 tj Exp $ */

/**
 * This is core configuration file.
 *
 * Use it to configure core behaviour ofCake.
 *
 * PHP versions 4 and 5
 *
 * CakePHP :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright (c) 2006, Cake Software Foundation, Inc.
 *                     1785 E. Sahara Avenue, Suite 490-204
 *                     Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright    Copyright (c) 2006, Cake Software Foundation, Inc.
 * @link         http://www.cakefoundation.org/projects/info/cakephp CakePHP Project
 * @package      cake
 * @subpackage   cake.app.config
 * @since        CakePHP v 0.2.9
 * @version      $Revision: 1.2 $
 * @modifiedby   $LastChangedBy: phpnut $
 * @lastmodified $Date: 2006/12/08 18:58:31 $
 * @license      http://www.opensource.org/licenses/mit-license.php The MIT License
 */

/**
 * In this file you set up your database connection details.
 *
 * @package cake
 * @subpackage cake.config
 */


/**
 * Database configuration class.
 * You can specify multiple configurations for production, development and testing.
 *
 * driver =>
 * mysql, postgres, sqlite, adodb-drivername, pear-drivername
 *
 * connect =>
 * MySQL set the connect to either mysql_pconnect of mysql_connect
 * PostgreSQL set the connect to either pg_pconnect of pg_connect
 * SQLite set the connect to sqlite_popen  sqlite_open
 * ADOdb set the connect to one of these
 *    (http://phplens.com/adodb/supported.databases.html) and
 *    append it '|p' for persistent connection. (mssql|p for example, or just mssql for not persistent)
 *
 * host =>
 * the host you connect to the database
 * MySQL 'localhost' to add a port number use 'localhost:port#'
 * PostgreSQL 'localhost' to add a port number use 'localhost port=5432'
 *
 */
class DATABASE_CONFIG {

	public $default = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'assetmgr',
		'password' => 'assetmgr8047',
		'database' => 'device_registry',
		'prefix' => '',
		//'encoding' => 'utf8',
	);

        public $report  =  array('driver'    => 'mysql',
                         'connect'  => 'mysql_pconnect',
                         'host'     => 'localhost',
                         'login'    => 'report',
                         'password' => '0upd@tes',
                         'database' => 'device_registry',
                         'prefix'    => '');

	public $test = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'user',
		'password' => 'password',
		'database' => 'test_database_name',
		'prefix' => '',
		//'encoding' => 'utf8',
	);
}

?>
