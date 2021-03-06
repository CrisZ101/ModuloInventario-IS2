<!DOCTYPE html>
<?php
session_start();
include_once '../../Model/Ajustes/CabeceraAjuste.php';
include_once '../../Model/Ajustes/AjustesModel.php';
$ajustesModel = new AjustesModel();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ajustes</title>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">				

        <!--Importación de Bootstrap al proyecto-->
        <script src="../../Bootstrap/js/jquery-2.1.4.js"></script>
        <script src="../../Bootstrap/js/bootstrap.js"></script>
        <script src="../../Bootstrap/js/bootstrap-table.js"></script>
        <link href="../../Bootstrap/css/bootstrap-table.css" rel="stylesheet">
         <script src="../../Bootstrap/js/validaciones.js"></script>
        <link href="../../Bootstrap/css/bootstrap.css" rel="stylesheet" />
        <link rel="../../stylesheet" href="Bootstrap/css/bootstrap-theme.css">
        <style type="text/css">
            div{
                font-family: Calibri Light;
            }
        </style>
    </head>
    <body>
        <div class="container-fluid">
            <!--Título de la página-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-12" style="border-bottom: 1px solid #c5c5c5">
                         <h1><span class="glyphicon glyphicon-cog"></span> AJUSTES</h1></div>
                </div>
            </div>

            <!--La clase col nos permite que la pagina sea responsive mediante numero de columnas
                 donde el total de columnas es 12 y
                 donde lg es en tamaño de escritorio, md medianos, sm tablets, xs celulares -->

            <div class="row">
                <div class="col-md-12" style="padding-top: 5px">
                    <!--La class nav nav-pills nos permite hacer menús-->
                    <ul class="nav nav-pills">
                        <li role="presentation"><a href="../../Controller/controller.php?opcion1=ajuste&opcion2=listar_ajustes"><h4>MOSTRAR TODOS</h4></a></li>
                        <li role="presentation"><a href="#nuevoAJU" data-toggle="modal"><h4>NUEVO AJUSTE</h4></a></li>
                        <!--<li role="presentation"><a href="nuevoAjuste.php"><h4>NUEVO AJUSTE</h4></a></li>-->
                    </ul>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-info">
                        <div class="panel-heading"><h4>Lista de Ajustes</h4></div>
                        <div class="panel-body">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-condensed table-hover">
                                        <thead>
                                            <tr>
                                        <th>CODIGO AJUSTE</th>
                                        <th>MOTIVO AJUSTE</th>
                                        <th>FECHA AJUSTE</th>
                                        <th colspan="2">ACCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        // Verificamos si existe la variable de sesión que contiene la lista de Usuarios
                                        if (isset($_SESSION['listadoAjustes'])) {
                                            // Deserializamos y mostraremos los atributos de los usuarios usando un ciclo for
                                            $listado = unserialize($_SESSION['listadoAjustes']);
                                            foreach ($listado as $aju) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $aju->getID_AJUSTE_PROD(); ?></td>
                                                    <td><?php echo $aju->getMOTIVO_AJUSTE_PROD() ?></td>
                                                    <td><?php echo $aju->getFECHA_AJUSTE_PROD() ?></td>
                                                    <!--<td><?php echo "<a href='../../Controller/controller.php?opcion1=ajuste&opcion2=editar_ajuste&ID_AJUSTE_PROD=" . $aju->getID_AJUSTE_PROD()."'>Editaaar</a>";?></td>-->
                                                    <!--<td align="center"><li role="presentation"><a href=#editAJU" data-toggle="modal">Editar</a></li></td>-->
                                                    <td align="center"><a href=""><span class="glyphicon glyphicon-pencil">Editar</span></a></td>
                                                    <td align="center"><a href=""><span class="glyphicon glyphicon-remove">Eliminar</span></a></td>
                                               
                                                <?php
                                            }
                                        }
                                        ?>
                                                     </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Ventana emergente para Nuevo ajuste-->
            <div class="modal fade" id="nuevoAJU">
                <div class="modal-dialog">
                    <!--<form class="form-horizontal" action="#ventanasEmergentes">-->
                    <form class="form-horizontal" action="../../Controller/controller.php">
                        <input type="hidden" name="opcion1" value="ajuste">
                        <input type="hidden" name="opcion2" value="insertar_ajuste">
                        <div class="modal-content">
                            <!-- Header de la ventana -->
                            <div class="modal-header bg-success">
                                <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h3 class="modal-title"><span class="glyphicon glyphicon-cog"></span> Nuevo Ajuste</h3>
                            </div>

                            <!-- Contenido de la ventana -->
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-3 col-md-offset-1">
                                                <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Codigo</label>
                                            </div>
                                            <div class="col-md-7">
                                                <?php echo $ajustesModel->generarCodigoAjuste(); ?>
                                                 <input type="hidden" name="ID_AJUSTE_PROD" value="<?php echo $ajustesModel->generarCodigoAjuste(); ?>">
                                                <!--<input type="text" class="form-control" placeholder="Ingrese sus Apellidos" required />-->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-3 col-md-offset-1">
                                                <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Motivo </label>
                                            </div>
                                            <div class="col-md-7">
                                                <input type="text" class="form-control" name="MOTIVO_AJUSTE_PROD" onkeypress="return SoloLetras(event);" size="150" maxlength="150" placeholder="Ingrese el motivo del ajuste" required />
                                            </div>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>

                            <!-- Footer de la ventana -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                <button class="btn btn-success">Guardar Ajuste</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            
            
            <!--Ventana emergente para Editar ajuste-->
            <div class="modal fade" id="editAJU">
                <div class="modal-dialog">
                    <!--<form class="form-horizontal" action="#ventanasEmergentes">-->
                    <form class="form-horizontal" action="../../Controller/controller.php">
                        <input type="hidden" name="opcion1" value="ajuste">
                        <input type="hidden" name="opcion2" value="insertar_ajuste">
                        <div class="modal-content">
                            <!-- Header de la ventana -->
                            <div class="modal-header bg-success">
                                <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h3 class="modal-title"><span class="glyphicon glyphicon-cog"></span> Nuevo Ajuste</h3>
                            </div>

                            <!-- Contenido de la ventana -->
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-3 col-md-offset-1">
                                                <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Codigo</label>
                                            </div>
                                            <div class="col-md-7">
                                                <?php echo $ajustesModel->generarCodigoAjuste(); ?>
                                                 <input type="hidden" name="ID_AJUSTE_PROD" value="<?php echo $ajustesModel->generarCodigoAjuste(); ?>">
                                                <!--<input type="text" class="form-control" placeholder="Ingrese sus Apellidos" required />-->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-3 col-md-offset-1">
                                                <label class="control-label"><span class="glyphicon glyphicon-asterisk"></span> Motivo </label>
                                            </div>
                                            <div class="col-md-7">
                                                <input type="text" class="form-control" name="MOTIVO_AJUSTE_PROD" onkeypress="return SoloLetras(event);" size="150" maxlength="150" placeholder="Ingrese el motivo del ajuste" required />
                                            </div>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>

                            <!-- Footer de la ventana -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                <button class="btn btn-success">Guardar Ajuste</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            
        </div>
    </body>
</html>