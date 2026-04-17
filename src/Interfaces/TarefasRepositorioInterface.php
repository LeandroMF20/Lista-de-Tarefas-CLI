<?php

namespace App\Interfaces;

/**
 * Interface para repositórios de tarefas.
 *
 * Definição dos requisitos mínimos de uso do repositório
 * selecionado, para ser usado pelo gerenciador de tarefas.
 *
 * @author Leandro Marques Ferreira
 */
interface TarefasRepositorioInterface
{
    /**
     * Salva a lista de tarefas no repositório.
     *
     * Recebe um array padrão com todas as tarefas a serem salvas, esse array deve
     * vir da conversão dos objetos de tarefa para array associativo.
     *
     * @param array $list Lista de tarefas em formato de array associativo
     * @return void
     */
    public function save(array $list): void;

    /**
     * Carrega a lista de tarefas do repositório.
     *
     * Retorna um array associativo padrão com todas as tarefas salvas
     * no repositório selecionado.
     *
     * @return array Lista de tarefas em formato de array associativo
     */
    public function load(): array;
}
