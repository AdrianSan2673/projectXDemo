<div class="modal fade" id="modal_ubicacion">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Ubicación</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Folio">
                    <input type="hidden" name="flag_ubicacion">
                    <input type="hidden" name="flag_vivienda">
                    <div class="form-group">
                        <label class="col-form-label" for="Tiempo_Viviendo">Tiempo de vivir en el domicilio</label>
                        <input type="text" class="form-control" name="Tiempo_Viviendo" maxlength="50">
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label class="col-form-label" for="Calle">Calle</label>
                            <input type="text" name="Calle" class="form-control" maxlength="100" required>
                        </div>
                        <div class="form-group col">
                            <label class="col-form-label" for="Exterior">Número</label>
                            <input type="text" name="Exterior" class="form-control" maxlength="15" required>
                        </div>
                        <div class="form-group col">
                            <label class="col-form-label" for="Interior">Interior</label>
                            <input type="text" name="Interior" class="form-control" maxlength="15" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label class="col-form-label" for="Colonia">Colonia</label>
                            <input type="text" name="Colonia" class="form-control" maxlength="100" required>
                        </div>
                        <div class="form-group col">
                            <label class="col-form-label" for="Entre_Calles">Entre</label>
                            <input type="text" name="Entre_Calles" class="form-control" maxlength="100">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label class="col-form-label" for="Municipio">Delegación o municipio</label>
                            <input type="text" name="Municipio" class="form-control" maxlength="100" required>
                        </div>
                        <div class="form-group col">
                            <label class="col-form-label" for="Estado">Estado</label>
                            <select class="form-control" name="Estado" required>
                                <?= $pais = ['', 'México', 'Guatemala'] ?>
                          <?php for ($i = 1; $i < count($pais); $i++) : ?>
                            <optgroup label="<?= $pais[$i] ?>">
                              <?php $estados = Utils::showEstadosPorPais($i) ?>
                              <?php foreach ($estados as $e) : ?>
                                <option value="<?= $e['Estado'] ?>"><?= $e['Descripcion'] ?></option>
                              <?php endforeach ?>
                            </optgroup>
                          <?php endfor; ?>
                            </select>
                        </div>
                        <div class="form-group col">
                            <label class="col-form-label" for="Codigo_Postal">CP</label>
                            <input type="text" name="Codigo_Postal" class="form-control" maxlength="5">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Fachada">Color y descripción de la fachada</label>
                        <input type="text" name="Fachada" class="form-control" maxlength="200" required >
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Tipo_Vivienda">Tipo de vivienda</label>
                        <select class="form-control" name="Tipo_Vivienda">
                            <option value="0">No asignado</option>
                            <?php $tipos = Utils::showTiposVivienda(); ?>
                            <?php foreach ($tipos as $t): ?>
                                <option value="<?=$t['Campo'] ?>"><?=$t['Descripcion'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label class="col-form-label" for="Plantas">No. de plantas o niveles</label>
                            <input type="number" name="Plantas" class="form-control" min="0">
                        </div>
                        <div class="form-group col">
                            <label class="col-form-label" for="Sanitarios">No. de baños</label>
                            <input type="number" name="Sanitarios" class="form-control" min="0">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label class="col-form-label" for="Recamaras">No. de recámaras</label>
                            <input type="number" name="Recamaras" class="form-control" min="0">
                        </div>
                        <div class="form-group col">
                            <label class="col-form-label" for="Capacidad_Cochera">Capacidad de autos en cochera</label>
                            <input type="number" name="Capacidad_Cochera" class="form-control" min="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Domicilio_es">El domicilio donde vive es</label>
                        <select class="form-control" name="Domicilio_es">
                            <option value="0">No asignado</option>
                            <?php $domicilio_es = Utils::showEstatusDomicilio() ?>
                            <?php foreach ($domicilio_es as $d): ?>
                                <option value="<?=$d['Campo']?>"><?=$d['Descripcion']?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Propietario">En caso de no ser propio, nombre del propietario</label>
                        <input type="text" name="Propietario" class="form-control" maxlength="50">
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label class="col-form-label" for="Parentesco">Parentesco</label>
                            <input type="text" name="Parentesco" class="form-control" maxlength="50" >
                        </div>
                        <div class="form-group col">
                            <label class="col-form-label" for="Telefono_Parentesco">Teléfono</label>
                            <input type="text" name="Telefono_Parentesco" class="form-control" maxlength="50">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label class="col-form-label" for="Contrato_Arrendamiento">En caso de arrendamiento, ¿cuenta con el contrato?</label>
                            <select class="form-control" name="Contrato_Arrendamiento">
                                <option value="No">No</option>
                                <option value="Si">Sí</option>
                            </select>
                        </div>
                        <div class="form-group col">
                            <label class="col-form-label" for="Tiempo_Contrato">Tiempo del contrato</label>
                            <input type="text" name="Tiempo_Contrato" class="form-control" maxlength="10">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Comentarios">Comentarios</label>
                        <textarea class="form-control" name="Comentarios" rows="6" maxlength="500"  ></textarea>
                    </div>
                    <br>
                    <div class="form-group">
                        <label class="col-form-label" for="Maps">Enlace Google Maps</label>
                        <input type="url" name="Maps" class="form-control" maxlength="500">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" class="btn btn-orange" value="Guardar">
                </div>
            </form>
        </div>
    </div>              
</div>


<div class="modal fade" id="modal_localizacion">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Localización</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Folio">
                    <input type="hidden" name="flag_ubicacion">
                    <div class="form-group">
                        <label class="col-form-label" for="Municipio">Delegación o municipio</label>
                        <input type="text" name="Municipio" class="form-control" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Estado">Estado</label>
                        <select class="form-control" name="Estado">
                          <?= $pais = ['', 'México', 'Guatemala'] ?>
                          <?php for ($i = 1; $i < count($pais); $i++) : ?>
                            <optgroup label="<?= $pais[$i] ?>">
                              <?php $estados = Utils::showEstadosPorPais($i) ?>
                              <?php foreach ($estados as $e) : ?>
                                <option value="<?= $e['Estado'] ?>"><?= $e['Descripcion'] ?></option>
                              <?php endforeach ?>
                            </optgroup>
                          <?php endfor; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" class="btn btn-orange" value="Guardar">
                </div>
            </form>
        </div>
    </div>              
</div>


<script>
     document.querySelector('#modal_ubicacion [name="Domicilio_es"]').addEventListener('change', function(e) {
        if (document.querySelector('#modal_ubicacion [name="Domicilio_es"]').value == "161"){
        document.querySelector('#modal_ubicacion [name="Tiempo_Contrato"]').required=true
		}
        else{
        document.querySelector('#modal_ubicacion [name="Tiempo_Contrato"]').required=false
		}
    })
</script>