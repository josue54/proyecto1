<?php
file_get_contents("c://parametros.json");
$json = file_get_contents("c://parametros.json");
$data = json_decode($json, true);
echo $data["parametros"]["ip"];
echo $data["parametros"]["usuario"];
?>