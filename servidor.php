<?php
 $hostname="localhost";
    $database="sysprosfin";
    $username="salasar";
    $password="19R0$@lin@98";
    $json=array();
    date_default_timezone_set('America/Tegucigalpa');
    $nombre=$_POST["nombre"] ?? null;
    $apellido=$_POST["apellido"] ?? null;
    $identidad=$_POST["dni"] ?? null;
    $telefono=$_POST["telefono"] ?? null;
    $correo=$_POST["correo"] ?? null;
    $usuario=$_POST["usuario"] ?? null;
    $clave=$_POST["clave"] ?? null;
    $fecha_creacion=date("Y-m-d");
    $hora_creacion=$hora=date("H:i:s");
    $fecha_actividad=date("Y-m-d");
    $hora_actividad=date("H:i:s");
    $fechaI=$_POST["fechaI"] ?? null;
    $fechaF=$_POST["fechaF"] ?? null;
    $correoOrigen="sysprosfin@gmail.com";
    $claveOrigen="degp yqxm ywrn fqbn";
    $codigoLlave=$_POST["codigoLlave"] ?? null;
    $id=$_POST["id"] ?? null;
    $tipo=$_POST["tipo"] ?? null;
    $empresa=$_POST["empresa"] ?? null;
    $usuarioP=$_POST["usuarioP"] ?? null;
    $porcentaje=$_POST["porcentaje"] ?? null;
    $cantidad=$_POST["cantidad"] ?? null;
    $conexion=mysqli_connect($hostname,$username,$password,$database);
    $cifrado=$_POST["cifrado"] ?? null;
    $cuenta=$_POST["cuenta"] ?? null;
    $cuentaO=$_POST["cuentaO"] ?? null;
    $rango=$_POST["rango"] ?? null;
    $nombreO=$_POST["nombreO"] ?? null;
    $apellidoO=$_POST["apellidoO"] ?? null;
    $cuentaD=$_POST["cuentaD"] ?? null;
    $nombreD=$_POST["nombreD"] ?? null;
    $apellidoD=$_POST["apellidoD"] ?? null;
    if($cifrado=="claveCifrado"){
        switch($codigoLlave){
            case 1:{
                if(isset($_POST["nombre"])&&isset($_POST["apellido"])&&isset($_POST["dni"])&&isset($_POST["telefono"])&&isset($_POST["correo"])&&isset($_POST["usuario"])&&isset($_POST["clave"])){
                    $consulta="SELECT * FROM `perfiles` WHERE (`correo`='$correo')";
                    $resultado=mysqli_query($conexion,$consulta);
                    if($resultado){
                        if($resultado->num_rows>0){
                            $resultar["mensaje"]="correo_repetido";
                            $json['aprobacion'][]=$resultar;
                            echo json_encode($json);
                        }
                        else{
                            $consulta="SELECT * FROM `perfiles` WHERE (`usuario`='$usuario')";
                            $resultado=mysqli_query($conexion,$consulta);
                            if($resultado){
                                if($resultado->num_rows>0){
                                    $resultar["mensaje"]="usuario_repetido";
                                    $json['aprobacion'][]=$resultar;
                                    echo json_encode($json);
                                }
                                else{
                                    $telefonofinal="+504".$telefono;
                                    $consulta="INSERT INTO `perfiles`(`id`, `nombre`, `apellido`, `identidad`, `telefono`, `usuario`, `correo`, `clave`, `fecha_creacion`, `hora_creacion`, `fecha_actividad`, `hora_actividad`, `estado`) VALUES (NULL,'$nombre','$apellido','$identidad','$telefonofinal','$usuario','$correo','$clave','$fecha_creacion','$hora_creacion','$fecha_actividad','$hora_actividad',2)";
                                    $resultado=mysqli_query($conexion,$consulta);
                                    $resultar["mensaje"]="registrado";
                                    $resultar["correo_origen"]=$correoOrigen;
                                    $resultar["clave_correo_origen"]=$claveOrigen;
                                    $json['aprobacion'][]=$resultar;
                                    echo json_encode($json);
                                }
                            }
                        }
                    }
                }
                break;
            }
            case 2:{
                if((isset($_POST["codigoLlave"])=="2")&&isset($_POST["usuario"])){
                    $consulta="UPDATE `perfiles` SET `fecha_actividad`='$fecha_actividad', `hora_actividad`='$hora_actividad', `estado`=1 WHERE (`usuario`='$usuario')";
                    $resultado=mysqli_query($conexion,$consulta);
                    if($resultado){
                        $resultar["mensaje"]="validado";
                        $json['aprobacion'][]=$resultar;
                        echo json_encode($json);
                    }
                }
                break;
            }
            case 3:{
                if(isset($_POST["usuario"])){
                    $consulta="SELECT p.nombre,p.apellido,p.correo,p.clave,es.estado FROM `perfiles` AS p JOIN `estado` AS es ON (p.estado=es.id) WHERE BINARY p.usuario='$usuario'";
                    $resultado=mysqli_query($conexion,$consulta);
                    if($resultado){
                        if($resultado->num_rows>0){
                            if($registro=mysqli_fetch_array($resultado)){
                                $resultar["mensaje"]=$registro["estado"];
                                $resultar["nombre"]=$registro["nombre"];
                                $resultar["apellido"]=$registro["apellido"];
                                $resultar["correo"]=$registro["correo"];
                                $resultar["clave"]=$registro["clave"];
                                $resultar["correo_origen"]=$correoOrigen;
                                $resultar["clave_correo_origen"]=$claveOrigen;
                                $json['aprobacion'][]=$resultar;
                                if($registro["estado"]=="1"){
                                    $consulta="UPDATE `perfiles` SET `fecha_actividad`='$fecha_actividad', `hora_actividad`='$hora_actividad' WHERE (`usuario`='$usuario')";
                                    $resultado=mysqli_query($conexion,$consulta);
                                }
                                echo json_encode($json);
                            }
                        }
                        else{
                            $resultar["mensaje"]="no existe";
                            $json['aprobacion'][]=$resultar;
                            echo json_encode($json);
                        }
                    }
                }
                break;
            }
            case 4:{
                if(isset($_POST["usuario"])){
                    $consulta="SELECT * FROM `perfiles` WHERE (`usuario`='$usuario')";
                    $resultado=mysqli_query($conexion,$consulta);
                    if($resultado){
                        if($resultado->num_rows>0){
                            if($registro=mysqli_fetch_array($resultado)){
                                $resultar["mensaje"]="existe";
                                $resultar["nombre"]=$registro["nombre"];
                                $resultar["apellido"]=$registro["apellido"];
                                $resultar["correo"]=$registro["correo"];
                                $resultar["correo_origen"]=$correoOrigen;
                                $resultar["clave_correo_origen"]=$claveOrigen;
                                $json['aprobacion'][]=$resultar;
                                echo json_encode($json);
                            }
                        }
                        else{
                            $resultar["mensaje"]="no existe";
                            $json['aprobacion'][]=$resultar;
                            echo json_encode($json);
                        }
                    }
                }
                break;
            }
            case 5:{
                if(isset($_POST["usuario"])&&isset($_POST["clave"])){
                    $consulta="UPDATE `perfiles` SET `clave`='$clave',`fecha_actividad`='$fecha_actividad', `hora_actividad`='$hora_actividad' WHERE (`usuario`='$usuario')";
                    $resultado=mysqli_query($conexion,$consulta);
                    $resultar["mensaje"]="guardado";
                    $json['aprobacion'][]=$resultar;
                    echo json_encode($json);
                }
                break;
            }
            case 6:{
                if(isset($_POST["usuario"])){
                    $consulta="SELECT c.cuenta, c.credito, c.congelado, c.deuda, c.intereses, c.porcentaje, e.empresa, r.rango, t.tipo, es.estado FROM `cuentas` AS c JOIN `perfiles` AS p JOIN `estado` AS es JOIN `tipo` AS t JOIN `empresas` AS e JOIN `rangos` AS r ON (c.perfiles=p.id) AND (c.estado=es.id) AND (c.empresas=e.id) AND (c.rangos=r.id) AND (c.tipo=t.id) WHERE (p.usuario='$usuario') AND (es.estado='activo')";
                    $resultado=mysqli_query($conexion,$consulta);
                    if($resultado){
                        if($resultado->num_rows>0){
                            while($registro=mysqli_fetch_assoc($resultado)){
                                $resultar["mensaje"]="aprobado";
                                $resultar["cuenta"]=$registro["cuenta"];
                                $resultar["credito"]=$registro["credito"];
                                $resultar["congelado"]=$registro["congelado"];
                                $resultar["deuda"]=$registro["deuda"];
                                $resultar["empresa"]=$registro["empresa"];
                                $resultar["tipo"]=$registro["tipo"];
                                $resultar["rango"]=$registro["rango"];
                                $resultar["estado"]=$registro["estado"];
                                $resultar["intereses"]=$registro["intereses"];
                                $resultar["porcentaje"]=$registro["porcentaje"];
                                $json['informacionCuentas'][]=$resultar;
                            }
                            echo json_encode($json);
                        }
                        else{
                            $resultar["mensaje"]="no existe";
                            $json['informacionCuentas'][]=$resultar;
                            echo json_encode($json);
                        }
                    }
                }
                break;
            }
            case 7:{
                if(isset($_POST["usuario"])){
                    $consulta="SELECT * FROM `perfiles` WHERE (`usuario`='$usuario')";
                    $resultado=mysqli_query($conexion,$consulta);
                    if($resultado){
                        if($resultado->num_rows>0){
                            if($registro=mysqli_fetch_array($resultado)){
                                $resultar["mensaje"]="encontrado";
                                $resultar["nombre"]=$registro["nombre"];
                                $resultar["apellido"]=$registro["apellido"];
                                $resultar["cuenta"]=$registro["id"];
                                $json['aprobacion'][]=$resultar;
                                echo json_encode($json);
                            }
                        }
                        else{
                            $resultar["mensaje"]="no existe";
                            $json['aprobacion'][]=$resultar;
                            echo json_encode($json);
                        }
                    }
                }
                break;
            }
            case 8:{
                if(isset($_POST["id"])){
                    $consulta="DELETE FROM `solicitud` WHERE (`id`='$id')";
                    $resultado=mysqli_query($conexion,$consulta);
                    if($resultado){
                        $resultar["mensaje"]="aprobado";
                        $json['aprobacion'][]=$resultar;
                        echo json_encode($json);
                    }
                }
                break;
            }
            case 9:{
                if(isset($_POST["usuario"])&&isset($_POST["empresa"])&&isset($_POST["usuarioP"])&&isset($_POST["id"])){
                    $consulta="INSERT INTO `cuentas`(`cuenta`, `perfiles`, `credito`, `congelado`, `deuda`, `intereses`, `porcentaje`, `empresas`, `rangos`, `tipo`, `estado`, `fecha_creacion`) VALUES (NULL,(SELECT `id` FROM `perfiles` WHERE (`usuario`='$usuario')),0.0,0.0,0.0,0.0,0.0,(SELECT `id` FROM `empresas` WHERE (`empresa`='$empresa')),4,2,1,'$fecha_creacion')";
                    $resultado=mysqli_query($conexion,$consulta);
                    if($resultado){
                        $consulta="UPDATE `empresas` AS s SET s.clientes=s.clientes+1 WHERE (s.empresa='$empresa')";
                        $resultado=mysqli_query($conexion,$consulta);
                        if($resultado){
                            $consulta="DELETE FROM `solicitud` WHERE (`id`='$id')";
                            $resultado=mysqli_query($conexion,$consulta);
                            $resultar["mensaje"]="aprobado";
                            $json['aprobacion'][]=$resultar;
                            echo json_encode($json);
                        }
                    }
                }
                break;
            }
            case 10:{
                if(isset($_POST["empresa"])){
                    $consulta="SELECT s.id, p.usuario, p.nombre, p.apellido, p.correo, p.telefono FROM `solicitud` AS s JOIN `perfiles` AS p JOIN `empresas` AS e JOIN `descripcion` AS d ON (s.perfiles=p.id AND s.empresas=e.id AND s.descripcion=d.id) WHERE (e.empresa='$empresa') AND (d.descripcion='agregar')";
                    $resultado=mysqli_query($conexion,$consulta);
                    if($resultado){
                        if($resultado->num_rows>0){
                            while($registro=mysqli_fetch_assoc($resultado)){
                                $resultar["mensaje"]="aprobado";
                                $resultar["id"]=$registro["id"];
                                $resultar["nombre"]=$registro["nombre"];
                                $resultar["apellido"]=$registro["apellido"];
                                $resultar["correo"]=$registro["correo"];
                                $resultar["usuario"]=$registro["usuario"];
                                $resultar["telefono"]=$registro["telefono"];
                                $json['aprobacion'][]=$resultar;
                            }
                            echo json_encode($json);
                        }
                        else{
                            $resultar["mensaje"]="nada";
                            $json['aprobacion'][]=$resultar;
                            echo json_encode($json);
                        }
                    }
                }
                break;
            }
            case 11:{
                if(isset($_POST["id"])&&isset($_POST["empresa"])&&isset($_POST["usuario"])&&isset($_POST["cantidad"])){
                    $consulta="UPDATE `cuentas` AS c JOIN `perfiles` AS p JOIN `empresas` AS e ON (c.perfiles=p.id AND c.empresas=e.id) SET c.credito=c.credito + $cantidad WHERE (p.usuario='$usuario') AND (e.empresa='$empresa')";
                    $resultado=mysqli_query($conexion,$consulta);
                    if($resultado){
                        $consulta="DELETE FROM `solicitud` WHERE (`id`='$id')";
                        $resultado=mysqli_query($conexion,$consulta);
                        if($resultado){
                            $resultar["mensaje"]="aprobado";
                            $json['aprobacion'][]=$resultar;
                            echo json_encode($json);
                        }
                    }
                }
                break;
            }
            case 12:{
                if(isset($_POST["empresa"])){
                    $consulta="SELECT s.id, p.usuario, p.nombre, p.apellido, p.correo, p.telefono, s.cantidad FROM `solicitud` AS s JOIN `perfiles` AS p JOIN `empresas` AS e JOIN `descripcion` AS d ON (s.perfiles = p.id AND s.empresas=e.id AND s.descripcion=d.id) WHERE (e.empresa = '$empresa' AND d.descripcion = 'prestamo')";
                    $resultado=mysqli_query($conexion,$consulta);
                    if($resultado){
                        if($resultado->num_rows>0){
                            while($registro=mysqli_fetch_assoc($resultado)){
                                $resultar["mensaje"]="aprobado";
                                $resultar["id"]=$registro["id"];
                                $resultar["nombre"]=$registro["nombre"];
                                $resultar["apellido"]=$registro["apellido"];
                                $resultar["correo"]=$registro["correo"];
                                $resultar["usuario"]=$registro["usuario"];
                                $resultar["telefono"]=$registro["telefono"];
                                $resultar["cantidad"]=$registro["cantidad"];
                                $json['aprobacion'][]=$resultar;
                            }
                            echo json_encode($json);
                        }
                        else{
                            $resultar["mensaje"]="nada";
                            $json['aprobacion'][]=$resultar;
                            echo json_encode($json);
                        }
                    }
                }
                break;
            }
            case 13:{
                if(isset($_POST["usuario"])&&isset($_POST["empresa"])&&isset($_POST["tipo"])){
                    if($tipo=="ahorro"){
                        $consulta="INSERT INTO `cuentas`(`cuenta`, `perfiles`, `credito`, `congelado`, `deuda`, `intereses`, `porcentaje`, `empresas`, `rangos`, `tipo`, `estado`, `fecha_creacion`) VALUES (NULL,(SELECT `id` FROM `perfiles` WHERE (`usuario`='$usuario')),0.0,0.0,0.0,0.0,0.0,(SELECT `id` FROM `empresas` WHERE (`empresa`='$empresa')),4,(SELECT `id` FROM `tipo` WHERE (`tipo`='$tipo')),1,'$fecha_creacion')";
                        $resultado=mysqli_query($conexion,$consulta);
                        $consulta="UPDATE `perfiles` SET `fecha_actividad`='$fecha_actividad', `hora_actividad`='$hora_actividad' WHERE (`usuario`='$usuario')";
                        $resultado=mysqli_query($conexion,$consulta);
                        $resultar["mensaje"]="registrado";
                        $json['aprobacion'][]=$resultar;
                        echo json_encode($json);
                    }
                    else{
                        if($tipo=="prestamos"){
                            $consulta="SELECT * FROM `empresas` WHERE (`empresa`='$empresa')";
                            $resultado=mysqli_query($conexion,$consulta);
                            if($resultado){
                                if($resultado->num_rows>0){
                                    $resultar["mensaje"]="existe";
                                    $json['aprobacion'][]=$resultar;
                                    echo json_encode($json);
                                }
                                else{
                                    $consulta="INSERT INTO `empresas`(`id`, `empresa`, `clientes`) VALUES (NULL,'$empresa',0)";
                                    $resultado=mysqli_query($conexion,$consulta);
                                    $consulta="INSERT INTO `cuentas`(`cuenta`, `perfiles`, `credito`, `congelado`, `deuda`, `intereses`, `porcentaje`, `empresas`, `rangos`, `tipo`, `estado`, `fecha_creacion`) VALUES (NULL,(SELECT `id` FROM `perfiles` WHERE (`usuario`='$usuario')),0.0,0.0,0.0,0.0,0.0,(SELECT `id` FROM `empresas` WHERE (`empresa`='$empresa')),1,(SELECT `id` FROM `tipo` WHERE (`tipo`='$tipo')),1,'$fecha_creacion')";
                                    $resultado=mysqli_query($conexion,$consulta);
                                    $consulta="UPDATE `perfiles` SET `fecha_actividad`='$fecha_actividad', `hora_actividad`='$hora_actividad' WHERE (`usuario`='$usuario')";
                                    $resultado=mysqli_query($conexion,$consulta);
                                    $resultar["mensaje"]="registrado";
                                    $json['aprobacion'][]=$resultar;
                                    echo json_encode($json);
                                }
                            }
                        }
                    }
                }
                break;
            }
            case 14:{
                if(isset($_POST["usuario"])){
                    $consulta="SELECT * FROM `perfiles` WHERE (`usuario`='$usuario')";
                    $resultado=mysqli_query($conexion,$consulta);
                    if($resultado){
                        if($resultado->num_rows>0){
                            if($registro=mysqli_fetch_array($resultado)){
                                $resultar["mensaje"]="aprobado";
                                $resultar["nombre"]=$registro["nombre"];
                                $resultar["apellido"]=$registro["apellido"];
                                $resultar["correo"]=$registro["correo"];
                                $resultar["correo_origen"]=$correoOrigen;
                                $resultar["clave_correo_origen"]=$claveOrigen;
                                $json['aprobacion'][]=$resultar;
                                echo json_encode($json);
                            }
                        }
                        else{
                            $resultar["mensaje"]="no existe";
                            $json['aprobacion'][]=$resultar;
                            echo json_encode($json);
                        }
                    }
                }
                break; 
            }
            case 15:{
                if(isset($_POST["usuario"]) && isset($_POST['cuenta'])){
                    $consulta="SELECT t.tipo,e.empresa,c.credito,c.congelado,c.deuda,c.fecha_creacion,c.intereses,c.porcentaje,r.rango FROM `cuentas` AS c JOIN `perfiles` AS p JOIN `tipo` AS t JOIN `empresas` AS e JOIN `rangos` AS r ON (c.perfiles=p.id AND c.empresas=e.id AND c.rangos=r.id AND c.tipo= t.id) WHERE (p.usuario='$usuario') AND (c.cuenta='$cuenta')";
                    $resultado=mysqli_query($conexion,$consulta);
                    if($resultado){
                        if($resultado->num_rows>0){
                            if($registro=mysqli_fetch_array($resultado)){
                                $resultar["mensaje"]="aprobado";
                                $resultar["tipo"]=$registro["tipo"];
                                $resultar["empresa"]=$registro["empresa"];
                                $resultar["credito"]=$registro["credito"];
                                $resultar["congelado"]=$registro["congelado"];
                                $resultar["fecha_creacion"]=$registro["fecha_creacion"];
                                $resultar["deuda"]=$registro["deuda"];
                                $resultar["intereses"]=$registro["intereses"];
                                $resultar["porcentaje"]=$registro["porcentaje"];
                                $resultar["rango"]=$registro["rango"];
                                $json['aprobacion'][]=$resultar;
                                echo json_encode($json);
                            }
                        }
                    }
                }
                break;
            }
            case 16:{
                if(isset($_POST['cuenta'])){
                    $consulta="SELECT `referencia`, p.nombre AS nombreO, p.apellido AS apellidoO, `cuentasO`, e.empresa AS empresaO, t.tipo AS tipoO, d.descripcion AS descripcionO, `cantidad`, `fecha`, `hora`, p2.nombre AS nombreD, p2.apellido AS apellidoD, `cuentasD`, e2.empresa AS empresaD, t2.tipo AS tipoD, d2.descripcion AS descripcionD FROM `historial` AS h JOIN `perfiles` AS p JOIN `perfiles` AS p2 JOIN `empresas` AS e JOIN `empresas` AS e2 JOIN `tipo` AS t JOIN `tipo` AS t2 JOIN `descripcion` d JOIN `descripcion` d2 ON (h.perfilesO=p.id AND h.perfilesD=p2.id AND h.empresasO=e.id AND h.empresasD=e2.id AND h.tipoO=t.id AND h.tipoD=t2.id AND h.descripcionO=d.id AND h.descripcionD=d2.id) WHERE (`cuentasO`='$cuenta') OR (`cuentasD`='$cuenta') ORDER BY `referencia` DESC";
                    $resultado=mysqli_query($conexion,$consulta);
                    if($resultado){
                        if($resultado->num_rows>0){
                            while($registro=mysqli_fetch_assoc($resultado)){
                                $resultar["mensaje"]="aprobado";
                                $resultar["referencia"]=$registro["referencia"];
                                $resultar["empresaO"]=$registro["empresaO"];
                                $resultar["tipoO"]=$registro["tipoO"];
                                $resultar["nombreO"]=$registro["nombreO"];
                                $resultar["apellidoO"]=$registro["apellidoO"];
                                $resultar["cuentaO"]=$registro["cuentasO"];
                                $resultar["cantidad"]=$registro["cantidad"];
                                $resultar["descripcionO"]=$registro["descripcionO"];
                                $resultar["descripcionD"]=$registro["descripcionD"];
                                $resultar["fecha"]=$registro["fecha"];
                                $resultar["empresaD"]=$registro["empresaD"];
                                $resultar["tipoD"]=$registro["tipoD"];
                                $resultar["nombreD"]=$registro["nombreD"];
                                $resultar["apellidoD"]=$registro["apellidoD"];
                                $resultar["cuentaD"]=$registro["cuentasD"];
                                $json['aprobacion'][]=$resultar;
                            }
                            echo json_encode($json);
                        }
                        else{
                            $resultar["mensaje"]="no existe";
                            $json['aprobacion'][]=$resultar;
                            echo json_encode($json);
                        }
                    }
                }
                break;
            }
            case 17:{
                if(isset($_POST["usuario"])&&isset($_POST["dni"])){
                    $consulta="UPDATE `perfiles` SET `identidad`='$identidad',`fecha_actividad`='$fecha_actividad', `hora_actividad`='$hora_actividad' WHERE (`usuario`='$usuario')";
                    $resultado=mysqli_query($conexion,$consulta);
                    if($resultado){
                        $resultar["mensaje"]="guardado";
                        $json['aprobacion'][]=$resultar;
                        echo json_encode($json);
                    }
                }
                break;
            }
            case 18:{
                if(isset($_POST["usuario"])&&isset($_POST["telefono"])){
                    $telefonofinal="+504".$telefono;
                    $consulta="UPDATE `perfiles` SET `telefono`='$telefonofinal',`fecha_actividad`='$fecha_actividad', `hora_actividad`='$hora_actividad' WHERE (`usuario`='$usuario')";
                    $resultado=mysqli_query($conexion,$consulta);
                    if($resultado){
                        $resultar["mensaje"]="guardado";
                        $json['aprobacion'][]=$resultar;
                        echo json_encode($json);
                    }
                }
                break;
            }
            case 19:{
                if(isset($_POST["usuario"])&&isset($_POST["clave"])){
                    $consulta="UPDATE `perfiles` SET `clave`='$clave',`fecha_actividad`='$fecha_actividad', `hora_actividad`='$hora_actividad' WHERE (`usuario`='$usuario')";
                    $resultado=mysqli_query($conexion,$consulta);
                    if($resultado){
                        $resultar["mensaje"]="guardado";
                        $json['aprobacion'][]=$resultar;
                        echo json_encode($json);
                    }
                }
                break;
            }
            case 20:{
                if(isset($_POST["usuario"])){
                    $consulta="SELECT * FROM `perfiles` WHERE (`usuario`='$usuario')";
                    $resultado=mysqli_query($conexion,$consulta);
                    if($resultado){
                        if($resultado->num_rows>0){
                            if($registro=mysqli_fetch_array($resultado)){
                                $resultar["mensaje"]="encontrado";
                                $resultar["nombre"]=$registro["nombre"];
                                $resultar["apellido"]=$registro["apellido"];
                                $resultar["identidad"]=$registro["identidad"];
                                $resultar["telefono"]=$registro["telefono"];
                                $resultar["correo"]=$registro["correo"];
                                $resultar["fecha_creacion"]=$registro["fecha_creacion"];
                                $resultar["hora_creacion"]=$registro["hora_creacion"];
                                $resultar["fecha_actividad"]=$registro["fecha_actividad"];
                                $resultar["hora_actividad"]=$registro["hora_actividad"];
                                $json['aprobacion'][]=$resultar;
                                echo json_encode($json);
                            }
                        }
                        else{
                            $resultar["mensaje"]="no existe";
                            $json['aprobacion'][]=$resultar;
                            echo json_encode($json);
                            mysqli_close($conexion);
                        }
                    }
                }
                break;
            }
            case 21:{
                if(isset($_POST['usuario'])){
                    $consulta="SELECT e.empresa, e.clientes, (SELECT p.usuario FROM `cuentas` AS c JOIN `perfiles` AS p ON (c.perfiles=p.id) WHERE (p.usuario='$usuario') AND (e.id=c.empresas) AND (c.estado=1)) AS agregado, (SELECT p.usuario FROM `solicitud` AS s JOIN `perfiles` AS p ON (s.perfiles=p.id)  WHERE (p.usuario='$usuario') AND (e.id=s.empresas) AND (`descripcion`=1)) AS proceso FROM `empresas` AS e WHERE (e.empresa!='personal') ORDER BY e.clientes DESC LIMIT 10";
                    $resultado=mysqli_query($conexion,$consulta);
                    if($resultado){
                        if($resultado->num_rows>0){
                            while($registro=mysqli_fetch_assoc($resultado)){
                                $resultar["mensaje"]="aprobado";
                                $resultar["empresa"]=$registro["empresa"];
                                $resultar["usuario"]=$registro["clientes"];
                                $resultar["agregado"]=$registro["agregado"];
                                $resultar["proceso"]=$registro["proceso"];
                                $json['aprobacion'][]=$resultar;
                            }
                            echo json_encode($json);
                        }
                        else{
                            $resultar["mensaje"]="no existe";
                            $json['aprobacion'][]=$resultar;
                            echo json_encode($json);
                        }
                    }
                }
                break;
            }
            case 22:{
                if(isset($_POST["usuario"])&&isset($_POST["cuenta"])){
                    $consulta="SELECT c.credito,p.nombre,p.apellido,p.correo,e.empresa FROM `cuentas` AS c JOIN `perfiles` AS p JOIN `empresas` AS e ON (c.perfiles=p.id AND c.empresas=e.id) WHERE (p.usuario='$usuario') AND (c.cuenta='$cuenta')";
                    $resultado=mysqli_query($conexion,$consulta);
                    if($resultado){
                        if($resultado->num_rows>0){
                            if($registro=mysqli_fetch_array($resultado)){
                                $resultar["mensaje"]="aprobado";
                                $resultar["nombre"]=$registro["nombre"];
                                $resultar["apellido"]=$registro["apellido"];
                                $resultar["correo"]=$registro["correo"];
                                $resultar["correo_origen"]=$correoOrigen;
                                $resultar["clave_correo_origen"]=$claveOrigen;
                                $resultar["credito"]=$registro["credito"];
                                $resultar["empresa"]=$registro["empresa"];
                                $json['aprobacion'][]=$resultar;
                                echo json_encode($json);
                            }
                        }
                        else{
                            $resultar["mensaje"]="no existe";
                            $json['aprobacion'][]=$resultar;
                            echo json_encode($json);
                            mysqli_close($conexion);
                        }
                    }
                }
                break;
            }
            case 23:{
                if(isset($_POST["usuario"])&&isset($_POST["cuenta"])&&isset($_POST["cantidad"])&&isset($_POST["empresa"])){
                    $saldo=(double)$cantidad;
                    $consulta="SELECT c.credito FROM `cuentas` AS c JOIN `perfiles` AS p JOIN `empresas` AS e ON (c.perfiles=p.id AND c.empresas=e.id) WHERE (p.usuario='$usuario') AND (c.cuenta='$cuenta') AND (e.empresa='$empresa')";
                    $resultado=mysqli_query($conexion,$consulta);
                    if($resultado){
                        if($resultado->num_rows>0){
                            if($registro=mysqli_fetch_array($resultado)){
                                $credito=(double)$registro["credito"];
                                if($credito>=$saldo){
                                    $consulta="UPDATE `cuentas` AS c JOIN `perfiles` AS p JOIN `empresas` AS e ON (c.perfiles=p.id AND c.empresas=e.id) SET c.credito=c.credito-$saldo WHERE (p.usuario='$usuario') AND (e.empresa='$empresa') AND (c.cuenta='$cuenta')";
                                    $resultado=mysqli_query($conexion,$consulta);
                                    if($resultado){
                                        $consulta="INSERT INTO `solicitud`(`id`, `perfiles`, `descripcion`, `cantidad`, `empresas`) VALUES (NULL,(SELECT `id` FROM `perfiles` WHERE (`usuario`='$usuario')),2,'$saldo',(SELECT `id` FROM `empresas` WHERE (`empresa`='$empresa')))";
                                        $resultado=mysqli_query($conexion,$consulta);
                                        if($resultado){
                                            $resultar["mensaje"]="aprobado";
                                            $json['aprobacion'][]=$resultar;
                                            echo json_encode($json);
                                        }
                                    }
                                }
                                else{
                                    $resultar["mensaje"]="no aprobado";
                                    $json['aprobacion'][]=$resultar;
                                    echo json_encode($json);
                                }
                            }
                        }
                        else{
                            $resultar["mensaje"]="no existe";
                            $json['aprobacion'][]=$resultar;
                            echo json_encode($json);
                        }
                    }
                }
                break;
            }
            case 24:{
                if(isset($_POST["cuentaO"]) && isset($_POST["nombreO"]) && isset($_POST["apellidoO"]) && isset($_POST["cuentaD"]) && isset($_POST["nombreD"]) && isset($_POST["apellidoD"]) && isset($_POST["cantidad"])){
                    $consulta="SELECT t.tipo,c.credito,e.empresa,c.congelado FROM `cuentas` AS c JOIN `tipo` AS t JOIN `empresas` AS e ON (c.tipo=t.id AND c.empresas=e.id) WHERE (c.cuenta='$cuentaO')";
                    $resultado=mysqli_query($conexion,$consulta);
                    if($resultado){
                        if($resultado->num_rows>0){
                            if($registro=mysqli_fetch_array($resultado)){
                                if($registro["tipo"] == "ahorro"){
                                    $cantidadO=$registro["credito"];
                                    $empresaO=$registro["empresa"];
                                    if((Double)$cantidadO >= (Double)$cantidad){
                                        $consulta="SELECT t.tipo,c.credito,e.empresa,c.congelado FROM `cuentas` AS c JOIN `tipo` AS t JOIN `empresas` AS e ON (c.tipo=t.id AND c.empresas=e.id) WHERE (c.cuenta='$cuentaD')";
                                        $resultado=mysqli_query($conexion,$consulta);
                                        if($resultado){
                                            if($resultado->num_rows>0){
                                                if($registro=mysqli_fetch_array($resultado)){
                                                    if($registro["tipo"] == "ahorro"){
                                                        $cantidadD=$registro["credito"];
                                                        $empresa=$registro["empresa"];
                                                        $totalO=(Double)$cantidadO - (Double)$cantidad;
                                                        $totalD=(Double)$cantidadD + (Double)$cantidad;
                                                        $consulta="UPDATE `cuentas` SET `credito`='$totalO' WHERE (`cuenta`='$cuentaO')";
                                                        $resultado=mysqli_query($conexion,$consulta);
                                                        $consulta="UPDATE `cuentas` SET `credito`='$totalD' WHERE (`cuenta`='$cuentaD')";
                                                        $resultado=mysqli_query($conexion,$consulta);
                                                        $consulta="INSERT INTO `historial` (`referencia`, `perfilesO`, `cuentasO`, `empresasO`, `tipoO`, `descripcionO`, `cantidad`, `fecha`, `hora`, `perfilesD`, `cuentasD`,`empresasD`,`tipoD`, `descripcionD`) VALUES (NULL,(SELECT p.id FROM `cuentas` AS c JOIN `perfiles` AS p ON (c.perfiles=p.id) WHERE (p.nombre='$nombreO') AND (p.apellido='$apellidoO') AND (c.cuenta='$cuentaO')),'$cuentaO',(SELECT `id` FROM `empresas` WHERE (`empresa`='$empresaO')),1,3,'$cantidad','$fecha_actividad','$hora_actividad',(SELECT p.id FROM `cuentas` AS c JOIN`perfiles` AS p ON (c.perfiles=p.id) WHERE (p.nombre='$nombreD') AND (p.apellido='$apellidoD') AND (c.cuenta='$cuentaD')),'$cuentaD',(SELECT `id` FROM `empresas` WHERE (`empresa`='$empresa')),1,4)";
                                                        $resultado=mysqli_query($conexion,$consulta);
                                                        $resultar["mensaje"]="aprobado";
                                                        $json['aprobacion'][]=$resultar;
                                                        echo json_encode($json);
                                                    }
                                                    else{
                                                        $cantidadD=$registro["congelado"];
                                                        $empresa=$registro["empresa"];
                                                        $totalO=(Double)$cantidadO - (Double)$cantidad;
                                                        $totalD=(Double)$cantidadD + (Double)$cantidad;
                                                        $consulta="UPDATE `cuentas` SET `credito`='$totalO' WHERE (`cuenta`='$cuentaO')";
                                                        $resultado=mysqli_query($conexion,$consulta);
                                                        $consulta="UPDATE `cuentas` SET `congelado`='$totalD' WHERE (`cuenta`='$cuentaD')";
                                                        $resultado=mysqli_query($conexion,$consulta);
                                                        $consulta="INSERT INTO `historial` (`referencia`, `perfilesO`, `cuentasO`, `empresasO`, `tipoO`, `descripcionO`, `cantidad`, `fecha`, `hora`, `perfilesD`, `cuentasD`,`empresasD`,`tipoD`, `descripcionD`) VALUES (NULL,(SELECT p.id FROM `cuentas` AS c JOIN `perfiles` AS p ON (c.perfiles=p.id) WHERE (p.nombre='$nombreO') AND (p.apellido='$apellidoO') AND (c.cuenta='$cuentaO')),'$cuentaO',(SELECT `id` FROM `empresas` WHERE (`empresa`='$empresaO')),1,3,'$cantidad','$fecha_actividad','$hora_actividad',(SELECT p.id FROM `cuentas` AS c JOIN `perfiles` AS p ON (c.perfiles=p.id) WHERE (p.nombre='$nombreD') AND (p.apellido='$apellidoD') AND (c.cuenta='$cuentaD')),'$cuentaD',(SELECT `id` FROM `empresas` WHERE (`empresa`='$empresa')),2,4)";
                                                        $resultado=mysqli_query($conexion,$consulta);
                                                        $resultar["mensaje"]="aprobado";
                                                        $json['aprobacion'][]=$resultar;
                                                        echo json_encode($json);
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    else{
                                        $resultar["mensaje"]="no existe";
                                        $json['aprobacion'][]=$resultar;
                                        echo json_encode($json);
                                    }
                                }
                                else{
                                    $cantidadO=$registro["congelado"];
                                    $empresaO=$registro["empresa"];
                                    if((Double)$cantidadO >= (Double)$cantidad){
                                        $consulta="SELECT t.tipo,c.credito,e.empresa,c.congelado FROM `cuentas` AS c JOIN `tipo` AS t JOIN `empresas` AS e ON (c.tipo=t.id AND c.empresas=e.id) WHERE (`cuenta`='$cuentaD')";
                                        $resultado=mysqli_query($conexion,$consulta);
                                        if($resultado){
                                            if($resultado->num_rows>0){
                                                if($registro=mysqli_fetch_array($resultado)){
                                                    if($registro["tipo"] == "ahorro"){
                                                        $cantidadD=$registro["credito"];
                                                        $empresa=$registro["empresa"];
                                                        $totalO=(Double)$cantidadO - (Double)$cantidad;
                                                        $totalD=(Double)$cantidadD + (Double)$cantidad;
                                                        $consulta="UPDATE `cuentas` SET `congelado`='$totalO' WHERE (`cuenta`='$cuentaO')";
                                                        $resultado=mysqli_query($conexion,$consulta);
                                                        $consulta="UPDATE `cuentas` SET `credito`='$totalD' WHERE (`cuenta`='$cuentaD')";
                                                        $resultado=mysqli_query($conexion,$consulta);
                                                        $consulta="INSERT INTO `historial` (`referencia`, `perfilesO`, `cuentasO`, `empresasO`, `tipoO`, `descripcionO`, `cantidad`, `fecha`, `hora`, `perfilesD`, `cuentasD`,`empresasD`,`tipoD`, `descripcionD`) VALUES (NULL,(SELECT p.id FROM `cuentas` AS c JOIN `perfiles` AS p ON (c.perfiles=p.id) WHERE (p.nombre='$nombreO') AND (p.apellido='$apellidoO') AND (c.cuenta='$cuentaO')),'$cuentaO',(SELECT `id` FROM `empresas` WHERE (`empresa`='$empresaO')),2,3,'$cantidad','$fecha_actividad','$hora_actividad',(SELECT p.id FROM `cuentas` AS c JOIN `perfiles` AS p ON (c.perfiles=p.id) WHERE (p.nombre='$nombreD') AND (p.apellido='$apellidoD') AND (c.cuenta='$cuentaD')),'$cuentaD',(SELECT `id` FROM `empresas` WHERE (`empresa`='$empresa')),1,4)";
                                                        $resultado=mysqli_query($conexion,$consulta);
                                                        $resultar["mensaje"]="aprobado";
                                                        $json['aprobacion'][]=$resultar;
                                                        echo json_encode($json);
                                                    }
                                                    else{
                                                        $cantidadD=$registro["congelado"];
                                                        $empresa=$registro["empresa"];
                                                        $totalO=(Double)$cantidadO - (Double)$cantidad;
                                                        $totalD=(Double)$cantidadD + (Double)$cantidad;
                                                        $consulta="UPDATE `cuentas` SET `congelado`='$totalO' WHERE (`cuenta`='$cuentaO')";
                                                        $resultado=mysqli_query($conexion,$consulta);
                                                        $consulta="UPDATE `cuentas` SET `congelado`='$totalD' WHERE (`cuenta`='$cuentaD')";
                                                        $resultado=mysqli_query($conexion,$consulta);
                                                        $consulta="INSERT INTO `historial` (`referencia`, `perfilesO`, `cuentasO`, `empresasO`, `tipoO`, `descripcionO`, `cantidad`, `fecha`, `hora`, `perfilesD`, `cuentasD`,`empresasD`,`tipoD`, `descripcionD`) VALUES (NULL,(SELECT p.id FROM `cuentas` AS c JOIN `perfiles` AS p ON (c.perfiles=p.id) WHERE (p.nombre='$nombreO') AND (p.apellido='$apellidoO') AND (c.cuenta='$cuentaO')),'$cuentaO',(SELECT `id` FROM `empresas` WHERE (`empresa`='$empresaO')),2,3,'$cantidad','$fecha_actividad','$hora_actividad',(SELECT p.id FROM `cuentas` AS c JOIN `perfiles` AS p ON (c.perfiles=p.id) WHERE (p.nombre='$nombreD') AND (p.apellido='$apellidoD') AND (c.cuenta='$cuentaD')),'$cuentaD',(SELECT `id` FROM `empresas` WHERE (`empresa`='$empresa')),2,4)";
                                                        $resultado=mysqli_query($conexion,$consulta);
                                                        $resultar["mensaje"]="aprobado";
                                                        $json['aprobacion'][]=$resultar;
                                                        echo json_encode($json);
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    else{
                                        $resultar["mensaje"]="no existe";
                                        $json['aprobacion'][]=$resultar;
                                        echo json_encode($json);
                                    }
                                }
                            }
                        }
                        else{
                            $resultar["mensaje"]="no existe";
                            $json['aprobacion'][]=$resultar;
                            echo json_encode($json);
                        }
                    }
                }
                break;
            }
            case 25:{
                if(isset($_POST["cuenta"])){
                    $consulta="SELECT p.usuario FROM `cuentas` AS c JOIN `perfiles` AS p ON (c.perfiles=p.id) WHERE (`cuenta`='$cuenta') AND (c.estado=1)";
                    $resultado=mysqli_query($conexion,$consulta);
                    if($resultado){
                        if($resultado->num_rows>0){
                            if($registro=mysqli_fetch_array($resultado)){
                                $usuario=$registro["usuario"];
                                $consulta="SELECT * FROM `perfiles` WHERE (`usuario`='$usuario')";
                                $resultado=mysqli_query($conexion,$consulta);
                                if($resultado){
                                    if($resultado->num_rows>0){
                                        if($registro=mysqli_fetch_array($resultado)){
                                            $resultar["mensaje"]="aprobado";
                                            $resultar["nombre"]=$registro["nombre"];
                                            $resultar["apellido"]=$registro["apellido"];
                                            $json['aprobacion'][]=$resultar;
                                            echo json_encode($json);
                                        }
                                    }
                                }
                            }
                        }
                        else{
                            $resultar["mensaje"]="no existe";
                            $json['aprobacion'][]=$resultar;
                            echo json_encode($json);
                            mysqli_close($conexion);
                        }
                    }
                }
                break;
            }
            case 26:{
                if(isset($_POST["usuario"]) && isset($_POST["empresa"])){
                    $consulta="SELECT * FROM `cuentas` AS c JOIN `perfiles` AS p JOIN `empresas` AS e ON (c.perfiles=p.id AND c.empresas=e.id) WHERE (e.empresa='$empresa') AND (p.usuario='$usuario') AND (c.estado=1)";
                    $resultado=mysqli_query($conexion,$consulta);
                    if($resultado){
                        if($resultado->num_rows>0){
                            $resultar["mensaje"]="existe";
                            $json['aprobacion'][]=$resultar;
                            echo json_encode($json);
                        }
                        else{
                            $consulta="SELECT * FROM `solicitud` AS s JOIN `perfiles` AS p JOIN `empresas` AS e JOIN `descripcion` d ON (s.perfiles=p.id AND s.empresas=e.id AND s.descripcion=d.id) WHERE (p.usuario='$usuario') AND (d.descripcion='agregar') AND (e.empresa='$empresa')";
                            $resultado=mysqli_query($conexion,$consulta);
                            if($resultado){
                                if($resultado->num_rows>0){
                                    $resultar["mensaje"]="enviado";
                                    $json['aprobacion'][]=$resultar;
                                    echo json_encode($json);
                                }
                                else{
                                    $consulta="INSERT INTO `solicitud`(`id`, `perfiles`, `descripcion`, `cantidad`, `empresas`) VALUES (NULL,(SELECT `id` FROM `perfiles` WHERE (`usuario`='$usuario')),1,0,(SELECT `id` FROM `empresas` WHERE (`empresa`='$empresa')))";
                                    $resultado=mysqli_query($conexion,$consulta);
                                    if($resultado){
                                        $resultar["mensaje"]="registrado";
                                        $json['aprobacion'][]=$resultar;
                                        echo json_encode($json);
                                    }
                                }
                            }
                        }
                    }
                }
                break;
            }
            case 27:{
                $consulta="SELECT p.nombre, p.apellido, c.cuenta, c.congelado FROM `cuentas` AS c JOIN `perfiles` AS p JOIN `empresas` AS e ON (c.perfiles=p.id AND c.empresas=e.id) WHERE (p.usuario='$usuarioP' AND e.empresa='$empresa' AND c.estado=1)";
                $resultado=mysqli_query($conexion,$consulta);
                if($resultado){
                    if($resultado->num_rows>0){
                        if($registro=mysqli_fetch_array($resultado)){
                            $nombreAO=$registro["nombre"];
                            $apellidoAO=$registro["apellido"];
                            $cuentaAO=$registro["cuenta"];
                            $congelado=$registro["congelado"];
                            $consulta="SELECT p.nombre, p.apellido, c.cuenta FROM `cuentas` AS c JOIN `perfiles` AS p JOIN `empresas` AS e ON (c.perfiles=p.id AND c.empresas=e.id) WHERE (p.usuario='$usuario' AND e.empresa='$empresa' AND c.estado=1)";
                            $resultado=mysqli_query($conexion,$consulta);
                            if($resultado){
                                if($resultado->num_rows>0){
                                    if($registro=mysqli_fetch_array($resultado)){
                                        $nombreAD=$registro["nombre"];
                                        $apellidoAD=$registro["apellido"];
                                        $cuentaAD=$registro["cuenta"];
                                        if((double)$congelado>=(double)$cantidad){
                                            $consulta="UPDATE `cuentas` AS c JOIN `perfiles` AS p JOIN `empresas` e ON (c.perfiles=p.id AND c.empresas=e.id) SET c.congelado=c.congelado - $cantidad WHERE (p.usuario='$usuarioP' AND c.cuenta='$cuentaAO' AND e.empresa='$empresa' AND c.estado=1)";
                                            $resultado=mysqli_query($conexion,$consulta);
                                            if($resultado){
                                                $consulta="UPDATE `cuentas` AS c JOIN `perfiles` AS p JOIN `empresas` AS e ON (c.perfiles=p.id AND c.empresas=e.id) SET c.congelado=c.congelado + $cantidad, c.deuda=c.deuda + $cantidad WHERE (p.usuario='$usuario' AND c.cuenta='$cuentaAD' AND e.empresa='$empresa' AND c.estado=1)";
                                                $resultado=mysqli_query($conexion,$consulta);
                                                if($resultado){
                                                    $consulta="INSERT INTO `historial`(`referencia`, `perfilesO`, `cuentasO`, `empresasO`, `tipoO`, `descripcionO`, `cantidad`, `fecha`, `hora`, `perfilesD`, `cuentasD`, `empresasD`, `tipoD`, `descripcionD`) VALUES (NULL,(SELECT p.id FROM `cuentas` AS c JOIN `perfiles` AS p ON (c.perfiles=p.id) WHERE (p.nombre='$nombreAO' AND p.apellido='$apellidoAO' AND c.cuenta='$cuentaAO')),'$cuentaAO',(SELECT `id` FROM `empresas` WHERE (`empresa`='$empresa')),2,5,'$cantidad','$fecha_actividad','$hora_actividad',(SELECT p.id FROM `cuentas` AS c JOIN `perfiles` AS p ON (c.perfiles=p.id) WHERE (p.nombre='$nombreAD' AND p.apellido='$apellidoAD' AND c.cuenta='$cuentaAD')),'$cuentaAD',(SELECT `id` FROM `empresas` WHERE (`empresa`='$empresa')),2,2)";
                                                    $resultado=mysqli_query($conexion,$consulta);
                                                    if($resultado){
                                                        $consulta="DELETE FROM `solicitud` WHERE (`id`='$id')";
                                                        $resultado=mysqli_query($conexion,$consulta);
                                                        if($resultado){
                                                            $consulta="SELECT h.cuentasD,h.fecha,h.hora,h.referencia,h.cantidad,p.nombre AS nombreD,p.apellido AS apellidoD,d.descripcion AS descripcionD FROM `historial` AS h JOIN `perfiles` AS p JOIN `descripcion` d ON (h.perfilesD=p.id AND h.descripcionD=d.id) WHERE (`fecha`='$fecha_actividad' AND `hora`='$hora_actividad')";
                                                            $resultado=mysqli_query($conexion,$consulta);
                                                            if($resultado){
                                                                if($resultado->num_rows>0){
                                                                    if($registro=mysqli_fetch_array($resultado)){
                                                                        $resultar["referencia"]=$registro["referencia"];
                                                                        $resultar["cantidad"]=$registro["cantidad"];
                                                                        $resultar["descripcion"]=$registro["descripcionD"];
                                                                        $resultar["hora"]=$registro["hora"];
                                                                        $resultar["fecha"]=$registro["fecha"];
                                                                        $resultar["nombre"]=$registro["nombreD"];
                                                                        $resultar["apellido"]=$registro["apellidoD"];
                                                                        $resultar["cuenta"]=$registro["cuentasD"];
                                                                        $resultar["mensaje"]="aprobado";
                                                                        $json['aprobacion'][]=$resultar;
                                                                        echo json_encode($json);
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                        else{
                                            $resultar["mensaje"]="insuficiente";
                                            $json['aprobacion'][]=$resultar;
                                            echo json_encode($json);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                break;
            }
            case 28:{
                $consulta="SELECT p.nombre, p.apellido, c.cuenta FROM `cuentas` AS c JOIN `perfiles` AS p JOIN `empresas` AS e ON (c.perfiles=p.id AND c.empresas=e.id) WHERE (p.usuario='$usuarioP' AND e.empresa='$empresa' AND c.estado=1)";
                $resultado=mysqli_query($conexion,$consulta);
                if($resultado){
                    if($resultado->num_rows>0){
                        if($registro=mysqli_fetch_array($resultado)){
                            $nombreAO=$registro["nombre"];
                            $apellidoAO=$registro["apellido"];
                            $cuentaAO=$registro["cuenta"];
                            $consulta="SELECT p.nombre, p.apellido, c.cuenta FROM `cuentas` AS c JOIN `perfiles` AS p JOIN `empresas` AS e ON (c.perfiles=p.id AND c.empresas=e.id) WHERE (p.usuario='$usuario' AND e.empresa='$empresa' AND c.estado=1)";
                            $resultado=mysqli_query($conexion,$consulta);
                            if($resultado){
                                if($resultado->num_rows>0){
                                    if($registro=mysqli_fetch_array($resultado)){
                                        $nombreAD=$registro["nombre"];
                                        $apellidoAD=$registro["apellido"];
                                        $cuentaAD=$registro["cuenta"];
                                        $consulta="UPDATE `cuentas` AS c JOIN `perfiles` AS p JOIN `empresas` AS e ON (c.perfiles=p.id AND c.empresas=e.id) SET c.deuda=c.deuda + $cantidad WHERE (p.usuario='$usuario' AND c.cuenta='$cuentaAD' AND e.empresa='$empresa' AND c.estado=1)";
                                        $resultado=mysqli_query($conexion,$consulta);
                                        if($resultado){
                                            $consulta="INSERT INTO `historial`(`referencia`, `perfilesO`, `cuentasO`, `empresasO`, `tipoO`, `descripcionO`, `cantidad`, `fecha`, `hora`, `perfilesD`, `cuentasD`, `empresasD`, `tipoD`, `descripcionD`) VALUES (NULL,(SELECT p.id FROM `cuentas` AS c JOIN `perfiles` AS p ON (c.perfiles=p.id) WHERE (p.nombre='$nombreAO' AND p.apellido='$apellidoAO' AND c.cuenta='$cuentaAO')),'$cuentaAO',(SELECT `id` FROM `empresas` WHERE (`empresa`='$empresa')),2,6,'$cantidad','$fecha_actividad','$hora_actividad',(SELECT p.id FROM `cuentas` AS c JOIN `perfiles` AS p ON (c.perfiles=p.id) WHERE (p.nombre='$nombreAD' AND p.apellido='$apellidoAD' AND c.cuenta='$cuentaAD')),'$cuentaAD',(SELECT `id` FROM `empresas` WHERE (`empresa`='$empresa')),2,7)";
                                            $resultado=mysqli_query($conexion,$consulta);
                                            if($resultado){
                                                $consulta="DELETE FROM `solicitudes` WHERE (`id`='$id')";
                                                $resultado=mysqli_query($conexion,$consulta);
                                                if($resultado){
                                                    $consulta="SELECT h.cuentasD,h.fecha,h.hora,h.referencia,h.cantidad,p.nombre AS nombreD,p.apellido AS apellidoD,d.descripcion AS descripcionD FROM `historial` AS h JOIN `perfiles` AS p JOIN `descripcion` d ON (h.perfilesD=p.id AND h.descripcionD=d.id) WHERE (`fecha`='$fecha_actividad' AND `hora`='$hora_actividad')";
                                                    $resultado=mysqli_query($conexion,$consulta);
                                                    if($resultado){
                                                        if($resultado->num_rows>0){
                                                            if($registro=mysqli_fetch_array($resultado)){
                                                                $resultar["referencia"]=$registro["referencia"];
                                                                $resultar["cantidad"]=$registro["cantidad"];
                                                                $resultar["descripcion"]=$registro["descripcionD"];
                                                                $resultar["hora"]=$registro["hora"];
                                                                $resultar["fecha"]=$registro["fecha"];
                                                                $resultar["nombre"]=$registro["nombreD"];
                                                                $resultar["apellido"]=$registro["apellidoD"];
                                                                $resultar["cuenta"]=$registro["cuentasD"];
                                                                $resultar["mensaje"]="aprobado";
                                                                $json['aprobacion'][]=$resultar;
                                                                echo json_encode($json);
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                break;
            }
            case 29:{
                if(isset($_POST['usuario']) && isset($_POST['empresa'])){
                    $consulta="SELECT p.nombre, p.apellido, c.cuenta, c.credito, c.deuda, c.intereses, r.rango, p.usuario FROM `cuentas` AS c JOIN `perfiles` AS p JOIN `empresas` AS e JOIN `rangos` r ON (c.perfiles=p.id AND c.empresas=e.id AND c.rangos=r.id) WHERE (p.usuario!='$usuario' AND e.empresa='$empresa' AND c.estado=1) ORDER BY p.nombre ASC, p.apellido ASC";
                    $resultado=mysqli_query($conexion,$consulta);
                    if($resultado){
                        if($resultado->num_rows>0){
                            while($registro=mysqli_fetch_assoc($resultado)){
                                $resultar["mensaje"]="aprobado";
                                $resultar["intereses"]=$registro["intereses"];
                                $resultar["nombre"]=$registro["nombre"];
                                $resultar["apellido"]=$registro["apellido"];
                                $resultar["cuenta"]=$registro["cuenta"];
                                $resultar["credito"]=$registro["credito"];
                                $resultar["capital"]=$registro["deuda"];
                                $resultar["rango"]=$registro["rango"];
                                $resultar["usuario"]=$registro["usuario"];
                                $json['aprobacion'][]=$resultar;
                            }
                            echo json_encode($json);
                        }
                        else{
                            $resultar["mensaje"]="no existe";
                            $json['aprobacion'][]=$resultar;
                            echo json_encode($json);
                        }
                    }
                }
                break;
            }
            case 30:{
                if(isset($_POST['cuenta'])){
                    $consulta="SELECT p.nombre, p.apellido, p.telefono, c.credito, c.deuda, c.intereses, r.rango, c.porcentaje, c.fecha_creacion FROM `cuentas` AS c JOIN `perfiles` AS p JOIN `rangos` AS r ON (c.perfiles=p.id AND c.rangos=r.id) WHERE (c.cuenta='$cuenta')";
                    $resultado=mysqli_query($conexion,$consulta);
                    if($resultado){
                        if($resultado->num_rows>0){
                            if($registro=mysqli_fetch_assoc($resultado)){
                                $resultar["mensaje"]="aprobado";
                                $resultar["intereses"]=$registro["intereses"];
                                $resultar["nombre"]=$registro["nombre"];
                                $resultar["apellido"]=$registro["apellido"];
                                $resultar["credito"]=$registro["credito"];
                                $resultar["deuda"]=$registro["deuda"];
                                $resultar["rango"]=$registro["rango"];
                                $resultar["porcentaje"]=$registro["porcentaje"];
                                $resultar["fechaLimite"]=$registro["fecha_creacion"];
                                $resultar["telefono"]=$registro["telefono"];
                                $json['aprobacion'][]=$resultar;
                            }
                            echo json_encode($json);
                        }
                    }
                }
                break;
            }
            case 31:{
                if(isset($_POST['cuenta']) && isset($_POST["cantidad"]) && isset($_POST["id"])){
                    $consulta="SELECT * FROM `cuentas` WHERE (`cuenta`='$cuenta')";
                    $resultado=mysqli_query($conexion,$consulta);
                    if($id=="1"){
                        if($resultado){
                            if($resultado->num_rows>0){
                                if($registro=mysqli_fetch_assoc($resultado)){
                                    $credito=(double)$registro["credito"] + (double)$cantidad;
                                    $consulta="UPDATE `cuentas`  SET `credito`=$credito WHERE (`cuenta`='$cuenta')";
                                    $resultado=mysqli_query($conexion,$consulta);
                                    if($resultado){
                                        $resultar["mensaje"]="aprobado";
                                        $json['aprobacion'][]=$resultar;
                                    }
                                }
                            }
                        }
                    }
                    else{
                        if($id=="2"){
                            if($resultado){
                                if($resultado->num_rows>0){
                                    if($registro=mysqli_fetch_assoc($resultado)){
                                        if((double)$registro["credito"]>=(double)$cantidad){
                                            $credito=(double)$registro["credito"] - (double)$cantidad;
                                            $consulta="UPDATE `cuentas`  SET `credito`=$credito WHERE (`cuenta`='$cuenta')";
                                            $resultado=mysqli_query($conexion,$consulta);
                                            if($resultado){
                                                $resultar["mensaje"]="aprobado";
                                                $json['aprobacion'][]=$resultar;
                                            }
                                        }
                                        else{
                                            $resultar["mensaje"]="negado";
                                            $json['aprobacion'][]=$resultar;
                                        }
                                    }
                                }
                            }
                        }
                    }
                    echo json_encode($json); 
                }
                break;
            }
            case 32:{
                if(isset($_POST['cuenta']) && isset($_POST["porcentaje"]) && isset($_POST["id"])){
                    $porcentaje=(double)$porcentaje/100;
                    $consulta="SELECT * FROM `cuentas` WHERE (`cuenta`='$cuenta')";
                    $resultado=mysqli_query($conexion,$consulta);
                    if($id=="1"){
                        if($resultado){
                            if($resultado->num_rows>0){
                                if($registro=mysqli_fetch_assoc($resultado)){
                                    $porcentaje=(double)$registro["porcentaje"] + $porcentaje;
                                    $consulta="UPDATE `cuentas`  SET `porcentaje`=$porcentaje WHERE (`cuenta`='$cuenta')";
                                    $resultado=mysqli_query($conexion,$consulta);
                                    if($resultado){
                                        $resultar["mensaje"]="aprobado";
                                        $json['aprobacion'][]=$resultar;
                                    }
                                }
                            }
                        }
                    }
                    else{
                        if($id=="2"){
                            if($resultado){
                                if($resultado->num_rows>0){
                                    if($registro=mysqli_fetch_assoc($resultado)){
                                        if((double)$registro["porcentaje"]>=$porcentaje){
                                            $porcentaje=(double)$registro["porcentaje"] - $porcentaje;
                                            $consulta="UPDATE `cuentas`  SET `porcentaje`=$porcentaje WHERE (`cuenta`='$cuenta')";
                                            $resultado=mysqli_query($conexion,$consulta);
                                            if($resultado){
                                                $resultar["mensaje"]="aprobado";
                                                $json['aprobacion'][]=$resultar;
                                            }
                                        }
                                        else{
                                            $resultar["mensaje"]="negado";
                                            $json['aprobacion'][]=$resultar;
                                        }
                                    }
                                }
                            }
                        }
                    }
                    echo json_encode($json); 
                }
                break;
            }
            case 33:{
                if(isset($_POST['cuenta']) && isset($_POST["rango"])){
                    $consulta="UPDATE `cuentas` SET `rangos`=(SELECT `id` FROM `rangos` WHERE (`rango`='$rango')) WHERE (`cuenta`='$cuenta')";
                    $resultado=mysqli_query($conexion,$consulta);
                    if($resultado){
                        $resultar["mensaje"]="aprobado";
                        $json['aprobacion'][]=$resultar;
                    }
                    echo json_encode($json); 
                }
                break;
            }
            case 34:{
                if(isset($_POST['cuenta']) && isset($_POST["cantidad"]) && isset($_POST["empresa"]) && isset($_POST["id"]) && isset($_POST["cuentaO"])){
                    $consulta="SELECT p.nombre, p.apellido, c.credito, c.deuda FROM `cuentas` AS c JOIN `perfiles` AS p ON (c.perfiles=p.id) WHERE (c.cuenta='$cuenta')";
                    $resultado=mysqli_query($conexion,$consulta);
                    if($resultado){
                        if($resultado->num_rows>0){
                            if($registro=mysqli_fetch_assoc($resultado)){
                                $nombreD=$registro["nombre"];
                                $apellidoD=$registro["apellido"];
                                $creditoD=(double)$registro["credito"];
                                $deudaD=(double)$registro["deuda"];
                                $consulta="SELECT p.nombre, p.apellido FROM `cuentas` AS c JOIN `perfiles` AS p ON (c.perfiles=p.id) WHERE (c.cuenta='$cuentaO')";
                                $resultado=mysqli_query($conexion,$consulta);
                                if($resultado){
                                    if($resultado->num_rows>0){
                                        if($registro=mysqli_fetch_assoc($resultado)){
                                            $nombreO=$registro["nombre"];
                                            $apellidoO=$registro["apellido"];
                                            if($id=="1"){
                                                if($creditoD>=(double)$cantidad){
                                                    $deudaT=$deudaD+(double)$cantidad;
                                                    $creditoT=$creditoD-(double)$cantidad;
                                                    $consulta="UPDATE `cuentas`  SET `credito`=$creditoT, `deuda`=$deudaT WHERE (`cuenta`='$cuenta')";
                                                    $resultado=mysqli_query($conexion,$consulta);
                                                    if($resultado){
                                                        $consulta="INSERT INTO `historial` (`referencia`, `perfilesO`, `cuentasO`, `empresasO`, `tipoO`, `descripcionO`, `cantidad`, `fecha`, `hora`, `perfilesD`, `cuentasD`,`empresasD`,`tipoD`, `descripcionD`) VALUES (NULL,(SELECT p.id FROM `cuentas` AS c JOIN `perfiles` AS p ON (c.perfiles=p.id) WHERE (p.nombre='$nombreO') AND (p.apellido='$apellidoO') AND (c.cuenta='$cuentaO')),'$cuentaO',(SELECT `id` FROM `empresas` WHERE (`empresa`='$empresa')),2,8,'$cantidad','$fecha_actividad','$hora_actividad',(SELECT p.id FROM `cuentas` AS c JOIN `perfiles` AS p ON (c.perfiles=p.id) WHERE (p.nombre='$nombreD') AND (p.apellido='$apellidoD') AND (c.cuenta='$cuenta')),'$cuenta',(SELECT `id` FROM `empresas` WHERE (`empresa`='$empresa')),2,9)";
                                                        $resultado=mysqli_query($conexion,$consulta);
                                                        if($resultado){
                                                            $resultar["mensaje"]="aprobado";
                                                            $json['aprobacion'][]=$resultar;
                                                        }
                                                    }
                                                }
                                                else{
                                                    $resultar["mensaje"]="negado";
                                                    $json['aprobacion'][]=$resultar;
                                                }
                                            }
                                            else{
                                                if($id=="2"){
                                                    if($deudaD>=(double)$cantidad){
                                                        $deudaT=$deudaD-(double)$cantidad;
                                                        $creditoT=$creditoD+(double)$cantidad;
                                                        $consulta="UPDATE `cuentas`  SET `credito`=$creditoT, `deuda`=$deudaT WHERE (`cuenta`='$cuenta')";
                                                        $resultado=mysqli_query($conexion,$consulta);
                                                        if($resultado){
                                                            $consulta="INSERT INTO `historial`(`referencia`, `perfilesO`, `cuentasO`, `empresasO`, `tipoO`, `descripcionO`, `cantidad`, `fecha`, `hora`, `perfilesD`, `cuentasD`, `empresasD`, `tipoD`, `descripcionD`) VALUES (NULL,(SELECT p.id FROM `cuentas` AS c JOIN `perfiles` AS p ON (c.perfiles=p.id) WHERE (p.nombre='$nombreO' AND p.apellido='$apellidoO' AND c.cuenta='$cuentaO')),'$cuentaO',(SELECT `id` FROM `empresas` WHERE (`empresa`='$empresa')),2,10,'$cantidad','$fecha_actividad','$hora_actividad',(SELECT p.id FROM `cuentas` AS c JOIN `perfiles` AS p ON (c.perfiles=p.id) WHERE (p.nombre='$nombreD' AND p.apellido='$apellidoD' AND c.cuenta='$cuenta')),'$cuenta',(SELECT `id` FROM `empresas` WHERE (`empresa`='$empresa')),2,11)";
                                                            $resultado=mysqli_query($conexion,$consulta);
                                                            if($resultado){
                                                                $resultar["mensaje"]="aprobado";
                                                                $json['aprobacion'][]=$resultar;
                                                            }
                                                        }
                                                    }
                                                    else{
                                                        $resultar["mensaje"]="insuficiente";
                                                        $json['aprobacion'][]=$resultar;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    echo json_encode($json); 
                }
                break;
            }
            case 35:{
                if(isset($_POST['cuenta']) && isset($_POST["cantidad"]) && isset($_POST["empresa"]) && isset($_POST["id"]) && isset($_POST["cuentaO"])){
                    $consulta="SELECT p.nombre, p.apellido, c.intereses, c.deuda FROM `cuentas` AS c JOIN `perfiles` AS p ON (c.perfiles=p.id) WHERE (c.cuenta='$cuenta')";
                    $resultado=mysqli_query($conexion,$consulta);
                    if($resultado){
                        if($resultado->num_rows>0){
                            if($registro=mysqli_fetch_assoc($resultado)){
                                $nombreD=$registro["nombre"];
                                $apellidoD=$registro["apellido"];
                                $interesesD=(double)$registro["intereses"];
                                $deuda=(double)$registro["deuda"];
                                $consulta="SELECT p.nombre, p.apellido FROM `cuentas` AS c JOIN `perfiles` AS p ON (c.perfiles=p.id) WHERE (c.cuenta='$cuentaO')";
                                $resultado=mysqli_query($conexion,$consulta);
                                if($resultado){
                                    if($resultado->num_rows>0){
                                        if($registro=mysqli_fetch_assoc($resultado)){
                                            $nombreO=$registro["nombre"];
                                            $apellidoO=$registro["apellido"];
                                            if($id=="1"){
                                                if($deuda>0){
                                                    $interesesT=(double)$cantidad;
                                                    $consulta="UPDATE `cuentas`  SET `intereses`=$interesesT WHERE (`cuenta`='$cuenta')";
                                                    $resultado=mysqli_query($conexion,$consulta);
                                                    if($resultado){
                                                        $consulta="INSERT INTO `historial`(`referencia`, `perfilesO`, `cuentasO`, `empresasO`, `tipoO`, `descripcionO`, `cantidad`, `fecha`, `hora`, `perfilesD`, `cuentasD`, `empresasD`, `tipoD`, `descripcionD`) VALUES (NULL,(SELECT p.id FROM `cuentas` AS c JOIN `perfiles` AS p ON (c.perfiles=p.id) WHERE (p.nombre='$nombreO' AND p.apellido='$apellidoO' AND c.cuenta='$cuentaO')),'$cuentaO',(SELECT `id` FROM `empresas` WHERE (`empresa`='$empresa')),2,12,'$cantidad','$fecha_actividad','$hora_actividad',(SELECT p.id FROM `cuentas` AS c JOIN `perfiles` AS p ON (c.perfiles=p.id) WHERE (p.nombre='$nombreD' AND p.apellido='$apellidoD' AND c.cuenta='$cuenta')),'$cuenta',(SELECT `id` FROM `empresas` WHERE (`empresa`='$empresa')),2,13)";
                                                        $resultado=mysqli_query($conexion,$consulta);
                                                        if($resultado){
                                                            $resultar["mensaje"]="aprobado";
                                                            $json['aprobacion'][]=$resultar;
                                                        }
                                                    }
                                                }
                                                else{
                                                    $resultar["mensaje"]="negado";
                                                    $json['aprobacion'][]=$resultar;
                                                }
                                            }
                                            else{
                                                if($id=="2"){
                                                    if($interesesD>=(double)$cantidad){
                                                        $interesesT=$interesesD-(double)$cantidad;
                                                        $consulta="UPDATE `cuentas` SET `intereses`=$interesesT WHERE (`cuenta`='$cuenta')";
                                                        $resultado=mysqli_query($conexion,$consulta);
                                                        if($resultado){
                                                            $consulta="INSERT INTO `historial`(`referencia`, `perfilesO`, `cuentasO`, `empresasO`, `tipoO`, `descripcionO`, `cantidad`, `fecha`, `hora`, `perfilesD`, `cuentasD`, `empresasD`, `tipoD`, `descripcionD`) VALUES (NULL,(SELECT p.id FROM `cuentas` AS c JOIN `perfiles` AS p ON (c.perfiles=p.id) WHERE (p.nombre='$nombreO' AND p.apellido='$apellidoO' AND c.cuenta='$cuentaO')),'$cuentaO',(SELECT `id` FROM `empresas` WHERE (`empresa`='$empresa')),2,14,'$cantidad','$fecha_actividad','$hora_actividad',(SELECT p.id FROM `cuentas` AS c JOIN `perfiles` AS p ON (c.perfiles=p.id) WHERE (p.nombre='$nombreD' AND p.apellido='$apellidoD' AND c.cuenta='$cuenta')),'$cuenta',(SELECT `id` FROM `empresas` WHERE (`empresa`='$empresa')),2,15)";
                                                            $resultado=mysqli_query($conexion,$consulta);
                                                            if($resultado){
                                                                $resultar["mensaje"]="aprobado";
                                                                $json['aprobacion'][]=$resultar;
                                                            }
                                                        }
                                                    }
                                                    else{
                                                        $resultar["mensaje"]="insuficiente";
                                                        $json['aprobacion'][]=$resultar;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    echo json_encode($json);
                }
                break;
            }
            case 36:{
                if(isset($_POST["cuenta"]) && isset($_POST["empresa"])){
                    $consulta="SELECT * FROM `cuentas` WHERE (`cuenta`='$cuenta')";
                    $resultado=mysqli_query($conexion,$consulta);
                    if($resultado){
                        if($resultado->num_rows>0){
                            if($registro=mysqli_fetch_assoc($resultado)){
                                $deuda=(double)$registro["deuda"];
                                $congelado=(double)$registro["congelado"];
                                if($deuda<1){
                                    if($congelado<1){
                                        $consulta="UPDATE `cuentas` SET `estado`=2 WHERE (`cuenta`='$cuenta')";
                                        $resultado=mysqli_query($conexion,$consulta);
                                        if($resultado){
                                            $consulta="UPDATE `empresas` AS e SET e.clientes=e.clientes-1 WHERE (`empresa`='$empresa')";
                                            $resultado=mysqli_query($conexion,$consulta);
                                            if($resultado){
                                                $resultar["mensaje"]="aprobado";
                                                $json['aprobacion'][]=$resultar;
                                            }
                                        }
                                    }
                                    else{
                                        $resultar["mensaje"]="tiene dinero";
                                        $json['aprobacion'][]=$resultar;
                                    }
                                }
                                else{
                                    $resultar["mensaje"]="negado";
                                    $json['aprobacion'][]=$resultar;
                                }
                            }
                        }
                    }
                    echo json_encode($json);
                }
                break;
            }
            case 37:{
                if(isset($_POST["cuenta"]) && isset($_POST["empresa"])){
                    $consulta="SELECT r.rango,c.deuda,c.congelado FROM `cuentas` AS c JOIN `rangos` AS r ON (c.rangos=r.id) WHERE (`cuenta`='$cuenta')";
                    $resultado=mysqli_query($conexion,$consulta);
                    if($resultado){
                        if($resultado->num_rows>0){
                            if($registro=mysqli_fetch_assoc($resultado)){
                                if($registro["rango"]=="usuario"){
                                    $deuda=(double)$registro["deuda"];
                                    $congelado=(double)$registro["congelado"];
                                    if($deuda<1){
                                        if($congelado<1){
                                            $consulta="UPDATE `cuentas` SET `estado`=2 WHERE (`cuenta`='$cuenta')";
                                            $resultado=mysqli_query($conexion,$consulta);
                                            if($resultado){
                                                $consulta="UPDATE `empresas` AS e SET e.clientes=e.clientes-1 WHERE (`empresa`='$empresa')";
                                                $resultado=mysqli_query($conexion,$consulta);
                                                if($resultado){
                                                    $resultar["mensaje"]="aprobado";
                                                    $json['aprobacion'][]=$resultar;
                                                }
                                            }
                                        }
                                        else{
                                            $resultar["mensaje"]="tiene dinero";
                                            $json['aprobacion'][]=$resultar;
                                        }
                                    }
                                    else{
                                        $resultar["mensaje"]="negado";
                                        $json['aprobacion'][]=$resultar;
                                    }
                                }
                                else{
                                    $resultar["mensaje"]="es trabajador";
                                        $json['aprobacion'][]=$resultar;
                                }
                            }
                        }
                    }
                    echo json_encode($json);
                }
                break;
            }
            case 38:{
                if(isset($_POST['cuenta']) && isset($_POST["fechaI"]) && isset($_POST["fechaF"])){
                    $consulta="SELECT `referencia`, p.nombre AS nombreO, p.apellido AS apellidoO, `cuentasO`, e.empresa AS empresaO, t.tipo AS tipoO, d.descripcion AS descripcionO, `cantidad`, `fecha`, `hora`, p2.nombre AS nombreD, p2.apellido AS apellidoD, `cuentasD`, e2.empresa AS empresaD, t2.tipo AS tipoD, d2.descripcion AS descripcionD FROM `historial` AS h JOIN `perfiles` AS p JOIN `perfiles` AS p2 JOIN `empresas` AS e JOIN `empresas` AS e2 JOIN `tipo` AS t JOIN `tipo` AS t2 JOIN `descripcion` d JOIN `descripcion` d2 ON (h.perfilesO=p.id AND h.perfilesD=p2.id AND h.empresasO=e.id AND h.empresasD=e2.id AND h.tipoO=t.id AND h.tipoD=t2.id AND h.descripcionO=d.id AND h.descripcionD=d2.id) WHERE ((`fecha` BETWEEN '$fechaI' AND '$fechaF') AND ((`cuentasO`='$cuenta') OR (`cuentasD`='$cuenta'))) ORDER BY `referencia` DESC";
                    $resultado=mysqli_query($conexion,$consulta);
                    if($resultado){
                        if($resultado->num_rows>0){
                            while($registro=mysqli_fetch_assoc($resultado)){
                                $resultar["mensaje"]="aprobado";
                                $resultar["referencia"]=$registro["referencia"];
                                $resultar["empresaO"]=$registro["empresaO"];
                                $resultar["tipoO"]=$registro["tipoO"];
                                $resultar["nombreO"]=$registro["nombreO"];
                                $resultar["apellidoO"]=$registro["apellidoO"];
                                $resultar["cuentaO"]=$registro["cuentasO"];
                                $resultar["cantidad"]=$registro["cantidad"];
                                $resultar["descripcionO"]=$registro["descripcionO"];
                                $resultar["descripcionD"]=$registro["descripcionD"];
                                $resultar["fecha"]=$registro["fecha"];
                                $resultar["empresaD"]=$registro["empresaD"];
                                $resultar["tipoD"]=$registro["tipoD"];
                                $resultar["nombreD"]=$registro["nombreD"];
                                $resultar["apellidoD"]=$registro["apellidoD"];
                                $resultar["cuentaD"]=$registro["cuentasD"];
                                $json['aprobacion'][]=$resultar;
                            }
                            echo json_encode($json);
                        }
                        else{
                            $resultar["mensaje"]="no existe";
                            $json['aprobacion'][]=$resultar;
                            echo json_encode($json);
                        }
                    }
                }
                break;
            }
            case 39:{
                if(isset($_POST['empresa'])&&isset($_POST['usuario'])){
                    $consulta="SELECT e.empresa, e.clientes, (SELECT p.usuario FROM `cuentas` AS c JOIN `perfiles` AS p ON (c.perfiles=p.id) WHERE (p.usuario='$usuario') AND (e.id=c.empresas) AND (c.estado=1)) AS agregado, (SELECT p.usuario FROM `solicitud` AS s JOIN `perfiles` AS p ON (s.perfiles=p.id)  WHERE (p.usuario='$usuario') AND (e.id=s.empresas) AND (`descripcion`=1)) AS proceso FROM `empresas` AS e WHERE (e.empresa LIKE '%$empresa%' AND e.empresa!='personal') ORDER BY e.clientes DESC";
                    $resultado=mysqli_query($conexion,$consulta);
                    if($resultado){
                        if($resultado->num_rows>0){
                            while($registro=mysqli_fetch_assoc($resultado)){
                                $resultar["mensaje"]="aprobado";
                                $resultar["empresa"]=$registro["empresa"];
                                $resultar["usuario"]=$registro["clientes"];
                                $resultar["agregado"]=$registro["agregado"];
                                $resultar["proceso"]=$registro["proceso"];
                                $json['aprobacion'][]=$resultar;
                            }
                            echo json_encode($json);
                        }
                        else{
                            $resultar["mensaje"]="no existe";
                            $json['aprobacion'][]=$resultar;
                            echo json_encode($json);
                        }
                    }
                }
                break;
            }
            case 40:{
                if(isset($_POST['usuario']) && isset($_POST['empresa']) && isset($_POST["nombre"])){
                    $consulta="SELECT p.nombre, p.apellido, c.cuenta, c.credito, c.deuda, c.intereses, r.rango, p.usuario FROM `cuentas` AS c JOIN `perfiles` AS p JOIN `empresas` AS e JOIN `rangos` AS r ON (c.perfiles=p.id AND c.empresas=e.id AND c.rangos=r.id) WHERE p.usuario!='$usuario' AND e.empresa='$empresa' AND c.estado=1 AND (p.nombre LIKE '%$nombre%' OR p.apellido LIKE '%$nombre%') ORDER BY p.nombre ASC, p.apellido ASC";
                    $resultado=mysqli_query($conexion,$consulta);
                    if($resultado){
                        if($resultado->num_rows>0){
                            while($registro=mysqli_fetch_assoc($resultado)){
                                $resultar["mensaje"]="aprobado";
                                $resultar["intereses"]=$registro["intereses"];
                                $resultar["nombre"]=$registro["nombre"];
                                $resultar["apellido"]=$registro["apellido"];
                                $resultar["cuenta"]=$registro["cuenta"];
                                $resultar["credito"]=$registro["credito"];
                                $resultar["capital"]=$registro["deuda"];
                                $resultar["rango"]=$registro["rango"];
                                $resultar["usuario"]=$registro["usuario"];
                                $json['aprobacion'][]=$resultar;
                            }
                            echo json_encode($json);
                        }
                        else{
                            $resultar["mensaje"]="no existe";
                            $json['aprobacion'][]=$resultar;
                            echo json_encode($json);
                        }
                    }
                }
                break;
            }
            case 41:{
                if(isset($_POST["cuenta"])&&isset($_POST["empresa"])&&isset($_POST["cuentaO"])){
                    $consulta="SELECT p.usuario,c.deuda,c.intereses FROM `cuentas` AS c JOIN `perfiles` AS p JOIN `empresas` AS e ON (c.perfiles=p.id AND c.empresas=e.id) WHERE (`cuenta`='$cuenta') AND (c.estado=1) AND (e.empresa='$empresa') AND (`cuenta`!='$cuentaO' AND `rangos`!=1)";
                    $resultado=mysqli_query($conexion,$consulta);
                    if($resultado){
                        if($resultado->num_rows>0){
                            if($registro=mysqli_fetch_array($resultado)){
                                $usuario=$registro["usuario"];
                                $deuda=$registro["deuda"];
                                $intereses=$registro["intereses"];
                                $consulta="SELECT * FROM `perfiles` WHERE (`usuario`='$usuario')";
                                $resultado=mysqli_query($conexion,$consulta);
                                if($resultado){
                                    if($resultado->num_rows>0){
                                        if($registro=mysqli_fetch_array($resultado)){
                                            $resultar["mensaje"]="aprobado";
                                            $resultar["nombre"]=$registro["nombre"];
                                            $resultar["apellido"]=$registro["apellido"];
                                            $resultar["deuda"]=$deuda;
                                            $resultar["intereses"]=$intereses;
                                            $json['aprobacion'][]=$resultar;
                                        }
                                    }
                                }
                            }
                        }
                        else{
                            $resultar["mensaje"]="no existe";
                            $json['aprobacion'][]=$resultar;
                        }
                        echo json_encode($json);
                    }
                }
                break;
            }
            case 42:{
                if(isset($_POST["cuenta"]) && isset($_POST["cuentaO"]) && isset($_POST["cantidad"]) && isset($_POST["empresa"])){
                    $consulta="SELECT p.nombre, p.apellido, c.deuda, c.intereses, c.fecha_creacion FROM `cuentas` AS c JOIN `perfiles` AS p ON (c.perfiles=p.id) WHERE (c.cuenta='$cuenta')";
                    $resultado=mysqli_query($conexion,$consulta);
                    if($resultado){
                        if($resultado->num_rows>0){
                            if($registro=mysqli_fetch_array($resultado)){
                                $nombreD=$registro["nombre"];
                                $apellidoD=$registro["apellido"];
                                $deuda=$registro["deuda"];
                                $intereses=$registro["intereses"];
                                $fecha_limite=new DateTime($registro["fecha_creacion"]);
                                $fecha=new DateTime($fecha_actividad);
                                if($fecha_limite>=$fecha){
                                    if((double)$intereses>=(double)$cantidad){
                                        $cantidadR=(double)$cantidad;
                                        $consulta="UPDATE `cuentas` AS c SET c.intereses=c.intereses-$cantidadR WHERE c.cuenta='$cuenta'";
                                        $resultado=mysqli_query($conexion,$consulta);
                                        if($resultado){
                                            $consulta="SELECT p.nombre, p.apellido FROM `cuentas` AS c JOIN `perfiles` AS p ON (c.perfiles=p.id) WHERE (c.cuenta='$cuentaO')";
                                            $resultado=mysqli_query($conexion,$consulta);
                                            if($resultado){
                                                if($resultado->num_rows>0){
                                                    if($registro=mysqli_fetch_array($resultado)){
                                                        $nombreO=$registro["nombre"];
                                                        $apellidoO=$registro["apellido"];
                                                        $consulta="INSERT INTO `historial`(`referencia`, `perfilesO`, `cuentasO`, `empresasO`, `tipoO`, `descripcionO`, `cantidad`, `fecha`, `hora`, `perfilesD`, `cuentasD`, `empresasD`, `tipoD`, `descripcionD`) VALUES (NULL,(SELECT p.id FROM `cuentas` AS c JOIN `perfiles` AS p ON (c.perfiles=p.id) WHERE (p.nombre='$nombreO' AND p.apellido='$apellidoO' AND c.cuenta='$cuentaO'),'$cuentaO',(SELECT `id` FROM `empresas` WHERE (`empresa`='$empresa')),2,16,'$cantidad','$fecha_actividad','$hora_actividad',(SELECT p.id FROM `cuentas` AS c JOIN `perfiles` AS p ON (c.perfiles=p.id) WHERE (p.nombre='$nombreD' AND p.apellido='$apellidoD' AND c.cuenta='$cuenta')),'$cuenta',(SELECT `id` FROM `empresas` WHERE (`empresa`='$empresa')),2,17)";
                                                        $resultado=mysqli_query($conexion,$consulta);
                                                        if($resultado){
                                                            $consulta="SELECT h.cuentasD,h.fecha,h.hora,h.referencia,h.cantidad,p.nombre AS nombreD,p.apellido AS apellidoD,d.descripcion AS descripcionD,e.empresa AS empresaD FROM `historial` AS h JOIN `perfiles` AS p JOIN `descripcion` d JOIN `empresas` AS e ON (h.perfilesD=p.id AND h.descripcionD=d.id AND h.empresasD=e.id) WHERE (`fecha`='$fecha_actividad' AND `hora`='$hora_actividad')";
                                                            $resultado=mysqli_query($conexion,$consulta);
                                                            if($resultado->num_rows>0){
                                                                if($registro=mysqli_fetch_array($resultado)){
                                                                    $resultar["mensaje"]="aprobado";
                                                                    $resultar["nombre"]=$registro["nombreD"];
                                                                    $resultar["apellido"]=$registro["apellidoD"];
                                                                    $resultar["referencia"]=$registro["referencia"];
                                                                    $resultar["descripcion"]=$registro["descripcionD"];
                                                                    $resultar["cantidad"]=$registro["cantidad"];
                                                                    $resultar["fecha"]=$registro["fecha"];
                                                                    $resultar["hora"]=$registro["hora"];
                                                                    $resultar["empresa"]=$registro["empresaD"];
                                                                    $resultar["cuenta"]=$registro["cuentasD"];
                                                                    $json['aprobacion'][]=$resultar;
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    else{
                                        if(((double)$deuda+(double)$intereses)>=(double)$cantidad){
                                            $restanteC=(double)$cantidad-(double)$intereses;
                                            $consulta="UPDATE `cuentas` AS c SET c.credito=c.credito+$restanteC, c.deuda=c.deuda-$restanteC, c.intereses=0 WHERE c.cuenta='$cuenta'";
                                            $resultado=mysqli_query($conexion,$consulta);
                                            if($resultado){
                                                $consulta="SELECT p.nombre, p.apellido FROM `cuentas` AS c JOIN `perfiles` AS p ON (c.perfiles=p.id) WHERE (c.cuenta='$cuentaO')";
                                                $resultado=mysqli_query($conexion,$consulta);
                                                if($resultado){
                                                    if($resultado->num_rows>0){
                                                        if($registro=mysqli_fetch_array($resultado)){
                                                            $nombreO=$registro["nombre"];
                                                            $apellidoO=$registro["apellido"];
                                                            $consulta="INSERT INTO `historial`(`referencia`, `perfilesO`, `cuentasO`, `empresasO`, `tipoO`, `descripcionO`, `cantidad`, `fecha`, `hora`, `perfilesD`, `cuentasD`, `empresasD`, `tipoD`, `descripcionD`) VALUES (NULL,(SELECT p.id FROM `cuentas` AS c JOIN `perfiles` AS p ON (c.perfiles=p.id) WHERE (p.nombre='$nombreO' AND p.apellido='$apellidoO' AND c.cuenta='$cuentaO')),'$cuentaO',(SELECT `id` FROM `empresas` WHERE (`empresa`='$empresa')),2,16,'$cantidad','$fecha_actividad','$hora_actividad',(SELECT p.id FROM `cuentas` AS c JOIN `perfiles` AS p ON (c.perfiles=p.id) WHERE (p.nombre='$nombreD' AND p.apellido='$apellidoD' AND c.cuenta='$cuenta')),'$cuenta',(SELECT `id` FROM `empresas` WHERE (`empresa`='$empresa')),2,17)";
                                                            $resultado=mysqli_query($conexion,$consulta);
                                                            if($resultado){
                                                                $consulta="SELECT h.cuentasD,h.fecha,h.hora,h.referencia,h.cantidad,p.nombre AS nombreD,p.apellido AS apellidoD,d.descripcion AS descripcionD,e.empresa AS empresaD FROM `historial` AS h JOIN `perfiles` AS p JOIN `descripcion` d JOIN `empresas` AS e ON (h.perfilesD=p.id AND h.descripcionD=d.id AND h.empresasD=e.id) WHERE (`fecha`='$fecha_actividad' AND `hora`='$hora_actividad')";
                                                                $resultado=mysqli_query($conexion,$consulta);
                                                                if($resultado->num_rows>0){
                                                                    if($registro=mysqli_fetch_array($resultado)){
                                                                        $resultar["mensaje"]="aprobado";
                                                                        $resultar["nombre"]=$registro["nombreD"];
                                                                        $resultar["apellido"]=$registro["apellidoD"];
                                                                        $resultar["referencia"]=$registro["referencia"];
                                                                        $resultar["descripcion"]=$registro["descripcionD"];
                                                                        $resultar["cantidad"]=$registro["cantidad"];
                                                                        $resultar["fecha"]=$registro["fecha"];
                                                                        $resultar["hora"]=$registro["hora"];
                                                                        $resultar["empresa"]=$registro["empresaD"];
                                                                        $resultar["cuenta"]=$registro["cuentasD"];
                                                                        $json['aprobacion'][]=$resultar;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                        else{
                                            $resultar["mensaje"]="saldo_insuficiente";
                                            $json['aprobacion'][]=$resultar;
                                        }
                                    }
                                }
                                else{
                                    $resultar["mensaje"]="fecha_vencida";
                                    $json['aprobacion'][]=$resultar;
                                }
                            }
                        }
                    }
                    echo json_encode($json);
                }
                break;
            }
            case 43:{
                if(isset($_POST['cuenta']) && isset($_POST["fechaI"])){
                    $consulta="UPDATE `cuentas` SET `fecha_creacion`='$fechaI' WHERE (`cuenta`='$cuenta')";
                    $resultado=mysqli_query($conexion,$consulta);
                    if($resultado){
                        $resultar["mensaje"]="aprobado";
                        $json['aprobacion'][]=$resultar;
                    }
                    echo json_encode($json); 
                }
                break;
            }
            case 44:{
                if(isset($_POST['cuenta'])){
                    $consulta="SELECT `referencia`, p.nombre AS nombreO, p.apellido AS apellidoO, `cuentasO`, e.empresa AS empresaO, t.tipo AS tipoO, d.descripcion AS descripcionO, `cantidad`, `fecha`, `hora`, p2.nombre AS nombreD, p2.apellido AS apellidoD, `cuentasD`, e2.empresa AS empresaD, t2.tipo AS tipoD, d2.descripcion AS descripcionD FROM `historial` AS h JOIN `perfiles` AS p JOIN `perfiles` AS p2 JOIN `empresas` AS e JOIN `empresas` AS e2 JOIN `tipo` AS t JOIN `tipo` AS t2 JOIN `descripcion` d JOIN `descripcion` d2 ON (h.perfilesO=p.id AND h.perfilesD=p2.id AND h.empresasO=e.id AND h.empresasD=e2.id AND h.tipoO=t.id AND h.tipoD=t2.id AND h.descripcionO=d.id AND h.descripcionD=d2.id) WHERE (`cuentasO`='$cuenta') AND ((`descripcionO`=16) OR (`descripcionO`=8) OR (`descripcionO`=12) OR (`descripcionO`=10) OR (`descripcionO`=14)) ORDER BY `referencia` DESC";
                    $resultado=mysqli_query($conexion,$consulta);
                    if($resultado){
                        if($resultado->num_rows>0){
                            while($registro=mysqli_fetch_assoc($resultado)){
                                $resultar["mensaje"]="aprobado";
                                $resultar["referencia"]=$registro["referencia"];
                                $resultar["empresaO"]=$registro["empresaO"];
                                $resultar["tipoO"]=$registro["tipoO"];
                                $resultar["nombreO"]=$registro["nombreO"];
                                $resultar["apellidoO"]=$registro["apellidoO"];
                                $resultar["cuentaO"]=$registro["cuentasO"];
                                $resultar["cantidad"]=$registro["cantidad"];
                                $resultar["descripcionO"]=$registro["descripcionO"];
                                $resultar["descripcionD"]=$registro["descripcionD"];
                                $resultar["fecha"]=$registro["fecha"];
                                $resultar["empresaD"]=$registro["empresaD"];
                                $resultar["tipoD"]=$registro["tipoD"];
                                $resultar["nombreD"]=$registro["nombreD"];
                                $resultar["apellidoD"]=$registro["apellidoD"];
                                $resultar["cuentaD"]=$registro["cuentasD"];
                                $json['aprobacion'][]=$resultar;
                            }
                            echo json_encode($json);
                        }
                        else{
                            $resultar["mensaje"]="no existe";
                            $json['aprobacion'][]=$resultar;
                            echo json_encode($json);
                        }
                    }
                }
                break;
            }
            case 45:{
                if(isset($_POST['cuenta']) && isset($_POST["fechaI"]) && isset($_POST["fechaF"])){
                    $consulta="SELECT `referencia`, p.nombre AS nombreO, p.apellido AS apellidoO, `cuentasO`, e.empresa AS empresaO, t.tipo AS tipoO, d.descripcion AS descripcionO, `cantidad`, `fecha`, `hora`, p2.nombre AS nombreD, p2.apellido AS apellidoD, `cuentasD`, e2.empresa AS empresaD, t2.tipo AS tipoD, d2.descripcion AS descripcionD FROM `historial` AS h JOIN `perfiles` AS p JOIN `perfiles` AS p2 JOIN `empresas` AS e JOIN `empresas` AS e2 JOIN `tipo` AS t JOIN `tipo` AS t2 JOIN `descripcion` d JOIN `descripcion` d2 ON (h.perfilesO=p.id AND h.perfilesD=p2.id AND h.empresasO=e.id AND h.empresasD=e2.id AND h.tipoO=t.id AND h.tipoD=t2.id AND h.descripcionO=d.id AND h.descripcionD=d2.id) WHERE (`fecha` BETWEEN '$fechaI' AND '$fechaF') AND (`cuentasO`='$cuenta') AND ((`descripcionO`=16) OR (`descripcionO`=8) OR (`descripcionO`=12) OR (`descripcionO`=10) OR (`descripcionO`=14)) ORDER BY `referencia` DESC";
                    $resultado=mysqli_query($conexion,$consulta);
                    if($resultado){
                        if($resultado->num_rows>0){
                            while($registro=mysqli_fetch_assoc($resultado)){
                                $resultar["mensaje"]="aprobado";
                                $resultar["referencia"]=$registro["referencia"];
                                $resultar["empresaO"]=$registro["empresaO"];
                                $resultar["tipoO"]=$registro["tipoO"];
                                $resultar["nombreO"]=$registro["nombreO"];
                                $resultar["apellidoO"]=$registro["apellidoO"];
                                $resultar["cuentaO"]=$registro["cuentasO"];
                                $resultar["cantidad"]=$registro["cantidad"];
                                $resultar["descripcionO"]=$registro["descripcionO"];
                                $resultar["descripcionD"]=$registro["descripcionD"];
                                $resultar["fecha"]=$registro["fecha"];
                                $resultar["empresaD"]=$registro["empresaD"];
                                $resultar["tipoD"]=$registro["tipoD"];
                                $resultar["nombreD"]=$registro["nombreD"];
                                $resultar["apellidoD"]=$registro["apellidoD"];
                                $resultar["cuentaD"]=$registro["cuentasD"];
                                $json['aprobacion'][]=$resultar;
                            }
                            echo json_encode($json);
                        }
                        else{
                            $resultar["mensaje"]="no existe";
                            $json['aprobacion'][]=$resultar;
                            echo json_encode($json);
                        }
                    }
                }
                break;
            }
            case 46:{
                if(isset($_POST['usuario']) && isset($_POST['empresa'])){
                    $consulta="SELECT p.nombre, p.apellido, c.cuenta, c.credito, c.deuda, c.intereses, r.rango, p.usuario FROM `cuentas` AS c JOIN `perfiles` AS p JOIN `empresas` AS e JOIN `rangos` AS r ON (c.perfiles=p.id AND c.empresas=e.id AND c.rangos=r.id) WHERE (p.usuario!='$usuario' AND e.empresa='$empresa' AND c.estado=1 AND c.rangos!=1) ORDER BY p.nombre ASC, p.apellido ASC";
                    $resultado=mysqli_query($conexion,$consulta);
                    if($resultado){
                        if($resultado->num_rows>0){
                            while($registro=mysqli_fetch_assoc($resultado)){
                                $resultar["mensaje"]="aprobado";
                                $resultar["intereses"]=$registro["intereses"];
                                $resultar["nombre"]=$registro["nombre"];
                                $resultar["apellido"]=$registro["apellido"];
                                $resultar["cuenta"]=$registro["cuenta"];
                                $resultar["credito"]=$registro["credito"];
                                $resultar["capital"]=$registro["deuda"];
                                $resultar["rango"]=$registro["rango"];
                                $resultar["usuario"]=$registro["usuario"];
                                $json['aprobacion'][]=$resultar;
                            }
                            echo json_encode($json);
                        }
                        else{
                            $resultar["mensaje"]="no existe";
                            $json['aprobacion'][]=$resultar;
                            echo json_encode($json);
                        }
                    }
                }
                break;
            }
            case 47:{
                if(isset($_POST['usuario']) && isset($_POST['empresa']) && isset($_POST["nombre"])){
                    $consulta="SELECT p.nombre, p.apellido, c.cuenta, c.credito, c.deuda, c.intereses, r.rango, p.usuario FROM `cuentas` AS c JOIN `perfiles` AS p JOIN `rangos` AS r JOIN `empresas` AS e ON (c.perfiles=p.id AND c.rangos=r.id AND c.empresas=e.id) WHERE (p.usuario!='$usuario' AND e.empresa='$empresa' AND c.estado=1 AND c.rangos!=1) AND (p.nombre LIKE '%$nombre%' OR p.apellido LIKE '%$nombre%') ORDER BY p.nombre ASC, p.apellido ASC";
                    $resultado=mysqli_query($conexion,$consulta);
                    if($resultado){
                        if($resultado->num_rows>0){
                            while($registro=mysqli_fetch_assoc($resultado)){
                                $resultar["mensaje"]="aprobado";
                                $resultar["intereses"]=$registro["intereses"];
                                $resultar["nombre"]=$registro["nombre"];
                                $resultar["apellido"]=$registro["apellido"];
                                $resultar["cuenta"]=$registro["cuenta"];
                                $resultar["credito"]=$registro["credito"];
                                $resultar["capital"]=$registro["deuda"];
                                $resultar["rango"]=$registro["rango"];
                                $resultar["usuario"]=$registro["usuario"];
                                $json['aprobacion'][]=$resultar;
                            }
                            echo json_encode($json);
                        }
                        else{
                            $resultar["mensaje"]="no existe";
                            $json['aprobacion'][]=$resultar;
                            echo json_encode($json);
                        }
                    }
                }
                break;
            }
            default:{
                header("Location: http://sysprosfin.salasar.xyz");
            }
        }
    }
    else{
        header("Location: http://sysprosfin.salasar.xyz");
    }
    mysqli_close($conexion);
?>
