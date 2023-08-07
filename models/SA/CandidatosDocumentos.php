<?php

class CandidatosDocumentos
{
    private $Candidato;
    private $Documento;
    private $Imagen;

    private $db;
    private $db2;
    private $db3;
    private $db4;
    private $db5;
    private $db6;
    private $db7;
    private $db8;
    private $db9;
    private $db10;
    private $db11;
    private $db12;
    private $db13;
    private $db14;
    private $db15;
    private $db16;
    private $db17;

    public function __construct()
    {
        $this->db = Connection::connectSA();
        $this->db2 = Connection::connectSA2();
        $this->db3 = Connection::connectSA3();
        $this->db4 = Connection::connectSA4();
        $this->db5 = Connection::connectSA5();
        $this->db6 = Connection::connectSA6();
        $this->db7 = Connection::connectSA7();
        $this->db8 = Connection::connectSA8();
        $this->db9 = Connection::connectSA9();
        $this->db10 = Connection::connectSA10();
        $this->db11 = Connection::connectSA11();
        $this->db12 = Connection::connectSA12();
        $this->db13 = Connection::connectSA13();
        $this->db14 = Connection::connectSA14();
        $this->db15 = Connection::connectSA15();
        $this->db16 = Connection::connectSA16();
        $this->db17 = Connection::connectSA17();
    }

    public function getCandidato()
    {
        return $this->Candidato;
    }

    public function setCandidato($Candidato)
    {
        $this->Candidato = $Candidato;
    }

    public function getDocumento()
    {
        return $this->Documento;
    }

    public function setDocumento($Documento)
    {
        $this->Documento = $Documento;
    }

    public function getImagen()
    {
        return $this->Imagen;
    }

    public function setImagen($Imagen)
    {
        $this->Imagen = $Imagen;
    }

    public function getDocumentosByCandidato()
    {
        $Candidato = $this->getCandidato();
        $stmt = $this->db->prepare("select rh_candidatos_documentos.*, sys_campos.Descripcion, cfg_imagenes.folio as Folio, cfg_imagenes.Imagen as Foto from rh_candidatos_documentos
        inner join sys_campos on rh_candidatos_documentos.documento =sys_campos.campo
        inner join cfg_imagenes on rh_candidatos_documentos.documento = cfg_imagenes.folio_origen and rh_candidatos_documentos.candidato = cfg_imagenes.candidato
        where rh_candidatos_documentos.candidato=:Candidato order by sys_campos.campo asc");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $documentos = $stmt->fetchAll();

        $stmt = $this->db2->prepare("select rrhhinge_Candidatos.dbo.rh_candidatos_documentos.*, rrhhinge_Candidatos.dbo.sys_campos.Descripcion, cfg_imagenes.folio as Folio, cfg_imagenes.Imagen as Foto from rrhhinge_Candidatos.dbo.rh_candidatos_documentos
        inner join rrhhinge_Candidatos.dbo.sys_campos on rrhhinge_Candidatos.dbo.rh_candidatos_documentos.documento =rrhhinge_Candidatos.dbo.sys_campos.campo
        inner join cfg_imagenes on rrhhinge_Candidatos.dbo.rh_candidatos_documentos.documento = cfg_imagenes.folio_origen and rrhhinge_Candidatos.dbo.rh_candidatos_documentos.candidato = cfg_imagenes.candidato
        where rrhhinge_Candidatos.dbo.rh_candidatos_documentos.candidato=:Candidato order by rrhhinge_Candidatos.dbo.sys_campos.campo asc");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $documentos2 = $stmt->fetchAll();

        $stmt = $this->db3->prepare("select rrhhinge_Candidatos.dbo.rh_candidatos_documentos.*, rrhhinge_Candidatos.dbo.sys_campos.Descripcion, cfg_imagenes.folio as Folio, cfg_imagenes.Imagen as Foto from rrhhinge_Candidatos.dbo.rh_candidatos_documentos
        inner join rrhhinge_Candidatos.dbo.sys_campos on rrhhinge_Candidatos.dbo.rh_candidatos_documentos.documento =rrhhinge_Candidatos.dbo.sys_campos.campo
        inner join cfg_imagenes on rrhhinge_Candidatos.dbo.rh_candidatos_documentos.documento = cfg_imagenes.folio_origen and rrhhinge_Candidatos.dbo.rh_candidatos_documentos.candidato = cfg_imagenes.candidato
        where rrhhinge_Candidatos.dbo.rh_candidatos_documentos.candidato=:Candidato order by rrhhinge_Candidatos.dbo.sys_campos.campo asc");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $documentos3 = $stmt->fetchAll();

        $stmt = $this->db4->prepare("select rrhhinge_Candidatos.dbo.rh_candidatos_documentos.*, rrhhinge_Candidatos.dbo.sys_campos.Descripcion, cfg_imagenes.folio as Folio, cfg_imagenes.Imagen as Foto from rrhhinge_Candidatos.dbo.rh_candidatos_documentos
        inner join rrhhinge_Candidatos.dbo.sys_campos on rrhhinge_Candidatos.dbo.rh_candidatos_documentos.documento =rrhhinge_Candidatos.dbo.sys_campos.campo
        inner join cfg_imagenes on rrhhinge_Candidatos.dbo.rh_candidatos_documentos.documento = cfg_imagenes.folio_origen and rrhhinge_Candidatos.dbo.rh_candidatos_documentos.candidato = cfg_imagenes.candidato
        where rrhhinge_Candidatos.dbo.rh_candidatos_documentos.candidato=:Candidato order by rrhhinge_Candidatos.dbo.sys_campos.campo asc");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $documentos4 = $stmt->fetchAll();

        $stmt = $this->db5->prepare("select rrhhinge_Candidatos.dbo.rh_candidatos_documentos.*, rrhhinge_Candidatos.dbo.sys_campos.Descripcion, cfg_imagenes.folio as Folio, cfg_imagenes.Imagen as Foto from rrhhinge_Candidatos.dbo.rh_candidatos_documentos
        inner join rrhhinge_Candidatos.dbo.sys_campos on rrhhinge_Candidatos.dbo.rh_candidatos_documentos.documento =rrhhinge_Candidatos.dbo.sys_campos.campo
        inner join cfg_imagenes on rrhhinge_Candidatos.dbo.rh_candidatos_documentos.documento = cfg_imagenes.folio_origen and rrhhinge_Candidatos.dbo.rh_candidatos_documentos.candidato = cfg_imagenes.candidato
        where rrhhinge_Candidatos.dbo.rh_candidatos_documentos.candidato=:Candidato order by rrhhinge_Candidatos.dbo.sys_campos.campo asc");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $documentos5 = $stmt->fetchAll();

        $stmt = $this->db6->prepare("select rrhhinge_Candidatos.dbo.rh_candidatos_documentos.*, rrhhinge_Candidatos.dbo.sys_campos.Descripcion, cfg_imagenes.folio as Folio, cfg_imagenes.Imagen as Foto from rrhhinge_Candidatos.dbo.rh_candidatos_documentos
        inner join rrhhinge_Candidatos.dbo.sys_campos on rrhhinge_Candidatos.dbo.rh_candidatos_documentos.documento =rrhhinge_Candidatos.dbo.sys_campos.campo
        inner join cfg_imagenes on rrhhinge_Candidatos.dbo.rh_candidatos_documentos.documento = cfg_imagenes.folio_origen and rrhhinge_Candidatos.dbo.rh_candidatos_documentos.candidato = cfg_imagenes.candidato
        where rrhhinge_Candidatos.dbo.rh_candidatos_documentos.candidato=:Candidato order by rrhhinge_Candidatos.dbo.sys_campos.campo asc");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $documentos6 = $stmt->fetchAll();

        $stmt = $this->db7->prepare("select rrhhinge_Candidatos.dbo.rh_candidatos_documentos.*, rrhhinge_Candidatos.dbo.sys_campos.Descripcion, cfg_imagenes.folio as Folio, cfg_imagenes.Imagen as Foto from rrhhinge_Candidatos.dbo.rh_candidatos_documentos
        inner join rrhhinge_Candidatos.dbo.sys_campos on rrhhinge_Candidatos.dbo.rh_candidatos_documentos.documento =rrhhinge_Candidatos.dbo.sys_campos.campo
        inner join cfg_imagenes on rrhhinge_Candidatos.dbo.rh_candidatos_documentos.documento = cfg_imagenes.folio_origen and rrhhinge_Candidatos.dbo.rh_candidatos_documentos.candidato = cfg_imagenes.candidato
        where rrhhinge_Candidatos.dbo.rh_candidatos_documentos.candidato=:Candidato order by rrhhinge_Candidatos.dbo.sys_campos.campo asc");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $documentos7 = $stmt->fetchAll();

        $stmt = $this->db8->prepare("select rrhhinge_Candidatos.dbo.rh_candidatos_documentos.*, rrhhinge_Candidatos.dbo.sys_campos.Descripcion, cfg_imagenes.folio as Folio, cfg_imagenes.Imagen as Foto from rrhhinge_Candidatos.dbo.rh_candidatos_documentos
        inner join rrhhinge_Candidatos.dbo.sys_campos on rrhhinge_Candidatos.dbo.rh_candidatos_documentos.documento =rrhhinge_Candidatos.dbo.sys_campos.campo
        inner join cfg_imagenes on rrhhinge_Candidatos.dbo.rh_candidatos_documentos.documento = cfg_imagenes.folio_origen and rrhhinge_Candidatos.dbo.rh_candidatos_documentos.candidato = cfg_imagenes.candidato
        where rrhhinge_Candidatos.dbo.rh_candidatos_documentos.candidato=:Candidato order by rrhhinge_Candidatos.dbo.sys_campos.campo asc");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $documentos8 = $stmt->fetchAll();

        $stmt = $this->db9->prepare("select rrhhinge_Candidatos.dbo.rh_candidatos_documentos.*, rrhhinge_Candidatos.dbo.sys_campos.Descripcion, cfg_imagenes.folio as Folio, cfg_imagenes.Imagen as Foto from rrhhinge_Candidatos.dbo.rh_candidatos_documentos
        inner join rrhhinge_Candidatos.dbo.sys_campos on rrhhinge_Candidatos.dbo.rh_candidatos_documentos.documento =rrhhinge_Candidatos.dbo.sys_campos.campo
        inner join cfg_imagenes on rrhhinge_Candidatos.dbo.rh_candidatos_documentos.documento = cfg_imagenes.folio_origen and rrhhinge_Candidatos.dbo.rh_candidatos_documentos.candidato = cfg_imagenes.candidato
        where rrhhinge_Candidatos.dbo.rh_candidatos_documentos.candidato=:Candidato order by rrhhinge_Candidatos.dbo.sys_campos.campo asc");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $documentos9 = $stmt->fetchAll();

        $stmt = $this->db10->prepare("select rrhhinge_Candidatos.dbo.rh_candidatos_documentos.*, rrhhinge_Candidatos.dbo.sys_campos.Descripcion, cfg_imagenes.folio as Folio, cfg_imagenes.Imagen as Foto from rrhhinge_Candidatos.dbo.rh_candidatos_documentos
        inner join rrhhinge_Candidatos.dbo.sys_campos on rrhhinge_Candidatos.dbo.rh_candidatos_documentos.documento =rrhhinge_Candidatos.dbo.sys_campos.campo
        inner join cfg_imagenes on rrhhinge_Candidatos.dbo.rh_candidatos_documentos.documento = cfg_imagenes.folio_origen and rrhhinge_Candidatos.dbo.rh_candidatos_documentos.candidato = cfg_imagenes.candidato
        where rrhhinge_Candidatos.dbo.rh_candidatos_documentos.candidato=:Candidato order by rrhhinge_Candidatos.dbo.sys_campos.campo asc");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $documentos10 = $stmt->fetchAll();

        $stmt = $this->db11->prepare("select rrhhinge_Candidatos.dbo.rh_candidatos_documentos.*, rrhhinge_Candidatos.dbo.sys_campos.Descripcion, cfg_imagenes.folio as Folio, cfg_imagenes.Imagen as Foto from rrhhinge_Candidatos.dbo.rh_candidatos_documentos
        inner join rrhhinge_Candidatos.dbo.sys_campos on rrhhinge_Candidatos.dbo.rh_candidatos_documentos.documento =rrhhinge_Candidatos.dbo.sys_campos.campo
        inner join cfg_imagenes on rrhhinge_Candidatos.dbo.rh_candidatos_documentos.documento = cfg_imagenes.folio_origen and rrhhinge_Candidatos.dbo.rh_candidatos_documentos.candidato = cfg_imagenes.candidato
        where rrhhinge_Candidatos.dbo.rh_candidatos_documentos.candidato=:Candidato order by rrhhinge_Candidatos.dbo.sys_campos.campo asc");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $documentos11 = $stmt->fetchAll();

        $stmt = $this->db12->prepare("select rrhhinge_Candidatos.dbo.rh_candidatos_documentos.*, rrhhinge_Candidatos.dbo.sys_campos.Descripcion, cfg_imagenes.folio as Folio, cfg_imagenes.Imagen as Foto from rrhhinge_Candidatos.dbo.rh_candidatos_documentos
        inner join rrhhinge_Candidatos.dbo.sys_campos on rrhhinge_Candidatos.dbo.rh_candidatos_documentos.documento =rrhhinge_Candidatos.dbo.sys_campos.campo
        inner join cfg_imagenes on rrhhinge_Candidatos.dbo.rh_candidatos_documentos.documento = cfg_imagenes.folio_origen and rrhhinge_Candidatos.dbo.rh_candidatos_documentos.candidato = cfg_imagenes.candidato
        where rrhhinge_Candidatos.dbo.rh_candidatos_documentos.candidato=:Candidato order by rrhhinge_Candidatos.dbo.sys_campos.campo asc");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $documentos12 = $stmt->fetchAll();

        $stmt = $this->db13->prepare("select rrhhinge_Candidatos.dbo.rh_candidatos_documentos.*, rrhhinge_Candidatos.dbo.sys_campos.Descripcion, cfg_imagenes.folio as Folio, cfg_imagenes.Imagen as Foto from rrhhinge_Candidatos.dbo.rh_candidatos_documentos
        inner join rrhhinge_Candidatos.dbo.sys_campos on rrhhinge_Candidatos.dbo.rh_candidatos_documentos.documento =rrhhinge_Candidatos.dbo.sys_campos.campo
        inner join cfg_imagenes on rrhhinge_Candidatos.dbo.rh_candidatos_documentos.documento = cfg_imagenes.folio_origen and rrhhinge_Candidatos.dbo.rh_candidatos_documentos.candidato = cfg_imagenes.candidato
        where rrhhinge_Candidatos.dbo.rh_candidatos_documentos.candidato=:Candidato order by rrhhinge_Candidatos.dbo.sys_campos.campo asc");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $documentos13 = $stmt->fetchAll();

        $stmt = $this->db14->prepare("select rrhhinge_Candidatos.dbo.rh_candidatos_documentos.*, rrhhinge_Candidatos.dbo.sys_campos.Descripcion, cfg_imagenes.folio as Folio, cfg_imagenes.Imagen as Foto from rrhhinge_Candidatos.dbo.rh_candidatos_documentos
        inner join rrhhinge_Candidatos.dbo.sys_campos on rrhhinge_Candidatos.dbo.rh_candidatos_documentos.documento =rrhhinge_Candidatos.dbo.sys_campos.campo
        inner join cfg_imagenes on rrhhinge_Candidatos.dbo.rh_candidatos_documentos.documento = cfg_imagenes.folio_origen and rrhhinge_Candidatos.dbo.rh_candidatos_documentos.candidato = cfg_imagenes.candidato
        where rrhhinge_Candidatos.dbo.rh_candidatos_documentos.candidato=:Candidato order by rrhhinge_Candidatos.dbo.sys_campos.campo asc");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $documentos14 = $stmt->fetchAll();

         $stmt = $this->db15->prepare("select rrhhinge_Candidatos.dbo.rh_candidatos_documentos.*, rrhhinge_Candidatos.dbo.sys_campos.Descripcion, cfg_imagenes.folio as Folio, cfg_imagenes.Imagen as Foto from rrhhinge_Candidatos.dbo.rh_candidatos_documentos
        inner join rrhhinge_Candidatos.dbo.sys_campos on rrhhinge_Candidatos.dbo.rh_candidatos_documentos.documento =rrhhinge_Candidatos.dbo.sys_campos.campo
        inner join cfg_imagenes on rrhhinge_Candidatos.dbo.rh_candidatos_documentos.documento = cfg_imagenes.folio_origen and rrhhinge_Candidatos.dbo.rh_candidatos_documentos.candidato = cfg_imagenes.candidato
        where rrhhinge_Candidatos.dbo.rh_candidatos_documentos.candidato=:Candidato order by rrhhinge_Candidatos.dbo.sys_campos.campo asc");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $documentos15 = $stmt->fetchAll(); 
      
        $stmt = $this->db16->prepare("SELECT rrhhinge_Candidatos.dbo.rh_candidatos_documentos.*, rrhhinge_Candidatos.dbo.sys_campos.Descripcion, cfg_imagenes.folio as Folio, cfg_imagenes.Imagen as Foto from rrhhinge_Candidatos.dbo.rh_candidatos_documentos
        inner join rrhhinge_Candidatos.dbo.sys_campos on rrhhinge_Candidatos.dbo.rh_candidatos_documentos.documento =rrhhinge_Candidatos.dbo.sys_campos.campo
        inner join cfg_imagenes on rrhhinge_Candidatos.dbo.rh_candidatos_documentos.documento = cfg_imagenes.folio_origen and rrhhinge_Candidatos.dbo.rh_candidatos_documentos.candidato = cfg_imagenes.candidato
        where rrhhinge_Candidatos.dbo.rh_candidatos_documentos.candidato=:Candidato order by rrhhinge_Candidatos.dbo.sys_campos.campo asc");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $documentos16 = $stmt->fetchAll(); 

        $stmt = $this->db17->prepare("SELECT rrhhinge_Candidatos.dbo.rh_candidatos_documentos.*, rrhhinge_Candidatos.dbo.sys_campos.Descripcion, cfg_imagenes.folio as Folio, cfg_imagenes.Imagen as Foto from rrhhinge_Candidatos.dbo.rh_candidatos_documentos
        inner join rrhhinge_Candidatos.dbo.sys_campos on rrhhinge_Candidatos.dbo.rh_candidatos_documentos.documento =rrhhinge_Candidatos.dbo.sys_campos.campo
        inner join cfg_imagenes on rrhhinge_Candidatos.dbo.rh_candidatos_documentos.documento = cfg_imagenes.folio_origen and rrhhinge_Candidatos.dbo.rh_candidatos_documentos.candidato = cfg_imagenes.candidato
        where rrhhinge_Candidatos.dbo.rh_candidatos_documentos.candidato=:Candidato order by rrhhinge_Candidatos.dbo.sys_campos.campo asc");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $documentos17 = $stmt->fetchAll(); 

        //$documentos = array_merge($documentos, $documentos2, $documentos3, $documentos4, $documentos5, $documentos6, $documentos7, $documentos8, $documentos9, $documentos10, $documentos11, $documentos12, $documentos13, $documentos14);
        $documentos = array_merge($documentos, $documentos2, $documentos3, $documentos4, $documentos5, $documentos6, $documentos7, $documentos8, $documentos9, $documentos10, $documentos11, $documentos12, $documentos13, $documentos14, $documentos15, $documentos16, $documentos17);
        return $documentos;
    }

    public function create()
    {
        $result = false;

        $Candidato = $this->getCandidato();
        $Documento = $this->getDocumento();
        $Imagen = $this->getImagen();

        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos_Documentos (Candidato, Documento, Imagen)
		VALUES (:Candidato, :Documento, :Imagen)");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Documento", $Documento, PDO::PARAM_INT);
        $stmt->bindParam(":Imagen", $Imagen, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }

    public function update()
    {

        $result = false;

        $Candidato = $this->getCandidato();
        $Documento = $this->getDocumento();
        $Imagen = $this->getImagen();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos_Documentos SET Documento=:Documento, Imagen=:Imagen WHERE Candidato=:Candidato");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Documento", $Documento, PDO::PARAM_INT);
        $stmt->bindParam(":Imagen", $Imagen, PDO::PARAM_INT);

        $flag = $stmt->execute();
        if ($flag)
            $result = true;
        return $result;
    }

    public function delete()
    {
        $result = false;

        $Candidato = $this->getCandidato();
        $Imagen = $this->getImagen();

        $stmt = $this->db->prepare("DELETE FROM rh_Candidatos_Documentos WHERE Candidato=:Candidato AND Imagen=:Imagen");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Imagen", $Imagen, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }
}
