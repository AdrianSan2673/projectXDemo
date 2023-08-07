<div class="modal fade" id="modal_cancelacion">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title">Comentarios de la cancelación</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Folio">
                    <input type="hidden" name="Servicio_Solicitado">
                    <input type="hidden" name="Fase">
                    <input type="hidden" name="Estado">
                    <input type="hidden" name="Finalizado">
                    <div class="form-group">
                        <h6></h6>
                        <br>
                        <label class="col-form-label" for="Comentario_Cancelacion"></label>
                        <textarea name="Comentario_Cancelacion" class="form-control" rows="7" maxlength="500"></textarea>
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
<div class="modal fade" id="modal_finalizacion">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header bg-success">
                    <h4 class="modal-title">Comentarios del servicio</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Folio">
                    <input type="hidden" name="Servicio_Solicitado">
                    <input type="hidden" name="Fase">
                    <input type="hidden" name="Estado">
                    <div class="form-group">
                        <h6></h6>
                        <br>
                        <label class="col-form-label" for="Comentario_Finalizacion"></label>
                        <textarea name="Comentario_Finalizacion" class="form-control" rows="7" maxlength="500"></textarea>
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
<div class="modal fade" id="modal_avanzar">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header bg-success">
                    <h4 class="modal-title">Continuar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Folio">
                    <input type="hidden" name="Servicio_Solicitado">
                    <input type="hidden" name="Fase">
                    <input type="hidden" name="Estado">
                    <div class="form-group">
                        <h6></h6>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" class="btn btn-orange" value="Aceptar">
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_reactivar">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Reactivar servicio</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Folio">
                    <input type="hidden" name="Factura">
                    <input type="hidden" name="Fase">
                    <input type="hidden" name="Estado">
                    <p>¿Estás seguro de que deseas reactivar el siguiente servicio?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" class="btn btn-orange" value="Aceptar">
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_eliminar">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Eliminar servicio</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Folio">
                    <input type="hidden" name="Factura">
                    <input type="hidden" name="Fase">
                    <input type="hidden" name="Estado">
                    <p>¿Estás seguro de que deseas eliminar el servicio?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" class="btn btn-orange" value="Aceptar">
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_pausar">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header bg-warning">
                    <h4 class="modal-title">Pausa del servicio</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Folio">
                    <input type="hidden" name="Servicio_Solicitado">
                    <input type="hidden" name="Fase">
                    <input type="hidden" name="Estado">
                    <div class="form-group">
                        <h6></h6>
                        <br>
                        <label class="col-form-label" for="Comentario_Pausa"></label>
                        <textarea name="Comentario_Pausa" class="form-control" rows="7" maxlength="500"></textarea>
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
<div class="modal fade" id="modal_reanudar">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header bg-navy">
                    <h4 class="modal-title">Reanudación del servicio</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Folio">
                    <input type="hidden" name="Servicio_Solicitado">
                    <input type="hidden" name="Fase">
                    <input type="hidden" name="Estado">
                    <div class="form-group">
                        <h6></h6>
                        <br>
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