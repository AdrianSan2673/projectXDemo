<?php

require_once 'models/Vacancy.php';
require_once 'models/VacancyQuestionnaire.php';
require_once 'models/CustomerContact.php';
require_once 'models/Customer.php';
require_once 'models/User.php';
require_once 'models/ExecutiveJRRecruiter.php';
require_once 'models/State.php';
require_once 'models/City.php';
require_once 'models/CandidateDirectory.php';

class VacanteController
{

    public function index()
    {
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSenior() || Utils::isJunior() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isCustomer() || Utils::isCandidate() || Utils::isRecruitmentManager()) {
            if (Utils::isCandidate()) {
                header('location:' . base_url . 'bolsa/vacantes');
            }

            if (Utils::isCustomer()) {
                $contact = new CustomerContact();
                $contact->setId_user($_SESSION['identity']->id);
                $contacto = $contact->getContactByUser();
                $vacancy = new Vacancy();
                $vacancy->setId_customer($contacto->id_customer);

                if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
                    if ($_POST['start_date'] > $_POST['end_date']) {
                        $aux = $_POST['start_date'];
                        $_POST['start_date'] = $_POST['end_date'];
                        $_POST['end_date'] = $aux;
                    }
                    $vacancy->setRequest_date($_POST['start_date']);
                    $vacancy->setEnd_date($_POST['end_date']);
                    $vacancies = $vacancy->getVacanciesByCustomerAndDate();
                } else
                    $vacancies = $vacancy->getVacanciesByCustomer();
                //if (!$vacancies) {
                //header('location:'.base_url);
                //}
                //}elseif(Utils::isSenior() && $_SESSION['identity']->id != 41 && $_SESSION['identity']->id != 1515) {
            } elseif (Utils::isSenior()) {
                $vacancy = new Vacancy();
                $vacancy->setId_recruiter($_SESSION['identity']->id);

                if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
                    if ($_POST['start_date'] > $_POST['end_date']) {
                        $aux = $_POST['start_date'];
                        $_POST['start_date'] = $_POST['end_date'];
                        $_POST['end_date'] = $aux;
                    }
                    $vacancy->setRequest_date($_POST['start_date']);
                    $vacancy->setEnd_date($_POST['end_date']);
                    $vacancies = $vacancy->getVacanciesByRecruiterAndDate();
                } else
                    $vacancies = $vacancy->getVacanciesByRecruiter();
            } elseif (Utils::isJunior()) {
                $assign = new ExecutiveJRRecruiter();
                $assign->setId_executiveJR($_SESSION['identity']->id);
                $executiveJR_recruiters = $assign->getRecruitersByExecutiveJR();

                $vacancies = [];
                foreach ($executiveJR_recruiters as $recruiter) {
                    $vacancy = new Vacancy();
                    $vacancy->setId_recruiter($recruiter['id']);
                    $vacancies = array_merge($vacancies, $vacancy->getVacanciesByRecruiter());
                }
            }/* elseif($_SESSION['identity']->id == 41 || $_SESSION['identity']->id == 1515){
                $vacancy = new Vacancy();
                $vacancy->setId_recruiter($_SESSION['identity']->id);
                $vacancies = $vacancy->getVacanciesByRecruiter();

                $assign = new ExecutiveJRRecruiter();
			    $assign->setId_executiveJR($_SESSION['identity']->id);
			    $executiveJR_recruiters = $assign->getRecruitersByExecutiveJR();

                foreach ($executiveJR_recruiters as $recruiter) {
                    $vacancy = new Vacancy();
                    $vacancy->setId_recruiter($recruiter['id']);
                    $vacancies = array_merge($vacancies, $vacancy->getVacanciesByRecruiter());
                }
            } */ else {
                $vacancy = new Vacancy();
                if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
                    if ($_POST['start_date'] > $_POST['end_date']) {
                        $aux = $_POST['start_date'];
                        $_POST['start_date'] = $_POST['end_date'];
                        $_POST['end_date'] = $aux;
                    }
                    $vacancy->setRequest_date($_POST['start_date']);
                    $vacancy->setEnd_date($_POST['end_date']);
                    $vacancies = $vacancy->getVacanciesByDate();
                } else
                    $vacancies = $vacancy->getAll();
            }

            //$n_in_process = 0;
            //$n_closed = 0;

            //$vacancy->setRequest_date(date('Y-m-d'));
            //$monthly_vacancies = $vacancy->getVacanciesPerMonth();

            /*foreach ($monthly_vacancies as $v) {
                if ($v['id_status'] <= 3) {
                    $n_in_process++;
                }else{
                    $n_closed++;
                }
            }*/

            $page_title = 'Vacantes | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/vacancy/index.php';
            require_once 'views/layout/footer.php';
        } else {
            header('location:' . base_url);
        }
    }

    public function en_proceso()
    {
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSenior() || Utils::isJunior() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isCustomer() || Utils::isCandidate() || Utils::isRecruitmentManager()) {
            if (Utils::isCandidate()) {
                header('location:' . base_url . 'bolsa/vacantes');
            }

            if ($_SESSION['identity']->username == 'salmaperez' && date('Y-m-d') == '2022-08-26') {
                if (!isset($_SESSION['salma_fest'])) {
                    $_SESSION['salma_fest'] = 1;
                    header('location:' . base_url . 'usuario/salma_fest');
                }
            }

            if (Utils::isCustomer()) {
                $contact = new CustomerContact();
                $contact->setId_user($_SESSION['identity']->id);
                $contactos = $contact->getContactByUser2();

                $vacancies = [];
                $inCurrentMont = 0;
                $inProcess = 0;
                $closeInCurrent = 0;
                $customerName = '';

                foreach ($contactos as $contacto) {
                    $vacancy = new Vacancy();
                    $vacancy->setId_customer($contacto['id_customer']);
                    $vacancie = $vacancy->getVacanciesInProcessByCustomer();
                    $vacancies = array_merge($vacancies, $vacancie);

                    $inCurrentMont += Statistics::getVacancyCountByCustomerInCurrentMonth($contacto['id_customer']);
                    $inProcess += Statistics::getVacancyInProcessCountByCustomer($contacto['id_customer']);
                    $closeInCurrent += Statistics::getVacancyClosedCountByCustomerInCurrentMonth($contacto['id_customer']);

                    if (count($contactos) >= 2) {
                        if (strpos($customerName, $contacto['customer'])) {
                            $customerName .= $customerName . ' , ' . $contacto['customer'];
                        }
                    } else {
                        $customerName = $contacto['customer'];
                    }
                }

                /*$contact = new CustomerContact();
                $contact->setId_user($_SESSION['identity']->id);
                $contacto = $contact->getContactByUser();

                $vacancy = new Vacancy();
                $vacancy->setId_customer($contacto->id_customer);
                $vacancies = $vacancy->getVacanciesInProcessByCustomer();*/
            } elseif (Utils::isSenior()) {
                $vacancy = new Vacancy();
                $vacancy->setId_recruiter($_SESSION['identity']->id);
                $vacancies = $vacancy->getVacanciesInProcessByRecruiter();
            } else {
                $vacancy = new Vacancy();
                $vacancies = $vacancy->getVacanciesInProcess();
            }

            $page_title = 'Vacantes | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/vacancy/index.php';
            require_once 'views/layout/footer.php';
        } else {
            header('location:' . base_url);
        }
    }

    public function crear()
    {
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSenior() || Utils::isJunior() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isCustomer() || Utils::isRecruitmentManager()) {
            if (Utils::isCustomer()) {
                $contact = new CustomerContact();
                $contact->setId_user($_SESSION['identity']->id);
                $contacto = $contact->getContactByUser();
                $id_customer = $contacto->id_customer;

                $customer = new Customer();
                $customer->setId($id_customer);
                $cliente = $customer->getOne();
            }

            $page_title = 'Nueva vacante | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/vacancy/create.php';
            require_once 'views/layout/footer.php';
        } else {
            header('location:' . base_url);
        }
    }

    public function create()
    {
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSenior() || Utils::isJunior() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isCustomer() || Utils::isRecruitmentManager()) {
            $customer = isset($_POST['customer']) ? trim($_POST['customer']) : FALSE;
            $customer_contact = isset($_POST['customer_contact']) ? trim($_POST['customer_contact']) : NULL;
            $business_name = isset($_POST['business_name']) && !empty($_POST['business_name']) ? trim($_POST['business_name']) : NULL;
            $recruiter = isset($_POST['recruiter']) ? trim($_POST['recruiter']) : NULL;
            $vacancy = isset($_POST['vacancy']) ? trim($_POST['vacancy']) : FALSE;
            $department = isset($_POST['department']) ? trim($_POST['department']) : FALSE;
            $report_to = Utils::sanitizeStringBlank($_POST['report_to']);
            $personal_in_charge = isset($_POST['personal_in_charge']) ? Utils::sanitizeStringBlank($_POST['personal_in_charge']) : 0;
            $education_level = isset($_POST['education_level']) ? trim($_POST['education_level']) : FALSE;
            $position_number = isset($_POST['position_number']) ? trim($_POST['position_number']) : FALSE;
            $experience_years = isset($_POST['experience_years']) ? trim($_POST['experience_years']) : FALSE;
            $experience = isset($_POST['experience']) ? trim($_POST['experience']) : NULL;
            $age_min = isset($_POST['age_min']) ? trim($_POST['age_min']) : FALSE;
            $age_max = isset($_POST['age_max']) ? trim($_POST['age_max']) : FALSE;
            $gender = isset($_POST['gender']) ? trim($_POST['gender']) : FALSE;
            $civil_status = isset($_POST['civil_status']) ? trim($_POST['civil_status']) : FALSE;
            $language = isset($_POST['language']) && !empty($_POST['language']) && $_POST['language'] != '0' ? trim($_POST['language']) : NULL;
            $language_level = isset($_POST['language_level']) && !empty($_POST['language_level']) && $_POST['language_level'] != '0' ? trim($_POST['language_level']) : NULL;
            $salary_min = isset($_POST['salary_min']) ? trim($_POST['salary_min']) : FALSE;
            $salary_max = isset($_POST['salary_max']) ? trim($_POST['salary_max']) : FALSE;
            $benefits = isset($_POST['benefits']) ? trim($_POST['benefits']) : ' ';
            $workdays = isset($_POST['workdays']) ? trim($_POST['workdays']) : FALSE;
            $schedule = isset($_POST['schedule']) ? trim($_POST['schedule']) : FALSE;
            $state = isset($_POST['state']) ? trim($_POST['state']) : FALSE;
            $city = isset($_POST['city']) ? trim($_POST['city']) : FALSE;
            $requirements = isset($_POST['requirements']) ? trim($_POST['requirements']) : FALSE;
            $functions = isset($_POST['functions']) ? trim($_POST['functions']) : FALSE;
            $skills = isset($_POST['skills']) ? trim($_POST['skills']) : NULL;
            $technical_knowledge = Utils::sanitizeStringBlank($_POST['technical_knowledge']);
            $area = isset($_POST['area']) ? trim($_POST['area']) : FALSE;
            $subarea = isset($_POST['subarea']) ? trim($_POST['subarea']) : FALSE;

            $working_day = isset($_POST['working_day']) ?  Utils::sanitizeStringBlank($_POST['working_day']) : null;
            $send_date_candidate = isset($_POST['send_date_candidate']) ?  Utils::sanitizeStringBlank($_POST['send_date_candidate']) : null;
            $advance_payment = isset($_POST['advance_payment']) ?  Utils::sanitizeStringBlank($_POST['advance_payment']) : null;
            $payment_amount = isset($_POST['payment_amount']) ?  Utils::sanitizeStringBlank($_POST['payment_amount']) : null;
            $experience_type = isset($_POST['experience_type']) ?  Utils::sanitizeStringBlank($_POST['experience_type']) : 'Años';
 $recruitment_service_cost = isset($_POST['recruitment_service_cost']) ? Utils::sanitizeNumber($_POST['recruitment_service_cost']) : 0;

            $how_many_interviews = isset($_POST['how_many_interviews']) ? trim($_POST['how_many_interviews']) : NULL;
            $accept_reentry = isset($_POST['accept_reentry']) ? trim($_POST['accept_reentry']) : NULL;
            $offer_transportation = isset($_POST['offer_transportation']) ? trim($_POST['offer_transportation']) : NULL;
            $do_medical_exam = isset($_POST['do_medical_exam']) ? trim($_POST['do_medical_exam']) : NULL;
            $time_without_filling = isset($_POST['time_without_filling']) ? Utils::sanitizeStringBlank($_POST['time_without_filling']) : NULL;
            $another_agency = isset($_POST['another_agency']) ? Utils::sanitizeStringBlank($_POST['another_agency']) : NULL;
            $comments = isset($_POST['comments']) ? trim($_POST['comments']) : NULL;
            // gabo 17 abril quitar a ventas
            $type =  isset($_POST['type']) ?  Utils::sanitizeNumber($_POST['type'])  : NULL;
            $warranty_time = isset($_POST['warranty_time']) ? Utils::sanitizeNumber($_POST['warranty_time']) : null;
            $amount_to_invoice = isset($_POST['amount_to_invoice']) ? Utils::sanitizeString($_POST['amount_to_invoice']) : null;
            $authorization_date = isset($_POST['authorization_date']) ? Utils::sanitizeString($_POST['authorization_date']) : null;
            $commitment_date = isset($_POST['commitment_date']) ? Utils::sanitizeString($_POST['commitment_date']) : null;

            $telephone = isset($_POST['telephone']) ? 0 : 1;
            //$notes = isset($_POST['notes']) ? Utils::sanitizeString($_POST['notes']) : NULL;
			

            // gabo 17 abril quitar a ventas
            if ($customer && $vacancy && $working_day && $department && $education_level && $position_number && $age_min && $age_max && $gender && $civil_status && $salary_min && $salary_max && $workdays && $schedule && $state && $city  && $area && $subarea) {

                $authorization_date = $authorization_date ? date_format(date_create($authorization_date), 'Y-m-d H:i') : NULL;
                $vacante = new Vacancy();
                $vacante->setRequest_date(Utils::getFechaIngresoVacante());
                $vacante->setId_customer($customer);
                $vacante->setId_customer_contact($customer_contact);
                $vacante->setBusiness_name($business_name);
                $vacante->setId_recruiter($recruiter);
                $vacante->setVacancy($vacancy);
                $vacante->setDepartment($department);
                $vacante->setReport_to($report_to);
                $vacante->setPersonal_in_charge($personal_in_charge);
                $vacante->setId_education_level($education_level);
                $vacante->setPosition_number($position_number);
                $vacante->setExperience_years($experience_years);
                $vacante->setExperience($experience);
                $vacante->setAge_min($age_min);
                $vacante->setAge_max($age_max);
                $vacante->setId_gender($gender);
                $vacante->setId_civil_status($civil_status);
                $vacante->setId_language($language);
                $vacante->setId_language_level($language_level);
                $vacante->setSalary_min($salary_min);
                $vacante->setSalary_max($salary_max);
                $vacante->setBenefits($benefits);
                $vacante->setWorkdays($workdays);
                $vacante->setSchedule($schedule);
                $vacante->setRequirements($requirements);
                $vacante->setFunctions($functions);
                $vacante->setSkills($skills);
                $vacante->setTechnical_knowledge($technical_knowledge);
                $vacante->setId_state($state);
                $vacante->setId_city($city);
                $vacante->setId_area($area);
                $vacante->setId_subarea($subarea);
                $vacante->setComments($comments);
                $vacante->setCreated_by($_SESSION['identity']->id);
                $vacante->setId_status(1);
                $vacante->settype($type);
                $vacante->setWarranty_time($warranty_time);
                $vacante->setAmount_to_invoice($amount_to_invoice);
                $vacante->setAuthorization_date($authorization_date);
                $vacante->setCommitment_date($commitment_date);
                $vacante->setWorking_day($working_day);
                $vacante->setSend_date_candidate($send_date_candidate);
                $vacante->setAdvance_payment($advance_payment);
                $vacante->setPayment_amount($payment_amount);
                $vacante->setExperience_type($experience_type);
                $vacante->setRecruitment_service_cost($recruitment_service_cost);
                $vacante->setTelephone($telephone);
				//$vacante->setNotes($notes);

                $save = $vacante->save();

                if ($save) {
                    $id = $vacante->getId();
                    $question = new VacancyQuestionnaire();
                    $question->setId_vacancy($id);
                    $question->setHow_many_interviews($how_many_interviews);
                    $question->setAccept_reentry($accept_reentry);
                    $question->setOffer_transportation($offer_transportation);
                    $question->setDo_medical_exam($do_medical_exam);

                    $guardado = $question->save();
                    if ($guardado) {
                        $cust = new Customer();
                        $cust->setId($customer);
                        $cliente = $cust->getOne()->customer;

                        $subject = 'Nueva vacante de ' . $cliente;
                        $created_by = $_SESSION['identity']->first_name . ' ' . $_SESSION['identity']->last_name;
                        $body = "Se ha registrado una nueva vacante de <b>{$cliente}</b> para el puesto de <b>{$vacancy}</b> la cual fue creada por {$created_by}.";
                        if ($recruiter) {
                            $user = new User();
                            $user->setId($recruiter);
                            $executive = $user->getOne();
                            $ejecutivo = '<br>El ejecutivo que la atenderá será <b>' . $executive->first_name . ' ' . $executive->last_name . '</b>';
                            $body = "{$body} {$ejecutivo}";

                            Utils::sendEmail($executive->email, $executive->first_name . ' ' . $executive->last_name, $subject, $body);
                        }
                        echo 1; //if everything is ok, returns 1
                        Utils::sendEmail('cindy.luna@rrhhingenia.com', 'Cindy Luna', $subject, $body);
                        Utils::sendEmail('iveth.gomez@rrhhingenia.com', 'Iveth Gómez', $subject, $body);
                    }
                } else {
                    echo 2;
                }
            } else {
                echo 0;
            }
        } else {
            header("location:" . base_url);
        }
    }

    public function ver()
    {
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSenior() || Utils::isJunior() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isCustomer() || Utils::isRecruitmentManager()) {
            if (isset($_GET['id'])) {
                $id = Encryption::decode($_GET['id']);
                $vacancy = new Vacancy();
                $vacancy->setId($id);
                $vacante = $vacancy->getOne();
                switch ($vacante->id_status) {
                    case 1:
                        $class_color = 'bg-info';
                        break;
                    case 2:
                        $class_color = 'bg-orange';
                        break;
                    case 3:
                        $class_color = 'bg-secondary';
                        break;
                    case 4:
                        $class_color = 'bg-danger';
                        break;
                    case 5:
                        $class_color = 'bg-success';
                        break;
                    case 8:
                        $class_color = 'bg-warning';
                        break;
                    default:
                        $class_color = '';
                        break;
                }

				
                $page_title = $vacante->vacancy . ' | RRHH Ingenia';

                require_once 'views/layout/header.php';
                require_once 'views/layout/sidebar.php';
                require_once 'views/vacancy/read.php';
                require_once 'views/vacancy/modal-perfil.php';
                require_once 'views/vacancy/modal-descripcion.php';
                require_once 'views/vacancy/modal-contacto.php';
                require_once 'views/vacancy/modal-condiciones.php';
                require_once 'views/layout/footer.php';
            } else {
                header('location:' . base_url . 'vacante/index');
            }
        } else {
            header('location:' . base_url);
        }
    }

    public function editar()
    {
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSenior() || Utils::isJunior() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isRecruitmentManager()) {
            if (isset($_GET['id'])) {
                $id = Encryption::decode($_GET['id']);
                $vacancy = new Vacancy();
                $vacancy->setId($id);
                $vacante = $vacancy->getOne();

                $page_title = $vacante->vacancy . ' | RRHH Ingenia';

                require_once 'views/layout/header.php';
                require_once 'views/layout/sidebar.php';
                require_once 'views/vacancy/create.php';
                require_once 'views/layout/footer.php';
            } else {
                header('location:' . base_url . 'vacante/index');
            }
        } else {
            header('location:' . base_url);
        }
    }

    public function update()
    {
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSenior() || Utils::isJunior() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isCustomer() || Utils::isRecruitmentManager()) {
            $id = isset($_POST['id']) ? trim(Encryption::decode($_POST['id'])) : FALSE;
            $customer = isset($_POST['customer']) ? trim($_POST['customer']) : FALSE;
            $customer_contact = isset($_POST['customer_contact']) ? trim($_POST['customer_contact']) : NULL;
            $business_name = isset($_POST['business_name']) ? trim($_POST['business_name']) : NULL;
            $recruiter = isset($_POST['recruiter']) ? trim($_POST['recruiter']) : NULL;
            $vacancy = isset($_POST['vacancy']) ? trim($_POST['vacancy']) : FALSE;
            $department = isset($_POST['department']) ? trim($_POST['department']) : FALSE;
            $report_to = Utils::sanitizeStringBlank($_POST['report_to']);
            $personal_in_charge = Utils::sanitizeStringBlank($_POST['personal_in_charge']);
            $education_level = isset($_POST['education_level']) ? trim($_POST['education_level']) : FALSE;
            $position_number = isset($_POST['position_number']) ? trim($_POST['position_number']) : FALSE;
            $experience_years = isset($_POST['experience_years']) ? trim($_POST['experience_years']) : FALSE;
            $experience = isset($_POST['experience']) ? trim($_POST['experience']) : NULL;
            $age_min = isset($_POST['age_min']) ? trim($_POST['age_min']) : FALSE;
            $age_max = isset($_POST['age_max']) ? trim($_POST['age_max']) : FALSE;
            $gender = isset($_POST['gender']) ? trim($_POST['gender']) : FALSE;
            $civil_status = isset($_POST['civil_status']) ? trim($_POST['civil_status']) : FALSE;
            $language = isset($_POST['language']) && !empty($_POST['language']) && $_POST['language'] != '0' ? trim($_POST['language']) : NULL;
            $language_level = isset($_POST['language_level']) && !empty($_POST['language_level']) && $_POST['language_level'] != '0' ? trim($_POST['language_level']) : NULL;
            $salary_min = isset($_POST['salary_min']) ? trim($_POST['salary_min']) : FALSE;
            $salary_max = isset($_POST['salary_max']) ? trim($_POST['salary_max']) : FALSE;
            $benefits = isset($_POST['benefits']) ? trim($_POST['benefits']) : FALSE;
            $workdays = isset($_POST['workdays']) ? trim($_POST['workdays']) : FALSE;
            $schedule = isset($_POST['schedule']) ? trim($_POST['schedule']) : FALSE;
            $state = isset($_POST['state']) ? trim($_POST['state']) : FALSE;
            $city = isset($_POST['city']) ? trim($_POST['city']) : FALSE;
            $requirements = isset($_POST['requirements']) ? trim($_POST['requirements']) : FALSE;
            $functions = isset($_POST['functions']) ? trim($_POST['functions']) : FALSE;
            $skills = isset($_POST['skills']) ? trim($_POST['skills']) : NULL;
            $technical_knowledge = Utils::sanitizeStringBlank($_POST['technical_knowledge']);
            $area = isset($_POST['area']) ? trim($_POST['area']) : FALSE;
            $subarea = isset($_POST['subarea']) ? trim($_POST['subarea']) : FALSE;

            $working_day = isset($_POST['working_day']) ?  Utils::sanitizeStringBlank($_POST['working_day']) : null;
            $send_date_candidate = isset($_POST['send_date_candidate']) ?  Utils::sanitizeStringBlank($_POST['send_date_candidate']) : null;
            $advance_payment = isset($_POST['advance_payment']) ?  Utils::sanitizeStringBlank($_POST['advance_payment']) : null;
            $payment_amount = isset($_POST['payment_amount']) ?  Utils::sanitizeStringBlank($_POST['payment_amount']) : null;
            $experience_type = isset($_POST['experience_type']) ?  Utils::sanitizeStringBlank($_POST['experience_type']) : 'Años';
            $recruitment_service_cost = isset($_POST['recruitment_service_cost']) ?  Utils::sanitizeNumber($_POST['recruitment_service_cost']) : 0;

            $how_many_interviews = isset($_POST['how_many_interviews']) ? trim($_POST['how_many_interviews']) : FALSE;
            $accept_reentry = isset($_POST['accept_reentry']) ? trim($_POST['accept_reentry']) : NULL;
            $offer_transportation = isset($_POST['offer_transportation']) ? trim($_POST['offer_transportation']) : NULL;
            $do_medical_exam = isset($_POST['do_medical_exam']) ? trim($_POST['do_medical_exam']) : NULL;
            $time_without_filling = Utils::sanitizeStringBlank($_POST['time_without_filling']);
            $another_agency = Utils::sanitizeNumber($_POST['another_agency']);
            $comments = isset($_POST['comments']) ? trim($_POST['comments']) : NULL;
            $type = Utils::sanitizeNumber($_POST['type']);
            $warranty_time = isset($_POST['warranty_time']) ? Utils::sanitizeNumber($_POST['warranty_time']) : null;
            $amount_to_invoice = isset($_POST['amount_to_invoice']) ? Utils::sanitizeString($_POST['amount_to_invoice']) : null;
            $authorization_date = isset($_POST['authorization_date']) ? Utils::sanitizeString($_POST['authorization_date']) : null;
            $commitment_date = isset($_POST['commitment_date']) ? Utils::sanitizeString($_POST['commitment_date']) : null;

			 $telephone = isset($_POST['telephone']) ? 0 : 1;
			 //$notes = isset($_POST['notes']) ? Utils::sanitizeString($_POST['notes']) : NULL;


            if ($customer && $vacancy && $department && $education_level && $position_number && $age_min && $age_max && $gender && $civil_status && $salary_min && $salary_max && $workdays && $schedule && $state && $city  && $area && $subarea) {
                $authorization_date = $authorization_date ? date_format(date_create($authorization_date), 'Y-m-d H:i') : NULL;
                $vacante = new Vacancy();
                $vacante->setId($id);
                $vacante->setId_customer($customer);
                $vacante->setId_customer_contact($customer_contact);
                $vacante->setBusiness_name($business_name);
                $vacante->setId_recruiter($recruiter);
                $vacante->setVacancy($vacancy);
                $vacante->setDepartment($department);
                $vacante->setReport_to($report_to);
                $vacante->setPersonal_in_charge($personal_in_charge);
                $vacante->setId_education_level($education_level);
                $vacante->setPosition_number($position_number);
                $vacante->setExperience_years($experience_years);
                $vacante->setExperience($experience);
                $vacante->setAge_min($age_min);
                $vacante->setAge_max($age_max);
                $vacante->setId_gender($gender);
                $vacante->setId_civil_status($civil_status);
                $vacante->setId_language($language);
                $vacante->setId_language_level($language_level);
                $vacante->setSalary_min($salary_min);
                $vacante->setSalary_max($salary_max);
                $vacante->setBenefits($benefits);
                $vacante->setWorkdays($workdays);
                $vacante->setSchedule($schedule);
                $vacante->setRequirements($requirements);
                $vacante->setFunctions($functions);
                $vacante->setSkills($skills);
                $vacante->setTechnical_knowledge($technical_knowledge);
                $vacante->setId_state($state);
                $vacante->setId_city($city);
                $vacante->setId_area($area);
                $vacante->setId_subarea($subarea);
                $vacante->setComments($comments);
                $vacante->setType($type);
                $vacante->setWarranty_time($warranty_time);
                $vacante->setAmount_to_invoice($amount_to_invoice);
                $vacante->setAuthorization_date($authorization_date);
                $vacante->setCommitment_date($commitment_date);
                $vacante->setWorking_day($working_day);
                $vacante->setSend_date_candidate($send_date_candidate);
                $vacante->setAdvance_payment($advance_payment);
                $vacante->setPayment_amount($payment_amount);
                $vacante->setExperience_type($experience_type);
                $vacante->setRecruitment_service_cost($recruitment_service_cost);
				$vacante->setTelephone($telephone);
				//$vacante->setNotes($notes);


                $save = $vacante->update();

                if ($save) {
                    $id = $vacante->getId();
                    $question = new VacancyQuestionnaire();
                    $question->setId_vacancy($id);
                    $question->setHow_many_interviews($how_many_interviews);
                    $question->setAccept_reentry($accept_reentry);
                    $question->setOffer_transportation($offer_transportation);
                    $question->setDo_medical_exam($do_medical_exam);

                    $CandidateDirectoryObj = new CandidateDirectory();
                    $CandidateDirectoryObj->setId_vacancy($id);
                    $CandidateDirectoryObj->setId_state($state);
                    $CandidateDirectoryObj->setId_city($city);
                    $CandidateDirectoryObj->updateByVacancy();
                    
                    $guardado = $question->update();
                    if ($guardado) {
                        echo 1;
                    } else {
                        echo 5;
                    }
                } else {
                    echo 6;
                }
            } else {
                echo 0;
            }
        } else {
            header("location:" . base_url);
        }
    }

    public function changeStatus()
    {
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSenior() || Utils::isJunior() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isCustomer() || Utils::isRecruitmentManager()) {
            $id = isset($_POST['id']) ? trim($_POST['id']) : FALSE;
            $status = isset($_POST['status']) ? trim($_POST['status']) : FALSE;
            if ($id && $status) {
                $vacancy = new Vacancy();
                $vacancy->setId($id);
                $vacancy->setId_status($status);
                $done = $vacancy->changeStatus();
                if ($done) {
                    if ($status == 5) {
                        $vacante = $vacancy->getOne();
                        $vacancy = $vacante->vacancy;
                        $customer = $vacante->customer;

                        $email_facturacion = 'facturacion@rrhhingenia.com';
                        $email_facturacion1 = 'facturacion1@rrhhingenia.com';
                        $name = 'Marisa Vallejo';
                        $name1 = 'Janet Gómez';
                        $subject = 'Cierre de vacante de ' . $customer;
                        $closed_by = $_SESSION['identity']->first_name . ' ' . $_SESSION['identity']->last_name;
                        $greetings = date('G') < 6 || date('G') > 19 ? 'Buenas noches' : (date('G') >= 6 && date('G') < 12 ? 'Buenos días' : 'Buenas tardes');

                        $body = "{$greetings}, Lic. {$name}<br><br>Se le informa que la vacante de <b>{$vacancy}</b> solicitada por el cliente <u>{$customer}</u> ha sido cerrada por {$closed_by}.";
                        $body1 = "{$greetings}, Lic. {$name1}<br><br>Se le informa que la vacante de <b>{$vacancy}</b> solicitada por el cliente <u>{$customer}</u> ha sido cerrada por {$closed_by}.";
                        Utils::sendEmail($email_facturacion, $name, $subject, $body);
                        Utils::sendEmail($email_facturacion1, $name1, $subject, $body1);
                    }
                    echo 1;
                } else
                    echo 0;
            }
        }
    }

    public function restart_date()
    {
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSenior() || Utils::isJunior() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isRecruitmentManager()) {
            $id = isset($_POST['id']) ? trim($_POST['id']) : FALSE;
            if ($id) {
                $vacancy = new Vacancy();
                $vacancy->setId($id);
                $done = $vacancy->restartSendDate();
                if ($done)
                    echo 1;
                else
                    echo 0;
            }
        }
    }

    public function duplicate()
    {
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSenior() || Utils::isJunior() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isRecruitmentManager()) {
            $id = isset($_POST['id']) ? trim($_POST['id']) : FALSE;

            if ($id) {
                $vacancy = new Vacancy();
                $vacancy->setId($id);
                $vacancy->setRequest_date(Utils::getFechaIngresoVacante());
                $vacancy->setCreated_by($_SESSION['identity']->id);
                $done = $vacancy->duplicate();
                if ($done) {
                    $id_vacancy = $vacancy->getId();
                    $question = new VacancyQuestionnaire();
                    $question->setId_vacancy($id_vacancy);
                    $question->setId($id);
                    $duplicated = $question->duplicate();

                    if ($duplicated) {
                        $vacancy->setId($id_vacancy);
                        $vacante = $vacancy->getOne();
                        $customer = $vacante->customer;
                        $recruiter = $vacante->recruiter;
                        $recruiter_email = $vacante->recruiter_email;
                        $vacancy = $vacante->vacancy;

                        $subject = 'Nueva vacante de ' . $customer;
                        $created_by = $_SESSION['identity']->first_name . ' ' . $_SESSION['identity']->last_name;
                        $body = "Se ha registrado una nueva vacante de <b>{$customer}</b> para el puesto de <b>{$vacancy}</b> la cual fue creada por {$created_by}.";
                        if ($recruiter) {
                            $ejecutivo = '<br>El ejecutivo que la atenderá será <b>' . $recruiter . '</b>';
                            $body = "{$body} {$ejecutivo}";

                            Utils::sendEmail($recruiter_email, $recruiter, $subject, $body);
                        }

                        echo 1; //if everything is ok, returns 1
                        Utils::sendEmail('cindy.luna@rrhhingenia.com', 'Cindy Luna', $subject, $body);
                        Utils::sendEmail('iveth.gomez@rrhhingenia.com', 'Iveth Gómez', $subject, $body);
                    }
                } else
                    echo 0;
            }
        }
    }

    public function getOne()
    {
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin()) {
            $id_vacancy = isset($_POST['id_vacancy']) ? trim($_POST['id_vacancy']) : FALSE;

            if ($id_vacancy) {
                $vacancy = new Vacancy();
                $vacancy->setId($id_vacancy);
                $vacancy_data = $vacancy->getOne();

                /*$business = new BusinessName();
                $business->setId_Customer($applicant_data->id_customer);
                $business_names = $business->getBNByCustomer();*/

                header('Content-Type: text/html; charset=utf-8');
                echo $json_vacancy = json_encode($vacancy_data, \JSON_UNESCAPED_UNICODE);
            } else {
                echo 0;
            }
        } else {
            header('location:' . base_url);
        }
    }

    public function update_config()
    {
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSenior() || Utils::isRecruitmentManager()) {
            $id = isset($_POST['id_vacancy']) && !empty($_POST['id_vacancy']) ? trim($_POST['id_vacancy']) : FALSE;
            $time = isset($_POST['time']) && !empty($_POST['time']) ? trim($_POST['time']) : FALSE;

            $request_day = isset($_POST['request_day']) ? $_POST['request_day'] : FALSE;
            $request_month = isset($_POST['request_month']) ? str_pad($_POST['request_month'], 2, "0", STR_PAD_LEFT) : FALSE;
            $request_year = isset($_POST['request_year']) ? str_pad($_POST['request_year'], 2, "0", STR_PAD_LEFT) : FALSE;
            $request_hour = isset($_POST['request_hour']) ? str_pad($_POST['request_hour'], 2, "0", STR_PAD_LEFT) : FALSE;
            $request_minute = isset($_POST['request_minute']) ? str_pad($_POST['request_minute'], 2, "0", STR_PAD_LEFT) : FALSE;

            $send_day = isset($_POST['send_day']) ? $_POST['send_day'] : FALSE;
            $send_month = isset($_POST['send_month']) ? str_pad($_POST['send_month'], 2, "0", STR_PAD_LEFT) : FALSE;
            $send_year = isset($_POST['send_year']) ? str_pad($_POST['send_year'], 2, "0", STR_PAD_LEFT) : FALSE;
            $send_hour = isset($_POST['send_hour']) ? str_pad($_POST['send_hour'], 2, "0", STR_PAD_LEFT) : FALSE;
            $send_minute = isset($_POST['send_minute']) ? str_pad($_POST['send_minute'], 2, "0", STR_PAD_LEFT) : FALSE;

            $end_day = isset($_POST['end_day']) ? $_POST['end_day'] : FALSE;
            $end_month = isset($_POST['end_month']) ? str_pad($_POST['end_month'], 2, "0", STR_PAD_LEFT) : FALSE;
            $end_year = isset($_POST['end_year']) ? str_pad($_POST['end_year'], 2, "0", STR_PAD_LEFT) : FALSE;
            $end_hour = isset($_POST['end_hour']) ? str_pad($_POST['end_hour'], 2, "0", STR_PAD_LEFT) : FALSE;
            $end_minute = isset($_POST['end_minute']) ? str_pad($_POST['end_minute'], 2, "0", STR_PAD_LEFT) : FALSE;




            if ($request_day && $request_month && $request_year && $request_hour && $request_minute) {
                $request_date = DateTime::createFromFormat('Y-m-d H:i', "{$request_year}-{$request_month}-{$request_day} {$request_hour}:{$request_minute}");
                $request_date = $request_date->format('Y-m-d H:i');

                if ($send_day && $send_month && $send_year && $send_hour && $send_minute) {
                    $send_date = DateTime::createFromFormat('Y-m-d H:i', "{$send_year}-{$send_month}-{$send_day} {$send_hour}:{$send_minute}");
                    $send_date = $send_date->format('Y-m-d H:i');
                } else {
                    $send_date = NULL;
                }

                if ($end_day && $end_month && $end_year && $end_hour && $end_minute) {
                    $end_date = DateTime::createFromFormat('Y-m-d H:i', "{$end_year}-{$end_month}-{$end_day} {$end_hour}:{$end_minute}");
                    $end_date = $end_date->format('Y-m-d H:i');
                } else {
                    $end_date = NULL;
                }


                $vacancy = new Vacancy();
                $vacancy->setId($id);
                $vacancy->setTime($time);
                $vacancy->setRequest_date($request_date);
                $vacancy->setSend_date($send_date);
                $vacancy->setEnd_date($end_date);
                $update = $vacancy->updateConfig();

                if ($update)
                    echo 1;
                else
                    echo 2;
            } else {
                echo 0;
            }
        } else {
            header("location:" . base_url);
        }
    }

    //==============================[Ulises y Rafa 28 Febrero 23]================================================
    public function vacantePDF()
    {
        if (isset($_SESSION['identity']) && isset($_GET['id'])) {
            $id = Encryption::decode($_GET['id']);
            $vacancy = new Vacancy();
            $vacancy->setId($id);
            $vacante = $vacancy->getOne();

            require_once 'libraries/fpdf/fpdf.php';
            require_once 'helpers/Vacante.php';

            $fpdf = new Vacante("P", "pt", "Letter");
            require('./libraries/fpdf/makefont/makefont.php');
            $fpdf->AddFont('SinkinSansLight', '', 'SinkinSans-300Light.php');
            $fpdf->AddFont('SinkinSans', '', 'SinkinSans-400Regular.php');
            $fpdf->AddFont('SinkinSans', 'I', 'SinkinSans-400Italic.php');
            $fpdf->AddFont('SinkinSans', 'B', 'SinkinSans-700Bold.php');
            $fpdf->AddFont('SinkinSans', 'BI', 'SinkinSans-700BoldItalic.php');
            $fpdf->SetTitle("Propuesta Reclutamiento", true);
            $fpdf->SetFont('Times');
            $fpdf->SetMargins(0, 55, 87, 0);
            $fpdf->AddPage();
            $fpdf->setText($vacante);
            $fpdf->Output('I', 'Propuesta_Reclutamiento_' . $vacante->vacancy . '_' . $vacante->customer . '.pdf', true);
        } else {
            header("location:" . base_url);
        }
    }
    //==============================[Ulises y Rafa 28 Febrero 23]================================================


    //==============================[gabo  7 marzo 2023]================================================

    public function update_perfil()
    {
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin()  || Utils::isSales() || Utils::isManager() || Utils::isSalesManager())) {

            $id = isset($_POST['id']) ? trim(Encryption::decode($_POST['id'])) : FALSE;
            $vacancy = isset($_POST['vacancy']) ? trim($_POST['vacancy']) : FALSE; //
            $department = isset($_POST['department']) ? trim($_POST['department']) : FALSE; //
            $salary_min = isset($_POST['salary_min']) ? trim($_POST['salary_min']) : FALSE;  //
            $salary_max = isset($_POST['salary_max']) ? trim($_POST['salary_max']) : FALSE; //
            $area = isset($_POST['area']) ? trim($_POST['area']) : FALSE; //
            $subarea = isset($_POST['subarea']) ? trim($_POST['subarea']) : FALSE;   //
            $type =  isset($_POST['type']) ?  Utils::sanitizeNumber($_POST['type'])  : NULL; //
            $warranty_time = Utils::sanitizeString($_POST['warranty_time']);  //
            $amount_to_invoice = Utils::sanitizeString($_POST['amount_to_invoice']);  //
            $authorization_date = isset($_POST['authorization_date']) ?  Utils::sanitizeString($_POST['authorization_date']) : ""; //
            $commitment_date =  isset($_POST['commitment_date']) ? Utils::sanitizeString($_POST['commitment_date']) : ""; //
            $working_day = isset($_POST['working_day']) ? trim($_POST['working_day']) : FALSE; //
            $state = isset($_POST['state']) ? trim($_POST['state']) : FALSE; //
            $city = isset($_POST['city']) ? trim($_POST['city']) : FALSE; //
            $report_to = isset($_POST['report_to']) ?  Utils::sanitizeString($_POST['report_to']) : false;  //
            $personal_in_charge = isset($_POST['personal_in_charge']) ?  Utils::sanitizeString($_POST['personal_in_charge']) : false;  //

            if ($vacancy  && $department  && $salary_min && $salary_max && $working_day && $state && $city  && $area && $subarea) {
                $authorization_date = $authorization_date ? date_format(date_create($authorization_date), 'Y-m-d H:i') : NULL;
                $vacante = new Vacancy();
                $vacante->setId($id);
                $vacante->setVacancy($vacancy);
                $vacante->setDepartment($department);
                $vacante->setSalary_min($salary_min);
                $vacante->setSalary_max($salary_max);
                $vacante->setWorking_day($working_day);
                $vacante->setId_state($state);
                $vacante->setId_city($city);
                $vacante->setId_area($area);
                $vacante->setId_subarea($subarea);
                $vacante->setType($type);
                $vacante->setWarranty_time($warranty_time);
                $vacante->setAmount_to_invoice($amount_to_invoice);
                $vacante->setAuthorization_date($authorization_date);
                $vacante->setCommitment_date($commitment_date);
                $vacante->setReport_to($report_to);
                $vacante->setPersonal_in_charge($personal_in_charge);
                $save = $vacante->update_perfil();

                if ($save) {
                    $vacante = $vacante->getOne();
                    $vacante->salary_min = number_format($vacante->salary_min, 0);
                    $vacante->salary_max = number_format($vacante->salary_max, 0);
                    $vacante->amount_to_invoice = number_format($vacante->amount_to_invoice, 2);
                    switch ($vacante->type) {
                        case 1:
                            $vacante->type = 'Operativa';
                            break;
                        case 2:
                            $vacante->type = 'Orden Común';
                            break;
                        case 3:
                            $vacante->type = 'Head Hunting';
                            break;
                        default:
                            $vacante->type = '';
                            break;
                    }

                    echo json_encode(array('vacante' => $vacante, 'status' => 1));
                } else
                    echo json_encode(array('status' => 6));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }


    public function update_descripcion()
    {
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin()  || Utils::isManager() || Utils::isSales() || Utils::isSalesManager())) {
            $id = isset($_POST['id']) ? trim(Encryption::decode($_POST['id'])) : FALSE;
            $education_level = isset($_POST['education_level']) ? trim($_POST['education_level']) : FALSE; //
            $position_number = isset($_POST['position_number']) ? trim($_POST['position_number']) : FALSE; //
            $experience_years = isset($_POST['experience_years']) ? trim($_POST['experience_years']) : FALSE;  //
            $experience_type = isset($_POST['experience_type']) ? trim($_POST['experience_type']) : FALSE; //
            $age_min =  isset($_POST['age_min']) ?  Utils::sanitizeNumber($_POST['age_min']) : FALSE; //
            $age_max =  isset($_POST['age_max']) ?  Utils::sanitizeNumber($_POST['age_max']) : FALSE; //
            $gender = Utils::sanitizeNumber($_POST['gender']);  //
            $civil_status =  isset($_POST['civil_status']) ? Utils::sanitizeNumber($_POST['civil_status']) : FALSE;  //
            $language = Utils::sanitizeNumber($_POST['language']);  //
            $language_level = Utils::sanitizeNumber($_POST['language_level']);  //
            $workdays =  isset($_POST['workdays']) ? Utils::sanitizeString($_POST['workdays']) : FALSE; //
            $schedule = isset($_POST['schedule']) ? Utils::sanitizeString($_POST['schedule']) : FALSE; //
            $requirements = isset($_POST['requirements']) && $_POST['requirements'] != "" ? Utils::sanitizeString($_POST['requirements']) : FALSE; //   gabo 17 abril  quitar a ventas 
            $functions = isset($_POST['functions']) && $_POST['functions'] != "" ?  Utils::sanitizeString($_POST['functions']) : false;  //   gabo 17 abril  quitar a ventas 
            $benefits = isset($_POST['benefits'])  && $_POST['benefits'] != "" ? Utils::sanitizeString($_POST['benefits']) : false;  //   gabo 17 abril  quitar a ventas 
            $comments = isset($_POST['comments']) ?  Utils::sanitizeString($_POST['comments']) : false;  //
            $experience = isset($_POST['experience']) ?  Utils::sanitizeString($_POST['experience']) : false;  //
            $skills = isset($_POST['skills']) ?  Utils::sanitizeString($_POST['skills']) : false;  //

            if ($education_level  && $position_number  && $experience_years && $experience_type && $age_min && $age_max && $civil_status  && $schedule) {
                $vacante = new Vacancy();
                $vacante->setId($id);
                $vacante->setId_education_level($education_level);
                $vacante->setPosition_number($position_number);
                $vacante->setExperience_years($experience_years);
                $vacante->setExperience_type($experience_type);
                $vacante->setAge_min($age_min);
                $vacante->setAge_max($age_max);
                $vacante->setId_gender($gender);
                $vacante->setId_civil_status($civil_status);
                $vacante->setId_language($language);
                $vacante->setId_language_level($language_level);
                $vacante->setWorkdays($workdays);
                $vacante->setSchedule($schedule);
                $vacante->setRequirements($requirements);
                $vacante->setFunctions($functions);
                $vacante->setBenefits($benefits);
                $vacante->setComments($comments);
                $save = $vacante->update_descripcion();

                if ($save) {
                    $vacante = $vacante->getOne();
                    $vacante->experience_years =  ($vacante->experience_years == 0) ? 'Sin experiencia' : $vacante->experience_years . ' ' . $vacante->experience_type;
                    $vacante->age_min = 'entre ' . $vacante->age_min . ' y ' . $vacante->age_max . ' años';
                    $vacante->language = $vacante->language . ' ' . $vacante->language_level;
                    echo json_encode(array('vacante' => $vacante, 'status' => 1));
                } else
                    echo json_encode(array('status' => 6));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }


    public function update_contacto()
    {
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin()  || Utils::isManager() || Utils::isSalesManager() || Utils::isSenior())) {
            $id = isset($_POST['id']) ? trim(Encryption::decode($_POST['id'])) : FALSE;
            $customer = isset($_POST['customer']) ? trim($_POST['customer']) : FALSE; //
            $customer_contact = isset($_POST['customer_contact']) ? trim($_POST['customer_contact']) : FALSE; //
            $business_name = isset($_POST['business_name']) ? trim($_POST['business_name']) : FALSE;  //
            $recruiter = isset($_POST['recruiter']) ? trim($_POST['recruiter']) : FALSE; //

            if ($customer  && $customer_contact  && $business_name && $recruiter) {
                $vacante = new Vacancy();
                $vacante->setId($id);
                $vacante->setId_customer($customer);
                $vacante->setId_customer_contact($customer_contact);
                $vacante->setBusiness_name($business_name);
                $vacante->setId_recruiter($recruiter);
                $save = $vacante->update_contacto();

                if ($save) {
                    $vacante = $vacante->getOne();
                    echo json_encode(array('vacante' => $vacante, 'status' => 1));
                } else
                    echo json_encode(array('status' => 6));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }


    public function update_condiciones()
    {
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin()  || Utils::isManager() || Utils::isSalesManager() || Utils::isSales() || Utils::isSenior())) {

            $id = isset($_POST['id']) ? trim(Encryption::decode($_POST['id'])) : FALSE;
            $send_date_candidate = isset($_POST['send_date_candidate']) ?  Utils::sanitizeStringBlank($_POST['send_date_candidate']) : null;
            $advance_payment = isset($_POST['advance_payment']) ?  Utils::sanitizeStringBlank($_POST['advance_payment']) : null;
            $payment_amount = isset($_POST['payment_amount']) ?  Utils::sanitizeStringBlank($_POST['payment_amount']) : null;
            $recruitment_service_cost = isset($_POST['recruitment_service_cost']) ?  Utils::sanitizeStringBlank($_POST['recruitment_service_cost']) : null;

            if (strlen($recruitment_service_cost) <= 3) {
                if ($send_date_candidate  && $advance_payment  && $payment_amount && $recruitment_service_cost) {

                    $vacante = new Vacancy();
                    $vacante->setId($id);
                    $vacante->setSend_date_candidate($send_date_candidate);
                    $vacante->setAdvance_payment($advance_payment);
                    $vacante->setPayment_amount($payment_amount);
                    $vacante->setRecruitment_service_cost($recruitment_service_cost);
                    $save = $vacante->update_condiciones();

                    if ($save) {
                        $vacante = $vacante->getOne();
                        $vacante->send_date_candidate =   Utils::getDate($vacante->send_date_candidate);
                        $vacante->payment_amount  =       number_format($vacante->payment_amount, 2) . " pesos";
                        $vacante->advance_payment  =       number_format($vacante->advance_payment, 2) . "pesos";
                        $vacante->recruitment_service_cost  =    number_format($vacante->recruitment_service_cost, 0) . "%";

                        echo json_encode(array('vacante' => $vacante, 'status' => 1));
                    } else
                        echo json_encode(array('status' => 6));
                } else
                    echo json_encode(array('status' => 0));
            } else
                echo json_encode(array('status' => 2));
        } else
            echo json_encode(array('status' => 0));
    }
    //=========================fin gabo============================

    //======================[Gabo Marzo 28 Perfil Postulado]=======
    public function consulta_vacante()
    {
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin()  || Utils::isManager() || Utils::isSalesManager() || Utils::isSenior() || Utils::isCustomer())) {
            $id = isset($_POST['id_vacancy']) ? trim(Encryption::decode($_POST['id_vacancy'])) : FALSE;
            if ($id) {
                $vacante = new Vacancy();
                $vacante->setId($id);
                $result = $vacante->getOne();

                if ($result) {
                    $result->salary_min  =       number_format($result->salary_min, 2);
                    $result->salary_max  =       number_format($result->salary_max, 2);
                    echo json_encode(array('vacante' => $result, 'status' => 1));
                } else
                    echo json_encode(array('status' => 0));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }
    //==========================================================
  //======================[Gabo Junio 02 Entregable]=======

    public function entregableVacante()
    {
        if (isset($_SESSION['identity']) && isset($_GET['id']) && (Utils::isAdmin() || Utils::isManager() || Utils::isSalesManager() || Utils::isSenior() || Utils::isSales())) {

            $id = Encryption::decode($_GET['id']);
            $vacancy = new Vacancy();
            $vacancy->setId($id);
            $vacante = $vacancy->getOne();

            require_once 'libraries/fpdf/fpdf.php';
            require_once 'helpers/Propuestas/Entregable.php';

            $fpdf = new Entregable("P", "pt", "Letter");
            require('./libraries/fpdf/makefont/makefont.php');
            $fpdf->AddFont('SinkinSansLight', '', 'SinkinSans-300Light.php');
            $fpdf->AddFont('SinkinSans', '', 'SinkinSans-400Regular.php');
            $fpdf->AddFont('SinkinSans', 'I', 'SinkinSans-400Italic.php');
            $fpdf->AddFont('SinkinSans', 'B', 'SinkinSans-700Bold.php');
            $fpdf->AddFont('SinkinSans', 'BI', 'SinkinSans-700BoldItalic.php');

            $fpdf->SetTitle("Formato Entrevista Operativos");
            $fpdf->SetFont('Times');
            $fpdf->SetMargins(0, 55, 87, 0);
            $fpdf->AddPage();
            $fpdf->expLaborales($vacante);
            $fpdf->Output('I', 'Formato Entrevista Reclutamiento.pdf', true);
        } else {
            header("location:" . base_url);
        }
    }
    //==========================================================
 public function getVacancySateCity()
    {
        if (Utils::isValid($_SESSION['identity'])) {
            $id_vacancy = isset($_POST['id_vacancy']) ? trim($_POST['id_vacancy']) : FALSE;

            if ($id_vacancy) {
                $vacancy = new Vacancy();
                $vacancy->setId($id_vacancy);
                $vacancy_data = $vacancy->getOne();

                $State = new State();
                $State = $State->getAll();

                $City = new City();
                $City->setId_state($vacancy_data->id_state);
                $City = $City->getCitiesByState();

                /*
                $business = new BusinessName();
                $business->setId_Customer($applicant_data->id_customer);
                $business_names = $business->getBNByCustomer();
                */


                echo json_encode(array('status' => 1, 'vacancy_data' => $vacancy_data, 'State' => $State, 'City' => $City));

            } else {
                echo json_encode(array('status' => 0));
            }
        } else {
            echo json_encode(array('status' => 0));
        }
    }
	  public function save_notes()
    {
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin())) {

            $id_vacancy = isset($_POST['id_vacancy']) ? trim(Encryption::decode($_POST['id_vacancy'])) : FALSE;
            $notes = isset($_POST['notes']) ?  Utils::sanitizeStringBlank($_POST['notes']) : null;

            if ($id_vacancy && $notes) {


                $vacante = new Vacancy();
                $vacante->setId($id_vacancy);
                $vacante->setNotes($notes);
                $save = $vacante->update_notes();

                if ($save) {
                    echo json_encode(array('status' => 1));
                } else {
                    echo json_encode(array('status' => 2));
                }
            } else {
                echo json_encode(array('status' => 0));
            }
        } else {
            echo json_encode(array('status' => 0));
        }
    }
}
