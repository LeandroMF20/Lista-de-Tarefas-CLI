<?php

namespace App\Classes;


use App\Interfaces\TarefasRepositorioInterface;
use App\Models\Tarefa;

/**
 * Processamento da lista de tarefas.
 *
 * Está classe tem por objetivo reunir o processamento de tarefas através
 * de seus objetos, listando elas, adicionando novas tarefas a lista, editando,
 * concluíndo e excluindo tarefas.
 *
 * @author Leandro Marques Ferreira
 */
class GerenciadorDeTarefas
{
    /**
     * Array que armazena todas as tarefas a serem gerenciadas.
     *
     * @var tarefa[] Lista de objetos da classe de tarefas
     */
    private array $tarefas = [];

    /**
     * Construtor da classe GerenciadorDeTarefas.
     *
     * @param TarefasRepositorioInterface $repositorio Objeto responsável pela manipulação
     *                                                 do arquivo onde os dados estão salvos
     */
    public function __construct(
        private TarefasRepositorioInterface $repositorio,
    ) {
        // Carrega e converte a lista de tarefa para uma lista de objetos
        $this->tarefas = array_map(
            fn ($tarefa) => Tarefa::arrayParaTarefa($tarefa),
            $this->repositorio->load()
        );
    }

    /**
     * Método para retorno da lista de tarefas do gerenciador.
     *
     * @return array Lista de objetos de tarefas
     */
    public function listaDeTarefas(): array
    {
        return $this->tarefas;
    }

    /**
     * Adição de um novo objeto "Tarefa" na lista de tarefas.
     *
     * @param string $titulo    Título da tarefa
     * @param string $descricao Descrição da tarefa
     */
    public function adicionarTarefa(string $titulo, string $descricao): bool
    {
        $this->tarefas[] = new Tarefa($titulo, $descricao);
        return true;
    }

    /**
     * Conclui uma tarefa da lista de objetos.
     *
     * Usa o id da lista de objetos (que são definidos no carregamento da lista)
     * para concluir a tarefa selecionada
     *
     * @param int $id Idenficidador do objeto tarefa na lista de tarefas
     */
    public function concluirTarefa(int $id): void
    {
        $this->tarefas[$id]->concluir();
    }

    /**
     * Remove uma tarefa da lista de objetos.
     *
     * Usa o id da lista de objetos (que são definidos no carregamento da lista)
     * para apagar a tarefa selecionada
     */
    public function removerTarefa(int $id): void
    {
        unset($this->tarefas[$id]);
    }

    /**
     * Salvamento da lista de tarefas no repositório selecionado.
     *
     * @return bool Retorno true para indicar salvamento bem sucedido
     */
    public function salvar(): bool
    {
        // Convertendo objetos em arrays
        foreach ($this->tarefas as $tarefa) {
            $saida[] = $tarefa->converterParaArray();
        }
        // Salvando lista de tarefas atualizada
        $this->repositorio->save($saida);

        return true;
    }
}
