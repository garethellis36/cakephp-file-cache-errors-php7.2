<?php

class DATABASE_CONFIG {

    const DB_USER = "";
    const DB_PASS = "";
    const DB_HOST = "";

	public $default = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => self::DB_HOST,
		'login' => self::DB_USER,
		'password' => self::DB_PASS,
		'database' => 'cake_test_app',
		'prefix' => '',
	);

	public $test = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => self::DB_HOST,
		'login' => self::DB_USER,
		'password' => self::DB_PASS,
		'database' => 'cake_test_test',
		'prefix' => '',
	);
}
