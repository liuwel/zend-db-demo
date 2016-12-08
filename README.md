# zend-db-demo

#### 测试数据

```sql
CREATE TABLE `test_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增主键',
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `content` text COMMENT '内容',  
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='测试表';

INSERT INTO `test_table` VALUES ('1', '测试标题1', '测试内容1');
INSERT INTO `test_table` VALUES ('2', '测试标题2', '测试内容2');
INSERT INTO `test_table` VALUES ('3', '测试标题3', '测试内容3');
INSERT INTO `test_table` VALUES ('4', '测试标题4', '测试内容4');
INSERT INTO `test_table` VALUES ('5', '测试标题5', '测试内容5');
INSERT INTO `test_table` VALUES ('6', '测试标题6', '测试内容6');

```



#### 代码示例

```php 
require(__DIR__.'/vendor/autoload.php');

$adapter = new \Zend\Db\Adapter\Adapter(array(
	'driver' => 'pdo',
	'dsn' => 'mysql:host=localhost;dbname=masterdb;',
	'username' => 'user',
	'password' => 'password',
	'driver_options' => array(
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
	),
));


//$result = $adapter->query(' select * from test_table where id > :id limit :limit ')->execute(array(':id'=>2,':limit'=>5));
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
})->limit(5))->execute();

foreach($result as $item){
	var_dump($item['title']);
}
```

