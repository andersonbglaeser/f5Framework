<?php

/**
 * <b>Index Controller</b>
 * Esta classe realiza o tratamento dos parâmetros para exibição na Index da aplicação.
 * @copyright (c) Agosto, 2017, Alessandra petry - F5 Digital.
 */
class Index extends F5_Controller{
    
    /**
     * Executa tudo que tem aqui antes de inicar QUALQUER action deste controller. O uso deste método é opcional, pois já está sobreescrevendo o método init() de controller do F5 Framework.
     */
    public function init() {
        $this->trataURL = new removerAcentosURLHelper();
        $this->redirector = new redirectorHelper();
    }
    
    /**
     * Action index do controller.
     */
    public function index_action(){
        $this->db = new PaginasModel();
        
        $this->view("home/index", $dados);
    }
}
