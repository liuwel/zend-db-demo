<?php 

require(__DIR__.'/vendor/autoload.php');

$adapter = new \Zend\Db\Adapter\Adapter(array(
	'driver' => 'pdo',
	'dsn' => 'mysql:host=localhost;dbname=masterdb;',
	'username' => 'root',
	'password' => '',
	'driver_options' => array(
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
	),
));


//$result = $adapter->query(' select * from test_table where id > :id limit :limit ')->execute(array(':id'=>37,':limit'=>10));
//
//var_dump($result->count());
//foreach($result as $item){
//	var_dump($item);
//}

$table = 'test_table';

$sql = new \Zend\Db\Sql\Sql($adapter);

$result = $sql->prepareStatementForSqlObject($sql->select($table)->where(function(\Zend\Db\Sql\Where $where){
	$where
		->greaterThan('id', '1')
		->lessThan('id', '4');
})->limit(10))->execute();

echo '<pre>';
foreach($result as $item){
	var_export($item);
}

echo '</pre>';