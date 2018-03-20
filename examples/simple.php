<?php

use \php_api_ml\APIML;

require '../vendor/autoload.php';

$a = new APIML();

$arr = [
	['Relatorio de Contas a Receber','cadastro/relatorio/0','POST','{}','{}'],
	['Relatorio de Contas a Pagar','cadastro/relatorio/1','POST','{}','{}'],
	['Relatorio de Movimento de Caixa','cadastro/relatorio/2','POST','{}','{}'],
	['Relatorio de Metas','cadastro/relatorio/3','POST','{}','{}'],
];

$a->learn($arr);

var_dump($a->process('perceber pontas no mictorio'));