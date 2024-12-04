<?php include('header.php'); ?>
<?php include('session.php'); ?>

<body>
    <?php include('navbar.php'); ?>

    <div id="masthead" style="padding-top: 70px;">
        <div class="container">
            <?php
            try {
                $userQuery = $conn->prepare("SELECT firstname, lastname, image FROM members WHERE member_id = :member_id");
                $userQuery->execute([':member_id' => $session_id]);
                $user = $userQuery->fetch();

                if ($user) {
                    $image = isset($user['image']) ? $user['image'] : 'default-profile.png';
                    $fullName = htmlspecialchars($user['firstname'] . ' ' . $user['lastname']);
                } else {
                    $image = 'default-profile.png';
                    $fullName = 'Usuario Invitado';
                }
            } catch (Exception $e) {
                echo "<p class='text-danger'>Error al obtener datos del usuario: " . $e->getMessage() . "</p>";
                $image = 'default-profile.png';
                $fullName = 'Mauricio Sevilla';
            }
            ?>
            <img src="<?php echo $image; ?>" alt="Foto de perfil" style="width:100px;height:100px" class="img-circle">
            <h2 class="h5 mt-2">Bienvenido, <?php echo $fullName; ?> 👋</h2>
        </div>
    </div>


    <div class="container">
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Subir una Foto</h5>
                        <form id="photos" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="image">Seleccionar imagen:</label>
                                <input type="file" name="image" id="image" class="form-control" accept="image/*" required>
                            </div>
                            <div class="mt-3 text-center">
                                <img id="preview" src="#" alt="Vista previa" class="img-thumbnail" style="display: none; max-width: 100%; height: auto;">
                            </div>
                            <button type="submit" name="submit" class="btn btn-success btn-block mt-3">
                                Subir Foto
                            </button>
                        </form>
                        <?php
                        if (isset($_POST['submit'])) {
                            $image = $_FILES['image'];
                            $targetDir = "upload/";
                            $targetFile = $targetDir . uniqid() . "-" . basename($image['name']);
                            if (move_uploaded_file($image['tmp_name'], $targetFile)) {
                                $stmt = $conn->prepare("INSERT INTO photos (location, member_id) VALUES (:location, :member_id)");
                                $stmt->execute([':location' => $targetFile, ':member_id' => $session_id]);
                                echo "<script>window.location = 'photos.php';</script>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <h3 class="mb-3 text-primary text-center elevate-title">Tus Fotos</h3>
                <div class="row">
                    <?php
                    $stmt = $conn->prepare("SELECT * FROM photos WHERE member_id = :member_id ORDER BY photos_id DESC");
                    $stmt->execute([':member_id' => $session_id]);
                    while ($row = $stmt->fetch()) {
                        $id = $row['photos_id'];
                        $location = $row['location'];
                    ?>
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card">
                                <img src="<?php echo $location; ?>" class="card-img-top img-thumbnail" alt="Foto">
                                <div class="card-body text-center">
                                    <button class="btn btn-outline-danger btn-sm delete-photo" data-id="<?php echo $id; ?>">
                                        Eliminar
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('image').addEventListener('change', function (event) {
            const preview = document.getElementById('preview');
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
                preview.src = '#';
            }
        });

        document.querySelectorAll('.delete-photo').forEach(button => {
            button.addEventListener('click', function () {
                const photoId = this.dataset.id;
                if (confirm('¿Seguro que quieres eliminar esta foto?')) {
                    fetch(`delete_photos.php?id=${photoId}`, { method: 'GET' })
                        .then(response => response.text())
                        .then(data => {
                            if (data === 'success') location.reload();
                        })
                        .catch(error => console.error('Error:', error));
                }
            });
        });
    </script>

    <?php include('footer.php'); ?>
</body>
</html>
