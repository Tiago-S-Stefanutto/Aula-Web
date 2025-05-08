# Aula-Web

Sistema de Biblioteca em PHP utilizando arquitetura MVC (Model-View-Controller)

## 📚 Descrição

Aula-Web é um sistema de gerenciamento de biblioteca desenvolvido em PHP seguindo a arquitetura MVC. O projeto foi criado para facilitar a administração de uma biblioteca, permitindo o controle de livros, autores, categorias, alunos e empréstimos.

## 🌟 Funcionalidades

- **Sistema de Login**: Autenticação de usuários com opção "lembrar-me"
- **Gestão de Alunos**: Cadastro, edição e exclusão de alunos
- **Gestão de Autores**: Registro completo de autores (nome, data de nascimento, CPF)
- **Gestão de Categorias**: Organização de livros por categorias
- **Gestão de Livros**: Cadastro detalhado de livros (título, ISBN, ano, editora)
- **Controle de Empréstimos**: Registro e acompanhamento de empréstimos

## 🛠️ Tecnologias Utilizadas

- PHP
- MySQL
- Arquitetura MVC (Model-View-Controller)
- Orientação a Objetos
- PDO para conexão com banco de dados

## 📋 Requisitos

- PHP 8.0 ou superior
- MySQL 5.7 ou superior
- Servidor Web (Apache, Nginx, etc.)

## ⚙️ Instalação

1. Clone este repositório:
```bash
git clone https://github.com/Tiago-S-Stefanutto/Aula-Web.git
```

2. Configure o banco de dados:
   - Crie um banco de dados MySQL chamado `biblioteca`
   - Importe o arquivo SQL (não incluído no repositório)

3. Configure o arquivo `config.php` com suas credenciais de banco de dados:
```php
$_ENV['db']['host'] = "seu_host:porta";
$_ENV['db']['user'] = "seu_usuario";
$_ENV['db']['pass'] = "sua_senha";
$_ENV['db']['database'] = "biblioteca";
```

4. Certifique-se de que seu servidor web está configurado corretamente para executar PHP.

## 🔧 Estrutura do Projeto

```
Aula-Web/
├── Controller/      # Controladores da aplicação
├── DAO/             # Objetos de Acesso a Dados
├── Model/           # Modelos de dados
├── View/            # Interfaces de usuário (não incluídas no repositório)
├── autoload.php     # Carregamento automático de classes
├── config.php       # Configurações do sistema
├── index.php        # Ponto de entrada da aplicação
└── routes.php       # Definição de rotas
```

## 🚀 Como Usar

1. Acesse o sistema pelo navegador (ex: http://localhost/Aula-Web/)
2. Faça login com suas credenciais
3. Navegue pelo menu para acessar as diferentes funcionalidades:
   - Gerenciamento de Alunos
   - Gerenciamento de Autores
   - Gerenciamento de Categorias
   - Gerenciamento de Livros
   - Controle de Empréstimos

## 🔄 Fluxo de Funcionamento

1. O usuário acessa uma URL
2. O arquivo `routes.php` direciona para o controlador adequado
3. O controlador processa a requisição e interage com os modelos
4. Os modelos se comunicam com o banco de dados através dos DAOs
5. O controlador renderiza a view correspondente

## 📝 Recursos de Código

### Exemplo de Controlador
```php
public static function index() : void
{
    parent::isProtected();
    $model = new Aluno();
    try {
        $model->getAllRows();
    } catch(Exception $e) {
        $model->setError("Ocorreu um erro ao buscar os alunos:");
        $model->setError($e->getMessage());
    }
    parent::render('Aluno/lista_aluno.php', $model);
}
```

### Exemplo de Modelo
```php
public ?string $Nome
{
    set
    {
        if(strlen($value) < 4)
            throw new Exception("Nome deve ter no mínimo 4 caracteres.");
        $this->Nome = $value;
    }
    get => $this->Nome ?? null;
}
```

## 🛠️ Problemas Conhecidos e Correções

- Alguns dos arquivos DAO e Model estão incompletos e precisam ser finalizados
- Há inconsistências de namespace entre arquivos que precisam ser corrigidas
- Alguns métodos possuem erros de sintaxe que precisam ser revisados

## 👥 Contribuição

Contribuições são bem-vindas! Para contribuir:

1. Faça um fork do projeto
2. Crie uma branch para sua feature (`git checkout -b feature/nova-feature`)
3. Faça commit das suas alterações (`git commit -m 'Adiciona nova feature'`)
4. Faça push para a branch (`git push origin feature/nova-feature`)
5. Abra um Pull Request

## 📄 Licença

Este projeto está licenciado sob a licença MIT - veja o arquivo LICENSE para detalhes.

## 📬 Contato

Tiago S. Stefanutto - [GitHub](https://github.com/Tiago-S-Stefanutto)

Link do projeto: [https://github.com/Tiago-S-Stefanutto/Aula-Web](https://github.com/Tiago-S-Stefanutto/Aula-Web)
