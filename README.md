# baldelivery
Api de cadastro e busca de estabelecimentos.

## Requisitos mínimos
- PHP 7.4.x
- Composer 2.x

## Instalação de pacotes
Utilize o comando `composer install` na raiz do projeto.

## Executando a aplicação
Utilize o comando `composer start`. A aplicação estará disponível em `http://localhost:8080`.

## Testando endpoints

### Cadastro de estabelecimentos
Envie uma requisição `POST` para o endpoint `/eateries`. Todos os itens são obrigatórios.


```
curl --location --request POST 'http://localhost:8080/eatery' \
--header 'Content-Type: application/json' \
--data-raw '{
 "id": 3,
 "name": "Restaurante do Nenê",
 "coverageArea": {
   "type": "MultiPolygon",
   "coordinates": [
     [[[30, 20], [45, 40], [10, 40], [30, 20]]],
     [[[15, 5], [40, 10], [10, 20], [5, 10], [15, 5]]]
   ]
 },
 "address": {
   "type": "Point",
   "coordinates": [46.57421, 21.785741]
 }
}'
```

Não serão aceitos ids que já existam na base de dados.


### Busca de estabelecimento por id
Envie uma requisição `GET` para o endpoint `/eateries/{id}`.
```
curl --location --request GET 'http://localhost:8080/eatery/3' \
--header 'Content-Type: application/json'
```


### Busca de estabelecimento por distância
Envie uma requisição `GET` para o endpoint `/eateries/{longitude},{latitude}`.
```
curl --location --request GET 'http://localhost:8080/eatery/location/-40,-20' \ --header 'Content-Type: application/json'
```

## Melhorias @TODO

- Validação de corpo de request no endpoint de cadastro;
- Testes unitários;
- Container em `docker` e `docker-compose`;
- Utilização de base de dados mais robusta (`MySQL`);
- Construção de tabela e seed com migrations;
- Retorno de status codes personalizados para endpoints `GET`.

## Testes unitários
### Estrutura de títulos
Recomenda-se que o título de um teste unitário apresente, em ordem, os seguintes requisitos:
- ação
- condição
- retorno esperado.

Além disso, recomenda-se que cada teste unitário tenha apenas uma asserção.

As camadas com maior necessidade de serem testadas por unidade são: repositório e serviço. 
Os testes podem utlilizar mock para garantir que métodos externos foram chamados corretamente (parâmetros, número de vezes) e para simular resultados obtidos. A partir de resultados mockados, podem ser escritos testes validando os retornos esperados.