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
$guid = trim(com_create_guid(), '{}');


if($db != null){
    echo "Conexión exitosa";
    try {
    

    // Preparar la consulta SQL
    $stmt = $db->prepare("INSERT INTO R_Trabajador (id,TenantId,IsDeleted,NombreTrab, ApellidoTrab,BloqueId,TipoTrabajadorId,ExtraProperties,ConcurrencyStamp,CreationTime,CreatorId,LastModificationTime,LastModifierId,TagTrab,Imagen,ProduccionType,cedula,correo) VALUES (:guide, NULL, 0, :nombre, :apellido, 'DDB17246-9773-1C56-EEE8-3A04A48E831F', :trabajador, NULL,NULL,'2022-07-14 12:35:26.5252690','D51F24DA-2450-5244-CB65-3A045A90DB0A',NULL,NULL,444400000018, NULL,NULL,:cedula, :correo)");

    $stmt->bindParam(':guide', $guid);
    $stmt->bindParam(':cedula', $_POST['cedula']);
    $stmt->bindParam(':apellido', $_POST['apellido']);
    $stmt->bindParam(':nombre', $_POST['nombre']);
    $stmt->bindParam(':correo', $_POST['correo']);
    $stmt->bindParam(':trabajador', $_POST['trabajador']);

$stmt->execute();


    echo "datos cargados";
      
    } catch (PDOException $e) {
        echo "Error al ejecutar la consulta: " . $e->getMessage();
    }
    
    

}else{
    echo "Error al conectar a la base de datos";
}
?>
