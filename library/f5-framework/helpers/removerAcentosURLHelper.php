<?php

/**
 * removerAcentosURLHelper [ TIPO ]
 * Descrição da classe
 * @copyright (c), Junho 2015, Anderson B. Glaeser - F5 Digital
 */
class removerAcentosURLHelper {
    function tratar($string, $slug = null, $tipo = null) {
		if($slug === null){
			$slug = '-';
		}
	
		if($tipo === null){
			// String é qualquer coisa e tudo precisa ser tratado
			$nomeSemExt = utf8_decode($string);
		}else{
			// String é um nome de arquivo e precisamos cuidar da extensão
			$string = utf8_decode($string);
			$extensao = end(explode(".", $string));

			$t = explode('.', $string);
			$c = count($t) - 1;
			for ($i = 0; $i < $c; $i++)
				$d .= $t[$i];
			$nomeSemExt = $d;

		}
        $string = strtolower($nomeSemExt);

// Código ASCII das vogais
        $ascii['a'] = range(224, 230);
        $ascii['e'] = range(232, 235);
        $ascii['i'] = range(236, 239);
        $ascii['o'] = array_merge(range(242, 246), array(240, 248));
        $ascii['u'] = range(249, 252);

        // Código ASCII dos outros caracteres
        $ascii['b'] = array(223);
        $ascii['c'] = array(231);
        $ascii['d'] = array(208);
        $ascii['n'] = array(241);
        $ascii['y'] = array(253, 255);

        foreach ($ascii as $key => $item) {
            $acentos = '';
            foreach ($item AS $codigo)
                $acentos .= chr($codigo);
            $troca[$key] = '/[' . $acentos . ']/i';
        }

        $string = preg_replace(array_values($troca), array_keys($troca), $string);

        // Slug?
        if ($slug) {
            // Troca tudo que não for letra ou número por um caractere ($slug)
            $string = preg_replace('/[^a-z0-9]/i', $slug, $string);
            // Tira os caracteres ($slug) repetidos
            $string = preg_replace('/' . $slug . '{2,}/i', $slug, $string);
            $string = trim($string, $slug);
        }
		
		if($tipo === null){
			$nomeCorreto = $string;
		}else{
			$nomeCorreto = $string . "." . utf8_encode($extensao);
		}
        
        return $nomeCorreto;
    }

}