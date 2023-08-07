<?php

require_once 'models/User.php';
require_once 'models/SA/EjecutivosPlazas.php';
require_once 'models/SA/EjecutivosLogistica.php';
require_once 'models/RecruiterCustomer.php';
require_once 'models/SA/Candidatos.php';

class Ejecutivos_SAController
{

	public function de_cuenta()
	{
		if (Utils::isAdmin()|| Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() ) {
			$executive = new User();
			$executive->setId_user_type(13);
			$executives = $executive->getUsersByType();

			for ($i = 0; $i < count($executives); $i++) {
				$path = 'uploads/avatar/' . $executives[$i]['id'];
				if (file_exists($path)) {
					$directory = opendir($path);

					while ($file = readdir($directory)) {
						if (!is_dir($file)) {
							$type = pathinfo($path, PATHINFO_EXTENSION);
							$img_content = file_get_contents($path . "/" . $file);
							$route = $path . '/' . $file;
						}
					}
				} else {
					$route = "dist/img/user-icon.png";
					$type = pathinfo($route, PATHINFO_EXTENSION);
					$img_content = file_get_contents($route);
				}
				//$img_base64 = chunk_split(base64_encode($img_content));
				
				//$img_base64 = 'data:image/' . $type . ';base64,' . base64_encode($img_content);
				$executives[$i]['avatar'] = base_url.$route;
			}

			$lbl_executives = "Ejecutivos de cuenta";

			$page_title = 'Ejecutivos de cuenta | RRHH Ingenia';
			require_once 'views/layout/header.php';
			require_once 'views/layout/sidebar.php';
			require_once 'views/executive/index.php';
			require_once 'views/layout/footer.php';
		} else {
			header("location:" . base_url);
		}
	}

	public function de_logistica()
	{
		if (Utils::isAdmin()|| Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() ) {
			$executive = new User();
			$executive->setId_user_type(14);
			$executives = $executive->getUsersByType();

			for ($i = 0; $i < count($executives); $i++) {
				$path = 'uploads/avatar/' . $executives[$i]['id'];
				if (file_exists($path)) {
					$directory = opendir($path);

					while ($file = readdir($directory)) {
						if (!is_dir($file)) {
							$type = pathinfo($path, PATHINFO_EXTENSION);
							$img_content = file_get_contents($path . "/" . $file);
							$route = $path . '/' . $file;
						}
					}
				} else {
					$route = "dist/img/user-icon.png";
					$type = pathinfo($route, PATHINFO_EXTENSION);
					$img_content = file_get_contents($route);
				}
				//$img_base64 = chunk_split(base64_encode($img_content));
				
				//$img_base64 = 'data:image/' . $type . ';base64,' . base64_encode($img_content);
				$executives[$i]['avatar'] = base_url.$route;
			}


			$lbl_executives = "Ejecutivos de logística";

			$page_title = 'Ejecutivos de logística | RRHH Ingenia';
			require_once 'views/layout/header.php';
			require_once 'views/layout/sidebar.php';
			require_once 'views/executive/index.php';
			require_once 'views/layout/footer.php';
		} else {
			header("location:" . base_url);
		}
	}

	public function asignar_clientes()
	{
		if ((Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isManager()) && isset($_GET['user'])) {
			$user = Encryption::decode($_GET['user']);
			$executive = new User();
			$executive->setId($user);
			$ejecutivo = $executive->getOne();

			$assign = new EjecutivosPlazas();
			$assign->setID_Ejecutivo($ejecutivo->username);

			$recruiter_customers = $assign->getClientesPorEjecutivo();
			$unassigned_customers = $assign->getClientesSinAsignar();
		$Estudios='';
			$page_title = $ejecutivo->first_name . ' ' . $ejecutivo->last_name . ' | RRHH Ingenia';
			require_once 'views/layout/header.php';
			require_once 'views/layout/sidebar.php';
			require_once 'views/executive/customers.php';
			require_once 'views/layout/footer.php';
		} else
			header("location:" . base_url);
	}

	public function asignar_ejecutivos()
	{

		if ((Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isManager()) && isset($_GET['user'])) {
			$user = Encryption::decode($_GET['user']);
			$executive = new User();
			$executive->setId($user);
			$ejecutivo = $executive->getOne();

			$executive->setId_user_type(13);
			$executives = $executive->getUsersByType();

			$assign = new EjecutivosLogistica();
			$assign->setUsuario_Apoyo($ejecutivo->username);
			$executiveJR_cuenta = $assign->getEjecutivosPorLogistica();

			require_once 'views/layout/header.php';
			require_once 'views/layout/sidebar.php';
			require_once 'views/executive/customersLogistica.php';
			require_once 'views/layout/footer.php';
		} else {
			header("location:" . base_url);
		}
	}

	public function getRecruiterByCustomer()
	{
		if (Utils::isValid($_SESSION['identity'])) {
			$customer = isset($_POST['customer']) ? trim($_POST['customer']) : FALSE;
			if ($customer) {
				$rc = new RecruiterCustomer();
				$rc->setId_Customer($customer);
				$recruiter = $rc->getRecruiterByCustomer();
				header('Content-Type: text/html; charset=utf-8');
				echo $json_recruiter_customer = json_encode($recruiter, \JSON_UNESCAPED_UNICODE);
			} else {
				echo 0;
			}
		} else {
			header('location:' . base_url);
		}
	}

	public function add_recruiter_customer()
	{
		if (isset($_SESSION['identity']) && isset($_POST['id_recruiter']) && isset($_POST['id_customer'])) {

			$id_recruiter = Encryption::decode($_POST['id_recruiter']);
			$id_customer =  Encryption::decode($_POST['id_customer']);

			if ($id_recruiter && $id_customer) {
				$assign = new RecruiterCustomer();
				$assign->setId_recruiter($id_recruiter);
				$assign->setId_customer($id_customer);
				$save = $assign->create();

				if ($save) {
					echo 1;
				} else {
					echo 2;
				}
			} else {
				echo 0;
			}
		} else {
			echo 0;
		}
	}

	public function delete_recruiter_customer()
	{
		if (isset($_SESSION['identity']) && isset($_GET['id_recruiter']) && isset($_GET['id_customer'])) {
			$id_recruiter = $_GET['id_recruiter'];
			$id_customer = $_GET['id_customer'];

			$assign = new RecruiterCustomer();
			$assign->setId_recruiter($id_recruiter);
			$assign->setId_customer($id_customer);
			$delete = $assign->delete();

			header("location:" . base_url . "ejecutivos/asignar_clientes&id=" . $id_recruiter);
		} else {
			header("location:" . base_url);
		}
	}



	public function add_executiveJR_recruiter()
	{
		if (isset($_SESSION['identity']) && isset($_POST['id_recruiter']) && isset($_POST['id_executiveJR'])) {
			$id_executiveJR = $_POST['id_executiveJR'];
			$id_recruiter = $_POST['id_recruiter'];

			$assign = new ExecutiveJRRecruiter();
			$assign->setId_executiveJR($id_executiveJR);
			$assign->setId_recruiter($id_recruiter);

			$save = $assign->create();

			if ($save) {
				echo 1;
			} else {
				echo 2;
			}
		} else {
			echo 0;
		}
	}

	public function delete_executiveJR_recruiter()
	{
		if (isset($_SESSION['identity']) && isset($_GET['id_recruiter']) && isset($_GET['id_executiveJR'])) {
			$id_executiveJR = $_GET['id_executiveJR'];
			$id_recruiter = $_GET['id_recruiter'];

			$assign = new ExecutiveJRRecruiter();
			$assign->setId_executiveJR($id_executiveJR);
			$assign->setId_recruiter($id_recruiter);
			$delete = $assign->delete();

			header("location:" . base_url . "ejecutivos/asignar_reclutadores&id=" . $id_executiveJR);
		} else {
			header("location:" . base_url);
		}
	}

	public function agregar_cliente_ejecutivoSA()
	{
		if (isset($_SESSION['identity'])&&(Utils::isAdmin()|| Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor())) {
			$id_recruiter = Encryption::decode($_POST['id_recruiter']);
			$id_customer =  Encryption::decode($_POST['id_customer']);

			$userObj = new User();
			$userObj->setId($id_recruiter);
			$username = $userObj->getOne()->username;

			if ($id_recruiter && $id_customer) {
				$ejecutivosplazasObj = new EjecutivosPlazas();
				$ejecutivosplazasObj->setID_Cliente($id_customer);
				$ejecutivosplazasObj->setID_Empresa(0);
				$ejecutivosplazasObj->setID_Ejecutivo($username);
				$save = $ejecutivosplazasObj->create();

				if ($save) {
					$ejecutivosplazasObj->setID_Ejecutivo($username);
					$recruiter_customers = $ejecutivosplazasObj->getClientesPorEjecutivo();
					for ($i = 0; $i < count($recruiter_customers); $i++) {
						$recruiter_customers[$i]['ID'] = Encryption::encode($recruiter_customers[$i]['ID']);
					}

					$unassigned_customers = $ejecutivosplazasObj->getClientesSinAsignar();
					for ($i = 0; $i < count($unassigned_customers); $i++) {
						$unassigned_customers[$i]['Cliente'] = Encryption::encode($unassigned_customers[$i]['Cliente']);
					}

					echo json_encode(array(
						'status' => 1,
						'recruiter_customers' => $recruiter_customers,
						'unassigned_customers' => $unassigned_customers
					));
				} else
					echo json_encode(array('status' => 2));
			} else
				echo json_encode(array('status' => 0));
		} else
			echo json_encode(array('status' => 0));
	}

	public function eliminar_cliente_ejecutivoSA()
	{
		if (isset($_SESSION['identity'])&&(Utils::isAdmin()|| Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor())) {
			$id = Encryption::decode($_POST['id']);

			if ($id) {
				$ejecutivosplazasObj = new EjecutivosPlazas();
				$ejecutivosplazasObj->setID($id);
				$username = $ejecutivosplazasObj->getOne()->ID_Ejecutivo;
				$ejecutivosplazasObj->setID_Ejecutivo($username);
				$delete = $ejecutivosplazasObj->delete();


				if ($delete) {
					$ejecutivosplazasObj->setID_Ejecutivo($username);
					$recruiter_customers = $ejecutivosplazasObj->getClientesPorEjecutivo();
					for ($i = 0; $i < count($recruiter_customers); $i++) {
						$recruiter_customers[$i]['ID'] = Encryption::encode($recruiter_customers[$i]['ID']);
					}

					$unassigned_customers = $ejecutivosplazasObj->getClientesSinAsignar();
					for ($i = 0; $i < count($unassigned_customers); $i++) {
						$unassigned_customers[$i]['Cliente'] = Encryption::encode($unassigned_customers[$i]['Cliente']);
					}

					echo json_encode(array(
						'status' => 1,
						'recruiter_customers' => $recruiter_customers,
						'unassigned_customers' => $unassigned_customers
					));
				} else
					echo json_encode(array('status' => 2));
			} else
				echo json_encode(array('status' => 0));
		} else
			echo json_encode(array('status' => 0));
	}



	public function agregar_ejecutivoSA()
	{
		if (isset($_SESSION['identity'])&&(Utils::isAdmin()|| Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor())) {
			$ejecutivo = Encryption::decode($_POST['ejecutivo']);
			$usuario_Apoyo =  Encryption::decode($_POST['usuario_Apoyo']);

			if ($ejecutivo && $usuario_Apoyo) {
				$ejecutivoObj = new EjecutivosLogistica();
				$ejecutivoObj->setEjecutivo($ejecutivo);
				$ejecutivoObj->setUsuario_Apoyo($usuario_Apoyo);
				$flag = $ejecutivoObj->getOne();

				if ($flag == false) {
					$save = $ejecutivoObj->create();

					if ($save) {
						/* 	$executive = new User();
					$executive->setId_user_type(13);
					$executives = $executive->getUsersByType(); */

						$executiveJR_cuenta = $ejecutivoObj->getEjecutivosPorLogistica();
						for ($i = 0; $i < count($executiveJR_cuenta); $i++) {
							$executiveJR_cuenta[$i]['username'] = Encryption::encode($executiveJR_cuenta[$i]['username']);
						}

						echo json_encode(array(
							'status' => 1,
							'executiveJR_cuenta' => $executiveJR_cuenta,
						));
					} else
						echo json_encode(array('status' => 2));
				} else {
					echo json_encode(array('status' => 3));
				}
			} else
				echo json_encode(array('status' => 0));
		} else
			echo json_encode(array('status' => 0));
	}


	public function eliminar_ejecutivoSA()
	{
		if (isset($_SESSION['identity'])&&(Utils::isAdmin()|| Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor())) {
			$ejecutivo = Encryption::decode($_POST['ejecutivo']);
			$usuario_Apoyo =  Encryption::decode($_POST['usuario_Apoyo']);

			if ($ejecutivo && $usuario_Apoyo) {
				$ejecutivoObj = new EjecutivosLogistica();
				$ejecutivoObj->setEjecutivo($ejecutivo);
				$ejecutivoObj->setUsuario_Apoyo($usuario_Apoyo);

				$delete = $ejecutivoObj->delete();

				if ($delete) {
					/* 	$executive = new User();
					$executive->setId_user_type(13);
					$executives = $executive->getUsersByType(); */

					$executiveJR_cuenta = $ejecutivoObj->getEjecutivosPorLogistica();
					for ($i = 0; $i < count($executiveJR_cuenta); $i++) {
						$executiveJR_cuenta[$i]['username'] = Encryption::encode($executiveJR_cuenta[$i]['username']);
					}

					echo json_encode(array(
						'status' => 1,
						'executiveJR_cuenta' => $executiveJR_cuenta,
					));
				} else
					echo json_encode(array('status' => 2));
			} else
				echo json_encode(array('status' => 0));
		} else
			echo json_encode(array('status' => 0));
	}

	public function desactivar_ejecutivoSA()
	{

		if (isset($_SESSION['identity'])&&(Utils::isAdmin()|| Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor())) {
			$id = Encryption::decode($_POST['id']);

			if ($id) {
				$userObj = new User();
				$userObj->setId($id);
				$user = $userObj->getOne();

				$username = $user->username;
				$userType = $user->id_user_type;

				$userObj->setActivation(0);
				$flag = $userObj->updateActivation();


				if ($flag) {
					if ($userType == 14||$userType == 13) {
						//cuenta
						$ejecutivoPlazaObj = new EjecutivosPlazas();
						$ejecutivoPlazaObj->setID_Ejecutivo($username);
						$ejecutivoPlazaObj->deleteAll();

						/*if ($ejecutivoPlazaObj->getOneByIdEjecutivo() == true) {
							$ejecutivoPlazaObj->deleteAll();
						}*/

						$userObj->setId_user_type($userType);
						$controlador = 'ejecutivos_SA/asignar_clientes';
					}/*  else if ($userType == 14) {
						//logistica
						$ejecutivoObj = new EjecutivosLogistica();
						$ejecutivoObj->setUsuario_Apoyo($username);
						if ($ejecutivoObj->getOneByEjecutivo() == true) {
							$ejecutivoObj->deleteAll();
						}

						$controlador = 'ejecutivos_SA/asignar_ejecutivos';
						$userObj->setId_user_type(14);
					}  */else if ($userType == 2) {
						//reclu

						$controlador = 'ejecutivos/asignar_clientes';
						$userObj->setId_user_type(2);
					} else {
						echo json_encode(array('status' => 3)); //si no es ninguno de los dos tipos
						die();
					}

					$executives = $userObj->getUsersByType();

					for ($i = 0; $i < count($executives); $i++) {
						$path = 'uploads/avatar/' . $executives[$i]['id'];
						if (file_exists($path)) {
							$directory = opendir($path);

							while ($file = readdir($directory)) {
								if (!is_dir($file)) {
									$type = pathinfo($path, PATHINFO_EXTENSION);
									$img_content = file_get_contents($path . "/" . $file);
									$route = $path . '/' . $file;
								}
							}
						} else {
							$route = "dist/img/user-icon.png";
							$type = pathinfo($route, PATHINFO_EXTENSION);
							$img_content = file_get_contents($route);
						}
						$img_base64 = 'data:image/' . $type . ';base64,' . base64_encode($img_content);
						$executives[$i]['avatar'] = $img_base64;
					}

					for ($i = 0; $i < count($executives); $i++) {

						$executives[$i]['id']=Encryption::encode($executives[$i]['id']);
						$executives[$i]['link'] = base_url . $controlador . '&user=' . Encryption::encode($executives[$i]['id']);
					}

					echo json_encode(array(
						'status' => 1,
						'executives' => $executives,
					));
				} else
					echo json_encode(array('status' => 0));
			} else
				echo json_encode(array('status' => 0));
		}
	}
}
