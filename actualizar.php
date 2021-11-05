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

    <?php
        //bajar el parametro de la url
        $id = $_GET['id'];

        //incluyendo el codigo de conexion
        include 'conexion.php';

        //Consultando el registro en mi bd
        $consulta = "Select * from ventas where Referencia = ".$id;

        //Queries para llenar los comboBox
        $llenaVendedor = "Select Vendedor from vendedores";
        $llenaTipo = "Select tipopropiedad from tipo";
        $llenaProvincia = "Select provincia from provincia";
        $llenaOperacion = "Select operacion from operacion";

        //Ejecutar el Query
        $resultado = mysqli_query($conn, $consulta); 

        $llenaTipo1 = mysqli_query($conn, $llenaTipo);
        $llenaOperacion1 = mysqli_query($conn, $llenaOperacion);
        $llenaProvincia1 = mysqli_query($conn, $llenaProvincia);
        $llenaVendedor1 = mysqli_query($conn, $llenaVendedor);
    ?>

    <h1>Mi Primer Proyecto CRUD</h1>    
    <h2>Editar datos de la Base</h2>
    
    <form method="post">
        <h2>Formulario para la Edición de Registros</h2>
        <?php
            while($dato = mysqli_fetch_assoc($resultado)){
                echo '<div class="form-floating mb-3">';
                echo '<input type="text" class="form-control" id="FechaAlta" name="FechaAlta" value="'.$dato['FechaAlta'].'">';
                echo '<label>Fecha de Alta</label></div>';
    
                echo '<div class="form-floating mb-3">';
                echo '<input type="text" class="form-control" id="FechaVenta" name="FechaVenta" value="'.$dato['FechaVenta'].'">';
                echo '<label>Fecha de Venta</label></div>';
    
                echo '<div class="form-floating mb-3">';
                echo '<select class="form-select" name="Tipo">';
                echo '<option selected>'.$dato['Tipo'].'</option>';
                while($dato1 = mysqli_fetch_assoc($llenaTipo1)){
                    echo '<option value='.$dato1['tipopropiedad'].'>'.$dato1['tipopropiedad'].'</option>';
                }
                echo '</select>';
                echo '</div>';

                echo '<div class="form-floating mb-3">';
                echo '<select class="form-select" name="Operacion">';
                echo '<option selected>'.$dato['Operacion'].'</option>';
                while($dato2 = mysqli_fetch_assoc($llenaOperacion1)){
                    echo '<option value='.$dato2['operacion'].'>'.$dato2['operacion'].'</option>';
                }
                echo '</select>';
                echo '</div>';
                
                echo '<div class="form-floating mb-3">';
                echo '<select class="form-select" name="Provincia">';
                echo '<option selected>'.$dato['Provincia'].'</option>';
                while($dato3 = mysqli_fetch_assoc($llenaProvincia1)){
                    echo '<option value='.$dato3['provincia'].'>'.$dato3['provincia'].'</option>';
                }
                echo '</select>';
                echo '</div>';
                    
                echo '<div class="form-floating mb-3">';
                echo '<input type="text" class="form-control" id="Superficie" name="Superficie"value="'.$dato['Superficie'].'">';
                echo '<label>Superficie en M2</label></div>';
    
                echo '<div class="form-floating mb-3">';
                echo '<input type="text" class="form-control" id="PrecioVenta" name="PrecioVenta" value="'.$dato['PrecioVenta'].'">';
                echo '<label>Precio de Venta</label></div>';
    
                echo '<div class="form-floating mb-3">';
                echo '<select class="form-select" name="Vendedor">';
                echo '<option selected>'.$dato['Vendedor'].'</option>';
                while($dato4 = mysqli_fetch_assoc($llenaVendedor1)){
                    echo '<option value='.$dato4['Vendedor'].'>'.$dato4['Vendedor'].'</option>';
                }
                echo '</select>';
                echo '</div>';

                echo '<div class="form-floating mb-3">';
                echo '<input type="text" class="form-control" disabled value="'.$dato['Comision'].'">';
                echo '<label>Comision Otorgada</label></div>';
            }
        ?>
        <div>
            <input class="btn btn-primary" type="submit" value="Actualizar" name="boton"/>
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
            $actualizar = "Update ventas set FechaAlta = '$FechaAlta', FechaVenta = '$FechaVenta', Tipo = '$Tipo', Operacion = '$Operacion', Provincia='$Provincia', Superficie = '$Superficie', PrecioVenta = '$PrecioVenta', Vendedor = '$Vendedor', Comision = '$Comision'  where Referencia = '$id'";
            mysqli_query($conn, $actualizar);
            mysqli_close($conn);
            echo "<script language='javascript'>window.location='index.php'</script>";
        }
    ?>
</body>
</html>