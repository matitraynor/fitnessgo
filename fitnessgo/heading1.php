<div class="row">
    <div class="col-md-2">
        <hr>
        <center>
            <img class="pp" src="<?php echo $image; ?>" height="140" width="160" alt="Foto de perfil">
        </center>
        <hr>
        <a class="btn btn-success" href="change_pic.php">Cambiar Foto de Perfil</a>
    </div>

    <div class="col-md-10">
        <hr>
        <div class="pull-right">
            <a href="edit_profile.php" class="btn btn-info">
                <i class="icon-pencil"></i> Editar
            </a>
        </div>
        
        <p><strong>Información Personal</strong></p>

        <?php
        $query = $conn->query("SELECT * FROM members WHERE member_id = '$session_id'");
        $row = $query->fetch();
        ?>

        <hr>
        <p><strong>Nombre:</strong> <?php echo $row['firstname'] . " " . $row['lastname']; ?></p>
        <p><strong>Género:</strong> <?php echo $row['gender']; ?></p>
        <hr>

        <p><strong>Dirección:</strong> <?php echo $row['address']; ?></p>
        <hr>

        <p><strong>Fecha de Nacimiento:</strong> <?php echo $row['birthdate']; ?></p>
        <hr>

        <p><strong>Número de Contacto:</strong> <?php echo $row['mobile']; ?></p>
        <hr>

        <p><strong>Estado:</strong> <?php echo $row['status']; ?></p>
        <hr>

        <p><strong>Trabajo:</strong> <?php echo $row['work']; ?></p>
        <hr>

        <p><strong>Religión:</strong> <?php echo $row['religion']; ?></p>
        <hr>
    </div>
</div>
