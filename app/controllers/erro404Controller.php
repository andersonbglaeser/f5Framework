<?php

/**
 * <b>Index Controller</b>
 * Esta classe realiza o tratamento dos parâmetros para exibição do erro 404 da aplicação.
 * @copyright (c) Junho, 2015, Anderson B. Glaeser - F5 Digital.
 */
class Erro404 extends F5_Controller{
    
    /**
     * Executa tudo que tem aqui antes de inicar QUALQUER action deste controller. O uso deste método é opcional, pois já está sobreescrevendo o método init() de controller do F5 Framework.
     */
    public function init() {
        //Execuções antes de inicar uma action.
    }
    
    /**
     * Action index do controller.
     */
    public function index_action(){
        $data = $this->getParams();
        $this->view('404', $data);
    }
}
