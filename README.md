# api_plantinha

HTTP:GET Request Comandos:

Acionar atuadores:
GET /acender/{$idpainel}/
GET /molhar/{$idpainel}/
GET /apagar/{$idpainel}/

Dados Compilados:
GET /pegar.lista.comandos/{$idpainel}/
GET /media.semanal/{$idpainel}/
GET /diario.{$tipo_acao}/{$idpainel}/
GET /diario.{$tipo_acao}.{$periodo}/{$idpainel}/

Inserindo dados:
GET ?t=$t&u=$u&s=$s&v=$v&l=$l&acao=$a&p=$idpainel
