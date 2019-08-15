<?php

    $ProjectData = mysqli_query($con, "select * from project");
?>
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
                            <select class="form-control" name="mod_status" id="mod_status" required>
                                <option value="" selected>-- Selecciona Rol --</option>
                                <option value="1" >Admin</option>
                                <option value="3" >Técnico</option>
                                <option value="2" >Usuario</option> 
                            </select>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <select class="form-control" required name="mod_empresa" id="mod_empresa">
                                <option value="" selected>-- Selecciona Empresa --</option>
                                <?php foreach($ProjectData as $p):?>
                                    <option value="<?php echo $p['id']; ?>"><?php echo $p['name']; ?></option>
                                <?php endforeach; ?>                                
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-1o col-xs-6">
                                <input type="password" id="password" name="password" class="form-control col-md-6 col-xs-6" placeholder="Password">
                                <p class="text-muted">La contraseña solo se modificara si escribes algo, en caso contrario no se modifica.</p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($kind_user == 3): ?>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <select class="form-control" required name="mod_empresa" id="mod_empresa">
                                <option value="" selected>-- Selecciona Empresa --</option>
                                <?php foreach($ProjectData as $p):?>
                                    <option value="<?php echo $p['id']; ?>"><?php echo $p['name']; ?></option>
                                <?php endforeach; ?>                                
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="password" id="password" name="password" class="form-control col-md-6 col-xs-12" placeholder="Password">
                                <p class="text-muted">La contraseña solo se modificara si escribes algo, en caso contrario no se modifica.</p>
                            </div>
                        </div>
                    <?php endif; ?>                
                    
                </div>
                <div class="modal-footer">
                    <button id="upd_data" type="submit" class="btn btn-success">Guardar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
    </div> <!-- /Modal -->