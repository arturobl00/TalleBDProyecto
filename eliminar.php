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

        //Ejecutar el Query
        $resultado = mysqli_query($conn, $consulta); 
    ?>

    <h1>Mi Primer Proyecto CRUD</h1>    
    <h2>Eliminar Registro de la Base</h2>
    
    <form method="post">
        <h2>Formulario para Eliminar Registro</h2>
        <?php
            while($dato = mysqli_fetch_assoc($resultado)){
            echo '<div class="form-floating mb-3">';
            echo '<input type="text" class="form-control" disabled value="'.$dato['FechaAlta'].'">';
            echo '<label>Fecha de Alta</label></div>';

            echo '<div class="form-floating mb-3">';
            echo '<input type="text" class="form-control" disabled value="'.$dato['FechaVenta'].'">';
            echo '<label>Fecha de Venta</label></div>';

            echo '<div class="form-floating mb-3">';
            echo '<input type="text" class="form-control" disabled value="'.$dato['Tipo'].'">';
            echo '<label>Tipo de Propiedad</label></div>';

            echo '<div class="form-floating mb-3">';
            echo '<input type="text" class="form-control" disabled value="'.$dato['Operacion'].'">';
            echo '<label>Tipo de Operacion</label></div>';

            echo '<div class="form-floating mb-3">';
            echo '<input type="text" class="form-control" disabled value="'.$dato['Provincia'].'">';
            echo '<label>Estado</label></div>';

            echo '<div class="form-floating mb-3">';
            echo '<input type="text" class="form-control" disabled value="'.$dato['Superficie'].'">';
            echo '<label>Superficie en M2</label></div>';

            echo '<div class="form-floating mb-3">';
            echo '<input type="text" class="form-control" disabled value="'.$dato['PrecioVenta'].'">';
            echo '<label>Precio de Venta</label></div>';

            echo '<div class="form-floating mb-3">';
            echo '<input type="text" class="form-control" disabled value="'.$dato['Vendedor'].'">';
            echo '<label>Vendedor a Cargo</label></div>';

            echo '<div class="form-floating mb-3">';
            echo '<input type="text" class="form-control" disabled value="'.$dato['Comision'].'">';
            echo '<label>Comision Otorgada</label></div>';
            }
        ?>
        <div>
            <input class="btn btn-primary" type="submit" value="Eliminar" name="boton"/>
        </div>
    </form>

    <?php
        if(isset($_POST['boton'])){
            $eliminar = "Delete from ventas where Referencia = '$id'";
            mysqli_query($conn, $eliminar);
            mysqli_close($conn);
            echo "<script language='javascript'>window.location='index.php'</script>";
        }
    ?>
</body>
</html>