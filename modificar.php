<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS v5.0.2 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<?php
include("datos_conexion.php");
$db_conexion=mysqli_connect($db_host,$db_usr,$db_pass,$db_name,$db_puerto);   
$codigo='';
$nombres = '';
$apellidos = '';
$direccion = '';
$telefono = '';
$puesto = '';
$fn = '';
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql= "SELECT * from empleados where id_empleados=$id";
        $result = mysqli_query($db_conexion, $sql);
            if (mysqli_num_rows($result) == 1) {
                $fila = mysqli_fetch_array($result);
                $codigo = $fila['codigo'];
                $nombres = $fila['nombres'];
                $apellidos = $fila['apellidos'];
                $direccion = $fila['direccion'];
                $telefono = $fila['telefono'];
                $puesto = $fila['id_puesto'];
                $fn = $fila['fecha_de_nacimiento'];
         }
    }

    if(isset($_POST['update'])) {
        $id = $_GET['id'];
        $codigo = $_POST['txt_codigo'];
        $nombres = $_POST['txt_nombres'];
        $apellidos = $_POST['txt_apellidos'];
        $direccion = $_POST['txt_direccion'];
        $telefono = $_POST['txt_telefono'];
        $puesto = $_POST['drop_puesto'];
        $fn = $_POST['txt_fn'];
        $sql= " UPDATE empleados SET codigo='$codigo',nombres='$nombres',apellidos='$apellidos',direccion='$direccion',telefono='$telefono',fecha_de_nacimiento='$fn',id_puesto='$puesto' 
        WHERE id_empleados=$id;";
        if($db_conexion -> query($sql) === true){
            $db_conexion -> close();
            header('Location: index.php');

        }else{
            echo "Error" . $sql."<br>".$db_conexion -> close();
        }
    }
?>
<div class="container">
    <form class="d-flex" action="modificar.php?id=<?php echo $_GET['id']; ?>" method="POST">
              <div class="col">
                  <div class="mb-3">
                      <label for="lbl_codigo" class="form-label"><b>Codigo</b></label>
                      <input type="text" name="txt_codigo" id="txt_codigo" value="<?php echo $codigo;?>" class="form-control" placeholder="Codigo: E001" required>
                  </div>
                  <div class="mb-3">
                      <label for="lbl_nombres" class="form-nombres"><b>Nombres</b></label>
                      <input type="text" name="txt_nombres" id="txt_nombres" value="<?php echo $nombres;?>" class="form-control" placeholder="Nombre: nombre1 nombre2" required>
                  </div>
                  <div class="mb-3">
                      <label for="lbl_apellidos" class="form-apellidos"><b>Apellidos</b></label>
                      <input type="text" name="txt_apellidos" id="txt_apellidos" value="<?php echo $apellidos;?>" class="form-control" placeholder="Apellidos: apellido1 apellido2" required>
                  </div>
                  <div class="mb-3">
                      <label for="lbl_direccion" class="form-direccion"><b>Direccion</b></label>
                      <input type="text" name="txt_direccion" id="txt_direccion" value="<?php echo $direccion;?>" class="form-control" placeholder="#casa Avenida Calle Lugar" required>
                  </div>
                  <div class="mb-3">
                      <label for="lbl_telefono" class="form-telefono"><b>Telefono</b></label>
                      <input type="number" name="txt_telefono" id="txt_telefono" value="<?php echo $telefono;?>" class="form-control" placeholder="55544422" required>
                  </div>
                  <div class="mb-3">
                    <label for="lbl_puesto" class="form-puesto"><b>Puesto</b></label>
                    <select class="form-select" name="drop_puesto" id="drop_puesto">
                       
                        <?php $db_conexion -> real_query ("SELECT * from puestos where id_puesto= $puesto;");
                        $resultado = $db_conexion -> use_result();
                        while ($puesto = $resultado ->fetch_assoc()){
                            
                            echo "<option value=". $puesto['id_puesto'].">". $puesto['puesto']."</option>";
                        }
                        $db_conexion -> close();?> 
                      
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
                      <input type="date" name="txt_fn" id="txt_fn" value="<?php echo $fn;?>" class="form-control" placeholder="aaaa-mmm-ddd" required>
                  </div>
                  <button class="btn btn-success" name="update">Update</button>
              </div>
          </form>
 </div>          
