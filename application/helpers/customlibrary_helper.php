<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/* * **************************************
 * 	FUNCIONES DE CONTROL DE SESIONES	*
 * ************************************** */
 
date_default_timezone_set('America/Mexico_City');

if (!function_exists('is_logged')) {
	function is_logged() {
		$CI = &get_instance();
		$CI -> load -> model('auth_model');
		if ((!$CI -> auth_model -> isThatMySession())) {
			if (!$CI -> auth_model -> isThatMyCookie()) {
				return false;
			}
		}
		return true;
	}

}

if (!function_exists('is_authorized')) {
	function is_authorized($nivelesReq, $idPermiso, $nivelUsuario, $rolUsuario) {
		//Función que verifica si un usuario está autorizado para visitar una sección
		//$nivelesReq = array con los niveles requeridos para acceder a la sección
		//idPermiso = el id del permiso para acceder a la sección
		//nivelUsuario = el nivel que tiene el usuario
		//rolUsuario = El rol que tiene el usuario
		// si idPermiso y rolUsuario son nulos, el usuario accede con tan sólo cumplir el nivel	
		// si el usuario es nivel 0, accede porque accede
		$CI = &get_instance();
		$CI -> load -> model('rol_model');
		if ($nivelUsuario == 0)
			return true;
		for ($i = 0; $i < count($nivelesReq); $i++) {
			if ($nivelesReq[$i] == $nivelUsuario) {
				if ($idPermiso != null && $rolUsuario != null) {
					if ($CI -> rol_model -> rol_tiene_permiso($idPermiso, $rolUsuario))
						return true;
				} else {
					return true;
				}
			}
		}
		return false;
	}

}

if (!function_exists('noobDate')) {
	/*
	 *
	 * ESTA FUNCION RECIBE COM PARAMETROS LA FECHA EN FORMATO SQL (AAAA-MM-DD) Y EL TIPO DE FECHA QUE DESEAMOS NOS REGRESE (ALL / D-M / M-A)
	 * ALL:
	 *    LA OPCION 'ALL' NOS REGRESA LA FECHA COMPLETA EN EL FORMATO 'DIA' DE 'MES' DEL 'AÑO' (25 DE DICIEMBRE DEL 2012)
	 *
	 * D-M:
	 *    ESTA OPCION NOS REGRESA 'DIA' DE 'MES' (25 DE DICIEMBRE)
	 * M-A:
	 *    SI UTILIZAMOS ESTA OPCION OBTENDREMOS 'MES' DEL 'AÑO' (DICIEMBRE DE 2012)
	 * 
	 */

    function noobDate($date,$type){
        $le_anio     = '';
        $le_mes      = '';
        $le_noobDate = '';
        $exp_date    = explode('-',$date);
        $le_anio     = $exp_date[0];
        $le_intMes   = $exp_date[1];
        $le_dia      = end($exp_date); 
        
        switch($le_intMes):
            case '01':
                $le_mes = 'Enero';                                
                break;
            case '02':
                $le_mes = 'Febrero';                                
                break;
            case '03':
                $le_mes = 'Marzo';                                
                break;
            case '04':
                $le_mes = 'Abril';                                
                break;
            case '05':
                $le_mes = 'Mayo';                                
                break;
            case '06':
                $le_mes = 'Junio';                                
                break;
            case '07':
                $le_mes = 'Julio';                                
                break;
            case '08':
                $le_mes = 'Agosto';                                
                break;
            case '09':
                $le_mes = 'Septiembre';                                
                break;
            case '10':
                $le_mes = 'Octubre';                                
                break;
            case '11':
                $le_mes = 'Noviembre';                                
                break;
            case '12':
                $le_mes = 'Diciembre';                                
                break;
            default:
                $le_mes = '*';
                break;
        endswitch;
        
        switch ($type):
            case 'ALL':
                $le_noobDate = $le_dia . 'de ' . $le_mes . 'de' . $le_anio;                
                break;
            case 'D-M':
                $le_noobDate = $le_dia . 'de ' . $le_mes;                
                break;
            case 'M-A':
                $le_noobDate = $le_mes . ' ' . $le_anio;                
                break;            
            default:
                $le_noobDate = $date;                
                break;
        endswitch;
        
        return $le_noobDate;
    } 
}

if(!function_exists('setMyToken')){    
	function setMyToken($form){	    
		$token = md5(uniqid(mt_rand(), true));
		$data = array(
			'token' => $token,
			'token_time' => date('Y-m-d H:i:s')
		);
		$CI = &get_instance();
	 	$CI->session->set_userdata($form.'_token', $data);
		
		return true;
	}
}


if(!function_exists('isThatMyToken')){
	function isThatMyToken($form, $token, $time = 0){
		$CI = &get_instance();
		$sess_token = $CI->session->userdata($form.'_token');		
		if($sess_token['token']=='')
			return false;
		if($sess_token['token']!=$token)
			return false;
		if($time>0){
			$token_age = time() - $this->session->userdata($form.'_token');
			if($token_age>=$time)
				return false;
		}
		return true;
	}
}


if(!function_exists('uploadThis')){
	function uploadThis(){
		$CI = &get_instance();
		$CI->load->model('upload_model');
		
	}
}


/*Varios*/

if (!function_exists('getNumberMonth')) {
    function getNumberMonth($stringMonth) {
        $numericMonth = '';
        $stringMonth = strtolower($stringMonth);
        switch ($stringMonth) {            
            case 'enero':
                $numericMonth = '01';               
                break;
                
            case 'febrero':
                $numericMonth = '02';               
                break;
                
            case 'marzo':
                $numericMonth = '03';               
                break;
                
            case 'abril':
                $numericMonth = '04';               
                break;
                
            case 'mayo':
                $numericMonth = '05';               
                break;
                
            case 'junio':
                $numericMonth = '06';               
                break;
                
            case 'julio':
                $numericMonth = '07';               
                break;
                
            case 'agosto':
                $numericMonth = '08';               
                break;
                
            case 'septiembre':
                $numericMonth = '09';               
                break;
                
            case 'octubre':
                $numericMonth = '10';               
                break;
                
            case 'noviembre':
                $numericMonth = '11';               
                break;
                
            case 'diciembre':
                $numericMonth = '12';               
                break;
            
            default:
                $numericMonth = '00';                
                break;
        }
        return $numericMonth;
    }
}


/* * **************************************
 * 	FUNCIONES DE FORMATO				*
 * ************************************** */

if(!function_exists('camelToString')){
	
	//Convierte notación camella a String
	function camelToString($word, $arrToInsert = null){
		$CI =& get_instance();
		$CI->load->model('diccionario_model');
		// repeat:
		$leRow = $CI->diccionario_model->searchAndFind($word);
		if($leRow!=null){
			$row = $leRow->row();
			return $row->fancyName;
		}
		else{
			$arrToDB = array();
			foreach($arrToInsert as $key=>$value){
				$arrToDB['word'] = $key;
				$arrToDB['fancyName'] = $value;
			}
			$CI->diccionario_model->goToCreate($arrToDB);
			/*->*/camelToString($word, $arrToInsert = null);
			// goto repeat;
		}
	}
}

if (!function_exists('cutstr')) {

	// function acorta strings, 2 parametros: string, longitud menor deseada
	function cutstr($strtocut, $long) {
		$strtocut = trim($strtocut);
		if (strlen($strtocut) > $long) {
			$strtocut = substr($strtocut, 0, $long - 3);
			$strtocut = $strtocut . "...";
		}
		return $strtocut;
	}

}

if (!function_exists('monTOint')) {

	// funcion de Moneda a Integer
	function monTOint($cdn) {
		$cdn = trim($cdn);
		$cdn = str_replace("$", "", $cdn);
		$cdn = str_replace(",", "", $cdn);
		$cdn = intval($cdn);
		return $cdn;
	}

}

if (!function_exists('intTOmon')) {

	// funcion de integer a moneda
	function intTOmon($cdn) {
		$cdn = trim($cdn);
		$CadLen = strlen($cdn);
		$Newcdn = "";
		if ($CadLen == 0) {
			$cdn = 0;
		}
		if ($CadLen > 3) {
			$cdnDp = "G" . $cdn;
			$mmc = 0;
			for ($i = $CadLen; $i >= 1; $i--) {
				$Newcdn = $cdnDp{$i} . $Newcdn;
				$mmc++;
				if (($mmc == 3) && ($i > 1)) {
					$mmc = 0;
					$Newcdn = "," . $Newcdn;
				}
			}
			$cdn = $Newcdn;
		}
		$cdn = "$" . $cdn . ".00";
		return $cdn;
	}

}

if (!function_exists('guioner')) {

	// funcion agrega todos espacios
	function guioner($url) {
		//        $cdn = trim($cdn);
		//        $cdn = str_replace(" ", "-", $cdn);
		//        return $cdn;
		if ($url != null) {
			$url = strtolower($url);
			$buscar = array(' ', '&', '+');
			$url = str_replace($buscar, '-', $url);
			$buscar = array('á', 'é', 'í', 'ó', 'ú', 'ñ');
			$remplzr = array('a', 'e', 'i', 'o', 'u', 'n');
			$url = str_replace($buscar, $remplzr, $url);
			$buscar = array('/[^a-z0-9-<>]/', '/[-]+/', '/<[^>]*>/');
			$remplzr = array('', '-', '');
			$url = preg_replace($buscar, $remplzr, $url);
			return $url;
		}
	}

}

if (!function_exists('desguioner')) {

	// funcion quita todos guiones
	function desguioner($cdn) {
		if ($cdn != null) {
			$cdn = trim($cdn);
			$cdn = str_replace("-", " ", $cdn);
			return $cdn;
		}
	}

}

if (!function_exists('cambiar_url')) {

	function cambiar_url($url) {
		$url = strtolower($url);
		$buscar = array(' ', '&', '+');
		$url = str_replace($buscar, '-', $url);
		$buscar = array('á', 'é', 'í', 'ó', 'ú', 'ñ');
		$remplzr = array('a', 'e', 'i', 'o', 'u', 'n');
		$url = str_replace($buscar, $remplzr, $url);
		$buscar = array('/[^a-z0-9-<>]/', '/[-]+/', '/<[^>]*>/');
		$remplzr = array('', '-', '');
		$url = preg_replace($buscar, $remplzr, $url);
		return $url;
	}

}

if (!function_exists('cleanStringUrl')) {

	//Limpia una cadena y la prepara para URL
	function cleanStringUrl($cadena) {
		$cadena = strtolower($cadena);
		$cadena = trim($cadena);
		$cadena = strtr($cadena, "���̀����������ͅ���������菎�������쓒����󆝜��؄�", "aaaaaaaaaaaaooooooooooooeeeeeeeecciiiiiiiiuuuuuuuuynn");
		$cadena = strtr($cadena, "ABCDEFGHIJKLMNOPQRSTUVWXYZ", "abcdefghijklmnopqrstuvwxyz");
		$cadena = preg_replace('#([^.a-z0-9]+)#i', '-', $cadena);
		$cadena = preg_replace('#-{2,}#', '-', $cadena);
		$cadena = preg_replace('#-$#', '', $cadena);
		$cadena = preg_replace('#^-#', '', $cadena);
		return $cadena;
	}

}

/* * **************************************
 * 	FUNCIONES PARA APIS/SERVICIOS		*
 * ************************************** */

if (!function_exists('gTranslate')) {

	// Funcion que traduce a un idioma en especial
	function gTranslate($text, $langOriginal, $langFinal) {
		//Si los idiomas son iguales no hago nada
		if ($langOriginal != $langFinal) {
			/* Definimos la URL de la API de Google Translate y metemos en la variable el texto a traducir */
			$url = 'http://ajax.googleapis.com/ajax/services/language/translate?v=1.0&q=' . urlencode($text) . '&langpair=' . $langOriginal . '|' . $langFinal;
			// iniciamos y configuramos curl_init();
			$curl_handle = curl_init();
			curl_setopt($curl_handle, CURLOPT_URL, $url);
			curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
			curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
			$code = curl_exec($curl_handle);
			curl_close($curl_handle);
			/* La api nos devuelve los resultados en forma de objeto stdClass */
			$json =    json_decode($code) -> responseData;
			$traduccion = utf8_decode($json -> translatedText);
			return utf8_decode($traduccion);
		} else {
			return $text;
		}
	}

}

if (!function_exists('getTinyUrl')) {

	// Funcion que obtiene TinyURL
	function getTinyUrl($bigURL) {
		// Se crea un manejador CURL
		$ch = curl_init();
		// Se establece la URL y algunas opciones
		$urlVieja = "http://tinyurl.com/api-create.php?url=" . $bigURL;
		curl_setopt($ch, CURLOPT_URL, $urlVieja);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// Se obtiene la URL indicada
		$result = curl_exec($ch);
		$resultArray = curl_getinfo($ch);
		//Si hay error manda un correo al administrador
		if ($resultArray['http_code'] == 200) {
			return $result;
		} else {
			return $bigURL;
		}
		// Se cierra el recurso CURL y se liberan los recursos del sistema
		curl_close($ch);
	}

}



