<?php

class ContactosEmpresa
{

    private $ID;
    private $Empresa;
    private $Nombre_Contacto;
    private $Apellido_Contacto;
    private $Puesto;
    private $Correo;
    private $Telefono;
    private $Extension;
    private $Celular;
    private $Fecha_Cumpleaños;
    private $Usuario;
    private $Activo;
    private $tipo_usuario;
    private $Master;

    private $db;
    private $db1;

    public function __construct()
    {
        $this->db = Connection::connectSA();
        //   $this->db1 = Connection::connectSA2();
    }

    public function getID()
    {
        return $this->ID;
    }

    public function setID($ID)
    {
        $this->ID = $ID;
    }

    public function getEmpresa()
    {
        return $this->Empresa;
    }

    public function setEmpresa($Empresa)
    {
        $this->Empresa = $Empresa;
    }

    public function getNombre_Contacto()
    {
        return $this->Nombre_Contacto;
    }

    public function setNombre_Contacto($Nombre_Contacto)
    {
        $this->Nombre_Contacto = $Nombre_Contacto;
    }

    public function getApellido_Contacto()
    {
        return $this->Apellido_Contacto;
    }

    public function setApellido_Contacto($Apellido_Contacto)
    {
        $this->Apellido_Contacto = $Apellido_Contacto;
    }

    public function getPuesto()
    {
        return $this->Puesto;
    }

    public function setPuesto($Puesto)
    {
        $this->Puesto = $Puesto;
    }

    public function getCorreo()
    {
        return $this->Correo;
    }

    public function setCorreo($Correo)
    {
        $this->Correo = $Correo;
    }

    public function getTelefono()
    {
        return $this->Telefono;
    }

    public function setTelefono($Telefono)
    {
        $this->Telefono = $Telefono;
    }

    public function getExtension()
    {
        return $this->Extension;
    }

    public function setExtension($Extension)
    {
        $this->Extension = $Extension;
    }

    public function getCelular()
    {
        return $this->Celular;
    }

    public function setCelular($Celular)
    {
        $this->Celular = $Celular;
    }

    public function getFecha_Cumpleaños()
    {
        return $this->Fecha_Cumpleaños;
    }

    public function setFecha_Cumpleaños($Fecha_Cumpleaños)
    {
        $this->Fecha_Cumpleaños = $Fecha_Cumpleaños;
    }

    public function getUsuario()
    {
        return $this->Usuario;
    }

    public function setUsuario($Usuario)
    {
        $this->Usuario = $Usuario;
    }

    public function getActivo()
    {
        return $this->Activo;
    }

    public function setActivo($Activo)
    {
        $this->Activo = $Activo;
    }

    public function getTipo_usuario()
    {
        return $this->tipo_usuario;
    }

    public function setTipo_usuario($tipo_usuario)
    {
        $this->tipo_usuario = $tipo_usuario;
    }

    public function getMaster()
    {
        return $this->Master;
    }

    public function setMaster($Master)
    {
        $this->Master = $Master;
    }


    public function create()
    {
        $result = false;

        $Empresa = $this->getEmpresa();
        $Nombre_Contacto = $this->getNombre_Contacto();
        $Apellido_Contacto = $this->getApellido_Contacto();
        $Puesto = $this->getPuesto();
        $Correo = $this->getCorreo();
        $Telefono = $this->getTelefono();
        $Extension = $this->getExtension();
        $Celular = $this->getCelular();
        $Fecha_Cumpleanos = $this->getFecha_Cumpleaños();
        $Usuario = $this->getUsuario();
        $tipo_usuario = $this->getTipo_usuario();
        $Master = $this->getMaster();

        $stmt = $this->db->prepare("INSERT INTO rh_Ventas_Alta_Contactos(Empresa,Cliente,  Nombre_Contacto, Apellido_Contacto, Puesto, Correo, Telefono, Extension, Celular, Fecha_Cumpleaños, Usuario,tipo_usuario, Master) VALUES (:Empresa, 0, :Nombre_Contacto, :Apellido_Contacto, :Puesto, :Correo, :Telefono, :Extension, :Celular, :Fecha_Cumple, :Usuario,:tipo_usuario, :Master)");
        $stmt->bindParam(":Empresa", $Empresa, PDO::PARAM_INT);
        $stmt->bindParam(":Nombre_Contacto", $Nombre_Contacto, PDO::PARAM_STR);
        $stmt->bindParam(":Apellido_Contacto", $Apellido_Contacto, PDO::PARAM_STR);
        $stmt->bindParam(":Puesto", $Puesto, PDO::PARAM_STR);
        $stmt->bindParam(":Correo", $Correo, PDO::PARAM_STR);
        $stmt->bindParam(":Telefono", $Telefono, PDO::PARAM_STR);
        $stmt->bindParam(":Extension", $Extension, PDO::PARAM_STR);
        $stmt->bindParam(":Celular", $Celular, PDO::PARAM_STR);
        $stmt->bindParam(":Fecha_Cumple", $Fecha_Cumpleanos, PDO::PARAM_STR);
        $stmt->bindParam(":Usuario", $Usuario, PDO::PARAM_STR);
        $stmt->bindParam(":tipo_usuario", $tipo_usuario, PDO::PARAM_INT);
        $stmt->bindParam(":Master", $Master, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
            $this->setID($this->db->lastInsertId());
        }
        return $result;
    }

    public function update()
    {
        $result = false;

        $ID = $this->getID();
        $Empresa = $this->getEmpresa();
        $Nombre_Contacto = $this->getNombre_Contacto();
        $Apellido_Contacto = $this->getApellido_Contacto();
        $Puesto = $this->getPuesto();
        $Correo = $this->getCorreo();
        $Telefono = $this->getTelefono();
        $Extension = $this->getExtension();
        $Celular = $this->getCelular();
        $Fecha_Cumpleanos = $this->getFecha_Cumpleaños();
        $Usuario = $this->getUsuario();
        $tipo_usuario = $this->getTipo_usuario();
        $Master = $this->getMaster();


        $stmt = $this->db->prepare("UPDATE rh_Ventas_Alta_Contactos SET Empresa=:Empresa, Nombre_Contacto=:Nombre_Contacto, Apellido_Contacto=:Apellido_Contacto, Puesto=:Puesto, Correo=:Correo, Telefono=:Telefono, Extension=:Extension, Celular=:Celular, Fecha_Cumpleaños=:Fecha_Cumple, Usuario=:Usuario , tipo_usuario=:tipo_usuario, Master=:Master  WHERE ID=:ID");
        $stmt->bindParam(":ID", $ID, PDO::PARAM_INT);
        $stmt->bindParam(":Empresa", $Empresa, PDO::PARAM_INT);
        $stmt->bindParam(":Nombre_Contacto", $Nombre_Contacto, PDO::PARAM_STR);
        $stmt->bindParam(":Apellido_Contacto", $Apellido_Contacto, PDO::PARAM_STR);
        $stmt->bindParam(":Puesto", $Puesto, PDO::PARAM_STR);
        $stmt->bindParam(":Correo", $Correo, PDO::PARAM_STR);
        $stmt->bindParam(":Telefono", $Telefono, PDO::PARAM_STR);
        $stmt->bindParam(":Extension", $Extension, PDO::PARAM_STR);
        $stmt->bindParam(":Celular", $Celular, PDO::PARAM_STR);
        $stmt->bindParam(":Fecha_Cumple", $Fecha_Cumpleanos, PDO::PARAM_STR);
        $stmt->bindParam(":Usuario", $Usuario, PDO::PARAM_STR);
        $stmt->bindParam(":tipo_usuario", $tipo_usuario, PDO::PARAM_INT);
        $stmt->bindParam(":Master", $Master, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }

    public function getOne()
    {
        $ID = $this->getID();
        $stmt = $this->db->prepare("SELECT ce.*,  dbo.fn_Seg_Desencriptar(u.Clave) AS Contrasena FROM rh_Ventas_Alta_Contactos ce LEFT JOIN Seguridad_Usuarios u ON ce.Usuario=u.Usuario WHERE ID=:ID");
        $stmt->bindParam(":ID", $ID, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }

    public function getContactosPorEmpresa()
    {
        $Empresa = $this->getEmpresa();

        $stmt = $this->db->prepare("SELECT ac.*, ac.ID AS ID_Contacto, ct.nombre_tipo as nombre_tipo,u.password FROM rh_Ventas_Alta_Contactos ac INNER JOIN rh_ventaS_Contacto_tipo ct ON ac.tipo_usuario=ct.id INNER JOIN reclutamiento.dbo.users u on ac.Usuario=u.username WHERE Empresa=:Empresa AND Activo=1 ORDER BY Nombre_Contacto");

        $stmt->bindParam(":Empresa", $Empresa, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }

    public function getContactoPorUsuario()
    {
        $Usuario = $this->getUsuario();
        $stmt = $this->db->prepare(
            "SELECT * FROM rh_Ventas_Alta_Contactos WHERE Usuario=:Usuario AND Activo=1"
        );
        $stmt->bindParam(":Usuario", $Usuario, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }

    //Esta consulta es para los usarios que tengan mas de 1 empresa
    public function getContactoPorUsuario2()
    {
        $Usuario = $this->getUsuario();
        $stmt = $this->db->prepare(
            "SELECT * FROM rh_Ventas_Alta_Contactos WHERE Usuario=:Usuario AND Activo=1"
        );
        $stmt->bindParam(":Usuario", $Usuario, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }

    public function getClientesPorUsuario()
    {
        $Usuario = $this->getUsuario();
        $stmt = $this->db->prepare("SELECT c.Cliente, c.Nombre_Cliente FROM rh_Ventas_Alta c INNER JOIN rh_Ventas_Cliente_Contactos cc ON c.Cliente=cc.ID_Cliente INNER JOIN rh_Ventas_Alta_Contactos co ON cc.ID_Contacto=co.ID WHERE co.Usuario=:Usuario ORDER BY Nombre_Cliente");
        $stmt->bindParam(":Usuario", $Usuario, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }

    public function getRazonesPorUsuario()
    {
        $Usuario = $this->getUsuario();
        $stmt = $this->db->prepare("SELECT DISTINCT r.Razon FROM rh_Ventas_Alta c INNER JOIN rh_Ventas_Cliente_Contactos cc ON c.Cliente=cc.ID_Cliente INNER JOIN rh_Ventas_Alta_Contactos co ON cc.ID_Contacto=co.ID INNER JOIN rh_Ventas_Cliente_Razones cr ON c.Cliente=cr.ID_Cliente INNER JOIN rh_Ventas_Alta_Razones r ON cr.ID_Razon=r.ID WHERE co.Usuario=:Usuario ORDER BY Razon");
        $stmt->bindParam(":Usuario", $Usuario, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }

    public function getEmpresaPorUsuario()
    {
        $Usuario = $this->getUsuario();
        $stmt = $this->db->prepare(
            "SELECT e.* FROM rh_Ventas_Alta_Contactos c INNER JOIN rh_Ventas_Empresas e ON c.Empresa=e.Empresa WHERE Usuario=:Usuario"
        );
        $stmt->bindParam(":Usuario", $Usuario, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }

    public function getContactosPorCumpleanos()
    {
        //$stmt = $this->db->prepare("SELECT Nombre_Contacto, Apellido_Contacto, Puesto, Correo, Telefono, Extension, Celular, Fecha_Cumpleaños, Nombre_Empresa, CASE WHEN Fecha_Cumpleaños=FORMAT (GETDATE() - 1, 'dd/MM') THEN 'Ayer' WHEN Fecha_Cumpleaños=FORMAT (GETDATE(), 'dd/MM') THEN 'Hoy' WHEN Fecha_Cumpleaños=FORMAT (GETDATE() + 1, 'dd/MM') THEN 'Mañana' WHEN Fecha_Cumpleaños=FORMAT (GETDATE() + 2, 'dd/MM') THEN 'Pasado mañana' END AS Cumple FROM rh_Ventas_Alta_Contactos c INNER JOIN rh_Ventas_Empresas e ON c.Empresa=e.Empresa WHERE (Fecha_Cumpleaños=FORMAT (GETDATE() - 1, 'dd/MM') OR Fecha_Cumpleaños=FORMAT (GETDATE(), 'dd/MM') OR Fecha_Cumpleaños=FORMAT (GETDATE() + 1, 'dd/MM') OR Fecha_Cumpleaños=FORMAT (GETDATE()+2, 'dd/MM')) AND c.Activo=1 ORDER BY CONCAT(SUBSTRING(Fecha_Cumpleaños, 4, 2) ,SUBSTRING(Fecha_Cumpleaños, 1, 2))");
        $stmt = $this->db->prepare("SELECT Nombre_Contacto, 
        Apellido_Contacto, 
        Puesto, Correo, 
        Telefono, 
        Extension, 
        Celular, 
        Fecha_Cumpleaños, 
        Nombre_Empresa, 
        CASE WHEN Fecha_Cumpleaños=FORMAT (GETDATE() - 1, 'dd/MM') THEN 'Ayer' 
             WHEN Fecha_Cumpleaños=FORMAT (GETDATE(), 'dd/MM') THEN 'Hoy' 
             WHEN Fecha_Cumpleaños=FORMAT (GETDATE() + 1, 'dd/MM') THEN 'Mañana' 
             WHEN Fecha_Cumpleaños=FORMAT (GETDATE() + 2, 'dd/MM') THEN 'Pasado mañana'
             WHEN Fecha_Cumpleaños<>FORMAT (GETDATE() + 2, 'dd/MM') THEN 'Proximamanete'END AS Cumple 
             FROM rh_Ventas_Alta_Contactos c INNER JOIN rh_Ventas_Empresas e ON c.Empresa=e.Empresa 
             WHERE (Fecha_Cumpleaños=FORMAT (GETDATE() - 1, 'dd/MM') OR Fecha_Cumpleaños=FORMAT (GETDATE(), 'dd/MM') OR Fecha_Cumpleaños=FORMAT (GETDATE() + 2, 'dd/MM')OR Fecha_Cumpleaños=FORMAT (GETDATE() + 3, 'dd/MM')OR Fecha_Cumpleaños=FORMAT (GETDATE() + 4, 'dd/MM')OR Fecha_Cumpleaños=FORMAT (GETDATE() + 5, 'dd/MM')OR Fecha_Cumpleaños=FORMAT (GETDATE() + 6, 'dd/MM')OR Fecha_Cumpleaños=FORMAT (GETDATE() + 7, 'dd/MM') OR Fecha_Cumpleaños=FORMAT (GETDATE()+2, 'dd/MM')) AND c.Activo=1 ORDER BY CONCAT(SUBSTRING(Fecha_Cumpleaños, 4, 2) ,SUBSTRING(Fecha_Cumpleaños, 1, 2))
        ");
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }

    public function getAll()
    {
        $stmt = $this->db1->prepare("SELECT Nombre_Contacto, Apellido_Contacto, Puesto, Correo, Telefono, Extension, Celular, Fecha_Cumpleaños, Nombre_Empresa, Usuario, u.id AS id_user FROM rrhhinge_Candidatos.dbo.rh_Ventas_Alta_Contactos c INNER JOIN rrhhinge_Candidatos.dbo.rh_Ventas_Empresas e ON c.Empresa=e.Empresa LEFT JOIN reclutamiento.dbo.users u ON c.Usuario=u.username WHERE c.Activo=1 ORDER BY Nombre_Empresa");
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }

    public function inhabilitar()
    {
        $result = false;

        $ID = $this->getID();

        $stmt = $this->db->prepare("UPDATE rh_Ventas_Alta_Contactos SET Activo=0 WHERE ID=:ID");
        $stmt->bindParam(":ID", $ID, PDO::PARAM_INT);
        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }

    public function getContactoPorUsuarioYEmpresa()
    {  //gabo
        $Usuario = $this->getUsuario();
        $Empresa = $this->getEmpresa();
        $stmt = $this->db->prepare("SELECT * FROM rh_Ventas_Alta_Contactos WHERE Usuario=:Usuario AND Empresa=:Empresa AND Activo=1");
        $stmt->bindParam(":Usuario", $Usuario, PDO::PARAM_STR);
        $stmt->bindParam(":Empresa", $Empresa, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();


        return $fetch;
    }

    // ===[Ulises 8 junio  contactos]===
    public function getClientesPorUsuarioContacto()
    {
        $Usuario = $this->getUsuario();

        $stmt = $this->db->prepare("SELECT * FROM rh_Ventas_Cliente_Contactos  vcc inner join rh_Ventas_Alta_Contactos vac on vcc.ID_Contacto= vac.ID where  vac.Usuario=:Usuario");
        $stmt->bindParam(":Usuario", $Usuario, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchALL();

        return $fetch;
    }



    public function getOneClientesPorUsuarioContacto()
    {
        $Usuario = $this->getUsuario();

        $stmt = $this->db->prepare("SELECT * FROM rh_Ventas_Cliente_Contactos  vcc inner join rh_Ventas_Alta_Contactos vac on vcc.ID_Contacto= vac.ID where  vac.Usuario=:Usuario");
        $stmt->bindParam(":Usuario", $Usuario, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();

        return $fetch;
    }

    public function getModuloRH()
    {
        $Usuario = $this->getUsuario();

        $stmt = $this->db->prepare("SELECT va.Modulo_RH, vcc.ID_Cliente
        FROM rh_Ventas_Cliente_Contactos  vcc inner join 
             rh_Ventas_Alta_Contactos vac on vcc.ID_Contacto= vac.ID 
             inner join rh_Ventas_Alta va on va.Cliente=vcc.ID_Cliente
        where  vac.Usuario=:Usuario and va.Modulo_RH=1");
        $stmt->bindParam(":Usuario", $Usuario, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();

        return $fetch;
    }
    public function getEmpresayClienteByUsername()
    {

        $username = $this->getUsuario();
        $email = $this->getCorreo();
        $stmt = $this->db->prepare("SELECT rve.Nombre_Empresa, rvac.ID as ID_Contacto,(select top (1) Nombre_Cliente from rh_Ventas_Cliente_Contactos rvcc LEFT JOIN rh_Ventas_Alta rva ON
        rvcc.ID_Cliente=rva.Cliente where rvcc.ID_Contacto=rvac.ID) as Nombre_Cliente from rh_Ventas_Alta_Contactos rvac LEFT JOIN rh_Ventas_Empresas rve
        ON rvac.Empresa=rve.Empresa where rvac.Usuario=:username or Correo=:email");
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }
}
