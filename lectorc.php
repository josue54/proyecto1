
<?php
//$conexion = mysqli_connect("localhost", "admin", "12345","example");
$consulta="insert into students (nombre,apellido,correo,telefono,cedula) values";
$valores=" ";
$usoconsulta=FALSE;
$stringconsulta=$consulta;
$aux2;
$aux3;
$aux4;
$aux5;
$aux6;


date_default_timezone_set("America/Costa_Rica");
$file=date("dmY");

if (($gestor = fopen($file.".csv", "r")) !== FALSE) {
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
            $usoconsulta=true;

           // $resEmp = mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
              $consulta=$stringconsulta;
              $usoconsulta=FALSE;
              $valores=" ";
              break; 
}
         
    }
    fclose($gestor);
}
?>
