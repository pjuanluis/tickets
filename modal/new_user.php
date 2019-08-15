<?php

    $ProjectData = mysqli_query($con, "select * from project");
?>

    <div> <!-- Modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg-add"><i class="fa fa-plus-circle"></i> Agregar Usuario</button>
    </div>
    <div class="modal fade bs-example-modal-lg-add" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Agregar Usuario</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" id="add_user" name="add_user">
                        <div id="result_user"></div>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <input name="name" required type="text" class="form-control" placeholder="Nombre">
                            <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <input name="lastname" type="text" class="form-control" placeholder="Apellidos" required>
                            <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <input name="email" type="email" class="form-control has-feedback-left" placeholder="Correo Electronico" required>
                            <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <select class="form-control" required name="rol">
                                <option value="" selected>-- Selecciona Rol --</option>
                                <?php if ($kind_user == 1): ?>
                                    <option value="1" >Admin</option>
                                    <option value="3" >Técnico</option>
                                <?php endif; ?>
                                <option value="2" >Usuario</option> 									
                            </select>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <select class="form-control" required name="empresa">
                                <option value="" selected>-- Selecciona Empresa --</option>
                                <?php foreach($ProjectData as $p):?>
                                    <option value="<?php echo $p['id']; ?>"><?php echo $p['name']; ?></option>
                                <?php endforeach; ?>                                
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="password" id="password" name="password" class="form-control col-md-6 col-xs-12" placeholder="Password *" maxlength="25" required>
                                <span class="fa fa-lock form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>                    
                    </div>
                    <div class="modal-footer">
                        <button id="save_data" type="submit" class="btn btn-success">Guardar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- /Modal -->