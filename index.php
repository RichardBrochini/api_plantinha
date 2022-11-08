<?php

include_once("config.php");
$bd =BD::getInstance();
$url = explode(".",str_replace('https://',"",$_SERVER['HTTP_ORIGIN']));
$url = $url[0];

//var_dump($url);

$painel = new Painel();
$painel->url = $url;
$painel->urlPainel();

$url = trim($_GET['ac']);
$comandos = explode("/",$url);

if($painel->idpainel==''){
	if($comandos[1]!=''){
		$painel->idpainel = $comandos[1];
	}

	if(trim($_GET['p'])!=''){
        	$painel->idpainel = trim($_GET['p']);
	}
}

if($comandos[0]=='pegar.lista.comandos'){
	$acao =  new Acao();
	$acao->idpainel = $painel->idpainel;
	echo json_encode($acao->listaComandos());
	die();
}

if($comandos[0]=='media.semanal'){
	$dadosStatus = new DadosStatus();
	$dadosStatus->idpainel = $painel->idpainel;
	echo json_encode($dadosStatus->mediaSemanal());
	die();
}

if (strpos($comandos[0],"hora.bash.") !== false) {
        $comandos[0] = str_replace("hora.bash.","",$comandos[0]);
        $dadosStatus = new DadosStatus();
        $dadosStatus->idpainel = $painel->idpainel;
	$dados = $dadosStatus->diario(trim($comandos[0]));
	echo trim($dados[0]['hora']);
        die();
}

if (strpos($comandos[0],"diario.bash.") !== false) {
        $comandos[0] = str_replace("diario.bash.","",$comandos[0]);
        $dadosStatus = new DadosStatus();
	$dadosStatus->idpainel = $painel->idpainel;
	$dados = $dadosStatus->diario(trim($comandos[0]));
        echo trim($dados[0]['valor']);
	die();
}

if (strpos($comandos[0],"diario.") !== false) {
	$vet = explode(".",trim($comandos[0]));
	$dadosStatus = new DadosStatus();
        $dadosStatus->idpainel = $painel->idpainel;
	if(count($vet)==3){
		echo json_encode($dadosStatus->diarioHora(trim($vet[1]),trim($vet[2])));	
	}else{
		echo json_encode($dadosStatus->diario(trim($vet[1])));
	}
	die();
}

if(trim($_GET['s'])!=''){
	$bd =BD::getInstance();
	$dadosStatus = new DadosStatus();
        $dadosStatus->idpainel = $painel->idpainel;
	$dadosStatus->idtipo_status=1;
	$dadosStatus->valor=trim($_GET['u']);
	$dadosStatus->salvar();
	$dadosStatus->idtipo_status=2;
        $dadosStatus->valor=trim($_GET['t']);
	$dadosStatus->salvar();
	$dadosStatus->idtipo_status=3;
        $dadosStatus->valor=trim($_GET['l']);
	$dadosStatus->salvar();
	$dadosStatus->idtipo_status=4;
        $dadosStatus->valor=trim($_GET['s']);
        $dadosStatus->salvar();
}
$idtipo_acao = 1;
if (strpos($comandos[0],"bash_") !== false) {
	$idtipo_acao = 2;
	$comandos[0] = str_replace("bash_","",$comandos[0]);
}

if (strpos(trim($_GET['ac']),"painel_") !== false) {
        $idtipo_acao = 3;
        $comandos[0] = str_replace("painel_","",$comandos[0]);
}

if(trim($_GET['acao'])!=''){
	$idtipo_acao = 4;
	$comandos[0] = trim($_GET['acao']);
}

if($comandos[0]=='acender'){
        $bd =BD::getInstance();
        $bd->query("update situacaoAtual set arduino='31',`update`=NOW() where tipo_status_idtipo_status=3 and painel_idpainel='".$painel->idpainel."'");
}
if($comandos[0]=='apagar'){
        $bd =BD::getInstance();
        $bd->query("update situacaoAtual set arduino='30',`update`=NOW() where tipo_status_idtipo_status=3  and painel_idpainel='".$painel->idpainel."'");
}

if($comandos[0]=='molhar'){
        $bd =BD::getInstance();
	$bd->query("update situacaoAtual set arduino='41',`update`=NOW() where tipo_status_idtipo_status=4  and painel_idpainel='".$painel->idpainel."'");
}

if(trim($_GET['acao'])=='agua'){
	$bd =BD::getInstance();
        $bd->query("update situacaoAtual set arduino='40',`update`=NOW() where tipo_status_idtipo_status=4  and painel_idpainel='".$painel->idpainel."'");
}

if($comandos[0]!=''){
	$bd->query("insert into acao set dia=NOW(),idtipo_acao=".$idtipo_acao.",comando='".$comandos[0]."',idpainel='".$painel->idpainel."'");
}


$dados = $bd->resultSet("select arduino from situacaoAtual where tipo_status_idtipo_status=4 and painel_idpainel='".$painel->idpainel."' order by `update` DESC limit 1");
if(trim($dados[0]['arduino'])==41){
	$dados = $bd->resultSet("select arduino from situacaoAtual where tipo_status_idtipo_status=4 and painel_idpainel='".$painel->idpainel."' order by `update` DESC limit 1");
}else{
	$dados = $bd->resultSet("select arduino from situacaoAtual where tipo_status_idtipo_status=3 and painel_idpainel='".$painel->idpainel."' order by `update` DESC limit 1");
}
echo "+".trim($dados[0]['arduino'])."+";
echo "\n";
?>
