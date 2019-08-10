
    <div class="modal fade bs-example-modal-lg-upd" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Editar Usuario</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" id="upd_user" name="upd_user">
                        <div id="result_user2"></div>
                        <input type="hidden" id="mod_id" name="mod_id">
                        <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                            <input name="mod_name" id="mod_name" type="text" class="form-control" required>
                            <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <input name="mod_email" id="mod_email" type="email" class="form-control has-feedback-left" required>
                            <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                        </div>
						
						<?php if ($kind_user == 1): ?>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <select class="form-control" required name="mod_status" id="mod_status">
                                    <option value="" selected>-- Selecciona Rol --</option>
                                    <option value="1" >Admin</option>
                                    <option value="3" >Técnico</option>
									<option value="2" >Usuario</option> 
                            </select>
                        </div>
						<div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Contraseña<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="password" id="password" name="password" class="form-control col-md-7 col-xs-12">
                                <p class="text-muted">La contraseña solo se modificara si escribes algo, en caso contrario no se modifica.</p>
                            </div>
                        </div>
						<?php endif; ?>
						
						<?php if ($kind_user == 3): ?>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="password">Contraseña<span class="required">*</span>
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <input type="password" id="password" name="password" class="form-control col-md-4 col-xs-12">
                                <p class="text-muted">La contraseña solo se modificara si escribes algo, en caso contrario no se modifica.</p>
                            </div>
                        </div>
						<?php endif; ?>
						
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                              <button id="upd_data" type="submit" class="btn btn-success">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div> <!-- /Modal -->