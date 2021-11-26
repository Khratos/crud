
<?php




include 'funtions.php';

$error = false;

$count_per_page = 2;
$next_offset = $_GET['page'] * $count_per_page;

try {
  $dsn = "mysql:host=db;dbname=test";

  $user = "root";
  $passwd = "123456";
  
  $conexion = new PDO($dsn, $user, $passwd);
 
  if (isset($_POST['apellido'])) {
    $consultaSQL = "SELECT * FROM facturas WHERE apellido LIKE '%" . $_POST['apellido'] . "%' LIMIT " . $count_per_page . " OFFSET " . $next_offset;
  
  } else {
    $qcount = "SELECT count(1) as total from facturas ";
    $consultaSQL = "SELECT * FROM facturas LIMIT " . $count_per_page  . " OFFSET " . $next_offset;
    
    // while ($row = mysqli_fetch_array($consultaSQL))
    //     $count = $row[0];
        
  }
 

  $sentencia = $conexion->prepare($consultaSQL);
  $sentencia->execute();
  $fac = $sentencia->fetchAll();
  $count = $conexion->prepare($qcount);
  $count->execute();
  $x = $count->fetchAll();
  $pages = round($x[0]['total']);
  // var_dump($x);
  // echo "COUNT".$x[0]['total'];
  $page = round($x[0]['total']/$count_per_page, 0, PHP_ROUND_HALF_DOWN);
  // echo "PAGE". $page;



} catch(PDOException $error) {
  $error= $error->getMessage();
}

$titulo = isset($_POST['apellido']) ? 'Facturas (' . $_POST['apellido'] . ')' : 'Facturas';
?>

<?php include "templates/header.php"; ?>

<?php
if ($error) {
  ?>
  <div class="container mt-2">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-danger" role="alert">
          <?= $error ?>
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
      <a href="create.php"  class="btn btn-primary mt-4">+</a>
      <hr>
     
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2 class="mt-3"><?= $titulo ?></h2>
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <th>RFC</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($fac && $sentencia->rowCount() > 0) {
            
            foreach ($fac as $fila) {
              ?>
              <tr>
                <td><?php echo escapar($fila["id"]); ?></td>
                <td><?php echo escapar($fila["nombre"]); ?></td>
                <td><?php echo escapar($fila["apellido"]); ?></td>
                <td><?php echo escapar($fila["email"]); ?></td>
                <td><?php echo escapar($fila["rfc"]); ?></td>
                <td>
                  <a href="<?= 'delete.php?id=' . escapar($fila["id"]) ?>">Borrrar</a>
                  <a href="<?= 'edit.php?id=' . escapar($fila["id"]) ?>">Editar</a>
                </td>
              </tr>
              <?php
            }
          }
          ?>
        <tbody>
      </table>

    </div>


    <nav>
  
    <ul class="pagination">
        <!-- Si la página actual es mayor a uno, mostramos el botón para ir una página atrás -->
        <?php if ($pages > 1) { ?>
            <li>
                <a href="./index.php?page=<?php echo $page - 1 ?>">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        <?php } ?>

        <!-- Mostramos enlaces para ir a todas las páginas. Es un simple ciclo for-->
        <?php for ($x = 0; $x <= $pages; $x++) { ?>
            <li class="<?php if ($x == $pagina) echo "active" ?>">
                <a href="./index.php?page=<?php echo $x ?>">
                    <?php echo $x+1 ?></a>
            </li>
        <?php } ?>
        <!-- Si la página actual es menor al total de páginas, mostramos un botón para ir una página adelante -->
        <?php if ($page < $pages) { ?>
            <li>
                <a href="./index.php?page=<?php echo $page + 1 ?>">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        <?php } ?>
    </ul>


    <a href="<?= 'palindrom.php' ?>">Palindormo </a>
    <a href="<?= 'Prueba/extract.php' ?>">Ejercicio xml </a>
  </div>
</div>

<?php include "templates/footer.php"; ?>