<?php

date_default_timezone_set('America/Sao_Paulo');

//Diretórios da aplicação, se for na raiz do servidor, utilizar apenas uma "/"
define("DIRETORIO_BASE", "http://www.seusite.com.br");
define("DIRETORIO_INICIAL", "/");

//Informações do banco de dados
define("TIPO_BD", "mysql");
define("HOST_BD", "localhost");
define("NOME_BD", "DATABASE");
define("USUARIO_BD", "USERNAME");
define("SENHA_BD", "PASSWORD");

//MVC da aplicação
define("CONTROLLERS", "app/controllers/");
define("VIEWS", "app/views/");
define("MODELS", "app/models/");

//Caminho para arquivos do template
define("HELPERS", "library/f5-framework/helpers/");
define("CSS", DIRETORIO_INICIAL."web-files/css/");
define("JS", DIRETORIO_INICIAL."web-files/js/");
define("PLUGINS", DIRETORIO_INICIAL."web-files/plugins/");
define("IMG", DIRETORIO_INICIAL."web-files/img/");
define("UPLOADS", DIRETORIO_INICIAL."web-files/uploads/");