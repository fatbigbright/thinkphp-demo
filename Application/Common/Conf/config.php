<?php
return array(
	//'配置项'=>'配置值'
	'DB_TYPE'=>'mysqli',
	'DB_HOST'=>'127.0.0.1',
	'DB_NAME'=>'Prod',
	'DB_USER'=>'root',
	'DB_PWD'=>'1qazxsw2#',
	'DB_PORT'=>'3306',
	'DB_CHARSET'=>'utf8',
	//'DB_PREFIX'=>'T_',
	'DB_PREFIX'=>'t_',
	'ANOTHER'=>'AAA',
	'DB_AZURE_CONN_STR'=>'mysql://root:1qazxsw2#@localhost:3306/Demo',
	'DOUBLE'=>array(
		'LOW0'=>'CCC',
		'LOW1'=>'DDD'
	),
	'MSDB'=>array(
		'DB_HOST'=>'10.0.2.15',
		'DB_NAME'=>'DemoMS',
		'DB_USER'=>'Reader',
		'DB_PWD'=>'1234!@#$',
	),
	'DB_PARAMS'=>array(\PDO::ATTR_CASE => \PDO::CASE_NATURAL),
	'URL_MODEL'=>0,
);
