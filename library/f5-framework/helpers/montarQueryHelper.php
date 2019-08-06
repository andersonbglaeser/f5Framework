<?php

/**
 * montarQueryHelper [ TIPO ]
 * Descrição da classe
 * @copyright (c) year, Anderson B. Glaeser - F5 Digital
 */
class montarQueryHelper {
    function montar($string, $registro) {
	
		$exp = explode('-', $string);
		$query = '';
		for($i=0;$i<count($exp);$i++){
			$query .= $registro." LIKE '%".$exp[$i]."%' AND ";
		}
		
		return substr($query, 0, -5);
    }

}