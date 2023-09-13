<?php
require_once 'libraries/fpdf/fpdf.php';
require_once 'helpers/Resume.php';
require_once 'helpers/FormatosCV/CVoperativo.php';
require_once 'models/Candidate.php';
require_once 'models/CandidateExperience.php';
require_once 'models/CandidateAptitude.php';
require_once 'models/CandidateLanguage.php';
require_once 'models/CandidateAdditionalPreparation.php';
require_once 'models/CandidateEducation.php';
require_once 'models/User.php';


class ResumeController{
	public function generate(){
		if (isset($_SESSION['identity']) || Utils::isCandidate()) {
            
            if (Utils::isCandidate()) {
                $id_username = $_SESSION['identity']->id;
                $candidate = new Candidate();
                $candidate->setId_user($id_username);
                $candidato = $candidate->getCandidateByUsername();
                $id = $candidato->id;
                
            }else{
                $id = Encryption::decode($_GET['id']);
                $candidate = new Candidate();
                $candidate->setId($id);
                $candidato = $candidate->getOne();
            }

            $path = 'uploads/candidate/'.$candidato->id;
            if (file_exists($path) && !empty($candidato->id)) {
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
            }

            $experience = new CandidateExperience();
            $experience->setId_candidate($id);
            $experiences = $experience->getExperiencesByCandidate();

            $aptitude = new CandidateAptitude();
            $aptitude->setId_candidate($id);
            $aptitudes = $aptitude->getAptitudesByCandidate();

            $preparation = new CandidateAdditionalPreparation();
            $preparation->setId_candidate($id);
            $preparations = $preparation->getAdditionalPreparationsByCandidate();

            $language = new CandidateLanguage();
            $language->setId_candidate($id);
            $languages = $language->getLanguagesByCandidate();

            $apt_lang = array_merge($preparations, $languages);
            
            $pdf = new Resume("P", "pt", "Letter");
            require('./libraries/fpdf/makefont/makefont.php');
            $pdf->AddFont('SinkinSansLight','', 'SinkinSans-300Light.php');
            $pdf->AddFont('SinkinSans','', 'SinkinSans-400Regular.php');
            $pdf->AddFont('SinkinSans','I', 'SinkinSans-400Italic.php');
            $pdf->AddFont('SinkinSans','B', 'SinkinSans-700Bold.php');
            $pdf->AddFont('SinkinSans','BI', 'SinkinSans-700BoldItalic.php');
            $pdf->AddFont('IBMPlexSans-Regular', '', 'IBMPlexSans-Regular.php');
            $pdf->AddFont('IBMPlexSans-Light', '', 'IBMPlexSans-Light.php');
            $pdf->AddFont('IBMPlexSans-Bold', 'B', 'IBMPlexSans-Bold.php');
            $pdf->AddFont('IBMPlexSans-Italic', 'I', 'IBMPlexSans-Italic.php');
            $pdf->AddFont('IBMPlexSans-BoldItalic', 'BI', 'IBMPlexSans-BoldItalic.php');
            $pdf->AddFont('NotoSans-Regular','', 'NotoSans-Regular.php');
            $pdf->AddFont('NotoSans-Light','', 'NotoSans-Light.php');
            $pdf->AddFont('NotoSans-Bold','B', 'NotoSans-Bold.php');
            $pdf->AddFont('NotoSans-Italic','I', 'NotoSans-Italic.php');
            $pdf->AddFont('NotoSans-BoldItalic','BI', 'NotoSans-BoldItalic.php');
            $pdf->AddFont('Lato-Regular','', 'Lato-Regular.php');
            $pdf->AddFont('Lato-Light','', 'Lato-Light.php');
            $pdf->AddFont('Lato-Bold','B', 'Lato-Bold.php');
            $pdf->AddFont('Lato-Italic','I', 'Lato-Italic.php');
            $pdf->AddFont('Lato-BoldItalic','BI', 'Lato-BoldItalic.php');
			$pdf->SetTitle("CV_".$candidato->first_name.'_'.$candidato->surname, true);
			$pdf->SetFont('Times');
			$pdf->SetMargins(0, 55, 0, 0);
            $pdf->AddPage();
			$pdf->SetAbout($candidato, $route);
            $pdf->SetExperience($experiences);
            $pdf->SetEducation($candidato, $apt_lang);
            $pdf->setAdditionalPreparation($preparations);
            $pdf->setLanguages($languages);
            $pdf->SetAptitude($aptitudes);
			$pdf->Output('I', 'CV '.$candidato->first_name.' '.$candidato->surname.' '.$candidato->last_name.'.pdf', true);
		}else{
			header("location:".base_url);
		}
	}
	
	  public function CVoperador()
    {
        $id = Encryption::decode($_GET['id']);
        $candidate = new Candidate();
        $candidate->setId($id);
        $candidato = $candidate->getOne();

        $experience = new CandidateExperience();
        $experience->setId_candidate($id);
        $experiences = $experience->getExperiencesByCandidate();

        /* $aptitude = new CandidateAptitude();
        $aptitude->setId_candidate($id);
        $aptitudes = $aptitude->getAptitudesByCandidate();

           $preparation = new CandidateAdditionalPreparation();
        $preparation->setId_candidate($id);
        $preparations = $preparation->getAdditionalPreparationsByCandidate();

        $language = new CandidateLanguage();
        $language->setId_candidate($id);
        $languages = $language->getLanguagesByCandidate(); 
        
        $apt_lang = array_merge($preparations, $languages); */

        $user_obj = new User();
        $user_obj->setId($candidato->created_by);
        $user = $user_obj->getOne();
        $user =  $user != false ? $user->first_name . ' ' . $user->last_name : Null;


        if ($candidato->date_birth) {
            $fechaNacimiento = $candidato->date_birth ; // La fecha de nacimiento en formato YYYY-MM-DD
            $fechaNacimiento = new DateTime($fechaNacimiento);
            $hoy = new DateTime(date('Y-m-d'));
            $candidato->date_birth  = $fechaNacimiento->diff($hoy)->y;
        }


        $datos = array(
            'nombre' => $candidato->first_name . ' ' . $candidato->surname . ' ' . $candidato->last_name,
            'tvacante' => $candidato->job_title,
            'edad' => $candidato->age != '' || $candidato->age != null ? $candidato->age : $candidato->date_birth ,
            'telefono' => $candidato->cellphone,
            'escolaridad' => $candidato->level . ' ' . $candidato->title,
            'estadores' => $candidato->state
        );


        $entrevista = array(
            'comentarios' => $candidato->description,
            'entrevistador' =>  $user
        );


       $pdf = new CVoperativo("P", "pt", "Letter");
        $pdf->AddFont('SinkinSans', '', 'SinkinSans-400Regular.php');
        $pdf->AddFont('SinkinSans', '', 'SinkinSans-300Light.php');
        $pdf->AddFont('SinkinSans', 'B', 'SinkinSans-700Bold.php');
        $pdf->AddFont('SinkinSans', 'I', 'SinkinSans-400Italic.php');
        $pdf->AddFont('SinkinSans', 'BI', 'SinkinSans-700BoldItalic.php');
        $pdf->SetTitle("Formato Entrevista Operativos");
        $pdf->SetFont('Times');
        $pdf->SetMargins(0, 55, 87, 0);
        $pdf->AddPage();
        $pdf->datosGenerales($datos, $entrevista);
        $pdf->expLaborales($experiences, $entrevista);
        $pdf->Output('I', 'Formato Entrevista Reclutamiento.pdf', true);		  
        $pdf->SetTitle("CV_" . $candidato->first_name . '_' . $candidato->surname.'.pdf', true);
    }

    public function creator(){
		if (isset($_POST) && isset($_SESSION['data'])) {
			$_SESSION['data']->id = 18803;
            $id = Utils::sanitizeNumber($_SESSION['data']->id);
            $first_name = Utils::sanitizeStringBlank($_POST['first_name']);
            $surname = Utils::sanitizeStringBlank($_POST['surname']);
            $last_name = Utils::sanitizeStringBlank($_POST['last_name']);
            $date_birth = @Utils::sanitizeString($_POST['date_birth']);
            //$id_level = isset($_POST['id_level']) ? trim($_POST['id_level']) : FALSE;
            $job_title = Utils::sanitizeStringBlank($_POST['job_title']);
            $description = Utils::sanitizeStringBlank($_POST['description']);
            $telephone = Utils::sanitizeString($_POST['telephone']);
            $cellphone = Utils::sanitizeString($_POST['cellphone']);
            $email = Utils::sanitizeEmail($_POST['email']);
            $id_state = @Utils::sanitizeNumber($_POST['id_state']);
            $id_city = @Utils::sanitizeNumber($_POST['id_city']);
            $id_area = Utils::sanitizeNumber($_POST['id_area']);
            $id_subarea = Utils::sanitizeNumber($_POST['id_subarea']);
            $education_level = isset($_POST['education_level']) && !empty($_POST['education_level']) ? Utils::sanitizeNumber($_POST['education_level']) : null;
            $education_institution = @Utils::sanitizeStringBlank($_POST['education_institution']);
            $education_title = @Utils::sanitizeStringBlank($_POST['education_title']);
            $education_start_date = @Utils::sanitizeStringBlank($_POST['education_start_date']);
            $education_end_date = @Utils::sanitizeStringBlank($_POST['education_end_date']);
            $education_still_studies = @$_POST['education_still_studies']  ? 1 : 0;

            if (($first_name != $_SESSION['data']->first_name) || ($surname != $_SESSION['data']->surname) || ($last_name != $_SESSION['data']->last_name) || ($date_birth != $_SESSION['data']->date_birth) || ($job_title != $_SESSION['data']->job_title) || ($description != $_SESSION['data']->description) || ($telephone != $_SESSION['data']->telephone) || ($cellphone != $_SESSION['data']->cellphone) || ($email != $_SESSION['data']->email) || ($id_state != $_SESSION['data']->id_state) || ($id_city != $_SESSION['data']->id_city) || ($id_area != $_SESSION['data']->id_area) || ($id_subarea != $_SESSION['data']->id_subarea)) {
                $candidate = new Candidate();
                $candidate->setId($id);
                $candidate->setFirst_name($first_name);
                $candidate->setSurname($surname);
                $candidate->setLast_name($last_name);
                $candidate->setDate_birth($date_birth);
                $candidate->setJob_title($job_title);
                $candidate->setDescription($description);
                $candidate->setTelephone($telephone);
                $candidate->setCellphone($cellphone);
                $candidate->setEmail($email);
                $candidate->setId_state($id_state);
                $candidate->setId_city($id_city);
                $candidate->setId_area($id_area);
                $candidate->setId_subarea($id_subarea);
                $candidate->update();
            }
            
            if (($education_level != $_SESSION['data']->education->id_level) || ($education_institution != $_SESSION['data']->education->institution) || ($education_title != $_SESSION['data']->education->title) || ($education_start_date != $_SESSION['data']->education->start_date) || ($education_end_date != $_SESSION['data']->education->end_date) || ($education_still_studies != $_SESSION['data']->education->still_studies)) {
                $candidateEducation = new CandidateEducation();
                $candidateEducation->setId_candidate($id);
                $candidateEducation->setId_level($education_level);
                $candidateEducation->setInstitution($education_institution);
                $candidateEducation->setTitle($education_title);
                $candidateEducation->setStart_date($education_start_date);
                $candidateEducation->setEnd_date($education_end_date);
                $candidateEducation->setStill_studies($education_still_studies);
                
                $education = $candidateEducation->getOne();
                if ($education)
                    $candidateEducation->update();
                else
                    $candidateEducation->save();
            }

            $experiences = [];

            if (isset($_POST['position_experience'])) {
                foreach ($_POST['position_experience'] as $key => $value) {
                    if (isset($_POST['position_experience'][$key]) && !empty($_POST['position_experience'][$key])) {
                        $experiences[$key]['item']  = isset($_POST['experience_id'][$key]) ? Utils::sanitizeNumber($_POST['experience_id'][$key]): 0;
                        $experiences[$key]['id_experience'] = isset($_POST['id_experience'][$key]) ? Utils::sanitizeNumber($_POST['id_experience'][$key]) : (isset(array_column($_SESSION['data']->experiences, 'id_experience')[$key]) ? array_column($_SESSION['data']->experiences, 'id_experience')[$key] : 0);
                        $experiences[$key]['position'] = Utils::sanitizeStringBlank($_POST['position_experience'][$key]);
                        $experiences[$key]['enterprise'] = Utils::sanitizeStringBlank(@$_POST['enterprise_experience'][$key]);
                        $experiences[$key]['id_subarea'] = isset($_POST['id_subarea_experience'][$key]) ? Utils::sanitizeNumber(@$_POST['id_subarea_experience'][$key]) : null;
                        $experiences[$key]['id_area'] = isset($_POST['id_area_experience'][$key]) ? Utils::sanitizeNumber(@$_POST['id_area_experience'][$key]) : null;
                        $experiences[$key]['id_city'] = isset($_POST['id_city_experience'][$key]) ? Utils::sanitizeNumber(@$_POST['id_city_experience'][$key]) : null;
                        $experiences[$key]['id_state'] = isset($_POST['id_state_experience'][$key]) ? Utils::sanitizeNumber(@$_POST['id_state_experience'][$key]) : null;
                        $experiences[$key]['city'] = isset($_POST['id_city_experience'][$key]) ? Utils::showCityById(@$_POST['id_city_experience'][$key])->city : '';
                        $experiences[$key]['state'] = isset($_POST['id_state_experience'][$key]) ? Utils::showStateById(@$_POST['id_state_experience'][$key])->state : '';
                        $experiences[$key]['start_date'] = Utils::sanitizeStringBlank(@$_POST['start_date_experience'][$key]);
                        $experiences[$key]['end_date'] = Utils::sanitizeStringBlank(@$_POST['end_date_experience'][$key]);
                        $experiences[$key]['still_works'] = (@$_POST['still_works_experience'][$key] ? 1 : 0);
                        $experiences[$key]['review'] = Utils::sanitizeStringBlank(@$_POST['review_experience'][$key]);
                        $experiences[$key]['activity1'] = Utils::sanitizeStringBlank(@$_POST['activity1'][$key]);
                        $experiences[$key]['activity2'] = Utils::sanitizeStringBlank(@$_POST['activity2'][$key]);
                        $experiences[$key]['activity3'] = Utils::sanitizeStringBlank(@$_POST['activity3'][$key]);
                        $experiences[$key]['activity4'] = Utils::sanitizeStringBlank(@$_POST['activity4'][$key]);

                        $candidateExperience = new CandidateExperience();
                        $candidateExperience->setPosition($experiences[$key]['position']);
                        $candidateExperience->setEnterprise($experiences[$key]['enterprise']);
                        $candidateExperience->setId_subarea($experiences[$key]['id_subarea']);
                        $candidateExperience->setId_area($experiences[$key]['id_area']);
                        $candidateExperience->setId_city($experiences[$key]['id_city']);
                        $candidateExperience->setId_state($experiences[$key]['id_state']);
                        $candidateExperience->setStart_date($experiences[$key]['start_date']);
                        $candidateExperience->setEnd_date($experiences[$key]['end_date']);
                        $candidateExperience->setStill_works($experiences[$key]['still_works']);
                        $candidateExperience->setReview($experiences[$key]['review']);
                        $candidateExperience->setActivity1($experiences[$key]['activity1']);
                        $candidateExperience->setActivity2($experiences[$key]['activity2']);
                        $candidateExperience->setActivity3($experiences[$key]['activity3']);
                        $candidateExperience->setActivity4($experiences[$key]['activity4']);
                        $candidateExperience->setId_candidate($id);

                        if ($experiences[$key]['id_experience'] == 0 && !isset(array_column($_SESSION['data']->experiences, 'id_experience')[$key]) && !in_array($experiences[$key]['item'], array_column($_SESSION['data']->experiences, 'experience_id'))) {
                            $candidateExperience->save();
                            $experiences[$key]['id_experience'] = $candidateExperience->getId();
                        }else {
                            if (($experiences[$key]['position'] != $_SESSION['data']->experiences[$key]['position']) || ($experiences[$key]['enterprise'] != $_SESSION['data']->experiences[$key]['enterprise']) || ($experiences[$key]['id_city'] != $_SESSION['data']->experiences[$key]['id_city']) || ($experiences[$key]['id_state'] != $_SESSION['data']->experiences[$key]['id_state']) || ($experiences[$key]['start_date'] != $_SESSION['data']->experiences[$key]['start_date']) || ($experiences[$key]['end_date'] != $_SESSION['data']->experiences[$key]['end_date']) || ($experiences[$key]['still_works'] != $_SESSION['data']->experiences[$key]['still_works']) || ($experiences[$key]['review'] != $_SESSION['data']->experiences[$key]['review']) || ($experiences[$key]['activity1'] != $_SESSION['data']->experiences[$key]['activity1']) || ($experiences[$key]['activity2'] != $_SESSION['data']->experiences[$key]['activity2']) || ($experiences[$key]['activity3'] != $_SESSION['data']->experiences[$key]['activity3']) || ($experiences[$key]['activity4'] != $_SESSION['data']->experiences[$key]['activity4'])) {
                                $candidateExperience->setId($experiences[$key]['id_experience']);
                                $candidateExperience->update();
                            }
                        }
                    }
                }
            }

            $preparations = [];

            if (isset($_POST['preparation_level'])) {
                foreach ($_POST['preparation_level'] as $key => $value) {
                    if (isset($_POST['preparation_course'][$key]) && !empty($_POST['preparation_course'][$key])) {
                        $preparations[$key]['item']  = isset($_POST['preparation_id'][$key]) ? Utils::sanitizeNumber($_POST['preparation_id'][$key]): 0;
                        $preparations[$key]['id'] = isset($_POST['id_preparation'][$key]) ? Utils::sanitizeNumber($_POST['id_preparation'][$key]) : (isset(array_column($_SESSION['data']->preparations, 'id_preparation')[$key]) ? array_column($_SESSION['data']->preparations, 'id_preparation')[$key] : 0);
                        $preparations[$key]['id_level'] = Utils::sanitizeNumber(@$_POST['preparation_level'][$key]);
                        $preparations[$key]['course'] = Utils::sanitizeStringBlank(@$_POST['preparation_course'][$key]);
                        $preparations[$key]['institution'] = Utils::sanitizeStringBlank(@$_POST['preparation_institution'][$key]);
                        $preparations[$key]['start_date'] = Utils::sanitizeStringBlank(@$_POST['preparation_start_date'][$key]);
                        $preparations[$key]['end_date'] = Utils::sanitizeStringBlank(@$_POST['preparation_end_date'][$key]);

                        $candidatePreparation = new CandidateAdditionalPreparation();
                        $candidatePreparation->setId_level($preparations[$key]['id_level']);
                        $candidatePreparation->setCourse($preparations[$key]['course']);
                        $candidatePreparation->setInstitution($preparations[$key]['institution']);
                        $candidatePreparation->setStart_date($preparations[$key]['start_date']);
                        $candidatePreparation->setEnd_date($preparations[$key]['end_date']);
                        $candidatePreparation->setId_candidate($id);

                        if ($preparations[$key]['id'] == 0 && !isset(array_column($_SESSION['data']->preparations, 'id_preparation')[$key]) && !in_array($preparations[$key]['item'], array_column($_SESSION['data']->preparations, 'preparation_id'))) {
                            $candidatePreparation->save();
                            $preparations[$key]['id'] = $candidatePreparation->getId();
                        }else {
                            if (($preparations[$key]['id_level'] != $_SESSION['data']->preparations[$key]['id_level']) || ($preparations[$key]['course'] != $_SESSION['data']->preparations[$key]['course']) || ($preparations[$key]['institution'] != $_SESSION['data']->preparations[$key]['institution']) || ($preparations[$key]['start_date'] != $_SESSION['data']->preparations[$key]['start_date']) || ($preparations[$key]['end_date'] != $_SESSION['data']->preparations[$key]['end_date'])) {
                                $candidatePreparation->setId($preparations[$key]['id']);
                                candidatePreparation->update();
                            }
                        }
                    }
                }
            }

            $languages = [];
            if (isset($_POST['language'])) {
                foreach ($_POST['language'] as $key => $value) {
                    if (isset($_POST['language'][$key]) && !empty($_POST['language'][$key])) {
                        $languages[$key]['item']  = isset($_POST['language_id'][$key]) ? Utils::sanitizeNumber($_POST['language_id'][$key]): 0;
                        $languages[$key]['id'] = isset($_POST['id_language'][$key]) ? Utils::sanitizeNumber($_POST['id_language'][$key]) : (isset(array_column($_SESSION['data']->languages, 'id')[$key]) ? array_column($_SESSION['data']->languages, 'id')[$key] : 0);
                        $languages[$key]['id_language'] = Utils::sanitizeNumber($_POST['language'][$key]);
                        $languages[$key]['language'] = isset($_POST['language'][$key]) ? Utils::showLanguageById($_POST['language'][$key])->language : '';
                        $languages[$key]['level'] = Utils::sanitizeNumber(@$_POST['language_level'][$key]);
                        $languages[$key]['language_level'] = isset($_POST['language_level'][$key]) ? Utils::showLanguageLevelById($_POST['language_level'][$key])->language_level : '';
                        $languages[$key]['institution'] = Utils::sanitizeStringBlank(@$_POST['language_institution'][$key]);
                        $languages[$key]['start_date'] = Utils::sanitizeStringBlank(@$_POST['language_start_date'][$key]);
                        $languages[$key]['end_date'] = Utils::sanitizeStringBlank(@$_POST['language_end_date'][$key]);

                        $candidateLanguage = new CandidateLanguage();
                        $candidateLanguage->setId_language($languages[$key]['id_language']);
                        $candidateLanguage->setLevel($languages[$key]['level']);
                        $candidateLanguage->setInstitution($languages[$key]['institution']);
                        $candidateLanguage->setStart_date($languages[$key]['start_date']);
                        $candidateLanguage->setEnd_date($languages[$key]['end_date']);
                        $candidateLanguage->setId_candidate($id);

                        if ($languages[$key]['id'] == 0 && !isset(array_column($_SESSION['data']->languages, 'id')[$key]) && !in_array($languages[$key]['item'], array_column($_SESSION['data']->languages, 'language_id'))) {
                            $candidateLanguage->save();
                            $languages[$key]['id_language'] = $candidateLanguage->getId();
                        }else {
                            if (($languages[$key]['id_language'] != $_SESSION['data']->languages[$key]['id_language']) || ($languages[$key]['level'] != $_SESSION['data']->languages[$key]['level']) || ($languages[$key]['institution'] != $_SESSION['data']->languages[$key]['institution']) || ($languages[$key]['start_date'] != $_SESSION['data']->languages[$key]['start_date']) || ($languages[$key]['end_date'] != $_SESSION['data']->languages[$key]['end_date'])) {
                                $candidateLanguage->setId($languages[$key]['id']);
                                $candidateLanguage->update();
                            }
                        }    
                    }
                }
            }

            $aptitudes = [];
            if (isset($_POST['aptitude'])) {
                foreach ($_POST['aptitude'] as $key => $value) {
                    if ($_POST['aptitude'][$key]) {
                        $aptitudes[$key]['item']  = isset($_POST['aptitude_id'][$key]) ? Utils::sanitizeNumber($_POST['aptitude_id'][$key]): 0;
                        $aptitudes[$key]['id'] = isset($_POST['id_aptitude'][$key]) ? Utils::sanitizeNumber($_POST['id_aptitude'][$key]) : (isset(array_column($_SESSION['data']->aptitudes, 'id_aptitude')[$key]) ? array_column($_SESSION['data']->aptitudes, 'id_aptitude')[$key] : 0);
                        $aptitudes[$key]['aptitude'] = Utils::sanitizeStringBlank($_POST['aptitude'][$key]);
                        $aptitudes[$key]['level'] = Utils::sanitizeNumber(@$_POST['aptitude_level'][$key]);

                        $candidateAptitude = new CandidateAptitude();
                        $candidateAptitude->setAptitude($aptitudes[$key]['aptitude']);
                        $candidateAptitude->setLevel($aptitudes[$key]['level']);
                        $candidateAptitude->setId_candidate($id);

                        if ($aptitudes[$key]['id'] == 0 && !isset(array_column($_SESSION['data']->aptitudes, 'id_aptitude')[$key]) && !in_array($aptitudes[$key]['item'], array_column($_SESSION['data']->aptitudes, 'aptitude_id'))) {
                            $candidateAptitude->save();
                            $aptitudes[$key]['id'] = $candidateAptitude->getId();
                        }else {
                            if (($aptitudes[$key]['aptitude'] != $_SESSION['data']->aptitudes[$key]['aptitude']) || ($aptitudes[$key]['level'] != $_SESSION['data']->aptitudes[$key]['level'])) {
                                $candidateAptitude->setId($aptitudes[$key]['id']);
                                $candidateAptitude->update();
                            }
                        }
                    }
                        
                }
            }

			$template = isset($_SESSION['data']->template) ? $_SESSION['data']->template : 'Resume';
            $candidato = [];
            $candidato = 
                    (object) array(
                        'id' => $_SESSION['data']->id,
                        'first_name' => $first_name,
                        'surname' => $surname,
                        'last_name' => $last_name,
                        'date_birth' => $date_birth,
                        'job_title' => $job_title,
                        'description' => $description,
                        'telephone' => $telephone,
                        'cellphone' => $cellphone,
                        'email' => $email,
                        'state' => @Utils::showStateById($id_state)->state,
                        'city' => @Utils::showCityById($id_city)->city,
                        'id_state' => @$id_state,
                        'id_city' => @$id_city,
                        'id_area' => $id_area,
                        'id_subarea' => $id_subarea,
                    	'template' => $template,
                        'education' => (object) 
                            array(
                                'id_level' => $education_level,
                                'level' => Utils::showEducationById($education_level)->level,
                                'institution'=> $education_institution,
                                'title' => $education_title ,
                                'start_date' => $education_start_date,
                                'end_date'=>$education_end_date,
                                'still_studies'=>$education_still_studies
                            ),
                        'experiences' => $experiences,
                        'preparations' => $preparations,
                        'languages' => $languages,
                        'aptitudes' => $aptitudes
                    );
            
            $_SESSION['data'] = $candidato;
            $route = isset($_SESSION['route']) && !empty($_SESSION['route']) ? Utils::getImage($_SESSION['route'])[0] : "dist/img/user-icon.png";
            $apt_lang = array_merge($preparations, $languages);            
            
            $pdf = new Resume("P", "pt", "Letter");
            require('./libraries/fpdf/makefont/makefont.php');
            $pdf->AddFont('SinkinSansLight','', 'SinkinSans-300Light.php');
            $pdf->AddFont('SinkinSans','', 'SinkinSans-400Regular.php');
            $pdf->AddFont('SinkinSans','I', 'SinkinSans-400Italic.php');
            $pdf->AddFont('SinkinSans','B', 'SinkinSans-700Bold.php');
            $pdf->AddFont('SinkinSans','BI', 'SinkinSans-700BoldItalic.php');
            $pdf->AddFont('IBMPlexSans-Regular', '', 'IBMPlexSans-Regular.php');
            $pdf->AddFont('IBMPlexSans-Light', '', 'IBMPlexSans-Light.php');
            $pdf->AddFont('IBMPlexSans-Bold', 'B', 'IBMPlexSans-Bold.php');
            $pdf->AddFont('IBMPlexSans-Italic', 'I', 'IBMPlexSans-Italic.php');
            $pdf->AddFont('IBMPlexSans-BoldItalic', 'BI', 'IBMPlexSans-BoldItalic.php');
            $pdf->AddFont('NotoSans-Regular','', 'NotoSans-Regular.php');
            $pdf->AddFont('NotoSans-Light','', 'NotoSans-Light.php');
            $pdf->AddFont('NotoSans-Bold','B', 'NotoSans-Bold.php');
            $pdf->AddFont('NotoSans-Italic','I', 'NotoSans-Italic.php');
            $pdf->AddFont('NotoSans-BoldItalic','BI', 'NotoSans-BoldItalic.php');
            $pdf->AddFont('Lato-Regular','', 'Lato-Regular.php');
            $pdf->AddFont('Lato-Light','', 'Lato-Light.php');
            $pdf->AddFont('Lato-Bold','B', 'Lato-Bold.php');
            $pdf->AddFont('Lato-Italic','I', 'Lato-Italic.php');
            $pdf->AddFont('Lato-BoldItalic','BI', 'Lato-BoldItalic.php');
			$pdf->SetTitle("CV_".$candidato->first_name.'_'.$candidato->surname, true);
			$pdf->SetFont('Times');
			$pdf->SetMargins(0, 55, 0, 0);
            $pdf->AddPage();
			$pdf->SetAbout($candidato, $route);
            $pdf->SetExperience($experiences);
            $pdf->SetEducation($candidato->education, $apt_lang);
            $pdf->setAdditionalPreparation($preparations);
            $pdf->setLanguages($languages);
            $pdf->SetAptitude($aptitudes);
            $pdfData = $pdf->Output('S');
            echo base64_encode($pdfData);
		}else{
			header("location:".base_url);
		}
	}

    public function selectTemplate() {
        if (isset($_POST) && isset($_SESSION['data'])) {
            $template = isset($_POST['template']) ? $_POST['template'] : 'Resume';
            $_SESSION['data']->template = $template;
        }
    }
	
}