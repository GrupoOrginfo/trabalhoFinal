<?php
function xmladd($document,$item,$value)
{
		
			$i = $document->createElement($item, $value);
		
			$contato = $document->createElement("contato");

#fone
 $foneElm = $document->createElement("telefone", $fone);

 #endereco
 $endElm = $document->createElement("endereco", $end);

 $parent->appendChild($nomeElm);

 return $parent;
}

$dom = new DOMDocument("1.0", "utf-8");
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;

$root = $dom->createElement("agenda");

#utilizando a funcao para criar contatos
$Tiao = addContato($dom, "Tiao J.", "5555-4444", "R. Jaú, 3");
$Joao = addContato($dom, "Joao S.", "4444-5555", "R. Itú, 4");

#adicionando no root
$root->appendChild($Tiao);
$root->appendChild($Joao);
$dom->appendChild($root);

#salvando o arquivo
$dom->save("agenda.xml");

#mostrar dados na tela
header("Content-Type: text/xml");
print $dom->saveXML();

new DOMDocument("1.0", "utf8")->

?>

