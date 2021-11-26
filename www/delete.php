<?php
include 'funtions.php';

$config = include 'config.php';

$resultado = [
  'error' => false,
  'mensaje' => ''
];

try {

  $dsn = "mysql:host=db;dbname=test";

  $user = "root";
  $passwd = "123456";
  
  $conexion = new PDO($dsn, $user, $passwd);
    
  $id = $_GET['id'];
  $consultaSQL = "DELETE FROM facturas WHERE id =" . $id;

  $sentencia = $conexion->prepare($consultaSQL);
  $sentencia->execute();

  header('Location: /index.php');

} catch(PDOException $error) {
  $resultado['error'] = true;
  $resultado['mensaje'] = $error->getMessage();
}
?>

<?php require "templates/header.php"; ?>

<div class="container mt-2">
  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-danger" role="alert">
        <?= $resultado['mensaje'] ?>
      </div>
    </div>
  </div>
</div>

<?php require "templates/footer.php"; ?>