<?php
/**
 * <b>Index da aplicação</b>
 * Este arquivo inicia a aplicação. Definindo as constantes e iniciando o F5 Framework.
 * @copyright (c) Junho, 2015, Anderson B. Glaeser - F5 Digital
 */

//Permite o uso de sessões.
ini_set("session.cache_expire", "86400");
ini_set("session.gc_maxlifetime", "86400");
ini_set("session.cache_limiter", "86400");
ini_set("session.cookie_lifetime", "86400");
session_start();

//Chama o F5 Framework
require_once 'library/f5-framework/core/config.inc.php';
require_once 'library/f5-framework/core/system.php';
require_once 'library/f5-framework/core/controller.php';
require_once 'library/f5-framework/core/model.php';

/**
 * <b>__autoload</b>
 * Este método é responsável por carregar as classes chamadas no "new" somente quando requisitadas. Evitando realizar um require() para cada classe chamada. Basta chamar o new e a classe será chamada.
 * @param string $file
 */
function __autoload($file){
    $file = lcfirst($file);
	
    if(file_exists(MODELS.$file.'.php')){
        require_once MODELS.$file.'.php';
    }else if(file_exists(HELPERS.$file.'.php')){
        require_once HELPERS.$file.'.php';
    }else if(file_exists(CONTROLLERS.$file.'Controller.php')){
        require_once CONTROLLERS.$file.'Controller.php';
    }else{
		echo $file;
        die("Model ou helper não encontrado.");
    }
}

$start = new F5_System;
$start->run();

?>