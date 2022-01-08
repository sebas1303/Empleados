<?php

include_once('includes/conection.php');                
include_once('includes/consultas.php');                

    //Editar empleado

    if (isset($_POST['editar'])) {
		$editar = $conn->prepare('UPDATE tbl_empleado SET nombre=:nombre,apellido=:apellido,id_estado_civil=:id_estado_civil,
        fecha_nacimiento=:fecha_nacimiento,id_genero=:id_genero,rh=:rh,id_cargo=:id_cargo,direccion=:direccion,
        id_municipio=:id_municipio,cuenta_bancaria=:cuenta_bancaria,salario=:salario,id_eps=:id_eps,
        id_arl=:id_arl,id_afp=:id_afp,id_caja_compensacion=:id_caja_compensacion WHERE cedula=:cedula');   

        $editar->bindParam(':cedula',$_POST['cedula']);
        $editar->bindParam(':nombre',$_POST['nombre']);
        $editar->bindParam(':apellido',$_POST['apellido']);
        $editar->bindParam(':id_estado_civil',$_POST['id_estado_civil']);
        $editar->bindParam(':fecha_nacimiento',$_POST['fecha_nacimiento']);
        $editar->bindParam(':id_genero',$_POST['id_genero']);
        $editar->bindParam(':rh',$_POST['rh']);
        $editar->bindParam(':id_cargo',$_POST['id_cargo']);
        $editar->bindParam(':direccion',$_POST['direccion']);
        $editar->bindParam(':id_municipio',$_POST['id_municipio']);
        $editar->bindParam(':cuenta_bancaria',$_POST['cuenta_bancaria']);
        $editar->bindParam(':salario',$_POST['salario']);
        $editar->bindParam(':id_eps',$_POST['id_eps']);
        $editar->bindParam(':id_arl',$_POST['id_arl']);
        $editar->bindParam(':id_afp',$_POST['id_afp']);
        $editar->bindParam(':id_caja_compensacion',$_POST['id_caja_compensacion']);
        

		if ($editar->execute()) {
		    $mensaje = "Se ha actualizado el trabajador";

		}else{
			$mensajemalo = "Error";
		}
	}  
     
    //Editar empleado
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- favicon -->
    <link rel="icon" href="image/logo1.png">


    <!-- css -->
    <link rel="stylesheet" href="css/empleado.css">
	<link rel="stylesheet" href="css/modal/bootstrap1.min.css">
  	<script src="css/modal/jquery.slim.min.js"></script>
  	<script src="css/modal/popper.min.js"></script>
  	<script src="css/modal/bootstrap.bundle1.min.js"></script>

    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/ce7cd523c1.js" crossorigin="anonymous"></script>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>

    <!-- datatables -->
  	<link rel="stylesheet" href="datatable/bootstrap.min.css"> 
	<link rel="stylesheet" href="datatable/dataTables.bootstrap5.min.css">
	<link rel="stylesheet" href="datatable/responsive.bootstrap5.min.css">
  	<script src="datatable/jquery-3.5.1.js"></script>
  	<script src="datatable/jquery.dataTables.min.js"></script>
  	<script src="datatable/dataTables.bootstrap5.min.js"></script>
	<script src="datatable/dataTables.buttons.min.js"></script>
	<script src="datatable/jszip.min.js"></script>
	<script src="datatable/pdfmake.min.js"></script>
	<script src="datatable/vfs_fonts.js"></script>
	<script src="datatable/buttons.html5.min.js"></script>
	<script src="datatable/buttons.print.min.js"></script>
	<script src="datatable/dataTables.responsive.min.js"></script>
	<script src="datatable/responsive.bootstrap5.min.js"></script>

    <title>Tabla Empleados</title>
</head>
<body class="body">

    <div class="arriba">
        <h1 class="titulo1"> Apoyo logistico  ZF</h1>
    </div>

    <header> 
        <div class="topnav" id="myTopnav">
            <a class="itm" href="index.php"><i class="fas fa-home"></i> Inicio</a>
			<a class="itm" href="nuevo.php"><i class="fas fa-plus"></i> Nuevo Empleado</a>
            <a class="itm primero" href=""><i class="fas fa-cog"></i> configuración</a>
            <a class="itm" href=""><i class="far fa-address-card"></i> Generar Carta</a>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <i class="fa fa-bars"></i>
            </a>
        </div>
    </header>

	<?php
		if (!empty($mensaje)) {  ?>
		<div class="alert alert-info alert-dismissible">
			<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
			<strong><?php echo $mensaje; ?></strong> 
		</div>
	<?php }?>

	<?php
		if (!empty($mensajemalo)) {  ?>
		<div class="alert alert-warning alert-dismissible">
			<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
			<strong><?php echo $mensajemalo; ?></strong> 
		</div>
	<?php }?>

    <div class="aa">

		<!-- nuevo empleado -->
		<button type="button" class="btn btn-dark" data-toggle="modal" data-target="#myModal"><i class="fas fa-plus"></i> Nuevo Empleado</button>

        <div class="table">
			<div class="tabal">
				<table class="table table-striped table-bordered dt-responsive nowrap" id="tabla">
					<thead>
						<tr>
							<th scope="col">Cedula:</th>
							<th scope="col">Nombres:</th>
							<th scope="col">Apellidos:</th>
							<th scope="col">Estado civil:</th>
                            <th scope="col">Fecha de nacimiento:</th>
							<th scope="col">Salario:</th>
                            <th scope="col">Cuenta Bancaria:</th>
                            <th scope="col">Genero:</th>
                            <th scope="col">RH:</th>
                            <th scope="col">Cargo:</th>
                            <th scope="col">Dirrección:</th>
                            <th scope="col">Municipio:</th>
							<th scope="col">Estado:</th>
                            <th scope="col">Eps:</th>
                            <th scope="col">Afp:</th>
                            <th scope="col">Arl:</th>
                            <th scope="col">Caja de compensación:</th>
							<th scope="col" class="ee">Editar</th>
							<th scope="col" class="ee">Eliminar</i></th>
						</tr>
					</thead>
					<tbody>
						<?php
						
					        /*resgistros de la base de datos*/
							foreach($tblempleado as $empleado) { ?>
							
							<tr>
								<td> <?php echo $empleado->cedula?> </td>
								<td> <?php echo $empleado->nombre?> </td>
								<td> <?php echo $empleado->apellido?> </td>
								<td> <?php echo $empleado->nomestado?> </td>
								<td> <?php echo $empleado->fecha_nacimiento?> </td>
                                <td> <?php echo $empleado->salario?> </td>
								<td> <?php echo $empleado->cuenta_bancaria?> </td>
								<td> <?php echo $empleado->nomgenero?> </td>
								<td> <?php echo $empleado->rh?> </td>
								<td> <?php echo $empleado->nomcargo?> </td>
								<td> <?php echo $empleado->direccion?> </td>
								<td> <?php echo $empleado->nommunicipio?> </td>
								<td> <?php echo $empleado->estado?> </td>
                                <td> <?php echo $empleado->nomeps?> </td>
								<td> <?php echo $empleado->nomafp?> </td>
								<td> <?php echo $empleado->nomarl?> </td>
								<td> <?php echo $empleado->nomcaja?> </td>
                                
								<td class="ee"><button id="editar" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editar<?php echo $empleado -> cedula; ?>"><i class="fas fa-pen"></i></button></td>
								<td class="ee"> <button type="button" class="btn btn-dark eliminarbtn" data-bs-toggle="modal" data-bs-target="#eliminar"><i class="fas fa-trash"></i> </button></td>
							</tr>

							<!-- Modal editar-->
							<div class="modal fade" id="editar<?php echo $empleado-> cedula; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Editar trabajador:<h1 class="nombrep">  <?php echo $empleado->nombre;?> <?php echo $empleado->apellido;?> </h1></h5>
										<button type="button" class="cerr" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
										</div>
										<div class="modal-body">
											<!-- Modal formulario-->
											<form action=""method="POST" autocomplete="off">
												<div class="padd-impu">
													<div class="nom-apee">
														<label for="" class="fecha">Documento : <?php echo $empleado-> cedula;?></label>
                        					</div>
                                       <div class="nom-apee">
                                       <input type="hidden" placeholder="Cedula" name="cedula" value="<?php echo $empleado-> cedula;?>"  required>
                        					</div>
													 <div class="nom-apee">
														<label for="" class="fecha">Nombre :</label>
														<label for="" class="fecha derecha a">Apellido :</label>
                        							</div>
													<div class="nom-ape">
                            							<input type="text" placeholder="Nombres" name="nombre" value="<?php echo $empleado-> nombre;?>"  title="Utilize solo letras, minimo carecteres 2" required>
                            							<input type="text" placeholder="Apellidos" name="apellido" value="<?php echo $empleado-> apellido;?>"  title="Utilize solo letras, minimo carecteres 2" required>
                        							</div>
													<div class="nom-apee">
														<label for="" class="fecha">Estado Civil :</label>
														<label for="" class="fecha derecha">Fecha de Nacimiento :</label>
                        							</div>
													<div class="nom-ape">
														<select name="id_estado_civil" >
															<option value="<?php echo $empleado -> id_estado_civil ?>"><?php echo $empleado -> nomestado ?></option>  
															<?php foreach ($tblestcivil as $estcivil) { ?>        
															<option class="opciones"  value="<?php echo $estcivil -> id_estado_civil ?>"><?php echo $estcivil -> nombre ?></option>  
															<?php } ?>  
														</select>
														<input type="date" placeholder="Fecha Nacimiento" name="fecha_nacimiento" value="<?php echo $empleado-> fecha_nacimiento;?>" title="Utilize solo letras, minimo carecteres 2" max="<?php $ano = Date("Y")-2; echo Date($ano."-m-d") ?>" required>
                        							</div>
													<div class="nom-apee">
														<label for="" class="fecha">Genero :</label>
														<label for="" class="fecha derecha b">Rh :</label>
                        							</div>
													<div class="nom-ape">
														<select name="id_genero" >
															<option value="<?php echo $empleado -> id_genero ?>"><?php echo $empleado -> nomgenero ?></option>    
															<?php foreach ($tblgenero as $genero) { ?>        
															<option class="opciones" value="<?php echo $genero -> id_genero ?>"><?php echo $genero -> nombre ?></option>  
															<?php } ?>  
														</select> 
														<input type="text" placeholder="RH" name="rh" value="<?php echo $empleado-> rh;?>"  title="Utilize solo letras, minimo carecteres 2" required>
                        							</div>
													<div class="nom-apee">
														<label for="" class="fecha">Cargo :</label>
                        							</div>
													<div class="nom-ape">
														<select name="id_cargo" >
															<option value="<?php echo $empleado -> id_cargo ?>"><?php echo $empleado -> nomcargo ?></option> 
															<?php foreach ($tblcargo as $cargo) { ?>        
															<option class="opciones" value="<?php echo $cargo -> id_cargo ?>"><?php echo $cargo -> nombre ?></option>  
															<?php } ?>  
														</select>
                        							 </div>
													<div class="nom-apee">
														<label for="" class="fecha">Dirección :</label>
														<label for="" class="fecha derecha c">Municipio :</label>
                        							</div>
													<div class="nom-ape">
														<input type="text" placeholder="Direccion" value="<?php echo $empleado-> direccion;?>" name="direccion"  title="Utilize solo letras, minimo carecteres 2" required>
														<select name="id_municipio" >
														<option value="<?php echo $empleado -> id_municipio ?>"><?php echo $empleado -> nommunicipio ?></option>  
															<?php foreach ($tblmunicipio as $municipio) { ?>        
															<option class="opciones" value="<?php echo $municipio -> id_municipio ?>"><?php echo $municipio -> nombre ?></option>  
															<?php } ?>  
														</select>
                        							</div>
													<div class="nom-apee">
														<label for="" class="fecha">Cuenta Bancaria :</label>
                        							</div>
													<div class="nom-ape">
														<input type="text" placeholder="Numero de Cuenta Bancaria"  value="<?php echo $empleado-> cuenta_bancaria;?>" name="cuenta_bancaria"  title="Utilize solo letras, minimo carecteres 2" required>
                        							</div>
													<div class="nom-apee">
														<label for="" class="fecha">Salario:</label>
														<label for="" class="fecha derecha e">Eps:</label>
                        							</div>
													<div class="nom-ape">
														<input type="text" placeholder="Salario" name="salario"  value="<?php echo $empleado-> salario;?>"   title="Utilize solo letras, minimo carecteres 2" required>
														<select name="id_eps" >
														<option value="<?php echo $empleado -> id_eps ?>"><?php echo $empleado -> nomeps ?></option> 
															<?php foreach ($tbleps as $eps) { ?>        
															<option class="opciones" value="<?php echo $eps -> id_eps ?>"><?php echo $eps -> nombre ?></option>  
															<?php } ?>  
														</select>
                        							</div>
													<div class="nom-apee">
														<label for="" class="fecha">Arl :</label>
														<label for="" class="fecha derecha e">Afp:</label>
                        							</div>
													<div class="nom-ape">
														<select name="id_arl" >
															<option value="<?php echo $empleado -> id_arl ?>"><?php echo $empleado -> nomarl ?></option>  
															<?php foreach ($tblarl as $arl) { ?>        
															<option class="opciones" value="<?php echo $arl -> id_arl ?>"><?php echo $arl -> nombre ?></option>  
															<?php } ?>  
														</select>
														<select name="id_afp" >
															<option value="<?php echo $empleado -> id_afp ?>"><?php echo $empleado -> nomafp ?></option> 
															<?php foreach ($tblafp as $afp) { ?>        
															<option class="opciones" value="<?php echo $afp -> id_afp ?>"><?php echo $afp -> nombre ?></option>  
															<?php } ?>  
														</select>
                        							</div>
															
													<div class="nom-apee">
														<label for="" class="fecha">Caja de Compensación :</label>
                        							</div>
													<div class="nom-ape">
														<select name="id_caja_compensacion" >
															<option value="<?php echo $empleado -> id_caja_compensacion?>"><?php echo $empleado -> nomcaja ?></option>  
															<?php foreach ($tblcaja as $caja) { ?>        
															<option class="opciones" value="<?php echo $caja -> id_caja_compensacion ?>"><?php echo $caja -> nombre ?></option>  
															<?php } ?>  
														</select>
                        				   </div>
														
												</div>
												<div class="modal-footer">
												    <button type="submit" name="editar" class="btn btn-primary">Guardar</button>
													<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
												</div>
											</form>
											<!-- Modal formulario-->
										</div>
									</div>
								</div>
							</div>
							<!-- Modal eliminar-->
							<div class="modal fade"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Eliminar trabajador</h5>
											<button type="button" class="cerr" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
										</div>
										<div class="modal-body">
											<div class="msg">
												<h4 class="msg-eliminar">Estas seguro de eliminar este registro ?</h4>
												<?php echo "<span>Documento: </span>".$traba-> docid; ?>
											</div>
										</div>
										<!-- Modal formulario-->
										<form  method="POST">
											<input  type="hidden" name="docid"  >
											<input  type="hidden" name="nombres"  >
											<input  type="hidden" name="apellidos"  >
											<input  type="hidden" name="direccion"  >
											<input  type="hidden" name="fechaNacimiento"  >
											<input  type="hidden" name="estadoCivil"  >
											<input  type="hidden" name="telefono"  >
											<input  type="hidden" name="genero"  >
											<input  type="hidden" name="cargo"  >
											<div class="modal-footer">
												<button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button>
												<button type="submit" class="btn btn-danger" name="delete">Eliminar</button>
											</div>
										</form>
										<!-- Modal formulario-->
									</div>
								</div>
							</div>
							<!-- Modal eliminar-->


						<?php } ?>
						<!-- hasta aca no funciona-->
					</tbody>
				</table>
			</div>
		</div>
		<!-- The Modal nuevo empleado -->

		<div class="modal" id="myModal">
    		<div class="modal-dialog">
      			<div class="modal-content">
      
        			<!-- Modal Header -->
        			<div class="modal-header">
          				<h4 class="modal-title">Registrar Nuevo Empleado</h4>
          				<button type="button" class="close" data-dismiss="modal">&times;</button>
        			</div>
        
      	  			<!-- Modal body -->
       				<div class="modal-body">
         				<form action=""method="POST" autocomplete="off">
							<div class="padd-impu">
								<div class="nom-apee">
									<label for="" class="fecha">Documento :</label>
                        		</div>
								<div class="nom-ape">
                            		<input type="text" placeholder="Documento de Identidad" name="cedula"  title="Utilize solo letras, minimo carecteres 2" required>
								
								     <!-- <input type="text"  name="estado"> -->
					
                        		</div>
								<div class="nom-apee">
									<label for="" class="fecha">Nombre :</label>
									<label for="" class="fecha derecha a">Apellido :</label>
                        		</div>
								<div class="nom-ape">
                            		<input type="text" placeholder="Nombres" name="nombre"  title="Utilize solo letras, minimo carecteres 2" required>
                            		<input type="text" placeholder="Apellidos" name="apellido"  title="Utilize solo letras, minimo carecteres 2" required>
                        		</div>
								<div class="nom-apee">
									<label for="" class="fecha">Estado Civil :</label>
									<label for="" class="fecha derecha">Fecha de Nacimiento :</label>
                        		</div>
								<div class="nom-ape">
									<select name="id_estado_civil" >
										<option class="t" hidden selected> Seleccionar Estado Civil</option>  
										<?php foreach ($tblestcivil as $estcivil) { ?>        
										<option class="opciones" value="<?php echo $estcivil -> id_estado_civil ?>"><?php echo $estcivil -> nombre ?></option>  
										<?php } ?>  
									</select>
									<input type="date" placeholder="Fecha Nacimiento" name="fecha_nacimiento"  title="Utilize solo letras, minimo carecteres 2" max="<?php $ano = Date("Y")-2; echo Date($ano."-m-d") ?>" required>
                        		</div>
								<div class="nom-apee">
									<label for="" class="fecha">Genero :</label>
									<label for="" class="fecha derecha b">Rh :</label>
                        		</div>
								<div class="nom-ape">
									<select name="id_genero" >
										<option class="t" hidden selected> Seleccionar Genero</option>  
										<?php foreach ($tblgenero as $genero) { ?>        
										<option class="opciones" value="<?php echo $genero -> id_genero ?>"><?php echo $genero -> nombre ?></option>  
										<?php } ?>  
									</select> 
									<input type="text" placeholder="RH" name="rh"  title="Utilize solo letras, minimo carecteres 2" required>
                        		</div>
								<div class="nom-apee">
									<label for="" class="fecha">Cargo :</label>
                        		</div>
								<div class="nom-ape">
									<select name="id_cargo" >
										<option class="t" hidden selected> Seleccionar el cargo</option>  
										<?php foreach ($tblcargo as $cargo) { ?>        
										<option class="opciones" value="<?php echo $cargo -> id_cargo ?>"><?php echo $cargo -> nombre ?></option>  
										<?php } ?>  
									</select>
                        		 </div>
								<div class="nom-apee">
									<label for="" class="fecha">Dirección :</label>
									<label for="" class="fecha derecha c">Municipio :</label>
                        		</div>
								<div class="nom-ape">
									<input type="text" placeholder="Direccion" name="direccion"  title="Utilize solo letras, minimo carecteres 2" required>
									<select name="id_municipio" >
										<option class="t" hidden selected> Seleccionar Municipio</option>  
										<?php foreach ($tblmunicipio as $municipio) { ?>        
										<option class="opciones" value="<?php echo $municipio -> id_municipio ?>"><?php echo $municipio -> nombre ?></option>  
										<?php } ?>  
									</select>
                        		</div>
								<div class="nom-apee">
									<label for="" class="fecha">Cuenta Bancaria :</label>
                        		</div>
								<div class="nom-ape">
									<input type="text" placeholder="Numero de Cuenta Bancaria" name="cuenta_bancaria"  title="Utilize solo letras, minimo carecteres 2" required>
                        		</div>
								<div class="nom-apee">
									<label for="" class="fecha">Salario:</label>
									<label for="" class="fecha derecha e">Eps:</label>
                        		</div>
								<div class="nom-ape">
									<input type="text" placeholder="Salario" name="salario"  title="Utilize solo letras, minimo carecteres 2" required>
									<select name="id_eps" >
										<option class="t" hidden selected> Seleccionar Eps</option>  
										<?php foreach ($tbleps as $eps) { ?>        
										<option class="opciones" value="<?php echo $eps -> id_eps ?>"><?php echo $eps -> nombre ?></option>  
										<?php } ?>  
									</select>
                        		</div>
								<div class="nom-apee">
									<label for="" class="fecha">Arl :</label>
									<label for="" class="fecha derecha e">Afp:</label>
                        		</div>
								<div class="nom-ape">
									<select name="id_arl" >
										<option class="t" hidden selected> Seleccionar Arl</option>  
										<?php foreach ($tblarl as $arl) { ?>        
										<option class="opciones" value="<?php echo $arl -> id_arl ?>"><?php echo $arl -> nombre ?></option>  
										<?php } ?>  
									</select>
									<select name="id_afp" >
										<option class="t" hidden selected> Seleccionar Afp</option>  
										<?php foreach ($tblafp as $afp) { ?>        
										<option class="opciones" value="<?php echo $afp -> id_afp ?>"><?php echo $afp -> nombre ?></option>  
										<?php } ?>  
									</select>
                        		</div>

								<div class="nom-apee">
									<label for="" class="fecha">Caja de Compensación :</label>
                        		</div>
								<div class="nom-ape">
									<select name="id_caja_compensacion" >
										<option class="t" hidden selected> Seleccionar Caja de compesación</option>  
										<?php foreach ($tblcaja as $caja) { ?>        
										<option class="opciones" value="<?php echo $caja -> id_caja_compensacion ?>"><?php echo $caja -> nombre ?></option>  
										<?php } ?>  
									</select>
                        		</div>

								<input type="hidden" value="activo" name="estado">

							</div>
							<div class="modal-footer">
							    <button type="submit" name="guardar" class="btn btn-primary">Guardar</button>
								<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
							</div>
						</form>
					</div>
      			</div>
    		</div>
  		</div>

    </div>

    <script>
		$(document).ready(function() {
    		$('#tabla').DataTable({
				// ?columnDefs permite asignar opciones específicas a columnas de la tabla
				"columnDefs": [{
					// ?targets indica a que columna se debe aplicar la funcion
					"targets": [4,5],
					// ?orderable desactiva la clasificacion de las columnas dadas en targest
					"orderable": false
				}],
				
				"language": {
					"lengthMenu": "Mostrar _MENU_ registros por pagina",
					"zeroRecords": "No se encontraron registros",
					"info": "",
					"infoEmpty": "",
					"infoFiltered": "",
					"search": "",
					"searchPlaceholder": "Buscar Registros",
					"paginate":{
						"next": "Siguiente",
						"previous": "Anterior"
					}
				},
				dom: 'Blfrtip',
				buttons: [
					{
						extend:'excelHtml5',
						text:'<i class="far fa-file-excel"></i>',
						titleAttr:'exportar a exel',
						className:'btn btn-success'
					},
					{
						extend:'csvHtml5',
						text:'<i class="fas fa-file-csv"></i>',
						titleAttr:'exportar en csv',
						className:'btn btn-dark'
					},
					{
						extend:'pdfHtml5',
						text:'<i class="fas fa-file-pdf"></i>',
						titleAttr:'exportar a pdf',
						className:'btn btn-danger'
					},
					{
						extend:'print',
						text:'<i class="fas fa-print"></i>',
						titleAttr:'imprimir',
						className:'btn btn-primary'
					},
				]
			});
		});
        function myFunction() {
        var x = document.getElementById("myTopnav");
        if (x.className === "topnav") {
            x.className += " responsive";
        } else {
            x.className = "topnav";
        }
    }
	</script>

</body>
</html>