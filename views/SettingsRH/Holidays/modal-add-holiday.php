<div class="modal fade" id="modal-add-holiday">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" id="add-holiday-form" name="formulario">
                <div class="modal-header">
                    <h5 class="modal-title" id="title"> Agregar nuevo Dia Festivo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input type="hidden" class="form-control" name="id_holiday" id="id_holiday">
                <input type="hidden" class="form-control" name="id_template" id="id_template" required>

                <div class="modal-body">
                    <label>Ingrese el nombre del dia festivo:</label>
                    <div class="input-group mb-3">
                        <input placeholder='Nombre de la plantilla' type="text" class="form-control" name="name" id="name" autocomplete="off" required>
                    </div>

                    <!-- <label>Ingrese la fecha del nuevo dia festivo:</label>
                    <div class="input-group mb-3">
                        <input type="date" class="form-control" name="holiday" id="holiday" autocomplete="off" required>
                    </div> -->



                    <div class="input-group mb-3">
                        <div class="col-md-6">
                            <label>Elija un dia:</label>
                            <select id="daySelect" name="day" class="form-control">
                                <?php for ($i = 1; $i < 32; $i++) :   ?>
                                    <option value="<?= $i ?>"><?= $i ?></option>
                                <?php endfor   ?>

                                <!-- Agrega más opciones para los días -->
                            </select>

                        </div>

                        <div class="col-md-6">
                            <label>Elija un mes:</label>
                            <select id="monthList" class="form-control" name="month">
                                <option value="1">Enero</option>
                                <option value="2">Febrero</option>
                                <option value="3">Marzo</option>
                                <option value="4">Abril</option>
                                <option value="5">Mayo</option>
                                <option value="6">Junio</option>
                                <option value="7">Julio</option>
                                <option value="8">Agosto</option>
                                <option value="9">Septiembre</option>
                                <option value="10">Octubre</option>
                                <option value="11">Noviembre</option>
                                <option value="12">Diciembre</option>
                            </select>
                        </div>




                    </div>



                    <div class="modal-footer">
                        <button id="guardar" name="guardar" type="submit" class="btn btn-primary">Guardar
                        </button>
                        <button id='close' type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?= base_url ?>app/RH/modulerh.js?v=<?= rand() ?>"></script>
<script>
    document.querySelector('#add-holiday-form').addEventListener('submit', e => {
        e.preventDefault();

        var modulerh = new ModuleRH();
        modulerh.save_holiday();

    });

    const daySelec = document.getElementById("daySelect");

    daySelec.addEventListener("change", updateMonths);


    function updateMonths() {
        const daySelect = document.getElementById("daySelect");
        const monthList = document.getElementById("monthList");
        // Obtiene el día seleccionado
        const selectedDay = parseInt(daySelect.value);

        const monthsWithSelectedDay = [];

        // Array de objetos que contiene los nombres de los meses y la cantidad de días en cada mes
        const months = [{
                name: "Enero",
                days: 31,
                id: 1
            },
            {
                name: "Febrero",
                days: 28,
                id: 2
            },
            {
                name: "Marzo",
                days: 31,
                id: 3
            },
            {
                name: "Abril",
                days: 30,
                id: 4
            },
            {
                name: "Mayo",
                days: 31,
                id: 5
            },
            {
                name: "Junio",
                days: 30,
                id: 6
            },
            {
                name: "Julio",
                days: 31,
                id: 7
            },
            {
                name: "Agosto",
                days: 31,
                id: 8
            },
            {
                name: "Septiembre",
                days: 30,
                id: 9
            },
            {
                name: "Octubre",
                days: 31,
                id: 10
            },
            {
                name: "Noviembre",
                days: 30,
                id: 11
            },
            {
                name: "Diciembre",
                days: 31,
                id: 12
            }
        ];

        // Encuentra los meses que tienen el día seleccionado
        for (let i = 0; i < months.length; i++) {
            if (selectedDay <= months[i].days) {
                monthsWithSelectedDay.push(months[i].name + ":" + months[i].id);


            }
        }

        // Limpia el select de meses
        monthList.innerHTML = "";

        // Agrega las opciones de los meses que tienen el día seleccionado
        if (monthsWithSelectedDay.length > 0) {


            monthList.disabled = false;
            for (const info of monthsWithSelectedDay) {

                var informacion = info.split(":");
                var month = informacion[0];
                var id = informacion[1];

                const option = document.createElement("option");
                option.text = month;
                option.value = id;
                monthList.add(option);
            }


        } else {
            monthList.disabled = true;
            const option = document.createElement("option");
            option.text = "No hay meses con este día";
            monthList.add(option);
        }
    }
</script>