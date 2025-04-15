# Desafio-Babum
## 🔐 Sistema Administrativo de Clientes

Bem-vindo(a)! Este é um sistema administrativo para gerenciar clientes, com funcionalidades de login, cadastro, edição e exclusão de clientes, além de permitir o cadastro de múltiplos endereços para cada cliente. O sistema utiliza PHP e MySQL, com a finalidade de gerenciar as informações de clientes e seus respectivos endereços, proporcionando uma interface administrativa para o gerenciamento completo desses dados.

O sistema utiliza **Programação Orientada a Objetos (POO)**, banco de dados **MySQL** e inclui uma interface de login, painel administrativo e operações de CRUD de clientes.

---

## Estrutura do Projeto

A estrutura do projeto é a seguinte:

├── classes/ │ 
├── Cliente.php │ 
├── Database.php │ 
├── Endereco.php │ 
├── Funcoes.php │  
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
├── Logout.php 
├── style.css 
└── README.md

## Requisitos

- PHP 7.0 ou superior
- MySQL ou MariaDB
- Apache ou Nginx (para servidor web)

## Como Inicializar o Projeto

1. **Clonar o Repositório**

- Primeiro, clone o repositório para sua máquina local:

```bash
git clone https://github.com/seuusuario/desafio-kabum.git
```

2. **Configuração do Banco de Dados**

- No diretório database/, você encontrará o arquivo banco.sql. Abra esse arquivo no seu MySQL ou MariaDB e execute as instruções para criar o banco de dados e as tabelas necessárias.

-- banco.sql
```sql
CREATE DATABASE desafio_kabum;
USE desafio_kabum;
```
-- (restante do script SQL...)

3. **Configuração do Servidor Web**

- Certifique-se de ter o PHP e um servidor web local configurado:
- Se estiver utilizando o XAMPP ou MAMP, mova o diretório do projeto para a pasta htdocs (para XAMPP) ou a pasta correspondente.
- Se preferir usar o Apache ou Nginx diretamente, configure-o para apontar para a pasta do projeto.

4. **Executando o Projeto**

- Abra o navegador e acesse http://localhost/desafio-kabum (ou a URL correspondente ao seu servidor local).

5. **Acessando o Sistema**

- Acesse a área administrativa usando as seguintes credenciais padrão:

Email: admin1@empresa.com
Senha: senha123

- Isso permitirá que você faça login e utilize as funcionalidades de cadastro e gerenciamento de clientes.

---

## Funcionalidades
**Login:** O sistema permite autenticação de administradores através de um formulário de login.

**Cadastro de Cliente:** Possibilidade de adicionar clientes ao sistema com nome, CPF, RG, data de nascimento e telefone.

**Cadastro de Endereços:** Cada cliente pode ter múltiplos endereços registrados.

**Edição e Exclusão de Clientes:** Funcionalidade para editar ou excluir informações de clientes.

**Listagem de Clientes:** Exibição de todos os clientes cadastrados com seus respectivos endereços.

---

## Exemplo de Uso

**Cadastrar um Novo Cliente**

- Na tela inicial, clique na opção de Cadastrar Cliente.
- Preencha o formulário com as informações do cliente, incluindo nome, CPF, telefone, data de nascimento, RG e endereços.
- Clique em Salvar para registrar as informações.

**Editar Cliente**

- Na página de listagem de clientes, clique em Editar ao lado do cliente desejado.
- Modifique as informações desejadas e clique em Salvar.

**Excluir Cliente**

- Na página de listagem de clientes, clique em Excluir ao lado do cliente que deseja remover.
- Confirme a exclusão na janela de confirmação.

---

### Como Contribuir

- Contribuições são sempre bem-vindas! Caso queira contribuir com melhorias ou correções, siga os passos abaixo:
- Faça o fork do repositório.
- Crie uma branch para sua feature: git checkout -b feature-nome
- Commit suas mudanças: git commit -am 'Adiciona nova feature'
- Push para a branch: git push origin feature-nome
- Envie um pull request.
- Caso encontre um bug ou tenha sugestões, abra uma issue.

---

💻 Desenvolvido por Enzo Zamineli