<?php
file_get_contents("c://proyecto1/parametros.json");
$json = file_get_contents("c://proyecto1/parametros.json");
$data = json_decode($json, true);

$ip=$data["parametros"]["ip"];
$usuario=$data["parametros"]["usuario"];
$clave=$data["parametros"]["clave"];
$bd=$data["parametros"]["bd"];
var_dump($ip);

$conexion = mysqli_connect($ip,$usuario,$clave,$bd);
$consulta="insert into students (nombre,apellido,correo,telefono,cedula) values";
$valores=" ";
$stringconsulta=$consulta;
$aux2;
$aux3;
$aux4;
$aux5;
$aux6;

date_default_timezone_set("America/Costa_Rica");
$file=date("dmY");
$archivo="c://proyecto1/";
$archivo=$archivo.$file.".csv";
var_dump($archivo);


if (($gestor = fopen($archivo, "r")) !== FALSE) {
    while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
        $numero = count($datos);
         
         for ($c=0; $c < $numero-1; $c++) {

            $stringconsulta=$consulta;
            $aux2=$datos[$c];
            $aux3=$datos[$c+1];
            $aux4=$datos[$c+2];
            $aux5=$datos[$c+3];
            $aux6=$datos[$c+4];
            $valores="(\"$aux2\",\"$aux3\",\"$aux4\",\"$aux5\",\"$aux6\")";
            $consulta.=" ".$valores;
            echo $consulta;

            $resEmp = mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
            echo "datos insertados";
              $consulta=$stringconsulta;
              $valores=" ";
              break; 
}
         
    }
    fclose($gestor);
}
?>
