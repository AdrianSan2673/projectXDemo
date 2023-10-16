class GroupEvaluation {
    //===[gabo 27 julio excel]===
    showDates(id_evaluation) {

        const data = new FormData();
        data.append('id_evaluation', id_evaluation);
        fetch('../EvaluacionEmpleado/getDatesGroupsEvaluation', {
                method: 'POST',
                body: data
            })
            .then(function (response) {
                //   console.log(response.json);
                if (response.ok) {
                    return response.json();
                } else {
                    throw "Error en la llamada Ajax";
                }
            })

            .then(function (json_app) {
                if (json_app.status == 1) {

                    $("#fechas").val("");
                    $('#fechas').trigger('change');

                    let groups = json_app.groups;
                    $("#fechas").find('option').remove();
                    groups.forEach((element) => {

                        $("#fechas").append($('<option>').val(element['start_date_noformat'] + ":" + element['end_date_noformat']).text(element['start_date'] + " al " + element['end_date']));
                    });


                } else if (json_app.status == 0) {
                    utils.showToast(' No se pudo consultar la informacion', 'error');
                }

            })
            .catch(function (err) {
                console.log(err);
            });


    }

    //===[gabo 27 julio excel]===

}