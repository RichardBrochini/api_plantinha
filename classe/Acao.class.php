<?php
class Acao {

      	private $bd;
      	private $idpainel;
     
      	public function Acao(){
      		$this->bd =BD::getInstance();	
      	}
      
      	public function __set($propriedade,$valor) {
      		if(strlen($valor)>0){
                	if($propriedade=='idpainel'){
                                 $this->idpainel=$valor;
			 }
		 }
      	}

         public function __get($propriedade) {
                 if($propriedade=='idpainel'){
                         return $this->idpainel;
		 }
	 }

	public function listaComandos(){
		$dados = $this->bd->resultSet("select tc.nome,ac.comando,
			DATE_FORMAT(ac.dia , \"%d/%m/%Y\") as dia,
			DATE_FORMAT(ac.dia , \"%H:%i:%s\") as hora
		from 
			acao  as ac
			inner join(tipo_acao as tc) on(tc.idtipo_acao=ac.idtipo_acao) 
		where
			ac.idpainel='".$this->idpainel."'
			order by ac.dia desc limit 20");
		return $dados;
	}
      
}
?>
