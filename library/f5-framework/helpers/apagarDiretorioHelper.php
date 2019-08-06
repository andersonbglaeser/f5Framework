<?php

/**
 * apagaDiretorioHelper
 * Apaga um diretório e todos os seus arquivos
 * @copyright (c) Junho, 2015, Anderson B. Glaeser - F5 Digital
 */
class apagarDiretorioHelper {
    function apagar($dir) {
        if (is_dir($dir)) {
            if ($handle = opendir($dir)) {
                while (false !== ($file = readdir($handle))) {
                    if (($file == ".") or ( $file == "..")) {
                        continue;
                    }
                    if (is_dir($dir . $file)) {
                        apagar($dir . $file . "/");
                    } else {
                        unlink($dir . $file);
                    }
                }
            } else {
                print("nao foi possivel abrir o arquivo.");
                return false;
            }

            // fecha a pasta aberta
            closedir($handle);

            // apaga a pasta, que agora esta vazia
            rmdir($dir);
        } else {
            print("diretorio informado invalido");
            return false;
        }
    }
}
