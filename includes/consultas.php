
<?php

    //datos de las tablas desplegables

        $genero = $conn-> query("SELECT * from tbl_genero;");
        $tblgenero = $genero -> fetchALL(PDO::FETCH_OBJ);

        $estcivil = $conn-> query("SELECT * from tbl_estado_civil;");
        $tblestcivil = $estcivil -> fetchALL(PDO::FETCH_OBJ);

        $municipio = $conn-> query("SELECT * from tbl_municipio;");
        $tblmunicipio = $municipio -> fetchALL(PDO::FETCH_OBJ);

        $cargo = $conn-> query("SELECT * from tbl_cargo;");
        $tblcargo = $cargo -> fetchALL(PDO::FETCH_OBJ);

        $eps = $conn-> query("SELECT * from tbl_eps;");
        $tbleps = $eps -> fetchALL(PDO::FETCH_OBJ);

        $afp = $conn-> query("SELECT * from tbl_afp;");
        $tblafp = $afp -> fetchALL(PDO::FETCH_OBJ);

        $arl = $conn-> query("SELECT * from tbl_arl;");
        $tblarl = $arl -> fetchALL(PDO::FETCH_OBJ);

        $caja = $conn-> query("SELECT * from tbl_caja_compensacion;");
        $tblcaja = $caja -> fetchALL(PDO::FETCH_OBJ);

    //datos de las tablas desplegables

    //Nuevo empleado

    $search=$conn->prepare('SELECT * FROM tbl_empleado WHERE cedula=:cedula;');
    $search->bindParam(':cedula',$_POST['cedula']);
    $search->execute();
    $search->rowCount();
    $empleado=$search->fetch(PDO::FETCH_ASSOC);
 
    if (isset($_POST['guardar'])) {
        
        if ($_POST['cedula']!=$empleado['cedula']) {/*insertar si se cumple la condicion */  
            
            $inser=$conn->prepare("INSERT INTO tbl_empleado(cedula,nombre,apellido,id_estado_civil,fecha_nacimiento,id_genero,rh,id_cargo,direccion,id_municipio,cuenta_bancaria,salario,id_eps,id_arl,id_afp,id_caja_compensacion,estado)
            VALUES (:cedula,:nombre,:apellido,:id_estado_civil,:fecha_nacimiento,:id_genero,:rh,:id_cargo,:direccion,:id_municipio,:cuenta_bancaria,:salario,:id_eps,:id_arl,:id_afp,:id_caja_compensacion,:estado);");
 
            $inser->bindParam(':cedula',$_POST['cedula']);
            $inser->bindParam(':nombre',$_POST['nombre']);
            $inser->bindParam(':apellido',$_POST['apellido']);
            $inser->bindParam(':id_estado_civil',$_POST['id_estado_civil']);
            $inser->bindParam(':fecha_nacimiento',$_POST['fecha_nacimiento']);
            $inser->bindParam(':id_genero',$_POST['id_genero']);
            $inser->bindParam(':rh',$_POST['rh']);
            $inser->bindParam(':id_cargo',$_POST['id_cargo']);
            $inser->bindParam(':direccion',$_POST['direccion']);
            $inser->bindParam(':id_municipio',$_POST['id_municipio']);
            $inser->bindParam(':cuenta_bancaria',$_POST['cuenta_bancaria']);
            $inser->bindParam(':salario',$_POST['salario']);
            $inser->bindParam(':id_eps',$_POST['id_eps']);
            $inser->bindParam(':id_arl',$_POST['id_arl']);
            $inser->bindParam(':id_afp',$_POST['id_afp']);
            $inser->bindParam(':id_caja_compensacion',$_POST['id_caja_compensacion']);
            $inser->bindParam(':estado',$_POST['estado']);

 
            if ($inser->execute()) {
                $mensaje = "Trabajador creado con exito";
                
            }else{
                $mensajemalo = "No se  registrar";
            }
        }else{
            $mensajemalo = "Error, el numero de documento ya ha sido ingresado";
        }	
    }
 
    //Nuevo empleado

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