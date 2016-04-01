<?php
require_once"accesoDatos.php";
class Persona
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	private $id;
	private $usuario;
 	private $password;
  	

//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--GETTERS Y SETTERS
  	public function GetId()
	{
		return $this->id;
	}
	
	public function GetUsuario()
	{
		return $this->usuario;
	}
	
	public function GetPassword()
	{
		return $this->password;
	}

	public function SetId($valor)
	{
		$this->id = $valor;
	}
	
	public function SetPassword($valor)
	{
		$this->password = $valor;
	}
	public function SetUsuario($valor)
	{
		$this->usuario = $valor;
	}
	
//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	public function __construct($usuario=NULL)
	{
		if($usuario != NULL){
			$obj = Persona::TraerUnaPersona($usuario);
			
			$this->usuario = $obj->usuario;
			$this->password = $obj->password;
		}
	}

//--------------------------------------------------------------------------------//
//--TOSTRING	
  	public function ToString()
	{
	  	return $this->usuario;
	}
//--------------------------------------------------------------------------------//
	public static function TraerUnaPersona2($username) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id, username as usuario, password as password from user where username like '$username'");

			$consulta->execute();
			$personaBuscada= $consulta->fetchObject('Persona');
			return $personaBuscada;				

			
	}
//--------------------------------------------------------------------------------//
//--METODO DE CLASE
	public static function TraerUnaPersona($idParametro) 
	{	


		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		//$consulta =$objetoAccesoDato->RetornarConsulta("select * from persona where id =:id");
		$consulta =$objetoAccesoDato->RetornarConsulta("CALL TraerUnaPersona(:id)");
		$consulta->bindValue(':id', $idParametro, PDO::PARAM_INT);
		$consulta->execute();
		$personaBuscada= $consulta->fetchObject('persona');
		return $personaBuscada;	
					
	}
	
	public static function TraerTodasLasPersonas()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		//$consulta =$objetoAccesoDato->RetornarConsulta("select * from persona");
		$consulta =$objetoAccesoDato->RetornarConsulta("CALL TraerTodasLasPersonas() ");
		$consulta->execute();			
		$arrPersonas= $consulta->fetchAll(PDO::FETCH_CLASS, "persona");	
		return $arrPersonas;
	}
	
	public static function BorrarPersona($idParametro)
	{	
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		//$consulta =$objetoAccesoDato->RetornarConsulta("delete from persona	WHERE id=:id");	
		$consulta =$objetoAccesoDato->RetornarConsulta("CALL BorrarPersona(:id)");	
		$consulta->bindValue(':id',$idParametro, PDO::PARAM_INT);		
		$consulta->execute();
		return $consulta->rowCount();
		
	}
	
	public static function ModificarPersona($persona)
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			/*$consulta =$objetoAccesoDato->RetornarConsulta("
				update persona 
				set nombre=:nombre,
				apellido=:apellido,
				foto=:foto
				WHERE id=:id");
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();*/ 
			$consulta =$objetoAccesoDato->RetornarConsulta("CALL ModificarPersona(:id,:usuario,:password)");
			$consulta->bindValue(':id',$persona->id, PDO::PARAM_INT);
			$consulta->bindValue(':usuario',$persona->usuario, PDO::PARAM_STR);
			$consulta->bindValue(':password', $persona->password, PDO::PARAM_STR);
			return $consulta->execute();
	}

//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//

	public static function InsertarPersona($persona)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		//$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into persona (nombre,apellido,dni,foto)values(:nombre,:apellido,:dni,:foto)");
		$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into user(username,password) values(:usuario,:password)");
		$consulta->bindValue(':usuario',$persona->usuario, PDO::PARAM_STR);
		$consulta->bindValue(':password', $persona->password, PDO::PARAM_STR);
	
		$consulta->execute();		
		return $objetoAccesoDato->RetornarUltimoIdInsertado();
	
				
	}	
//--------------------------------------------------------------------------------//

}
