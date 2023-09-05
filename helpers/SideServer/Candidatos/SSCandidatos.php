<?php
// $candidate = new Candidate();
// $candidates = $candidate->getCandidatesByKey('', '', '');

$_GET['filtros'] .= ($_GET['id_language'] != '') ? "and id_language like " . "'%" . $_GET['id_language'] . "%'" : '';
$extrawhere = substr($_GET['filtros'], 3);
$tabla = "rrhhinge_Candidatos.filtros_candidatos fc";


if ($_GET['clave'] != '') {
    $extrawhere = " ( first_name LIKE " . "'%" . $_GET['clave'] . "%' OR age LIKE " . "'%" . $_GET['clave'] . "%' OR city LIKE " . "'%" . $_GET['clave'] . "%' OR state LIKE " . "'%" . $_GET['clave'] . "%' OR level LIKE " . "'%" . $_GET['clave'] . "%' OR job_title LIKE " . "'%" . $_GET['clave'] . "%' OR language LIKE " . "'%" . $_GET['clave'] . "%' OR area LIKE " . "'%" . $_GET['clave'] . "%' OR subarea LIKE " . "'%" . $_GET['clave'] . "%' OR description LIKE " . "'%" . $_GET['clave'] . "%' OR experiences LIKE " . "'%" . $_GET['clave'] . "%' OR aptitudes LIKE " . "'%" . $_GET['clave'] . "%' OR created_at LIKE " . "'%" . $_GET['clave'] . "%' OR created_by LIKE " . "'%" . $_GET['clave'] . "%')";
}




$primaryKey = 'id';
$columns = array(

    array('db' => 'first_name',  'dt' => 1),
    array('db' => 'age',  'dt' => 2),
    array('db' => 'city',  'dt' => 3),
    array('db' => 'state',  'dt' => 4),
    array('db' => 'level',  'dt' => 5),
    array('db' => 'job_title',  'dt' => 6),
    array('db' => 'language',  'dt' => 7),
    array('db' => 'area',  'dt' => 8),
    array('db' => 'subarea',  'dt' => 9),
    array('db' => 'description',  'dt' => 10),
    array('db' => 'experiences',  'dt' => 11),
    array('db' => 'aptitudes',  'dt' => 12),
    array('db' => 'created_at',  'dt' => 13),
    array('db' => 'created_by',  'dt' => 14),
    array('db' => 'id',  'dt' => 15),
    array('db' => 'id_gender',  'dt' => 16),
    array('db' => 'surname',  'dt' => 18),
    array('db' => 'last_name',  'dt' => 19),
    array('db' => 'id_language',  'dt' => 20),
    // array('db' => 'first_name',  'dt' => 11),
    // array('db' => 'first_name',  'dt' => 12),
    // array('db' => 'first_name',  'dt' => 13)

);


// $sql_details = array(
//     'user' => '',
//     'pass' => '',
//     'db'   => 'reclutamiento3',
//     'host' => 'localhost'
// );

$sql_details = array(
    'user' => 'reclutador',
    'pass' => 'Sr65s$0z',
    'db'   => 'reclutamiento',
    'host' => '148.72.144.152'
);

$botones = 1;

require("ssp.php");
require("../../Encryption.php");
require("../../../config/Connection.php");
require("../../../config/Parameters.php");
require("../../../models/Candidate.php");
require("../../../helpers/utils.php");


$extraFields = '';
//si la busqueda viene del datatable input
$_GET['search']['value'] != "" ? $extrawhere = '' : '';

//si la tabla es postulate ocupamos 2 atributos extra
if (isset($_GET['id_vacancy'])) {
    $_GET['id_vacancy'] = Encryption::decode($_GET['id_vacancy']);
    $extraFields = " ,(SELECT top (1) id_status FROM vacancy_applicants va WHERE va.id_candidate=fc.id AND va.id_vacancy=" . $_GET['id_vacancy'] . ") AS id_status, (SELECT top (1) vas.status FROM vacancy_applicants va LEFT JOIN vacancy_applicant_status vas ON va.id_status=vas.id WHERE va.id_candidate=fc.id AND va.id_vacancy=" . $_GET['id_vacancy'] . ") AS status";
}

echo json_encode(
    SSP::simple($_GET, $sql_details,  $tabla, $primaryKey, $columns, $botones, $extrawhere, $extraFields)
);
