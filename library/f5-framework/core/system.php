<?php

/**
 * <b>F5 System</b>
 * Esta classe realiza o tratamento da url pelo F5 Framework, a tornando amigável e possibilitando navegar entre controllers, actions e métodos.
 * @copyright (c) Junho, 2015, Anderson B. Glaeser - F5 Digital
 */
class F5_System {
    
    /** @var string da URL do navegador. */
    private $_url;
    /** @var array com os dados da URL dividida pelas barras. */
    private $_explode;
    /** @var string com parte da URL que corresponde ao controller. */
    public $_controller;
    /** @var string com parte da URL que corresponde ao action. */
    public $_action;
    /** @var array com parte da URL que corresponde aos parâmetros. */
    public $_params;
    /** @var object com o redirectorHelper. */
    public $_redirector;
    
    //Método público que constrói a classe, iniciando os valores.
    public function __construct(){
        $this->_redirector = new redirectorHelper();
        $this->setUrl();
        $this->setExplode();
        $this->setController();
        $this->setAction();
        $this->setParams();
    }
    
    /**
     * Método privado que alimenta a variável com a URL.
     */
    private function setUrl(){
        $_GET['url'] = (isset($_GET[url]) ? $_GET[url] : 'index/index_action');
        $this->_url = $_GET[url];
    }
    
    /**
     * Método privado que quebra a URL pelas barras.
     */
    private function setExplode(){
        $this->_explode = explode("/", $this->_url);
    }
    
    /**
     * Método privado que identifica parte da URL que corresponde ao controller.
     */
    private function setController(){
		$file1 = explode('-',mb_strtolower($this->_explode[0]));
		if(count($file1) == 1){
			$file = $this->_explode[0];
		}else{
			$file = "";
			for($i=0;$i<count($file1);$i++){
				if($i != 0){
					$file .= ucfirst($file1[$i]);
				}else{
					$file .= $file1[$i];
				}		
			}
		}
        $this->_controller = $file;
    }
    
    /**
     * Método privado que identifica parte da URL que corresponde a action.
     */
    private function setAction(){
        $ac = (!isset($this->_explode[1]) || $this->_explode[1] == null || $this->_explode[1] == "index" ? "index_action" : $this->_explode[1]);
        
        //Aqui um replace para que sempre que tiver hífen na URL mudar para underline (único separador permitido em métodos).
        $this->_action = str_replace("-","_", $ac);
    }
    
    /**
     * Método privado que cria um array com os parâmetros da URL.
     */
    private function setParams(){
        unset($this->_explode[0], $this->_explode[1]);
        $testeUltimoArray = end($this->_explode);
        
        if(empty($testeUltimoArray)){
            array_pop($this->_explode);
        }
        
        $i=0;
        
        if(!empty($this->_explode)){
            foreach ($this->_explode as $val){
                if($i % 2 == 0){
                    $ind[] = $val;
                }else{
                    $value[] = $val;
                }
                $i++;
            }
        }else{
            $ind = array();
            $value = array();
        }
        
        if(count($ind) == count($value) && !empty($ind) && !empty($value)){
            $this->_params = array_combine($ind, $value);
        }else{
            $this->_params = array();
        }
    }
    
    /**
     * Método público para retornar os parâmetros da URL que não compreendem nem controllers nem actions.
     * @param string $name = se preencher, irá exibir apenas o registro associado a ele. Senão exibirá todos.
     * @return array = dados da URL que serão retornados como parâmetros.
     */
    public function getParams($name = null){
        if($name != null){
            if(array_key_exists($name, $this->_params)){
               return $this->_params[$name]; 
            }else{
                return false;
            }
        }else{
            return $this->_params;
        }
    }
    
    /**
     * Método público que para iniciar o framework, buscando o controller e a action.
     */
    public function run(){
        $controller_path = CONTROLLERS.$this->_controller."Controller.php";
        
        if(!file_exists($controller_path)){
            $this->_redirector->setUrlParameters("mensagem", "Houve um erro. O controller não existe")
                              ->goToController("erro404");
        }else{
            require_once $controller_path;
            $app = new $this->_controller;
            
                if(!method_exists($app, $this->_action)){
                    $this->_redirector->setUrlParameters("mensagem", "Houve um erro. A action não existe")
                                      ->goToController("erro404");
                }
            $action = $this->_action;
            $app->init();
            $app->$action();
        }
    }
}
