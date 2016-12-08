<?php

require(__DIR__ . '/vendor/autoload.php');

$adapter = new \Zend\Db\Adapter\Adapter(array(
	'driver' => 'pdo',
	'dsn' => 'mysql:host=localhost;dbname=masterdb;',
	'username' => 'root',
	'password' => '',
	'driver_options' => array(
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
	),
));

$table = 'test_table';


// 直接运行sql
$result = $adapter->query(' select * from ' . $table . ' where id > :id limit :limit ')->execute(array(':id' => 1, ':limit' => 5));

foreach ($result as $item) {
	var_dump($item['title']);
}

echo '<hr />';


// 用Sql对象查询
$sql = new \Zend\Db\Sql\Sql($adapter);

$result = $sql->prepareStatementForSqlObject($sql->select($table)->where(function (\Zend\Db\Sql\Where $where) {
	$where->greaterThan('id', '1')->lessThan('id', '4');
})->limit(10))->execute();


foreach ($result as $item) {
	var_dump($item);
}

