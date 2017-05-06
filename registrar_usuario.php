<!DOCTYPE html>
<html>
<?php 
	echo "Bienvenido<hr>";
	//validar datos de usuario
	if($_POST){
		$claseNombre = "";
    	$claseApellido = "";
    	$claseTelefono = "";
    	$claseClave = "";
		$claseCorreo = "";
		$nombre = $_POST["nombre"];
		if($nombre == "" ){
			$msgNombre = " falta ingresar el nombre";
			$claseNombre = "error";
		}
		$apellido = $_POST["apellido"];
		if($apellido == "" ){
			$msgApellido = " falta ingresar el apellido";
			$claseApellido = "error";
		}
		$correo = $_POST["correo"];
		if($correo == "" ){
			$msgCorreo = " falta ingresar el correo";
			$claseCorreo = "error";
		}
		$telefono = $_POST["telefono"];
		if($telefono == "" ){
		  $msgTelefono = " falta ingresar el telefono";
		  $claseTelefono = "error";
		}else{
			if(!is_numeric($telefono)){
				$msgTelefono = "ingresar solo numeros";
				$claseTelefono = "error";
			}
		}
		if ($_POST["clave1"] == $_POST["clave2"] && $_POST["clave1"] =! ""){
			$clave = $_POST["clave1"];
		}else{
			if ($_POST["clave1"] == ""){
				$msgClave = " falta ingresar la clave";
				$claseClave = "error";
			}else{
					$msgClave = "la clave no coincide";
					$claseClave = "error";
			}
		}
		if($claseNombre == "" && $claseApellido == "" && $claseClave == "" && $claseCorreo == "" && $claseTelefono == ""){
			//para conectarse con la base de datos de venbitcoin
			$user = 'postgres';
			$passwd = 'bitcoin';
			//nombre de la base de datos  
			$db = 'VenBitcoin';
			$port = 5432;
			$host = 'localhost';

			$asi = "host=$host port=$port dbname=$db user=$user password=$passwd";
			$cnx = pg_connect($asi) or die ("Error de conexion. ". pg_last_error());
			echo '<br /> Resultado de la consulta: <br />';
				$insert = pg_query("INSERT INTO public.usuario (correo, nombre, apellido, telefono, clave)
                                                VALUES('$correo', '$nombre', '$apellido', '$telefono','$clave')");
				if (!$insert){
					$error.="pg_last_error($connection)<li>";
				}
			
			//verificamos si el user exite con un condicional
	//		$q = pg_query("SELECT * FROM public.usuario WHERE correo = '$correo'")
			// pg_num_rows <- esta funcion me imprime el numero de registro que encontro
			// si el numero es igual a 0 es porque el registro no exite, en otras palabras ese user no esta en la tabla miembro por lo tanto se puede registrar
		/*	$numRe = pg_num_rows($q);
			if( $numRe == 0){
				echo "el user es valido";
			}else{
				//caso contario (else) es porque ese user ya esta registrado 
				echo 'el user ya esta registrado, ingresa otro';
			}*/
			//en result se guarda la informacion de la tabla de clientes
			$result = pg_query($cnx,"SELECT * FROM public.usuario");
			if (!$result) {
				echo "Ocurrió un error.\n";
				exit;
			}
			$numReg = pg_num_rows($result);
			if($numReg>0){
				echo "<table border='5' align='center'>
				<tr bgcolor='purple'>
				<th>correo</th>
				<th>nombre</th>
				<th>Apellido</th>
				<th>Telefono</th>
				<th>clave</th></tr>";
				while ($row = pg_fetch_row($result)) {
					echo "<tr><td>  $row[0] </td>";
					echo "<td>  $row[1]  </td>";
					echo "<td>  $row[2] </td>";
					echo "<td>  $row[3] </td>";
					echo "<td>  $row[4] </td>";
					echo "<br />\n";
				}
				echo "</table>";
			}else{
				echo "No hay Registros";
			}
			echo "<ul>";
			pg_close($cnx);
		}
	}else{
		$nombre = "";
    	$apellido = "";
    	$telefono = "";
    	$clave = "";
		$correo = "";
		
	}
?>
<head>
	<title>VenBitcoin</title>
	<style>
		div{
			margin: 2px;
		}
		div label{
			padding: 10px;
			float: left;
			width: 15%;
		}
		input{
			padding: 10px;
			border: solid 4px black;
		}
		.error{
			background: orange;
			border: solid 4px red;
		}
		.msg{
			color: white;
			font-size: 15px;
		}
	</style>

</head>


<body>
	<center><img src="bitcoin/logoVenBitcoin.png" alt="VenBitcoin" style="width:700px;height:200px;"> </center>
    <h1 style="text-align:center;">Registrarse como usuario</h1>
	<form name="fomulariousuario" method="post" action="registrar_usuario.php">
		<fieldset> 
		    <legend>Formulario de Ejemplo</legend>
			<div class="<?php echo $claseNombre; ?>">
				<label> Nombre  </label>
				<input name="nombre" type="text" placeholder="Nombre" value="<?php echo $nombre; ?>"><br>
				<span class="msg"><?php echo $msgNombre; ?></span>
			</div>
			<div class="<?php echo $claseApellido; ?>">
				<label> Apellido  </label>
		  		<input name="apellido" type="text" value="<?php echo $apellido; ?>" placeholder="Apellido"><br>
				<span class="msg"><?php echo $msgApellido; ?></span>
			</div>
			<div class="<?php echo $claseCorreo; ?>">
				<label> Email  </label>	        
			    <input name="correo" type="text" placeholder="Email"/><br>
				<span class="msg"><?php echo $msgCorreo; ?></span>
			</div>
			<div class="<?php echo $claseTelefono; ?>">
				<label> Telefono  </label>
			    <input name="telefono" type="text" placeholder="Telefono"/><br>	
				<span class="msg"><?php echo $msgTelefono; ?></span>
			</div>
			<div class="<?php echo $claseClave; ?>">
				<label> contraseña </label>
			    <input type="password" name="clave1" placeholder="Password"/><br>
				<span class="msg"><?php echo $msgClave; ?></span>
			</div>
			<div class="<?php echo $claseClave; ?>">
				<label>repetir contraseña  </label>     
		   		<input type="password"  name="clave2" placeholder="Password(Repetir)" /><br>
				<span class="msg"><?php echo $msgClave1; ?></span>
			</div>
			<div>
		  		<input name="enviar" type="submit" value="Registrarse" />
			</div>
		</fieldset>
	</form>
</body>
</html>

