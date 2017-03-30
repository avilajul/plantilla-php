<?php 
# Importar modelo de abstracción de base de datos
require_once('database.php');
class Usuario
{
	############################### PROPIEDADES ################################
	private $pdo;
	public $id;
	public $nombre;
	public $apellido;
	public $email;
	public $contrasena;

	############################### PROPIEDADES ################################
	# Contructor de  la Clase Usuario
	public function __construct()
	{

		$this->pdo = new BaseDatos();
	}
	
	################################# MÉTODOS ##################################
	# Listar todos los usuarios
	public function listar()
	{
		try
		{			
			$sql = "SELECT * FROM usuarios";
			$query = $this->pdo->ejecutar_consulta_simple($sql);

			$query->execute();
			cerrar_conexion();
			
			return $query->fetchAll(PDO::FETCH_OBJ);
		}
		catch(PDOException $e)
		{
			echo "Error al traer datos de un usuario: ".$e->getMessage(); 
		}
	}

	# Traer datos de un usuario
	public function obtener($id_usuario) 
	{
		try
		{
			$sql = "SELECT * FROM usuarios WHERE id = :id_usuario";
			$query = $this->pdo->ejecutar_consulta_simple($sql);
			$query->bindParam(':id:_usuario', $id_usuario);

			$query->execute();
			cerrar_conexion();
			return $query->fetch(PDO::FETCH_OBJ);
		}
		catch(PDOException $e)
		{
			echo "Error al traer datos de un usuario: ".$e->getMessage(); 
		}
	}

	# Crear un nuevo usuario
	public function registrar($campo1, $campo2, $campo3, $campo4) 
	{
		try
		{
			$sql = "INSERT INTO usuarios (campo1, campo2, campo3, campo4)VALUES(:campo1, :campo2, :campo3, campo4)";
			$query = $this->pdo->ejecutar_consulta_simple($sql);
			$query->bindParam(':campo1', $campo1);
			$query->bindParam(':campo2', $campo2);
			$query->bindParam(':campo3', $campo3);
			$query->bindParam(':campo4', $campo4);

			$query->execute();
			cerrar_conexion();			
		}
		catch(PDOException $e)
		{
			echo "Error al crear un nuevo usuario: ".$e->getMessage(); 
		}	
	}

	# Modificar un usuario
	public function editar($campo1, $campo2, $campo3, $id_usuario) 
	{
		try
		{ 
			$sql = "UPDATE * FROM usuarios SET  campo1 = :valor1, campo2 = :valor2, campo3 = :valor3, WHERE id = :id_usuario";
			$query = $this->pdo->ejecutar_consulta_simple($sql);
			$query->bindParam(':valor1', $campo1);
			$query->bindParam(':valor2', $campo2);
			$query->bindParam(':valor3', $campo3);
			$query->bindParam(':id_usuario', $id_usuario);
			
			$query->execute();  
			cerrar_conexion();
		}
		catch(PDOException $e)
		{
			echo "Error al editar el usuario: ".$e->getMessage(); 
		}
	}

	# Eliminar un usuario
	public function eliminar($id_usuario)
	{
		try
		{
			$sql = "DELETE * FROM usuarios WHERE id = :id_usuario";
			$query = $this->pdo->ejecutar_consulta_simple($sql);
			$query->bindParam(':id', $id_usuario);
			$query->execute();
			cerrar_conexion();

			return true;		
		}
		catch(PDOException $e)
		{
			echo "Error al borrar el usuario: ".$e->getMessage(); 
		}
	}
}
?>