<?php

namespace App\Models;

/**
 * Representação do objeto "tarefa" do sistema
 * 
 * Esta classe encapsula as propriedades e métodos de uma tarefa, definindo
 * regras que ditam como é uma tarefa e padronizando seus comportamentos.
 * 
 * @author Leandro Marques Ferreira
 */
class Tarefa {    

    /**
     * Construtor da classe Tarefa
     * 
     * @param string $titulo Título da tarefa
     * @param string $descricao Descrição detalhada da tarefa
     * @param bool $concluido Status de conclusão da tarefa (padrão: false)
     */
    public function __construct(
        private string $titulo,
        private string $descricao,
        private bool $concluido = false,
    )
    {}

    /**
     * Obtém o título da tarefa
     * 
     * @return string Título da tarefa
     */
    public function retornaTitulo() : string {
        return $this->titulo;
    }

    /**
     * Obtém a descrição da tarefa
     * 
     * @return string Descrição da tarefa
     */
    public function retornaDescricao() : string {
        return $this->descricao;
    }

    /**
     * Retorna o status de conclusão da tarefa
     * 
     * @return bool True se a tarefa está concluída, false caso contrário
     */
    public function retornaConcluido() : bool {
        return $this->concluido;
    }

    /**
     * Marca a tarefa como concluída
     * 
     * @return void
     */
    public function concluir() : void {
        $this->concluido = true;
    }

    /**
     * Converte o objeto Tarefa em um array associativo
     * 
     * Útil para serialização (por exemplo, ao salvar em JSON)
     * 
     * @return array Array contendo os dados da tarefa
     */
    public function converterParaArray() : array{
        return [
            'Título' => $this->titulo,
            'Descrição' => $this->descricao,
            'Concluído' => $this->concluido
        ];
    }

    /**
     * Cria um objeto Tarefa a partir de um array associativo
     * 
     * Método estático que define como uma tarefa deve ser convertida em um objeto "tarefa"
     * 
     * @param array $tarefa Array contendo as chaves: 'Título', 'Descrição', 'Concluído'
     * @return Tarefa Novo objeto Tarefa com os dados fornecidos
     */
    public static function arrayParaTarefa(array $tarefa): Tarefa {
        return new Tarefa($tarefa['Título'], $tarefa['Descrição'], $tarefa['Concluído']);
    }
}