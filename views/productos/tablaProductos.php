<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="ruta/a/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/2.0.5/css/dataTables.dataTables.min.css">
    <title>Productos</title>
</head>
<body>

<table id="myTable">
    <!-- <thead>
        <tr>
            <th>Productos ID</th>
            <th>Descripcion</th>
            <th>Categoria</th>
            <th>Estado</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Fecha de Creacion</th>
        </tr>
    </thead> -->
    <!-- <tbody>
        <?php while ($row = $productos->fetch(PDO::FETCH_ASSOC)){?>
        <tr>
            <td><?php echo $row['productosId']; ?></td>
            <td><?php echo $row['descripcion']; ?></td>
            <td><?php echo $row['categoriaId']; ?></td>
            <td><?php echo $row['estadoId']; ?></td>
            <td><?php echo $row['nombre']; ?></td>
            <td><?php echo $row['precio']; ?></td>
            <td><?php echo $row['stock']; ?></td>
            <td><?php echo $row['creado']; }?></td>
        </tr>
    </tbody>
</table> -->

</div>

<script src="//code.jquery.com/jquery-3.5.1.js"></script>
<script src="//cdn.datatables.net/2.0.5/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#myTable').DataTable();
});
</script>
    
</body>
</html>