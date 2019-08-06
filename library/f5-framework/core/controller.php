<?php

/**
 * <b>F5 Controller</b>
 * Esta classe realiza recebe os parâmetros da URL e apresenta na VIEW do F5 Framework.
 * @copyright (c) Junho, 2015, Anderson B. Glaeser - F5 Digital
 */
class F5_Controller extends F5_System {
    
    /**
     * 
     * @param string $name especifíca qual view será chamada.
     * @param array $vars variáveis que são enviadas para a view. Sempre da seguinte forma: $f5_nomedavariavel.
     */
    protected function view($name, $vars = null){
        if(is_array($vars) && count($vars) > 0){
            extract($vars, EXTR_PREFIX_ALL, "f5");
        }
        require_once VIEWS.$name.'.phtml';
        exit;
    }
    
    /**
     * Método para especificar parâmetros a serem executados antes de todas as actions do F5 Framework.
     */
    public function init() {
        
    }
}
