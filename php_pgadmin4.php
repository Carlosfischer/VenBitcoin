
<?php 
  //para conectarse con la base de datos de venbitcoin
  $user = 'postgres';
  $passwd = 'bitcoin';
  //nombre de la base de datos  
  $db = 'VenBitcoin';
  $port = 5432;
  $host = 'localhost';

  $asi = "host=$host port=$port dbname=$db user=$user password=$passwd";
  $cnx = pg_connect($asi) or die ("Error de conexion. ". pg_last_error());
  echo "Bienvenido<hr>"; 

  echo '<br /> Resultado de la consulta: <br />';
//validar datos de usuario
    if($_POST){
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $correo = $_POST["correo"];
        $telefono = $_POST["telefono"];
        $clave = 321;        
//        $clave = $_POST["clave"];
        //var_dump($nombre);
        if($nombre == "" ) echo " falta ingresar nombre";
        if($apellido == "" ) echo " falta ingresar apellido";
        if($telefono == "" ) echo " falta ingresar telefono";
     
        $insert = pg_query("INSERT INTO public.usuario (correo, nombre, apellido, telefono, clave)
                                                VALUES('carlos@hotmail.com', '$nombre', '$apellido', '$telefono','$clave')");
        if (!$insert) {
            $error.="pg_last_error($connection)<li>";
        }
        
    }
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
    <th>clave</th>
    <th>Telefono</th></tr>";
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
?>
