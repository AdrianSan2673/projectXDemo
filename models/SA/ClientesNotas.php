<?php

class ClientesNotas{

    private $ID;
    private $Comentarios;
    private $ID_Cliente;
    private $ID_Cliente_Reclu;
    private $Fecha;
    private $Usuario;

    public function __construct() {
        $this->db = Connection::connect();
    }

    public function getID(){
		return $this->ID;
	}

	public function setID($ID){
		$this->ID = $ID;
	}

	public function getComentarios(){
		return $this->Comentarios;
	}

	public function setComentarios($Comentarios){
		$this->Comentarios = $Comentarios;
	}

	public function getID_Cliente(){
		return $this->ID_Cliente;
	}

	public function setID_Cliente($ID_Cliente){
		$this->ID_Cliente = $ID_Cliente;
	}

	public function getID_Cliente_Reclu(){
		return $this->ID_Cliente_Reclu;
	}

	public function setID_Cliente_Reclu($ID_Cliente_Reclu){
		$this->ID_Cliente_Reclu = $ID_Cliente_Reclu;
	}

	public function getFecha(){
		return $this->Fecha;
	}

	public function setFecha($Fecha){
		$this->Fecha = $Fecha;
	}

	public function getUsuario(){
		return $this->Usuario;
	}

	public function setUsuario($Usuario){
		$this->Usuario = $Usuario;
	}

    public function getNotasPorCliente(){
        $ID_Cliente = $this->getID_Cliente();
        
        $stmt = $this->db->prepare("SELECT Comentarios, Usuario, CONVERT(DATE, Fecha) AS Fechaa, u.first_name, u.last_name, u.id AS id_user FROM Clientes_Notas n INNER JOIN users u ON n.Usuario=u.username WHERE ID_Cliente=:ID_Cliente ORDER BY Fecha DESC");
        $stmt->bindParam(":ID_Cliente", $ID_Cliente, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }
    
    public function getNotasPorClienteReclu(){
        $ID_Cliente_Reclu = $this->getID_Cliente_Reclu();

        $stmt = $this->db->prepare("SELECT Comentarios, Usuario, CONVERT(DATE, Fecha) AS Fechaa, u.first_name, u.last_name, u.id AS id_user FROM Clientes_Notas n INNER JOIN users u ON n.Usuario=u.username WHERE ID_Cliente_Reclu=:ID_Cliente_Reclu ORDER BY Fecha DESC");
        $stmt->bindParam(":ID_Cliente_Reclu", $ID_Cliente_Reclu, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }

    public function create(){
		$result = false;

		$Comentarios = $this->getComentarios();
        $ID_Cliente = $this->getID_Cliente();
        $ID_Cliente_Reclu = $this->getID_Cliente_Reclu();
        $Usuario = $this->getUsuario();
		
        $stmt = $this->db->prepare("INSERT INTO Clientes_Notas (Comentarios, ID_Cliente, ID_Cliente_Reclu, Fecha, Usuario) VALUES (:Comentarios, :ID_Cliente, :ID_Cliente_Reclu, GETDATE(), :Usuario)");
		$stmt->bindParam(":Comentarios", $Comentarios, PDO::PARAM_STR);
        $stmt->bindParam(":ID_Cliente", $ID_Cliente, PDO::PARAM_INT);
        $stmt->bindParam(":ID_Cliente_Reclu", $ID_Cliente_Reclu, PDO::PARAM_INT);
        $stmt->bindParam(":Usuario", $Usuario, PDO::PARAM_STR);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
			$this->setID($this->db->lastInsertId());
        }
        return $result;
    }
}