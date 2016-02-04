<?php
return array(
	//'配置项'=>'配置值'
	'DB_TYPE'=>'mysqli',
	'DB_HOST'=>'127.0.0.1',
	'DB_NAME'=>'Dev',
	//'DB_NAME'=>'iwe_azure',
	'DB_USER'=>'root',
	'DB_PWD'=>'1qazxsw2#',
	'DB_PORT'=>'3306',
	'DB_CHARSET'=>'utf8',
	'DB_PREFIX'=>'t_',
	//'DB_PREFIX'=>'td_',
	'MSDB'=>array(
		'DB_HOST'=>'192.168.0.102',
		'DB_NAME'=>'DemoMS',
		'DB_USER'=>'Reader',
		'DB_PWD'=>'1234!@#$',
	),
	'DB_PARAMS'				=> array(\PDO::ATTR_CASE => \PDO::CASE_NATURAL),

);
