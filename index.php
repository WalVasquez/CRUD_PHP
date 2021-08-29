<!doctype html>
<html lang="en">
  <head>
    <title>Pagina en PHP</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Font Awsome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  </head>
  <body>
      <h1>Formulario Empleado</h1>
      <div class="container">
          <form class="d-flex" action="insertar.php" method="post">
              <div class="col">
                  <div class="mb-3">
                      <label for="lbl_codigo" class="form-label"><b>Codigo</b></label>
                      <input type="text" name="txt_codigo" id="txt_codigo" class="form-control" placeholder="Codigo: E001" required>
                  </div>
                  <div class="mb-3">
                      <label for="lbl_nombres" class="form-nombres"><b>Nombres</b></label>
                      <input type="text" name="txt_nombres" id="txt_nombres" class="form-control" placeholder="Nombre: nombre1 nombre2" required>
                  </div>
                  <div class="mb-3">
                      <label for="lbl_apellidos" class="form-apellidos"><b>Apellidos</b></label>
                      <input type="text" name="txt_apellidos" id="txt_apellidos" class="form-control" placeholder="Apellidos: apellido1 apellido2" required>
                  </div>
                  <div class="mb-3">
                      <label for="lbl_direccion" class="form-direccion"><b>Direccion</b></label>
                      <input type="text" name="txt_direccion" id="txt_direccion" class="form-control" placeholder="#casa Avenida Calle Lugar" required>
                  </div>
                  <div class="mb-3">
                      <label for="lbl_telefono" class="form-telefono"><b>Telefono</b></label>
                      <input type="number" name="txt_telefono" id="txt_telefono" class="form-control" placeholder="55544422" required>
                  </div>
                  <div class="mb-3">
                    <label for="lbl_puesto" class="form-puesto"><b>Puesto</b></label>
                    <select class="form-select" name="drop_puesto" id="drop_puesto">
                      <option value=0>------Puesto--------</option>
                      <?php
                        include("datos_conexion.php");
                        $db_conexion=mysqli_connect($db_host,$db_usr,$db_pass,$db_name,$db_puerto);
                        $db_conexion -> real_query ("SELECT id_puesto as id,puesto FROM puestos;");
                        $resultado = $db_conexion -> use_result();
                        while ($fila = $resultado ->fetch_assoc()){
                          echo "<option value=". $fila['id'].">". $fila['puesto']."</option>";
                        }
                        $db_conexion -> close();
                      ?>
                    </select>
                  </div>
                  <div class="mb-3">
                      <label for="txt_fn" class="form-fn"><b>Fecha de Nacimiento</b></label>
                      <input type="date" name="txt_fn" id="txt_fn" class="form-control" placeholder="aaaa-mmm-ddd" required>
                  </div>
                  <div class="mb-3">
                      <input type="submit" name="btn_agregar" id="btn_agregar" class="btn btn-primary" value="Agregar">
                  </div>
              </div>
          </form>
          <table class="table table-striped table-inverse table-responsive">
              <thead class="thead-inverse">
                  <tr>
                      <th>Codigo</th>
                      <th>Nombres</th>
                      <th>Apellidos</th>
                      <th>Direccion</th>
                      <th>Telefono</th>
                      <th>Puesto</th>
                      <th>Nacimiento</th>
                      <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody>
                      <tr>
                        <?php
                            include("datos_conexion.php");
                            $db_conexion=mysqli_connect($db_host,$db_usr,$db_pass,$db_name,$db_puerto);
                            $db_conexion -> real_query ("SELECT e.id_empleados as id,e.codigo,e.nombres,e.apellidos,e.direccion,e.telefono,p.puesto,e.fecha_de_nacimiento
                            FROM empleados as e inner join puestos as p on e.id_puesto = p.id_puesto;");
                            $resultado = $db_conexion -> use_result();
                            while ($fila = $resultado ->fetch_assoc()){
                                echo "<tr data-id=" . $fila['id'].">";
                                    echo "<td>". $fila['codigo']."</td>";
                                    echo "<td>". $fila['nombres']."</td>";
                                    echo "<td>". $fila['apellidos']."</td>";
                                    echo "<td>". $fila['direccion']."</td>";
                                    echo "<td>". $fila['telefono']."</td>";
                                    echo "<td>". $fila['puesto']."</td>";
                                    echo "<td>". $fila['fecha_de_nacimiento']."</td>";
                                    echo "<td>"."<a href=".'"eliminar.php?id='. $fila['id'].'" class="btn btn-danger" > <i class="fas fa-trash-alt"></i></a><a href="modificar.php?id=' .$fila['id'].'" class="btn btn-secondary"><i class="fas fa-marker"></i></a></td>';
                                
                                echo "</tr>";
   
                            }
                            $db_conexion -> close();
                        ?>
                      </tr>
                  </tbody>
          </table>
          
      </div>

        
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>