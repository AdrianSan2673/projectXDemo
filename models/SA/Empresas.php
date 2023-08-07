<?php

class Empresas{
 
    private $Empresa;
    private $Nombre_Empresa;
    private $Alias;
    private $Fecha_Entrega;
    private $Nuevo_Procedimiento;
     private $Especificaciones;
    private $db;
    
    public function __construct() {
        $this->db = Connection::connectSA();
    }

	public function getEmpresa(){
		return $this->Empresa;
	}

	public function setEmpresa($Empresa){
		$this->Empresa = $Empresa;
	}

	public function getNombre_Empresa(){
		return $this->Nombre_Empresa;
	}

	public function setNombre_Empresa($Nombre_Empresa){
		$this->Nombre_Empresa = $Nombre_Empresa;
	}

	public function getAlias(){
		return $this->Alias;
	}

	public function setAlias($Alias){
		$this->Alias = $Alias;
	}

	public function getFecha_Entrega(){
		return $this->Fecha_Entrega;
	}

	public function setFecha_Entrega($Fecha_Entrega){
		$this->Fecha_Entrega = $Fecha_Entrega;
	}

	public function getNuevo_Procedimiento(){
		return $this->Nuevo_Procedimiento;
	}

	public function setNuevo_Procedimiento($Nuevo_Procedimiento){
		$this->Nuevo_Procedimiento = $Nuevo_Procedimiento;
	}

	
	public function getEspecificaciones(){
		return $this->Especificaciones;
	}

	public function setEspecificaciones($Especificaciones){
		$this->Especificaciones = $Especificaciones;
	}
	
    public function getOne(){
        $Empresa=$this->getEmpresa();
        $stmt = $this->db->prepare(
            "SELECT * FROM rh_Ventas_Empresas WHERE Empresa=:Empresa"
        );
        $stmt->bindParam(":Empresa", $Empresa, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }

    public function getAll(){
        $stmt = $this->db->prepare("SELECT * FROM rh_Ventas_Empresas ORDER BY Nombre_Empresa");
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }

	public function create(){
		$result = false;

        $Nombre_Empresa = $this->getNombre_Empresa();
        $Alias = $this->getAlias();
        $Nuevo_Procedimiento = $this->getNuevo_Procedimiento();

        $stmt = $this->db->prepare("INSERT INTO rh_Ventas_Empresas(Nombre_Empresa, Alias, Fecha_Entrega, Nuevo_Procedimiento) VALUES (:Nombre_Empresa, :Alias, GETDATE(), :Nuevo_Procedimiento)");
        $stmt->bindParam(":Nombre_Empresa", $Nombre_Empresa, PDO::PARAM_STR);
        $stmt->bindParam(":Alias", $Alias, PDO::PARAM_STR);
        $stmt->bindParam(":Nuevo_Procedimiento", $Nuevo_Procedimiento, PDO::PARAM_INT);
        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
			$this->setEmpresa($this->db->lastInsertId());
        }
        return $result;
    }

public function update(){
		$result = false;

        $Empresa = $this->getEmpresa();
        $Nombre_Empresa = $this->getNombre_Empresa();
        $Alias = $this->getAlias();
        $Nuevo_Procedimiento = $this->getNuevo_Procedimiento();
        $Especificaciones = $this->getEspecificaciones();

        $stmt = $this->db->prepare("UPDATE rh_Ventas_Empresas SET Nombre_Empresa=:Nombre_Empresa, Alias=:Alias, Nuevo_Procedimiento=:Nuevo_Procedimiento, Especificaciones=:Especificaciones WHERE Empresa=:Empresa");
        $stmt->bindParam(":Empresa", $Empresa, PDO::PARAM_INT);
        $stmt->bindParam(":Nombre_Empresa", $Nombre_Empresa, PDO::PARAM_STR);
        $stmt->bindParam(":Alias", $Alias, PDO::PARAM_STR);
        $stmt->bindParam(":Nuevo_Procedimiento", $Nuevo_Procedimiento, PDO::PARAM_INT);
        $stmt->bindParam(":Especificaciones", $Especificaciones, PDO::PARAM_STR);
        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }
	
    public function getCentroCostosPorEmpresa(){
        $Empresa = $this->getEmpresa();

        $stmt = $this->db->prepare("SELECT * FROM Centro_Costos_Cliente WHERE Id_Empresa=:Id_Empresa ORDER BY Centro_Costos");
        $stmt->bindParam(":Id_Empresa", $Empresa, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }
};