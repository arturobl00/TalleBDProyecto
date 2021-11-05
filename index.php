<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Proyecto CRUD de PHP con MySQL</title>
</head>
<body class="container">
    <h1>Mi Primer Proyecto CRUD</h1>
    <h2>Mostrar datos de la Base</h2>
    <?php
        //Agregando cadena de conexion a BD
        include 'conexion.php';

        //Extraer Datos de la tabla

        //Query para estraer datos
        $consulta = "Select * from Ventas Order By Referencia desc";

        //Queries para llenar los comboBox
        $llenaVendedor = "Select Vendedor from vendedores";
        $llenaTipo = "Select tipopropiedad from tipo";
        $llenaProvincia = "Select provincia from provincia";
        $llenaOperacion = "Select operacion from operacion";

        //Variable contenedora de datos
        $resultado = mysqli_query($conn, $consulta);

        //Ejecutar Queries
        $llenaTipo1 = mysqli_query($conn, $llenaTipo);
        $llenaOperacion1 = mysqli_query($conn, $llenaOperacion);
        $llenaProvincia1 = mysqli_query($conn, $llenaProvincia);
        $llenaVendedor1 = mysqli_query($conn, $llenaVendedor);

    ?>

    <!--Proceso de extracción de datos-->
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">REFERENCIA</th>
                <th scope="col">FECHA ALTA</th>
                <th scope="col">FECHA VENTA</th>
                <th scope="col">TIPO</th>
                <th scope="col">OPERACIÓN</th>
                <th scope="col">PROVINCIA</th>
                <th scope="col">SUPERFICIE</th>
                <th scope="col">PRECIO VENTA</th>
                <th scope="col">VENDEDOR</th>
                <th scope="col">COMISION</th>
                <th scope="col">EDITAR</th>
                <th scope="col">BORRAR</th>
            </tr>
        </thead>
        <tbody>
            <?php
                //ciclo para extraer el registro del paquete
                while($dato = mysqli_fetch_assoc($resultado)){
                    echo '<tr> <th scope="row">'.$dato['Referencia'].'</th>';
                    echo '<td>'.$dato['FechaAlta'].'</td>';
                    echo '<td>'.$dato['FechaVenta'].'</td>';
                    echo '<td>'.$dato['Tipo'].'</td>';
                    echo '<td>'.$dato['Operacion'].'</td>';
                    echo '<td>'.$dato['Provincia'].'</td>';
                    echo '<td>'.$dato['Superficie'].'</td>';
                    echo '<td>'.$dato['PrecioVenta'].'</td>';
                    echo '<td>'.$dato['Vendedor'].'</td>';
                    echo '<td>'.$dato['Comision'].'</td>';
                    echo '<td><a href="actualizar.php?id='.$dato['Referencia'].'" class="btn btn-warning">Actualizar</a></td>';
                    echo '<td><a href="eliminar.php?id='.$dato['Referencia'].'" class="btn btn-danger">Eliminar</a></td></tr>';
                } 
            ?>
        </tbody>
    </table>
    
    <br/>

    <form method="POST">
        <h2>Formulario para el Registro de Nuevos Datos</h2>
        <div class="form-floating mb-3">
            <input type="date" class="form-control" id="FechaAlta" name="FechaAlta">
            <label for="nombre">Fecha de Alta</label>
        </div>
        <div class="form-floating mb-3">
            <input type="date" class="form-control" id="FechaVenta" name="FechaVenta">
            <label for="nombre">Fecha de la Venta</label>
        </div>
        <div class="form-floating mb-3">
            <!--Remplazar por un comboBox-->
            <select class="form-select" name="Tipo">
                <option selected>Seleccione un Tipo de Propiedad</option>
                <?php
                //ciclo para extraer el registro del paquete
                while($dato1 = mysqli_fetch_assoc($llenaTipo1)){
                    echo '<option value='.$dato1['tipopropiedad'].'>'.$dato1['tipopropiedad'].'</option>';
                }?>
            </select>
        </div>
        <div class="form-floating mb-3">
            <!--Remplazar por un comboBox-->
            <select class="form-select" name="Operacion">
                <option selected>Seleccione un Tipo de Operacion</option>
                <?php
                //ciclo para extraer el registro del paquete
                while($dato2 = mysqli_fetch_assoc($llenaOperacion1)){
                    echo '<option value='.$dato2['operacion'].'>'.$dato2['operacion'].'</option>';
                }?>
            </select>
        </div>
        <div class="form-floating mb-3">
            <!--Remplazar por un comboBox-->
            <select class="form-select" name="Provincia">
                <option selected>Seleccione Provincia</option>
                <?php
                //ciclo para extraer el registro del paquete
                while($dato3 = mysqli_fetch_assoc($llenaProvincia1)){
                    echo '<option value='.$dato3['provincia'].'>'.$dato3['provincia'].'</option>';
                }?>
            </select>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="Superficie" placeholder="Mtros Cuadrados" name="Superficie">
            <label for="Superficie">Superficie en M2</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="PrecioVenta" placeholder="Precio de la Propiedad" name="PrecioVenta">
            <label for="Superficie">Precio de la Propiedad</label>
        </div>
        <div class="form-floating mb-3">
            <!--Remplazar por un comboBox-->
            <select class="form-select" name="Vendedor">
                <option selected>Vendedor</option>
                <?php
                //ciclo para extraer el registro del paquete
                while($dato4 = mysqli_fetch_assoc($llenaVendedor1)){
                    echo '<option value='.$dato4['Vendedor'].'>'.$dato4['Vendedor'].'</option>';
                }?>
            </select>
        </div>
        <div>
            <input class="btn btn-primary" type="submit" value="Guardar Datos" name="boton"/>
        </div>
    </form>

    <?php
        if(isset($_POST['boton'])){
            $FechaAlta = $_POST['FechaAlta'];
            $FechaVenta = $_POST['FechaVenta'];
            $Tipo = $_POST['Tipo'];
            $Operacion = $_POST['Operacion'];
            $Provincia = $_POST['Provincia'];
            $Superficie = $_POST['Superficie'];
            $PrecioVenta = $_POST['PrecioVenta'];
            $Vendedor = $_POST['Vendedor'];
            $Comision = $PrecioVenta * 0.05;
            $insertar = "Insert Into Ventas (FechaAlta, FechaVenta, Tipo, Operacion, Provincia, Superficie, PrecioVenta, Vendedor, Comision) Values ('$FechaAlta', '$FechaVenta', '$Tipo', '$Operacion', '$Provincia', '$Superficie', '$PrecioVenta', '$Vendedor', '$Comision')";
            mysqli_query($conn, $insertar);
            mysqli_close($conn);
            echo "<script language='javascript'>window.location='index.php'</script>";
        }
    ?>


</body>
</html>