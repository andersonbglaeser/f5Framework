<?php

/**
 * <b>F5 Model</b>
 * Esta classe realiza a conexão com o banco de dados e realiza todos os CRUD`s do F5 Framework.
 * @copyright (c) Junho, 2015, Anderson B. Glaeser - F5 Digital
 */
class F5_Model {
    /** @var responsável pela integração com o banco de dados. */
    protected $db;
    /** @var responsável pela integração com o banco de dados. */
    public $_table;
    
    public function __construct() {
        $this->db = new PDO(TIPO_BD.':host='.HOST_BD.';dbname='.NOME_BD, USUARIO_BD, SENHA_BD);
        $this->db->exec("set names utf8");
    }
    
    //START CRUD
    public function insert(Array $data){
        $fields = implode('`, `', array_keys($data));
        $values = "'".implode("', '", array_values($data))."'";
		
		// echo "INSERT INTO `{$this->_table}` (`{$fields}`, `data_cadastro`) VALUES ({$values}, NOW())";
		// exit;
		
        $query = $this->db->query("INSERT INTO `{$this->_table}` (`{$fields}`, `data_cadastro`) VALUES ({$values}, NOW())");
        
		$id = $this->db->lastInsertId();
		
        return $id;
    }
    public function read($fields = null, $where = null, $limit = null, $offset = null, $orderby = null, $joins = null, $groupby = null){
        $fields = ($fields != null ? "{$fields}" : "*");
        $where = ($where != null ? "WHERE {$where}" : "");
        $limite = ($limit != null ? "LIMIT {$limit}" : "");
		$offset = ($offset != null ? "OFFSET {$offset}" : "");
		$orderby = ($orderby != null ? "ORDER BY {$orderby}" : "");
        $joins = ($joins != null ? "{$joins}" : "");
        $groupby = ($groupby != null ? "GROUP BY {$groupby}" : "");
		
		// echo "SELECT {$fields} FROM {$this->_table} {$joins} {$where} {$groupby} {$orderby} {$limite} {$offset}";
		// exit;
		
        $query = $this->db->query("SELECT {$fields} FROM {$this->_table} {$joins} {$where} {$groupby} {$orderby} {$limite} {$offset}");
        $query->setFetchMode(PDO::FETCH_ASSOC);
        
        return $query->fetchAll();
    }
    public function update(Array $data, $where = null){
        foreach ($data as $idx => $vals){
            $fields[] = "`{$idx}` = '{$vals}'";
        }
        $fields = implode(', ', $fields);
        
        $where = ($where != null ? "WHERE {$where}" : "");

		// echo "UPDATE `{$this->_table}` SET {$fields} {$where}";
		// exit;
		
        $query = $this->db->query("UPDATE `{$this->_table}` SET {$fields} {$where}");

        return $query;
    }
    public function delete($where = null){
        $where = ($where != null ? "WHERE {$where}" : "");

        $query = $this->db->query("DELETE FROM `{$this->_table}` {$where}");
        return $query;
    }
    //END CRUD
}
