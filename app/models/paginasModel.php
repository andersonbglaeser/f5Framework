<?php

/**
 * PaginasModel
 * Tratamento de dados.
 * @copyright (c) Julho, 2015, Anderson B. Glaeser - F5 Digital.
 */
class PaginasModel extends F5_Model{
    public $_table = ""; //Tabela no banco de dados
    public $idName = ""; //Chave primária da tabela
	
    public function visualizarDados($pagina = null){
			$dados = $this->read();

			return $dados[0];
    }
}
