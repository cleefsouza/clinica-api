# :syringe: clinica-api
> Simples API para cadastro de médicos e especialidades, colocando em prática as aulas de Symfony 4 na Alura

### Requisitos
- Composer
- PHP 7.4
- Symfony CLI (opcional)

### Dependências:
- Doctrine Fixtures
- Firebase JWT
- Symfony Maker
- Symfony Secutiry

### Executando
- Clone o projeto:
  ```shell
  git clone git@github.com:cleefsouza/clinica-api.git
  ```

- Execute o seguinte comando na raiz do projeto:
  ```shell
  composer install
  ```

- Execute usando o `php server` ou `symfony cli`:
  ```shell
  php -S localhost:8000 -t public
  # ou
  symfony server:start
  ```

- Acesse `http://localhost:8000/` para o seguinte retorno:
    ```json
    {
        "nome": "clinica-api",
        "descricao": "Cadastro de médicos e especialidades",
        "uri": "http://localhost:8000/",
        "method": "GET"
    }
    ```

### Autor <div id="autor"></div>
Aryosvalldo Cleef ─ [linkedin](https://www.linkedin.com/in/aryosvalldo-cleef/) ─ [@cleefsouza](https://github.com/cleefsouza)

### Meta <div id="meta"></div>
Made with :heart: by **Cleef Souza**
