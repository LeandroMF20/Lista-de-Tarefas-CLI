<?php

namespace App\Models;

use App\Interfaces\TarefasRepositorioInterface;
use Exception;

/**
 * Repositório de tarefas baseado em arquivo JSON.
 *
 * Esta classe implementa a interface `tarefasRepositorioInterface` e
 * persiste a lista de tarefas em um arquivo no disco no formato JSON.
 * O gerenciador de tarefas usa este repositório para salvar e carregar
 * a lista de tarefas convertida para arrays associativos.
 *
 * Observações importantes:
 * - O construtor recebe o caminho do arquivo onde os dados serão
 *   armazenados/recuperados.
 * - O método `save` recebe um array (lista de tarefas já convertida
 *   para arrays associativos) e escreve o JSON no arquivo.
 * - O método `load` retorna um array correspondente ao conteúdo JSON
 *   do arquivo.
 */
class JsonRepositorio implements TarefasRepositorioInterface
{
    /**
     * @param string $caminho caminho absoluto ou relativo do arquivo JSON
     *                        onde a lista de tarefas será salva/carregada
     *
     * @throws Exception Quando o caminho do arquivo é inválido ou ele não existe
     */
    public function __construct(
        private string $caminho
    ) {
        // Obtém o diretório do arquivo
        $diretorio = dirname($caminho);

        // Cria o diretório caso ele não exista
        if (!is_dir($diretorio)) {
            if (!mkdir($diretorio, 0755, true)) {
                throw new \RuntimeException('Erro ao criar o diretório: ' . $diretorio);
            }
        }

        // Verifica se o arquivo passado existe.
        if (!file_exists($caminho)) {
            // Criando arquivo caso ele não exista no diretório informado
            if (file_put_contents($caminho, json_encode([])) === false) {
                throw new \RuntimeException('Erro ao criar arquivo JSON: ' . $caminho);
            }
        }
    }

    /**
     * Salva a lista de tarefas no arquivo JSON.
     *
     * Recebe um array de tarefas em formato de array associativo (cada
     * tarefa é um array com os campos necessários) e converte para JSON.
     * O JSON é escrito com `JSON_PRETTY_PRINT` para facilitar edição
     * manual do arquivo.
     *
     * @param array $list Lista de tarefas em formato de array associativo
     */
    public function save(array $list): void
    {
        // Monta o json que será salvo no arquivo
        $json = json_encode($list, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        // Dispara erro caso o json_encode falhar
        if ($json === false) {
            throw new \InvalidArgumentException('Erro ao salvar arquivo, json inválido');
        }

        // Tenta salvar o json no arquivo selecionado, disparando erro caso algo dê errado
        if (file_put_contents($this->caminho, $json) === false) {
            throw new \RuntimeException('Erro de escrita no caminho do json: '.$this->caminho);
        }
    }

    /**
     * Carrega a lista de tarefas do arquivo JSON.
     *
     * Retorna um array associativo com as tarefas salvas.
     *
     * @return array Lista de tarefas em formato de array associativo
     */
    public function load(): array
    {
        // Carrega o json do arquivo selecionado
        $json = file_get_contents($this->caminho);

        // Dispara erro caso o json não tenha sido carregado corretamente
        if ($json === false) {
            throw new \InvalidArgumentException('Erro ao carregar arquivo JSON: '.$this->caminho);
        }

        // Converte o json em array
        if (json_validate($json)) {
            $json = json_decode($json, true);
        } else {
            throw new \RuntimeException('JSON Inválido no arquivo carregado');
        }


        // Dispara erro caso o json seja inválido
        if ($json === null) {
            throw new \RuntimeException('Erro na conversão do JSON em array');
        }

        // Se tudo der certo retorna o json
        return $json;
    }
}
