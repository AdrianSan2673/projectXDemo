<div class="content-wrapper">
    
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 mt-3">
               <div class="card bg-light card-primary card-outline">
                  <div class="card-body box-profile">
                    <p id="folio" style="display: <?=Utils::isAdmin() ? 'block' : 'none'?>;"><?=$folio?></p>
                       <div id="info-servicio">
                          <div class="d-flex justify-content-center mt-5 mb-5">
                            <div class="spinner-border" role="status">
                              <span class="sr-only">Loading...</span>
                            </div>
                          </div>
                       </div>  
                  </div>
               </div>
            </div>
            <div class="col-md-9 mt-3">
              <div class="card bg-light card-tabs">
                <div class="card-header p-0 pt-1">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item" id="nav-vlf" style="display: none;"><a class="nav-link" href="#vlf" data-toggle="tab">Validación de Licencia Federal</a></li>
                    <li class="nav-item" style="display: <?=!Utils::isLogistics() ? 'display' : 'none'?>;"><a class="nav-link" href="#ral" data-toggle="tab">Registro de Antecedentes Legales</a></li>
                    <li class="nav-item" style="display: <?=!Utils::isLogistics() ? 'display' : 'none'?>;"><a class="nav-link" href="#investigacion" data-toggle="tab">Investigación Laboral</a></li>
                    <li class="nav-item"><a class="nav-link" href="#estudio" data-toggle="tab">Estudio Socioeconómico</a></li>
                  </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content">
                    <div class="tab-pane" id="vlf">
                      <div class="row">
                        <div class="col-5 col-sm-3 mt-3">
                          <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="vert-tabs-licencia-tab" data-toggle="pill" href="#vert-tabs-licencia" role="tab" aria-controls="vert-tabs-licencia" aria-selected="true">Licencia</a>
                            <a class="nav-link" id="vert-tabs-examen_medico-tab" data-toggle="pill" href="#vert-tabs-examen_medico" role="tab" aria-controls="vert-tabs-examen_medico" aria-selected="false">Exámen Médico</a>
                            <a class="nav-link" id="vert-tabs-resultado_licencia-tab" data-toggle="pill" href="#vert-tabs-resultado_licencia" role="tab" aria-controls="vert-tabs-resultado_licencia" aria-selected="false">Resultado</a>
                          </div>
                        </div>
                        <div class="col-7 col-sm-9">
                          <div class="tab-content" id="vert-tabs-tabContent">
                            <div class="tab-pane text-left fade show active" id="vert-tabs-licencia" role="tabpanel" aria-labellelicenciadby="vert-tabs-licencia-tab">
                              <div id="content-licencia">
                                <div class="d-flex justify-content-center mt-5 mb-5">
                                  <div class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-examen_medico" role="tabpanel" aria-labelledby="vert-tabs-examen_medico-tab">
                              <div id="content-examen_medico">
                                <div class="d-flex justify-content-center mt-5 mb-5">
                                  <div class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-resultado_licencia" role="tabpanel" aria-labelledby="vert-tabs-resultado_licencia-tab">
                              <div id="content-resultado_licencia">
                                <div class="d-flex justify-content-center mt-5 mb-5">
                                  <div class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                  </div>
                                </div>
                              </div>
                          </div>
                          </div>
                        </div>
                      </div>                        
                    </div>
                    <div class="tab-pane" id="ral">
                      <div class="row">
                        <div class="col-5 col-sm-3 col-md-2 mt-3">
                          <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link <?=Utils::getDisplayBotones()['Account'] == 'block' ? 'active' : ''?>" id="vert-tabs-busqueda_ral-tab" data-toggle="pill" href="#vert-tabs-busqueda_ral" role="tab" aria-controls="vert-tabs-busqueda_ral" aria-selected="true" style="display: block">Búsqueda de RAL</a>
                            <a class="nav-link" id="vert-tabs-propio_ral-tab" data-toggle="pill" href="#vert-tabs-propio_ral" role="tab" aria-controls="vert-tabs-busqueda_ral" aria-selected="true" style="display: <?=Utils::getDisplayBotones()['Account']?>;">RAL Propio</a>
                            <a class="nav-link <?=Utils::getDisplayBotones()['Account'] != 'block' ? 'active' : ''?>" id="vert-tabs-acerca_ral-tab" data-toggle="pill" href="#vert-tabs-acerca_ral" role="tab" aria-controls="vert-tabs-acerca_ral" aria-selected="true">Acerca del RAL</a>
                            <a class="nav-link" id="vert-tabs-capturas_ral-tab" data-toggle="pill" href="#vert-tabs-capturas_ral" role="tab" aria-controls="vert-tabs-capturas_ral" aria-selected="false">Capturas del RAL</a>
                            <a class="nav-link" id="vert-tabs-comentarios_ral-tab" data-toggle="pill" href="#vert-tabs-comentarios_ral" role="tab" aria-controls="vert-tabs-comentarios_ral" aria-selected="true" style="display: <?=Utils::getDisplayBotones()['Account']?>;">Comentarios de RAL</a>
                          </div>
                        </div>
                        <div class="col-7 col-sm-9 col-md-10">
                          <div class="tab-content" id="vert-tabs-tabContent">
                            <div class="tab-pane fade <?=Utils::getDisplayBotones()['Account'] == 'block' ? 'show active' : ''?>" id="vert-tabs-busqueda_ral" role="tabpanel" aria-labelledby="vert-tabs-busqueda_ral-tab">
                              <div id="content-busqueda_ral">
                                <div class="d-flex justify-content-center mt-5 mb-5">
                                  <div class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                  </div>
                                </div>
                              </div>
                              <hr>
                              <div id="content-expedientes_ral" id="accordion"></div>
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-propio_ral" role="tabpanel" aria-labelledby="vert-tabs-propio_ral-tab">
                              <div id="content-propio_ral" style="display: <?=Utils::getDisplayBotones()['Account']?>;">
                                <div class="d-flex justify-content-center mt-5 mb-5">
                                  <div class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                  </div>
                                </div>
                              </div>
                              <hr>
                              <div id="content-expedientes_propio_ral"></div>
                            </div>
                            <div class="tab-pane fade <?=Utils::getDisplayBotones()['Account'] != 'block' ? 'show active' : ''?>" id="vert-tabs-acerca_ral" role="tabpanel" aria-labelledby="vert-tabs-acerca_ral-tab">
                              <div id="content-ral">
                                <div class="d-flex justify-content-center mt-5 mb-5">
                                  <div class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-capturas_ral" role="tabpanel" aria-labelledby="vert-tabs-capturas_ral-tab">
                              <div class="form-group mb-3">
                                <label class="col-form-label">Agregar captura</label>
                                <input type="file" class="btn btn-success" id="btn-image-ral" style="display: <?=Utils::getDisplayBotones()['Account']?>" accept="image/x-png,image/gif,image/jpeg">
                              </div>
                              <table class="table table-sm">
                                <thead>
                                  <tr>
                                    <th>#</th>
                                    <th>Archivo</th>
                                    <th></th>
                                  </tr>
                                </thead>
                                <tbody id="content-capturas_ral"></tbody>
                              </table>
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-comentarios_ral" role="tabpanel" aria-labelledby="vert-tabs-comentarios_ral-tab">
                              <button class="btn btn-info btn-lg float-right mb-3" style="display: <?=Utils::getDisplayBotones()['Account']?>;"><i class="fas fa-pencil-alt"></i></button>
                              <div id="content-comentarios_ral">
                                <div class="d-flex justify-content-center mt-5 mb-5">
                                  <div class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>                        
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="investigacion">
                      <div class="row">
                        <div class="col-5 col-sm-3 col-md-2 mt-3">
                          <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home" aria-selected="true">Datos personales</a>
                            <a class="nav-link" id="vert-tabs-home2-tab" data-toggle="pill" href="#vert-tabs-home2" role="tab" aria-controls="vert-tabs-home2" aria-selected="false">Datos de contacto</a>
                            <a class="nav-link" id="vert-tabs-escolaridad-tab" data-toggle="pill" href="#vert-tabs-escolaridad" role="tab" aria-controls="vert-tabs-escolaridad" aria-selected="false">Escolaridad</a>
                            <a class="nav-link" id="vert-tabs-cohabitantes-tab" data-toggle="pill" href="#vert-tabs-cohabitantes" role="tab" aria-controls="vert-tabs-cohabitantes" aria-selected="false">Cohabitantes</a>
                            <a class="nav-link" id="vert-tabs-referenciass-tab" data-toggle="pill" href="#vert-tabs-referenciass" role="tab" aria-controls="vert-tabs-referenciass" aria-selected="false">Referencias</a>
                            <a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill" href="#vert-tabs-profile" role="tab" aria-controls="vert-tabs-profile" aria-selected="false">Referencias laborales</a>
                            <a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill" href="#vert-tabs-messages" role="tab" aria-controls="vert-tabs-messages" aria-selected="false">Documentos</a>
                            <a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill" href="#vert-tabs-settings" role="tab" aria-controls="vert-tabs-settings" aria-selected="false">Preguntas</a>
                            <a class="nav-link" id="vert-tabs-google-search-tab" data-toggle="pill" href="#vert-tabs-google-search" role="tab" aria-controls="vert-tabs-google-search" aria-selected="false" style="display: block;">Búsqueda Google</a>
                            <a class="nav-link" id="vert-tabs-comentarios_generales_inv-tab" data-toggle="pill" href="#vert-tabs-comentarios_generales_inv" role="tab" aria-controls="vert-tabs-comentarios_generales_inv" aria-selected="false">Comentarios generales</a>
                          </div>
                        </div>
                        <div class="col-7 col-sm-9 col-md-10">
                          <div class="form-group row" style="display: none;">
                            <label class="col col-form-label">Tipo de investigación</label>
                            <div class="col" style="display: <?=Utils::getDisplayBotones()['Account']?>;">
                              <select class="form-control" id="Tipo_Investigacion">
                                <option value="1">Ordinaria</option>
                                <option value="2">Completa</option>
                              </select>
                            </div>
                          </div>
                          <div class="tab-content" id="vert-tabs-tabContent">
                            <div class="tab-pane text-left fade show active" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                              <button class="btn btn-info btn-lg float-right mb-3" style="display: <?=Utils::getDisplayBotones()['SA']?>;"><i class="fas fa-pencil-alt"></i></button>
                              <div class="content-datos_generales">
                                <div class="d-flex justify-content-center mt-5 mb-5">
                                  <div class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                  </div>
                                </div>
                              </div>                              
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-home2" role="tabpanel" aria-labelledby="vert-tabs-home2-tab">
                              <button class="btn btn-info btn-lg float-right mb-3" style="display: <?=Utils::getDisplayBotones()['SA']?>;"><i class="fas fa-pencil-alt"></i></button>
                              <div class="content-contacto">
                                <div class="d-flex justify-content-center mt-5 mb-5">
                                  <div class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-escolaridad" role="tabpanel" aria-labelledby="vert-tabs-escolaridad-tab">
                              <button class="btn btn-info btn-lg float-right mb-3" style="display: <?=Utils::getDisplayBotones()['SA']?>;"><i class="fas fa-pencil-alt"></i></button>
                              <div class="content-escolaridad">
                                <div class="d-flex justify-content-center mt-5 mb-5">
                                  <div class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-cohabitantes" role="tabpanel" aria-labelledby="vert-tabs-cohabitantes-tab">
                              <button class="btn btn-success" style="display: <?=Utils::getDisplayBotones()['SA']?>;"><i class="fas fa-plus mr-1"></i> Agregar</button><br>
                              <div class="table table-responsive mt-3">
                                <table class="table table-sm text-nowrap">
                                  <thead>
                                    <tr>
                                      <th>Nombre</th>
                                      <th>Parentesco</th>
                                      <th>Edad</th>
                                      <th style="display: none;">Estado civil</th>
                                      <th>Ocupación</th>
                                      <th>Empresa</th>
                                      <th>¿Es dependiente económico?</th>
                                      <th style="display: none;">Teléfono</th>
                                      <th></th>
                                    </tr>
                                  </thead>
                                  <tbody class="content-cohabitantes"></tbody>
                                </table>
                              </div>
                              <button class="btn btn-info btn-sm float-right"><i class="fas fa-pencil-alt" style="display: <?=Utils::getDisplayBotones()['SA']?>;"></i></button>
                              <b>Comentarios</b>
                              <p></p>
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-referenciass" role="tabpanel" aria-labelledby="vert-tabs-referenciass-tab">
                              <button class="btn btn-success mb-5" style="display: <?=Utils::getDisplayBotones()['SA']?>;"><i class="fas fa-plus mr-1"></i> Agregar referencia</button>
                              <div class="content-referencias">
                                <div class="d-flex justify-content-center mt-5 mb-5">
                                  <div class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
                              <button class="btn btn-success btn-sm mb-3" id="btn-nueva_laboral" style="display: <?=Utils::getDisplayBotones()['SA']?>;"><i class="fas fa-plus mr-1"></i>Nuevo</button>
                              <div id="content-referencias_laborales" class="<?= $folio ?>">
                                <div class="d-flex justify-content-center mt-5 mb-5">
                                  <div class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-messages" role="tabpanel" aria-labelledby="vert-tabs-messages-tab">
                              <div class="form-group mb-3">
                                <label class="col-form-label">Agregar documento</label>
                                <input type="file" class="btn btn-success" style="display: <?=Utils::getDisplayBotones()['SA']?>" accept="image/x-png,image/gif,image/jpeg">
                              </div>
                              <div class="table-responsive">
                                <table class="table table-sm text-nowrap">
                                  <thead>
                                    <tr>
                                      <th>Documento</th>
                                      <th></th>
                                    </tr>
                                  </thead>
                                  <tbody class="content-documentos"></tbody>
                                </table>
                              </div>
                              <hr>
                              <button class="btn btn-info btn-sm float-right" style="display: <?=Utils::getDisplayBotones()['SA']?>;"><i class="fas fa-pencil-alt"></i></button>
                              <b>Comentarios de la documentación</b>
                              <p></p>
                              <hr>
                              <b hidden>Comentario de redes sociales</b>
                              <p hidden></p>
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-settings" role="tabpanel" aria-labelledby="vert-tabs-settings-tab">
                              <div id="content-investigacion">
                                <div class="d-flex justify-content-center mt-5 mb-5">
                                  <div class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-google-search" role="tabpanel" aria-labelledby="vert-tabs-google-search-tab">
                              <div class="form-group mb-3">
                                <label class="col-form-label">Agregar búsqueda de google</label>
                                <input type="file" class="btn btn-success" id="btn-upload-google-search" style="display: <?=Utils::getDisplayBotones()['SA']?>" accept="application/pdf">
                              </div>
                              <div id="content-google-search">
                                <div class="d-flex justify-content-center mt-5 mb-5">
                                  <div class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-comentarios_generales_inv" role="tabpanel" aria-labelledby="vert-tabs-comentarios_generales_inv-tab">
                              <button class="btn btn-info btn-lg float-right mb-3" style="display: <?=Utils::getDisplayBotones()['SA']?>;"><i class="fas fa-pencil-alt"></i></button>
                              <div id="content-comentarios_generales_inv">
                                <div class="d-flex justify-content-center mt-5 mb-5">
                                  <div class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="estudio">
                      <div class="row">
                        <div class="col-5 col-sm-3 col-md-2">
                          <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="vert-tabs-datos-generales-tab" data-toggle="pill" href="#vert-tabs-datos-generales" role="tab" aria-controls="vert-tabs-datos-generales" aria-selected="true">Datos personales</a>
                            <a class="nav-link" id="vert-tabs-datos-contacto-tab" data-toggle="pill" href="#vert-tabs-datos-contacto" role="tab" aria-controls="vert-tabs-datos-contacto" aria-selected="false">Datos de contacto</a>
                            <a class="nav-link" id="vert-tabs-conociendo-tab" data-toggle="pill" href="#vert-tabs-conociendo" role="tab" aria-controls="vert-tabs-conociendo" aria-selected="false">Conociendo al candidato</a>
                            <a class="nav-link" id="vert-tabs-documentacion-tab" data-toggle="pill" href="#vert-tabs-documentacion" role="tab" aria-controls="vert-tabs-documentacion" aria-selected="false">Documentación</a>
                            <a class="nav-link" id="vert-tabs-escolaridad1-tab" data-toggle="pill" href="#vert-tabs-escolaridad1" role="tab" aria-controls="vert-tabs-escolaridad1" aria-selected="false">Escolaridad</a>
                            <a class="nav-link" id="vert-tabs-cohabitan-tab" data-toggle="pill" href="#vert-tabs-cohabitan" role="tab" aria-controls="vert-tabs-cohabitan" aria-selected="false">Cohabitantes</a>
                            <a class="nav-link" id="vert-tabs-circulo_familiar-tab" data-toggle="pill" href="#vert-tabs-circulo_familiar" role="tab" aria-controls="vert-tabs-circulo_familiar" aria-selected="false">Primer cículo familiar</a>
                            <a class="nav-link" id="vert-tabs-historial_salud-tab" data-toggle="pill" href="#vert-tabs-historial_salud" role="tab" aria-controls="vert-tabs-historial_salud" aria-selected="false">Historial de Salud</a>
                            <a class="nav-link" id="vert-tabs-ubicacion-tab" data-toggle="pill" href="#vert-tabs-ubicacion" role="tab" aria-controls="vert-tabs-ubicacion" aria-selected="false">Ubicación</a>
                            <a class="nav-link" id="vert-tabs-ubicacion_fotos-tab" data-toggle="pill" href="#vert-tabs-ubicacion_fotos" role="tab" aria-controls="vert-tabs-ubicacion_fotos" aria-selected="false">Fotos de la vivienda</a>
                            <a class="nav-link" id="vert-tabs-enseres-tab" data-toggle="pill" href="#vert-tabs-enseres" role="tab" aria-controls="vert-tabs-enseres" aria-selected="false">Enseres</a>
                            <a class="nav-link" id="vert-tabs-referencias-tab" data-toggle="pill" href="#vert-tabs-referencias" role="tab" aria-controls="vert-tabs-referencias" aria-selected="false">Referencias</a>
                            <a class="nav-link" id="vert-tabs-economia-tab" data-toggle="pill" href="#vert-tabs-economia" role="tab" aria-controls="vert-tabs-economia" aria-selected="false">Economía Familiar</a>
                            <a class="nav-link" id="vert-tabs-info_financiera-tab" data-toggle="pill" href="#vert-tabs-info_financiera" role="tab" aria-controls="vert-tabs-info_financiera" aria-selected="false">Información Financiera</a>
                            <a class="nav-link" id="vert-tabs-info_patrimonial-tab" data-toggle="pill" href="#vert-tabs-info_patrimonial" role="tab" aria-controls="vert-tabs-info_patrimonial" aria-selected="false">Información Patrimonial</a>
                            <a class="nav-link" id="vert-tabs-conclusiones-tab" data-toggle="pill" href="#vert-tabs-conclusiones" role="tab" aria-controls="vert-tabs-conclusiones" aria-selected="false">Conclusiones</a>
                            <a class="nav-link" id="vert-tabs-comentarios_generales-tab" data-toggle="pill" href="#vert-tabs-comentarios_generales" role="tab" aria-controls="vert-tabs-comentarios_generales" aria-selected="false">Comentarios generales</a>
                          </div>
                        </div>
                        <div class="col-7 col-sm-9 col-md-10">
                          <div class="tab-content" id="vert-tabs-tabContent">
                            <div class="tab-pane text-left fade show active" id="vert-tabs-datos-generales" role="tabpanel" aria-labelledby="vert-tabs-datos-generales-tab">
                              <button class="btn btn-info btn-lg float-right mb-3" style="display: <?=Utils::getDisplayBotones()['SA']?>;"><i class="fas fa-pencil-alt"></i></button>
                              <div class="content-datos_generales">
                                <div class="d-flex justify-content-center mt-5 mb-5">
                                  <div class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-datos-contacto" role="tabpanel" aria-labelledby="vert-tabs-datos-contacto-tab">
                              <button class="btn btn-info btn-lg float-right mb-3" style="display: <?=Utils::getDisplayBotones()['SA']?>;"><i class="fas fa-pencil-alt"></i></button>
                               <div class="content-contacto">
                                <div class="d-flex justify-content-center mt-5 mb-5">
                                  <div class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-conociendo" role="tabpanel" aria-labelledby="vert-tabs-conociendo-tab">
                              <div id="content-conociendo_candidato">
                                <div class="d-flex justify-content-center mt-5 mb-5">
                                  <div class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-documentacion" role="tabpanel" aria-labelledby="vert-tabs-documentacion-tab">
                              <div class="form-group mb-3">
                                <label class="col-form-label">Agregar documento</label>
                                <input type="file" class="btn btn-success btn-img-documento" id="btn-img-documento" style="display: <?=Utils::getDisplayBotones()['SA']?>" accept="image/x-png,image/gif,image/jpeg">
                              </div>
                              <div class="table-responsive">
                                <table class="table table-sm text-nowrap">
                                  <thead>
                                    <tr>
                                      <th>Documento</th>
                                      <th></th>
                                    </tr>
                                  </thead>
                                  <tbody class="content-documentos"></tbody>
                                </table>
                              </div>
                              <hr>
                              <button class="btn btn-info btn-sm float-right" style="display: <?=Utils::getDisplayBotones()['SA']?>;"><i class="fas fa-pencil-alt"></i></button>
                              <b>Comentarios de la documentación</b>
                              <p></p>
                              <hr>
                              <b>Comentario de redes sociales</b>
                              <p></p>
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-escolaridad1" role="tabpanel" aria-labelledby="vert-tabs-escolaridad1-tab">
                              <button class="btn btn-info btn-lg float-right mb-3" style="display: <?=Utils::getDisplayBotones()['SA']?>;"><i class="fas fa-pencil-alt"></i></button>
                              <div class="content-escolaridad">
                                <div class="d-flex justify-content-center mt-5 mb-5">
                                  <div class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-cohabitan" role="tabpanel" aria-labelledby="vert-tabs-cohabitan-tab">
                              <button class="btn btn-success" style="display: <?=Utils::getDisplayBotones()['SA']?>;"><i class="fas fa-plus mr-1"></i> Agregar</button><br>
                              <div class="table table-responsive mt-3">
                                <table class="table table-sm text-nowrap">
                                  <thead>
                                    <tr>
                                      <th>Nombre</th>
                                      <th>Parentesco</th>
                                      <th>Edad</th>
                                      <th style="display: none;">Estado civil</th>
                                      <th>Ocupación</th>
                                      <th>Empresa</th>
                                      <th>¿Es dependiente económico?</th>
                                      <th style="display: none;">Teléfono</th>
                                      <th></th>
                                    </tr>
                                  </thead>
                                  <tbody class="content-cohabitantes"></tbody>
                                </table>
                              </div>
                              <button class="btn btn-info btn-sm float-right" style="display: <?=Utils::getDisplayBotones()['SA']?>;"><i class="fas fa-pencil-alt"></i></button>
                              <b>Comentarios</b>
                              <p></p>
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-circulo_familiar" role="tabpanel" aria-labelledby="vert-tabs-circulo_familiar-tab">
                              <button class="btn btn-success" style="display: <?=Utils::getDisplayBotones()['Logistics']?>;"><i class="fas fa-plus mr-1"></i> Agregar</button><br>
                              <div class="table table-responsive mt-3">
                                <table class="table table-sm text-nowrap">
                                  <thead>
                                    <tr>
                                      <th>Nombre</th>
                                      <th>Parentesco</th>
                                      <th>Teléfono</th>
                                      <th class="text-center">Vivo</th>
                                      <th class="text-center">Finado</th>
                                      <th></th>
                                    </tr>
                                  </thead>
                                  <tbody id="content-circulo_familiar"></tbody>
                                </table>
                              </div>
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-historial_salud" role="tabpanel" aria-labelledby="vert-tabs-historial_salud-tab">
                              <button class="btn btn-info btn-lg float-right mb-3" style="display: <?=Utils::getDisplayBotones()['Logistics']?>;"><i class="fas fa-pencil-alt"></i></button>
                              <div id="content-historial_salud">
                                <div class="d-flex justify-content-center mt-5 mb-5">
                                  <div class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-ubicacion" role="tabpanel" aria-labelledby="vert-tabs-ubicacion-tab">
                              <button class="btn btn-info btn-lg float-right mb-3" style="display: <?=Utils::getDisplayBotones()['Logistics']?>;"><i class="fas fa-pencil-alt"></i></button>
                              <div id="content-ubicacion">
                                <div class="d-flex justify-content-center mt-5 mb-5">
                                  <div class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-ubicacion_fotos" role="tabpanel" aria-labelledby="vert-tabs-ubicacion_fotos-tab">
                              <div id="content-ubicacion_fotos">
                                <div class="d-flex justify-content-center mt-5 mb-5">
                                  <div class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-enseres" role="tabpanel" aria-labelledby="vert-tabs-enseres-tab">
                              <button class="btn btn-info btn-lg float-right mb-3" style="display: <?=Utils::getDisplayBotones()['Logistics']?>;"><i class="fas fa-pencil-alt"></i></button>
                              <div class="table-responsive">
                                <table class="table table-sm text-nowrap">
                                  <thead>
                                    <tr>
                                      <th colspan="3" class="text-center">Enseres</th>
                                    </tr>
                                  </thead>
                                  <tbody id="content-enseres"></tbody>
                                </table>
                              </div>
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-referencias" role="tabpanel" aria-labelledby="vert-tabs-referencias-tab">
                              <button class="btn btn-success mb-5" style="display: <?=Utils::getDisplayBotones()['SA']?>;"><i class="fas fa-plus mr-1"></i> Agregar referencia</button>
                              <div class="content-referencias">
                                <div class="d-flex justify-content-center mt-5 mb-5">
                                  <div class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-economia" role="tabpanel" aria-labelledby="vert-tabs-economia-tab">
                              <div class="row">
                                <div class="col-sm-6">
                                  <button class="btn btn-success mb-3" style="display: <?=Utils::getDisplayBotones()['Logistics']?>;"><i class="fas fa-plus mr-1"></i> Agregar ingreso</button><br>
                                  <div class="table-responsive">
                                    <table class="table table-sm text-nowrap">
                                      <thead>
                                        <tr>
                                          <th colspan="4" class="text-center">Ingresos</th>
                                        </tr>
                                        <tr>
                                          <th>¿Quién aporta?</th>
                                          <th>Fuente de ingreso</th>
                                          <th>Monto mensual</th>
                                        </tr>
                                      </thead>
                                      <tbody id="content-ingresos"></tbody>
                                    </table>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <button class="btn btn-success mb-3" style="display: <?=Utils::getDisplayBotones()['Logistics']?>;"><i class="fas fa-plus mr-1"></i> Agregar egreso</button><br>
                                  <div class="table-responsive">
                                    <table class="table table-sm text-nowrap">
                                      <thead>
                                        <tr>
                                          <th colspan="3" class="text-center">Egresos</th>
                                        </tr>
                                        <tr>
                                          <th>Egreso</th>
                                          <th>Monto mensual</th>
                                        </tr>
                                      </thead>
                                      <tbody id="content-egresos"></tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                              <div id="content-totales-economia">    
                              </div>
                              <button class="btn btn-info btn-sm float-right" style="display: <?=Utils::getDisplayBotones()['Logistics']?>;"><i class="fas fa-pencil-alt"></i></button>
                              <b>Comentarios</b>
                              <p></p>
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-info_financiera" role="tabpanel" aria-labelledby="vert-tabs-info_financiera-tab">
                            <button class="btn btn-info btn-lg float-right" style="display: <?=Utils::getDisplayBotones()['Logistics']?>;"><i class="fas fa-pencil-alt"></i></button>
							<b>¿Cuenta con crédito INFONAVIT?</b>
							<p></p>
							<br><br>
							<hr><hr>  
							<div>
                                <button class="btn btn-success mb-3" style="display: <?=Utils::getDisplayBotones()['Logistics']?>;"><i class="fas fa-plus mr-1"></i> Agregar crédito</button><br>
                                <div class="table-responsive">
                                  <table class="table table-sm text-nowrap">
                                    <thead>
                                      <tr>
                                        <th colspan="6" class="text-center">Créditos al consumo o TDC</th>
                                      </tr>
                                      <tr>
                                        <th>Institución</th>
                                        <th>Límite de crédito</th>
                                        <th>Saldo actual aprox</th>
                                        <th>Vencimiento</th>
                                        <th>Abono mensual</th>
                                        <th></th>
                                      </tr>
                                    </thead>
                                    <tbody id="content-creditos"></tbody>
                                  </table>
                                </div>
                                <br><br><hr>
                              </div>
                              <div>
                                <button class="btn btn-success mb-3" style="display: <?=Utils::getDisplayBotones()['Logistics']?>;"><i class="fas fa-plus mr-1"></i> Agregar cuenta bancaria</button><br>
                                <div class="table-responsive">
                                  <table class="table table-sm text-nowrap">
                                    <thead>
                                      <tr>
                                        <th colspan="5" class="text-center">Cuentas bancarias y de inversión</th>
                                      </tr>
                                      <tr>
                                        <th>Institución</th>
                                        <th>Tipo de cuenta</th>
                                        <th>Objetivo del ahorro</th>
                                        <th>Depósito mensual</th>
                                        <th></th>
                                      </tr>
                                    </thead>
                                    <tbody id="content-cuentas_bancarias"></tbody>
                                  </table>
                                </div>
                                <br><br><hr>
                              </div>
                              <div>
                                <button class="btn btn-success mb-3" style="display: <?=Utils::getDisplayBotones()['Logistics']?>;"><i class="fas fa-plus mr-1"></i> Agregar seguro</button><br>
                                <div class="table-responsive">
                                  <table class="table table-sm text-nowrap">
                                    <thead>
                                      <tr>
                                        <th colspan="6" class="text-center">Seguros (vida, auto, vivienda, GMM)</th>
                                      </tr>
                                      <tr>
                                        <th>Institución</th>
                                        <th>Tipo de seguros</th>
                                        <th>Forma de pago</th>
                                        <th>Prima</th>
                                        <th>Vigencia</th>
                                        <th></th>
                                      </tr>
                                    </thead>
                                    <tbody id="content-seguros"></tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-info_patrimonial" role="tabpanel" aria-labelledby="vert-tabs-info_patrimonial-tab">
                              <div>
                                <button class="btn btn-success mb-3" style="display: <?=Utils::getDisplayBotones()['Logistics']?>;"><i class="fas fa-plus mr-1"></i> Agregar Inmueble</button><br>
                                <div class="table-responsive">
                                  <table class="table table-sm text-nowrap">
                                    <thead>
                                      <tr>
                                        <th colspan="6" class="text-center">Bienes inmuebles</th>
                                      </tr>
                                      <tr>
                                        <th>Tipo</th>
                                        <th>Ubicación</th>
                                        <th>Valor</th>
                                        <th>¿Está pagado?</th>
                                        <th>Abono mensual</th>
                                        <th></th>
                                      </tr>
                                    </thead>
                                    <tbody id="content-inmuebles"></tbody>
                                  </table>
                                </div>
                                <br><br><hr>
                              </div>
                              <div>
                                <button class="btn btn-success mb-3" style="display: <?=Utils::getDisplayBotones()['Logistics']?>;"><i class="fas fa-plus mr-1"></i> Agregar vehículo</button><br>
                                <div class="table-responsive">
                                  <table class="table table-sm text-nowrap">
                                    <thead>
                                      <tr>
                                        <th colspan="6" class="text-center">Vehículos</th>
                                      </tr>
                                      <tr>
                                        <th>Marca</th>
                                        <th>Modelo</th>
                                        <th>Valor</th>
                                        <th>¿Está pagado?</th>
                                        <th>Abono mensual</th>
                                        <th></th>
                                      </tr>
                                    </thead>
                                    <tbody id="content-vehiculos"></tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-conclusiones" role="tabpanel" aria-labelledby="vert-tabs-conclusiones-tab">
                              <button class="btn btn-info btn-lg float-right mb-3" style="display: <?=Utils::getDisplayBotones()['Logistics']?>;"><i class="fas fa-pencil-alt"></i></button>
                              <div id="content-conclusiones">
                                <div class="d-flex justify-content-center mt-5 mb-5">
                                  <div class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-comentarios_generales" role="tabpanel" aria-labelledby="vert-tabs-comentarios_generales-tab">
                              <button class="btn btn-info btn-lg float-right mb-3" style="display: <?=Utils::getDisplayBotones()['Logistics']?>;"><i class="fas fa-pencil-alt"></i></button>
                              <div id="content-comentarios_generales">
                                <div class="d-flex justify-content-center mt-5 mb-5">
                                  <div class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.tab-pane -->
                  </div>
                  <!-- /.tab-content -->
                </div><!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <div class="content" id="content_botones">
              <div class="row">
                <div class="col-sm-3">
                  <a href="<?=base_url?>formato/validacion_licencia_federal&candidato=<?=Encryption::encode($folio)?>" class="btn btn-success" target="_blank" style="display: none;">Descargar Validación de Licencia Federal</a>
                </div>
                <div class="col-sm-3">
                  <a href="<?=base_url?>formato/ral&candidato=<?=Encryption::encode($folio)?>" class="btn btn-orange" target="_blank" style="display: none;">Descargar Registro de Antecedentes Legales</a>
                </div>
                <div class="col-sm-3">
                  <a href="<?=base_url?>formato/investigacion_laboral&candidato=<?=Encryption::encode($folio)?>" class="btn btn-danger" target="_blank" style="display: none;">Descargar Investigación Laboral</a>
                </div>
                <div class="col-sm-3">
                  <a href="<?=base_url?>formato/ese&candidato=<?=Encryption::encode($folio)?>" target="_blank" class="btn btn-navy" target="_blank" style="display: none;">Descargar Verificación Domiciliaria</a>
                </div>   
				  
			  <div class="col-6 ">
                <a href="<?= base_url ?>formatoing/investigacion_laboral&candidato=<?= Encryption::encode($folio) ?>" target="_blank" class="btn-lg btn-danger float-right h3 mt-4" target="_blank" style="display: none;">Download English Version INV</a>
              </div>
              <div class="col-6 ">
                <a href="<?= base_url ?>formatoing/ese&candidato=<?= Encryption::encode($folio) ?>" target="_blank" class="btn-lg btn-warning float-right h3 mt-4" target="_blank" style="display: none;">Download English Version</a>
              </div>   
                <div class="col-sm-3">
                  <a href="<?=base_url?>formato/soi&candidato=<?=Encryption::encode($folio)?>" target="_blank" class="btn bg-black" style="display: none;">Descargar Safe Operator By Ingenia</a>
                </div>
                   
              </div>
            </div>
			<div class="content botones_continuar mt-4">
              <button class="btn btn-app bg-danger mb-5" style="display: none;">
                <i class="fas fa-play"></i>
                Continuar con investigación
              </button>
              <button class="btn btn-app bg-navy" style="display: none;">
                <i class="fas fa-play"></i>
                Continuar con estudio ESE(EG48)
              </button>
			  <button class="btn btn-app bg-maroon" style="display: none;" >
                <i class="fas fa-play"></i>
                Continuar con análisis de RAL
              </button>
              <button class="btn btn-app bg-black" style="display: none;">
                <i class="fas fa-play"></i>
                Continuar con SAFE OPERATOR
              </button>
              <button class="btn btn-app bg-success" style="display: none;">
                <i class="fas fa-play"></i>
                Continuar con ESE SMART
              </button>
            </div>
            <div class="content botones_pausar_finalizar mt-3 text-center">
              <button class="btn btn-app bg-info" style="display: none;">
                <i class="fas fa-stop"></i>
                No deseo continuar
              </button>
              <button class="btn btn-app bg-orange" style="display: none;">
                <i class="fas fa-pause"></i>
                Pausar por 7 días
              </button>
            </div>
			 <div class="card  card-warning" id="especificaciones_Empresa" style="display: none;">
            <div class="card-header">
              <h3 class="card-title">Especificaciones del proceso</h3>
            </div>
            <div class="card-body h6">
              <h6></h6>
            </div>
            </div>
				
				    <div class="card  card-orange" id="especificaciones_Cliente" style="display: none;">
            <div class="card-header">
              <h3 class="card-title">Especificaciones del cliente</h3>
            </div>
            <div class="card-body h6">
            </div>
          </div>


				
				
			<div class="card" id="Comentarios_Cliente" style="display: none;">
              <div class="card-header">
                <h3 class="card-title">Comentarios del cliente</h3>
              </div>
              <div class="card-body">
                <h6></h6>
              </div>
            </div>
			<div class="card" id="soi-card" style="display: none;">
              <div class="card-header">
                <h3>Safe Operator By Ingenia</h3>
              </div>
              <div class="card-body">
                <div class="text-center" style="display: none;">
                  <button class="btn btn-warning">Certificar SOI</button>
                  <button class="btn btn-danger">Denegar SOI</button>
                </div>
                <a href="#">
                  <img src="" alt="SOI" class="img-fluid" style="display: none;">
                </a>
              </div>
            </div>
            <div class="card" style="display: none;">
              <div class="card-header">
                <h4 class="card-title">Notas</h4>
              </div>
              <div class="card-body">
                <div class="text-right">
                                  <button class="btn btn-success mb-3" style="display: <?= Utils::getDisplayBotones()['Account']=='block'|| Utils::getDisplayBotones()['Logistics']=='block'?'block':'none' ?>;"><i class="fas fa-plus mr-1"></i> Nueva nota</button>

                </div>
              </div>
              <div class="card-footer card-comments" id="content-notas">
                Sin notas
              </div>
            </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
</div>
<template id="template-perfil">
  <div class="text-center ml-5 mr-5 mb-3">
    <img src="../dist/img/user-icon.png" class="img-fluid img-circle user-image mt-3">
    <div class="btn-group btn-group-sm mt-2">
      <button class="btn btn-success btn-watch-photo"><i class="fas fa-eye"></i></button>
      <button class="btn btn-info btn-edit-photo"><i class="fas fa-pencil-alt mr-1"></i></button>
      <button class="btn btn-danger btn-delete-photo"><i class="fas fa-times mr-1"></i></button>
      <!-- <button class="btn btn-orange btn-upload-photo ml-2"><i class="fas fa-upload"></i></button> -->
      <label class="btn btn-orange ml-2">
        <input type="file" class="d-none btn-upload-photo" accept="image/x-png,image/gif,image/jpeg"><i class="fas fa-upload"></i>
      </label>
    </div>  
  </div>
  <h3 class="profile-username text-center"><b></b><p></p></h3>
  <h6 class="text-muted text-center"></h6>
  <hr>
</template>
<template id="template-candidato_contactado">
  <span class="badge"></span>
  <p></p>
  <button class="btn btn-success btn-sm btn-contactar" style="display: none;">Contactar candidato</button>
  <hr>
</template>
<template id="template-datos_empresa">
  <button class="btn btn-info btn-sm float-right btn-empresa"><i class="fas fa-pencil-alt"></i></button>
  <b>Cliente</b>
  <p class="text-muted"></p>
  <b>Razón social</b>
  <p></p>
  <b>Centro de costos del cliente</b>
  <p></p>
  <hr>
  <b>Solicitado por</b>
  <p></p>
  <b>Correo electrónico</b>
  <p></p>
  <b>Teléfono</b>
  <p></p>
  <b>Celular</b>
  <p></p>
  <hr>
</template>
<template id="template-localizacion">
  <button class="btn btn-info btn-sm float-right btn-localizacion"><i class="fas fa-pencil-alt"></i></button>
  <b>Ciudad</b>
  <p></p>
  <b>Estado</b>
  <p></p>
  <hr>
</template>
<template id="template-estatus_servicio">
  <button class="btn btn-info btn-sm float-right btn-service"><i class="fas fa-pencil-alt"></i></button>
  <b>Servicio solicitado</b>
  <p></p>
  <b>Fase</b>
  <p></p>
  <b>Estatus</b>
  <p></p>
  <hr>
</template>
<template id="template-botones_estatus">
  <div class="btn-group btn-group-sm text-center">
    <button class="btn btn-danger btn-sm btn-cancelar">Cancelar servicio</button>
    <button class="btn btn-info btn-sm btn-cancelar-ralf">Finalizar en RAL</button>
    <button class="btn btn-success btn-sm btn-avanzar-investigacion">Avanzar a Investigación</button>
  </div>
  <div class="btn-group btn-group-sm text-center">
    <button class="btn btn-danger btn-sm btn-cancelar-ral">Cancelar Investigación</button>
    <button class="btn btn-info btn-sm btn-cancelar-investigacionf" style="display: none;">Finalizar en Investigación</button>
    <button class="btn btn-success btn-sm btn-avanzar-estudio">Finalizar Investigación</button>
  </div>
  <div class="btn-group btn-group-sm text-center">
    <button class="btn btn-danger btn-sm btn-cancelar-investigacion" style="display: none;">Cancelar Estudio</button>
    <button class="btn btn-success btn-sm btn-finalizar-servicio">Finalizar Estudio</button>
  </div>
  <div class="btn-group btn-group-sm text-center">
    <button class="btn btn-danger btn-sm btn-cancelar-ral">Cancelar Investigación</button>
    <button class="btn btn-success btn-sm btn-finalizar-investigacion">Finalizar Investigación</button>
  </div>
  <div class="btn-group btn-group-sm text-center">
    <button class="btn btn-danger btn-sm btn-cancelar">Cancelar servicio</button>
    <button class="btn btn-success btn-sm btn-finalizar-ral">Finalizar RAL</button>
  </div>
  <div class="btn-group btn-group-sm text-center">
    <button class="btn btn-danger btn-sm btn-cancelar">Cancelar servicio</button>
    <button class="btn btn-success btn-sm btn-finalizar-investigacion">Finalizar Investigación</button>
  </div>
  <div class="btn-group btn-group-sm text-center">
    <button class="btn btn-danger btn-sm btn-cancelar">Cancelar servicio</button>
    <button class="btn btn-info btn-sm btn-finalizar-investigacion">Finalizar Investigación</button>
    <button class="btn btn-success btn-sm btn-finalizar-estudio">Finalizar Estudio</button>
  </div>
  <div class="btn-group btn-group-sm text-center">
    <button class="btn btn-danger btn-sm btn-cancelar-investigacion">Cancelar Estudio</button>
    <button class="btn btn-info btn-sm btn-cancelar-estudiof">Finalizar en Estudio</button>
    <button class="btn btn-success btn-sm btn-avanzar-visita">Avanzar a Visita</button>
  </div>
  <div class="btn-group btn-group-sm text-center">
    <button class="btn btn-danger btn-sm btn-cancelar-estudio">Cancelar Visita</button>
    <button class="btn btn-success btn-sm btn-finalizar-visita">Finalizar Visita</button>
  </div>
  <div class="btn-group btn-group-sm text-center">
    <button class="btn btn-success btn-sm btn-finalizar-aral">Finalizar Análisis de RAL</button>
  </div>
  <div class="btn-group btn-group-sm text-center">
    <button class="btn btn-warning btn-sm btn-pausar">Pausar</button>
  </div>
  <div class="btn-group btn-group-sm text-center">
    <button class="btn btn-navy btn-sm btn-reanudar">Reanudar</button>
  </div>
  <!-- <div class="btn-group btn-group-sm text-center">
    <button class="btn btn-danger btn-sm btn-cancelar">Cancelar servicio</button>
    <button class="btn btn-info btn-sm btn-cancelar-vlff">Finalizar en Val. Licencia</button>
    <button class="btn btn-success btn-sm btn-avanzar-ral">Avanzar a RAL</button>
  </div>
  <div class="btn-group btn-group-sm text-center">
    <button class="btn btn-danger btn-sm btn-cancelar-vlf">Cancelar RAL</button>
    <button class="btn btn-info btn-sm btn-cancelar-ralf">Finalizar en RAL</button>
    <button class="btn btn-success btn-sm btn-avanzar-investigacion">Avanzar a Investigación</button>
  </div>
  <div class="btn-group btn-group-sm text-center">
    <button class="btn btn-danger btn-sm btn-cancelar">Cancelar servicio</button>
    <button class="btn btn-success btn-sm btn-finalizar-vlf">Finalizar VLF</button>
  </div> -->
  <hr>
</template>
<template id="template-config">
  <button class="btn btn-info btn-sm float-right btn-config"><i class="fas fa-pencil-alt"></i></button>
  <b>Fecha de solicitud</b>
  <p></p>
  <b>Ejecutivo de cuenta</b>
  <p></p>
  <b>Correo electrónico</b>
  <p></p>
  <b>Fecha de finalización</b>
  <p></p>
  <hr>
</template>

<template id="template-schedule">
  <button class="btn btn-info btn-sm float-right btn-schedule"><i class="fas fa-pencil-alt"></i></button>
  <b>Ejecutivo de logística</b>
  <p></p>
  <b>Fecha de aplicación del estudio</b>
  <p></p>
  <hr>
</template>

<template id="template-videollamada">
  <button class="btn btn-info btn-sm float-right btn-videocall"><i class="fas fa-pencil-alt"></i></button>
  <b>Verificación domiciliaria</b>
  <div class="embed-responsive embed-responsive-16by9 mt-3 mb-3">
    <iframe class="embed-responsive-item" src="" allow="autoplay" allowfullscreen></iframe>
  </div>
</template>

<template id="template-comentarios_servicio">
  <b>Comentarios del cliente</b>
  <p></p>
  <br>
  <b>Comentarios de cancelación</b>
  <p></p>
  <hr>
</template>
<template id="template-reactivar_eliminar">
  <div class="btn-group btn-group-sm text-center">
    <button class="btn btn-info btn-sm btn-reactivar">Reactivar</button>
    <button class="btn btn-danger btn-sm btn-eliminar" >Eliminar servicio</button>
  </div>
  <hr>
  <div class="col-12 mt-4 text-center">
    <a href="#" target="_blank" class="btn btn-lg btn-outline-success" style="display: none;"><i class="fas fa-file-download"></i> Descargar CV personal</a>
  </div>
</template>
<template id="template-historial_candidato">
  <div class="callout">
    <a href="#" target="_blank" class="text-primary" style="text-decoration: none;"><h6></h6></a>
    <p></p>
    <b></b>
    <p></p>
  </div>
</template>
<template id="template-licencia">
  <button class="btn btn-info btn-sm float-right btn-licencia"><i class="fas fa-pencil-alt mr-1"></i>Editar</button>
  <b>Tipo de Licencia</b>
  <p></p>
  <b>Número</b>
  <p></p>
  <b>Categoría</b>
  <p></p>
  <div class="row">
    <div class="col">
      <b>Vigente del</b>
      <p></p>
    </div>
    <div class="col">
      <b>hasta el</b>
      <p></p>
    </div>
  </div>
  <div class="row" style="display: none;">
    <div class="col">
      <b>Vencimiento</b>
      <p></p>
    </div>
    <div class="col">
      <b>Estatus</b>
      <p></p>
    </div>
  </div>
</template>
<template id="template-examen_medico">
  <button class="btn btn-info btn-sm float-right btn-examen"><i class="fas fa-pencil-alt mr-1"></i>Editar</button>
  <b>Número</b>
  <p></p>
  <b>Tipo</b>
  <p></p>
  <b>Resultado</b>
  <p></p>
  <div class="row">
    <div class="col">
      <b>Fecha de dictamen</b>
      <p></p>
    </div>
    <div class="col">
      <b>vigente hasta</b>
      <p></p>
    </div>
  </div>
</template>
<template id="template-resultado_licencia">
  <button class="btn btn-info btn-sm float-right"><i class="fas fa-pencil-alt mr-1"></i>Editar</button>
  <b>Características</b>
  <p></p>
  <b>Resultado</b>
  <p></p>
</template>
<template id="template-busqueda_ral">
  <form method="POST" class="row mb-2" id="ral-form">
    <div class="col-12 col-md-5">
      <div class="form-group">
        <label for="Nombres" class="col-form-label">Nombre(s):</label>
        <input type="text" name="Nombres" id="Nombres" class="form-control" disabled>
      </div>
    </div>
    <div class="col-12 col-md-5">
      <div class="form-group">
        <label for="Apellidos" class="col-form-label">Apellidos:</label>
        <input type="text" name="Apellidos" id="Apellidos" class="form-control" disabled>
      </div>
    </div>
    <div class="col-12 col-md-2">
      <div class="input-group-append">
        <button class="btn btn-app btn-block btn-info" style="background-color: #17a2b8; color: #fff;"><i class="fas fa-search"></i>
        </button>
      </div>
    </div>
  </form>
  <h6></h6>
  <p></p>
  <a href="#" class="btn btn-outline-danger mt-3" target="_blank"><i class="fas fa-file-pdf mr-2"></i>PDF</a>
  <br>
</template>
<template id="template-expediente_ral">
  <div class="card card-primary card-outline">
      <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
          <div class="card-header">
            <h4 class="card-title w-100"></h4>
            <br>
            <i class="fas fa-map-marker-alt mr-2 mt-3"></i><b></b>
          </div>
      </a>
      <div id="collapseOne" class="collapse" data-parent="#content-expedientes_ral">
          <div class="card-body">
              <p></p>
              <dl class="mb-2">
                <dt>Actor:</dt>
                <dd></dd>
                <dt>Demandado:</dt>
                <dd></dd>
                <dt>Tipo de Expediente:</dt>
                <dd></dd>
              </dl>
              <p></p>
              <a href="#" class="btn btn-outline-danger mt-3" target="_blank"><i class="fas fa-file-pdf mr-2"></i>PDF</a>
          </div>
          <div class="card card-navy border-0">
            <div class="card-header">
              <h4 class="card-title"></h4>
            </div>
            <div class="card-body"></div>
          </div>
      </div>
  </div>
</template>
<template id="template-ral">
  <button class="btn btn-info btn-sm float-right btn-ral"><i class="fas fa-pencil-alt mr-1"></i>Editar</button>
  <b>Demandas</b>
  <p></p>
  <b>Estado o Nacional</b>
  <p></p>
  <div style="display: none;">
    <b>Total de demandas</b>
    <p></p>
    <b>Total de acuerdos</b>
    <p></p>
    <b>Tipo de Juicio</b>
    <p></p>
  </div> 
</template>
<template id="template-captura_ral">
  <tr>
    <td></td>
    <td></td>
    <td class="text-right py-0 align-middle">
      <div class="btn-group btn-group-sm">
          <a class="btn btn-success">
            <i class="fas fa-eye"></i> Ver
          </a>
          <button class="btn btn-info">
            <i class="fas fa-pencil-alt mr-1"></i> Editar
          </button>
          <button class="btn btn-danger">
            <i class="fas fa-times mr-1"></i>Borrar
          </button>
      </div>
    </td>
  </tr>
</template>
	<template id="template-propio_ral_estados">
  <div class="card card-primary card-outline">
    <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
      <div class="card-header">
        <h4 class="card-title w-100"></h4>
      </div>
    </a>
    <div id="collapseOne" class="collapse collapsestados" data-parent="#content-expedientes_ral">

  </div>
  </div>
</template>
<template id="template-propio_ral">
  <div class="card card-primary card-outline">
    <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
      <div class="card-header">
        <h4 class="card-title w-100"></h4>
        <br>
        <i class="fas fa-map-marker-alt mr-2 mt-3"></i><b></b>
      </div>
    </a>

    <div id="collapseOne" class="collapse collapseral" data-parent="#content-expedientes_ral">
      <div class="card-body">
        <p></p>
        <p></p>
        <p></p>
        <p></p>
      </div>
      <div class="card card-navy border-0">
        <div class="card-header">
          <h4 class="card-title"></h4>
        </div>
        <div class="card-body"></div>
      </div>
    </div>
  </div>
</template>
<template id="template-comentarios_ral">
  <b>Comentarios</b>
  <p></p>
</template>
<template id="template-datos_generales">
  <div class="row">
    <div class="col">
      <b>Fecha de nacimiento</b>
      <p></p>
    </div>
    <div class="col">
      <b>Edad</b>
      <p></p>
    </div>
    <div class="col">
      <b>Sexo</b>
      <p></p>
    </div>
  </div>
  <b>Lugar de Nacimiento</b>
  <p></p>
  <div class="row">
    <div class="col">
      <b>Estado civil</b>
      <p></p>
    </div>
    <div class="col">
      <b>Fecha de matrimonio</b>
      <p></p>
    </div>
    <div class="col">
      <b>Número de hijos</b>
      <p></p>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <b>Nacionalidad</b>
      <p></p>
    </div>
    <div class="col">
      <b>Vive con</b>
      <p></p>
    </div>
  </div>
  <b>CURP</b>
  <p></p>
  <b>Número de Seguridad Social</b>
  <p></p>
  <b>RFC</b>
  <p></p>
  <b style="display: none;">Numero de Licencia</b>
  <p></p>
</template>

<template id="template-contacto">
  <b>Teléfono fijo</b>
  <p></p>
  <b>Número de celular</b>
  <p></p>
  <b>Otro contacto</b>
  <p></p>
  <b>Dirección de correo electrónico</b>
  <p></p>
  <b>LinkedIn</b>
  <p></p>
  <b>Facebook</b>
  <p></p>
  <b>Domicilio completo</b>
  <p></p>
</template>

<template id="template-referencia_laboral">
  <div class="callout callout-info referencia_laboral_class">
    <i class="fas fa-grip-horizontal float-left fa-3x" style="cursor: move;"></i>
    <button class="btn btn-danger btn-lg float-right"><i class="fas fa-trash"></i></button>
    <button class="btn btn-info btn-lg float-right"><i class="fas fa-pencil-alt"></i></button>
    <br>
    <h6 class="mt-3">Referencia</h6>
    <div class="row">
      <div class="col-sm-6">
        <b>Empresa</b>
        <p></p>
      </div>
      <div class="col-sm-6">
        <b>Giro</b>
        <p></p>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6">
        <b>Domicilio</b>
        <p></p>
      </div>
      <div class="col-sm-6">
        <b>Teléfono</b>
        <p></p>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6">
        <b>Fecha de Ingreso</b>
        <p></p>
      </div>
      <div class="col-sm-6">
        <b>Fecha de Baja</b>
        <p></p>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6">
        <b>Puesto inicial</b>
        <p></p>
      </div>
      <div class="col-sm-6">
        <b>Puesto final</b>
        <p></p>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6">
        <b>Jefe inmediato</b>
        <p></p>
      </div>
      <div class="col-sm-6">
        <b>Puesto del jefe</b>
        <p></p>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6">
        <b>Motivo de separación</b>
        <p></p>
      </div>
      <div class="col-sm-6" style="display: none;">
        <b>Uso y abuso de estupefacientes y medicamentos controlados</b>
        <p></p>
      </div>
    </div>   
    <div class="row">
      <div class="col-sm-6">
        <b>¿Es el candidato una persona recontratable?</b>
        <p></p>
      </div>
      <div class="col-sm-6">
        <b>Justifique su respuesta</b>
        <p></p>
      </div>
    </div>
    <b>Nombre de quién proporciona la información</b>
    <p></p>
    <b>Puesto de quién proporciona la información</b>
    <p></p>
    <b>Comentarios</b>
    <p></p>
    <br>
    <div class="table-responsive">
      <table class="table table-sm text-nowrap">
        <thead>
          <tr>
            <th></th>
            <th class="text-center">Excelente</th>
            <th class="text-center">Apropiada</th>
            <th class="text-center">Regular</th>
            <th class="text-center">Malo</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th>Desempeño laboral</th>
            <td class="text-center"></td>
            <td class="text-center"></td>
            <td class="text-center"></td>
            <td class="text-center"></td>
          </tr>
          <tr>
            <th>Honradez</th>
            <td class="text-center"></td>
            <td class="text-center"></td>
            <td class="text-center"></td>
            <td class="text-center"></td>
          </tr>
          <tr>
            <th>Asistencia y puntualidad</th>
            <td class="text-center"></td>
            <td class="text-center"></td>
            <td class="text-center"></td>
            <td class="text-center"></td>
          </tr>
          <tr>
            <th>Relación con superiores y compañeros</th>
            <td class="text-center"></td>
            <td class="text-center"></td>
            <td class="text-center"></td>
            <td class="text-center"></td>
          </tr>
          <tr>
            <th>Responsabilidad</th>
            <td class="text-center"></td>
            <td class="text-center"></td>
            <td class="text-center"></td>
            <td class="text-center"></td>
          </tr>
          <tr>
            <th>Adaptación al ambiente de trabajo</th>
            <td class="text-center"></td>
            <td class="text-center"></td>
            <td class="text-center"></td>
            <td class="text-center"></td>
          </tr>
        </tbody>
      </table>
    </div>
	<hr>
	<div class="sindicato-cementin" style="display: none;">
      <div class="row">
        <div class="col">
          <b>¿El candidato estuvo sindicalizado?</b>
          <p></p>
        </div>
        <div class="col">
          <b>¿En cuál(es) sindicato(s) estuvo?</b>
          <p></p>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <b>¿Tuvo un puesto en el comité sindical?</b>
          <p></p>
        </div>
        <div class="col">
          <b>¿Cuál fue el puesto</b>
          <p></p>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <b>¿Cuáles eran sus funciones?</b>
          <p></p>
        </div>
        <div class="col">
          <b>¿Durante cuánto tiempo?</b>
          <p></p>
        </div>
      </div>
    </div>
  </div>
 
</template>
<template id="template-documento">
  <tr>
    <td></td>
    <td class="text-right py-0 align-middle">
      <div class="btn-group btn-group-sm">
        <button class="btn btn-success">
          <i class="fas fa-eye"></i>
        </button>
        <button class="btn btn-info">
          <i class="fas fa-pencil-alt"></i>
        </button>
        <button class="btn btn-danger">
          <i class="fas fa-times"></i>
        </button>
      </div>
    </td>
  </tr>
</template>
<template id="template-investigacion">
  <button class="btn btn-info btn-sm float-right"><i class="fas fa-pencil-alt"></i></button>
  <b>¿El candidato cuenta con constancias laborales?</b>
  <p></p>
  <b>¿Proporcionó los datos de contacto de sus empleos?</b>
  <p></p>
  <b>En caso de que no, ¿cuál fue el motivo por que no los proporcionó?</b>
  <p></p>
  <b>¿Ha demandado alguna empresa?</b>
  <p></p>
  <b>En caso afirmativo, ¿cuál fue el motivo?</b>
  <p></p>
  <b>Número de empleos registrados en los últimos 3 años</b>
  <p></p>
  <div class="sindicato-cementin" style="display: none;">
	  <div class="row">
		  <div class="col">
			  <b>¿El candidato estuvo sindicalizado?</b>
			  <p></p>
		  </div>
		  <div class="col">
			  <b>¿En cuál(es) sindicato(s) estuvo?</b>
			  <p></p>
		  </div>
	  </div>
	  <div class="row">
		  <div class="col">
			  <b>¿Tuvo un puesto en el comité sindical?</b>
			  <p></p>
		  </div>
		  <div class="col">
			  <b>¿Cuál fue el puesto</b>
			  <p></p>
		  </div>
	  </div>
	  <div class="row">
		  <div class="col">
			  <b>¿Cuáles eran sus funciones?</b>
			  <p></p>
		  </div>
		  <div class="col">
			  <b>¿Durante cuánto tiempo?</b>
			  <p></p>
		  </div>
	  </div>
	</div>
	 <div class="trabajo-ternium" style="display: none;">
    <b>¿Ha trabajado para Ternium?</b>
    <p></p>
    <b>¿Qué empresa lo dio de alta y cuándo fue su último acceso a una planta Ternium?</b>
    <p></p>
    <b>¿Tiene algún veto o sanción con Ternium?</b>
    <p></p>
  </div>
  <div class="preguntas-operador" style="display: none;">
    <div class="row">
      <div class="col-md-6">
        <b>¿Alguna vez salió positivo en una prueba antidoping?</b>
        <p></p>
      </div>
      <div class="col-md-6">
        <b>Especificar la sustancia</b>
        <p></p>
      </div>
    </div>
	<b>¿Cuenta con accidentes en su historia con la empresa?</b>
	<p></p>
	<b>¿Tuvo abandono de unidad?</b>
	<p></p>
  </div>
	
  <div class="trabajo-dalton" style="display: none;">
    <b>¿Cuentan con algún familiar dentro de la empresa?</b>
    <p></p>
  </div>
	
	  <div class="reingreso" style="display: none;">
    <b>¿Es reingreso de la empresa?</b>
    <p></p>
  </div>
	
</template>
<template id="template-google_search">
  <embed src="" type="application/pdf" width="100%" height="500">
</template>
<template id="template-comentarios_generales_inv">
  <div class="table-responsive">
    <table class="table table-sm text-nowrap">
      <thead>
        <tr>
          <th>Resultados de la investigación laboral</th>
          <th class="text-center">Apropiada</th>
          <th class="text-center">Regular</th>
          <th class="text-center">Malo</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th>Información proporcionada por el candidato</th>
          <td class="text-center"></td>
          <td class="text-center"></td>
          <td class="text-center"></td>
        </tr>
        <tr>
          <th>Referencias laborales Obtenidas</th>
          <td class="text-center"></td>
          <td class="text-center"></td>
          <td class="text-center"></td>
        </tr>
        <tr>
          <th>Información confiable y verificable</th>
          <td class="text-center"></td>
          <td class="text-center"></td>
          <td class="text-center"></td>
        </tr>
      </tbody>
    </table>
  </div>
  <hr>
  <b>Comentarios generales de la investigación laboral</b>
  <p></p>
  <table class="table table-sm text-nowrap">
      <thead>
        <tr>
          <th></th>
          <th class="text-center">Sí</th>
          <th class="text-center">No</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th>¿El candidato proporcionó los datos de contacto?</th>
          <td class="text-center"></td>
          <td class="text-center"></td>
        </tr>
        <tr>
          <th>¿Es congruente la información con lo obtenido en información de IMSS?</th>
          <td class="text-center"></td>
          <td class="text-center"></td>
        </tr>
        <tr>
          <th>¿Se detectó algún factor de riesgo?</th>
          <td class="text-center"></td>
          <td class="text-center"></td>
        </tr>
        <tr>
          <th>¿Se observa estabilidad laboral</th>
          <td class="text-center"></td>
          <td class="text-center"></td>
        </tr>
      </tbody>
  </table>
  <br>
  <b>Viabilidad</b>
  <p></p>
</template>
<template id="template-conociendo_candidato">
  <button id="btn-conociendo" class="btn btn-info btn-sm float-right"><i class="fas fa-pencil-alt"></i></button>
  <b>¿Por qué te interesó el puesto para el que estás postulándote?</b>
  <p></p>
  <b>¿Qué esperas lograr en caso de ingresar a este empleo?</b>
  <p></p>
  <b>¿Cuáles son para ti las características más importantes que debe tener un empleo?</b>
  <p></p>
  <b>¿Cuál es tu objetivo Laboral / Profesional?</b>
  <p></p>
  <b>¿Qué esperas de una empresa que te contrate?</b>
  <p></p>
  <b>Describe tus principales cualidades</b>
  <p></p>
  <b>¿Qué piensas del trabajo en equipo?</b>
  <p></p>
  <b>¿Qué nos dirías de tus últimos 2 jefes?</b>
  <p></p>
  <b>¿Qué vas a aportar a esta empresa en caso de ser contratado?</b>
  <p></p>
  <b>¿Qué tan importante es para ti apegarse a la jornada laboral?</b>
  <p></p>
  <b>¿Cuál es tu principal motivación para trabajar?</b>
  <p></p>
  <b>Si platicamos con tus jefes anteriores ¿Qué crees que nos dirían?</b>
  <p></p>
  <b>De toda tu trayectoria laboral / profesional ¿De qué te sientes más orgulloso?</b>
  <p></p>
  <b>¿Qué es lo que no te llegó a gustar de tus empleos anteriores?</b>
  <p></p>
  <b>¿Actualmente estás en otros procesos?</b>
  <p></p>
</template>
<template id="template-escolaridad">
  <div class="row">
    <div class="col">
      <b>Grado escolar</b>
      <p></p>
    </div>
    <div class="col">
      <b>Institución</b>
      <p></p>
    </div>
    <div class="col">
      <b>Localidad</b>
      <p></p>
    </div>
    <div class="col">
      <b>Periodo</b>
      <p></p>
    </div>
    <div class="col">
      <b>Documento</b>
      <p></p>
    </div>
    <div class="col">
      <b>Folio</b>
      <p></p>
    </div>
  </div>    
</template>
<template id="template-cohabitante">
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td style="display: none;"></td>
    <td></td>
    <td></td>
    <td></td>
    <td style="display: none;"></td>
    <td class="text-center py-0 align-middle">
        <div class="btn-group btn-group-sm">
          <button class="btn btn-lg btn-info">
            <i class="fas fa-pencil-alt"></i>
           </button>
          <button class="btn btn-lg btn-danger">
            <i class="fas fa-trash"></i>
          </button>
        </div>
    </td>
  </tr>
</template>
<template id="template-comentario_cohabitan">
  <b>Comentarios</b>
  <p></p>
</template>
<template id="template-circulo_familiar">
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td class="text-center text-bold"></td>
    <td class="text-center text-bold"></td>
    <td class="text-center py-0 align-middle">
        <div class="btn-group btn-group-sm">
          <button class="btn btn-lg btn-info">
            <i class="fas fa-pencil-alt"></i>
          </button>
          <button class="btn btn-lg btn-danger">
            <i class="fas fa-trash"></i>
          </button>
        </div>
    </td>
  </tr>
</template>
<template id="template-historial_salud">
  <div class="table table-responsive">
    <table class="table text-nowrap">
      <thead>
        <tr>
          <th colspan="2">¿Padece usted o un familiar directo alguna de las siguientes enfermedades?</th>
          <th>¿Quién</th>
        </tr>
      </thead>
      <tbody id="content-historial_salud">
        <tr>
          <th>Diabetes</th>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <th>Cáncer</th>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <th>Hipertensión</th>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <th>Disfunción Renal</th>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <th>Fibrosis Quística</th>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <th>Miopía</th>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <th>Asma</th>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <th>Migrañas</th>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <th>Esclerosis Múltiple</th>
          <td></td>
          <td></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="table table-responsive">
    <table class="table table-sm text-nowrap">
      <tr>
        <th>¿Fuma?</th>
        <td></td>
        <th>¿Cuántos cigarros al día?</th>
        <td></td>
      </tr>
      <tr>
        <th>¿Bebe?</th>
        <td></td>
        <th>¿Con qué frecuencia?</th>
        <td></td>
      </tr>
      <tr>
        <th>¿Consume alguna droga?</th>
        <td></td>
        <th>¿Cuál?</th>
        <td></td>
      </tr>
      <tr>
        <th>¿Cuenta con servicio médico?</th>
        <td></td>
        <th>¿Cuál?</th>
        <td></td>
      </tr>
      <tr>
        <th>¿Practica algún deporte?</th>
        <td></td>
        <th>¿Cuál y con qué frecuencia?</th>
        <td></td>
      </tr>
    </table>
  </div>
</template>
<template id="template-ubicacion">
  <b>Tiempo de vivir en el domicilio</b>
  <p></p>
  <div class="row">
    <div class="col">
      <b>Calle</b>
      <p></p>
    </div>
    <div class="col">
      <b>Número</b>
      <p></p>
    </div>
    <div class="col">
      <b>Interior</b>
      <p></p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-6">
      <b>Colonia</b>
      <p></p>
    </div>
    <div class="col-sm-6">
      <b>Entre</b>
      <p></p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-5">
      <b>Delegación o municipio</b>
      <p></p>
    </div>
    <div class="col-sm-5">
      <b>Estado</b>
      <p></p>
    </div>
    <div class="col-sm-2">
      <b>CP</b>
      <p></p>
    </div>
  </div>
  <b>Color y descripción de la fachada</b>
  <p></p>
  <b>Tipo de vivienda</b>
  <p></p>
  <div class="row">
    <div class="col-sm-6">
      <b>No. de plantas o niveles</b>
      <p></p>
    </div>
    <div class="col-sm-6">
      <b>No. de baños</b>
      <p></p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-6">
      <b>No. de recámaras</b>
      <p></p>
    </div>
    <div class="col-sm-6">
      <b>Capacidad de autos en cochera</b>
      <p></p>
    </div>
  </div>
  <b>El domicilio donde vive es</b>
  <p></p>
  <b>En caso de no ser propio, nombre del propietario</b>
  <p></p>
  <div class="row">
    <div class="col-sm-6">
      <b>Parentesco</b>
      <p></p>
    </div>
    <div class="col-sm-6">
      <b>Teléfono</b>
      <p></p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-6">
      <b>En caso de arrendamiento, ¿cuenta con el contrato?</b>
      <p></p>
    </div>
    <div class="col-sm-6">
      <b>Tiempo de contrato</b>
      <p></p>
    </div>
  </div>
  <b>Comentarios</b>
  <p></p>
  <br>
  <b>Ubicación geográfica</b>
  <p></p>
</template>
<template id="template-ubicacion_fotos">
  <div class="row">
    <div class="col text-center">
      <b>Foto de la fachada</b>
      <img src="" class="img-fluid">
      <div class="btn-group btn-group-sm mt-2">
        <button class="btn btn-success"><i class="fas fa-eye"></i></button>
        <button class="btn btn-info"><i class="fas fa-pencil-alt mr-1"></i></button>
        <button class="btn btn-danger"><i class="fas fa-times mr-1"></i></button>
      </div>
      <label class="btn btn-orange ml-2">
        <input type="file" class="d-none btn-upload-photo" accept="image/x-png,image/gif,image/jpeg"><i class="fas fa-upload"></i>
      </label>
    </div>
    <div class="col text-center">
      <b>Foto del número del domicilio</b>
      <img src="" class="img-fluid">
      <div class="btn-group btn-group-sm mt-2">
        <button class="btn btn-success"><i class="fas fa-eye"></i></button>
        <button class="btn btn-info"><i class="fas fa-pencil-alt mr-1"></i></button>
        <button class="btn btn-danger"><i class="fas fa-times mr-1"></i></button>
      </div>
      <label class="btn btn-orange ml-2">
        <input type="file" class="d-none btn-upload-photo" accept="image/x-png,image/gif,image/jpeg"><i class="fas fa-upload"></i>
      </label>
    </div>
    <div class="col text-center">
      <b>Foto del interior de la vivienda</b>
      <img src="" class="img-fluid">
      <div class="btn-group btn-group-sm mt-2">
        <button class="btn btn-success"><i class="fas fa-eye"></i></button>
        <button class="btn btn-info"><i class="fas fa-pencil-alt mr-1"></i></button>
        <button class="btn btn-danger"><i class="fas fa-times mr-1"></i></button>
      </div>
      <label class="btn btn-orange ml-2">
        <input type="file" class="d-none btn-upload-photo" accept="image/x-png,image/gif,image/jpeg"><i class="fas fa-upload"></i>
      </label>
    </div>
  </div>
</template>
<template id="template-enseres">
  <tr>
    <th rowspan="4">Electrónicos</th>
    <td>Computadoras</td>
    <td></td>
  </tr>
  <tr>
    <td>Pantallas</td>
    <td></td>
  </tr>
  <tr>
    <td>Laptop</td>
    <td></td>
  </tr>
  <tr>
    <td>Impresoras</td>
    <td></td>
  </tr>
  <tr>
    <th rowspan="5">Línea blanca</th>
    <td>Refrigerador</td>
    <td></td>
  </tr>
  <tr>
    <td>Estufa</td>
    <td></td>
  </tr>
  <tr>
    <td>Aire acondicionado</td>
    <td></td>
  </tr>
  <tr>
    <td>Lavadora</td>
    <td></td>
  </tr>
  <tr>
    <td>Secadora</td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td>Otros</td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td>¿Se observa mobiliario de uso cotidiano?</td>
    <td></td>
  </tr>
  <tr>
    <td>Comentarios</td>
    <td colspan="2"></td>
  </tr>
</template>
<template id="template-referencia">
  <div class="callout callout-orange">
    <button class="btn btn-danger btn-lg float-right"><i class="fas fa-trash"></i></button>
    <button class="btn btn-info btn-lg float-right"><i class="fas fa-pencil-alt"></i></button>
    <b>Tipo de referencia</b>
    <p></p>
    <b>Relación con el candidato</b>
    <p></p>
    <b>Nombre</b>
    <p></p>
    <div class="row">
      <div class="col-sm-6">
        <b>Teléfono</b>
        <p></p>
      </div>
      <div class="col-sm-6">
        <b>Domicilio de la referencia</b>
        <p></p>
      </div>
    </div>
    <b>¿Cuál es el domicilio del candidato?</b>
    <p></p>
    <div class="row">
      <div class="col-sm-6">
        <b>¿Cuánto tiempo tiene el candidato viviendo ahí?</b>
        <p></p>
      </div>
      <div class="col-sm-6">
        <b>¿Cuánto tiempo tiene de conocerlo?</b>
        <p></p>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6">
        <b>¿Sabe si tiene hijos?</b>
        <p></p>
      </div>
      <div class="col-sm-6">
        <b>¿Sabe a qué se dedica</b>
        <p></p>
      </div>
    </div>
    <b>¿Sabe sobre su estado civil?</b>
    <p></p>
    <b>Comentarios sobre el candidato</b>
    <p></p>
  </div>
    
  <hr>
</template>
<template id="template-ingreso">
  <tr>
    <th></th>
    <th></th>
    <td class="text-right"></td>
    <td class="text-center py-0 align-middle">
        <div class="btn-group btn-group-sm">
          <button class="btn btn-lg btn-info">
            <i class="fas fa-pencil-alt"></i>
          </button>
          <button class="btn btn-lg btn-danger">
            <i class="fas fa-trash"></i>
          </button>
        </div>
    </td>
  </tr>
</template>
<template id="template-egreso">
  <tr>
    <th></th>
    <td class="text-right"></td>
    <td class="text-center py-0 align-middle">
        <div class="btn-group btn-group-sm">
          <button class="btn btn-lg btn-info">
            <i class="fas fa-pencil-alt"></i>
          </button>
          <button class="btn btn-lg btn-danger">
            <i class="fas fa-trash"></i>
          </button>
        </div>
    </td>
  </tr>
</template>
<template id="template-totales-economia">
  <div class="row">
    <div class="col">
      <hr>
      <b>Total de ingresos</b>
    </div>
    <div class="col">
      <hr>
      <p class="text-right"></p>
    </div>
    <div class="col">
      <hr>
      <b>Total de egresos</b>
    </div>
    <div class="col">
      <hr>
      <p class="text-right"></p>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <hr>
      <b>Diferencia</b>
    </div>
    <div class="col">
      <hr>
      <p class="text-left"></p>
    </div>
  </div>
</template>
<template id="template-credito">
  <tr>
    <th></th>
    <td class="text-right"></td>
    <td class="text-right"></td>
    <td></td>
    <td class="text-right"></td>
    <td class="text-center py-0 align-middle">
        <div class="btn-group btn-group-sm">
          <button class="btn btn-lg btn-info">
            <i class="fas fa-pencil-alt"></i>
          </button>
          <button class="btn btn-lg btn-danger">
            <i class="fas fa-trash"></i>
          </button>
        </div>
    </td>
  </tr>
</template>
<template id="template-cuenta_bancaria">
  <tr>
    <th></th>
    <td></td>
    <td></td>
    <td class="text-right"></td>
    <td class="text-center py-0 align-middle">
        <div class="btn-group btn-group-sm">
          <button class="btn btn-lg btn-info">
            <i class="fas fa-pencil-alt"></i>
          </button>
          <button class="btn btn-lg btn-danger">
            <i class="fas fa-trash"></i>
          </button>
        </div>
    </td>
  </tr>
</template>
<template id="template-seguro">
  <tr>
    <th></th>
    <td></td>
    <td></td>
    <td class="text-right"></td>
    <td></td>
    <td class="text-center py-0 align-middle">
        <div class="btn-group btn-group-sm">
          <button class="btn btn-lg btn-info">
            <i class="fas fa-pencil-alt"></i>
          </button>
          <button class="btn btn-lg btn-danger">
            <i class="fas fa-trash"></i>
          </button>
        </div>
    </td>
  </tr>
</template>
<template id="template-inmueble">
  <tr>
    <th></th>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td class="text-center py-0 align-middle">
      <div class="btn-group btn-group-sm">
        <button class="btn btn-lg btn-info">
          <i class="fas fa-pencil-alt"></i>
        </button>
        <button class="btn btn-lg btn-danger">
          <i class="fas fa-trash"></i>
        </button>
      </div>
    </td>
  </tr>
</template>
<template id="template-vehiculo">
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td class="text-center py-0 align-middle">
      <div class="btn-group btn-group-sm">
        <button class="btn btn-lg btn-info">
          <i class="fas fa-pencil-alt"></i>
        </button>
        <button class="btn btn-lg btn-danger">
          <i class="fas fa-trash"></i>
        </button>
      </div>
    </td>
  </tr>
</template>
<template id="template-conclusiones">
  <b>Acerca del candidato</b>
  <p></p>
  <b>Acerca de su familia y entorno</b>
  <p></p>
  <b>Conclusiones del entrevistador</b>
  <p></p>
  <br>
  <div class="table-responsive">
    <table class="table table-sm text-nowrap">
      <thead>
        <tr>
          <th></th>
          <th class="text-center">Bueno</th>
          <th class="text-center">Regular</th>
          <th class="text-center">No aceptable</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th>Participación del candidato</th>
          <td class="text-center"></td>
          <td class="text-center"></td>
          <td class="text-center"></td>
        </tr>
        <tr>
          <th>Entorno familiar</th>
          <td class="text-center"></td>
          <td class="text-center"></td>
          <td class="text-center"></td>
        </tr>
        <tr>
          <th>Referencias personales</th>
          <td class="text-center"></td>
          <td class="text-center"></td>
          <td class="text-center"></td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<template id="template-comentarios_generales">
  <b>Comentarios generales de la verificación</b>
  <p></p>
  <table class="table table-sm text-nowrap">
      <thead>
        <tr>
          <th></th>
          <th class="text-center">Sí</th>
          <th class="text-center">No</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th>¿Atendió puntual y en fecha y hora acordada?</th>
          <td class="text-center"></td>
          <td class="text-center"></td>
        </tr>
        <tr>
          <th>¿Presentó la documentación solicitada?</th>
          <td class="text-center"></td>
          <td class="text-center"></td>
        </tr>
        <tr>
          <th>¿Se condujo con naturalidad y dominio?</th>
          <td class="text-center"></td>
          <td class="text-center"></td>
        </tr>
        <tr>
          <th>¿Sus respuestas fueron claras y seguras</th>
          <td class="text-center"></td>
          <td class="text-center"></td>
        </tr>
      </tbody>
  </table>
  <br>
  <b>Análisis de la Verificación</b>
  <p></p>
</template>
<template id="template-notas">
  <div class="card card-widget">
    <div class="card-header">
      <div class="user-block">
        <img src="#" class="img-circle img-sm">
        <span class="username"></span>
        <span class="description"></span>
      </div>
      <div class="card-tools">
        <button class="btn btn-tool btn-info" type="button">
          <i class="fas fa-pencil-alt"></i>
        </button>
        <button class="btn btn-tool btn-danger" type="button">
          <i class="fas fa-times"></i>
        </button>
      </div>
    </div>
    <div class="card-body">
      <p></p>
    </div>
  </div>
</template>
<script type="text/javascript" src="<?=base_url?>app/contenido_estudio.js?v=<?=rand()?>"></script>
<script src="<?=base_url?>app/servicioapoyo.js?v=<?=rand()?>"></script>
<script src="<?=base_url?>app/estudio.js?v=<?=rand()?>"></script>
<script src="<?=base_url?>app/servicio_apoyo-events.js?v=<?=rand()?>"></script>
	
<script src="<?= base_url ?>plugins/Sortable/Sortable.min.js?v=<?= rand() ?>"></script>
<script>
  const referencia = document.getElementById('content-referencias_laborales');
  Sortable.create(referencia, {
    animation: 150,
    swapThreshold: 1,
    easing: "cubic-bezier(0.895, 0.03, 0.685, 0.22)",
    handle: ".fas",
    chosenClass: "active",
    group: "lista-referencias",
    dataIdAttr: "renglon",
    store: {
      set: function(sortable) {
        const orden = sortable.toArray();
        let estudioObj= new Estudio()
        estudioObj.update_referencia_laboral_renglon(orden,referencia.className )
        //localStorage.setItem('lista-tareas', orden.join('|'));
      },

      get: function() {
        //const orden = localStorage.getItem('lista-tareas');
        //return orden ? orden.split('|') : [];
      }
    }
  })
</script>