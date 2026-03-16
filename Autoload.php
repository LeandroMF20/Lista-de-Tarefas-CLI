<?php
/**
 * Autoload padrão do programa.
 *
 * Este autoload foi adicionado ao invés do autoload do composer, por se tratar
 * de um pequeno projeto para aprendizado.
 */
spl_autoload_register(function (string $classe) {
    // Prefixo padrão do projeto
    $prefixo = 'App\\';

    // Base do caminho físico do projeto
    $caminhoBase = __DIR__.'/src/';

    // Verifica se o inicio do nome da classe contém o prefixo padrão
    if (strpos($classe, $prefixo) === 0) {
        // Converte namespace no caminho absoluto para a classe
        $caminho = str_replace($prefixo, $caminhoBase, $classe).'.php';

        // Normaliza o caminho, colocando o separador padrão do sistema operacional
        $caminho = str_replace('\\', DIRECTORY_SEPARATOR, $caminho);

        // Verifica se o arquivo existe e o inclui
        if (file_exists($caminho)) {
            // Realiza a inclusão do arquivo
            require_once $caminho;
        }
    }
});
