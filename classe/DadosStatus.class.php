<?php
class DadosStatus {

        private $bd;
        private $idpainel;
	private $idtipo_status;
	private $valor;

        public function DadosStatus(){
                $this->bd =BD::getInstance();
	}

        public function __set($propriedade,$valor) {
                if(strlen($valor)>0){
                        if($propriedade=='idpainel'){
                                 $this->idpainel=$valor;
                         }
		}
		if(strlen($valor)>0){
                        if($propriedade=='idtipo_status'){
                                 $this->idtipo_status=$valor;
                         }
		}	
		if(strlen($valor)>0){
                        if($propriedade=='valor'){
                                 $this->valor=$valor;
                         }
		}
        }

         public function __get($propriedade) {
                 if($propriedade=='idpainel'){
                         return $this->idpainel;
		 }
		 if($propriedade=='idtipo_status'){
                         return $this->idtipo_status;
		 }
		 if($propriedade=='valor'){
                         return $this->valor;
                 }
	 }

	public function mediaSemanal(){
		        $dados = $this->bd->resultSet("select DATE_FORMAT(max(ds.dia) , \"%d/%m/%Y\") as dia,
			DATE_FORMAT(max(ds.dia) , \"%H:%i:%s\") as hora,                
			ds.idtipo_status,
			ts.nome,
			ROUND((sum(valor)/count(*)), 2) as mediaSemana 
        	from 
			dados_status as ds 
			inner join(tipo_status as ts) on(ts.idtipo_status=ds.idtipo_status)
        	where
			ds.idpainel='".$this->idpainel."' and
			ds.dia  >= ( CURDATE() - INTERVAL 7 DAY )
		group by ds.idtipo_status  order by ds.idtipo_status asc");
		$temp = null;
		$temp[0]['dia']         = $dados[0]['dia'];
		$temp[0]['hora']        = $dados[0]['hora'];
		$temp[0]['umidade']     = $dados[0]['mediaSemana'];
		$temp[0]['luz']         = round(($dados[2]['mediaSemana'] * 100) / 1000);
		$temp[0]['temperatura'] = $dados[1]['mediaSemana'];
		$temp[0]['agua']        = round(($dados[3]['mediaSemana'] * 100) / 1000);
		return $temp;
	}

	public function diario($comando){
		        $dados = $this->bd->resultSet("select  ds.idtipo_status,ts.nome,ROUND(ds.valor,0) as valor,
			DATE_FORMAT(ds.dia , \"%d/%m/%Y\") as dia,
			DATE_FORMAT(ds.dia , \"%H:%i:%s\") as hora
		from
			dados_status as ds
			inner join(tipo_status as ts) on(ts.idtipo_status=ds.idtipo_status)
		where
			ds.idpainel='".$this->idpainel."' and ts.nome='".$comando."' order by ds.dia desc limit 1");
			return $dados;
	}

	public function diarioHora($comando,$tempo){
                        $dados = $this->bd->resultSet("select  		
				ts.nome,
				max(ds.dia) as dia,
				hour(ds.dia)  as hora,
                		round((sum(ds.valor)/count(*)))  as valor
                from
                        dados_status as ds
                        inner join(tipo_status as ts) on(ts.idtipo_status=ds.idtipo_status)
                where
                        ds.idpainel='".$this->idpainel."' and ts.nome='".$comando."'  and 
                        (DATE_SUB(NOW(),INTERVAL ".$tempo." HOUR)<ds.dia)  group by hora order by dia asc");
                        return $dados;
	}

	public function salvar(){
	        $this->bd->query("insert into dados_status set idpainel='".$this->idpainel."',idtipo_status=".$this->idtipo_status.",valor='".$this->valor."',dia=NOW()");
	}
}
?>
