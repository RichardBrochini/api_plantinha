<?php

class ExceptionDB extends ExceptionFile{

        const ERRO_CONEXAO       = 0;
        const ERRO_QUERY         = 1;
        const VALOR_NAO_DEFINIDO = 2;

    public function ExceptionDB($msg,$cod){
                parent::__construct($msg,$cod);
   }
}
?>
