<div class="modal fade" id="modal_imagen">
    <div class="modal-dialog modal-lg" style="max-width: 1000px;">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Foto de perfil</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id">
                    <input type="hidden" name="id_employee" value="<?=isset($_GET['id']) ? Encryption::decode($_GET['id']) : 0?>">
                    <input type="hidden" name="file_name">
                    <input type="hidden" name="flag">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="img-container" style="max-height: 500px;">
                                <img src="" class="img-fluid" />
                            </div>
                        </div>
                    </div>
                    <div class="text-center docs-buttons mt-3">
                        <div class="btn-group">
                          <button type="button" class="btn bg-gradient-primary btn-lg" data-method="setDragMode" data-option="move" title="Move">
                            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.setDragMode(&quot;move&quot;)">
                              <span class="fa fa-arrows-alt"></span>
                            </span>
                          </button>
                          <button type="button" class="btn bg-gradient-primary btn-lg" data-method="setDragMode" data-option="crop" title="Crop">
                            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.setDragMode(&quot;crop&quot;)">
                              <span class="fa fa-crop-alt"></span>
                            </span>
                          </button>
                        </div>

                        <div class="btn-group">
                          <button type="button" class="btn bg-gradient-primary btn-lg" data-method="zoom" data-option="0.1" title="Zoom In">
                            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.zoom(0.1)">
                              <span class="fa fa-search-plus"></span>
                            </span>
                          </button>
                          <button type="button" class="btn bg-gradient-primary btn-lg" data-method="zoom" data-option="-0.1" title="Zoom Out">
                            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.zoom(-0.1)">
                              <span class="fa fa-search-minus"></span>
                            </span>
                          </button>
                        </div>

                        <div class="btn-group">
                          <button type="button" class="btn bg-gradient-primary btn-lg" data-method="move" data-option="-10" data-second-option="0" title="Move Left">
                            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.move(-10, 0)">
                              <span class="fa fa-arrow-left"></span>
                            </span>
                          </button>
                          <button type="button" class="btn bg-gradient-primary btn-lg" data-method="move" data-option="10" data-second-option="0" title="Move Right">
                            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.move(10, 0)">
                              <span class="fa fa-arrow-right"></span>
                            </span>
                          </button>
                          <button type="button" class="btn bg-gradient-primary btn-lg" data-method="move" data-option="0" data-second-option="-10" title="Move Up">
                            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.move(0, -10)">
                              <span class="fa fa-arrow-up"></span>
                            </span>
                          </button>
                          <button type="button" class="btn bg-gradient-primary btn-lg" data-method="move" data-option="0" data-second-option="10" title="Move Down">
                            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.move(0, 10)">
                              <span class="fa fa-arrow-down"></span>
                            </span>
                          </button>
                        </div>

                        <div class="btn-group">
                          <button type="button" class="btn bg-gradient-primary btn-lg" data-method="rotate" data-option="-45" title="Rotate Left">
                            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.rotate(-45)">
                              <span class="fa fa-undo-alt"></span>
                            </span>
                          </button>
                          <button type="button" class="btn bg-gradient-primary btn-lg" data-method="rotate" data-option="45" title="Rotate Right">
                            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.rotate(45)">
                              <span class="fa fa-redo-alt"></span>
                            </span>
                          </button>
                        </div>

                        <div class="btn-group">
                          <button type="button" class="btn bg-gradient-primary btn-lg" data-method="scaleX" data-option="-1" title="Flip Horizontal">
                            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.scaleX(-1)">
                              <span class="fa fa-arrows-alt-h"></span>
                            </span>
                          </button>
                          <button type="button" class="btn bg-gradient-primary btn-lg" data-method="scaleY" data-option="-1" title="Flip Vertical">
                            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.scaleY(-1)">
                              <span class="fa fa-arrows-alt-v"></span>
                            </span>
                          </button>
                        </div>
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
<div class="modal fade" id="modal_ver_imagen">
    <div class="modal-dialog modal-lg" style="max-width: 1000px;">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Imagen</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Imagen">
                    <input type="hidden" name="flag">
                    <div class="img-container">
                        <img src="" style="display: block; max-width: 100%; height: auto;" />
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <a href="#" download="imagen" class="btn btn-primary">Descargar</a>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_delete_imagen">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Eliminar imagen</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_employee" value="<?=isset($_GET['id']) ? Encryption::decode($_GET['id']) : 0?>">
                    <p></p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <input type="submit" name="submit" class="btn btn-danger" value="Eliminar">
                </div>
            </form>
        </div>
    </div>              
</div>
<div class="modal fade" id="modal_documento">
    <div class="modal-dialog modal-lg" style="max-width: 1000px;">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Documento</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id">
                    <input type="hidden" name="id_employee" value="<?=isset($_GET['id']) ? ($_GET['id']) : 0?>">
                    <input type="hidden" name="file_name">
                    <input type="hidden" name="document">
                    <input type="hidden" name="flag">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="img-container" style="max-height: 500px;">
                                <img src="" class="img-fluid" />
                            </div>
                        </div>
                    </div>
                    <div class="text-center docs-buttons mt-3">
                        <div class="btn-group">
                          <button type="button" class="btn bg-gradient-primary btn-lg" data-method="setDragMode" data-option="move" title="Move">
                            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.setDragMode(&quot;move&quot;)">
                              <span class="fa fa-arrows-alt"></span>
                            </span>
                          </button>
                          <button type="button" class="btn bg-gradient-primary btn-lg" data-method="setDragMode" data-option="crop" title="Crop">
                            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.setDragMode(&quot;crop&quot;)">
                              <span class="fa fa-crop-alt"></span>
                            </span>
                          </button>
                        </div>

                        <div class="btn-group">
                          <button type="button" class="btn bg-gradient-primary btn-lg" data-method="zoom" data-option="0.1" title="Zoom In">
                            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.zoom(0.1)">
                              <span class="fa fa-search-plus"></span>
                            </span>
                          </button>
                          <button type="button" class="btn bg-gradient-primary btn-lg" data-method="zoom" data-option="-0.1" title="Zoom Out">
                            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.zoom(-0.1)">
                              <span class="fa fa-search-minus"></span>
                            </span>
                          </button>
                        </div>

                        <div class="btn-group">
                          <button type="button" class="btn bg-gradient-primary btn-lg" data-method="move" data-option="-10" data-second-option="0" title="Move Left">
                            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.move(-10, 0)">
                              <span class="fa fa-arrow-left"></span>
                            </span>
                          </button>
                          <button type="button" class="btn bg-gradient-primary btn-lg" data-method="move" data-option="10" data-second-option="0" title="Move Right">
                            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.move(10, 0)">
                              <span class="fa fa-arrow-right"></span>
                            </span>
                          </button>
                          <button type="button" class="btn bg-gradient-primary btn-lg" data-method="move" data-option="0" data-second-option="-10" title="Move Up">
                            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.move(0, -10)">
                              <span class="fa fa-arrow-up"></span>
                            </span>
                          </button>
                          <button type="button" class="btn bg-gradient-primary btn-lg" data-method="move" data-option="0" data-second-option="10" title="Move Down">
                            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.move(0, 10)">
                              <span class="fa fa-arrow-down"></span>
                            </span>
                          </button>
                        </div>

                        <div class="btn-group">
                          <button type="button" class="btn bg-gradient-primary btn-lg" data-method="rotate" data-option="-45" title="Rotate Left">
                            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.rotate(-45)">
                              <span class="fa fa-undo-alt"></span>
                            </span>
                          </button>
                          <button type="button" class="btn bg-gradient-primary btn-lg" data-method="rotate" data-option="45" title="Rotate Right">
                            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.rotate(45)">
                              <span class="fa fa-redo-alt"></span>
                            </span>
                          </button>
                        </div>

                        <div class="btn-group">
                          <button type="button" class="btn bg-gradient-primary btn-lg" data-method="scaleX" data-option="-1" title="Flip Horizontal">
                            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.scaleX(-1)">
                              <span class="fa fa-arrows-alt-h"></span>
                            </span>
                          </button>
                          <button type="button" class="btn bg-gradient-primary btn-lg" data-method="scaleY" data-option="-1" title="Flip Vertical">
                            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.scaleY(-1)">
                              <span class="fa fa-arrows-alt-v"></span>
                            </span>
                          </button>
                        </div>
                    </div>
                        
                    <div class="form-group">
                        <label class="col-form-label" for="Folio_Origen">Documento</label>
                        <select class="form-control" name="Folio_Origen">
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