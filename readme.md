
<center>
    <h1>Weather Web</h1>
    <img src="https://user-images.githubusercontent.com/29307282/58775602-a324c880-859c-11e9-8295-c01781f7c9a2.PNG">
</center>


## Sobre o Projeto

Cadastro de Cidades (conforme disponibilidade na API openweather)
Previsão para a cidade com forecast de 5 dias:


-Linguagem utilizada: PHP 7.2
-Framework: Laravel 5.7
-Banco de Dados: MongoDB
-FrontEnd: Select2, JQuery, Bootstrap4
-Todas as dependências estão em: composer.json


## Coleções

Cities: Coleção com os documentos de cidades que a api openweather retorna,
com os dados abaixo:
"active","api_id",'display_name','day','rainy_day','cloudy_day','cloudy_night','rainy_night','night','api_name','country','coords'

Countries: Coleção com o código de países e nome do respective país, utilizada para segmentar as cidades no cadastro.
"name","code"

Todas as cidades já estão cadastradas, a partir da lista fornecida na documentação da api, o usuário apenas ativa as cidades que deseja visualizar.


## Layout

As imagens mudam dinamicamente, conforme o clima na cidade em questão, o usuário pode cadastrar imagens distintas para cada cidade.
Todas as telas são responsivas.

