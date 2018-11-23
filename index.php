<?php

header('content-type: application/json; charset=utf-8');
require_once __DIR__.'/vendor/autoload.php';

use duzun\hQuery;

$doc = hQuery::fromUrl(
    'http://www.ssw.inf.br/2/ssw_resultSSW_dest',
    ['Accept' => 'text/html,application/xhtml+xml;q=0.9,*/*;q=0.8'],
    ['cnpjdest' => '00000000000'],
    ['method' => 'POST']
);

/* 
 * Os índices do array retornado por find_html() não começam em 0
 * É preciso percorrer o array retornado, mesmo que para obter apenas a primeira posição
 */
$items = $doc->find_html('p:.tdb');
$resultado = [];

foreach($items as $item) {
    $content = trim(str_replace('<br>', "\n", strip_tags($item, '<br>')));
    $resultado[] = explode("\n", $content);
}

echo json_encode($resultado);

?>