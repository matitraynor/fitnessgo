<?php include('header.php'); ?>    
<?php include('session.php'); ?>    

<body>
    <?php include('navbar.php'); ?>

    <div id="masthead">  
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <hr>
                    <center><img class="pp" src="<?php echo htmlspecialchars($image); ?>" height="140" width="160" alt="Foto de perfil"></center>
                    <hr>
                    <a href="change_pic.php" class="btn btn-success">Cambiar Foto de Perfil</a>
                </div>
                <div class="col-md-10">
                    <?php
                    $query = $conn->query("SELECT * FROM members WHERE member_id = '$session_id'");
                    $row = $query->fetch();
                    $id = $row['member_id'];
                    ?>

                    <hr>

                    <form method="post" action="save_edit.php">
                        <input type="hidden" name="member_id" value="<?php echo htmlspecialchars($id); ?>">

                        <div class="form-group">
                            <label for="username">Usuario:</label>
                            <input type="text" class="form-control" name="username" id="username" value="<?php echo htmlspecialchars($row['username']); ?>" required>
                        </div>
                        <hr>

                        <div class="form-group">
                            <label for="firstname">Nombre:</label>
                            <input type="text" class="form-control" name="firstname" id="firstname" value="<?php echo htmlspecialchars($row['firstname']); ?>" required>
                        </div>
                        <hr>

                        <div class="form-group">
                            <label for="lastname">Apellido:</label>
                            <input type="text" class="form-control" name="lastname" id="lastname" value="<?php echo htmlspecialchars($row['lastname']); ?>" required>
                        </div>
                        <hr>

                        <div class="form-group">
                            <label for="gender">Género:</label>
                            <select name="gender" class="form-control" id="gender" required>
                                <option value=""><?php echo htmlspecialchars($row['gender']); ?></option>
                                <option value="Hombre">Hombre</option>
                                <option value="Mujer">Mujer</option>
                            </select>
                        </div>
                        <hr>

                        <div class="form-group">
                            <label for="birthdate">Fecha de Nacimiento:</label>
                            <input type="date" class="form-control" name="birthdate" id="birthdate" value="<?php echo htmlspecialchars($row['birthdate']); ?>" required>
                        </div>
                        <hr>

                        <div class="form-group">
                            <label for="address">Dirección:</label>
                            <input type="text" class="form-control" name="address" id="address" value="<?php echo htmlspecialchars($row['address']); ?>" required>
                        </div>
                        <hr>

                        <div class="form-group">
                            <label for="status">Estado:</label>
                            <input type="text" class="form-control" name="status" id="status" value="<?php echo htmlspecialchars($row['status']); ?>" required>
                        </div>
                        <hr>

                        <div class="form-group">
                            <label for="mobile">Móvil:</label>
                            <input type="tel" class="form-control" name="mobile" id="mobile" value="<?php echo htmlspecialchars($row['mobile']); ?>" required>
                        </div>
                        <hr>

                        <div class="form-group">
                            <label for="work">Trabajo:</label>
                            <input type="text" class="form-control" name="work" id="work" value="<?php echo htmlspecialchars($row['work']); ?>" required>
                        </div>
                        <hr>

                        <div class="form-group">
                            <label for="religion">Religión:</label>
                            <input type="text" class="form-control" name="religion" id="religion" value="<?php echo htmlspecialchars($row['religion']); ?>" required>
                        </div>
                        <hr>

                        <div class="text-center">
                            <button type="submit" name="save" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="top-spacer"></div>
                </div>
            </div>
        </div>
    </div>

    <?php include('footer.php'); ?>

</body>
</html>
