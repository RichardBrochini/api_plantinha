<?php
class Painel {

        private $bd;
        private $idpainel;
	private $url;
	private $nome;
	private $descricao;
	private $dia;
	private $hash;
	private $key;


        public function Painel(){
                $this->bd =BD::getInstance();
	}

        public function __set($propriedade,$valor) {
                if(strlen($valor)>0){
                        if($propriedade=='idpainel'){
                                 $this->idpainel=trim($valor);
                         }
		}
		if(strlen($valor)>0){
                        if($propriedade=='url'){
                                 $this->url=trim($valor);
                         }
		}
		if(strlen($valor)>0){
                        if($propriedade=='nome'){
                                 $this->nome=trim($valor);
                         }
		}
		if(strlen($valor)>0){
                        if($propriedade=='descricao'){
                                 $this->descricao=trim($valor);
                         }
		}
		if(strlen($valor)>0){
                        if($propriedade=='dia'){
                                 $this->dia=trim($valor);
                         }
		}
		if(strlen($valor)>0){
                        if($propriedade=='hash'){
                                 $this->hash=trim($valor);
                         }
		}
		if(strlen($valor)>0){
                        if($propriedade=='key'){
                                 $this->key=trim($valor);
                         }
                }
        }

         public function __get($propriedade) {
                 if($propriedade=='idpainel'){
                         return $this->idpainel;
		 }
		 if($propriedade=='url'){
                         return $this->url;
		 }
		 if($propriedade=='nome'){
                         return $this->nome;
		 }
		 if($propriedade=='descricao'){
                         return $this->descricao;
		 }
		 if($propriedade=='dia'){
                         return $this->dia;
		 }
		 if($propriedade=='hash'){
                         return $this->hash;
		 }
		 if($propriedade=='key'){
                         return $this->key;
                 }
	 }
	 
	public function urlPainel(){
		$dados = $this->bd->resultSet("select * from painel where url='".$this->url."'");
		$this->idpainel = $dados[0]['idpainel'];
		$this->url = $dados[0]['url'];
		$this->nome = $dados[0]['nome'];
		$this->descricao = $dados[0]['descricao'];
		$this->dia = $dados[0]['dia'];
		$this->hash = $dados[0]['hash'];
		$this->key = $dados[0]['key'];
	}
}
?>
