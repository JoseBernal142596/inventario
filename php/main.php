<?php

    try{

        // Conexión a la BBDD
        $pdo = new PDO(
            "mysql:host=localhost;dbname=inventario;charset-utf8mb4",
            "root",
            ""
        );
        function conexion(){
            


        };


        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql= "INSERT INTO categoria(categoria_nombre, categoria_ubicacion)
            VALUES(:nombre, :ubicacion)
        ";

        $sentencia = $pdo->prepare($sql);

        $sentencia->execute([
            ":nombre" => "prueba",
            ":ubicacion" => "texto ubicacion"

        ]);

        echo "<div> 
            Categoria creada correctamente.
        </div>";

    }catch(PDOException $error){
        echo "Error de base de datos: " .$error->getMessage();
    }
    
    
    /*$pdo= new PDO("mysql:localhost; dbname=inventario", "root","");
    $pdo->query("INSERT INTO categoria(categoria_nombre,categoria_ubicacion) VALUES ('prueba','texto ubicacion')");*/
?>