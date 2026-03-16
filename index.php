<?php

require __DIR__.'/Autoload.php';

use App\Classes\GerenciadorDeTarefas;
use App\Models\JsonRepositorio;

// Carregamento do repositório e do gerenciador de tarefas
$repo = new JsonRepositorio(__DIR__.'/data/tarefas.json');
$gerenciador = new GerenciadorDeTarefas($repo);

// Processamento dos comandos passados via linha de comando
switch ($argv[1]) {
    case '-help':
        echo "Uso: php Gerenciador-de-Tarefas.php [comando] [args]\n";
        echo "Comandos:\n";
        echo "  -add <titulo> <descricao>    Adiciona nova tarefa (título e descrição obrigatórios)\n";
        echo "  -list                        Lista todas as tarefas com seus IDs e estado\n";
        echo "  -done <id>                   Marca a tarefa com o ID informado como concluída\n";
        echo "  -delete <id>                 Remove a tarefa com o ID informado\n";
        echo "  -help                        Exibe esta tela de ajuda\n\n";
        echo "Observações:\n";
        echo "  IDs são números mostrados na lista (-list).\n";
        echo "Exemplo para adição de tarefa:\n";
        echo "  php Gerenciador-de-Tarefas.php -add \"Comprar leite\" \"Ir ao mercado\"\n";
        break;
    case '-add':
        // Adiciona nova tarefa
        $gerenciador->adicionarTarefa($argv[2], $argv[3]);
        $gerenciador->salvar();
        echo "Tarefa adicionada com sucesso\n";
        break;
    case '-list':
        // Lista todas as tarefas
        foreach ($gerenciador->listaDeTarefas() as $id => $item) {
            echo '(ID: '.$id.') ';
            echo "\033[1;31m".$item->retornaTitulo()."\033[0m: ";
            echo $item->retornaDescricao();
            echo $item->retornaConcluido() ? ' [x]'."\n" : ' [ ]'."\n";
        }
        break;
    case '-done':
        // Marca uma tarefa como concluída
        $gerenciador->concluirTarefa($argv[2]);
        $gerenciador->salvar();
        echo "Tarefa marcada como concluída\n";
        break;
    case '-delete':
        // Remove uma tarefa
        $gerenciador->removerTarefa($argv[2]);
        $gerenciador->salvar();
        echo "Item Removido com sucesso\n";
        break;
    default:
        echo "Comando não reconhecido. Use '-help' para ter um resumo dos comandos.\n";
        break;
}
