<?php
//$conexion = mysqli_connect("localhost", "admin", "12345","example");
$aux=$argv[1];//!isset($argv[1]){die"print"}
$primeravez=true;
$consulta="insert into students (nombre,apellido,correo,telefono,cedula) values";
$valores=" ";
$usoconsulta=FALSE;
$stringconsulta=$consulta;
$columnas;


if (($gestor = fopen($aux, "r")) !== FALSE) {
    while (($datos = fgetcsv($gestor, 1000, ";")) !== FALSE) {
        $numero = count($datos);

         for ($c=0; $c < $numero; $c++) {
            $stringconsulta=$consulta;
            $columnas=$datos[$c];
            $valores="(".$columnas.")";
            $consulta.=" ".$valores;
            echo $consulta;
            $usoconsulta=true;
            //$resEmp = mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
            
             if($usoconsulta==true){
                $consulta=$stringconsulta;
                $usoconsulta=FALSE;
                $valores=" ";
             } 
          }
         
    }
    fclose($gestor);
}
?>
