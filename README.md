# desafio-kabum
## 🔐 Sistema de Login com Painel Administrativo (PHP + MySQL + POO)

Bem-vindo(a)! Este projeto é uma aplicação web desenvolvida em PHP com o objetivo de simular um sistema administrativo simples, com funcionalidades de gerenciamento de clientes, usuários e controle de sessões.

O sistema utiliza **Programação Orientada a Objetos (POO)**, banco de dados **MySQL** e inclui uma interface de login, painel administrativo e operações de CRUD de clientes.

---

## 📁 Estrutura do Projeto

desafio-kabum/ 

├── classes/ │ 
├── Cliente.php │ 
├── Database.php │ 
├── Endereco.php │ 
├── Funcoes.php │ 
├── Logout.php │ 
└── Usuario.php │ 

├── database/ │ 
└── banco.sql │ 

├── portal-administrativo/ │ 
├── area-administrativa.php │ 
└── funcoes/ │ 
├── cadastrarCliente.php │ 
├── editarCliente.php │ 
├── excluirCliente.php │ 
└── listarCliente.php │ 

├── templates/ │ 
├── footer.php │ 
└── navBar.php │ 

├── index.php 
├── style.css 
└── README.md

---

## 🚀 Como Executar o Projeto

### ✅ Pré-requisitos

- PHP >= 7.4
- Apache/Nginx (XAMPP, WAMP, Laragon ou PHP embutido)
- MySQL ou MariaDB
- Navegador Web

### 🛠️ Passo a Passo

1. **Clone o repositório:**

```bash
    git clone https://github.com/seu-usuario/desafio-kabum.git
    cd desafio-kabum
```

2. **Crie o banco de dados:**

Abra o terminal MySQL ou phpMyAdmin e execute:
```sql
    SOURCE C:\xampp\htdocs\dev-kabum\desafio-kabum\database\banco.sql;
```

3. **Configure a conexão no arquivo classes/Database.php**
```php
    private $host = 'localhost';
    private $db_name = 'desafio_kabum';
    private $username = 'root';
    private $password = '';
```

4. **Execute o projeto:**
- Usando servidor embutido:
```bash 
    php -S localhost:8080
```
- Ou coloque os arquivos na pasta htdocs do XAMPP/WAMP e acesse: (Recomendado)
```bash
    http://localhost/desafio-kabum/
```

--- 

## 🤝 Guia para Aliados

Para contribuir com este projeto:
- Clone o repositório e crie uma branch para sua feature:

```bash
git checkout -b feature/sua-funcionalidade
```
- Faça commits claros.
- Envie um Pull Request com uma descrição explicativa.
- Validar mudanças localmente antes de submeter.

## 👨‍💻 Funcionalidades

### 🔐 Login (index.php)

- 'Tela de login usando a classe Usuario.php
- 'Validações e controle de sessão
- 'Redirecionamento para área administrativa

### 📁 Área Administrativa (area-administrativa.php)

- Painel principal após login
- Acesso às operações com clientes
- Opção de logout

### 👥 CRUD de Clientes (portal-administrativo/funcoes/)

- Cadastrar (cadastrarCliente.php)
- Editar (editarCliente.php)
- Excluir (excluirCliente.php)
- Listar (listarCliente.php)

### 📚 Templates

- navBar.php: Navegação
- footer.php: Rodapé
- style.css: Estilos visuais

---

## 🧠 Documentação Técnica

### Estrutura em Camadas

#### Apresentação (interface):

- index.php, area-administrativa.php
- navBar.php, footer.php
- style.css

#### Lógica de Negócio:

- Usuario.php, Cliente.php, Endereco.php, Funcoes.php, Logout.php

#### Persistência (Banco de Dados):

- Database.php
- banco.sql

---

## 🔐 Sessões e Segurança

- session_start() gerencia sessões
- Verificações de $_SESSION['usuario'] para páginas restritas
- Logout controlado por Logout.php

### Ideias futuras

- Usar password_hash() e password_verify() para criptografar senhas com mais segurança.

---

💻 Desenvolvido por Enzo Zamineli
