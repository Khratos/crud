<?php


if (isset($_POST['submit'])) {
  include 'funtions.php';
  $resultado = [
    'error' => false,
    'mensaje' => 'Factura: ' . escapar($_POST['nombre']) . ' agregada'
  ];

  $config = include 'config.php';

  try {
    $dsn = "mysql:host=db;dbname=test";

    $user = "root";
    $passwd = "123456";
    
    $conexion = new PDO($dsn, $user, $passwd);
    $fac = [
      "nombre"   => $_POST['nombre'],
      "apellido" => $_POST['apellido'],
      "email"    => $_POST['email'],
      "rfc"     => $_POST['rfc'],
    ];

    $consultaSQL = "INSERT INTO facturas (nombre, apellido, email, rfc)";
    $consultaSQL .= "values (:" . implode(", :", array_keys($fac)) . ")";

    $sentencia = $conexion->prepare($consultaSQL);
    $sentencia->execute($fac);

  } catch(PDOException $error) {
    $resultado['error'] = true;
    $resultado['mensaje'] = $error->getMessage();
  }
}
?>

<?php include 'templates/header.php'; ?>

<?php
if (isset($resultado)) {
  ?>
  <div class="container mt-3">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-<?= $resultado['error'] ? 'danger' : 'success' ?>" role="alert">
          <?= $resultado['mensaje'] ?>
        </div>
      </div>
    </div>
  </div>
  <?php
}
?>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2 class="mt-4">Crea un alumno</h2>
      <hr>
      <form method="post">
        <div class="form-group">
          <label for="nombre">Nombre</label>
          <input type="text" name="nombre" id="nombre" class="form-control">
        </div>
        <div class="form-group">
          <label for="apellido">Apellido</label>
          <input type="text" name="apellido" id="apellido" class="form-control">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" class="form-control">
        </div>
        <div class="form-group">
          <label for="rfc">RFC</label>
          <input type="text" name="rfc" id="rfc" class="form-control">
        </div>
        <div class="form-group">

          <input type="submit" name="submit" class="btn btn-primary" value="Enviar">
          <a class="btn btn-primary" href="index.php">Regresar al inicio</a>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include 'templates/footer.php'; ?>