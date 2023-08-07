<?php
require_once 'libraries/fpdf/fpdf.php';
require_once 'helpers/Resume.php';
require_once 'helpers/FormatosCV/CVoperativo.php';
require_once 'models/Candidate.php';
require_once 'models/CandidateExperience.php';
require_once 'models/CandidateAptitude.php';
require_once 'models/CandidateLanguage.php';
require_once 'models/CandidateAdditionalPreparation.php';
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
	
}