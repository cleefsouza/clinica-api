# :syringe: clinica-api
> Simples API para cadastro de médicos e especialidades, colocando em prática as aulas de Symfony 4 na Alura

### Índice
- [Requisitos](#requisitos)
- [Dependências](#dependencias)
- [Executando](#executando)
- [Recursos](#recursos)
  - [Login](#login)
  - [Médico](#medico)
  - [Especialidade](#especialidade)
- [Autor](#autor)
- [Meta](#meta)

### Requisitos <div id="requisitos"></div>
- Composer
- PHP 7.4
- Symfony CLI (opcional)

### Dependências <div id="dependencias"></div>
- Doctrine Fixtures
- Firebase JWT
- Symfony Maker
- Symfony Secutiry

### Executando <div id="executando"></div>
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
    ```json5
    {
        "nome": "clinica-api",
        "descricao": "Cadastro de médicos e especialidades",
        "uri": "http://localhost:8000/",
        "method": "GET"
    }
    ```
 
### Recursos <div id="recursos"></div>

#### Login <div id="login"></div>

##### `/login` Iniciar sessão
- Request
    ```json5
    /**
     * POST /login
     * Content-Type: application/json
     * Host: localhost:8000
     */
    
    {
        "username": "usuario",
        "password": "123456"
    }
    ```
 - Response
    ```json5
    {
        "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6InVzdWFyaW8ifQ.Yytcv05WKMtD5T4-saEgpZxICv7Vhp6uCnfeP_N2Uew"
    }
    ```

#### Médico <div id="medico"></div>

##### `/medico` Adicionar médico
- Request
    ```json5
    /**
     * POST /medico
     * Content-Type: application/json
     * Host: localhost:8000
     * Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6InVzdWFyaW8ifQ.Yytcv05WKMtD5T4-saEgpZxICv7Vhp6uCnfeP_N2Uew
     */
    
    {
    	"crm": "CRM123",
    	"nome": "Joaquim Monteiro de Sousa",
    	"especialidade_id": 1
    }
    ```
 - Response
    ```json5
    {
        "conteudo": {
            "id": 1,
            "nome": "Joaquim Monteiro de Sousa",
            "crm": "CRM123",
            "especialidade_id": 1,
            "_links": [
                {
                    "rel": "self",
                    "path": "/medico/1"
                },
                {
                    "rel": "especialidade",
                    "path": "/especialidade/1"
                }
            ]
        },
        "status": 200,
        "sucesso": true
    }
    ```
##### `/medico/{id}` Buscar médico
- Request
    ```json5
    /**
     * POST /medico/1
     * Content-Type: application/json
     * Host: localhost:8000
     * Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6InVzdWFyaW8ifQ.Yytcv05WKMtD5T4-saEgpZxICv7Vhp6uCnfeP_N2Uew
     */
    ```
 - Response
    ```json5
    {
        "conteudo": {
            "id": 1,
            "nome": "Joaquim Monteiro de Sousa",
            "crm": "CRM123",
            "especialidade_id": 1,
            "_links": [
                {
                    "rel": "self",
                    "path": "/medico/1"
                },
                {
                    "rel": "especialidade",
                    "path": "/especialidade/1"
                }
            ]
        },
        "status": 200,
        "sucesso": true
    }
    ```
##### `/medico/{id}` Atualizar médico
- Request
    ```json5
    /**
     * PUT /medico/1
     * Content-Type: application/json
     * Host: localhost:8000
     * Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6InVzdWFyaW8ifQ.Yytcv05WKMtD5T4-saEgpZxICv7Vhp6uCnfeP_N2Uew
     */
  
      {
        "crm": "CRM456",
        "nome": "Joaquim Monteiro de Freitas",
        "especialidade_id": 2
      }
    ```
 - Response
    ```json5
    {
        "conteudo": {
            "id": 1,
            "nome": "Joaquim Monteiro de Freitas",
            "crm": "CRM123",
            "especialidade_id": 2,
            "_links": [
                {
                    "rel": "self",
                    "path": "/medico/1"
                },
                {
                    "rel": "especialidade",
                    "path": "/especialidade/2"
                }
            ]
        },
        "status": 200,
        "sucesso": true
    }
    ```  
##### `/medico/{id}` Remover médico
- Request
    ```json5
    /**
     * DELETE /medico/1
     * Content-Type: application/json
     * Host: localhost:8000
     * Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6InVzdWFyaW8ifQ.Yytcv05WKMtD5T4-saEgpZxICv7Vhp6uCnfeP_N2Uew
     */
    ``` 

##### `/medicos` Buscar todos os médicos
- Request
    ```json5
    /**
     * GET /medicos
     *
     * Parameters: ?page=1&limit=5&order[nome]=DESC
     * page: número da página
     * limit: limite por página
     * nome|especialidade|crm: filtrar por campo
     * order[campo]: ordenar por campo
     * 
     * Content-Type: application/json
     * Host: localhost:8000
     * Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6InVzdWFyaW8ifQ.Yytcv05WKMtD5T4-saEgpZxICv7Vhp6uCnfeP_N2Uew
     */
    ```
- Response
    ```json5
    {
        "conteudo": [
            {
                "id": 1,
                "nome": "Joaquim Monteiro de Sousa",
                "crm": "CRM555",
                "especialidade_id": 1,
                "_links": [
                    {
                        "rel": "self",
                        "path": "/medico/1"
                    },
                    {
                        "rel": "especialidade",
                        "path": "/especialidade/1"
                    }
                ]
            },
            {
                ...
            },
            {
                ...
            }
        ],
        "status": 200,
        "sucesso": true,
        "pagina": 1,
        "limite": 5
    }
    ``` 
 ##### `/medico/especialidade/{id}` Buscar médicos por especialidade
 - Request
     ```json5
     /**
      * POST /medico/especialidade/1
      * Content-Type: application/json
      * Host: localhost:8000
      * Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6InVzdWFyaW8ifQ.Yytcv05WKMtD5T4-saEgpZxICv7Vhp6uCnfeP_N2Uew
      */
     ```
  - Response
    ```json5
    {
        "conteudo": [
            {
                "id": 1,
                "nome": "Joaquim Monteiro de Sousa",
                "crm": "CRM555",
                "especialidade_id": 1,
                "_links": [
                    {
                        "rel": "self",
                        "path": "/medico/1"
                    },
                    {
                        "rel": "especialidade",
                        "path": "/especialidade/1"
                    }
                ]
            },
            {
                ...
            }
        ],
        "status": 200,
        "sucesso": true,
        "pagina": 1,
        "limite": 5
    }
    ``` 
### Autor <div id="autor"></div>
Aryosvalldo Cleef ─ [linkedin](https://www.linkedin.com/in/aryosvalldo-cleef/) ─ [@cleefsouza](https://github.com/cleefsouza)

### Meta <div id="meta"></div>
Made with :heart: by **Cleef Souza**
