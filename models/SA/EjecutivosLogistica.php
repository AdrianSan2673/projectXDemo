<?php

class EjecutivosLogistica
{
    private $Usuario_Apoyo;
    private $Ejecutivo;

    private $db;

    public function __construct()
    {
        $this->db = Connection::connectSA();
    }

    public function getUsuario_Apoyo()
    {
        return $this->Usuario_Apoyo;
    }

    public function setUsuario_Apoyo($Usuario_Apoyo)
    {
        $this->Usuario_Apoyo = $Usuario_Apoyo;
    }

    public function getEjecutivo()
    {
        return $this->Ejecutivo;
    }

    public function setEjecutivo($Ejecutivo)
    {
        $this->Ejecutivo = $Ejecutivo;
    }

    public function getOne()
    {
        $result = false;

        $Usuario_Apoyo = $this->getUsuario_Apoyo();
        $Ejecutivo = $this->getEjecutivo();

        $stmt = $this->db->prepare("SELECT * FROM Ejecutivos_Apoyo WHERE Usuario_Apoyo=:Usuario_Apoyo AND Ejecutivo=:Ejecutivo ");
        $stmt->bindParam(":Usuario_Apoyo", $Usuario_Apoyo, PDO::PARAM_STR);
        $stmt->bindParam(":Ejecutivo", $Ejecutivo, PDO::PARAM_STR);
        $flag = $stmt->execute();
        $result = $stmt->fetchObject();

        return $result;
    }
   
    public function getOneByEjecutivo()
    {
        $result = false;

        $Usuario_Apoyo = $this->getUsuario_Apoyo();

        $stmt = $this->db->prepare("SELECT * FROM Ejecutivos_Apoyo WHERE Usuario_Apoyo=:Usuario_Apoyo ");
        $stmt->bindParam(":Usuario_Apoyo", $Usuario_Apoyo, PDO::PARAM_STR);
        $flag = $stmt->execute();
        $result = $stmt->fetchObject();

        return $result;
    }


    public function getEjecutivosPorLogistica()
    {
        $Usuario_Apoyo = $this->getUsuario_Apoyo();

        //$stmt = $this->db->prepare("SELECT r.id, r.first_name, r.last_name, r.email FROM reclutamiento.dbo.users r INNER JOIN Ejecutivos_Apoyo er ON r.username=er.Ejecutivo WHERE er.Usuario_Apoyo=:Usuario_Apoyo");
        $stmt = $this->db->prepare("SELECT * FROM reclutamiento.dbo.users r, Ejecutivos_Apoyo er WHERE r.username=er.Ejecutivo AND er.Usuario_Apoyo=:Usuario_Apoyo ORDER BY first_name");
        $stmt->bindParam(":Usuario_Apoyo", $Usuario_Apoyo, PDO::PARAM_INT);
        $stmt->execute();
        $recruiters = $stmt->fetchAll();
        return $recruiters;
    }

    public function getLogisticaPorEjecutivo()
    {
        $Ejecutivo = $this->getEjecutivo();

        $stmt = $this->db->prepare("SELECT e.id, e.first_name, e.last_name, e.email FROM users e INNER JOIN rrhhinge_Candidatos.dbo.Ejecutivos_Apoyo er ON e.username=er.Usuario_Apoyo WHERE er.Ejecutivo=:Ejecutivo");
        $stmt->bindParam(":Ejecutivo", $Ejecutivo, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }

    public function create()
    {
        $result = false;

        $Usuario_Apoyo = $this->getUsuario_Apoyo();
        $Ejecutivo = $this->getEjecutivo();

        $stmt = $this->db->prepare("INSERT INTO Ejecutivos_Apoyo(Usuario_Apoyo, Ejecutivo) VALUES (:Usuario_Apoyo, :Ejecutivo)");
        $stmt->bindParam(":Usuario_Apoyo", $Usuario_Apoyo, PDO::PARAM_STR);
        $stmt->bindParam(":Ejecutivo", $Ejecutivo, PDO::PARAM_STR);

        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
        }
        return $result;
    }

    public function delete()
    {
        $result = false;

        $Usuario_Apoyo = $this->getUsuario_Apoyo();
        $Ejecutivo = $this->getEjecutivo();

        $stmt = $this->db->prepare("DELETE FROM Ejecutivos_Apoyo WHERE Usuario_Apoyo=:Usuario_Apoyo AND Ejecutivo=:Ejecutivo");
        $stmt->bindParam(":Usuario_Apoyo", $Usuario_Apoyo, PDO::PARAM_STR);
        $stmt->bindParam(":Ejecutivo", $Ejecutivo, PDO::PARAM_STR);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }

    public function deleteAll()
    {
        $result = false;
        $Usuario_Apoyo = $this->getUsuario_Apoyo();
        $stmt = $this->db->prepare("DELETE FROM Ejecutivos_Apoyo WHERE Usuario_Apoyo=:Usuario_Apoyo ");
        $stmt->bindParam(":Usuario_Apoyo", $Usuario_Apoyo, PDO::PARAM_STR);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }
}
