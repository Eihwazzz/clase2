<?php
session_start();
	require_once("clases/AccesoDatos.php");
	require_once("clases/Personas.php");

	
	$usuario = $_POST["user"];
	$password = $_POST["pass"];
	if(!empty($usuario) && !empty($password))
	{
		$retorno;
		$persona = Persona::TraerUnaPersona2($usuario);
		var_dump($persona);
	if($usuario==$persona->GetUsuario() && $password==$persona->GetPassword())
	{			
		setcookie("registro",$usuario,  time()+36000 , '/');
		$_SESSION['registrado']=$usuario;
		$retorno="Ingreso";	
	}else
		{
			$retorno= "NoEsta";
		}

	echo $retorno;
	}


?>