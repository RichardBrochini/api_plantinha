<?php
class BD {

      private $banco;
      private $senha;
      private $usuario;
      private $servidor;
      private $result;
      private $id;
      private $link;
      private static $instancia;

     private function BD(){
        $this->servidor  = Config::$sqlHost;
        $this->usuario   = Config::$sqlUser;
        $this->senha     = Config::$sqlPass;
        $this->banco     = Config::$sqlScrema;
        $this->conectaBanco();
     }

         public static function getInstance(){
                if(empty(self::$instancia)){
                        self::$instancia = new BD();
                        return self::$instancia;
                }else{
                        return self::$instancia;
                }
         }

         public function __set($propriedade,$valor) {
                 if(strlen($valor)>0){
                         if($propriedade=='banco'){
                                $this->banco=$valor;
                         }else if($propriedade=='senha'){
                                $this->senha=$valor;
                         }else if($propriedade=='usuario'){
                                $this->usuario=$valor;
                         }else if($propriedade=='servidor'){
                                $this->servidor=$valor;
                         }else if($propriedade=='id'){
                                if(is_int($valor)){
                                        $this->id=$valor;
                                }else{
                                        throw new ExceptionDB('Valor invalido, integer era esperado:',ExceptionDB::VALOR_NAO_DEFINIDO);
                                }
                         }else if($propriedade=='link'){
                                $this->link=$valor;
                         }else if($propriedade=='result'){
                                $this->result=$valor;
                         }
                 }else{
                        throw new ExceptionDB('Valor invalido:',ExceptionDB::VALOR_NAO_DEFINIDO);
                 }
	 }


         public function __get($propriedade) {
                 if($propriedade=='banco'){
                        if(strlen($this->banco)<0){
                                throw new ExceptionDB('Valor invalido:',ExceptionDB::VALOR_NAO_DEFINIDO);
                        }
                        return $this->banco;
                 }else if($propriedade=='senha'){
                        if(strlen($this->senha)<0){
                                throw new ExceptionDB('Valor invalido:',ExceptionDB::VALOR_NAO_DEFINIDO);
                        }
                        return $this->senha;
                 }else if($propriedade=='usuario'){
                        if(strlen($this->usuario)<0){
                                throw new ExceptionDB('Valor invalido:',ExceptionDB::VALOR_NAO_DEFINIDO);
                        }
                        return $this->usuario;
                 }else if($propriedade=='servidor'){
                        if(strlen($this->servidor)<0){
                                throw new ExceptionDB('Valor invalido:',ExceptionDB::VALOR_NAO_DEFINIDO);
                        }
                        return $this->servidor;
                 }else if($propriedade=='id'){
                        if(strlen($this->id)<0){
                                throw new ExceptionDB('Valor invalido:',ExceptionDB::VALOR_NAO_DEFINIDO);
                        }
                        return $this->id;
                 }else if($propriedade=='link'){
                        if(strlen($this->link)<0){
                                throw new ExceptionDB('Valor invalido:',ExceptionDB::VALOR_NAO_DEFINIDO);
                        }
                        return $this->link;
                 }else if($propriedade=='result'){
                        if(strlen($this->result)<0){
                                throw new ExceptionDB('Valor invalido:',ExceptionDB::VALOR_NAO_DEFINIDO);
                        }
                        return $this->result;
                 }
        }

        public function getLastId(){
                return $this->id;
	}

	        public function conectaBanco(){
                if(empty($this->link)){
                        $this->link = new PDO( 'mysql:host='.$this->servidor.';dbname='.$this->banco,$this->usuario,$this->senha );
                               return true;
               }else{
                        return true;
               }
        }

        public function query($qry){
                if($this->conectaBanco()){
                        if($this->result=$this->link->query($qry)){
                                $id = $this->link->lastInsertId();
                                if(strlen($id)>0){
                                        $this->id = $id;
                                }
                                return true;
                        }else{
                                throw new ExceptionDB('Sintaxe da query errada:'.$qry,ExceptionDB::ERRO_QUERY);
                                return false;
                        }
                }else{
                        return false;
                }
	}

	public function resultSet($qry){
        	$result = $this->query($qry);
        	$vetor = $this->result->fetchAll(PDO::FETCH_ASSOC);
                return $vetor;
	}

	public function getLink(){
                return $this->link;
	}


  	public function mysql_escape_string($value) {
      		return substr($this->getLink()->quote($value), 1, -1);
  	}
}
?>
