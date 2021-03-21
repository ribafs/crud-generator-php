<?php

class Utils {

    /**
     * copyDir
     * Copiar uma pasta com todos os arquivos e subpastas recursivamente. Caso a pasta de destino não exista será criada
     * usage: copyDir('dir1', 'dir2')
     * @param string $src
     * @param string $dst
     * @return void
     * @credit https://stackoverflow.com/questions/2050859/copy-entire-contents-of-a-directory-to-another-using-php#2050909
    */
    public function copyDir($src,$dst) { 
        $dir = opendir($src); 
        mkdir($dst); 
        while(false !== ( $file = readdir($dir)) ) { 
            if (( $file != '.' ) && ( $file != '..' )) { 
                if ( is_dir($src . '/' . $file) ) { 
                    recurse_copy($src . '/' . $file,$dst . '/' . $file); 
                } 
                else { 
                    copy($src . '/' . $file,$dst . '/' . $file); 
                } 
            } 
        } 
        closedir($dir); 
    } 

}
