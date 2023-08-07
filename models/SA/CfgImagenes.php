<?php

class CfgImagenes
{
    private $Imagen;
    private $Tabla;
    private $Folio_Origen;
    private $Archivo;
    private $Objeto;
    private $Candidato;
    private $Folio;

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

    public function getImagen()
    {
        return $this->Imagen;
    }

    public function setImagen($Imagen)
    {
        $this->Imagen = $Imagen;
    }

    public function getTabla()
    {
        return $this->Tabla;
    }

    public function setTabla($Tabla)
    {
        $this->Tabla = $Tabla;
    }

    public function getFolio_Origen()
    {
        return $this->Folio_Origen;
    }

    public function setFolio_Origen($Folio_Origen)
    {
        $this->Folio_Origen = $Folio_Origen;
    }

    public function getArchivo()
    {
        return $this->Archivo;
    }

    public function setArchivo($Archivo)
    {
        $this->Archivo = $Archivo;
    }

    public function getObjeto()
    {
        return $this->Objeto;
    }

    public function setObjeto($Objeto)
    {
        $this->Objeto = $Objeto;
    }

    public function getCandidato()
    {
        return $this->Candidato;
    }

    public function setCandidato($Candidato)
    {
        $this->Candidato = $Candidato;
    }

    public function getFolio()
    {
        return $this->Folio;
    }

    public function setFolio($Folio)
    {
        $this->Folio = $Folio;
    }

    public function getProfile()
    {
        $Folio_Origen = $this->getFolio_Origen();
        $Tabla = $this->getTabla();

        $stmt = $this->db->prepare(
            "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
        );
        $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        if ($fetch) {
            $foto = base64_encode($fetch->Objeto);
            $pic = "data:image/jpg;base64, $foto";
            $fetch = Utils::getImage($pic);
        } else {
            $stmt = $this->db2->prepare(
                "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
            );
            $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
            $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
            $stmt->execute();
            $fetch = $stmt->fetchObject();
            if ($fetch) {
                $foto = base64_encode($fetch->Objeto);
                $pic = "data:image/jpg;base64, $foto";
                $fetch = Utils::getImage($pic);
            } else {
                /** En caso de emergencia */
                $stmt = $this->db3->prepare(
                    "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                );
                $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                $stmt->execute();
                $fetch = $stmt->fetchObject();
                if ($fetch) {
                    $foto = base64_encode($fetch->Objeto);
                    $pic = "data:image/jpg;base64, $foto";
                    $fetch = Utils::getImage($pic);
                } else {
                    $stmt = $this->db4->prepare(
                        "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                    );
                    $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                    $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                    $stmt->execute();
                    $fetch = $stmt->fetchObject();
                    if ($fetch) {
                        $foto = base64_encode($fetch->Objeto);
                        $pic = "data:image/jpg;base64, $foto";
                        $fetch = Utils::getImage($pic);
                    } else {
                        $stmt = $this->db5->prepare(
                            "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                        );
                        $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                        $stmt->execute();
                        $fetch = $stmt->fetchObject();
                        if ($fetch) {
                            $foto = base64_encode($fetch->Objeto);
                            $pic = "data:image/jpg;base64, $foto";
                            $fetch = Utils::getImage($pic);
                        } else {
                            $stmt = $this->db6->prepare(
                                "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                            );
                            $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                            $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                            $stmt->execute();
                            $fetch = $stmt->fetchObject();
                            if ($fetch) {
                                $foto = base64_encode($fetch->Objeto);
                                $pic = "data:image/jpg;base64, $foto";
                                $fetch = Utils::getImage($pic);
                            } else {
                                $stmt = $this->db7->prepare(
                                    "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                );
                                $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                $stmt->execute();
                                $fetch = $stmt->fetchObject();
                                if ($fetch) {
                                    $foto = base64_encode($fetch->Objeto);
                                    $pic = "data:image/jpg;base64, $foto";
                                    $fetch = Utils::getImage($pic);
                                } else {
                                    $stmt = $this->db8->prepare(
                                        "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                    );
                                    $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                    $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                    $stmt->execute();
                                    $fetch = $stmt->fetchObject();
                                    if ($fetch) {
                                        $foto = base64_encode($fetch->Objeto);
                                        $pic = "data:image/jpg;base64, $foto";
                                        $fetch = Utils::getImage($pic);
                                    } else {
                                        $stmt = $this->db9->prepare(
                                            "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                        );
                                        $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                        $stmt->execute();
                                        $fetch = $stmt->fetchObject();
                                        if ($fetch) {
                                            $foto = base64_encode($fetch->Objeto);
                                            $pic = "data:image/jpg;base64, $foto";
                                            $fetch = Utils::getImage($pic);
                                        } else {
                                            $stmt = $this->db10->prepare(
                                                "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                            );
                                            $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                            $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                            $stmt->execute();
                                            $fetch = $stmt->fetchObject();
                                            if ($fetch) {
                                                $foto = base64_encode($fetch->Objeto);
                                                $pic = "data:image/jpg;base64, $foto";
                                                $fetch = Utils::getImage($pic);
                                            } else {
                                                $stmt = $this->db11->prepare(
                                                    "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                                );
                                                $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                $stmt->execute();
                                                $fetch = $stmt->fetchObject();
                                                if ($fetch) {
                                                    $foto = base64_encode($fetch->Objeto);
                                                    $pic = "data:image/jpg;base64, $foto";
                                                    $fetch = Utils::getImage($pic);
                                                } else {
                                                    $stmt = $this->db12->prepare(
                                                        "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                                    );
                                                    $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                    $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                    $stmt->execute();
                                                    $fetch = $stmt->fetchObject();
                                                    if ($fetch) {
                                                        $foto = base64_encode($fetch->Objeto);
                                                        $pic = "data:image/jpg;base64, $foto";
                                                        $fetch = Utils::getImage($pic);
                                                    } else {
                                                        $stmt = $this->db13->prepare(
                                                            "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                                        );
                                                        $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                        $stmt->execute();
                                                        $fetch = $stmt->fetchObject();
                                                        if ($fetch) {
                                                            $foto = base64_encode($fetch->Objeto);
                                                            $pic = "data:image/jpg;base64, $foto";
                                                            $fetch = Utils::getImage($pic);
                                                        } else {
                                                            $stmt = $this->db14->prepare(
                                                                "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                                            );
                                                            $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                            $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                            $stmt->execute();
                                                            $fetch = $stmt->fetchObject();
                                                            if ($fetch) {
                                                                $foto = base64_encode($fetch->Objeto);
                                                                $pic = "data:image/jpg;base64, $foto";
                                                                $fetch = Utils::getImage($pic);
                                                            } else {
                                                                $stmt = $this->db15->prepare(
                                                                    "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                                                );
                                                                $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                                $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                                $stmt->execute();
                                                                $fetch = $stmt->fetchObject();
                                                                if ($fetch) {
                                                                    $foto = base64_encode($fetch->Objeto);
                                                                    $pic = "data:image/jpg;base64, $foto";
                                                                    $fetch = Utils::getImage($pic);
                                                                } else {
                                                                    $stmt = $this->db16->prepare(
                                                                        "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                                                    );
                                                                    $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                                    $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                                    $stmt->execute();
                                                                    $fetch = $stmt->fetchObject();
                                                                    if ($fetch) {
                                                                        $foto = base64_encode($fetch->Objeto);
                                                                        $pic = "data:image/jpg;base64, $foto";
                                                                        $fetch = Utils::getImage($pic);
                                                                    } else {
                                                                        $stmt = $this->db17->prepare(
                                                                            "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                                                        );
                                                                        $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                                        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                                        $stmt->execute();
                                                                        $fetch = $stmt->fetchObject();
                                                                        if ($fetch) {
                                                                            $foto = base64_encode($fetch->Objeto);
                                                                            $pic = "data:image/jpg;base64, $foto";
                                                                            $fetch = Utils::getImage($pic);
                                                                        } else
                                                                            $fetch = false;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $fetch;
    }

    public function getNumeroExteriorDomicilio()
    {
        $this->setTabla('Candidatos_Ubicacion');
        $Candidato = $this->getCandidato();
        $Tabla = $this->getTabla();

        $stmt = $this->db->prepare(
            "SELECT Objeto FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        if ($fetch) {
            $foto = base64_encode($fetch->Objeto);
            $pic = "data:image/jpg;charset=utf8;base64, $foto";
            $fetch = Utils::getImage($pic);
        } else {
            $stmt = $this->db2->prepare(
                "SELECT Objeto FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
            );
            $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
            $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
            $stmt->execute();
            $fetch = $stmt->fetchObject();
            if ($fetch) {
                $foto = base64_encode($fetch->Objeto);
                $pic = "data:image/jpg;base64, $foto";
                $fetch = Utils::getImage($pic);
            } else {
                /** En caso de emergencia */
                $stmt = $this->db3->prepare(
                    "SELECT Objeto FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
                );
                $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                $stmt->execute();
                $fetch = $stmt->fetchObject();
                if ($fetch) {
                    $foto = base64_encode($fetch->Objeto);
                    $pic = "data:image/jpg;base64, $foto";
                    $fetch = Utils::getImage($pic);
                } else {
                    $stmt = $this->db4->prepare(
                        "SELECT Objeto FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
                    );
                    $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                    $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                    $stmt->execute();
                    $fetch = $stmt->fetchObject();
                    if ($fetch) {
                        $foto = base64_encode($fetch->Objeto);
                        $pic = "data:image/jpg;base64, $foto";
                        $fetch = Utils::getImage($pic);
                    } else {
                        $stmt = $this->db5->prepare(
                            "SELECT Objeto FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
                        );
                        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                        $stmt->execute();
                        $fetch = $stmt->fetchObject();
                        if ($fetch) {
                            $foto = base64_encode($fetch->Objeto);
                            $pic = "data:image/jpg;base64, $foto";
                            $fetch = Utils::getImage($pic);
                        } else {
                            $stmt = $this->db6->prepare(
                                "SELECT Objeto FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
                            );
                            $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                            $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                            $stmt->execute();
                            $fetch = $stmt->fetchObject();
                            if ($fetch) {
                                $foto = base64_encode($fetch->Objeto);
                                $pic = "data:image/jpg;base64, $foto";
                                $fetch = Utils::getImage($pic);
                            } else {
                                $stmt = $this->db7->prepare(
                                    "SELECT Objeto FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
                                );
                                $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                $stmt->execute();
                                $fetch = $stmt->fetchObject();
                                if ($fetch) {
                                    $foto = base64_encode($fetch->Objeto);
                                    $pic = "data:image/jpg;base64, $foto";
                                    $fetch = Utils::getImage($pic);
                                } else {
                                    $stmt = $this->db8->prepare(
                                        "SELECT Objeto FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
                                    );
                                    $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                    $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                    $stmt->execute();
                                    $fetch = $stmt->fetchObject();
                                    if ($fetch) {
                                        $foto = base64_encode($fetch->Objeto);
                                        $pic = "data:image/jpg;base64, $foto";
                                        $fetch = Utils::getImage($pic);
                                    } else {
                                        $stmt = $this->db9->prepare(
                                            "SELECT Objeto FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
                                        );
                                        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                        $stmt->execute();
                                        $fetch = $stmt->fetchObject();
                                        if ($fetch) {
                                            $foto = base64_encode($fetch->Objeto);
                                            $pic = "data:image/jpg;base64, $foto";
                                            $fetch = Utils::getImage($pic);
                                        } else {
                                            $stmt = $this->db10->prepare(
                                                "SELECT Objeto FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
                                            );
                                            $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                            $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                            $stmt->execute();
                                            $fetch = $stmt->fetchObject();
                                            if ($fetch) {
                                                $foto = base64_encode($fetch->Objeto);
                                                $pic = "data:image/jpg;base64, $foto";
                                                $fetch = Utils::getImage($pic);
                                            } else {
                                                $stmt = $this->db11->prepare(
                                                    "SELECT Objeto FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
                                                );
                                                $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                                $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                $stmt->execute();
                                                $fetch = $stmt->fetchObject();
                                                if ($fetch) {
                                                    $foto = base64_encode($fetch->Objeto);
                                                    $pic = "data:image/jpg;base64, $foto";
                                                    $fetch = Utils::getImage($pic);
                                                } else {
                                                    $stmt = $this->db12->prepare(
                                                        "SELECT Objeto FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
                                                    );
                                                    $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                                    $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                    $stmt->execute();
                                                    $fetch = $stmt->fetchObject();
                                                    if ($fetch) {
                                                        $foto = base64_encode($fetch->Objeto);
                                                        $pic = "data:image/jpg;base64, $foto";
                                                        $fetch = Utils::getImage($pic);
                                                    } else {
                                                        $stmt = $this->db13->prepare(
                                                            "SELECT Objeto FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
                                                        );
                                                        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                                        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                        $stmt->execute();
                                                        $fetch = $stmt->fetchObject();
                                                        if ($fetch) {
                                                            $foto = base64_encode($fetch->Objeto);
                                                            $pic = "data:image/jpg;base64, $foto";
                                                            $fetch = Utils::getImage($pic);
                                                        } else {
                                                            $stmt = $this->db14->prepare(
                                                                "SELECT Objeto FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
                                                            );
                                                            $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                                            $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                            $stmt->execute();
                                                            $fetch = $stmt->fetchObject();
                                                            if ($fetch) {
                                                                $foto = base64_encode($fetch->Objeto);
                                                                $pic = "data:image/jpg;base64, $foto";
                                                                $fetch = Utils::getImage($pic);
                                                            } else {
                                                                $stmt = $this->db15->prepare(
                                                                    "SELECT Objeto FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
                                                                );
                                                                $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                                                $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                                $stmt->execute();
                                                                $fetch = $stmt->fetchObject();
                                                                if ($fetch) {
                                                                    $foto = base64_encode($fetch->Objeto);
                                                                    $pic = "data:image/jpg;base64, $foto";
                                                                    $fetch = Utils::getImage($pic);
                                                                } else {
                                                                    $stmt = $this->db16->prepare(
                                                                        "SELECT Objeto FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
                                                                    );
                                                                    $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                                                    $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                                    $stmt->execute();
                                                                    $fetch = $stmt->fetchObject();
                                                                    if ($fetch) {
                                                                        $foto = base64_encode($fetch->Objeto);
                                                                        $pic = "data:image/jpg;base64, $foto";
                                                                        $fetch = Utils::getImage($pic);
                                                                    } else {
                                                                        $stmt = $this->db17->prepare(
                                                                            "SELECT Objeto FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
                                                                        );
                                                                        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                                                        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                                        $stmt->execute();
                                                                        $fetch = $stmt->fetchObject();
                                                                        if ($fetch) {
                                                                            $foto = base64_encode($fetch->Objeto);
                                                                            $pic = "data:image/jpg;base64, $foto";
                                                                            $fetch = Utils::getImage($pic);
                                                                        } else
                                                                            $fetch = false;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $fetch;
    }

    public function getExteriorDomicilio()
    {
        $this->setTabla('Candidatos_Ubicacion');
        $Folio_Origen = $this->getFolio_Origen();
        $Tabla = $this->getTabla();

        $stmt = $this->db->prepare(
            "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
        );
        $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        if ($fetch) {
            $foto = base64_encode($fetch->Objeto);
            $pic = "data:image/jpg;charset=utf8;base64, $foto";
            $fetch = Utils::getImage($pic);
        } else {
            $stmt = $this->db2->prepare(
                "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
            );
            $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
            $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
            $stmt->execute();
            $fetch = $stmt->fetchObject();
            if ($fetch) {
                $foto = base64_encode($fetch->Objeto);
                $pic = "data:image/jpg;charset=utf8;base64, $foto";
                $fetch = Utils::getImage($pic);
            } else {
                /** En caso de emergencia */
                $stmt = $this->db3->prepare(
                    "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                );
                $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                $stmt->execute();
                $fetch = $stmt->fetchObject();
                if ($fetch) {
                    $foto = base64_encode($fetch->Objeto);
                    $pic = "data:image/jpg;charset=utf8;base64, $foto";
                    $fetch = Utils::getImage($pic);
                } else {
                    $stmt = $this->db4->prepare(
                        "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                    );
                    $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                    $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                    $stmt->execute();
                    $fetch = $stmt->fetchObject();
                    if ($fetch) {
                        $foto = base64_encode($fetch->Objeto);
                        $pic = "data:image/jpg;charset=utf8;base64, $foto";
                        $fetch = Utils::getImage($pic);
                    } else {
                        $stmt = $this->db5->prepare(
                            "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                        );
                        $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                        $stmt->execute();
                        $fetch = $stmt->fetchObject();
                        if ($fetch) {
                            $foto = base64_encode($fetch->Objeto);
                            $pic = "data:image/jpg;charset=utf8;base64, $foto";
                            $fetch = Utils::getImage($pic);
                        } else {
                            $stmt = $this->db6->prepare(
                                "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                            );
                            $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                            $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                            $stmt->execute();
                            $fetch = $stmt->fetchObject();
                            if ($fetch) {
                                $foto = base64_encode($fetch->Objeto);
                                $pic = "data:image/jpg;charset=utf8;base64, $foto";
                                $fetch = Utils::getImage($pic);
                            } else {
                                $stmt = $this->db7->prepare(
                                    "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                );
                                $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                $stmt->execute();
                                $fetch = $stmt->fetchObject();
                                if ($fetch) {
                                    $foto = base64_encode($fetch->Objeto);
                                    $pic = "data:image/jpg;charset=utf8;base64, $foto";
                                    $fetch = Utils::getImage($pic);
                                } else {
                                    $stmt = $this->db8->prepare(
                                        "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                    );
                                    $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                    $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                    $stmt->execute();
                                    $fetch = $stmt->fetchObject();
                                    if ($fetch) {
                                        $foto = base64_encode($fetch->Objeto);
                                        $pic = "data:image/jpg;charset=utf8;base64, $foto";
                                        $fetch = Utils::getImage($pic);
                                    } else {
                                        $stmt = $this->db9->prepare(
                                            "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                        );
                                        $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                        $stmt->execute();
                                        $fetch = $stmt->fetchObject();
                                        if ($fetch) {
                                            $foto = base64_encode($fetch->Objeto);
                                            $pic = "data:image/jpg;charset=utf8;base64, $foto";
                                            $fetch = Utils::getImage($pic);
                                        } else {
                                            $stmt = $this->db10->prepare(
                                                "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                            );
                                            $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                            $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                            $stmt->execute();
                                            $fetch = $stmt->fetchObject();
                                            if ($fetch) {
                                                $foto = base64_encode($fetch->Objeto);
                                                $pic = "data:image/jpg;charset=utf8;base64, $foto";
                                                $fetch = Utils::getImage($pic);
                                            } else {
                                                $stmt = $this->db11->prepare(
                                                    "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                                );
                                                $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                $stmt->execute();
                                                $fetch = $stmt->fetchObject();
                                                if ($fetch) {
                                                    $foto = base64_encode($fetch->Objeto);
                                                    $pic = "data:image/jpg;charset=utf8;base64, $foto";
                                                    $fetch = Utils::getImage($pic);
                                                } else {
                                                    $stmt = $this->db12->prepare(
                                                        "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                                    );
                                                    $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                    $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                    $stmt->execute();
                                                    $fetch = $stmt->fetchObject();
                                                    if ($fetch) {
                                                        $foto = base64_encode($fetch->Objeto);
                                                        $pic = "data:image/jpg;charset=utf8;base64, $foto";
                                                        $fetch = Utils::getImage($pic);
                                                    } else {
                                                        $stmt = $this->db13->prepare(
                                                            "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                                        );
                                                        $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                        $stmt->execute();
                                                        $fetch = $stmt->fetchObject();
                                                        if ($fetch) {
                                                            $foto = base64_encode($fetch->Objeto);
                                                            $pic = "data:image/jpg;charset=utf8;base64, $foto";
                                                            $fetch = Utils::getImage($pic);
                                                        } else {
                                                            $stmt = $this->db14->prepare(
                                                                "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                                            );
                                                            $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                            $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                            $stmt->execute();
                                                            $fetch = $stmt->fetchObject();
                                                            if ($fetch) {
                                                                $foto = base64_encode($fetch->Objeto);
                                                                $pic = "data:image/jpg;charset=utf8;base64, $foto";
                                                                $fetch = Utils::getImage($pic);
                                                            } else {
                                                                $stmt = $this->db15->prepare(
                                                                    "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                                                );
                                                                $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                                $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                                $stmt->execute();
                                                                $fetch = $stmt->fetchObject();
                                                                if ($fetch) {
                                                                    $foto = base64_encode($fetch->Objeto);
                                                                    $pic = "data:image/jpg;charset=utf8;base64, $foto";
                                                                    $fetch = Utils::getImage($pic);
                                                                } else {
                                                                    $stmt = $this->db16->prepare(
                                                                        "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                                                    );
                                                                    $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                                    $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                                    $stmt->execute();
                                                                    $fetch = $stmt->fetchObject();
                                                                    if ($fetch) {
                                                                        $foto = base64_encode($fetch->Objeto);
                                                                        $pic = "data:image/jpg;charset=utf8;base64, $foto";
                                                                        $fetch = Utils::getImage($pic);
                                                                    } else {
                                                                        $stmt = $this->db17->prepare(
                                                                            "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                                                        );
                                                                        $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                                        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                                        $stmt->execute();
                                                                        $fetch = $stmt->fetchObject();
                                                                        if ($fetch) {
                                                                            $foto = base64_encode($fetch->Objeto);
                                                                            $pic = "data:image/jpg;charset=utf8;base64, $foto";
                                                                            $fetch = Utils::getImage($pic);
                                                                        } else
                                                                            $fetch = false;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $fetch;
    }

    public function getInteriorDomicilio()
    {
        $this->setTabla('Candidatos_Vivienda');
        $Folio_Origen = $this->getFolio_Origen();
        $Tabla = $this->getTabla();

        $stmt = $this->db->prepare(
            "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
        );
        $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        if ($fetch) {
            $foto = base64_encode($fetch->Objeto);
            $pic = "data:image/jpg;charset=utf8;base64, $foto";
            $fetch = Utils::getImage($pic);
        } else {
            $stmt = $this->db2->prepare(
                "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
            );
            $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
            $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
            $stmt->execute();
            $fetch = $stmt->fetchObject();
            if ($fetch) {
                $foto = base64_encode($fetch->Objeto);
                $pic = "data:image/jpg;charset=utf8;base64, $foto";
                $fetch = Utils::getImage($pic);
            } else {
                /** En caso de emergencia */
                $stmt = $this->db3->prepare(
                    "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                );
                $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                $stmt->execute();
                $fetch = $stmt->fetchObject();
                if ($fetch) {
                    $foto = base64_encode($fetch->Objeto);
                    $pic = "data:image/jpg;charset=utf8;base64, $foto";
                    $fetch = Utils::getImage($pic);
                } else {
                    $stmt = $this->db4->prepare(
                        "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                    );
                    $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                    $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                    $stmt->execute();
                    $fetch = $stmt->fetchObject();
                    if ($fetch) {
                        $foto = base64_encode($fetch->Objeto);
                        $pic = "data:image/jpg;charset=utf8;base64, $foto";
                        $fetch = Utils::getImage($pic);
                    } else {
                        $stmt = $this->db5->prepare(
                            "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                        );
                        $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                        $stmt->execute();
                        $fetch = $stmt->fetchObject();
                        if ($fetch) {
                            $foto = base64_encode($fetch->Objeto);
                            $pic = "data:image/jpg;charset=utf8;base64, $foto";
                            $fetch = Utils::getImage($pic);
                        } else {
                            $stmt = $this->db6->prepare(
                                "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                            );
                            $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                            $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                            $stmt->execute();
                            $fetch = $stmt->fetchObject();
                            if ($fetch) {
                                $foto = base64_encode($fetch->Objeto);
                                $pic = "data:image/jpg;charset=utf8;base64, $foto";
                                $fetch = Utils::getImage($pic);
                            } else {
                                $stmt = $this->db7->prepare(
                                    "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                );
                                $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                $stmt->execute();
                                $fetch = $stmt->fetchObject();
                                if ($fetch) {
                                    $foto = base64_encode($fetch->Objeto);
                                    $pic = "data:image/jpg;charset=utf8;base64, $foto";
                                    $fetch = Utils::getImage($pic);
                                } else {
                                    $stmt = $this->db8->prepare(
                                        "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                    );
                                    $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                    $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                    $stmt->execute();
                                    $fetch = $stmt->fetchObject();
                                    if ($fetch) {
                                        $foto = base64_encode($fetch->Objeto);
                                        $pic = "data:image/jpg;charset=utf8;base64, $foto";
                                        $fetch = Utils::getImage($pic);
                                    } else {
                                        $stmt = $this->db9->prepare(
                                            "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                        );
                                        $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                        $stmt->execute();
                                        $fetch = $stmt->fetchObject();
                                        if ($fetch) {
                                            $foto = base64_encode($fetch->Objeto);
                                            $pic = "data:image/jpg;charset=utf8;base64, $foto";
                                            $fetch = Utils::getImage($pic);
                                        } else {
                                            $stmt = $this->db10->prepare(
                                                "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                            );
                                            $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                            $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                            $stmt->execute();
                                            $fetch = $stmt->fetchObject();
                                            if ($fetch) {
                                                $foto = base64_encode($fetch->Objeto);
                                                $pic = "data:image/jpg;charset=utf8;base64, $foto";
                                                $fetch = Utils::getImage($pic);
                                            } else {
                                                $stmt = $this->db11->prepare(
                                                    "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                                );
                                                $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                $stmt->execute();
                                                $fetch = $stmt->fetchObject();
                                                if ($fetch) {
                                                    $foto = base64_encode($fetch->Objeto);
                                                    $pic = "data:image/jpg;charset=utf8;base64, $foto";
                                                    $fetch = Utils::getImage($pic);
                                                } else {
                                                    $stmt = $this->db12->prepare(
                                                        "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                                    );
                                                    $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                    $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                    $stmt->execute();
                                                    $fetch = $stmt->fetchObject();
                                                    if ($fetch) {
                                                        $foto = base64_encode($fetch->Objeto);
                                                        $pic = "data:image/jpg;charset=utf8;base64, $foto";
                                                        $fetch = Utils::getImage($pic);
                                                    } else {
                                                        $stmt = $this->db13->prepare(
                                                            "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                                        );
                                                        $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                        $stmt->execute();
                                                        $fetch = $stmt->fetchObject();
                                                        if ($fetch) {
                                                            $foto = base64_encode($fetch->Objeto);
                                                            $pic = "data:image/jpg;charset=utf8;base64, $foto";
                                                            $fetch = Utils::getImage($pic);
                                                        } else {
                                                            $stmt = $this->db14->prepare(
                                                                "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                                            );
                                                            $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                            $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                            $stmt->execute();
                                                            $fetch = $stmt->fetchObject();
                                                            if ($fetch) {
                                                                $foto = base64_encode($fetch->Objeto);
                                                                $pic = "data:image/jpg;charset=utf8;base64, $foto";
                                                                $fetch = Utils::getImage($pic);
                                                            } else {
                                                                $stmt = $this->db15->prepare(
                                                                    "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                                                );
                                                                $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                                $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                                $stmt->execute();
                                                                $fetch = $stmt->fetchObject();
                                                                if ($fetch) {
                                                                    $foto = base64_encode($fetch->Objeto);
                                                                    $pic = "data:image/jpg;charset=utf8;base64, $foto";
                                                                    $fetch = Utils::getImage($pic);
                                                                } else {
                                                                    $stmt = $this->db16->prepare(
                                                                        "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                                                    );
                                                                    $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                                    $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                                    $stmt->execute();
                                                                    $fetch = $stmt->fetchObject();
                                                                    if ($fetch) {
                                                                        $foto = base64_encode($fetch->Objeto);
                                                                        $pic = "data:image/jpg;charset=utf8;base64, $foto";
                                                                        $fetch = Utils::getImage($pic);
                                                                    } else {
                                                                        $stmt = $this->db17->prepare(
                                                                            "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                                                        );
                                                                        $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                                        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                                        $stmt->execute();
                                                                        $fetch = $stmt->fetchObject();
                                                                        if ($fetch) {
                                                                            $foto = base64_encode($fetch->Objeto);
                                                                            $pic = "data:image/jpg;charset=utf8;base64, $foto";
                                                                            $fetch = Utils::getImage($pic);
                                                                        } else
                                                                            $fetch = false;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $fetch;
    }

    /**
     * 
     *
     */
    public function deleteNumeroExteriorDomicilio()
    {
        $result = false;

        $Candidato = $this->getCandidato();
        $Tabla = $this->getTabla();

        $stmt = $this->db->prepare(
            "DELETE FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
        } else {
            $stmt = $this->db2->prepare(
                "DELETE FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
            );
            $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
            $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
            $flag = $stmt->execute();
            if ($flag) {
                $result = true;
            }
            /** En caso de emergencia */
            else {
                $stmt = $this->db3->prepare(
                    "DELETE FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
                );
                $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                $flag = $stmt->execute();
                if ($flag) {
                    $result = true;
                } else {
                    $stmt = $this->db4->prepare(
                        "DELETE FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
                    );
                    $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                    $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                    $flag = $stmt->execute();
                    if ($flag) {
                        $result = true;
                    } else {
                        $stmt = $this->db5->prepare(
                            "DELETE FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
                        );
                        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                        $flag = $stmt->execute();
                        if ($flag) {
                            $result = true;
                        } else {
                            $stmt = $this->db6->prepare(
                                "DELETE FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
                            );
                            $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                            $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                            $flag = $stmt->execute();
                            if ($flag) {
                                $result = true;
                            } else {
                                $stmt = $this->db7->prepare(
                                    "DELETE FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
                                );
                                $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                $flag = $stmt->execute();
                                if ($flag) {
                                    $result = true;
                                } else {
                                    $stmt = $this->db8->prepare(
                                        "DELETE FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
                                    );
                                    $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                    $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                    $flag = $stmt->execute();
                                    if ($flag) {
                                        $result = true;
                                    } else {
                                        $stmt = $this->db9->prepare(
                                            "DELETE FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
                                        );
                                        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                        $flag = $stmt->execute();
                                        if ($flag) {
                                            $result = true;
                                        } else {
                                            $stmt = $this->db10->prepare(
                                                "DELETE FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
                                            );
                                            $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                            $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                            $flag = $stmt->execute();
                                            if ($flag) {
                                                $result = true;
                                            } else {
                                                $stmt = $this->db11->prepare(
                                                    "DELETE FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
                                                );
                                                $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                                $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                $flag = $stmt->execute();
                                                if ($flag) {
                                                    $result = true;
                                                } else {
                                                    $stmt = $this->db12->prepare(
                                                        "DELETE FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
                                                    );
                                                    $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                                    $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                    $flag = $stmt->execute();
                                                    if ($flag) {
                                                        $result = true;
                                                    } else {
                                                        $stmt = $this->db13->prepare(
                                                            "DELETE FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
                                                        );
                                                        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                                        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                        $flag = $stmt->execute();
                                                        if ($flag) {
                                                            $result = true;
                                                        } else {
                                                            $stmt = $this->db14->prepare(
                                                                "DELETE FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
                                                            );
                                                            $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                                            $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                            $flag = $stmt->execute();
                                                            if ($flag) {
                                                                $result = true;
                                                            } else {
                                                                $stmt = $this->db15->prepare(
                                                                    "DELETE FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
                                                                );
                                                                $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                                                $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                                $flag = $stmt->execute();
                                                                if ($flag) {
                                                                    $result = true;
                                                                } else {
                                                                    $stmt = $this->db16->prepare(
                                                                        "DELETE FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
                                                                    );
                                                                    $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                                                    $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                                    $flag = $stmt->execute();
                                                                    if ($flag) {
                                                                        $result = true;
                                                                    } else {
                                                                        $stmt = $this->db17->prepare(
                                                                            "DELETE FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
                                                                        );
                                                                        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                                                        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                                        $flag = $stmt->execute();
                                                                        if ($flag) {
                                                                            $result = true;
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $result;
    }

    public function deleteExteriorDomicilio()
    {
        $result = false;

        $Folio_Origen = $this->getFolio_Origen();
        $Tabla = $this->getTabla();

        $stmt = $this->db->prepare(
            "DELETE FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
        );
        $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
        } else {
            $stmt = $this->db2->prepare(
                "DELETE FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
            );
            $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
            $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
            $flag = $stmt->execute();
            if ($flag) {
                $result = true;
            }
            /** En caso de emergencia */
            else {
                $stmt = $this->db3->prepare(
                    "DELETE FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                );
                $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                $flag = $stmt->execute();
                if ($flag) {
                    $result = true;
                } else {
                    $stmt = $this->db4->prepare(
                        "DELETE FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                    );
                    $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                    $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                    $flag = $stmt->execute();
                    if ($flag) {
                        $result = true;
                    } else {
                        $stmt = $this->db5->prepare(
                            "DELETE FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                        );
                        $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                        $flag = $stmt->execute();
                        if ($flag) {
                            $result = true;
                        } else {
                            $stmt = $this->db6->prepare(
                                "DELETE FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                            );
                            $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                            $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                            $flag = $stmt->execute();
                            if ($flag) {
                                $result = true;
                            } else {
                                $stmt = $this->db7->prepare(
                                    "DELETE FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                );
                                $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                $flag = $stmt->execute();
                                if ($flag) {
                                    $result = true;
                                } else {
                                    $stmt = $this->db8->prepare(
                                        "DELETE FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                    );
                                    $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                    $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                    $flag = $stmt->execute();
                                    if ($flag) {
                                        $result = true;
                                    } else {
                                        $stmt = $this->db9->prepare(
                                            "DELETE FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                        );
                                        $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                        $flag = $stmt->execute();
                                        if ($flag) {
                                            $result = true;
                                        } else {
                                            $stmt = $this->db10->prepare(
                                                "DELETE FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                            );
                                            $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                            $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                            $flag = $stmt->execute();
                                            if ($flag) {
                                                $result = true;
                                            } else {
                                                $stmt = $this->db11->prepare(
                                                    "DELETE FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                                );
                                                $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                $flag = $stmt->execute();
                                                if ($flag) {
                                                    $result = true;
                                                } else {
                                                    $stmt = $this->db12->prepare(
                                                        "DELETE FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                                    );
                                                    $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                    $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                    $flag = $stmt->execute();
                                                    if ($flag) {
                                                        $result = true;
                                                    } else {
                                                        $stmt = $this->db13->prepare(
                                                            "DELETE FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                                        );
                                                        $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                        $flag = $stmt->execute();
                                                        if ($flag) {
                                                            $result = true;
                                                        } else {
                                                            $stmt = $this->db14->prepare(
                                                                "DELETE FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                                            );
                                                            $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                            $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                            $flag = $stmt->execute();
                                                            if ($flag) {
                                                                $result = true;
                                                            } else {
                                                                $stmt = $this->db15->prepare(
                                                                    "DELETE FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                                                );
                                                                $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                                $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                                $flag = $stmt->execute();
                                                                if ($flag) {
                                                                    $result = true;
                                                                } else {
                                                                    $stmt = $this->db16->prepare(
                                                                        "DELETE FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                                                    );
                                                                    $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                                    $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                                    $flag = $stmt->execute();
                                                                    if ($flag) {
                                                                        $result = true;
                                                                    }else {
                                                                        $stmt = $this->db17->prepare(
                                                                            "DELETE FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                                                        );
                                                                        $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                                        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                                        $flag = $stmt->execute();
                                                                        if ($flag) {
                                                                            $result = true;
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $result;
    }

    /**
     * 
     * 
     */

    public function getExteriorNoDomicilioID()
    {
        $Candidato = $this->getCandidato();
        $Tabla = $this->getTabla();

        $stmt = $this->db->prepare(
            "SELECT Imagen FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        if ($fetch) {
            return $fetch->Imagen;
        } else {
            $stmt = $this->db2->prepare(
                "SELECT Imagen FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
            );
            $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
            $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
            $stmt->execute();
            $fetch = $stmt->fetchObject();
            if ($fetch) {
                return $fetch->Imagen;
            } else {
                /** En caso de emergencia */
                $stmt = $this->db3->prepare(
                    "SELECT Imagen FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
                );
                $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                $stmt->execute();
                $fetch = $stmt->fetchObject();
                if ($fetch) {
                    return $fetch->Imagen;
                } else {
                    $stmt = $this->db4->prepare(
                        "SELECT Imagen FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
                    );
                    $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                    $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                    $stmt->execute();
                    $fetch = $stmt->fetchObject();
                    if ($fetch) {
                        return $fetch->Imagen;
                    } else {
                        $stmt = $this->db5->prepare(
                            "SELECT Imagen FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
                        );
                        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                        $stmt->execute();
                        $fetch = $stmt->fetchObject();
                        if ($fetch) {
                            return $fetch->Imagen;
                        } else {
                            $stmt = $this->db6->prepare(
                                "SELECT Imagen FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
                            );
                            $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                            $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                            $stmt->execute();
                            $fetch = $stmt->fetchObject();
                            if ($fetch) {
                                return $fetch->Imagen;
                            } else {
                                $stmt = $this->db7->prepare(
                                    "SELECT Imagen FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
                                );
                                $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                $stmt->execute();
                                $fetch = $stmt->fetchObject();
                                if ($fetch) {
                                    return $fetch->Imagen;
                                } else {
                                    $stmt = $this->db8->prepare(
                                        "SELECT Imagen FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
                                    );
                                    $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                    $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                    $stmt->execute();
                                    $fetch = $stmt->fetchObject();
                                    if ($fetch) {
                                        return $fetch->Imagen;
                                    } else {
                                        $stmt = $this->db9->prepare(
                                            "SELECT Imagen FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
                                        );
                                        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                        $stmt->execute();
                                        $fetch = $stmt->fetchObject();
                                        if ($fetch) {
                                            return $fetch->Imagen;
                                        } else {
                                            $stmt = $this->db10->prepare(
                                                "SELECT Imagen FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
                                            );
                                            $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                            $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                            $stmt->execute();
                                            $fetch = $stmt->fetchObject();
                                            if ($fetch) {
                                                return $fetch->Imagen;
                                            } else {
                                                $stmt = $this->db11->prepare(
                                                    "SELECT Imagen FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
                                                );
                                                $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                                $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                $stmt->execute();
                                                $fetch = $stmt->fetchObject();
                                                if ($fetch) {
                                                    return $fetch->Imagen;
                                                } else {
                                                    $stmt = $this->db12->prepare(
                                                        "SELECT Imagen FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
                                                    );
                                                    $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                                    $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                    $stmt->execute();
                                                    $fetch = $stmt->fetchObject();
                                                    if ($fetch) {
                                                        return $fetch->Imagen;
                                                    } else {
                                                        $stmt = $this->db13->prepare(
                                                            "SELECT Imagen FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
                                                        );
                                                        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                                        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                        $stmt->execute();
                                                        $fetch = $stmt->fetchObject();
                                                        if ($fetch) {
                                                            return $fetch->Imagen;
                                                        } else {
                                                            $stmt = $this->db14->prepare(
                                                                "SELECT Imagen FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
                                                            );
                                                            $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                                            $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                            $stmt->execute();
                                                            $fetch = $stmt->fetchObject();
                                                            if ($fetch) {
                                                                return $fetch->Imagen;
                                                            } else {
                                                                $stmt = $this->db15->prepare(
                                                                    "SELECT Imagen FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
                                                                );
                                                                $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                                                $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                                $stmt->execute();
                                                                $fetch = $stmt->fetchObject();
                                                                if ($fetch) {
                                                                    return $fetch->Imagen;
                                                                } else {
                                                                    $stmt = $this->db16->prepare(
                                                                        "SELECT Imagen FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
                                                                    );
                                                                    $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                                                    $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                                    $stmt->execute();
                                                                    $fetch = $stmt->fetchObject();
                                                                    if ($fetch) {
                                                                        return $fetch->Imagen;
                                                                    }  else {
                                                                        $stmt = $this->db17->prepare(
                                                                            "SELECT Imagen FROM cfg_Imagenes WHERE Candidato=:Candidato AND Tabla=:Tabla"
                                                                        );
                                                                        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                                                        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                                        $stmt->execute();
                                                                        $fetch = $stmt->fetchObject();
                                                                        if ($fetch) {
                                                                            return $fetch->Imagen;
                                                                        } else
                                                                            return false;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public function getExteriorDomicilioID()
    {
        $Folio_Origen = $this->getFolio_Origen();
        $Tabla = $this->getTabla();

        $stmt = $this->db->prepare(
            "SELECT Imagen FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
        );
        $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        if ($fetch) {
            return $fetch->Imagen;
        } else {
            $stmt = $this->db2->prepare(
                "SELECT Imagen FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
            );
            $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
            $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
            $stmt->execute();
            $fetch = $stmt->fetchObject();
            if ($fetch) {
                return $fetch->Imagen;
            } else {
                /** En caso de emergencia */
                $stmt = $this->db3->prepare(
                    "SELECT Imagen FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                );
                $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                $stmt->execute();
                $fetch = $stmt->fetchObject();
                if ($fetch) {
                    return $fetch->Imagen;
                } else {
                    $stmt = $this->db4->prepare(
                        "SELECT Imagen FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                    );
                    $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                    $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                    $stmt->execute();
                    $fetch = $stmt->fetchObject();
                    if ($fetch) {
                        return $fetch->Imagen;
                    } else {
                        $stmt = $this->db5->prepare(
                            "SELECT Imagen FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                        );
                        $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                        $stmt->execute();
                        $fetch = $stmt->fetchObject();
                        if ($fetch) {
                            return $fetch->Imagen;
                        } else {
                            $stmt = $this->db6->prepare(
                                "SELECT Imagen FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                            );
                            $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                            $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                            $stmt->execute();
                            $fetch = $stmt->fetchObject();
                            if ($fetch) {
                                return $fetch->Imagen;
                            } else {
                                $stmt = $this->db7->prepare(
                                    "SELECT Imagen FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                );
                                $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                $stmt->execute();
                                $fetch = $stmt->fetchObject();
                                if ($fetch) {
                                    return $fetch->Imagen;
                                } else {
                                    $stmt = $this->db8->prepare(
                                        "SELECT Imagen FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                    );
                                    $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                    $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                    $stmt->execute();
                                    $fetch = $stmt->fetchObject();
                                    if ($fetch) {
                                        return $fetch->Imagen;
                                    } else {
                                        $stmt = $this->db9->prepare(
                                            "SELECT Imagen FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                        );
                                        $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                        $stmt->execute();
                                        $fetch = $stmt->fetchObject();
                                        if ($fetch) {
                                            return $fetch->Imagen;
                                        } else {
                                            $stmt = $this->db10->prepare(
                                                "SELECT Imagen FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                            );
                                            $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                            $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                            $stmt->execute();
                                            $fetch = $stmt->fetchObject();
                                            if ($fetch) {
                                                return $fetch->Imagen;
                                            } else {
                                                $stmt = $this->db11->prepare(
                                                    "SELECT Imagen FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                                );
                                                $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                $stmt->execute();
                                                $fetch = $stmt->fetchObject();
                                                if ($fetch) {
                                                    return $fetch->Imagen;
                                                } else {
                                                    $stmt = $this->db12->prepare(
                                                        "SELECT Imagen FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                                    );
                                                    $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                    $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                    $stmt->execute();
                                                    $fetch = $stmt->fetchObject();
                                                    if ($fetch) {
                                                        return $fetch->Imagen;
                                                    } else {
                                                        $stmt = $this->db13->prepare(
                                                            "SELECT Imagen FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                                        );
                                                        $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                        $stmt->execute();
                                                        $fetch = $stmt->fetchObject();
                                                        if ($fetch) {
                                                            return $fetch->Imagen;
                                                        } else {
                                                            $stmt = $this->db14->prepare(
                                                                "SELECT Imagen FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                                            );
                                                            $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                            $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                            $stmt->execute();
                                                            $fetch = $stmt->fetchObject();
                                                            if ($fetch) {
                                                                return $fetch->Imagen;
                                                            } else {
                                                                $stmt = $this->db15->prepare(
                                                                    "SELECT Imagen FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                                                );
                                                                $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                                $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                                $stmt->execute();
                                                                $fetch = $stmt->fetchObject();
                                                                if ($fetch) {
                                                                    return $fetch->Imagen;
                                                                } else {
                                                                    $stmt = $this->db16->prepare(
                                                                        "SELECT Imagen FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                                                    );
                                                                    $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                                    $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                                    $stmt->execute();
                                                                    $fetch = $stmt->fetchObject();
                                                                    if ($fetch) {
                                                                        return $fetch->Imagen;
                                                                    } else {
                                                                        $stmt = $this->db17->prepare(
                                                                            "SELECT Imagen FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla"
                                                                        );
                                                                        $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                                        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
                                                                        $stmt->execute();
                                                                        $fetch = $stmt->fetchObject();
                                                                        if ($fetch) {
                                                                            return $fetch->Imagen;
                                                                        } else
                                                                            return false;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public function getDocumento()
    {
        $Folio_Origen = $this->getFolio_Origen();
        $Candidato = $this->getCandidato();

        $stmt = $this->db->prepare(
            "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Candidato=:Candidato"
        );
        $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        if ($fetch) {
            $foto = base64_encode($fetch->Objeto);
            $pic = "data:image/jpg;base64, $foto";
            $fetch = Utils::getImage($pic);
        } else {
            $stmt = $this->db2->prepare(
                "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Candidato=:Candidato"
            );
            $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
            $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
            $stmt->execute();
            $fetch = $stmt->fetchObject();
            if ($fetch) {
                $foto = base64_encode($fetch->Objeto);
                $pic = "data:image/jpg;base64, $foto";
                $fetch = Utils::getImage($pic);
            } else {
                /** En caso de emergencia */
                $stmt = $this->db3->prepare(
                    "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Candidato=:Candidato"
                );
                $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                $stmt->execute();
                $fetch = $stmt->fetchObject();
                if ($fetch) {
                    $foto = base64_encode($fetch->Objeto);
                    $pic = "data:image/jpg;base64, $foto";
                    $fetch = Utils::getImage($pic);
                } else {
                    $stmt = $this->db4->prepare(
                        "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Candidato=:Candidato"
                    );
                    $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                    $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                    $stmt->execute();
                    $fetch = $stmt->fetchObject();
                    if ($fetch) {
                        $foto = base64_encode($fetch->Objeto);
                        $pic = "data:image/jpg;base64, $foto";
                        $fetch = Utils::getImage($pic);
                    } else {
                        $stmt = $this->db5->prepare(
                            "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Candidato=:Candidato"
                        );
                        $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                        $stmt->execute();
                        $fetch = $stmt->fetchObject();
                        if ($fetch) {
                            $foto = base64_encode($fetch->Objeto);
                            $pic = "data:image/jpg;base64, $foto";
                            $fetch = Utils::getImage($pic);
                        } else {
                            $stmt = $this->db6->prepare(
                                "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Candidato=:Candidato"
                            );
                            $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                            $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                            $stmt->execute();
                            $fetch = $stmt->fetchObject();
                            if ($fetch) {
                                $foto = base64_encode($fetch->Objeto);
                                $pic = "data:image/jpg;base64, $foto";
                                $fetch = Utils::getImage($pic);
                            } else {
                                $stmt = $this->db7->prepare(
                                    "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Candidato=:Candidato"
                                );
                                $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                $stmt->execute();
                                $fetch = $stmt->fetchObject();
                                if ($fetch) {
                                    $foto = base64_encode($fetch->Objeto);
                                    $pic = "data:image/jpg;base64, $foto";
                                    $fetch = Utils::getImage($pic);
                                } else {
                                    $stmt = $this->db8->prepare(
                                        "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Candidato=:Candidato"
                                    );
                                    $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                    $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                    $stmt->execute();
                                    $fetch = $stmt->fetchObject();
                                    if ($fetch) {
                                        $foto = base64_encode($fetch->Objeto);
                                        $pic = "data:image/jpg;base64, $foto";
                                        $fetch = Utils::getImage($pic);
                                    } else {
                                        $stmt = $this->db9->prepare(
                                            "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Candidato=:Candidato"
                                        );
                                        $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                        $stmt->execute();
                                        $fetch = $stmt->fetchObject();
                                        if ($fetch) {
                                            $foto = base64_encode($fetch->Objeto);
                                            $pic = "data:image/jpg;base64, $foto";
                                            $fetch = Utils::getImage($pic);
                                        } else {
                                            $stmt = $this->db10->prepare(
                                                "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Candidato=:Candidato"
                                            );
                                            $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                            $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                            $stmt->execute();
                                            $fetch = $stmt->fetchObject();
                                            if ($fetch) {
                                                $foto = base64_encode($fetch->Objeto);
                                                $pic = "data:image/jpg;base64, $foto";
                                                $fetch = Utils::getImage($pic);
                                            } else {
                                                $stmt = $this->db11->prepare(
                                                    "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Candidato=:Candidato"
                                                );
                                                $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                                $stmt->execute();
                                                $fetch = $stmt->fetchObject();
                                                if ($fetch) {
                                                    $foto = base64_encode($fetch->Objeto);
                                                    $pic = "data:image/jpg;base64, $foto";
                                                    $fetch = Utils::getImage($pic);
                                                } else {
                                                    $stmt = $this->db12->prepare(
                                                        "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Candidato=:Candidato"
                                                    );
                                                    $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                    $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                                    $stmt->execute();
                                                    $fetch = $stmt->fetchObject();
                                                    if ($fetch) {
                                                        $foto = base64_encode($fetch->Objeto);
                                                        $pic = "data:image/jpg;base64, $foto";
                                                        $fetch = Utils::getImage($pic);
                                                    } else {
                                                        $stmt = $this->db13->prepare(
                                                            "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Candidato=:Candidato"
                                                        );
                                                        $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                                        $stmt->execute();
                                                        $fetch = $stmt->fetchObject();
                                                        if ($fetch) {
                                                            $foto = base64_encode($fetch->Objeto);
                                                            $pic = "data:image/jpg;base64, $foto";
                                                            $fetch = Utils::getImage($pic);
                                                        } else {
                                                            $stmt = $this->db14->prepare(
                                                                "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Candidato=:Candidato"
                                                            );
                                                            $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                            $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                                            $stmt->execute();
                                                            $fetch = $stmt->fetchObject();
                                                            if ($fetch) {
                                                                $foto = base64_encode($fetch->Objeto);
                                                                $pic = "data:image/jpg;base64, $foto";
                                                                $fetch = Utils::getImage($pic);
                                                            } else {
                                                                $stmt = $this->db15->prepare(
                                                                    "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Candidato=:Candidato"
                                                                );
                                                                $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                                $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                                                $stmt->execute();
                                                                $fetch = $stmt->fetchObject();
                                                                if ($fetch) {
                                                                    $foto = base64_encode($fetch->Objeto);
                                                                    $pic = "data:image/jpg;base64, $foto";
                                                                    $fetch = Utils::getImage($pic);
                                                                } else {
                                                                    $stmt = $this->db16->prepare(
                                                                        "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Candidato=:Candidato"
                                                                    );
                                                                    $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                                    $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                                                    $stmt->execute();
                                                                    $fetch = $stmt->fetchObject();
                                                                    if ($fetch) {
                                                                        $foto = base64_encode($fetch->Objeto);
                                                                        $pic = "data:image/jpg;base64, $foto";
                                                                        $fetch = Utils::getImage($pic);
                                                                    } else {
                                                                        $stmt = $this->db17->prepare(
                                                                            "SELECT Objeto FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Candidato=:Candidato"
                                                                        );
                                                                        $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                                        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                                                        $stmt->execute();
                                                                        $fetch = $stmt->fetchObject();
                                                                        if ($fetch) {
                                                                            $foto = base64_encode($fetch->Objeto);
                                                                            $pic = "data:image/jpg;base64, $foto";
                                                                            $fetch = Utils::getImage($pic);
                                                                        } else
                                                                            $fetch = false;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $fetch;
    }

    public function getDocumentosAdjuntos()
    {
        $Candidato = $this->getCandidato();
        $stmt = $this->db->prepare(
            "SELECT Folio_Origen FROM cfg_Imagenes WHERE Candidato=:Candidato AND Folio_Origen IN(269, 278, 271, 283, 285, 282, 295)"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $documentos = $stmt->fetchAll();
        if ($documentos) {
            $docs = [];
            foreach ($documentos as $documento) {
                array_push($docs, $documento['Folio_Origen']);
            }
            $documentos = $docs;
        }
        $stmt = $this->db2->prepare(
            "SELECT Folio_Origen FROM cfg_Imagenes WHERE Candidato=:Candidato AND Folio_Origen IN(269, 278, 271, 283, 285, 282, 295)"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $documentos2 = $stmt->fetchAll();
        if ($documentos2) {
            $docs = [];
            foreach ($documentos2 as $documento) {
                array_push($docs, $documento['Folio_Origen']);
            }
            $documentos2 = $docs;
        }
        /** En caso de emergencia */
        $stmt = $this->db3->prepare(
            "SELECT Folio_Origen FROM cfg_Imagenes WHERE Candidato=:Candidato AND Folio_Origen IN(269, 278, 271, 283, 285, 282, 295)"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $documentos3 = $stmt->fetchAll();
        if ($documentos3) {
            $docs = [];
            foreach ($documentos3 as $documento) {
                array_push($docs, $documento['Folio_Origen']);
            }
            $documentos3 = $docs;
        }

        $stmt = $this->db4->prepare(
            "SELECT Folio_Origen FROM cfg_Imagenes WHERE Candidato=:Candidato AND Folio_Origen IN(269, 278, 271, 283, 285, 282, 295)"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $documentos4 = $stmt->fetchAll();
        if ($documentos4) {
            $docs = [];
            foreach ($documentos4 as $documento) {
                array_push($docs, $documento['Folio_Origen']);
            }
            $documentos4 = $docs;
        }

        $stmt = $this->db5->prepare(
            "SELECT Folio_Origen FROM cfg_Imagenes WHERE Candidato=:Candidato AND Folio_Origen IN(269, 278, 271, 283, 285, 282, 295)"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $documentos5 = $stmt->fetchAll();
        if ($documentos5) {
            $docs = [];
            foreach ($documentos5 as $documento) {
                array_push($docs, $documento['Folio_Origen']);
            }
            $documentos5 = $docs;
        }

        $stmt = $this->db6->prepare(
            "SELECT Folio_Origen FROM cfg_Imagenes WHERE Candidato=:Candidato AND Folio_Origen IN(269, 278, 271, 283, 285, 282, 295)"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $documentos6 = $stmt->fetchAll();
        if ($documentos6) {
            $docs = [];
            foreach ($documentos6 as $documento) {
                array_push($docs, $documento['Folio_Origen']);
            }
            $documentos6 = $docs;
        }

        $stmt = $this->db7->prepare(
            "SELECT Folio_Origen FROM cfg_Imagenes WHERE Candidato=:Candidato AND Folio_Origen IN(269, 278, 271, 283, 285, 282, 295)"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $documentos7 = $stmt->fetchAll();
        if ($documentos7) {
            $docs = [];
            foreach ($documentos7 as $documento) {
                array_push($docs, $documento['Folio_Origen']);
            }
            $documentos7 = $docs;
        }

        $stmt = $this->db8->prepare(
            "SELECT Folio_Origen FROM cfg_Imagenes WHERE Candidato=:Candidato AND Folio_Origen IN(269, 278, 271, 283, 285, 282, 295)"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $documentos8 = $stmt->fetchAll();
        if ($documentos8) {
            $docs = [];
            foreach ($documentos8 as $documento) {
                array_push($docs, $documento['Folio_Origen']);
            }
            $documentos8 = $docs;
        }

        $stmt = $this->db9->prepare(
            "SELECT Folio_Origen FROM cfg_Imagenes WHERE Candidato=:Candidato AND Folio_Origen IN(269, 278, 271, 283, 285, 282, 295)"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $documentos9 = $stmt->fetchAll();
        if ($documentos9) {
            $docs = [];
            foreach ($documentos9 as $documento) {
                array_push($docs, $documento['Folio_Origen']);
            }
            $documentos9 = $docs;
        }

        $stmt = $this->db10->prepare(
            "SELECT Folio_Origen FROM cfg_Imagenes WHERE Candidato=:Candidato AND Folio_Origen IN(269, 278, 271, 283, 285, 282, 295)"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $documentos10 = $stmt->fetchAll();
        if ($documentos10) {
            $docs = [];
            foreach ($documentos10 as $documento) {
                array_push($docs, $documento['Folio_Origen']);
            }
            $documentos10 = $docs;
        }

        $stmt = $this->db11->prepare(
            "SELECT Folio_Origen FROM cfg_Imagenes WHERE Candidato=:Candidato AND Folio_Origen IN(269, 278, 271, 283, 285, 282, 295)"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $documentos11 = $stmt->fetchAll();
        if ($documentos11) {
            $docs = [];
            foreach ($documentos11 as $documento) {
                array_push($docs, $documento['Folio_Origen']);
            }
            $documentos11 = $docs;
        }

        $stmt = $this->db12->prepare(
            "SELECT Folio_Origen FROM cfg_Imagenes WHERE Candidato=:Candidato AND Folio_Origen IN(269, 278, 271, 283, 285, 282, 295)"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $documentos12 = $stmt->fetchAll();
        if ($documentos12) {
            $docs = [];
            foreach ($documentos12 as $documento) {
                array_push($docs, $documento['Folio_Origen']);
            }
            $documentos12 = $docs;
        }

        $stmt = $this->db13->prepare(
            "SELECT Folio_Origen FROM cfg_Imagenes WHERE Candidato=:Candidato AND Folio_Origen IN(269, 278, 271, 283, 285, 282, 295)"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $documentos13 = $stmt->fetchAll();
        if ($documentos13) {
            $docs = [];
            foreach ($documentos13 as $documento) {
                array_push($docs, $documento['Folio_Origen']);
            }
            $documentos13 = $docs;
        }

        $stmt = $this->db14->prepare(
            "SELECT Folio_Origen FROM cfg_Imagenes WHERE Candidato=:Candidato AND Folio_Origen IN(269, 278, 271, 283, 285, 282, 295)"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $documentos14 = $stmt->fetchAll();
        if ($documentos14) {
            $docs = [];
            foreach ($documentos14 as $documento) {
                array_push($docs, $documento['Folio_Origen']);
            }
            $documentos14 = $docs;
        }


        $stmt = $this->db15->prepare(
            "SELECT Folio_Origen FROM cfg_Imagenes WHERE Candidato=:Candidato AND Folio_Origen IN(269, 278, 271, 283, 285, 282, 295)"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $documentos15 = $stmt->fetchAll();
        if ($documentos15) {
            $docs = [];
            foreach ($documentos15 as $documento) {
                array_push($docs, $documento['Folio_Origen']);
            }
            $documentos15 = $docs;
        }


        $stmt = $this->db16->prepare(
            "SELECT Folio_Origen FROM cfg_Imagenes WHERE Candidato=:Candidato AND Folio_Origen IN(269, 278, 271, 283, 285, 282, 295)"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $documentos16 = $stmt->fetchAll();
        if ($documentos16) {
            $docs = [];
            foreach ($documentos16 as $documento) {
                array_push($docs, $documento['Folio_Origen']);
            }
            $documentos16 = $docs;
        }

        $stmt = $this->db17->prepare(
            "SELECT Folio_Origen FROM cfg_Imagenes WHERE Candidato=:Candidato AND Folio_Origen IN(269, 278, 271, 283, 285, 282, 295)"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $documentos17 = $stmt->fetchAll();
        if ($documentos17) {
            $docs = [];
            foreach ($documentos17 as $documento) {
                array_push($docs, $documento['Folio_Origen']);
            }
            $documentos17 = $docs;
        }
        //$documentos = array_merge($documentos, $documentos2, $documentos3);
        //$documentos = array_merge($documentos, $documentos2, $documentos3, $documentos4);
        //$documentos = array_merge($documentos, $documentos2, $documentos3, $documentos4, $documentos5);
        //$documentos = array_merge($documentos, $documentos2, $documentos3, $documentos4, $documentos5, $documentos6);
        //$documentos = array_merge($documentos, $documentos2, $documentos3, $documentos4, $documentos5, $documentos6, $documentos7);
        //$documentos = array_merge($documentos, $documentos2, $documentos3, $documentos4, $documentos5, $documentos6, $documentos7, $documentos8, $documentos9, $documentos10);
        //$documentos = array_merge($documentos, $documentos2, $documentos3, $documentos4, $documentos5, $documentos6, $documentos7, $documentos8, $documentos9, $documentos10, $documentos11);
        //$documentos = array_merge($documentos, $documentos2, $documentos3, $documentos4, $documentos5, $documentos6, $documentos7, $documentos8, $documentos9, $documentos10, $documentos11, $documentos12);
        //$documentos = array_merge($documentos, $documentos2, $documentos3, $documentos4, $documentos5, $documentos6, $documentos7, $documentos8, $documentos9, $documentos10, $documentos11, $documentos12, $documentos13);
        //$documentos = array_merge($documentos, $documentos2, $documentos3, $documentos4, $documentos5, $documentos6, $documentos7, $documentos8, $documentos9, $documentos10, $documentos11, $documentos12, $documentos13, $documentos14);
        //$documentos = array_merge($documentos, $documentos2, $documentos3, $documentos4, $documentos5, $documentos6, $documentos7, $documentos8, $documentos9, $documentos10, $documentos11, $documentos12, $documentos13, $documentos14, $documentos15);
        //$documentos = array_merge($documentos, $documentos2, $documentos3, $documentos4, $documentos5, $documentos6, $documentos7, $documentos8, $documentos9, $documentos10, $documentos11, $documentos12, $documentos13, $documentos14, $documentos15, $documentos16);
        $documentos = array_merge($documentos, $documentos2, $documentos3, $documentos4, $documentos5, $documentos6, $documentos7, $documentos8, $documentos9, $documentos10, $documentos11, $documentos12, $documentos13, $documentos14, $documentos15, $documentos16,$documentos17);
        //$documentos = array_merge($documentos, $documentos2);

        return $documentos;
    }

    public function getCapturasRALByCandidato()
    {
        $Candidato = $this->getCandidato();
        $stmt = $this->db->prepare("SELECT Imagen, Tabla, Folio_Origen, Archivo,  Candidato, Folio FROM cfg_Imagenes i WHERE Tabla='RAL' AND Candidato=:Candidato ORDER BY Folio");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $capturas = $stmt->fetchAll();
        if ($capturas) {
            for ($i = 0; $i < count($capturas); $i++) {
                $foto = base64_encode($capturas[$i]['Objeto']);
                echo $foto;
                $pic = "data:image/jpg;charset=utf8;base64, $foto";
                $capturas[$i]['Objeto'] = Utils::getImage($pic);
                echo '<br>' . Utils::getImage($pic);
            }
            die();
        }
        $stmt = $this->db2->prepare("SELECT Imagen, Tabla, Folio_Origen, Archivo,  Candidato, Folio FROM cfg_Imagenes i WHERE Tabla='RAL' AND Candidato=:Candidato ORDER BY Folio");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $capturas2 = $stmt->fetchAll();
        $stmt = $this->db3->prepare("SELECT Imagen, Tabla, Folio_Origen, Archivo,  Candidato, Folio FROM cfg_Imagenes i WHERE Tabla='RAL' AND Candidato=:Candidato ORDER BY Folio");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $capturas3 = $stmt->fetchAll();
        //$capturas = array_merge($capturas, $capturas2, $capturas3);
        $stmt = $this->db4->prepare("SELECT Imagen, Tabla, Folio_Origen, Archivo,  Candidato, Folio FROM cfg_Imagenes i WHERE Tabla='RAL' AND Candidato=:Candidato ORDER BY Folio");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $capturas4 = $stmt->fetchAll();

        $stmt = $this->db5->prepare("SELECT Imagen, Tabla, Folio_Origen, Archivo,  Candidato, Folio FROM cfg_Imagenes i WHERE Tabla='RAL' AND Candidato=:Candidato ORDER BY Folio");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $capturas5 = $stmt->fetchAll();

        $stmt = $this->db6->prepare("SELECT Imagen, Tabla, Folio_Origen, Archivo,  Candidato, Folio FROM cfg_Imagenes i WHERE Tabla='RAL' AND Candidato=:Candidato ORDER BY Folio");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $capturas6 = $stmt->fetchAll();

        $stmt = $this->db7->prepare("SELECT Imagen, Tabla, Folio_Origen, Archivo,  Candidato, Folio FROM cfg_Imagenes i WHERE Tabla='RAL' AND Candidato=:Candidato ORDER BY Folio");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $capturas7 = $stmt->fetchAll();

        $stmt = $this->db8->prepare("SELECT Imagen, Tabla, Folio_Origen, Archivo,  Candidato, Folio FROM cfg_Imagenes i WHERE Tabla='RAL' AND Candidato=:Candidato ORDER BY Folio");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $capturas8 = $stmt->fetchAll();

        $stmt = $this->db9->prepare("SELECT Imagen, Tabla, Folio_Origen, Archivo,  Candidato, Folio FROM cfg_Imagenes i WHERE Tabla='RAL' AND Candidato=:Candidato ORDER BY Folio");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $capturas9 = $stmt->fetchAll();

        $stmt = $this->db10->prepare("SELECT Imagen, Tabla, Folio_Origen, Archivo,  Candidato, Folio FROM cfg_Imagenes i WHERE Tabla='RAL' AND Candidato=:Candidato ORDER BY Folio");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $capturas10 = $stmt->fetchAll();

        $stmt = $this->db11->prepare("SELECT Imagen, Tabla, Folio_Origen, Archivo,  Candidato, Folio FROM cfg_Imagenes i WHERE Tabla='RAL' AND Candidato=:Candidato ORDER BY Folio");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $capturas11 = $stmt->fetchAll();

        $stmt = $this->db12->prepare("SELECT Imagen, Tabla, Folio_Origen, Archivo,  Candidato, Folio FROM cfg_Imagenes i WHERE Tabla='RAL' AND Candidato=:Candidato ORDER BY Folio");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $capturas12 = $stmt->fetchAll();

        $stmt = $this->db13->prepare("SELECT Imagen, Tabla, Folio_Origen, Archivo,  Candidato, Folio FROM cfg_Imagenes i WHERE Tabla='RAL' AND Candidato=:Candidato ORDER BY Folio");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $capturas13 = $stmt->fetchAll();

        $stmt = $this->db14->prepare("SELECT Imagen, Tabla, Folio_Origen, Archivo,  Candidato, Folio FROM cfg_Imagenes i WHERE Tabla='RAL' AND Candidato=:Candidato ORDER BY Folio");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $capturas14 = $stmt->fetchAll();

        $stmt = $this->db15->prepare("SELECT Imagen, Tabla, Folio_Origen, Archivo,  Candidato, Folio FROM cfg_Imagenes i WHERE Tabla='RAL' AND Candidato=:Candidato ORDER BY Folio");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $capturas15 = $stmt->fetchAll();

        $stmt = $this->db16->prepare("SELECT Imagen, Tabla, Folio_Origen, Archivo,  Candidato, Folio FROM cfg_Imagenes i WHERE Tabla='RAL' AND Candidato=:Candidato ORDER BY Folio");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $capturas16 = $stmt->fetchAll();

        $stmt = $this->db17->prepare("SELECT Imagen, Tabla, Folio_Origen, Archivo,  Candidato, Folio FROM cfg_Imagenes i WHERE Tabla='RAL' AND Candidato=:Candidato ORDER BY Folio");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $capturas17 = $stmt->fetchAll();

        $capturas = array_merge($capturas, $capturas2, $capturas3, $capturas4, $capturas5, $capturas6, $capturas7, $capturas8, $capturas9, $capturas10, $capturas11, $capturas12, $capturas13, $capturas14, $capturas15, $capturas16,$capturas17);

        //$capturas = array_merge($capturas, $capturas2);
        return $capturas;
    }

    public function getCapturasRALObjetoByCandidato()
    {
        $Candidato = $this->getCandidato();
        $stmt = $this->db->prepare("SELECT Objeto FROM cfg_Imagenes i WHERE Tabla='RAL' AND Candidato=:Candidato ORDER BY Folio");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $capturas = $stmt->fetchAll();
        if ($capturas) {
            for ($i = 0; $i < count($capturas); $i++) {
                $foto = base64_encode($capturas[$i]['Objeto']);
                $pic = "data:image/jpg;charset=utf8;base64, $foto";
                $capturas[$i] = NULL;
                $capturas[$i] = Utils::getImage($pic);
            }
        }
        $stmt = $this->db2->prepare("SELECT Objeto FROM cfg_Imagenes i WHERE Tabla='RAL' AND Candidato=:Candidato ORDER BY Folio");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $capturas2 = $stmt->fetchAll();
        if ($capturas2) {
            for ($i = 0; $i < count($capturas2); $i++) {
                $foto = base64_encode($capturas2[$i]['Objeto']);
                $pic = "data:image/jpg;charset=utf8;base64, $foto";
                $capturas2[$i] = NULL;
                $capturas2[$i] = Utils::getImage($pic);
            }
        }
        $stmt = $this->db3->prepare("SELECT Objeto FROM cfg_Imagenes i WHERE Tabla='RAL' AND Candidato=:Candidato ORDER BY Folio");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $capturas3 = $stmt->fetchAll();
        if ($capturas3) {
            for ($i = 0; $i < count($capturas3); $i++) {
                $foto = base64_encode($capturas3[$i]['Objeto']);
                $pic = "data:image/jpg;charset=utf8;base64, $foto";
                $capturas3[$i] = NULL;
                $capturas3[$i] = Utils::getImage($pic);
            }
        }
        $stmt = $this->db4->prepare("SELECT Objeto FROM cfg_Imagenes i WHERE Tabla='RAL' AND Candidato=:Candidato ORDER BY Folio");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $capturas4 = $stmt->fetchAll();
        if ($capturas4) {
            for ($i = 0; $i < count($capturas4); $i++) {
                $foto = base64_encode($capturas4[$i]['Objeto']);
                $pic = "data:image/jpg;charset=utf8;base64, $foto";
                $capturas4[$i] = NULL;
                $capturas4[$i] = Utils::getImage($pic);
            }
        }
        $stmt = $this->db5->prepare("SELECT Objeto FROM cfg_Imagenes i WHERE Tabla='RAL' AND Candidato=:Candidato ORDER BY Folio");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $capturas5 = $stmt->fetchAll();
        if ($capturas5) {
            for ($i = 0; $i < count($capturas5); $i++) {
                $foto = base64_encode($capturas5[$i]['Objeto']);
                $pic = "data:image/jpg;charset=utf8;base64, $foto";
                $capturas5[$i] = NULL;
                $capturas5[$i] = Utils::getImage($pic);
            }
        }
        $stmt = $this->db6->prepare("SELECT Objeto FROM cfg_Imagenes i WHERE Tabla='RAL' AND Candidato=:Candidato ORDER BY Folio");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $capturas6 = $stmt->fetchAll();
        if ($capturas6) {
            for ($i = 0; $i < count($capturas6); $i++) {
                $foto = base64_encode($capturas6[$i]['Objeto']);
                $pic = "data:image/jpg;charset=utf8;base64, $foto";
                $capturas6[$i] = NULL;
                $capturas6[$i] = Utils::getImage($pic);
            }
        }
        $stmt = $this->db7->prepare("SELECT Objeto FROM cfg_Imagenes i WHERE Tabla='RAL' AND Candidato=:Candidato ORDER BY Folio");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $capturas7 = $stmt->fetchAll();
        if ($capturas7) {
            for ($i = 0; $i < count($capturas7); $i++) {
                $foto = base64_encode($capturas7[$i]['Objeto']);
                $pic = "data:image/jpg;charset=utf8;base64, $foto";
                $capturas7[$i] = NULL;
                $capturas7[$i] = Utils::getImage($pic);
            }
        }
        $stmt = $this->db8->prepare("SELECT Objeto FROM cfg_Imagenes i WHERE Tabla='RAL' AND Candidato=:Candidato ORDER BY Folio");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $capturas8 = $stmt->fetchAll();
        if ($capturas8) {
            for ($i = 0; $i < count($capturas8); $i++) {
                $foto = base64_encode($capturas8[$i]['Objeto']);
                $pic = "data:image/jpg;charset=utf8;base64, $foto";
                $capturas8[$i] = NULL;
                $capturas8[$i] = Utils::getImage($pic);
            }
        }
        $stmt = $this->db9->prepare("SELECT Objeto FROM cfg_Imagenes i WHERE Tabla='RAL' AND Candidato=:Candidato ORDER BY Folio");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $capturas9 = $stmt->fetchAll();
        if ($capturas9) {
            for ($i = 0; $i < count($capturas9); $i++) {
                $foto = base64_encode($capturas9[$i]['Objeto']);
                $pic = "data:image/jpg;charset=utf8;base64, $foto";
                $capturas9[$i] = NULL;
                $capturas9[$i] = Utils::getImage($pic);
            }
        }
        $stmt = $this->db10->prepare("SELECT Objeto FROM cfg_Imagenes i WHERE Tabla='RAL' AND Candidato=:Candidato ORDER BY Folio");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $capturas10 = $stmt->fetchAll();
        if ($capturas10) {
            for ($i = 0; $i < count($capturas10); $i++) {
                $foto = base64_encode($capturas10[$i]['Objeto']);
                $pic = "data:image/jpg;charset=utf8;base64, $foto";
                $capturas10[$i] = NULL;
                $capturas10[$i] = Utils::getImage($pic);
            }
        }
        $stmt = $this->db11->prepare("SELECT Objeto FROM cfg_Imagenes i WHERE Tabla='RAL' AND Candidato=:Candidato ORDER BY Folio");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $capturas11 = $stmt->fetchAll();
        if ($capturas11) {
            for ($i = 0; $i < count($capturas11); $i++) {
                $foto = base64_encode($capturas11[$i]['Objeto']);
                $pic = "data:image/jpg;charset=utf8;base64, $foto";
                $capturas11[$i] = NULL;
                $capturas11[$i] = Utils::getImage($pic);
            }
        }
        $stmt = $this->db12->prepare("SELECT Objeto FROM cfg_Imagenes i WHERE Tabla='RAL' AND Candidato=:Candidato ORDER BY Folio");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $capturas12 = $stmt->fetchAll();
        if ($capturas12) {
            for ($i = 0; $i < count($capturas12); $i++) {
                $foto = base64_encode($capturas12[$i]['Objeto']);
                $pic = "data:image/jpg;charset=utf8;base64, $foto";
                $capturas12[$i] = NULL;
                $capturas12[$i] = Utils::getImage($pic);
            }
        }
        $stmt = $this->db13->prepare("SELECT Objeto FROM cfg_Imagenes i WHERE Tabla='RAL' AND Candidato=:Candidato ORDER BY Folio");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $capturas13 = $stmt->fetchAll();
        if ($capturas13) {
            for ($i = 0; $i < count($capturas13); $i++) {
                $foto = base64_encode($capturas13[$i]['Objeto']);
                $pic = "data:image/jpg;charset=utf8;base64, $foto";
                $capturas13[$i] = NULL;
                $capturas13[$i] = Utils::getImage($pic);
            }
        }
        $stmt = $this->db14->prepare("SELECT Objeto FROM cfg_Imagenes i WHERE Tabla='RAL' AND Candidato=:Candidato ORDER BY Folio");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $capturas14 = $stmt->fetchAll();
        if ($capturas14) {
            for ($i = 0; $i < count($capturas14); $i++) {
                $foto = base64_encode($capturas14[$i]['Objeto']);
                $pic = "data:image/jpg;charset=utf8;base64, $foto";
                $capturas14[$i] = NULL;
                $capturas14[$i] = Utils::getImage($pic);
            }
        }
        $stmt = $this->db15->prepare("SELECT Objeto FROM cfg_Imagenes i WHERE Tabla='RAL' AND Candidato=:Candidato ORDER BY Folio");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $capturas15 = $stmt->fetchAll();
        if ($capturas15) {
            for ($i = 0; $i < count($capturas15); $i++) {
                $foto = base64_encode($capturas15[$i]['Objeto']);
                $pic = "data:image/jpg;charset=utf8;base64, $foto";
                $capturas15[$i] = NULL;
                $capturas15[$i] = Utils::getImage($pic);
            }
        }

        $stmt = $this->db16->prepare("SELECT Objeto FROM cfg_Imagenes i WHERE Tabla='RAL' AND Candidato=:Candidato ORDER BY Folio");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $capturas16 = $stmt->fetchAll();
        if ($capturas16) {
            for ($i = 0; $i < count($capturas16); $i++) {
                $foto = base64_encode($capturas16[$i]['Objeto']);
                $pic = "data:image/jpg;charset=utf8;base64, $foto";
                $capturas16[$i] = NULL;
                $capturas16[$i] = Utils::getImage($pic);
            }
        }
      
        $stmt = $this->db17->prepare("SELECT Objeto FROM cfg_Imagenes i WHERE Tabla='RAL' AND Candidato=:Candidato ORDER BY Folio");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $capturas17 = $stmt->fetchAll();
        if ($capturas17) {
            for ($i = 0; $i < count($capturas17); $i++) {
                $foto = base64_encode($capturas17[$i]['Objeto']);
                $pic = "data:image/jpg;charset=utf8;base64, $foto";
                $capturas17[$i] = NULL;
                $capturas17[$i] = Utils::getImage($pic);
            }
        }


        //$capturas = array_merge($capturas, $capturas2, $capturas3, $capturas4, $capturas5, $capturas6, $capturas7, $capturas8, $capturas9, $capturas10);
        $capturas = array_merge($capturas, $capturas2, $capturas3, $capturas4, $capturas5, $capturas6, $capturas7, $capturas8, $capturas9, $capturas10, $capturas11, $capturas12, $capturas13, $capturas14, $capturas15, $capturas16,$capturas17);
        //$capturas = array_merge($capturas, $capturas2, $capturas3, $capturas4, $capturas5);
        //$capturas = array_merge($capturas, $capturas2, $capturas3);

        //$capturas = array_merge($capturas, $capturas2);

        return $capturas;
    }

    public function getOne()
    {
        $Imagen = $this->getImagen();

        if ($Imagen > maxImage17)
            $stmt = $this->db17->prepare(
                "SELECT Imagen, Tabla, Folio_Origen, Objeto, Archivo, Candidato, Folio FROM cfg_Imagenes WHERE Imagen=:Imagen"
            );
        elseif ($Imagen > maxImage16 && $Imagen <= maxImage17)
            $stmt = $this->db16->prepare(
                "SELECT Imagen, Tabla, Folio_Origen, Objeto, Archivo, Candidato, Folio FROM cfg_Imagenes WHERE Imagen=:Imagen"
            );
        elseif ($Imagen > maxImage15 && $Imagen <= maxImage16)
            $stmt = $this->db15->prepare(
                "SELECT Imagen, Tabla, Folio_Origen, Objeto, Archivo, Candidato, Folio FROM cfg_Imagenes WHERE Imagen=:Imagen"
            );
        elseif ($Imagen > maxImage14 && $Imagen <= maxImage15)
            $stmt = $this->db14->prepare(
                "SELECT Imagen, Tabla, Folio_Origen, Objeto, Archivo, Candidato, Folio FROM cfg_Imagenes WHERE Imagen=:Imagen"
            );
        elseif ($Imagen > maxImage13 && $Imagen <= maxImage14)
            $stmt = $this->db13->prepare(
                "SELECT Imagen, Tabla, Folio_Origen, Objeto, Archivo, Candidato, Folio FROM cfg_Imagenes WHERE Imagen=:Imagen"
            );
        elseif ($Imagen > maxImage12 && $Imagen <= maxImage13)
            $stmt = $this->db12->prepare(
                "SELECT Imagen, Tabla, Folio_Origen, Objeto, Archivo, Candidato, Folio FROM cfg_Imagenes WHERE Imagen=:Imagen"
            );
        elseif ($Imagen > maxImage11 && $Imagen <= maxImage12)
            $stmt = $this->db11->prepare(
                "SELECT Imagen, Tabla, Folio_Origen, Objeto, Archivo, Candidato, Folio FROM cfg_Imagenes WHERE Imagen=:Imagen"
            );
        elseif ($Imagen > maxImage10 && $Imagen <= maxImage11)
            $stmt = $this->db10->prepare(
                "SELECT Imagen, Tabla, Folio_Origen, Objeto, Archivo, Candidato, Folio FROM cfg_Imagenes WHERE Imagen=:Imagen"
            );
        elseif ($Imagen > maxImage9 && $Imagen <= maxImage10)
            $stmt = $this->db3->prepare(
                "SELECT Imagen, Tabla, Folio_Origen, Objeto, Archivo, Candidato, Folio FROM cfg_Imagenes WHERE Imagen=:Imagen"
            );
        elseif ($Imagen > maxImage8 && $Imagen <= maxImage9)
            $stmt = $this->db2->prepare(
                "SELECT Imagen, Tabla, Folio_Origen, Objeto, Archivo, Candidato, Folio FROM cfg_Imagenes WHERE Imagen=:Imagen"
            );
        elseif ($Imagen > maxImage7 && $Imagen <= maxImage8)
            $stmt = $this->db9->prepare(
                "SELECT Imagen, Tabla, Folio_Origen, Objeto, Archivo, Candidato, Folio FROM cfg_Imagenes WHERE Imagen=:Imagen"
            );
        elseif ($Imagen > maxImage6 && $Imagen <= maxImage7)
            $stmt = $this->db8->prepare(
                "SELECT Imagen, Tabla, Folio_Origen, Objeto, Archivo, Candidato, Folio FROM cfg_Imagenes WHERE Imagen=:Imagen"
            );
        elseif ($Imagen > maxImage5 && $Imagen <= maxImage6)
            $stmt = $this->db7->prepare(
                "SELECT Imagen, Tabla, Folio_Origen, Objeto, Archivo, Candidato, Folio FROM cfg_Imagenes WHERE Imagen=:Imagen"
            );
        elseif ($Imagen > maxImage4 && $Imagen <= maxImage5)
            $stmt = $this->db6->prepare(
                "SELECT Imagen, Tabla, Folio_Origen, Objeto, Archivo, Candidato, Folio FROM cfg_Imagenes WHERE Imagen=:Imagen"
            );
        elseif ($Imagen > maxImage3 && $Imagen <= maxImage4)
            $stmt = $this->db5->prepare(
                "SELECT Imagen, Tabla, Folio_Origen, Objeto, Archivo, Candidato, Folio FROM cfg_Imagenes WHERE Imagen=:Imagen"
            );
        elseif ($Imagen > maxImage2 && $Imagen <= maxImage3)
            $stmt = $this->db4->prepare(
                "SELECT Imagen, Tabla, Folio_Origen, Objeto, Archivo, Candidato, Folio FROM cfg_Imagenes WHERE Imagen=:Imagen"
            );
        elseif ($Imagen > maxImage1 && $Imagen <= maxImage2)
            $stmt = $this->db3->prepare(
                "SELECT Imagen, Tabla, Folio_Origen, Objeto, Archivo, Candidato, Folio FROM cfg_Imagenes WHERE Imagen=:Imagen"
            );
        elseif ($Imagen > maxImage && $Imagen <= maxImage1)
            $stmt = $this->db2->prepare(
                "SELECT Imagen, Tabla, Folio_Origen, Objeto, Archivo, Candidato, Folio FROM cfg_Imagenes WHERE Imagen=:Imagen"
            );
        else
            $stmt = $this->db->prepare(
                "SELECT Imagen, Tabla, Folio_Origen, Objeto, Archivo, Candidato, Folio FROM cfg_Imagenes WHERE Imagen=:Imagen"
            );

        $stmt->bindParam(":Imagen", $Imagen, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        if ($fetch) {
            $foto = base64_encode($fetch->Objeto);
            $pic = "data:image/jpg;charset=utf8;base64, $foto";
            $fetch->Objeto = $pic;
            //$fetch = Utils::getImage($pic);
        } else {
            $fetch = false;
        }
        return $fetch;
    }

    public function getOneToDownload()
    {
        $Imagen = $this->getImagen();

        if ($Imagen > maxImage17)
            $stmt = $this->db17->prepare(
                "SELECT Objeto FROM cfg_Imagenes WHERE Imagen=:Imagen"
            );
        elseif ($Imagen > maxImage16 && $Imagen <= maxImage17)
            $stmt = $this->db16->prepare(
                "SELECT Objeto FROM cfg_Imagenes WHERE Imagen=:Imagen"
            );
        elseif ($Imagen > maxImage15 && $Imagen <= maxImage16)
            $stmt = $this->db15->prepare(
                "SELECT Objeto FROM cfg_Imagenes WHERE Imagen=:Imagen"
            );
        elseif ($Imagen > maxImage14 && $Imagen <= maxImage15)
            $stmt = $this->db14->prepare(
                "SELECT Objeto FROM cfg_Imagenes WHERE Imagen=:Imagen"
            );
        elseif ($Imagen > maxImage13 && $Imagen <= maxImage14)
            $stmt = $this->db13->prepare(
                "SELECT Objeto FROM cfg_Imagenes WHERE Imagen=:Imagen"
            );
        elseif ($Imagen > maxImage12 && $Imagen <= maxImage13)
            $stmt = $this->db12->prepare(
                "SELECT Objeto FROM cfg_Imagenes WHERE Imagen=:Imagen"
            );
        elseif ($Imagen > maxImage11 && $Imagen <= maxImage12)
            $stmt = $this->db11->prepare(
                "SELECT Objeto FROM cfg_Imagenes WHERE Imagen=:Imagen"
            );
        elseif ($Imagen > maxImage10 && $Imagen <= maxImage11)
            $stmt = $this->db10->prepare(
                "SELECT Objeto FROM cfg_Imagenes WHERE Imagen=:Imagen"
            );
        elseif ($Imagen > maxImage9 && $Imagen <= maxImage10)
            $stmt = $this->db3->prepare(
                "SELECT Objeto FROM cfg_Imagenes WHERE Imagen=:Imagen"
            );
        elseif ($Imagen > maxImage8 && $Imagen <= maxImage9)
            $stmt = $this->db2->prepare(
                "SELECT Objeto FROM cfg_Imagenes WHERE Imagen=:Imagen"
            );
        elseif ($Imagen > maxImage7 && $Imagen <= maxImage8)
            $stmt = $this->db9->prepare(
                "SELECT Objeto FROM cfg_Imagenes WHERE Imagen=:Imagen"
            );
        elseif ($Imagen > maxImage6 && $Imagen <= maxImage7)
            $stmt = $this->db8->prepare(
                "SELECT Objeto FROM cfg_Imagenes WHERE Imagen=:Imagen"
            );
        elseif ($Imagen > maxImage5 && $Imagen <= maxImage6)
            $stmt = $this->db7->prepare(
                "SELECT Objeto FROM cfg_Imagenes WHERE Imagen=:Imagen"
            );
        elseif ($Imagen > maxImage4 && $Imagen <= maxImage5)
            $stmt = $this->db6->prepare(
                "SELECT Objeto FROM cfg_Imagenes WHERE Imagen=:Imagen"
            );
        elseif ($Imagen > maxImage3 && $Imagen <= maxImage4)
            $stmt = $this->db5->prepare(
                "SELECT Objeto FROM cfg_Imagenes WHERE Imagen=:Imagen"
            );
        elseif ($Imagen > maxImage2 && $Imagen <= maxImage3)
            $stmt = $this->db4->prepare(
                "SELECT Objeto FROM cfg_Imagenes WHERE Imagen=:Imagen"
            );
        elseif ($Imagen > maxImage1 && $Imagen <= maxImage2)
            $stmt = $this->db3->prepare(
                "SELECT Objeto FROM cfg_Imagenes WHERE Imagen=:Imagen"
            );
        elseif ($Imagen > maxImage && $Imagen <= maxImage1)
            $stmt = $this->db2->prepare(
                "SELECT Objeto FROM cfg_Imagenes WHERE Imagen=:Imagen"
            );
        else
            $stmt = $this->db->prepare(
                "SELECT Objeto FROM cfg_Imagenes WHERE Imagen=:Imagen"
            );
        $stmt->bindParam(":Imagen", $Imagen, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        if ($fetch) {
            $foto = base64_encode($fetch->Objeto);
            $pic = "data:application/octet-stream;charset=utf8;base64, $foto";
            $fetch = $pic;
            //$fetch = Utils::getImage($pic);
        } else {
            $fetch = false;
        }
        return $fetch;
    }

    public function getMax()
    {
        $stmt = $this->db->prepare(
            "SELECT ISNULL(MAX(Imagen), 0) AS Imagen FROM cfg_Imagenes"
        );
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->Imagen;
    }

    public function getMaxFolioRALCandidato()
    {
        $Candidato = $this->getCandidato();

        $stmt = $this->db->prepare(
            "SELECT ISNULL(MAX(Folio), 0) AS Folio FROM cfg_Imagenes WHERE Candidato=:Candidato"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        if ($fetch->Folio == 0) {
            $stmt = $this->db2->prepare(
                "SELECT ISNULL(MAX(Folio), 0) AS Folio FROM cfg_Imagenes WHERE Candidato=:Candidato"
            );
            $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
            $stmt->execute();
            $fetch = $stmt->fetchObject();

            if ($fetch->Folio == 0) {
                $stmt = $this->db3->prepare(
                    "SELECT ISNULL(MAX(Folio), 0) AS Folio FROM cfg_Imagenes WHERE Candidato=:Candidato"
                );
                $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                $stmt->execute();
                $fetch = $stmt->fetchObject();

                if ($fetch->Folio == 0) {
                    $stmt = $this->db4->prepare(
                        "SELECT ISNULL(MAX(Folio), 0) AS Folio FROM cfg_Imagenes WHERE Candidato=:Candidato"
                    );
                    $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                    $stmt->execute();
                    $fetch = $stmt->fetchObject();

                    if ($fetch->Folio == 0) {
                        $stmt = $this->db5->prepare(
                            "SELECT ISNULL(MAX(Folio), 0) AS Folio FROM cfg_Imagenes WHERE Candidato=:Candidato"
                        );
                        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                        $stmt->execute();
                        $fetch = $stmt->fetchObject();

                        if ($fetch->Folio == 0) {
                            $stmt = $this->db6->prepare(
                                "SELECT ISNULL(MAX(Folio), 0) AS Folio FROM cfg_Imagenes WHERE Candidato=:Candidato"
                            );
                            $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                            $stmt->execute();
                            $fetch = $stmt->fetchObject();

                            if ($fetch->Folio == 0) {
                                $stmt = $this->db7->prepare(
                                    "SELECT ISNULL(MAX(Folio), 0) AS Folio FROM cfg_Imagenes WHERE Candidato=:Candidato"
                                );
                                $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                $stmt->execute();
                                $fetch = $stmt->fetchObject();

                                if ($fetch->Folio == 0) {
                                    $stmt = $this->db8->prepare(
                                        "SELECT ISNULL(MAX(Folio), 0) AS Folio FROM cfg_Imagenes WHERE Candidato=:Candidato"
                                    );
                                    $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                    $stmt->execute();
                                    $fetch = $stmt->fetchObject();

                                    if ($fetch->Folio == 0) {
                                        $stmt = $this->db9->prepare(
                                            "SELECT ISNULL(MAX(Folio), 0) AS Folio FROM cfg_Imagenes WHERE Candidato=:Candidato"
                                        );
                                        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                        $stmt->execute();
                                        $fetch = $stmt->fetchObject();

                                        if ($fetch->Folio == 0) {
                                            $stmt = $this->db10->prepare(
                                                "SELECT ISNULL(MAX(Folio), 0) AS Folio FROM cfg_Imagenes WHERE Candidato=:Candidato"
                                            );
                                            $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                            $stmt->execute();
                                            $fetch = $stmt->fetchObject();

                                            if ($fetch->Folio == 0) {
                                                $stmt = $this->db11->prepare(
                                                    "SELECT ISNULL(MAX(Folio), 0) AS Folio FROM cfg_Imagenes WHERE Candidato=:Candidato"
                                                );
                                                $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                                $stmt->execute();
                                                $fetch = $stmt->fetchObject();

                                                if ($fetch->Folio == 0) {
                                                    $stmt = $this->db12->prepare(
                                                        "SELECT ISNULL(MAX(Folio), 0) AS Folio FROM cfg_Imagenes WHERE Candidato=:Candidato"
                                                    );
                                                    $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                                    $stmt->execute();
                                                    $fetch = $stmt->fetchObject();

                                                    if ($fetch->Folio == 0) {
                                                        $stmt = $this->db13->prepare(
                                                            "SELECT CASE WHEN MAX(Folio) IS NULL OR MAX(Folio)='' THEN 0 ELSE MAX(Folio) END AS Folio FROM cfg_Imagenes WHERE Candidato=:Candidato"
                                                        );
                                                        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                                        $stmt->execute();
                                                        $fetch = $stmt->fetchObject();

                                                        if ($fetch->Folio == 0) {
                                                            $stmt = $this->db14->prepare(
                                                                "SELECT CASE WHEN MAX(Folio) IS NULL OR MAX(Folio)='' THEN 0 ELSE MAX(Folio) END AS Folio FROM cfg_Imagenes WHERE Candidato=:Candidato"
                                                            );
                                                            $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                                            $stmt->execute();
                                                            $fetch = $stmt->fetchObject();

                                                            if ($fetch->Folio == 0) {
                                                                $stmt = $this->db15->prepare(
                                                                    "SELECT CASE WHEN MAX(Folio) IS NULL OR MAX(Folio)='' THEN 0 ELSE MAX(Folio) END AS Folio FROM cfg_Imagenes WHERE Candidato=:Candidato"
                                                                );
                                                                $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                                                $stmt->execute();
                                                                $fetch = $stmt->fetchObject();
                                                                if ($fetch->Folio == 0) {
                                                                    $stmt = $this->db16->prepare(
                                                                        "SELECT CASE WHEN MAX(Folio) IS NULL OR MAX(Folio)='' THEN 0 ELSE MAX(Folio) END AS Folio FROM cfg_Imagenes WHERE Candidato=:Candidato"
                                                                    );
                                                                    $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                                                    $stmt->execute();
                                                                    $fetch = $stmt->fetchObject();
                                                                    if ($fetch->Folio == 0) {
                                                                        $stmt = $this->db17->prepare(
                                                                            "SELECT CASE WHEN MAX(Folio) IS NULL OR MAX(Folio)='' THEN 0 ELSE MAX(Folio) END AS Folio FROM cfg_Imagenes WHERE Candidato=:Candidato"
                                                                        );
                                                                        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
                                                                        $stmt->execute();
                                                                        $fetch = $stmt->fetchObject();
                                                                        
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $fetch->Folio;
    }

    public function create()
    {
        $result = false;

        //$Imagen = $this->getMax() + 1;
        $Tabla = $this->getTabla();
        $Folio_Origen = $this->getFolio_Origen();
        $Archivo = $this->getArchivo();
        $Objeto = $this->getObjeto();
        $Candidato = $this->getCandidato();
        if ($Tabla == 'RAL') {
            $Folio = $this->getMaxFolioRALCandidato() + 1;
        }
        if ($Tabla == 'Documentos') {
            $Folio = '';
        }

        if ($Tabla == 'Candidatos') {
            $Folio_Origen = $Candidato;
            $Candidato = NULL;
            $Folio = NULL;
        }

        if ($Tabla == 'Candidatos_Ubicacion') {
            if ($Folio_Origen != 115) {
                $Candidato = NULL;
                $Folio = NULL;
            } else {
                $Folio = '';
            }
        }

        if ($Tabla == 'Candidatos_Vivienda') {
            $Candidato = NULL;
            $Folio = NULL;
        }

        //$stmt = $this->db2->prepare("INSERT INTO cfg_Imagenes(Imagen, Tabla, Folio_Origen, Archivo, Objeto, Candidato, Folio) VALUES (:Imagen, :Tabla, :Folio_Origen, :Archivo, :Objeto, :Candidato, :Folio)");
        //$stmt = $this->db2->prepare("INSERT INTO cfg_Imagenes(Tabla, Folio_Origen, Archivo, Objeto, Candidato, Folio) VALUES (:Tabla, :Folio_Origen, :Archivo, :Objeto, :Candidato, :Folio)");
        //$stmt = $this->db3->prepare("INSERT INTO cfg_Imagenes(Tabla, Folio_Origen, Archivo, Objeto, Candidato, Folio) VALUES (:Tabla, :Folio_Origen, :Archivo, :Objeto, :Candidato, :Folio)");
        //$stmt = $this->db4->prepare("INSERT INTO cfg_Imagenes(Tabla, Folio_Origen, Archivo, Objeto, Candidato, Folio) VALUES (:Tabla, :Folio_Origen, :Archivo, :Objeto, :Candidato, :Folio)");
        //$stmt = $this->db5->prepare("INSERT INTO cfg_Imagenes(Tabla, Folio_Origen, Archivo, Objeto, Candidato, Folio) VALUES (:Tabla, :Folio_Origen, :Archivo, :Objeto, :Candidato, :Folio)");
        //$stmt = $this->db6->prepare("INSERT INTO cfg_Imagenes(Tabla, Folio_Origen, Archivo, Objeto, Candidato, Folio) VALUES (:Tabla, :Folio_Origen, :Archivo, :Objeto, :Candidato, :Folio)");
        //$stmt = $this->db7->prepare("INSERT INTO cfg_Imagenes(Tabla, Folio_Origen, Archivo, Objeto, Candidato, Folio) VALUES (:Tabla, :Folio_Origen, :Archivo, :Objeto, :Candidato, :Folio)");
        //$stmt = $this->db8->prepare("INSERT INTO cfg_Imagenes(Tabla, Folio_Origen, Archivo, Objeto, Candidato, Folio) VALUES (:Tabla, :Folio_Origen, :Archivo, :Objeto, :Candidato, :Folio)");
        //$stmt = $this->db9->prepare("INSERT INTO cfg_Imagenes(Tabla, Folio_Origen, Archivo, Objeto, Candidato, Folio) VALUES (:Tabla, :Folio_Origen, :Archivo, :Objeto, :Candidato, :Folio)");
        //$stmt = $this->db10->prepare("INSERT INTO cfg_Imagenes(Tabla, Folio_Origen, Archivo, Objeto, Candidato, Folio) VALUES (:Tabla, :Folio_Origen, :Archivo, :Objeto, :Candidato, :Folio)");
        //$stmt = $this->db11->prepare("INSERT INTO cfg_Imagenes(Tabla, Folio_Origen, Archivo, Objeto, Candidato, Folio) VALUES (:Tabla, :Folio_Origen, :Archivo, :Objeto, :Candidato, :Folio)");
        //$stmt = $this->db12->prepare("INSERT INTO cfg_Imagenes(Tabla, Folio_Origen, Archivo, Objeto, Candidato, Folio) VALUES (:Tabla, :Folio_Origen, :Archivo, :Objeto, :Candidato, :Folio)");
        //$stmt = $this->db13->prepare("INSERT INTO cfg_Imagenes(Tabla, Folio_Origen, Archivo, Objeto, Candidato, Folio) VALUES (:Tabla, :Folio_Origen, :Archivo, :Objeto, :Candidato, :Folio)");
        //$stmt = $this->db14->prepare("INSERT INTO cfg_Imagenes(Tabla, Folio_Origen, Archivo, Objeto, Candidato, Folio) VALUES (:Tabla, :Folio_Origen, :Archivo, :Objeto, :Candidato, :Folio)");
        //$stmt = $this->db15->prepare("INSERT INTO cfg_Imagenes(Tabla, Folio_Origen, Archivo, Objeto, Candidato, Folio) VALUES (:Tabla, :Folio_Origen, :Archivo, :Objeto, :Candidato, :Folio)");
        //$stmt = $this->db16->prepare("INSERT INTO cfg_Imagenes(Tabla, Folio_Origen, Archivo, Objeto, Candidato, Folio) VALUES (:Tabla, :Folio_Origen, :Archivo, :Objeto, :Candidato, :Folio)");
        $stmt = $this->db17->prepare("INSERT INTO cfg_Imagenes(Tabla, Folio_Origen, Archivo, Objeto, Candidato, Folio) VALUES (:Tabla, :Folio_Origen, :Archivo, :Objeto, :Candidato, :Folio)");
        //$stmt->bindParam(":Imagen", $Imagen, PDO::PARAM_INT);
        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
        $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
        $stmt->bindParam(":Archivo", $Archivo, PDO::PARAM_STR);
        $stmt->bindParam(":Objeto", $Objeto, PDO::PARAM_LOB, 0, PDO::SQLSRV_ENCODING_BINARY);
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Folio", $Folio, PDO::PARAM_STR);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
            //$this->setImagen($this->db3->lastInsertId());
            $this->setImagen($this->db16->lastInsertId());
        }
        return $result;
    }

    public function update()
    {
        $result = false;

        $Imagen = $this->getImagen();
        $Tabla = $this->getTabla();
        $Folio_Origen = $this->getFolio_Origen();
        $Archivo = $this->getArchivo();
        $Objeto = ($this->getObjeto());
        $Candidato = $this->getCandidato();
        $Folio = $this->getFolio();

        if ($Imagen > maxImage17)
            $stmt = $this->db17->prepare("UPDATE cfg_Imagenes SET Objeto=:Objeto WHERE Imagen=:Imagen");
        elseif ($Imagen > maxImage16 && $Imagen <= maxImage17)
            $stmt = $this->db16->prepare("UPDATE cfg_Imagenes SET Objeto=:Objeto WHERE Imagen=:Imagen");
        elseif ($Imagen > maxImage15 && $Imagen <= maxImage16)
            $stmt = $this->db15->prepare("UPDATE cfg_Imagenes SET Objeto=:Objeto WHERE Imagen=:Imagen");
        elseif ($Imagen > maxImage14 && $Imagen <= maxImage15)
            $stmt = $this->db14->prepare("UPDATE cfg_Imagenes SET Objeto=:Objeto WHERE Imagen=:Imagen");
        elseif ($Imagen > maxImage13 && $Imagen <= maxImage14)
            $stmt = $this->db13->prepare("UPDATE cfg_Imagenes SET Objeto=:Objeto WHERE Imagen=:Imagen");
        elseif ($Imagen > maxImage12 && $Imagen <= maxImage13)
            $stmt = $this->db12->prepare("UPDATE cfg_Imagenes SET Objeto=:Objeto WHERE Imagen=:Imagen");
        elseif ($Imagen > maxImage11 && $Imagen <= maxImage12)
            $stmt = $this->db11->prepare("UPDATE cfg_Imagenes SET Objeto=:Objeto WHERE Imagen=:Imagen");
        elseif ($Imagen > maxImage10 && $Imagen <= maxImage11)
            $stmt = $this->db10->prepare("UPDATE cfg_Imagenes SET Objeto=:Objeto WHERE Imagen=:Imagen");
        elseif ($Imagen > maxImage9 && $Imagen <= maxImage10)
            $stmt = $this->db3->prepare("UPDATE cfg_Imagenes SET Objeto=:Objeto WHERE Imagen=:Imagen");
        elseif ($Imagen > maxImage8 && $Imagen <= maxImage9)
            $stmt = $this->db2->prepare("UPDATE cfg_Imagenes SET Objeto=:Objeto WHERE Imagen=:Imagen");
        elseif ($Imagen > maxImage7 && $Imagen <= maxImage8)
            $stmt = $this->db9->prepare("UPDATE cfg_Imagenes SET Objeto=:Objeto WHERE Imagen=:Imagen");
        elseif ($Imagen > maxImage6 && $Imagen <= maxImage7)
            $stmt = $this->db8->prepare("UPDATE cfg_Imagenes SET Objeto=:Objeto WHERE Imagen=:Imagen");
        elseif ($Imagen > maxImage5 && $Imagen <= maxImage6)
            $stmt = $this->db7->prepare("UPDATE cfg_Imagenes SET Objeto=:Objeto WHERE Imagen=:Imagen");
        elseif ($Imagen > maxImage4 && $Imagen <= maxImage5)
            $stmt = $this->db6->prepare("UPDATE cfg_Imagenes SET Objeto=:Objeto WHERE Imagen=:Imagen");
        elseif ($Imagen > maxImage3 && $Imagen <= maxImage4)
            $stmt = $this->db5->prepare("UPDATE cfg_Imagenes SET Objeto=:Objeto WHERE Imagen=:Imagen");
        elseif ($Imagen > maxImage2 && $Imagen <= maxImage3)
            $stmt = $this->db4->prepare("UPDATE cfg_Imagenes SET Objeto=:Objeto WHERE Imagen=:Imagen");
        elseif ($Imagen > maxImage1 && $Imagen <= maxImage2)
            $stmt = $this->db3->prepare("UPDATE cfg_Imagenes SET Objeto=:Objeto WHERE Imagen=:Imagen");
        elseif ($Imagen > maxImage && $Imagen <= maxImage1)
            $stmt = $this->db2->prepare("UPDATE cfg_Imagenes SET Objeto=:Objeto WHERE Imagen=:Imagen");
        else
            $stmt = $this->db->prepare("UPDATE cfg_Imagenes SET Objeto=:Objeto WHERE Imagen=:Imagen");
        $stmt->bindParam(":Imagen", $Imagen, PDO::PARAM_INT);
        /*$stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
        $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
        $stmt->bindParam(":Archivo", $Archivo, PDO::PARAM_STR, 50);*/
        $stmt->bindParam(":Objeto", $Objeto, PDO::PARAM_LOB, 0, PDO::SQLSRV_ENCODING_BINARY);
        //$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        //$stmt->bindParam(":Folio", $Folio, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }

    public function delete()
    {
        $result = false;

        $Imagen = $this->getImagen();

        if ($Imagen > maxImage17)
            $stmt = $this->db17->prepare("DELETE FROM cfg_Imagenes WHERE Imagen=:Imagen");
        elseif ($Imagen > maxImage16 && $Imagen <= maxImage17)
            $stmt = $this->db16->prepare("DELETE FROM cfg_Imagenes WHERE Imagen=:Imagen");
        elseif ($Imagen > maxImage15 && $Imagen <= maxImage16)
            $stmt = $this->db15->prepare("DELETE FROM cfg_Imagenes WHERE Imagen=:Imagen");
        elseif ($Imagen > maxImage14 && $Imagen <= maxImage15)
            $stmt = $this->db14->prepare("DELETE FROM cfg_Imagenes WHERE Imagen=:Imagen");
        elseif ($Imagen > maxImage13 && $Imagen <= maxImage14)
            $stmt = $this->db13->prepare("DELETE FROM cfg_Imagenes WHERE Imagen=:Imagen");
        elseif ($Imagen > maxImage12 && $Imagen <= maxImage13)
            $stmt = $this->db12->prepare("DELETE FROM cfg_Imagenes WHERE Imagen=:Imagen");
        elseif ($Imagen > maxImage11 && $Imagen <= maxImage12)
            $stmt = $this->db11->prepare("DELETE FROM cfg_Imagenes WHERE Imagen=:Imagen");
        elseif ($Imagen > maxImage10 && $Imagen <= maxImage11)
            $stmt = $this->db10->prepare("DELETE FROM cfg_Imagenes WHERE Imagen=:Imagen");
        elseif ($Imagen > maxImage9 && $Imagen <= maxImage10)
            $stmt = $this->db3->prepare("DELETE FROM cfg_Imagenes WHERE Imagen=:Imagen");
        elseif ($Imagen > maxImage8 && $Imagen <= maxImage9)
            $stmt = $this->db2->prepare("DELETE FROM cfg_Imagenes WHERE Imagen=:Imagen");
        elseif ($Imagen > maxImage7 && $Imagen <= maxImage8)
            $stmt = $this->db9->prepare("DELETE FROM cfg_Imagenes WHERE Imagen=:Imagen");
        elseif ($Imagen > maxImage6 && $Imagen <= maxImage7)
            $stmt = $this->db8->prepare("DELETE FROM cfg_Imagenes WHERE Imagen=:Imagen");
        elseif ($Imagen > maxImage5 && $Imagen <= maxImage6)
            $stmt = $this->db7->prepare("DELETE FROM cfg_Imagenes WHERE Imagen=:Imagen");
        elseif ($Imagen > maxImage4 && $Imagen <= maxImage5)
            $stmt = $this->db6->prepare("DELETE FROM cfg_Imagenes WHERE Imagen=:Imagen");
        elseif ($Imagen > maxImage3 && $Imagen <= maxImage4)
            $stmt = $this->db5->prepare("DELETE FROM cfg_Imagenes WHERE Imagen=:Imagen");
        elseif ($Imagen > maxImage2 && $Imagen <= maxImage3)
            $stmt = $this->db4->prepare("DELETE FROM cfg_Imagenes WHERE Imagen=:Imagen");
        elseif ($Imagen > maxImage1 && $Imagen <= maxImage2)
            $stmt = $this->db3->prepare("DELETE FROM cfg_Imagenes WHERE Imagen=:Imagen");
        elseif ($Imagen > maxImage && $Imagen <= maxImage1)
            $stmt = $this->db2->prepare("DELETE FROM cfg_Imagenes WHERE Imagen=:Imagen");
        else
            $stmt = $this->db->prepare("DELETE FROM cfg_Imagenes WHERE Imagen=:Imagen");

        $stmt->bindParam(":Imagen", $Imagen, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }

    public function deleteProfile()
    {
        $result = false;

        $Folio_Origen = $this->getFolio_Origen();
        $Tabla = $this->getTabla();

        $stmt = $this->db->prepare("DELETE FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla");
        $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        } else {
            $stmt = $this->db2->prepare("DELETE FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla");
            $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
            $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);

            $flag = $stmt->execute();

            if ($flag) {
                $result = true;
            } else {
                $stmt = $this->db3->prepare("DELETE FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla");
                $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);

                $flag = $stmt->execute();

                if ($flag) {
                    $result = true;
                } else {
                    $stmt = $this->db4->prepare("DELETE FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla");
                    $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                    $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);

                    $flag = $stmt->execute();

                    if ($flag) {
                        $result = true;
                    } else {
                        $stmt = $this->db5->prepare("DELETE FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla");
                        $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);

                        $flag = $stmt->execute();

                        if ($flag) {
                            $result = true;
                        } else {
                            $stmt = $this->db6->prepare("DELETE FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla");
                            $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                            $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);

                            $flag = $stmt->execute();

                            if ($flag) {
                                $result = true;
                            } else {
                                $stmt = $this->db7->prepare("DELETE FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla");
                                $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);

                                $flag = $stmt->execute();

                                if ($flag) {
                                    $result = true;
                                } else {
                                    $stmt = $this->db8->prepare("DELETE FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla");
                                    $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                    $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);

                                    $flag = $stmt->execute();

                                    if ($flag) {
                                        $result = true;
                                    } else {
                                        $stmt = $this->db9->prepare("DELETE FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla");
                                        $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);

                                        $flag = $stmt->execute();

                                        if ($flag) {
                                            $result = true;
                                        } else {
                                            $stmt = $this->db10->prepare("DELETE FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla");
                                            $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                            $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);

                                            $flag = $stmt->execute();

                                            if ($flag) {
                                                $result = true;
                                            } else {
                                                $stmt = $this->db11->prepare("DELETE FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla");
                                                $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);

                                                $flag = $stmt->execute();

                                                if ($flag) {
                                                    $result = true;
                                                } else {
                                                    $stmt = $this->db12->prepare("DELETE FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla");
                                                    $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                    $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);

                                                    $flag = $stmt->execute();

                                                    if ($flag) {
                                                        $result = true;
                                                    } else {
                                                        $stmt = $this->db13->prepare("DELETE FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla");
                                                        $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);

                                                        $flag = $stmt->execute();

                                                        if ($flag) {
                                                            $result = true;
                                                        } else {
                                                            $stmt = $this->db14->prepare("DELETE FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla");
                                                            $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                            $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);

                                                            $flag = $stmt->execute();

                                                            if ($flag) {
                                                                $result = true;
                                                            } else {
                                                                $stmt = $this->db15->prepare("DELETE FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla");
                                                                $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                                $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);

                                                                $flag = $stmt->execute();

                                                                if ($flag) {
                                                                    $result = true;
                                                                } else {
                                                                    $stmt = $this->db16->prepare("DELETE FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla");
                                                                    $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                                    $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);

                                                                    $flag = $stmt->execute();

                                                                    if ($flag) {
                                                                        $result = true;
                                                                    }else {
                                                                        $stmt = $this->db17->prepare("DELETE FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla");
                                                                        $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                                        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
    
                                                                        $flag = $stmt->execute();
    
                                                                        if ($flag) {
                                                                            $result = true;
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $result;
    }

    public function getProfileID()
    {
        $result = false;

        $Folio_Origen = $this->getFolio_Origen();
        $Tabla = $this->getTabla();

        $stmt = $this->db->prepare("SELECT Imagen FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla");
        $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);

        $stmt->execute();

        $fetch = $stmt->fetchObject();
        if (!$fetch) {
            $stmt = $this->db2->prepare("SELECT Imagen FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla");
            $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
            $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);

            $stmt->execute();

            $fetch = $stmt->fetchObject();

            if (!$fetch) {
                $stmt = $this->db3->prepare("SELECT Imagen FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla");
                $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);

                $stmt->execute();

                $fetch = $stmt->fetchObject();

                if (!$fetch) {
                    $stmt = $this->db4->prepare("SELECT Imagen FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla");
                    $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                    $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);

                    $stmt->execute();

                    $fetch = $stmt->fetchObject();

                    if (!$fetch) {
                        $stmt = $this->db5->prepare("SELECT Imagen FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla");
                        $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);

                        $stmt->execute();

                        $fetch = $stmt->fetchObject();

                        if (!$fetch) {
                            $stmt = $this->db6->prepare("SELECT Imagen FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla");
                            $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                            $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);

                            $stmt->execute();

                            $fetch = $stmt->fetchObject();

                            if (!$fetch) {
                                $stmt = $this->db7->prepare("SELECT Imagen FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla");
                                $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);

                                $stmt->execute();

                                $fetch = $stmt->fetchObject();

                                if (!$fetch) {
                                    $stmt = $this->db8->prepare("SELECT Imagen FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla");
                                    $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                    $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);

                                    $stmt->execute();

                                    $fetch = $stmt->fetchObject();

                                    if (!$fetch) {
                                        $stmt = $this->db9->prepare("SELECT Imagen FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla");
                                        $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);

                                        $stmt->execute();

                                        $fetch = $stmt->fetchObject();

                                        if (!$fetch) {
                                            $stmt = $this->db10->prepare("SELECT Imagen FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla");
                                            $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                            $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);

                                            $stmt->execute();

                                            $fetch = $stmt->fetchObject();

                                            if (!$fetch) {
                                                $stmt = $this->db11->prepare("SELECT Imagen FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla");
                                                $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);

                                                $stmt->execute();

                                                $fetch = $stmt->fetchObject();

                                                if (!$fetch) {
                                                    $stmt = $this->db12->prepare("SELECT Imagen FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla");
                                                    $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                    $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);

                                                    $stmt->execute();

                                                    $fetch = $stmt->fetchObject();

                                                    if (!$fetch) {
                                                        $stmt = $this->db13->prepare("SELECT Imagen FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla");
                                                        $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);

                                                        $stmt->execute();

                                                        $fetch = $stmt->fetchObject();

                                                        if (!$fetch) {
                                                            $stmt = $this->db14->prepare("SELECT Imagen FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla");
                                                            $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                            $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);

                                                            $stmt->execute();

                                                            $fetch = $stmt->fetchObject();

                                                            if (!$fetch) {
                                                                $stmt = $this->db15->prepare("SELECT Imagen FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla");
                                                                $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                                $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);

                                                                $stmt->execute();

                                                                $fetch = $stmt->fetchObject();

                                                                if (!$fetch) {
                                                                    $stmt = $this->db16->prepare("SELECT Imagen FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla");
                                                                    $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                                    $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);

                                                                    $stmt->execute();

                                                                    $fetch = $stmt->fetchObject();
                                                                    if (!$fetch) {
                                                                        $stmt = $this->db17->prepare("SELECT Imagen FROM cfg_Imagenes WHERE Folio_Origen=:Folio_Origen AND Tabla=:Tabla");
                                                                        $stmt->bindParam(":Folio_Origen", $Folio_Origen, PDO::PARAM_INT);
                                                                        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_STR);
    
                                                                        $stmt->execute();
    
                                                                        $fetch = $stmt->fetchObject();
                                                                    }
                                                                } 
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $fetch->Imagen;
    }

    public function getDocumentosFaltantesPorCandidato()
    {
        $Candidato = $this->getCandidato();
        $stmt = $this->db->prepare(
            "SELECT c.Campo, c.Descripcion FROM (SELECT * FROM sys_Campos WHERE Tabla=104) c LEFT OUTER JOIN (SELECT Imagen, Folio_Origen FROM cfg_Imagenes WHERE Candidato=:Candidato) e ON e.Folio_Origen=c.Campo WHERE e.Folio_origen IS NULL ORDER BY c.Descripcion"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();

        $stmt = $this->db2->prepare(
            "SELECT c.Campo, c.Descripcion FROM (SELECT * FROM rrhhinge_Candidatos.dbo.sys_Campos WHERE Tabla=104) c LEFT OUTER JOIN (SELECT Imagen, Folio_Origen FROM cfg_Imagenes WHERE Candidato=:Candidato) e ON e.Folio_Origen=c.Campo WHERE e.Folio_origen IS NULL ORDER BY c.Descripcion"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch2 = $stmt->fetchAll();

        $stmt = $this->db3->prepare(
            "SELECT c.Campo, c.Descripcion FROM (SELECT * FROM rrhhinge_Candidatos.dbo.sys_Campos WHERE Tabla=104) c LEFT OUTER JOIN (SELECT Imagen, Folio_Origen FROM cfg_Imagenes WHERE Candidato=:Candidato) e ON e.Folio_Origen=c.Campo WHERE e.Folio_origen IS NULL ORDER BY c.Descripcion"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch3 = $stmt->fetchAll();

        $stmt = $this->db4->prepare(
            "SELECT c.Campo, c.Descripcion FROM (SELECT * FROM rrhhinge_Candidatos.dbo.sys_Campos WHERE Tabla=104) c LEFT OUTER JOIN (SELECT Imagen, Folio_Origen FROM cfg_Imagenes WHERE Candidato=:Candidato) e ON e.Folio_Origen=c.Campo WHERE e.Folio_origen IS NULL ORDER BY c.Descripcion"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch4 = $stmt->fetchAll();

        $stmt = $this->db5->prepare(
            "SELECT c.Campo, c.Descripcion FROM (SELECT * FROM rrhhinge_Candidatos.dbo.sys_Campos WHERE Tabla=104) c LEFT OUTER JOIN (SELECT Imagen, Folio_Origen FROM cfg_Imagenes WHERE Candidato=:Candidato) e ON e.Folio_Origen=c.Campo WHERE e.Folio_origen IS NULL ORDER BY c.Descripcion"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch5 = $stmt->fetchAll();

        $stmt = $this->db6->prepare(
            "SELECT c.Campo, c.Descripcion FROM (SELECT * FROM rrhhinge_Candidatos.dbo.sys_Campos WHERE Tabla=104) c LEFT OUTER JOIN (SELECT Imagen, Folio_Origen FROM cfg_Imagenes WHERE Candidato=:Candidato) e ON e.Folio_Origen=c.Campo WHERE e.Folio_origen IS NULL ORDER BY c.Descripcion"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch6 = $stmt->fetchAll();

        $stmt = $this->db7->prepare(
            "SELECT c.Campo, c.Descripcion FROM (SELECT * FROM rrhhinge_Candidatos.dbo.sys_Campos WHERE Tabla=104) c LEFT OUTER JOIN (SELECT Imagen, Folio_Origen FROM cfg_Imagenes WHERE Candidato=:Candidato) e ON e.Folio_Origen=c.Campo WHERE e.Folio_origen IS NULL ORDER BY c.Descripcion"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch7 = $stmt->fetchAll();

        $stmt = $this->db8->prepare(
            "SELECT c.Campo, c.Descripcion FROM (SELECT * FROM rrhhinge_Candidatos.dbo.sys_Campos WHERE Tabla=104) c LEFT OUTER JOIN (SELECT Imagen, Folio_Origen FROM cfg_Imagenes WHERE Candidato=:Candidato) e ON e.Folio_Origen=c.Campo WHERE e.Folio_origen IS NULL ORDER BY c.Descripcion"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch8 = $stmt->fetchAll();

        $stmt = $this->db9->prepare(
            "SELECT c.Campo, c.Descripcion FROM (SELECT * FROM rrhhinge_Candidatos.dbo.sys_Campos WHERE Tabla=104) c LEFT OUTER JOIN (SELECT Imagen, Folio_Origen FROM cfg_Imagenes WHERE Candidato=:Candidato) e ON e.Folio_Origen=c.Campo WHERE e.Folio_origen IS NULL ORDER BY c.Descripcion"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch9 = $stmt->fetchAll();

        $stmt = $this->db10->prepare(
            "SELECT c.Campo, c.Descripcion FROM (SELECT * FROM rrhhinge_Candidatos.dbo.sys_Campos WHERE Tabla=104) c LEFT OUTER JOIN (SELECT Imagen, Folio_Origen FROM cfg_Imagenes WHERE Candidato=:Candidato) e ON e.Folio_Origen=c.Campo WHERE e.Folio_origen IS NULL ORDER BY c.Descripcion"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch10 = $stmt->fetchAll();

        $stmt = $this->db11->prepare(
            "SELECT c.Campo, c.Descripcion FROM (SELECT * FROM rrhhinge_Candidatos.dbo.sys_Campos WHERE Tabla=104) c LEFT OUTER JOIN (SELECT Imagen, Folio_Origen FROM cfg_Imagenes WHERE Candidato=:Candidato) e ON e.Folio_Origen=c.Campo WHERE e.Folio_origen IS NULL ORDER BY c.Descripcion"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch11 = $stmt->fetchAll();

        $stmt = $this->db12->prepare(
            "SELECT c.Campo, c.Descripcion FROM (SELECT * FROM rrhhinge_Candidatos.dbo.sys_Campos WHERE Tabla=104) c LEFT OUTER JOIN (SELECT Imagen, Folio_Origen FROM cfg_Imagenes WHERE Candidato=:Candidato) e ON e.Folio_Origen=c.Campo WHERE e.Folio_origen IS NULL ORDER BY c.Descripcion"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch12 = $stmt->fetchAll();

        $stmt = $this->db13->prepare(
            "SELECT c.Campo, c.Descripcion FROM (SELECT * FROM rrhhinge_Candidatos.dbo.sys_Campos WHERE Tabla=104) c LEFT OUTER JOIN (SELECT Imagen, Folio_Origen FROM cfg_Imagenes WHERE Candidato=:Candidato) e ON e.Folio_Origen=c.Campo WHERE e.Folio_origen IS NULL ORDER BY c.Descripcion"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch13 = $stmt->fetchAll();

        $stmt = $this->db14->prepare(
            "SELECT c.Campo, c.Descripcion FROM (SELECT * FROM rrhhinge_Candidatos.dbo.sys_Campos WHERE Tabla=104) c LEFT OUTER JOIN (SELECT Imagen, Folio_Origen FROM cfg_Imagenes WHERE Candidato=:Candidato) e ON e.Folio_Origen=c.Campo WHERE e.Folio_origen IS NULL ORDER BY c.Descripcion"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch14 = $stmt->fetchAll();

        $stmt = $this->db15->prepare(
            "SELECT c.Campo, c.Descripcion FROM (SELECT * FROM rrhhinge_Candidatos.dbo.sys_Campos WHERE Tabla=104) c LEFT OUTER JOIN (SELECT Imagen, Folio_Origen FROM cfg_Imagenes WHERE Candidato=:Candidato) e ON e.Folio_Origen=c.Campo WHERE e.Folio_origen IS NULL ORDER BY c.Descripcion"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch15 = $stmt->fetchAll();

        $stmt = $this->db16->prepare(
            "SELECT c.Campo, c.Descripcion FROM (SELECT * FROM rrhhinge_Candidatos.dbo.sys_Campos WHERE Tabla=104) c LEFT OUTER JOIN (SELECT Imagen, Folio_Origen FROM cfg_Imagenes WHERE Candidato=:Candidato) e ON e.Folio_Origen=c.Campo WHERE e.Folio_origen IS NULL ORDER BY c.Descripcion"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch16 = $stmt->fetchAll();

        $stmt = $this->db17->prepare(
            "SELECT c.Campo, c.Descripcion FROM (SELECT * FROM rrhhinge_Candidatos.dbo.sys_Campos WHERE Tabla=104) c LEFT OUTER JOIN (SELECT Imagen, Folio_Origen FROM cfg_Imagenes WHERE Candidato=:Candidato) e ON e.Folio_Origen=c.Campo WHERE e.Folio_origen IS NULL ORDER BY c.Descripcion"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch17 = $stmt->fetchAll();

        $fetch = array_uintersect($fetch, $fetch2, function ($val1, $val2) {
            return strcmp($val1['Descripcion'], $val2['Descripcion']);
        });

        $fetch = array_uintersect($fetch, $fetch3, function ($val1, $val3) {
            return strcmp($val1['Descripcion'], $val3['Descripcion']);
        });

        $fetch = array_uintersect($fetch, $fetch4, function ($val1, $val4) {
            return strcmp($val1['Descripcion'], $val4['Descripcion']);
        });

        $fetch = array_uintersect($fetch, $fetch5, function ($val1, $val5) {
            return strcmp($val1['Descripcion'], $val5['Descripcion']);
        });

        $fetch = array_uintersect($fetch, $fetch6, function ($val1, $val6) {
            return strcmp($val1['Descripcion'], $val6['Descripcion']);
        });

        $fetch = array_uintersect($fetch, $fetch7, function ($val1, $val7) {
            return strcmp($val1['Descripcion'], $val7['Descripcion']);
        });

        $fetch = array_uintersect($fetch, $fetch8, function ($val1, $val8) {
            return strcmp($val1['Descripcion'], $val8['Descripcion']);
        });

        $fetch = array_uintersect($fetch, $fetch9, function ($val1, $val9) {
            return strcmp($val1['Descripcion'], $val9['Descripcion']);
        });

        $fetch = array_uintersect($fetch, $fetch10, function ($val1, $val10) {
            return strcmp($val1['Descripcion'], $val10['Descripcion']);
        });

        $fetch = array_uintersect($fetch, $fetch11, function ($val1, $val11) {
            return strcmp($val1['Descripcion'], $val11['Descripcion']);
        });

        $fetch = array_uintersect($fetch, $fetch12, function ($val1, $val12) {
            return strcmp($val1['Descripcion'], $val12['Descripcion']);
        });

        $fetch = array_uintersect($fetch, $fetch13, function ($val1, $val13) {
            return strcmp($val1['Descripcion'], $val13['Descripcion']);
        });

        $fetch = array_uintersect($fetch, $fetch14, function ($val1, $val14) {
            return strcmp($val1['Descripcion'], $val14['Descripcion']);
        });

        $fetch = array_uintersect($fetch, $fetch15, function ($val1, $val15) {
            return strcmp($val1['Descripcion'], $val15['Descripcion']);
        });

        $fetch = array_uintersect($fetch, $fetch16, function ($val1, $val16) {
            return strcmp($val1['Descripcion'], $val16['Descripcion']);
        });

        $fetch = array_uintersect($fetch, $fetch17, function ($val1, $val17) {
            return strcmp($val1['Descripcion'], $val17['Descripcion']);
        });

        return $fetch;
    }

    function compareDeepValue($val1, $val2, $val3)
    {
    }
}
