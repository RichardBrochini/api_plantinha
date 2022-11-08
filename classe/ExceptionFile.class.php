<?php

class ExceptionFile extends Exception{

        private $log;

    public function ExceptionFile($msg,$cod){
         parent::__construct($msg,$cod);
                $hora  = date("d-m-Y H:i:s");
                 $texto = $hora."::".$msg."::".$cod."\n";
                 $texto = $texto."Classe::".__CLASS__."\n";
                 $texto = $texto."Arquivo::".$this->getFile()."\n";
                 $texto = $texto."Linha::".$this->line."\n";
                 $texto = $texto."Trace::".$this->getTraceAsString()."\n";
                 $texto = $texto."\n\n";
         $this->log->msg=$texto;
    }

    public function gravarLog($arquivo){ }
}
?>
