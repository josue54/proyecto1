<?php
require('class.phpmailer.php');//importa la clase php mailer
require('class.smtp.php');//importo el servidor para autenticar


file_get_contents("c://xampp/htdocs/proyecto1/parametros.json");//busco el archivo json de parametros
$json = file_get_contents("c://xampp/htdocs/proyecto1/parametros.json");//busco el archivo json de parametros
$data = json_decode($json, true);//decodifica el json a datos entendibles port php

//tomo todos los parametros del archivo .json
$ip=$data["parametros"]["ip"];
$usuario=$data["parametros"]["usuario"];
$clave=$data["parametros"]["clave"];
$bd=$data["parametros"]["bd"];
$destinatario=$data["parametros"]["destinatario"];
$remitente=$data["parametros"]["remitente"];
$titulo=$fecha=date("dmY");
$usuariocorreo=$data["parametros"]["usuariocorreo"];
$clavecorreo=$data["parametros"]["clavecorreo"];


$conexion = mysqli_connect($ip,$usuario,$clave,$bd);//conecto a la base con los parametros
$consulta="insert into students (nombre,apellido,correo,telefono,cedula) values";//armo la consulta
$valores=" ";//declaro los valores que insertara la consulta
$stringconsulta=$consulta;//hago una string de respaldo de la consulta
$aux2;//las auxiliares son los valores que se tomaran del csv para insertar en la base
$aux3;
$aux4;
$aux5;
$aux6;
$contador=0;
$mensaje="registros insertados =";// se crea un mensaje para enciar al correo

date_default_timezone_set("America/Costa_Rica");// declaro la zona horaria
$file=date("dmY");//se crea el nombre que ira en el csv
$archivo="c://xampp/htdocs/proyecto1/";// se declara una string con la ruta donde estara el csv
$archivo=$archivo.$file.".csv";// se le concatena el formato


// se recorre el array del csv y se procesa insertandolo en la base de datos
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
            $contador++;
            $resEmp = mysqli_query($conexion,$consulta) or die(mysqli_error($conexion));
              $consulta=$stringconsulta;
              $valores=" ";
              break; 
}
         
    }
    fclose($gestor);//se cierra el puntero
}
echo "datos insertados";
$mensaje.=" ".$contador;



$mail = new PHPMailer();

$body = $mensaje;

$mail->IsSMTP(); 

// la dirección del servidor, p. ej.: smtp.servidor.com
$mail->Host = "www.gmail.com";

// dirección remitente, p. ej.: no-responder@miempresa.com
$mail->From = $destinatario;

// nombre remitente, p. ej.: "Servicio de envío automático"
$mail->FromName = $remitente;

// asunto y cuerpo alternativo del mensaje
$mail->Subject = "datos insertados en la base de datos"." ". $fecha;
$mail->AltBody = " "; 

// si el cuerpo del mensaje es HTML
$mail->MsgHTML($body);

// podemos hacer varios AddAdress
$mail->AddAddress($destinatario,$destinatario);

// si el SMTP necesita autenticación
$mail->SMTPAuth = true;
$mail->Mailer = 'smtp';  $mail->Host = 'ssl://smtp.gmail.com';   $mail->Port = 465;
// credenciales usuario
$mail->Username =$usuariocorreo;
$mail->Password = $clavecorreo; 

if(!$mail->Send()) {
echo "Error enviando: " . $mail->ErrorInfo;
} else {
echo "Enviado!!";
}


?>
