<?php

session_start();

$login = $_POST["login"];
$senha = $_POST["senha"];

$serv = "DESKTOP-OE398R0\SQLEXPRESS";

$arq = fopen('pw.txt','r');
while(!feof($arq))
{
    $id = fgets($arq,1);
    $pass = fgets($arq,2);
}

$db   = "gesfin";

$conInfo = array("Database"=>"$db","UID"=>"$pass","PWD"=>"$pass");

$conn = sqlsrv_connect($serv,$conInfo);

if($conn == false)
{
    echo" Erro ao conctar com o Banco de Dados: \n";
    die(print_r(sqlsrv_errors(),true));
}

$sql = "SELECT * FROM T000USU WHERE NOMUSU = '$login' AND PASUSU = hashbytes('md5','$senha')";

$conslogin = sqlsrv_query($conn,$sql,array(),array("Scrollable" => SQLSRV_CURSOR_KEYSET));

if($conslogin == true)
{
    $_SESSION['valid_user'] = true;
    $_SESSION['iduser'] = $login;
    header('Location: http://127.0.0.1:5501/GesFin/dashboard/index.html');
    die();
}
else
{

    echo "Consulta não retornou dados!";
    /*header('Location: index.html');
    die();*/
}




?>