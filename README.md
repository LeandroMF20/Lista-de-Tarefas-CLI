# 📝 Lista de Tarefas CLI

Este é um projeto simples de lista de tarefas (To-Do List) executado via linha de comando (CLI), desenvolvido para fins de estudo e prática de lógica de programação e persistência de dados.

> **⚠️ Aviso Importante:** Este é um projeto de **aprendizado** e ainda está em **fase de desenvolvimento**. Ele contém bugs conhecidos, falta de tratamento de exceções e recursos incompletos.

---

## 🚀 Funcionalidades Atuais
- Adicionar uma nova tarefa.
- Listar tarefas existentes.
- Marcar tarefa como concluída (em desenvolvimento).
- Remover uma tarefa através de seu ID

## 🐛 Problemas Conhecidos e Limitações
- **Disparo de erros:** Atualmente alguns comandos ainda não tem disparo e tratamento de erros.


## 📚 O que estou praticando neste projeto:

1. **Arquitetura de Software:** Implementação de padrões como **Repository Pattern** e uso de **Interfaces** para desacoplamento de código.
2. **Tratamento de Exceções:** Fluxo de controle robusto com disparo de erros personalizados e blocos `try/catch`.
3. **Persistência de Dados:** Manipulação de arquivos JSON para armazenamento de objetos e listas.
4. **Interface de Linha de Comando (CLI):** Gerenciamento de entrada/saída de dados e interação direta com o usuário via terminal.
5. **Versionamento:** Boas práticas de commits e organização de repositório com Git.

---

## 💻 Como testar

Para rodar o projeto localmente, você precisará do **PHP 8.x** instalado em sua máquina.

1. **Baixe o código-fonte** ou clone o repositório.
2. **Configure o arquivo de dados:**
   - Na raiz do projeto, localize o arquivo `tarefas-example.json`.
   - Renomeie-o para `tarefas.json`.
3. **Execute o programa:**
   - Abra o terminal na raiz do projeto e digite:
     ```bash
     php index.php
     ```

---
Desenvolvido com por [LeandroMF20](https://github.com)
