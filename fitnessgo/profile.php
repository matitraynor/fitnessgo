<?php include('header.php'); ?>    
<?php include('session.php'); ?>

<body>
    <?php include('navbar.php'); ?>
    <?php
        $query = $conn->query("SELECT * FROM members WHERE member_id = '$session_id'");
        $row = $query->fetch();
        ?>

    <header id="masthead">
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="top-spacer"></div>
                </div>
            </div>
        </div>
    </header>

    <div class="container profile-page mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-card text-center">
                    <img class="pp rounded-circle" src="<?php echo $image; ?>" alt="Foto de perfil" height="150" width="150">
                    <h3 class="mt-3"><?php echo $row['firstname'] . " " . $row['lastname']; ?></h3>
                    <p class="text-muted"><?php echo $row['status']; ?></p>
                    <a class="btn btn-warning mt-3" href="change_pic.php">Cambiar Foto</a>
                </div>
            </div>

            <div class="col-md-8">
                <!-- Información Personal -->
                <div class="profile-info-card">
                    <div class="d-flex justify-content-between">
                        <h4 class="mb-3">Información Personal</h4>
                        <a href="edit_profile.php" class="btn btn-primary">
                            <i class="icon-pencil"></i> Editar
                        </a>
                    </div>
                    <ul class="list-unstyled">
                        <li><strong>Género:</strong> <?php echo $row['gender']; ?></li>
                        <li><strong>Dirección:</strong> <?php echo $row['address']; ?></li>
                        <li><strong>Fecha de Nacimiento:</strong> <?php echo $row['birthdate']; ?></li>
                        <li><strong>Número de Contacto:</strong> <?php echo $row['mobile']; ?></li>
                        <li><strong>Trabajo:</strong> <?php echo $row['work']; ?></li>
                        <li><strong>Religión:</strong> <?php echo $row['religion']; ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <?php include('footer.php'); ?>
</body>
</html>
