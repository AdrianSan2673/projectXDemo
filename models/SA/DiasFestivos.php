<?php

class Festivos
{
    private $Fecha;
	private $db;


public function __construct()
    {
        $this->db = Connection::connectSA();
    }

	public function getFecha(){
		return $this->Fecha;
	}

	public function setFecha($Fecha){
		$this->Fecha = $Fecha;
	}


	public function save(){
		$result = false;

		$Fecha = $this->getFecha();

		$stmt = $this->db->prepare("INSERT INTO Dias_Inhabiles(Fecha) VALUES (:Fecha)");

		$stmt->bindParam(":Fecha", $Fecha, PDO::PARAM_STR);
	
		$flag = $stmt->execute();

	

		return $flag;
	}


	}

