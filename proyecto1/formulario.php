<form name="form" method="post" action="<?=$_SERVER['PHP_SELF'];?>">
      Nombre: <input type="text" name="nombre" /> <br />
      Apellido: <input type="text" name="apellido" /> <br />
      Correo: <input type="text" name="correo" /> <br />
      Telefono: <input type="text" name="telefono" /> <br /> 
      Cedula: <input type="text" name="cedula" /> <br />  
      <input type="submit" name="submit" />
    </form>

    <?php 


if(isset($_POST["submit"])) 
{ 
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];
    $cedula = $_POST["cedula"]; 
    
    if(empty($nombre)||empty($apellido)||empty($correo)||empty($telefono)||empty($cedula)) 
    { 
        echo "ERROR MESSAGE"; 
        die; 
    } 
    date_default_timezone_set("America/Costa_Rica");
$file=date("dmY");
    $cvsData ='"Nombre","Apellido","Correo","Telefono","Cedula"'.PHP_EOL; 
    $cvsData .= "\"$nombre\",\"$apellido\",\"$correo\",\"$telefono\",\"$cedula\"".PHP_EOL; 
    $fp = fopen($file.".csv", "a"); 
     
    if($fp) 
    { 
        fwrite($fp,$cvsData); // Write information to the file 
        fclose($fp); // Close the file 
    } 
     
     
} 
?>