<header class="navbar navbar-bright navbar-fixed-top" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="home.php" class="navbar-brand">
        <i class="icon-anchor"></i> FitnessGo
      </a>
    </div>

    <nav class="collapse navbar-collapse" role="navigation">
      <ul class="nav navbar-nav navbar-right"> <!-- Alineamos los elementos del navbar a la derecha -->
        <li><a href="home.php"><i class="icon-home"></i> Inicio</a></li>
        <li><a href="photos.php"><i class="icon-picture"></i> Fotos</a></li>
        <li><a href="friends.php"><i class="icon-group"></i> Amigos</a></li>
        <li><a href="message.php"><i class="icon-envelope"></i> Mensajes</a></li>
        <li>
          <a 
            href="logout.php" 
            onclick="return confirmLogout(event);">
            <i class="icon-signout"></i> Cerrar Sesión
          </a>
        </li>
        
        <!-- Foto de perfil del usuario -->
        <li class="navbar-profile">
          <a href="profile.php">
            <img src="<?php echo $image; ?>" alt="Foto de perfil" class="img-circle" width="30" height="30">
          </a>
        </li>
      </ul>

      <!--<div class="form-inline navbar-form navbar-right">
        <form method="post" action="search.php">
          <input type="text" name="search" class="form-control" id="span5" placeholder="Buscar">
        </form>
      </div>-->
    </nav>
  </div>
</header>

<script>
  function confirmLogout(event) {
      event.preventDefault(); // Evita que el enlace se ejecute automáticamente
      const userConfirmed = confirm("¿Deseas cerrar sesión?");
      if (userConfirmed) {
          // Si el usuario confirma, redirige al enlace de cierre de sesión
          window.location.href = event.target.href;
      }
  }
</script>
