# Sistema de Biblioteca - PHP MVC

Sistema de gerenciamento de biblioteca desenvolvido em PHP utilizando arquitetura MVC (Model-View-Controller) para controle completo de empréstimos, livros, alunos, autores e categorias.

## 📚 Sobre o Projeto

Este sistema foi desenvolvido como uma solução completa para gerenciamento de bibliotecas, oferecendo funcionalidades essenciais para o controle de acervo e empréstimos. Utiliza conceitos modernos de orientação a objetos, prepared statements para segurança contra SQL injection e uma arquitetura MVC bem estruturada.

## ✨ Funcionalidades

### 🔐 Sistema de Autenticação
- Login seguro com criptografia SHA1
- Opção "Lembrar-me" com cookies
- Proteção de rotas (páginas protegidas)
- Logout seguro

### 👥 Gestão de Alunos
- Cadastro completo (Nome, RA, Curso)
- Listagem com filtros
- Edição e exclusão
- Validações de campos obrigatórios

### ✍️ Gestão de Autores
- Registro detalhado (Nome, Data de Nascimento, CPF)
- Relacionamento many-to-many com livros
- Validações de dados

### 📖 Gestão de Livros
- Cadastro completo (Título, ISBN, Editora, Ano)
- Múltiplos autores por livro
- Categorização
- Controle de disponibilidade

### 🏷️ Gestão de Categorias
- Organização do acervo
- Classificação por assunto
- Facilita busca e organização

### 📋 Controle de Empréstimos
- Registro de empréstimos com datas
- Controle de devoluções
- Histórico completo
- Relacionamento com alunos e livros

## 🛠️ Tecnologias Utilizadas

- **PHP 8.0+** - Linguagem principal
- **MySQL 5.7+** - Banco de dados
- **PDO** - Conexão segura com banco
- **Bootstrap 5.3.3** - Framework CSS
- **Arquitetura MVC** - Padrão de desenvolvimento
- **Autoload PSR-4** - Carregamento automático de classes
- **Prepared Statements** - Segurança contra SQL Injection

## 📦 Estrutura do Projeto

```
sistema-biblioteca/
├── Controller/              # Controladores da aplicação
│   ├── AlunoController.php
│   ├── AutorController.php
│   ├── CategoriaController.php
│   ├── Controller.php       # Classe base abstrata
│   ├── EmprestimoController.php
│   ├── InicialController.php
│   ├── LivroController.php
│   └── LoginController.php
├── DAO/                     # Data Access Objects
│   ├── AlunoDAO.php
│   ├── AutorDAO.php
│   ├── CategoriaDAO.php
│   ├── DAO.php              # Classe base para conexão
│   ├── EmprestimoDAO.php
│   ├── LivroDAO.php
│   └── LoginDAO.php
├── Model/                   # Modelos de dados
│   ├── Aluno.php
│   ├── Autor.php
│   ├── Categoria.php
│   ├── Emprestimo.php
│   ├── Livro.php
│   ├── Login.php
│   └── Model.php            # Classe base abstrata
├── View/                    # Templates e interfaces
│   ├── Aluno/
│   ├── Autor/
│   ├── Categoria/
│   ├── Emprestimo/
│   ├── Includes/
│   ├── Inicial/
│   ├── Livro/
│   └── Login/
├── autoload.php             # Autoloader de classes
├── config.php               # Configurações do sistema
├── index.php                # Ponto de entrada
├── routes.php               # Definição de rotas
└── README.md
```

## 🚀 Instalação e Configuração

### Pré-requisitos
- PHP 8.0 ou superior
- MySQL 5.7 ou superior
- Servidor web (Apache, Nginx, etc.)
- Extensões PHP: PDO, PDO_MySQL

### Passo a passo

1. **Clone o repositório:**
```bash
git clone https://github.com/seu-usuario/sistema-biblioteca.git
cd sistema-biblioteca
```

2. **Configure o banco de dados:**
```sql
CREATE DATABASE biblioteca CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

3. **Execute o script SQL para criar as tabelas:**
```sql
-- Tabelas principais
CREATE TABLE categoria (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(255) NOT NULL
);

CREATE TABLE autor (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    data_nascimento DATE,
    cpf VARCHAR(14)
);

CREATE TABLE aluno (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    ra VARCHAR(50) NOT NULL UNIQUE,
    curso VARCHAR(255) NOT NULL
);

CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);

CREATE TABLE livro (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_categoria INT NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    isbn VARCHAR(20),
    ano VARCHAR(4),
    editora VARCHAR(255),
    FOREIGN KEY (id_categoria) REFERENCES categoria(id)
);

CREATE TABLE livro_autor_assoc (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_livro INT NOT NULL,
    id_autor INT NOT NULL,
    FOREIGN KEY (id_livro) REFERENCES livro(id) ON DELETE CASCADE,
    FOREIGN KEY (id_autor) REFERENCES autor(id) ON DELETE CASCADE
);

CREATE TABLE emprestimo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_aluno INT NOT NULL,
    id_livro INT NOT NULL,
    data_emprestimo DATE NOT NULL,
    data_devolucao DATE,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id),
    FOREIGN KEY (id_aluno) REFERENCES aluno(id),
    FOREIGN KEY (id_livro) REFERENCES livro(id)
);
```

4. **Configure as credenciais no arquivo `config.php`:**
```php
$_ENV['db']['host'] = "localhost:3306";  // ou sua porta
$_ENV['db']['user'] = "seu_usuario";
$_ENV['db']['pass'] = "sua_senha";
$_ENV['db']['database'] = "biblioteca";
```

5. **Crie um usuário inicial:**
```sql
INSERT INTO usuario (nome, email, senha) 
VALUES ('Administrador', 'admin@biblioteca.com', SHA1('admin123'));
```

6. **Configure seu servidor web** para apontar para o diretório do projeto.

## 🎯 Como Usar

### Acesso ao Sistema
1. Acesse `http://localhost/sistema-biblioteca/`
2. Faça login com as credenciais criadas
3. Navegue pelo menu para acessar as funcionalidades

### Fluxo Básico de Operações

1. **Configuração Inicial:**
   - Cadastre categorias para organizar os livros
   - Registre autores do acervo
   - Cadastre alunos que utilizarão a biblioteca

2. **Gestão do Acervo:**
   - Adicione livros associando-os a categorias e autores
   - Mantenha o cadastro atualizado

3. **Controle de Empréstimos:**
   - Registre empréstimos informando aluno, livro e datas
   - Acompanhe devoluções através da listagem

## 🔧 Recursos Técnicos

### Segurança
- **Prepared Statements:** Proteção contra SQL Injection
- **Autenticação:** Sistema de login obrigatório
- **Validação de Dados:** Validação tanto no front-end quanto no back-end
- **Proteção de Rotas:** Middleware de autenticação

### Arquitetura MVC
- **Model:** Regras de negócio e validações
- **View:** Interface do usuário com Bootstrap
- **Controller:** Lógica de controle e fluxo
- **DAO:** Acesso aos dados de forma organizada

### Características do Código
- **Namespaces:** Organização em namespaces PSR-4
- **Autoload:** Carregamento automático de classes
- **Tipagem:** Uso de type hints e return types
- **Properties:** Uso de propriedades com getters/setters customizados
- **Transações:** Controle de transações em operações complexas

## 🔍 Exemplos de Uso

### Validação Automática nos Models
```php
public ?string $Nome
{
    set {
        if(strlen($value) < 3)
            throw new Exception("Nome deve ter no mínimo 3 caracteres.");
        $this->Nome = $value;
    }
    get => $this->Nome ?? null;
}
```

### Operações com Transações
```php
// Em LivroDAO::insert()
parent::$conexao->beginTransaction();
// Inserção do livro
// Associação com autores
parent::$conexao->commit();
```

## 🛠️ Correções Necessárias

O código atual possui alguns problemas que precisam ser corrigidos:

1. **Erro de sintaxe no routes.php (linha 85):**
```php
// Erro atual:
case '/emprestimo/cadastro':-

// Correção:
case '/emprestimo/cadastro':
```

2. **Linha de debug em LivroController.php:**
```php
// Remover estas linhas (44-46):
echo "Estou onde quero";
var_dump($model->Id_Autores);
```

## 📈 Possíveis Melhorias

- [ ] Implementar sistema de multas por atraso
- [ ] Adicionar relatórios e estatísticas
- [ ] Implementar sistema de reservas
- [ ] Adicionar controle de exemplares múltiplos
- [ ] Criar API REST para integração
- [ ] Implementar sistema de notificações
- [ ] Adicionar upload de capas de livros

## 🤝 Contribuição

1. Faça um fork do projeto
2. Crie uma branch para sua feature (`git checkout -b feature/nova-funcionalidade`)
3. Commit suas mudanças (`git commit -m 'Adiciona nova funcionalidade'`)
4. Push para a branch (`git push origin feature/nova-funcionalidade`)
5. Abra um Pull Request

## 📄 Licença

Este projeto está sob a licença MIT. Veja o arquivo `LICENSE` para mais detalhes.

## 📞 Suporte

Se você encontrar algum problema ou tiver dúvidas:

1. Verifique se seguiu todos os passos de instalação
2. Confira as configurações do banco de dados
3. Verifique as permissões de arquivo do servidor web
4. Consulte os logs de erro do PHP

---

**Desenvolvido com ❤️ para facilitar a gestão de bibliotecas**
