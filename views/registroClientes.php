<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/CSS/registroUsuarios.css">
    <script src="ruta/a/bootstrap/js/bootstrap.min.js"></script>
    <title>Registro de Clientes - Celtech Store</title>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Celltech Store</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Productos</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Link
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Catalogo</a></li>
            <li><a class="dropdown-item" href="#">iPhone</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Accesorios</a></li>
          </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Sobre Nosotros</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
</header>

<main class="container">
  <h1 class="display-6">Registro de Usuario</h1>

  <div class="formContainer">
    
    <form action="../controllers/registroClientes.php" method="post"class="row g-3" novalidate>

    <div class="col-md-6">
      <label for="" class="form-label">Nombre</label>
      <input type="text" class="form-control" id="" placeholder="Nombre" name="nombre" required>
    </div>

    <div class="col-md-6">
      <label for="" class="form-label">Apellido</label>
      <input type="text" class="form-control" id="" placeholder="Apellido" name="apellido" required>
    </div>

    <div class="col-md-6">
      <label for="" class="form-label">Nombre de Usuario</label>
      <div class="input-group">
        <input type="text" class="form-control" id="" aria-describedby="inputGroupPrepend" name="usuario" required>
      </div>
    </div>

    <div class="col-md-6">
      <label for="" class="form-label">Contraseña</label>
      <div class="input-group">
        <input type="text" class="form-control" id="" aria-describedby="inputGroupPrepend" name="password" required>
      </div>
    </div>

    <div class="col-md-6">
      <label for="" class="form-label">Cedula</label>
      <input type="text" class="form-control" id="" placeholder="Cedula" name="cedula" required>
      </select>
    </div>

    <div class="col-md-6">
      <label for="" class="form-label">Telefono</label>
      <input type="text" class="form-control" id="" placeholder="Telefono" name="telefono" required>
      </select>
    </div>

    <div class="col-md-6">
      <label for="" class="form-label">Correo</label>
      <input type="text" class="form-control" id="" placeholder="Correo Electronico" name="email" required>
      </select>
    </div>

    <div class="col-md-6">
      <label for="" class="form-label">Direccion</label>
      <input type="text" class="form-control" id="" placeholder="Direccion" name="direccion" required>
    </div>


    <div class="col-20">
      <button class="btn btn-primary" type="submit" name="btn">Registrarse</button>
    </div>
    </form>
  </div>    
</main>
</body>
</html>