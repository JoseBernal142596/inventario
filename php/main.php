<?php
        function conexion(){
                try{
                    // Conexión a la BBDD
                    $pdo = new PDO(
                        "mysql:host=localhost;dbname=inventario;charset-utf8mb4",
                        "root",
                        ""
                    );

            }catch(PDOException $error){
                echo "Error de base de datos: " .$error->getMessage();
            }

        };

    # verificar conexión BBDD#

    function verificar_datos($filtro, $cadena){
        if(preg_match("/^".$filtro."$/", $cadena)){
            return false;    
        }else{
            return true;
        }
    }
        
    #limpuar cadenas de texto#

    function limpiar_cadena($cadena){
        $cadena=trim($cadena);
        $cadena=stripslashes($cadena);
        //Codigo para evitar inyección SQL y scripts
        $cadena=str_ireplace("<script>","",$cadena);
        $cadena=str_ireplace("</script>","",$cadena);
        $cadena=str_ireplace("<script src","",$cadena);
        $cadena=str_ireplace("<script type=","",$cadena);
        $cadena=str_ireplace("SELECT * FROM","",$cadena);
        $cadena=str_ireplace("DELETE FROM","",$cadena);
        $cadena=str_ireplace("INSERT INTO","",$cadena);
        $cadena=str_ireplace("DROP TABLE","",$cadena);
        $cadena=str_ireplace("DROP DATABASE","",$cadena);
        $cadena=str_ireplace("TRUNCATE TABLE","",$cadena);
        $cadena=str_ireplace("SHOW TABLES","",$cadena);
        $cadena=str_ireplace("SHOW DATABASES","",$cadena);
        $cadena=str_ireplace("<?php","",$cadena);
        $cadena=str_ireplace("?>","",$cadena);
        $cadena=str_ireplace("--","",$cadena);
        $cadena=str_ireplace("^","",$cadena);
        $cadena=str_ireplace("<","",$cadena);
        $cadena=str_ireplace("[","",$cadena);
        $cadena=str_ireplace("]","",$cadena);
        $cadena=str_ireplace("==","",$cadena);
        $cadena=str_ireplace(";","",$cadena);
        $cadena=str_ireplace("::","",$cadena);
        $cadena=trim($cadena); #eliminar espacios
        $cadena=stripslashes($cadena);  #eliminar caracteres
        return $cadena;
    }

    #FUNCION RENOMBRAR FOTOS#

    function renombrar_fotos($nombre){
        //Remplazamos el espacio en el nombre de la gfoto por guiones bajos
        $nombre=str_replace(" ","_", $nombre);
        $nombre=str_replace("/","_", $nombre);
        $nombre=str_replace("#","_", $nombre);
        $nombre=str_replace("-","_", $nombre);
        $nombre=str_replace("$","_", $nombre);
        $nombre=str_replace(".","_", $nombre);
        $nombre=str_replace(",","_", $nombre);
        $nombre=$nombre."_".rand(0,100);
        return $nombre;
    }
    /*$pdo= new PDO("mysql:localhost; dbname=inventario", "root","");
    $pdo->query("INSERT INTO categoria(categoria_nombre,categoria_ubicacion) VALUES ('prueba','texto ubicacion')");*/


    #Funcion paginador de tablas
    function paginador_tablas($pagina, $NPaginas, $url, $botones){

        $tabla='<nav class="pagination is-centered is-rounded" role="navigation" aria-label="pagination">';


        if($pagina<=1){
            $tabla.='<a href="#" class="pagination-previous is-disabled">Anterior</a>
                    <ul class="pagination-list"
            ';
        }else{
            $tabla.='<a href="'.$url($pagina-1).'" class="pagination-previous">Anterior</a>';
            $tabla.='<ul class="pagination-list">   
                    <li><a href="'.$url.'1" class="pagination-link">1</a></li>
                    <li><span class="pagination-ellipsis">&hellip;</span></li>
                    ';
        }


       $contadorInteracciones=0;

            for($i=$pagina;$i<=$NPaginas;$i++){
                if($contadorInteracciones>=$botones){
                    break;
                }

                if($pagina==$i){
                    $tabla.= '<li><a href="'.$url.$i.'" class="pagination-link is-current">'.$i.'/a></li>';
                }else{
                    $tabla.= '<li><a href="'.$url.$i.'" class="pagination-link">'.$i.'/a></li>';
                }
                $contadorInteracciones++;   
            }

        
        
        
        if($pagina==$NPaginas){
            $tabla.='</ul>';
            $tabla.='<a class="pagination-next is-disabled" disabled>Siguiente</a>';
        }else{
            $tabla.='
                <li><span class="pagination-ellipsis">&hellip;</span></li>
                <li><a href="'.$url.$NPaginas.'">'.$NPaginas.'class="pagination-link">1</a></li>
            </ul>
            <a href="'.$url($pagina+1).'" class="pagination-next">Siguiente</a>
            ';
            $tabla.='</ul>';
        }   

        $tabla.='</nav>';
        return $tabla;

    }
?>