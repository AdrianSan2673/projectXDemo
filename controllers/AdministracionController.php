<?php

require_once 'models/User.php';
require_once 'models/Bill.php';
require_once 'models/BillFollowUp.php';
require_once 'models/PurchaseOrder.php';
require_once 'models/PurchaseOrderFollowUp.php';
require_once 'models/Vacancy.php';
require_once 'models/VacancyApplicant.php';
require_once 'models/BusinessName.php';
require_once 'models/Psychometry.php';
require_once 'models/TalentAttraction.php';
require_once 'models/SA/RazonesSociales.php'; 

class AdministracionController{

	public function facturacion(){
		if (Utils::isAdmin() || Utils::isManager()) {
            $vacancy = new Vacancy();
            if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
                if ($_POST['start_date'] > $_POST['end_date']) {
                    $aux = $_POST['start_date'];
                    $_POST['start_date'] = $_POST['end_date'];
                    $_POST['end_date'] = $aux;
                }

                $vacancy->setRequest_date($_POST['start_date']);
                $vacancy->setEnd_date($_POST['end_date']);
                $vacancies = $vacancy->getVacanciesByDateRange();
            }
            /* elseif (isset($_POST['submit'])) {
                
                for ($i=0; $i < count($_POST['id']); $i++) { 
                    echo($_POST['id'][$i]. ' '. $_POST['folio'][$i].'<br>');

                }
                die();
            } */
            else {
                $vacancies = $vacancy->getVacanciesFromCurrentWeek(); 
            }

			$page_title = 'Facturación | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/management/billing.php';
            require_once 'views/layout/footer.php';
		} else {
			header("location:".base_url);
		}
		
    }
    
    public function facturacion_psicometrias(){
		if (Utils::isAdmin() || Utils::isManager()) {
            $psychometry = new Psychometry();
            if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
                if ($_POST['start_date'] > $_POST['end_date']) {
                    $aux = $_POST['start_date'];
                    $_POST['start_date'] = $_POST['end_date'];
                    $_POST['end_date'] = $aux;
                }
                $psychometry->setRequest_date($_POST['start_date']);
                $psychometry->setEnd_date($_POST['end_date']);
                $psychometrics = $psychometry->getPsychometricsByDateRange();
                
            }
            /* elseif (isset($_POST['submit'])) {
                
                for ($i=0; $i < count($_POST['id']); $i++) { 
                    echo($_POST['id'][$i]. ' '. $_POST['folio'][$i].'<br>');

                }
                die();
            } */
            else {
                $psychometrics = $psychometry->getPsychometricsFromCurrentWeek(); 
                
            }

			$page_title = 'Facturación Psicometrías | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/management/billing_psycho.php';
            require_once 'views/layout/footer.php';
		} else {
			header("location:".base_url);
		}
		
	}

    public function facturacion_at(){
		if (Utils::isAdmin() || Utils::isManager()) {
            $at = new TalentAttraction();
            if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
                if ($_POST['start_date'] > $_POST['end_date']) {
                    $aux = $_POST['start_date'];
                    $_POST['start_date'] = $_POST['end_date'];
                    $_POST['end_date'] = $aux;
                }
                $at->setRequest_date($_POST['start_date']);
                $at->setEnd_date($_POST['end_date']);
                $attractions = $at->getAttractionsByDateRange();
                
            }
            else
                $attractions = $at->getAttractionsFromTheLast60Days(); 

			$page_title = 'Facturación Atracción de Talento | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/management/billing_at.php';
            require_once 'views/layout/footer.php';
		} else {
			header("location:".base_url);
		}
		
	}

    public function cobranza(){
		if (Utils::isAdmin() || Utils::isManager()) {
            $bill = new Bill();
            if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
                
            }
            else {
                $bill->setStatus(1);
                $bills = $bill->getBillsByStatus();

                $bill->setStatus(2);
                $paid_bills = $bill->getBillsByStatus(); 
				
				$bill->setStatus(3);
                $cancelled_bills = $bill->getBillsByStatus();
            }

			$page_title = 'Cobranza | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
             require_once 'views/management/modal-gestionar-factura.php';
            require_once 'views/management/collection.php';
			require_once 'views/management/modal-info-cancelled.php';
            require_once 'views/management/modal-editar-factura.php';
            require_once 'views/layout/footer.php';
		} else {
			header("location:".base_url);
		}	
    }

    public function editar_factura(){
		if (Utils::isAdmin() || Utils::isManager()) {
            if (isset($_GET['id'])) {
                $id = Encryption::decode($_GET['id']);
                $bill = new Bill();
                $bill->setId($id);
                $applicants = $bill->getApplicantsByBill();
                $psychometrics = $bill->getPsychometricsByBill();
                $attractions = $bill->getTalentAttractionsByBill();
				$follow_ups = $bill->getFollowUpsByBill();

                $factura = $bill->getOne();
                $folio = $factura->folio;
            }
            else {
                header("location:".base_url."administracion/cobranza");
            }

			$page_title = "{$folio} Factura | RRHH Ingenia";
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/management/bill_edit.php';
            require_once 'views/layout/footer.php';
		} else {
			header("location:".base_url);
		}	
    }

    public function update_bill(){
		if (Utils::isAdmin() || Utils::isManager() && Utils::isValid($_POST)) {
            $id = isset($_POST['id']) ? $_POST['id'] : FALSE;
            $folio = isset($_POST['folio']) ? trim($_POST['folio']) : FALSE;
            $emit_date = isset($_POST['emit_date']) ? $_POST['emit_date'] : FALSE;
            $id_business_name = isset($_POST['id_business_name']) && !empty($_POST['id_business_name']) ? $_POST['id_business_name'] : NULL;
            $status = isset($_POST['status']) ? $_POST['status'] : FALSE;
            $payment_promise_date = isset($_POST['payment_promise_date']) && !empty($_POST['payment_promise_date']) ? trim($_POST['payment_promise_date']) : NULL;
            $payment_date = isset($_POST['payment_date']) && !empty($_POST['payment_date']) ? trim($_POST['payment_date']) : NULL;
            $iva = isset($_POST['iva']) ? $_POST['iva'] : FALSE;

            if ($id && $folio && $emit_date && $status && $iva) {
                $bill = new Bill();
                $bill->setId($id);
                $bill->setFolio($folio);
                $bill->setEmit_date($emit_date);
                $bill->setId_business_name($id_business_name);
                $bill->setStatus($status);
                $bill->setPayment_promise_date($payment_promise_date);
                $bill->setPayment_date($payment_date);
                $bill->setIva($iva);
                $update = $bill->update();
                
                if ($update) {
                    echo 1;
                }
            }
            else {
                echo 0;
            }
		} else {
			header("location:".base_url);
		}	
    }
    
    public function gestion_factura(){
		if (Utils::isAdmin() || Utils::isManager()) {
            if (isset($_GET['id'])) {
                $id = Encryption::decode($_GET['id']);
                $bill = new Bill();
                $bill->setId($id);
                $follow_ups = $bill->getFollowUpsByBill();
                $factura = $bill->getOne();
                $folio = $factura->folio;
            }
            else {
                header("location:".base_url."administracion/cobranza");
            }

			$page_title = "{$folio} Factura | RRHH Ingenia";
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/management/bill_manage.php';
            require_once 'views/layout/footer.php';
		} else {
			header("location:".base_url);
		}	
    }

    public function bill_follow_up(){
		if (Utils::isAdmin() || Utils::isManager() && Utils::isValid($_POST)) {
            $id = isset($_POST['id']) ? $_POST['id'] : FALSE;
            $status = isset($_POST['status']) ? trim($_POST['status']) : FALSE;
            $who_contacted = isset($_POST['who_contacted']) ? trim($_POST['who_contacted']) : FALSE;
            $payment_promise_date = isset($_POST['payment_promise_date']) && !empty($_POST['payment_promise_date']) ? trim($_POST['payment_promise_date']) : NULL;
            $comments = isset($_POST['comments']) ? trim($_POST['comments']) : FALSE;
            if ($id && $status && $who_contacted && $comments) {
                $billfollowup = new BillFollowUp();
                $billfollowup->setId_bill($id);
                $billfollowup->setWho_contacted($who_contacted);
                $billfollowup->setPayment_promise_date($payment_promise_date);
                $billfollowup->setComments($comments);
                $billfollowup->setCreated_by($_SESSION['identity']->id);
                $save = $billfollowup->save();
                if ($save) {
                    $bill = new Bill();
                    $bill->setId($id);
                    $bill->setPayment_promise_date($payment_promise_date);
                    $bill->setStatus($status);
					($status == '3') ? $bill->setCancellation_date(date('Y-m-d')) : $bill->setCancellation_date(NULL);
                    $update = $bill->updatePayment_promise_date_and_status();
                    if ($update) {
                        echo 1;
                    }else{
                        echo 2;
                    }
                        
                }else{
                    echo 2;
                }

            }
            else {
                echo 0;
            }
		} else {
			header("location:".base_url);
		}	
    }

	public function ordenes_de_compra(){
		if (Utils::isAdmin() || Utils::isManager()) {
            $purchase_order = new PurchaseOrder();
            if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
                
            }
            else {
                $purchase_order->setStatus(1);
                $pending = $purchase_order->getPurchaseOrdersByStatus();
                $purchase_order->setStatus(2);
                $process = $purchase_order->getPurchaseOrdersByStatus();
                $orders = array_merge($pending, $process);
                $purchase_order->setStatus(3);
                $bills = $purchase_order->getPurchaseOrdersByStatus();
            }

			$page_title = 'Ordenes de compra | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/management/purchase_orders.php';
            require_once 'views/layout/footer.php';
		} else {
			header("location:".base_url);
		}	
    }

    public function gestion_orden_de_compra(){
		if (Utils::isAdmin() || Utils::isManager()) {
            $purchase_order = new PurchaseOrder();
            if (isset($_GET['id'])) {
                $id = Encryption::decode($_GET['id']);
                $purchase_order = new PurchaseOrder();
                $purchase_order->setId($id);
                $follow_ups = $purchase_order->getFollowUpsByPurchaseOrder();
                $orden_de_compra = $purchase_order->getOne();
                $folio = $orden_de_compra->folio;
            }
            else {
                header("location:".base_url."administracion/ordenes_de_compra");
            }

			$page_title = "{$folio} OC | RRHH Ingenia";
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/management/purchase_order_manage.php';
            require_once 'views/layout/footer.php';
		} else {
			header("location:".base_url);
		}	
    }

    public function purchase_order_follow_up(){
		if (Utils::isAdmin() || Utils::isManager() && Utils::isValid($_POST)) {
            $id = isset($_POST['id']) ? $_POST['id'] : FALSE;
            $folio = isset($_POST['folio']) ? trim($_POST['folio']) : FALSE;
            $emit_date = isset($_POST['emit_date']) ? trim($_POST['emit_date']) : FALSE;
            $id_customer = isset($_POST['id_customer']) ? trim($_POST['id_customer']) : FALSE;
            $id_business_name = isset($_POST['id_business_name']) ? trim($_POST['id_business_name']) : FALSE;
            $status = isset($_POST['status']) ? trim($_POST['status']) : FALSE;
            $comments = isset($_POST['comments']) ? trim($_POST['comments']) : FALSE;
            $next_follow_up_date = isset($_POST['next_follow_up_date']) && !empty($_POST['next_follow_up_date']) ? trim($_POST['next_follow_up_date']) : NULL;
            $bill_folio = isset($_POST['bill_folio']) && !empty($_POST['bill_folio']) ? trim($_POST['bill_folio']) : FALSE;

            if ($id && $folio && $emit_date && $status) {
                $purchase_order = new PurchaseOrder();
                $purchase_order->setId($id);
                $purchase_order->setFolio($folio);
                $purchase_order->setEmit_date($emit_date);
                $purchase_order->setId_business_name($id_business_name);
                $purchase_order->setStatus($status);
                $purchase_order->setNext_follow_up_date($next_follow_up_date);
                $update = $purchase_order->update();
                if ($update) {
                    if ($comments) {
                        $orderfollowup = new PurchaseOrderFollowUp();
                        $orderfollowup->setId_purchase_order($id);
                        $orderfollowup->setNext_follow_up_date($next_follow_up_date);
                        $orderfollowup->setComments($comments);
                        $orderfollowup->setCreated_by($_SESSION['identity']->id);
                        $save = $orderfollowup->save();

                        if ($save) {
                            if ($bill_folio) {
                                $bill = new Bill();
                                $bill->setFolio($bill_folio);
                                $id_bill = $bill->billExists();

                                if ($id_bill) {
                                    $update = $bill->updateFolio();
                                    if ($update) {echo 1;} 
                                    else {echo 2;}
                                }else{
                                    $bill->setId_customer($id_customer);
                                    $bill->setId_business_name($id_business_name);
                                    $bill->setId_purchase_order($id);
                                    $save = $bill->save();
                                    $id_bill = $bill->getId();

                                    $applicant = new VacancyApplicant();
                                    $applicant->setId_bill($id_bill);
                                    $applicant->setId_purchase_order($id);
                                    $update = $applicant->updateBillByPurchaseOrder();
                                    if ($update) {echo 1;} 
                                    else {echo 2;}
                                }
                            }else{
                                echo 1;
                            }
                        }else{
                            echo 2;
                        }
                    }else{
                        if ($bill_folio) {
                            $bill = new Bill();
                            $bill->setFolio($bill_folio);
                            $id_bill = $bill->billExists();

                            if ($id_bill) {
                                $update = $bill->updateFolio();
                                if ($update) {echo 3;} 
                                else {echo 2;}
                            }else{
                                $bill->setId_customer($id_customer);
                                $bill->setId_business_name($id_business_name);
                                $bill->setId_purchase_order($id);
                                $save = $bill->save();
                                $id_bill = $bill->getId();

                                $applicant = new VacancyApplicant();
                                $applicant->setId_bill($id_bill);
                                $applicant->setId_purchase_order($id);
                                $update = $applicant->updateBillByPurchaseOrder();
                                if ($update) {echo 3;} 
                                else {echo 2;}
                            }
                        }else{
                            echo 3;
                        }
                    }
                } else {
                    echo 2;
                }
                
                    

            }
            else {
                echo 0;
            }
		} else {
			header("location:".base_url);
		}	
    }

    public function detalle_orden_de_compra(){
		if (Utils::isAdmin() || Utils::isManager()) {
            $purchase_order = new PurchaseOrder();
            if (isset($_GET['id'])) {
                $id = Encryption::decode($_GET['id']);
                $purchase_order = new PurchaseOrder();
                $purchase_order->setId($id);
                $orders = $purchase_order->getApplicantsByPurchaseOrder();
                $psychometrics = $purchase_order->getPsychometricsByPurchaseOrder();
                $folio = $purchase_order->getFolioById();
            }
            else {
                header("location:".base_url."administracion/ordenes_de_compra");
            }

			$page_title = "{$folio} OC | RRHH Ingenia";
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/management/purchase_order_detail.php';
            require_once 'views/layout/footer.php';
		} else {
			header("location:".base_url);
		}	
    }
    
    public function listado_orden_de_compra(){
		if (Utils::isAdmin() || Utils::isManager()) {
            $purchase_order = new PurchaseOrder();
            if (isset($_GET['id'])) {
                $id = Encryption::decode($_GET['id']);
                $purchase_order = new PurchaseOrder();
                $purchase_order->setId($id);
                $orders = $purchase_order->getApplicantsByPurchaseOrder();
                $psychometrics = $purchase_order->getPsychometricsByPurchaseOrder();
                $folio = $purchase_order->getFolioById();
            }
            else {
                header("location:".base_url."administracion/ordenes_de_compra");
            }

			$page_title = "{$folio} OC | RRHH Ingenia";
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/management/purchase_order_list.php';
            require_once 'views/layout/footer.php';
		} else {
			header("location:".base_url);
		}	
    }
    
    public function getApplicant(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isManager()) {
            $id_applicant = isset($_POST['id_applicant']) ? trim($_POST['id_applicant']) : FALSE;
            if ($id_applicant) {
                $applicant = new VacancyApplicant();
                $applicant->setId($id_applicant);
                $applicant_data = $applicant->getApplicantById();

                /*$business = new BusinessName();
                $business->setId_Customer($applicant_data->id_customer);
                $business_names = $business->getBNByCustomer();*/

                header('Content-Type: text/html; charset=utf-8');
                echo $json_applicant = json_encode($applicant_data, \JSON_UNESCAPED_UNICODE);
            }else{
                echo 0;
            }
        } else {
            header('location:'.base_url);
        }
    }

    public function getPsychometry(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isManager()) {
            $id = isset($_POST['id']) ? trim($_POST['id']) : FALSE;
            if ($id) {
                $psychometry = new Psychometry();
                $psychometry->setId($id);
                $psychometry_data = $psychometry->getOne();

                /*$business = new BusinessName();
                $business->setId_Customer($psychometry_data->id_customer);
                $business_names = $business->getBNByCustomer();*/

                header('Content-Type: text/html; charset=utf-8');
                echo $json_applicant = json_encode($psychometry_data, \JSON_UNESCAPED_UNICODE);
            }else{
                echo 0;
            }
        } else {
            header('location:'.base_url);
        }
    }

    public function getAT(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isManager()) {
            $id = Utils::sanitizeNumber($_POST['id']);
            if ($id) {
                $at = new TalentAttraction();
                $at->setId($id);
                $at_data = $at->getOne();

                header('Content-Type: text/html; charset=utf-8');
                echo json_encode($at_data);
            }else
                echo 0;
        }else
            header('location:'.base_url);
    }

    public function update_folio(){
        if (Utils::isValid($_POST) && !Utils::isCustomer()) {
            $id = isset($_POST['id_applicant']) && !empty($_POST['id_applicant']) ? trim($_POST['id_applicant']) : FALSE;
            $id_customer = isset($_POST['id_customer']) && !empty($_POST['id_customer']) ? trim($_POST['id_customer']) : NULL;
            $id_business_name = isset($_POST['id_business_name']) && !empty($_POST['id_business_name']) ? trim($_POST['id_business_name']) : NULL;
            $folio = isset($_POST['folio']) && !empty($_POST['folio']) ? trim($_POST['folio']) : FALSE;
            $amount = isset($_POST['amount']) ? trim($_POST['amount']) : NULL;
            $entry_date = isset($_POST['entry_date']) ? trim($_POST['entry_date']) : NULL;
            $id_purchase_order = isset($_POST['id_purchase_order']) && !empty($_POST['id_purchase_order']) ? trim($_POST['id_purchase_order']) : NULL;

            if ($id && $folio) {
                if (substr($folio, 0, 2) == 'F-') {
                    $folio = str_replace(' ', '', $folio);

                    $bill = new Bill();
                    $bill->setFolio($folio);
                    $id_bill = $bill->billExists();

                    if ($id_bill) {
                        $applicant = new VacancyApplicant();
                        $applicant->setId($id);
                        $applicant->setId_bill($id_bill);
                        $applicant->setAmount($amount);
                        $applicant->setEntry_date($entry_date);
                        $applicant->updateBill();

                    }else{
                        $bill->setId_customer($id_customer);
                        $bill->setId_business_name($id_business_name);
                        $bill->setId_purchase_order($id_purchase_order);
                        $save = $bill->save();
                        $id_bill = $bill->getId();

                        $applicant = new VacancyApplicant();
                        $applicant->setId($id);
                        $applicant->setId_bill($id_bill);
                        $applicant->setAmount($amount);
                        $applicant->setEntry_date($entry_date);
                        $applicant->updateBill();
                    }

                }else{
                    $purchase_order = new PurchaseOrder();
                    $purchase_order->setFolio($folio);
                    $id_purchaseorder = $purchase_order->purchaseOrderExists();

                    if ($id_purchaseorder) {
                        $applicant = new VacancyApplicant();

                        $applicant->setId($id);
                        $applicant->setId_purchase_order($id_purchaseorder);
                        $applicant->setAmount($amount);
                        $applicant->setEntry_date($entry_date);
                        $applicant->updatePurchaseOrder();
                    }else{
                        $purchase_order->setId_customer($id_customer);
                        $purchase_order->setId_business_name($id_business_name);
                        $save = $purchase_order->save();
                        $id_purchaseorder = $purchase_order->getId();

                        $applicant = new VacancyApplicant();
                        $applicant->setId($id);
                        $applicant->setId_purchase_order($id_purchaseorder);
                        $applicant->setAmount($amount);
                        $applicant->setEntry_date($entry_date);
                        $applicant->updatePurchaseOrder();
                    }
                }
                echo $folio;
            }else{
                echo 0;
            }

            
        }else{
            header("location:".base_url); 
        }
    }

    public function update_folio_psycho(){
        if (Utils::isValid($_POST) && !Utils::isCustomer()) {
            $id = isset($_POST['id']) && !empty($_POST['id']) ? trim($_POST['id']) : FALSE;
            $id_customer = isset($_POST['id_customer']) && !empty($_POST['id_customer']) ? trim($_POST['id_customer']) : NULL;
            $id_business_name = isset($_POST['id_business_name']) && !empty($_POST['id_business_name']) ? trim($_POST['id_business_name']) : NULL;
            $folio = isset($_POST['folio']) && !empty($_POST['folio']) ? trim($_POST['folio']) : FALSE;
            $amount = isset($_POST['amount']) ? trim($_POST['amount']) : NULL;
            $end_date = isset($_POST['send_date']) ? trim($_POST['send_date']) : NULL;
            $id_purchase_order = isset($_POST['id_purchase_order']) && !empty($_POST['id_purchase_order']) ? trim($_POST['id_purchase_order']) : NULL;

            if ($id && $folio) {
                if (substr($folio, 0, 2) == 'F-') {
                    $folio = str_replace(' ', '', $folio);

                    $bill = new Bill();
                    $bill->setFolio($folio);
                    $id_bill = $bill->billExists();

                    if ($id_bill) {
                        $psychometry = new Psychometry();
                        $psychometry->setId($id);
                        $psychometry->setId_bill($id_bill);
                        $psychometry->setAmount($amount);
                        $psychometry->setEnd_date($end_date);
                        $psychometry->updateBill();

                    }else{
                        $bill->setId_customer($id_customer);
                        $bill->setId_business_name($id_business_name);
                        $bill->setId_purchase_order($id_purchase_order);
                        $save = $bill->save();
                        $id_bill = $bill->getId();

                        $psychometry = new Psychometry();
                        $psychometry->setId($id);
                        $psychometry->setId_bill($id_bill);
                        $psychometry->setAmount($amount);
                        $psychometry->setEnd_date($end_date);
                        $psychometry->updateBill();
                    }

                }else{
                    $purchase_order = new PurchaseOrder();
                    $purchase_order->setFolio($folio);
                    $id_purchaseorder = $purchase_order->purchaseOrderExists();

                    if ($id_purchaseorder) {
                        $psychometry = new Psychometry();

                        $psychometry->setId($id);
                        $psychometry->setId_purchase_order($id_purchaseorder);
                        $psychometry->setAmount($amount);
                        $psychometry->setEnd_date($end_date);
                        $psychometry->updatePurchaseOrder();
                    }else{
                        $purchase_order->setId_customer($id_customer);
                        $purchase_order->setId_business_name($id_business_name);
                        $save = $purchase_order->save();
                        $id_purchaseorder = $purchase_order->getId();

                        $psychometry = new Psychometry();
                        $psychometry->setId($id);
                        $psychometry->setId_purchase_order($id_purchaseorder);
                        $psychometry->setAmount($amount);
                        $psychometry->setEnd_date($end_date);
                        $psychometry->updatePurchaseOrder();
                    }
                }
                echo $folio;
            }else{
                echo 0;
            }

            
        }else{
            header("location:".base_url); 
        }
    }

    public function update_folio_at(){
        if (Utils::isValid($_POST) && !Utils::isCustomer()) {
            $id = Utils::sanitizeNumber($_POST['id']);
            $id_customer = Utils::sanitizeNumber($_POST['id_customer']);
            $id_business_name = Utils::sanitizeNumber($_POST['id_business_name']);
            $folio = Utils::sanitizeStringBlank($_POST['folio']);
            $amount = Utils::sanitizeString($_POST['amount']);
            $end_date = Utils::sanitizeString($_POST['end_date']);
            $id_purchase_order = Utils::sanitizeNumber($_POST['id_purchase_order']);

            if ($id && $folio) {
                if (substr($folio, 0, 2) == 'F-') {
                    $folio = str_replace(' ', '', $folio);

                    $bill = new Bill();
                    $bill->setFolio($folio);
                    $id_bill = $bill->billExists();

                    if ($id_bill) {
                        $at = new TalentAttraction();
                        $at->setId($id);
                        $at->setId_bill($id_bill);
                        $at->setAmount($amount);
                        $at->setEnd_date($end_date);
                        $at->updateBill();

                    }else{
                        $bill->setId_customer($id_customer);
                        $bill->setId_business_name($id_business_name);
                        $bill->setId_purchase_order($id_purchase_order);
                        $save = $bill->save();
                        $id_bill = $bill->getId();

                        $at = new TalentAttraction();
                        $at->setId($id);
                        $at->setId_bill($id_bill);
                        $at->setAmount($amount);
                        $at->setEnd_date($end_date);
                        $at->updateBill();
                    }

                }else{
                    $purchase_order = new PurchaseOrder();
                    $purchase_order->setFolio($folio);
                    $id_purchaseorder = $purchase_order->purchaseOrderExists();

                    if ($id_purchaseorder) {
                        $at = new TalentAttraction();

                        $at->setId($id);
                        $at->setId_purchase_order($id_purchaseorder);
                        $at->setAmount($amount);
                        $at->setEnd_date($end_date);
                        $at->updatePurchaseOrder();
                    }else{
                        $purchase_order->setId_customer($id_customer);
                        $purchase_order->setId_business_name($id_business_name);
                        $save = $purchase_order->save();
                        $id_purchaseorder = $purchase_order->getId();

                        $at = new TalentAttraction();
                        $at->setId($id);
                        $at->setId_purchase_order($id_purchaseorder);
                        $at->setAmount($amount);
                        $at->setEnd_date($end_date);
                        $at->updatePurchaseOrder();
                    }
                }
                echo json_encode(array('folio' => $folio, 'end_date' => $end_date, 'status' => 1));
            }else{
                echo json_encode(array('status' => 0));
            }

            
        }else{
            header("location:".base_url); 
        }
    }
	

    //=========================================[gabo 20/02/2022]============================================================================================
    public function getBillG()
    {

        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isSAManager() || Utils::isManager())) {
            $id = Utils::sanitizeString(Encryption::decode($_POST['id']));

            if ($id) {
                $billObj = new Bill();
                $billObj->setId($id);
                $factura_datos = $billObj->getOne();
                //$razon=Utils::showBNByCustomer($factura_datos->id_customer);
                $factura_datos->total = number_format($factura_datos->total, 2);
                $razon = new RazonesSociales();
                $razon->setID_Cliente($factura_datos->id_customer);
                $razones = $razon->getRazonesSocialesPorCliente();

                $business_name = Utils::showBNByCustomer($factura_datos->id_customer);

                $all_info = array(
                    'factura_datos' => $factura_datos,
                    'razones' => $razones,
                    'status' => 1,
                    'business_names' => $business_name
                );
                // header('Content-Type: text/html; charset=utf-8');
                echo json_encode($all_info);
            } else {
                echo json_encode(array('status' => 0));
            }
        } else {
            echo json_encode(array('status' => 0));
        }
    }


   public function update_bill_modal()
    {  //gabo 20/02/2022
        if (Utils::isAdmin() || Utils::isManager() && Utils::isValid($_POST)) {
            $id = isset($_POST['id']) ? $_POST['id'] : FALSE;
            $folio = isset($_POST['folio']) ? trim($_POST['folio']) : FALSE;
            $emit_date = isset($_POST['emit_date']) ? $_POST['emit_date'] : FALSE;
            $id_business_name = isset($_POST['id_business_name']) && !empty($_POST['id_business_name']) ? $_POST['id_business_name'] : NULL;
            $status = isset($_POST['status']) ? $_POST['status'] : FALSE;
            $payment_promise_date = isset($_POST['payment_promise_date']) && !empty($_POST['payment_promise_date']) ? trim($_POST['payment_promise_date']) : NULL;
            $payment_date = isset($_POST['payment_date']) && !empty($_POST['payment_date']) ? trim($_POST['payment_date']) : NULL;
            $iva = isset($_POST['iva']) ? $_POST['iva'] : FALSE;


            if ($id && $folio && $emit_date && $status && $iva) {
                $bill = new Bill();
                $bill->setId($id);
                $bill->setFolio($folio);
                $bill->setEmit_date($emit_date);
                $bill->setId_business_name($id_business_name);
                $bill->setStatus($status);
                $bill->setPayment_promise_date($payment_promise_date);
                $bill->setPayment_date($payment_date);
                $bill->setIva($iva);
                ($status == '3') ? $bill->setCancellation_date(date('Y-m-d')) : $bill->setCancellation_date(NULL);

                $update = $bill->update();

                if ($update) {
                    $bills = new Bill();
                    $bills->setStatus(1);
                    $unpaid_bills = $bills->getBillsByStatus();
                    $unpaid_bills = AdministracionController::format($unpaid_bills);

                    $bills->setStatus(2);
                    $paid_bills = $bills->getBillsByStatus();
                    $paid_bills = AdministracionController::format($paid_bills);

                    $bill->setStatus(3);
                    $cancelled_bills = $bill->getBillsByStatus();
                    $cancelled_bills = AdministracionController::format($cancelled_bills);


                    echo json_encode(array(
                        'unpaid_bills' => $unpaid_bills,
                        'paid_bills' => $paid_bills,
                        'cancelled_bills' => $cancelled_bills,
                        'status' => 1
                    ));
                }
            } else {
                echo json_encode(array('status' => 0));
            }
        } else {
            header("location:" . base_url);
        }
    }


    public function gestion_factura_modal()
    {  //gabo 20/02/2022

        if (Utils::isAdmin() || Utils::isManager()) {
            if (isset($_POST['id'])) {
                $id = Encryption::decode($_POST['id']);
                $bill = new Bill();
                $bill->setId($id);
                $factura = $bill->getOne();
                $folio = $factura->folio;

                $factura->total = number_format($factura->total, 2);
                $razon = new RazonesSociales();
                $razon->setID_Cliente($factura->id_customer);
                $razones = $razon->getRazonesSocialesPorCliente();

                $business_name = Utils::showBNByCustomer($factura->id_customer);

                $all_info = array(
                    'factura' => $factura,
                    'razones' => $razones,
                    'status' => 1,
                    'business_names' => $business_name
                );

                echo json_encode($all_info);
            } else {
                echo json_encode(array('status' => 0));
            }
        } else {
            echo json_encode(array('status' => 0));
        }
    }

     public function bill_follow_up_modal()
    {
        if (Utils::isAdmin() || Utils::isManager() && Utils::isValid($_POST)) {
            $id = isset($_POST['id']) ? $_POST['id'] : FALSE;
            $status = isset($_POST['status']) ? trim($_POST['status']) : FALSE;
            $who_contacted = isset($_POST['who_contacted']) ? trim($_POST['who_contacted']) : FALSE;
            $payment_promise_date = isset($_POST['payment_promise_date']) && !empty($_POST['payment_promise_date']) ? trim($_POST['payment_promise_date']) : NULL;
            $comments = isset($_POST['comments']) ? trim($_POST['comments']) : FALSE;
            $save = true;
            $update = true;
            if ($id && $status && $who_contacted && $comments) {
                $billfollowup = new BillFollowUp();
                $billfollowup->setId_bill($id);
                $billfollowup->setWho_contacted($who_contacted);
                $billfollowup->setPayment_promise_date($payment_promise_date);
                $billfollowup->setComments($comments);
                $billfollowup->setCreated_by($_SESSION['identity']->id);
                $save = $billfollowup->save();
                $save = true;
                if ($save) {
                    $bill = new Bill();
                    $bill->setId($id);
                    $bill->setPayment_promise_date($payment_promise_date);
                    $bill->setStatus($status);
                    //===[gabo 16 agosto]===
                    ($status == '3') ? $bill->setCancellation_date(date('Y-m-d')) : $bill->setCancellation_date(NULL);
                    //===[gabo 16 agosto]===
                    $update = $bill->updatePayment_promise_date_and_status();
                    $update = true;
                    if ($update) {

                        $bills = new Bill();
                        $bills->setStatus(1);
                        $unpaid_bills = $bills->getBillsByStatus();
                        $unpaid_bills = AdministracionController::format($unpaid_bills);


                        $bills->setStatus(2);
                        $paid_bills = $bills->getBillsByStatus();
                        $paid_bills = AdministracionController::format($paid_bills);

                        $bill->setStatus(3);
                        $cancelled_bills = $bill->getBillsByStatus();
                        $cancelled_bills = AdministracionController::format($cancelled_bills);


                        echo json_encode(array(
                            'unpaid_bills' => $unpaid_bills,
                            'paid_bills' => $paid_bills,
                            'cancelled_bills' => $cancelled_bills,
                            'status' => 1
                        ));
                    } else {
                        echo json_encode(array('status' => 2));
                    }
                } else {
                    echo json_encode(array('status' => 2));
                }
            } else {
                echo json_encode(array('status' => 0));
            }
        } else {
            header("location:" . base_url);
        }
    }
	
	    public function getInfoCancel()
    {
        if (Utils::isValid($_SESSION['identity']) && isset($_POST)) {
            $id = isset($_POST['id'])  ? Encryption::decode($_POST['id']) : Null;

            if ($id) {
                $bill = new Bill;
                $bill->setId($id);
                $bill = $bill->getOne();
                $bill->id_encrypted = Encryption::encode($bill->id);
            }

            echo json_encode(array('status' => 1, 'bill' => $bill));
        } else {
            echo json_encode(array('status' => 0));
        }
    }
	  public function updateInfoCancelled()
    {
        if (Utils::isValid($_SESSION['identity']) && isset($_POST)) {

            $id = isset($_POST['id'])  ? Encryption::decode($_POST['id']) : Null;
            $comments = isset($_POST['comments'])  ? Utils::sanitizeString($_POST['comments']) : Null;
            $cancellation_date = isset($_POST['cancellation_date'])  ? Utils::sanitizeString($_POST['cancellation_date']) : Null;

            if ($id) {
                $bill = new Bill;
                $bill->setId($id);
                $bill->setComments($comments);
                $bill->setCancellation_date($cancellation_date);
                $update = $bill->updateInfoCancelled();

                $bill->setStatus(3);
                $cancelled_bills = $bill->getBillsByStatus();

                $cancelled_bills = AdministracionController::format($cancelled_bills);

                echo json_encode(array('status' => 1, 'cancelled_bills' => $cancelled_bills));
            } else {
                echo json_encode(array('status' => 0));
            }
        } else {
            echo json_encode(array('status' => 0));
        }
    }


    public static function format($bills)
    {

        foreach ($bills as &$bill) {
            $bill['emit_date'] =   Utils::getShortDate($bill['emit_date']);
            $bill['total'] = number_format($bill['total']);
            $bill['total_IVA'] = number_format($bill['total_IVA'], 2);
            $bill['payment_date'] = (!is_null($bill['payment_date'])) ? Utils::getShortDate($bill['payment_date']) : '';
            $bill['cancellation_date'] = (!is_null($bill['cancellation_date'])) ? Utils::getShortDate($bill['cancellation_date']) : '';
            $bill['comments'] = (!is_null($bill['comments'])) ? $bill['comments'] : '';
            $bill['id_encrypted'] = Encryption::encode($bill['id']);
            $bill['payment_promise_date'] = $bill['payment_promise_date'] == null ? '' :  Utils::getShortDate($bill['payment_promise_date']);
            $bill['last_follow_up_date'] =  $bill['last_follow_up_date'] == null ? '' :  Utils::getShortDate($bill['last_follow_up_date']);
            $bill['last_follow_up_comments'] =  $bill['last_follow_up_comments'] == null ? '' :  $bill['last_follow_up_comments'];
            $bill['url_editar_factura'] =  base_url . 'administracion/editar_factura&id=' . $bill['id_encrypted'];
            $bill['url_gestion_factura'] =  base_url . 'administracion/gestion_factura&id=' . $bill['id_encrypted'];
            $bill['name_vacancy'] = Utils::nameVacancy($bill['id']);
        }
        return $bills;
    }
    //=====================================================================================================================================
}