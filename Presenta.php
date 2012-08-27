<style type="text/css"> 
    
    /**********************************
   * 
   *   Presintación CSS3, no util IE.
   *
    **********************************/
.press {
    width: 805px; 
    height: 320px;
    overflow: hidden;
    background: rgba(0, 0, 0, 0.35);
    border:0;
    margin: 100px auto;
}

.press ul {
    width: 2000px; 
}

.press li {
    position: relative;
    display: block;
    width: 120px;
    float: left;

    border-left: 1px solid #888;

    box-shadow: 0 0 20px 5px rgba(255, 255, 255, 0.5);
    -webkit-box-shadow: 0 0 15px 10px rgba(255, 255, 255, 0.5);
    -moz-box-shadow: 0 0 15px 10px rgba(255, 255, 255, 0.5);

    /*Transicion de la imagen*/
    transition: all 0.5s;
    -webkit-transition: all 0.5s;
    -moz-transition: all 0.5s;
    
}


.press ul:hover li {
    width: 40px;
    cursor: pointer;
}

.press ul li:hover {
    width: 540px;
}


.press li img {
    display: block;
}

.image_title {
    background: rgba(0, 0, 0, 0.5);
    position: absolute;
    left: 0; 
    bottom: 0;	
    width: 540px;
    height: auto;

}
.image_title a {
    display: block;
    color: #fff;
    text-decoration: none;
    padding: 20px;
    font-size: 16px;
}
#cas {
    position: absolute;
    z-index: 5;
    margin: auto 0 auto 0;
    background: rgba(0, 0, 0, 0.9);
    width: auto;
    height:  auto;
    
}
#movis {
    position: absolute;
    z-index: 6;
    top: 100px;
    right: 0;
    width: 40px;
    color: #fff;
    background: rgba(0, 0, 0, 0.5);
    font-size: 19px;
    text-align: center;
    padding-top: 149px;
    padding-bottom: 150px;
    cursor: pointer;
}
#movis:hover {
    position: absolute;
    z-index: 6;
    top: 100px;
    right: 0;
    width: 40px;
    color: #fff;
    background: rgba(255, 255, 255, 0.5);
    font-size: 19px;
    padding-top: 149px; 
    padding-bottom: 150px;
    cursor: pointer;
}
#movia {
    position: absolute;
    z-index: 5;
    top: 100px;
    left: 0;
    width: 40px;
    color: #fff;
    background: rgba(0, 0, 0, 0.5);
    font-size: 19px;
    text-align: center;
    padding-top: 149px; 
    padding-bottom: 150px;
    cursor: pointer;
}
#movia:hover {
    position: absolute;
    z-index: 6;
    top: 100px;
    right: 0;
    width: 40px;
    color: #fff;
    background: rgba(255, 255, 255, 0.5);
    font-size: 19px;
    padding-top: 149px; 
    padding-bottom: 150px;
    cursor: pointer;
}

/**********Fin Presentación******************/
</style>
		
<?php

     
    /**********************************************************************
    *  listado pequeño de fotografias
    *********************************************************************/    
    $path="../img/fotogra";//carpeta deode se encuentra las imágenes
    $mostrar=Array(".JPG",".jpg");//selecciona el formate a enseñar
    $dir_handle = @opendir($path) or die("No se pudo abrir $path");//si no encuentra el direcctorio

            while ( $file = readdir($dir_handle)) { //leemos el directorio
                  $pos=strrpos($file,"."); //buscalos archivos con "."
                  $extension=substr($file,$pos); //los elimina
                           if (in_array($extension, $mostrar)) { //muestra solamente los jpg.
                               
                                $arch[$file] = filemtime($path."/".$file);//les obtiene la fecha de la ultima modificación
                                arsort ($arch);
                           }
                        }

                closedir($dir_handle);
                
                /***************************
                 * Paginacion de la carpeta
                 ***************************/
                       
                        $currentpage = $_SERVER['PHP_SELF'];//la pagina en la que te encuentras
                        $total=(count($arch)-1);
                        $n_archi_mostrar=4; //numero de archivos a mostrar
                        $pag_inicio=0; //pagina de inicio

                        if (isset($_GET[pag])){ //si existe
                            $pag_inicio = intval($_GET['pag']);
                        }

                        $startRow = $pag_inicio*$n_archi_mostrar;

                        if (isset($_GET[pag])){
                            $pag_inicio = intval($_GET['pag']);
                        }

                        $startRow = $pag_inicio*$n_archi_mostrar;
                        $total=ceil($total / $n_archi_mostrar);
                        $archivos= array_slice($arch,$startRow,$n_archi_mostrar);

                
                
                
     echo "<div id=\"cas\">";  
           if ($pag_inicio > 0) {  
    
    echo "<a id=\"movia\" href=\"".$currentpage."?pag=";
    echo htmlentities($_GET['pag']-1);
    echo "\" title=\"Anterior\">&laquo;</a>  ";
    
        }else{
        
        echo "<span  id=\"movia\">&laquo;</span>   ";
        }


echo"<div class=\"press\"><ul>";
  
 foreach ($archivos as $archivo => $timestamp) { 
    
            echo "<li>\n
                         <div class=\"image_title\">
                             <a href=\"#\">";echo date("d-F-Y", $timestamp);
            echo"</a>
                     </div>
                      <a href=\"fotografia.php?nombre='$path$archivo#lp\" title=\"$archivo\">                                                                                                           
                <img src=\"$path/thumbs/640x480-$archivo\"  width=\"540\" height=\"290\">\n
                                                    </a>\n";                                                                                                       
             echo " </li>\n";
                                                                                                                                                  
                                          
                             }
                                        
echo "</ul></div>";

if ($pag_inicio < $total) {
           
       echo "<a id=\"movis\" href=\"".$currentpage."?pag=";
       echo htmlentities($_GET['pag']+1);
       echo "\" title=\"Siguiente\">&raquo;</a>  ";
       
       }else{
          
          echo "<span  id=\"movsi\">&rsaquo;&rsaquo;</span>  ";
       }
                


echo "</div>";
     
?>
