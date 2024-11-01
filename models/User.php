<?php
class User {
    private $id;
    private $username;
    private $password;
    private $first_name;
    private $last_name;
    private $email;
    private $last_session;
    private $activation;
    private $token;
    private $token_password;
    private $password_request;
    private $id_user_type;
    private $dark_mode;
    private $db;

    public function __construct()
    {
        $this->db = Connection::connect();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        //return password_hash($this->password, PASSWORD_BCRYPT, ['cost' => 4]);
        return $this->password;
    }

    public function getHashPassword()
    {
        //return password_hash($this->password, PASSWORD_BCRYPT, ['cost' => 4]);
        return Utils::encrypt($this->password);
    }

    public function getFirst_name()
    {
        return $this->first_name;
    }

    public function getLast_name()
    {
        return $this->last_name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getLast_session()
    {
        return $this->last_session;
    }

    public function getActivation()
    {
        return $this->activation;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function getTokenMD5()
    {
        return md5(uniqid(mt_rand(), false));
    }

    public function getToken_password()
    {
        return $this->token_password;
    }

    public function getPassword_request()
    {
        return $this->password_request;
    }

    public function getId_user_type()
    {
        return $this->id_user_type;
    }

    public function getDark_mode()
    {
        return $this->dark_mode;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setFirst_name($first_name)
    {
        $this->first_name = $first_name;
    }

    public function setLast_name($last_name)
    {
        $this->last_name = $last_name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setLast_session($last_session)
    {
        $this->last_session = $last_session;
    }

    public function setActivation($activation)
    {
        $this->activation = $activation;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function setToken_password($token_password)
    {
        $this->token_password = $token_password;
    }

    public function setPassword_request($password_request)
    {
        $this->password_request = $password_request;
    }

    public function setId_user_type($id_user_type)
    {
        $this->id_user_type = $id_user_type;
    }

    public function setDark_mode($dark_mode)
    {
        $this->dark_mode = $dark_mode;
    }

    public function getUserTypes()
    {
        $stmt = $this->db->prepare("SELECT * FROM tipo_usuario ORDER BY id ASC;");
        $stmt->execute();
        $roles = $stmt->fetchAll();
        return $roles;
    }



    public function getOne()
    {
        $id = $this->getId();
        $stmt = $this->db->prepare("SELECT u.*, t.tipo_usuario FROM usuarios u INNER JOIN tipo_usuario t ON u.id_tipo_usuario=t.id  WHERE u.id=:id;");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        $fetch = $stmt->fetchObject();
        return $fetch;
    }

    public function getAll()
    {
        $stmt = $this->db->prepare("SELECT * FROM usuarios u INNER JOIN tipo_usuario t ON u.id_tipo_usuario=t.id ORDER BY u.id ASC");
        $stmt->execute();
        $usuarios = $stmt->fetchAll();
        return $usuarios;
    }



    public function userExists()
    {
        $result = FALSE;
        $username = $this->getUsername();
        $stmt = $this->db->prepare("SELECT TOP 1 id, username FROM users WHERE username = :username", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        $num = $stmt->rowCount();
        if ($num > 0) {
            $result = $fetch->username;
            $this->setId($fetch->id);
        }
        return $result;
    }

    public function emailExists()
    {
        $result = FALSE;
        $email = $this->getEmail();
        $stmt = $this->db->prepare("SELECT TOP 1 id, email FROM users WHERE email = :email", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        $num = $stmt->rowCount();
        if ($num > 0) {
            $result = $fetch->email;
            $this->setId($fetch->id);
        }
        return $result;
    }

    public function save()
    {

        $result = false;

        $username = $this->getUsername();
        $password = $this->getHashPassword();
        $first_name = $this->getFirst_name();
        $last_name = $this->getLast_name();
        $email = $this->getEmail();
        $activation = $this->getActivation();
        $token = $this->getTokenMD5();
        $id_user_type = $this->getId_user_type();

        $stmt = $this->db->prepare("INSERT INTO users (username, password, first_name, last_name, email, activation, token, id_user_type, created_at, modified_at) VALUES(:username, :password, :first_name, :last_name, :email, :activationn , :token, :id_user_type, GETDATE(), GETDATE())");
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->bindParam(":password", $password, PDO::PARAM_STR);
        $stmt->bindParam(":first_name", $first_name, PDO::PARAM_STR);
        $stmt->bindParam(":last_name", $last_name, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":activationn", $activation, PDO::PARAM_INT);
        $stmt->bindParam(":token", $token, PDO::PARAM_STR);
        $stmt->bindParam(":id_user_type", $id_user_type, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
            $this->setId($this->db->lastInsertId());
            $this->setToken($token);
        }

        return $result;
    }

    public function updateToken()
    {
        $id = $this->getId();
        $token = $this->getTokenMD5();
        $this->setToken($token);

        $stmt = $this->db->prepare("UPDATE users SET token=:token WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":token", $token, PDO::PARAM_STR);
        $result = $stmt->execute();
        return $result;
    }

    public function activateUser($id)
    {

        $stmt = $this->db->prepare("UPDATE users SET activation=1 WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $result = $stmt->execute();
        return $result;
    }

    public function validateIdToken($id, $token)
    {

        $stmt = $this->db->prepare("SELECT TOP 1 activation FROM users WHERE id = :id AND token = :token", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":token", $token, PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->rowCount();

        if ($rows > 0) {
            $fetch = $stmt->fetchObject();
            if ($fetch->activation == 1) {
                $case = 1;
            } else {
                if ($this->activateUser($id)) {
                    $case = 2;
                } else {
                    $case = 3;
                }
            }
        } else {
            $case = 4;
        }
        return $case;
    }

    public function lastSession($id)
    {

        $stmt = $this->db->prepare("UPDATE users SET last_session=GETDATE(), token_password='', password_request=1 WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function login()
    {
        $result = FALSE;
        //$email = $this->getEmail();
        $password = $this->getPassword();
        $username = $this->getUsername();

        $stmt = $this->db->prepare("SELECT * FROM usuarios u INNER JOIN tipo_usuario tu ON u.id_tipo_usuario = tu.id WHERE usuario = :usuario AND password = :password");
        $stmt->bindParam(":usuario", $username, PDO::PARAM_STR);
        $stmt->bindParam(":password", $password, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetchObject();
        return $result;
    }

    public function loginWithEmail()
    {
        $result = FALSE;
        $email = $this->getEmail();

        $stmt = $this->db->prepare("SELECT TOP 1 u.*, t.user_type FROM users u INNER JOIN user_types t ON u.id_user_type=t.id WHERE email = :email", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();

        $fetch = $stmt->fetchObject();
        $numRows = $stmt->rowCount();

        if ($fetch && $numRows == 1) {
            $result = $fetch;
        }
        return $result;
    }

    public function update()
    {
        $id = $this->getId();
        $first_name = $this->getFirst_name();
        $last_name = $this->getLast_name();

        $stmt = $this->db->prepare("UPDATE users SET first_name=:first_name, last_name=:last_name, modified_at=GETDATE() WHERE id=:id");
        $stmt->bindParam(":first_name", $first_name, PDO::PARAM_STR);
        $stmt->bindParam(":last_name", $last_name, PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }

        return $result;
    }

    public function updateUser()
    {
        $id = $this->getId();
        $first_name = $this->getFirst_name();
        $last_name = $this->getLast_name();
        $password = $this->getPassword();
        $id_user_type = $this->getId_user_type();

        $stmt = $this->db->prepare("UPDATE users 
        SET first_name=:first_name,last_name=:last_name, password=:password,id_user_type=:id_user_type, modified_at=GETDATE() 
        WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        $stmt->bindParam(":first_name", $first_name, PDO::PARAM_STR);
        $stmt->bindParam(":last_name", $last_name, PDO::PARAM_STR);
        $stmt->bindParam(":password", $password, PDO::PARAM_INT);
        $stmt->bindParam(":id_user_type", $id_user_type, PDO::PARAM_INT);
        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }

        return $result;
    }

    public function updateUserEmail()
    {
        $id = $this->getId();
        $email = $this->getEmail();

        $stmt = $this->db->prepare("UPDATE users 
        SET email=:email, modified_at=GETDATE() 
        WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_INT);
        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }

    public function updateUserName()
    {
        $id = $this->getId();
        $username = $this->getUsername();

        $stmt = $this->db->prepare("UPDATE users 
        SET username=:username, modified_at=GETDATE() 
        WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }


    public function delete()
    {
        $result = false;

        $username = $this->getUsername();

        $stmt = $this->db->prepare("DELETE FROM users WHERE username=:username");
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }


    //obtengo el id de acuerdo al email proporcionado
    public function getIdWithEmail()
    {
        $email = $this->getEmail();
        $stmt = $this->db->prepare("SELECT id FROM users WHERE email=:email");
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();

        $fetch = $stmt->fetchObject();
        return $fetch->id;
    }

    //obtengo el nombre de acuerdo al email proporcionado
    public function getNameWithEmail()
    {
        $email = $this->getEmail();
        $stmt = $this->db->prepare("SELECT CONCAT(first_name, ' ', last_name) as name FROM users WHERE email=:email");
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();

        $fetch = $stmt->fetchObject();
        return $fetch->name;
    }

    public function generateToken_password()
    {
        $token = $this->getTokenMD5();
        $id = $this->getId();
        $stmt = $this->db->prepare("UPDATE users SET token_password=:token_password, password_request=1 WHERE id=:id");
        $stmt->bindParam(":token_password", $token, PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        return $token;
    }

    public function verifyToken_password()
    {
        $id = $this->getId();
        $token = $this->getToken_password();
        $stmt = $this->db->prepare("SELECT TOP 1 activation FROM users WHERE id=:id AND token_password=:token_password AND password_request=1", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":token_password", $token, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        $numRows = $stmt->rowCount();

        if ($fetch && $numRows == 1) {
            /* if ($fetch->activation == 1) {
                return true;
            }else{
                return false;
            } */
            return true;
        } else {
            return false;
        }
    }

    public function changePassword()
    {
        $id = $this->getId();
        $password = $this->getHashPassword();
        $token_password = $this->getToken_password();
        $stmt = $this->db->prepare("UPDATE users SET password=:password, token_password='', password_request=0, activation=1 WHERE id=:id AND token_password=:token_password");
        $stmt->bindParam(":password", $password, PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":token_password", $token_password, PDO::PARAM_STR);
        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }

        return $result;
    }

    public function updatePassword()
    {
        $id = $this->getId();
        $password = $this->getHashPassword();
        $stmt = $this->db->prepare("UPDATE users SET password=:password WHERE id=:id");
        $stmt->bindParam(":password", $password, PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }

        return $result;
    }



    public function getEmployees()
    {
        //$stmt = $this->db->prepare("SELECT u.id, username, first_name, last_name, password, email, last_session , user_type FROM users u INNER JOIN user_types t ON u.id_user_type=t.id WHERE id_user_type <> 6 AND id_user_type <> 7 AND id_user_type <> 15 AND activation = 1 ORDER BY username ASC");
        $stmt = $this->db->prepare("SELECT u.id, username, first_name, last_name, password, email, last_session , user_type FROM users u INNER JOIN user_types t ON u.id_user_type=t.id WHERE  id_user_type <> 7  AND activation = 1 ORDER BY username ASC");
        $stmt->execute();
        $users = $stmt->fetchAll();
        return $users;
    }


    public function getUsersByType()
    {
        $id_user_type = $this->getId_user_type();

        if ($id_user_type == 2) {
            $stmt = $this->db->prepare("SELECT id, username, first_name, last_name, email, last_session FROM users WHERE id_user_type=:id_user_type AND activation=1 OR (id=21 OR id=3712 OR id=24) ORDER BY username ASC;");
        } elseif ($id_user_type == 13) {
            $stmt = $this->db->prepare("SELECT id, username, first_name, last_name, email, last_session, UPPER(username) AS Usuario, CONCAT(first_name, ' ', last_name) AS Nombre FROM users WHERE id_user_type=:id_user_type AND activation=1 OR (id_user_type=11 OR id_user_type=10) ORDER BY username ASC");
        } else {
            $stmt = $this->db->prepare("SELECT id, username, first_name, last_name, email, last_session, UPPER(username) AS Usuario, CONCAT(first_name, ' ', last_name) AS Nombre FROM users WHERE id_user_type=:id_user_type AND activation=1 ORDER BY username ASC;");
        }

        $stmt->bindParam(":id_user_type", $id_user_type, PDO::PARAM_INT);
        $stmt->execute();
        $recruiters = $stmt->fetchAll();
        return $recruiters;
    }

    public function edit()
    {
        $id = $this->getId();
        $first_name = $this->getFirst_name();
        $last_name = $this->getLast_name();
        $email = $this->getEmail();
        $username = $this->getUsername();
        $password = $this->getHashPassword();
        $id_user_type = $this->getId_user_type();

        $stmt = $this->db->prepare("UPDATE users SET first_name=:first_name, last_name=:last_name, email=:email, username=:username, password=:password, id_user_type=:id_user_type, modified_at=GETDATE() WHERE id=:id");
        $stmt->bindParam(":first_name", $first_name, PDO::PARAM_STR);
        $stmt->bindParam(":last_name", $last_name, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->bindParam(":password", $password, PDO::PARAM_STR);
        $stmt->bindParam(":id_user_type", $id_user_type, PDO::PARAM_INT);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }

        return $result;
    }

    public function darkMode()
    {
        $id = $this->getId();
        $dark_mode = $this->getDark_mode();

        $stmt = $this->db->prepare("UPDATE users SET dark_mode=:dark_mode WHERE id = :id");
        $stmt->bindParam(":dark_mode", $dark_mode, PDO::PARAM_INT);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $result = $stmt->execute();
        return $result;
    }

    public function getUserByUsername()
    {
        $username = $this->getusername();
        $stmt = $this->db->prepare("SELECT id, first_name, last_name, username, password, email FROM users WHERE username=:username");
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->execute();

        $fetch = $stmt->fetchObject();
        return $fetch;
    }


    public function updateActivation()
    {
        $id = $this->getId();
        $activation = $this->getActivation();
        $stmt = $this->db->prepare("UPDATE users set activation=:activation WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        $stmt->bindParam(":activation", $activation, PDO::PARAM_STR);
        $fetch = $stmt->execute();
        return $fetch;
    }

    public function getEmployeesInactive()
    {
        $stmt = $this->db->prepare("SELECT u.id, username, first_name, last_name, password, email, last_session , user_type FROM users u INNER JOIN user_types t ON u.id_user_type=t.id WHERE id_user_type <> 6 AND id_user_type <> 7 AND id_user_type <> 1 AND activation = 0 ORDER BY username ASC");
        $stmt->execute();
        $users = $stmt->fetchAll();
        return $users;
    }

    public function showUsuariosByVentas()
    {
        $stmt = $this->db->prepare("SELECT u.id, username, first_name, last_name, password, email, last_session , user_type FROM users u INNER JOIN user_types t ON u.id_user_type=t.id WHERE id_user_type =5 OR id_user_type=8 AND activation = 1 ORDER BY username ASC");
        $stmt->execute();
        $users = $stmt->fetchAll();
        return $users;
    }
    public function getOneByUsername()
    {
        $username = $this->getUsername();
        $stmt = $this->db->prepare("SELECT TOP 1 * FROM users WHERE username = :username");
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }

    public function getOneByEmail()
    {
        $result = FALSE;
        $email = $this->getEmail();
        $stmt = $this->db->prepare("SELECT TOP 1 * FROM users WHERE email = :email");
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }


    public function getAllUserIngenia()
    {
        $stmt = $this->db->prepare("SELECT * from users where (id_user_type<>1 AND  id_user_type<>6 AND id_user_type<>7 AND id_user_type<>16 AND  id_user_type<>15 ) AND activation=1");
        $stmt->execute();
        $users = $stmt->fetchAll();
        return $users;
    }


    public function updatePasword()
    {
        $id = $this->getId();
        $password = $this->getPassword();
        $stmt = $this->db->prepare("UPDATE top(1) users set password=:password WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        $stmt->bindParam(":password", $password, PDO::PARAM_STR);
        $fetch = $stmt->execute();
        return $fetch;
    }
}
