<?php
namespace app\models;

use Yii;
use yii\base\Model;

class AppModel extends Model
{    
    
    /**
     * Este metodo traduce codigo html a un caracter valido, convierte a minusculas, y pone la primera letra de la palabra en mayuscula
     * @param type $cadena, indica la cadena que se desea analizar y sanitizar
     * @return type  String, Devuelve la cadena normalizada
     */
    public static function sanitizarCadena($cadena){        
         return strtr(ucfirst(strtolower(html_entity_decode(trim($cadena)))),"ÁÉÍÓÚÑ","áéíóúñ");                
    }
    
    
    /**
     * 
     * @param String $cadena, indica la cedena de texto que se desea encriptar
     * @return String $cadena, Devuelve la cadena encriptada
     */
    public static function encriptarCadena($cadena=""){
        for ($i = 0; $i < 251; $i++) {
            $cadena = md5(md5($cadena . 'wX3b') . md5($i . 'fI7Ge3u') . '0dk3nY8fr' . sha1($cadena . '93mSn67dfE'));
        }
        return $cadena;   
    }
        
	
    /**
     * Metodo que permite ejecutar un comando y devolver la salida
     * @param String $comando, Comando a ejecutar
     * @param String $entrada, Parametros del comando
     * @return String, Devuelve el resultado de la ejecucion del comando
     * @throws Exception
     */
    public static function ejecutarComando($cmd, $input = ''){
        $proc = proc_open(
                $cmd,
                array(
                    array('pipe', 'r'),
                    array('pipe', 'w'),
                    array('pipe', 'w'),
                ),
                $pipes
        );
        if (is_resource($proc)) {
            $result = array();

            fwrite($pipes[0], $input);
            fclose($pipes[0]);

            $result['stdout'] = stream_get_contents($pipes[1]);
            fclose($pipes[1]);

            $result['stderr'] = stream_get_contents($pipes[2]);
            fclose($pipes[2]);

            $result['return'] = proc_close($proc);

            return $result;
        } else {
            throw new Exception('No se puede ejecutar el comando: ' . $cmd);
        }
    }           
	
   
}
