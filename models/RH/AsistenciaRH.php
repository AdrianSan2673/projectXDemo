<?php
class AsistenciaRH
{
    private $id;
    private $id_user_rh;
    private $coordenada;
    private $created_at;
    private $db;
    //11 sept
    private $type;

    public function __construct()
    {
        $this->db = Connection::connectSA();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId_user_rh()
    {
        return $this->id_user_rh;
    }

    public function setId_user_rh($id_user_rh)
    {
        $this->id_user_rh = $id_user_rh;
    }

    public function getCoordenada()
    {
        return $this->coordenada;
    }

    public function setCoordenada($coordenada)
    {
        $this->coordenada = $coordenada;
    }

    public function getCreated_at()
    {
        return $this->created_at;
    }

    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;
    }
    //11 sept
    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }



    public function getOne()
    {

        $id = $this->getId();
        $stmt = $this->db->prepare("SELECT * from asistencia_rh where id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchObject();
        return $fetch;
    }

    public function getAll()
    {
        $id_user_rh = $this->getId_user_rh();
        $stmt = $this->db->prepare("SELECT ar.*,at.name from asistencia_rh ar INNER JOIN asistence_type at ON  ar.type=at.id where id_user_rh=:id_user_rh order by id DESC");
        $stmt->bindParam(":id_user_rh", $id_user_rh, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }

    //gabo 11 sept
    public function Insertar_Asistencia()
    {

        $result = false;
        $coordenada = $this->getCoordenada();
        $id_user_rh = $this->getId_user_rh();
        $id_type = $this->getType();

        $stmt = $this->db->prepare("INSERT INTO asistencia_rh (id_user_rh,coordenada,created_at,type) values (:id_user_rh,:coordenada,GETDATE(),:id_type)");
        $stmt->bindParam(":coordenada", $coordenada, PDO::PARAM_STR);
        $stmt->bindParam(":id_user_rh", $id_user_rh, PDO::PARAM_INT);
        $stmt->bindParam(":id_type", $id_type, PDO::PARAM_INT);


        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
            $this->setId($this->db->lastInsertId());
        }
        return $result;
    }
}
