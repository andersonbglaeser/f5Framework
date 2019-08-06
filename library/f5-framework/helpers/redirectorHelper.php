<?php

/**
 * redirectorHelper
 * Helper para gerar redirecionamentos. Uma alternativa para o uso de models, que devem ser utilizadas para integrações com o banco de dados, com esta espécie de plugin é possível realizar redirecionamentos facilmente.
 * @copyright (c) Junho, 2015, Anderson B. Glaeser - F5 Digital
 */
class redirectorHelper {
    /**
     *
     * @var array com parâmetros definidores para identificar o que é indexador e o que é valor. 
     */
    protected $parameters = array();
    
    /**
     * 
     * @param string $data realiza o redirecionamento estruturando a URL e definindo se é da área administrativa ou de um site.
     */
    protected function go($data) {
        if(preg_match("/f5admin/i", $_SERVER[REQUEST_URI])){
            echo "<script>location.href='".DIRETORIO_ADMIN.$data."';</script>";
        }else if(preg_match("/site/i", $_SERVER[REQUEST_URI])){
            echo "<script>location.href='".DIRETORIO_SITE.$data."';</script>";
        }else{
            echo "<script>location.href='".DIRETORIO_INICIAL.$data."';</script>";
        }
    }
    
    /**
     * 
     * @return string Obtem os parâmetros do array para gerar URL.
     */
    public function getUrlParameters() {
        $parms = "";
        foreach ($this->parameters as $name => $value){
            $parms .= $name."/".$value."/";
        }
        return $parms;
    }
    
    /**
     * 
     * @param string $name
     * @param string $value
     * @return \redirectorHelper
     * 
     * Define os parâmetros que serão gerados para a URL.
     */
    public function setUrlParameters($name, $value) {
        $this->parameters[$name] = $value;
        return $this;
    }
    
    /**
     * 
     * @param string $controller
     * 
     * Redireciona para a index do controller desejado.
     */
    public function goToController($controller) {
        $this->go($controller."/index/".$this->getUrlParameters());
    }
    
    /**
     * 
     * @param string $action
     * 
     * Redireciona para a action do controller atual.
     */
    public function goToAction($action) {
        $this->go($this->getCurrentController()."/".$action."/".$this->getUrlParameters());
    }
    
    /**
     * 
     * @param string $controller
     * @param string $action
     * 
     * Redireciona para o controller e para a action desejada.
     */
    public function goToControllerAction($controller, $action) {
        $this->go($controller."/".$action."/".$this->getUrlParameters());
    }
    
    /**
     * Redireciona para a index da aplicação atual.
     */
    public function goToIndex() {
        $this->go("index");
    }
    
    /**
     * 
     * @param string $url
     * 
     * Redireciona para qualquer URL, interna ou externa, precisa ser passado o caminho completo. Ex: http://www.f5digital.com.br
     */
    public function goToUrl($url) {
        echo "<script>location.href='".$url."';</script>";
    }
    
    /**
     * 
     * @global object $start
     * @return string
     * 
     * Obtem o controller atual, através do arquivo system do F5 Framework.
     */
    public function getCurrentController(){
        global $start;
        return $start->_controller;
    }
    
    /**
     * 
     * @global object $start
     * @return string
     * 
     * Obtem a action atual, através do arquivo system do F5 Framework.
     */
    public function getCurrentAction(){
        global $start;
        return $start->_action;
    }
}
