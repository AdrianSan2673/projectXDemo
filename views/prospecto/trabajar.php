<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-1">
                <div class="col-sm-12">
                    <div class="alert alert-success">
                        <h4>Trabajar Prospecto</h4>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#tab_1" id="li1" data-toggle="tab">Trabajar prospecto</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#tab_2" id="li2" data-toggle="tab">Elaborar propuesta</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    <form name="trabajar-prospecto-form" id="trabajar-prospecto-form">
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Fecha de alta</label>
                                            <input type="number" name="ID" id="ID" hidden value="<?=isset($prospecto) && is_object($prospecto) ? $prospecto->ID : ''; ?>">
                                            <input type="number" name="ID_Prospecto" id="ID_Prospecto" hidden value="<?=isset($prospecto) && is_object($prospecto) ? $prospecto->ID_Prospecto : ''; ?>">
                                            <input ID="Fecha" class="col-md-9 form-control" type="date" readonly>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-md-3 col-form-label">Prospecto:</label>
                                            <input type="text" name="Prospecto" id="Prospecto" class="col-md-9 form-control" value="<?=isset($prospecto) && is_object($prospecto) ? $prospecto->Prospecto : ''; ?>" readonly>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-md-3 col-form-label">Giro:</label>
                                            <input type="text" name="Giro" id="Giro" class="col-md-9 form-control" value="<?=isset($prospecto) && is_object($prospecto) ? $prospecto->Giro : ''; ?>" readonly>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Plaza:</label>
                                            <select name="Plaza" id="Plaza" class="col-md-9 form-control" readonly>
                                              <option value=""></option>
                                              <option value="TAM" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Plaza == 'TAM' ? 'selected' : ''; ?>>TAM</option>
                                              <option value="SLP" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Plaza == 'SLP' ? 'selected' : ''; ?>>SLP</option>
                                              <option value="MTY" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Plaza == 'MTY' ? 'selected' : ''; ?>>MTY</option>
                                            </select>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Tipo de cliente:</label>
                                            <select class="col-md-9 form-control" name="Tipo" id="Tipo" readonly>
                                              <option value=""></option>
                                              <option value="Real" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Tipo == 'Real' ? 'selected' : ''; ?>>Real</option>
                                              <option value="Potencial" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Tipo == 'Potencial' ? 'selected' : ''; ?>>Potencial</option>
                                              <option value="BI" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Tipo == 'BI' ? 'selected' : ''; ?>>BI</option>
 <option value="CDMX" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Plaza == 'CDMX' ? 'selected' : ''; ?>>CDMX</option>

                                            </select>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-md-3 col-form-label">Nombre del contacto:</label>
                                            <input type="text" name="Contacto" id="Contacto" class="col-md-9 form-control" value="<?=isset($prospecto) && is_object($prospecto) ? $prospecto->Contacto_RH : ''; ?>" readonly maxlength="80">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Puesto:</label>
                                            <input type="text" name="Puesto" class="col-md-9 form-control" value="<?=isset($prospecto) && is_object($prospecto) ? $prospecto->Puesto : ''; ?>" maxlength="40" readonly>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Teléfono:</label>
                                            <input type="text" name="Telefono" id="Telefono" maxlength="30" class="col-md-9 form-control" value="<?=isset($prospecto) && is_object($prospecto) ? $prospecto->Telefono : ''; ?>" readonly>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Correo:</label>
                                            <input type="email" name="Correo" id="Correo" maxlength="60" class="col-md-9 form-control" value="<?=isset($prospecto) && is_object($prospecto) ? $prospecto->Correo : ''; ?>" readonly>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">¿Quién es su proveedor actual?</label>
                                            <input type="text" name="Proveedor_Actual" id="Proveedor_Actual" class="col-md-9 form-control" value="<?=isset($prospecto) && is_object($prospecto) ? $prospecto->Proveedor_Actual : ''; ?>" maxlength="50">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-md-6 col-form-label">¿Qué servicio utiliza actualmente con ellos?</label>
                                                    <select name="Servicio" id="Servicio" class="col-md-6 form-control">
                                                      <option value="">Selecciona un servicio</option>
                                                      <option value="ESE" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Servicio == 'ESE' ? 'selected' : ''; ?>>ESE</option>
                                                      <option value="INV" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Servicio == 'INV' ? 'selected' : ''; ?>>Inv Lab</option>
                                                      <option value="RAL" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Servicio == 'RAL' ? 'selected' : ''; ?>>RAL</option>
                                                      <option value="Reclutamiento" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Servicio == 'Reclutamiento' ? 'selected' : ''; ?>>Reclutamiento</option>
                                                      <option value="Atraccion" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Servicio == 'Atraccion' ? 'selected' : ''; ?>>Atracción de talento</option>
                                                      <option value="Psicometria" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Servicio == 'Psicometria' ? 'selected' : ''; ?>>Psicometría</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-md-6 col-form-label">¿Algún otro servicio?</label>
                                                    <input type="text" name="Servicio_Que_Utiliza" id="Servicio_Que_Utiliza" class="col-md-6 form-control" value="<?=isset($prospecto) && is_object($prospecto) ? $prospecto->Servicio_Que_Utiliza : ''; ?>">
                                                </div>
                                            </div>
                                        </div>
                                                
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-md-6 col-form-label">Tipo de vacantes</label>
                                                    <select name="Tipo_Vacantes" id="Tipo_Vacantes" class="col-md-6 form-control">
                                                      <option value=""></option>
                                                      <option value="Comun" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Tipo_Vacantes == 'Comun' ? 'selected' : ''; ?>>Orden común</option>
                                                      <option value="Especializada" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Tipo_Vacantes == 'Especializada' ? 'selected' : ''; ?>>Especializada</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-md-6 col-form-label">Valor de la vacante</label>
                                                    <input type="text" name="Valor_Vacante" id="Valor_Vacante" class="col-md-6 form-control" value="<?=isset($prospecto) && is_object($prospecto) ? round($prospecto->Valor_Vacante) : ''; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">¿Qué precio le ofrecen?</label>
                                            <input type="text" name="Precio_Ofrecido" id="Precio_Ofrecido" class="col-md-9 form-control" value="<?=isset($prospecto) && is_object($prospecto) ? round($prospecto->Precio_Ofrecido) : ''; ?>">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">¿Qué tiempo de entrega le ofrecen? (no. de días)</label>
                                            <input type="number" name="Tiempo_Entrega" id="Tiempo_Entrega" class="col-md-9 form-control" value="<?=isset($prospecto) && is_object($prospecto) ? $prospecto->Tiempo_Entrega : ''?>">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">¿Cuál es el no. promedio de servicios que solicita en el mes?</label>
                                            <input type="number" name="Promedio_Servicios" id="Promedio_Servicios" class="col-md-9 form-control" value="<?=isset($prospecto) && is_object($prospecto) ? $prospecto->Promedio_Servicios : ''; ?>">
                                        </div>
                                        <br />
                                        <hr />
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="col-form-label">¿Cuál fue tu oferta?</label>
                                                    <input type="text" name="Oferta1" id="Oferta1" class="form-control" value="<?=isset($prospecto) && is_object($prospecto) ? $prospecto->Oferta1 : ''; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="col-form-label">Precio</label>
                                                    <input type="text" name="Precio1" id="Precio1" class="form-control" value="<?=isset($prospecto) && is_object($prospecto) ? round($prospecto->Precio1) : ''; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="col-form-label">Tiempo de entrega</label>
                                                    <select name="Tiempo1" id="Tiempo1" class="form-control">
                                                      <option value=""></option>
                                                      <option value="Estandar" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Tiempo1 == 'Estandar' ? 'selected' : ''; ?>>Estándar (24 a 48hrs)</option>
                                                      <option value="Extendido" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Tiempo1 == 'Extendido' ? 'selected' : ''; ?>>Extendido (5 días) Reclutamiento</option>
                                                      <option value="Especial" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Tiempo1 == 'Especial' ? 'selected' : ''; ?>>Especial (especificar)</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="col-form-label">Especificar</label>
                                                    <input type="text" name="Especificar1" id="Especificar1" class="form-control" value="<?=isset($prospecto) && is_object($prospecto) ? $prospecto->Especificar1 : ''; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="col-form-label">Garantía</label>
                                                    <input type="text" name="Garantia1" id="Garantia1" class="form-control" value="<?=isset($prospecto) && is_object($prospecto) ? $prospecto->Garantia1 : ''; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="col-form-label">¿Cuál fue tu oferta?</label>
                                                    <input type="text" name="Oferta2" id="Oferta2" class="form-control" value="<?=isset($prospecto) && is_object($prospecto) ? $prospecto->Oferta2 : ''; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="col-form-label">Precio</label>
                                                    <input type="text" name="Precio2" id="Precio2" class="form-control" value="<?=isset($prospecto) && is_object($prospecto) ? round($prospecto->Precio2) : ''; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="col-form-label">Tiempo de entrega</label>
                                                    <select name="Tiempo2" id="Tiempo2" class="form-control">
                                                      <option value=""></option>
                                                      <option value="Estandar" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Tiempo2 == 'Estandar' ? 'selected' : ''; ?>>Estándar (24 a 48hrs)</option>
                                                      <option value="Extendido" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Tiempo2 == 'Extendido' ? 'selected' : ''; ?>>Extendido (5 días) Reclutamiento</option>
                                                      <option value="Especial" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Tiempo2 == 'Especial' ? 'selected' : ''; ?>>Especial (especificar)</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="col-form-label">Especificar</label>
                                                    <input type="text" name="Especificar2" id="Especificar2" class="form-control" value="<?=isset($prospecto) && is_object($prospecto) ? $prospecto->Especificar2 : ''; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="col-form-label">Garantía</label>
                                                    <input type="text" name="Garantia2" id="Garantia2" class="form-control" value="<?=isset($prospecto) && is_object($prospecto) ? $prospecto->Garantia2 : ''; ?>">
                                                </div>
                                            </div>

                                        </div>
                                        <hr />
                                        <br />
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Acuerdos</label>
                                            <select name="Acuerdos" id="Acuerdos" class="col-md-9 form-control">
                                              <option value=""></option>
                                              <option value="cortesia" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Acuerdos == 'cortesia' ? 'selected' : ''; ?>>Servicio de cortesía</option>
                                              <option value="cliente" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Acuerdos == 'cliente' ? 'selected' : ''; ?>>Alta como cliente</option>
                                              <option value="propuesta" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Acuerdos == 'propuesta' ? 'selected' : ''; ?>>Propuesta por escrito</option>
                                            </select>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Comentarios</label>
                                            <input type="text" name="Comentarios_Acuerdos" id="Comentarios_Acuerdos" class="col-md-9 form-control" value="<?=isset($prospecto) && is_object($prospecto) ? $prospecto->Comentarios_Acuerdos : ''; ?>">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Fecha del último contacto</label>
                                            <input type="date" name="Fecha_Propuesta" id="Fecha_Propuesta" disabled class="col-md-9 form-control">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Siguiente paso</label>
                                            <select name="Acciones" id="Acciones" class="col-md-9 form-control">
                                              <option value=""></option>
                                              <option value="Prospeccion" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Acciones == 'Prospeccion' ? 'selected' : ''; ?> disabled>Prospección</option>
                                              <option value="Contacto" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Acciones == 'Contacto' ? 'selected' : ''; ?> disabled>Primer contacto</option>
                                              <option value="Entrevista" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Acciones == 'Entrevista' ? 'selected' : ''; ?>>Entrevista de ventas</option>
                                              <option value="Cortesia" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Acciones == 'Cortesia' ? 'selected' : ''; ?>>Servicio de cortesía</option>
                                              <option value="Cliente" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Acciones == 'Cliente' ? 'selected' : ''; ?>>Alta como cliente</option>
                                              <option value="Propuesta" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Acciones == 'Propuesta' ? 'selected' : ''; ?>>Propuesta enviada</option>
                                              <option value="Seguimiento" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Acciones == 'Seguimiento' ? 'selected' : ''; ?>>Mantener seguimiento</option>
                                            </select>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3">Comentarios:</label>
                                            <textarea name="Acciones_Realizadas" id="Acciones_Realizadas" class="col-md-9 form-control" rows="5"><?=isset($prospecto) && is_object($prospecto) ? $prospecto->Acciones_Realizadas : ''; ?></textarea>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Periodicidad del seguimiento</label>
                                            <select name="Periodicidad" id="Periodicidad" class="col-md-9 form-control">
                                            <option value=""></option>
                                            <option value="Diaria" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Periodicidad == 'Diaria' ? 'selected' : ''; ?>>Diaria</option>
                                            <option value="3dia" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Periodicidad == '3dia' ? 'selected' : ''; ?>>Cada 3er día</option>
                                            <option value="Semanal" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Periodicidad == 'Semanal' ? 'selected' : ''; ?>>Semanal</option>
                                            <option value="Mensual" <?=isset($prospecto) && is_object($prospecto) && $prospecto->Periodicidad == 'Mensual' ? 'selected' : ''; ?>>Mensual</option>
                                            </select>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3">¿Cuándo daremos seguimiento:</label>
                                            <input type="date" name="Fecha_Prox_Seguimiento" id="Fecha_Prox_Seguimiento" class="col-md-9 form-control" value="<?=isset($prospecto) && is_object($prospecto) ? $prospecto->Fecha_Prox_Seguimiento : ''; ?>">
                                        </div>
                                        <br />
                                        <div class="form-group">
                                            <a class="btn btn-info float-left" href="javascript: history.back()">Regresar</a>
                                            <input type="submit" name="submit" id="submit" class="btn btn-success float-right" value="Guardar">
											<a class="btn btn-warning float-center ml-3" href="<?=base_url?>empresa_SA/save_prospecto&prospecto=<?=Encryption::encode($prospecto->ID)?>">Alta como Empresa y Cliente SA</a>
                                            <a class="btn btn-warning float-center ml-3" href="<?=base_url?>cliente_SA/crear&prospecto=<?=Encryption::encode($prospecto->ID)?>">Alta como Cliente SA</a>
											<a class="btn btn-orange float-center ml-3" href="<?=base_url?>cliente/crear&prospecto=<?=Encryption::encode($prospecto->ID)?>">Alta como Cliente Reclutamiento</a>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="tab_2">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Dirigida a:</label>
                                        <input type="text" name="dirigida" class="col-md-9 form-control" value="<?=isset($prospecto) && is_object($prospecto) ? $prospecto->Contacto_RH : ''; ?>" readonly>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Puesto:</label>
                                        <input type="text" name="position" id="position" class="col-md-9 form-control" value="<?=isset($prospecto) && is_object($prospecto) ? $prospecto->Puesto : ''; ?>" readonly>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Empresa</label>
                                        <input type="text" name="Empresa" id="Empresa" class="col-md-9 form-control" value="<?=isset($prospecto) && is_object($prospecto) ? $prospecto->Prospecto : ''; ?>" readonly>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form name="reclutamiento-form" id="reclutamiento-form" action="./propuesta_reclutamiento" method="POST" target="_blank" class="form-group row">
                                                <input type="hidden" name="id_prospecto" value="<?=$_GET['id']?>">
                                                <label class="col-md-3 col-form-label">Cuota reclutamiento:</label>
                                                <input type="number" name="Cuota_Reclutamiento" id="Cuota_Reclutamiento" class="col-md-1 form-control" max="100" min="0" required  value="<?=isset($prospecto) && is_object($prospecto) ? $prospecto->Cuota_Reclutamiento : ''; ?>">
                                                <label class="col-md-2 col-form-label">Garantía de renuncia:</label>
                                                <input type="text" name="Garantia_Renuncia" id="Garantia_Renuncia" class="col-md-3 form-control" max="100" min="0" required  value="<?=isset($prospecto) && is_object($prospecto) ? $prospecto->Garantia_Renuncia : ''; ?>">
                                                <input type="submit" name="submit_reclutamiento" id="submit_reclutamiento" class="btn btn-success ml-auto" value="Generar propuesta reclutamiento">
                                            </form>
                                            <form name="atraccion-form" id="atraccion-form" action="./propuesta_atraccion_talento" method="POST" target="_blank" class="form-group row">
                                                <input type="hidden" name="id_prospecto" value="<?=$_GET['id']?>">
                                                <label class="col-md-3 col-form-label">Precio atraccion de talento</label>
                                                <input type="number" name="Precio_Atraccion" id="Precio_Atraccion" class="col-md-1 form-control" required value="<?=isset($prospecto) && is_object($prospecto) ? round($prospecto->Precio_Atraccion) : ''; ?>">
                                                <input type="submit" name="submit_atraccion" id="submit_atraccion" class="btn btn-orange ml-auto" value="Generar propuesta de AT">
                                            </form>
                                            <form name="psicometrias-form" id="psicometrias-form" action="./propuesta_psicometrias" method="POST" target="_blank" class="form-group row">
                                                <input type="hidden" name="id_prospecto" id="id_prospecto" value="<?=$_GET['id']?>">
                                                <label class="col-md-3 col-form-label">Precio psicometría por persona</label>
                                                <input type="number" name="Precio_Psicometria" id="Precio_Psicometria" class="col-md-1 form-control" required value="<?=isset($prospecto) && is_object($prospecto) ? round($prospecto->Precio_Psicometria) : ''; ?>">
                                                <input type="submit" name="submit_psicometrias" id="submit_psicometrias" class="btn btn-info ml-auto" value="Generar propuesta de psicometrías">
                                            </form>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form name="sa-form" id="sa-form" action="./propuesta_sa" method="POST" target="_blank" class="form-group row">
                                                <input type="hidden" name="id_prospecto" value="<?=$_GET['id']?>">
                                                <label class="col-md-2 col-form-label">Precio hasta RAL:</label>
                                                <input type="number" name="Precio_RAL" id="Precio_RAL" class="col-md-1 form-control" min="0" required  value="<?=isset($prospecto) && is_object($prospecto) ? round($prospecto->Precio_RAL) : ''; ?>">
                                                <label class="col-md-2 col-form-label">Precio hasta INV. LAB.:</label>
                                                <input type="number" name="Precio_Inv" id="Precio_Inv" class="col-md-1 form-control"  min="0" required  value="<?=isset($prospecto) && is_object($prospecto) ? round($prospecto->Precio_Inv) : ''; ?>">
                                                <label class="col-md-2 col-form-label">Precio hasta Verificación domiciliar:</label>
                                                <input type="number" name="Precio_ESE" id="Precio_ESE" class="col-md-1 form-control"  min="0" required  value="<?=isset($prospecto) && is_object($prospecto) ? round($prospecto->Precio_ESE) : ''; ?>">
                                                <input type="submit" name="submit_sa" id="submit_sa" class="btn btn-danger ml-auto" value="Generar propuesta SA">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
</div>
<script src="<?=base_url?>app/prospecto.js?v=<?=rand()?>"></script>
<?php if (isset($prospecto) && !empty($prospecto->ID_Prospecto)): ?>
<script type="text/javascript">
  document.querySelector('#trabajar-prospecto-form').addEventListener('submit', e =>{
    e.preventDefault();
    let prospecto = new Prospecto();
    prospecto.update_work();
  });
</script>
<?php else: ?>
<script type="text/javascript">
  document.querySelector('#trabajar-prospecto-form').addEventListener('submit', e =>{
    e.preventDefault();
    document.querySelector("#submit").disabled = true;
    let prospecto = new Prospecto();
    prospecto.create_work();
  });
</script>
<?php endif ?>