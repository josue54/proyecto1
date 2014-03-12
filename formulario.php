 <?php 


if(isset($_POST["submit"])) // metodo post el cual efectua una accion en caso de darse el submit
{ 
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];
    $cedula = $_POST["cedula"]; 
    
    if(empty($nombre)||empty($apellido)||empty($correo)||empty($telefono)||empty($cedula)) // validaciones
    { 
        echo "ERROR MESSAGE"; 
        die; 
    } 
date_default_timezone_set("America/Costa_Rica");// se declara la zona horaria
$file=date("dmY");
$cvsData = "\"$nombre\",\"$apellido\",\"$correo\",\"$telefono\",\"$cedula\"".PHP_EOL; 
$fp = fopen($file.".csv", "a"); 
     
    if($fp) // en caso de encontrarse el archivo
    { 
        fwrite($fp,$cvsData); // escribe en el
        fclose($fp); // lo cierra
    } 
     
     
} 
header('refresh:5;url=index.html');
?>