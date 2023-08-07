<?php

require_once 'models/User.php';
require_once 'models/RecruiterCustomer.php';
require_once 'models/ExecutiveJRRecruiter.php';

class EjecutivosController{

	public function de_reclutamiento(){
		if (Utils::isAdmin()) {
			$executive = new User();
			$executive->setId_user_type(2);
			$executives = $executive->getUsersByType();

			for($i=0; $i < count($executives); $i++){
                $path = 'uploads/avatar/'.$executives[$i]['id'];
                if (file_exists($path)) {
                    $directory = opendir($path);
        
                    while ($file = readdir($directory))
                    {
                        if (!is_dir($file)){
                            $type = pathinfo($path, PATHINFO_EXTENSION);
                            $img_content = file_get_contents($path."/".$file);
                            $route = $path.'/'.$file;
                        }
                    }
                }else{
                    $route = "dist/img/user-icon.png";
                    $type = pathinfo($route, PATHINFO_EXTENSION);
                    $img_content = file_get_contents($route);
                }
                //$img_base64 = chunk_split(base64_encode($img_content));
                $img_base64 = 'data:image/' . $type . ';base64,' . base64_encode($img_content);
                $executives[$i]['avatar'] = $img_base64;
                
            }

			$lbl_executives = "Ejecutivos de reclutamiento";

			$page_title = 'Ej. reclutamiento | RRHH Ingenia';
			require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/executive/index.php';
            require_once 'views/layout/footer.php';
		} else {
			header("location:".base_url);
		}
		
	}

	public function de_busqueda(){
		if (Utils::isAdmin()) {
			$executive = new User();
			$executive->setId_user_type(3);
			$executives = $executive->getUsersByType();

			for($i=0; $i < count($executives); $i++){
                $path = 'uploads/avatar/'.$executives[$i]['id'];
                if (file_exists($path)) {
                    $directory = opendir($path);
        
                    while ($file = readdir($directory))
                    {
                        if (!is_dir($file)){
                            $type = pathinfo($path, PATHINFO_EXTENSION);
                            $img_content = file_get_contents($path."/".$file);
                            $route = $path.'/'.$file;
                        }
                    }
                }else{
                    $route = "dist/img/user-icon.png";
                    $type = pathinfo($route, PATHINFO_EXTENSION);
                    $img_content = file_get_contents($route);
                }
                //$img_base64 = chunk_split(base64_encode($img_content));
                $img_base64 = 'data:image/' . $type . ';base64,' . base64_encode($img_content);
                $executives[$i]['avatar'] = $img_base64;
            }


			$lbl_executives = "Ejecutivos de búsqueda";

			$page_title = 'Ej. búsqueda | RRHH Ingenia';
			require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/executive/index.php';
            require_once 'views/layout/footer.php';
		} else {
			header("location:".base_url);
		}	
	}

	public function asignar_clientes(){
		if (Utils::isAdmin() && isset($_GET['id'])) {
			$id = $_GET['id'];
			$executive = new User();
			$executive->setId($id);
			$ejecutivo = $executive->getOne();

			$assign = new RecruiterCustomer();
			$assign->setId_recruiter($id);
			$recruiter_customers = $assign->getCustomersByRecruiter();

			$unassigned_customers = $assign->getUnassignedCustomers();

			require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/executive/customers.php';
            require_once 'views/layout/footer.php';

		} else {
			header("location:".base_url);
		}
		
	}

	public function getRecruiterByCustomer(){
		if (Utils::isValid($_SESSION['identity'])) {
            $customer = isset($_POST['customer']) ? trim($_POST['customer']) : FALSE;
            if ($customer) {
                $rc = new RecruiterCustomer();
                $rc->setId_Customer($customer);
                $recruiter = $rc->getRecruiterByCustomer();
                header('Content-Type: text/html; charset=utf-8');
                echo $json_recruiter_customer = json_encode($recruiter, \JSON_UNESCAPED_UNICODE);
            }else{
                echo 0;
            }
        } else {
            header('location:'.base_url);
        }
	}

	public function add_recruiter_customer(){
		if (isset($_SESSION['identity']) && isset($_POST['id_recruiter']) && isset($_POST['id_customer'])) {
			$id_recruiter = $_POST['id_recruiter'];
			$id_customer = $_POST['id_customer'];

			$assign = new RecruiterCustomer();
			$assign->setId_recruiter($id_recruiter);
			$assign->setId_customer($id_customer);
			$save = $assign->create();

			if ($save) {
				echo 1;
			}else{
				echo 2;
			}
		}else{
			echo 0;
		}
	}

	public function delete_recruiter_customer(){
		if (isset($_SESSION['identity']) && isset($_GET['id_recruiter']) && isset($_GET['id_customer'])) {
			$id_recruiter = $_GET['id_recruiter'];
			$id_customer = $_GET['id_customer'];

			$assign = new RecruiterCustomer();
			$assign->setId_recruiter($id_recruiter);
			$assign->setId_customer($id_customer);
			$delete = $assign->delete();

			header("location:".base_url."ejecutivos/asignar_clientes&id=".$id_recruiter);
		}else{
			header("location:".base_url);
		}
	}

	public function asignar_reclutadores(){
		if (Utils::isAdmin() && isset($_GET['id'])) {
			$id = $_GET['id'];
			$executive = new User();
			$executive->setId($id);
			$ejecutivo = $executive->getOne();

			$assign = new ExecutiveJRRecruiter();
			$assign->setId_executiveJR($id);
			$executiveJR_recruiters = $assign->getRecruitersByExecutiveJR();

			$unassigned_recruiters = $assign->getUnassignedRecruiters();

			require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/executive/recruiters.php';
            require_once 'views/layout/footer.php';

		} else {
			header("location:".base_url);
		}
		
	}

	public function add_executiveJR_recruiter(){
		if (isset($_SESSION['identity']) && isset($_POST['id_recruiter']) && isset($_POST['id_executiveJR'])) {
			$id_executiveJR = $_POST['id_executiveJR'];
			$id_recruiter = $_POST['id_recruiter'];

			$assign = new ExecutiveJRRecruiter();
			$assign->setId_executiveJR($id_executiveJR);
			$assign->setId_recruiter($id_recruiter);
			
			$save = $assign->create();

			if ($save) {
				echo 1;
			}else{
				echo 2;
			}
		}else{
			echo 0;
		}
	}

	public function delete_executiveJR_recruiter(){
		if (isset($_SESSION['identity']) && isset($_GET['id_recruiter']) && isset($_GET['id_executiveJR'])) {
			$id_executiveJR = $_GET['id_executiveJR'];
			$id_recruiter = $_GET['id_recruiter'];

			$assign = new ExecutiveJRRecruiter();
			$assign->setId_executiveJR($id_executiveJR);
			$assign->setId_recruiter($id_recruiter);
			$delete = $assign->delete();

			header("location:".base_url."ejecutivos/asignar_reclutadores&id=".$id_executiveJR);
		}else{
			header("location:".base_url);
		}
	}

}