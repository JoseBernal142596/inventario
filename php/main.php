<?php
        function conexion(){
                try{
                    // Conexión a la BBDD
                    $pdo = new PDO(
                        "mysql:host=localhost;dbname=inventario;charset-utf8mb4",
                        "root",
                        ""
                    );
                   // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        /*$sql= "INSERT INTO categoria(categoria_nombre, categoria_ubicacion)
                            VALUES(:nombre, :ubicacion)
                        ";

                        $sentencia = $pdo->prepare($sql);

                        $sentencia->execute([
                            ":nombre" => "prueba",
                            ":ubicacion" => "texto ubicacion"

                        ]);

                        echo "<div> 
                            Categoria creada correctamente.
                        </div>";*/

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
?>