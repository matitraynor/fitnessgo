<?php include('header.php'); ?>
<?php include('session.php'); ?>

<body>
    <?php include('navbar.php'); ?>

    <div id="masthead" style="padding-top: 70px;">
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="top-spacer"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5 d-flex justify-content-center">
        <div class="row w-100">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 mb-4 text-center">
                                <h4>Enviar Mensaje</h4>
                                <form method="post" id="send_message" action="send_message.php">
                                    <div class="form-group">
                                        <label for="friend_id">Selecciona tu Contacto:</label>
                                        <select name="friend_id" class="form-control combo" id="friend_id" required>
                                            <option value="" disabled selected>Selecciona un contacto</option>
                                            <?php
                                            $query = $conn->query("
                                                SELECT 
                                                    members.member_id, 
                                                    members.firstname, 
                                                    members.lastname, 
                                                    members.image, 
                                                    friends.friends_id 
                                                FROM 
                                                    members, friends
                                                WHERE 
                                                    (friends.my_friend_id = '$session_id' AND members.member_id = friends.my_id)
                                                    OR 
                                                    (friends.my_id = '$session_id' AND members.member_id = friends.my_friend_id)
                                            ");

                                            while ($row = $query->fetch()) {
                                                $friend_name = $row['firstname'] . " " . $row['lastname'];
                                                $id = $row['member_id'];
                                            ?>
                                                <option value="<?php echo $id; ?>"><?php echo $friend_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                  
                                    <div class="form-group">
                                        <label for="my_message">Tu mensaje:</label>
                                        <textarea name="my_message" id="my_message" class="form-control my_message" rows="4" required></textarea>
                                    </div>
                                  
                                    <div class="form-group text-center">
                                        <button class="btn btn-success" type="submit">
                                            <i class="icon-envelope-alt"></i> Enviar
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <div class="col-md-6 col-sm-12">
                                <h4>Bandeja Privada</h4>
                                <button id="toggleBandejaBtn" class="btn btn-primary mb-3">Ocultar Bandeja Privada</button>
                                <hr id="bandejaDivider">
                                <div id="bandejaPrivate">
                                    <?php
                                    $query = $conn->query("
                                        SELECT 
                                            * 
                                        FROM 
                                            message
                                        LEFT JOIN 
                                            members ON message.sender_id = members.member_id 
                                        WHERE 
                                            reciever_id = '$session_id'
                                    ");

                                    while ($row = $query->fetch()) {
                                        $id = $row['message_id'];
                                    ?>
                                        <div class="mes">
                                            <div class="message">
                                                <p><?php echo $row['content']; ?></p>
                                                <hr>
                                                <div class="d-flex justify-content-between">
                                                    <span class="text-muted"><?php echo $row['date_sended']; ?></span>
                                                    <span class="text-muted">Enviado por: <?php echo $row['firstname'] . " " . $row['lastname']; ?></span>
                                                </div>
                                                <hr>
                                                <a href="delete_message.php?id=<?php echo $id; ?>" class="btn btn-danger">
                                                    <i class="icon-remove"></i> Eliminar
                                                </a>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('footer.php'); ?>

    <script>
        const toggleBandejaBtn = document.getElementById('toggleBandejaBtn');
        const bandejaPrivate = document.getElementById('bandejaPrivate');
        const bandejaDivider = document.getElementById('bandejaDivider');

        toggleBandejaBtn.addEventListener('click', () => {
            const isHidden = bandejaPrivate.style.display === 'none';

            if (isHidden) {
                bandejaPrivate.style.display = 'block';
                bandejaDivider.style.display = 'block';
                toggleBandejaBtn.textContent = 'Ocultar Bandeja Privada';
            } else {
                bandejaPrivate.style.display = 'none';
                bandejaDivider.style.display = 'none';
                toggleBandejaBtn.textContent = 'Mostrar Bandeja Privada';
            }
        });
    </script>
</body>
</html>
