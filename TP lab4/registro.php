<?php

	require_once("clases/AccesoDatos.php");
	require_once("clases/Personas.php");

	
	$usuario = $_POST["user"];
	$password = $_POST["pass"];
	$password2 = $_POST["pass2"];
	if(!empty($usuario) && !empty($password) && !empty($password2))
	{
		$retorno = "ok";
		$persona = new Persona();
		$persona->SetUsuario($usuario);
		$persona->SetPassword($password);
		Persona::InsertarPersona($persona);
		var_dump($persona);
	}else
		{
			$retorno= "NoEsta";
		}

	echo $retorno;
?>