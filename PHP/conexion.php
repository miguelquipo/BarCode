<?php
require 'setting.php';

class conexion{
    private $conector = null;

    public function getConexion(){
        $this->conector = new PDO("sqlsrv:server=".SERVIDOR.";database=".DATABASE,USUARIO,PASSWORD);
        return $this->conector;
    }
}

$con = new conexion();
$db = $con->getConexion();

if($db != null){
    echo "Conexión exitosa";
    try {
    

    // Preparar la consulta SQL
    $stmt = $db->prepare("INSERT INTO R_Trabajador (Id,TenantId,IsDeleted,NombreTrab,ApellidoTrab,BloqueId,TipoTrabajadorId,ExtraProperties,ConcurrencyStamp,CreationTime,CreatorId,LastModificationTime,LastModifierld,TagTrab,Imagen,ProduccionType,cedula,correo) VALUES (:null, :null, :nombre, :apellido, :null,:TipoTrabajadorId,:null,:null,:null,:null,:null,null,:token,:null,:null,:cedula,:correo)");

    // Vincular parámetros
    $stmt->bindParam(':cedula', $_POST['cedula']);
    $stmt->bindParam(':token', $_POST['token']);
    $stmt->bindParam(':apellido', $_POST['apellido']);
    $stmt->bindParam(':nombre', $_POST['NombreTrab']);
    $stmt->bindParam(':correo', $_POST['correo']);
    $stmt->bindParam(':trabajador', $_POST['trabajador']);

    // insertar una fila
    $stmt->execute();

    echo '<script>
    swal({
        title: "¡Éxito!",
        text: "Nuevo registro creado exitosamente",
        icon: "success",
        button: "OK",
    });
  </script>';
} catch (PDOException $e) {
// Print a JavaScript code to show a SweetAlert
echo '<script>
    swal({
        title: "¡Error!",
        text: "No se pudo crear el registro",
        icon: "error",
        button: "OK",
    });
  </script>';
}
}else{
echo "Error al conectar a la base de datos";
}
?>
