# api_plantinha

HTTP:GET Request Comandos:

## Acionar atuadores:
```bash
GET /acender/{$idpainel}/
GET /molhar/{$idpainel}/
GET /apagar/{$idpainel}/
```

## Dados Compilados:
```bash
GET /pegar.lista.comandos/{$idpainel}/
GET /media.semanal/{$idpainel}/
GET /diario.{$tipo_acao}/{$idpainel}/
GET /diario.{$tipo_acao}.{$periodo}/{$idpainel}/
```

## Inserindo dados:
```bash
GET ?t=$t&u=$u&s=$s&v=$v&l=$l&acao=$a&p=$idpainel
```
## Projetos de integração com a API
[Codigo Arduino para automação](https://github.com/RichardBrochini/plantinha_ino)
#
[Integração com ALEXA](https://github.com/RichardBrochini/alexa_plantinha)
#
[Painel de Dados e Interação](https://github.com/RichardBrochini/painel_plantinha)
#
[Bash script](https://github.com/RichardBrochini/bash_plantinha)
