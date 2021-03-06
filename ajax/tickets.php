<?php
    session_start();    
    $id_kind = $_SESSION['kind'];
    $user_id = $_SESSION['user_id'];
?>
<?php

    include "../config/config.php";//Contiene funcion que conecta a la base de datos
    
    $action = (isset($_REQUEST['action']) && $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    if (isset($_GET['id'])){
        $id_del=intval($_GET['id']);
        $query=mysqli_query($con, "SELECT * from ticket where id='".$id_del."'");
        $count=mysqli_num_rows($query);

        if ($delete1=mysqli_query($con,"DELETE FROM ticket WHERE id='".$id_del."'")){
            ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Aviso!</strong> Datos eliminados exitosamente.
          </div>
          <?php 
      }else {
        ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
      </div>
      <?php
            } //end else
        } //end if
        ?>

        <?php
        if($action == 'ajax'){
        // escaping, additionally removing everything that could be (html/javascript-) code
           $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
         $aColumns = array('title');//Columnas de busqueda
         $sTable = "ticket";
         $sWhere = 'WHERE user_id = '.$user_id;

         if ($id_kind != 2) {
             $sWhere = '';
         }


         if ( $_GET['q'] != "" ) {
            $sWhere = "WHERE (";
            for ( $i=0 ; $i<count($aColumns) ; $i++ ) {
                $sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
            }
            $sWhere = substr_replace( $sWhere, "", -3 );
            if ($id_kind != 2) {
             $sWhere .= ')';
            } else{
                $sWhere .= ') AND user_id =' .$user_id;
            }
            
        }
        $sWhere.=" order by created_at desc";
        include 'pagination.php'; //include pagination file
        //pagination variables
        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
        $per_page = 10; //how much records you want to show
        $adjacents  = 4; //gap between pages after number of adjacents
        $offset = ($page - 1) * $per_page;
        //Count the total number of row in your table*/
        $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
        $row= mysqli_fetch_array($count_query);
        $numrows = $row['numrows'];
        $total_pages = ceil($numrows/$per_page);
        $reload = './expences.php';
        //main query to fetch the data
        $sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
        $query = mysqli_query($con, $sql);
        //loop through fetched data
        if ($numrows>0){

            ?>
            <table class="table table-striped jambo_table bulk_action" id="tickets">
                <thead>
                    <tr class="headings">
                        <?php if ($id_kind != 2): ?>  
                            <th class="column-title">Creado Por </th>
                        <?php endif; ?>
                        <th class="column-title">Asunto</th>
                        <th class="column-title">Empresa</th>
                        <th class="column-title">Prioridad</th>                        
                        <th>Fecha</th>
                        <th class="column-title">Estado </th>
                        <th class="column-title">Atendido Por</th>						
                        <th class="column-title no-link last"><span class="nobr"></span></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    while ($r=mysqli_fetch_array($query)) {
                        $id=$r['id'];
                        $created_at=date('d/m/Y', strtotime($r['created_at']));
                        $description=$r['description'];
                        $title=$r['title'];
                        $project_id=$r['project_id'];
                        $priority_id=$r['priority_id'];
                        $status_id=$r['status_id'];
                        $kind_id=$r['kind_id'];
                        $created_by=$r['user_id'];
                        $category_id=$r['category_id'];
                        $atendido_por=$r['atendido_por'];

                        $sql = mysqli_query($con, "select * from project where id=$project_id");
                        if($c=mysqli_fetch_array($sql)) {
                            $name_project=$c['name'];
                        }

                        $sql = mysqli_query($con, "select * from priority where id=$priority_id");
                        if($c=mysqli_fetch_array($sql)) {
                            $name_priority=$c['name'];
                        }

                        $sql = mysqli_query($con, "select * from status where id=$status_id");
                        if($c=mysqli_fetch_array($sql)) {
                            $name_status=$c['name'];
                        }

                        if ($id_kind != 2) {
                            $sql = mysqli_query($con, "select u.name from user u, ticket t where u.id=$created_by");
                            if($c=mysqli_fetch_array($sql)) {
                            $creado_por=$c['name'];
                            }
                        }



                        if ($atendido_por != null && !empty($atendido_por)) {
                            $sql = mysqli_query($con, "select u.name from user u, ticket t where u.id=$atendido_por");
                            if($c=mysqli_fetch_array($sql)) {
                                $name_atention=$c['name'];
                            }
                        } else {
                            $name_atention = '';
                        }

                        ?>
                        <input type="hidden" value="<?php echo $id;?>" id="id<?php echo $id;?>">
                        <input type="hidden" value="<?php echo $title;?>" id="title<?php echo $id;?>">
                        <input type="hidden" value="<?php echo $description;?>" id="description<?php echo $id;?>">
                        <!-- me obtiene los datos -->
                        <input type="hidden" value="<?php echo $kind_id;?>" id="kind_id<?php echo $id;?>">
                        <input type="hidden" value="<?php echo $project_id;?>" id="project_id<?php echo $id;?>">
                        <input type="hidden" value="<?php echo $category_id;?>" id="category_id<?php echo $id;?>">
                        <input type="hidden" value="<?php echo $priority_id;?>" id="priority_id<?php echo $id;?>">
                        <input type="hidden" value="<?php echo $status_id;?>" id="status_id<?php echo $id;?>">


                        <tr class="even pointer">
                            <?php if ($id_kind != 2): ?>  
                                <td><?php echo $creado_por;?></td>
                            <?php endif; ?>
                            <td><?php echo $title;?></td>
                            <td><?php echo $name_project; ?></td>
                            <td><?php echo $name_priority; ?></td>                        
                            <td><?php echo $created_at;?></td>
                            <td>
                             <?php if ($status_id == 1): ?>							
                                <span class="label label-danger"><?php echo $name_status;?></span>
                            <?php endif; ?>
                            <?php if ($status_id == 2): ?>							
                                <span class="label label-warning"><?php echo $name_status;?></span>
                            <?php endif; ?>	
                            <?php if ($status_id == 3): ?>							
                                <span class="label label-success"><?php echo $name_status;?></span>
                            <?php endif; ?>	
                            <?php if ($status_id == 4): ?>							
                                <span class="label label-default"><?php echo $name_status;?></span>
                            <?php endif; ?>	
                        </td>
                        <td>
                            <?php if ($name_atention != NULL): ?>
                               <?php echo $name_atention;?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if (($status_id == 1 && $id_kind == 2) || ($id_kind != 2)): ?>
                            <span class="pull-right">
                                <a href="#" class='btn btn-default' title='Editar producto' onclick="obtener_datos('<?php echo $id;?>');" data-toggle="modal" data-target=".bs-example-modal-lg-udp"><i class="glyphicon glyphicon-edit"></i></a> 
                                <a href="#" class='btn btn-default' title='Borrar producto' onclick="eliminar('<?php echo $id; ?>')"><i class="glyphicon glyphicon-trash"></i> </a>
                            </span>
                        <?php endif; ?> 
                    </td>
                </tr>
                <?php
                    } //en while
                    ?>
                    <tr>
                        <td colspan=8><span class="pull-right">
                            <?php echo paginate($reload, $page, $total_pages, $adjacents);?>
                        </span></td>
                    </tr>
                </table>
            </div>
            <?php
        }else{
         ?> 
         <div class="alert alert-warning alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Aviso!</strong> No hay datos para mostrar!
      </div>
      <?php    
  }
}
?>