<?php
//$conexion = mysqli_connect("localhost", "admin", "12345","example");
$aux=$argv[1];//!isset($argv[1]){die"print"}
$primeravez=true;
$columnames=array();
$consulta="insert into people";
$values="values";
$valores=" ";
$usoconsulta=FALSE;
$stringconsulta="";
$aux2;
$aux3;

if (($gestor = fopen($aux, "r")) !== FALSE) {
    while (($datos = fgetcsv($gestor, 1000, ";")) !== FALSE) {
        $numero = count($datos);

        if($primeravez==true){
        $columnames=$datos;
        $primeravez=FALSE;
        $consulta=$consulta." "."(".$datos[0].",".$datos[1].")";
        $consulta.=" ".$values;
        $stringconsulta=$consulta;
        continue;
        }
 
         for ($c=0; $c < $numero-1; $c++) {
            $aux2=$datos[$c];
            $aux3=$datos[$c+1];
            $valores="(".$aux2.",".$aux3.")";
            $consulta.=" ".$valores;
            echo $consulta;
            $usoconsulta=true;
           // $resEmp = mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
            
         if($usoconsulta==true){
        $consulta=$stringconsulta;
        $usoconsulta=FALSE;
        } 
}
         
    }
    fclose($gestor);
}
?>
