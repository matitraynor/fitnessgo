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

    <div class="container text-center">
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="panel" style="border: 1px solid #ddd; padding: 20px; border-radius: 10px;">
                    <div class="panel-body">
                        <?php
                        try {
                            $userQuery = $conn->prepare("SELECT firstname, lastname, image FROM members WHERE member_id = :member_id");
                            $userQuery->execute([':member_id' => $session_id]);
                            $user = $userQuery->fetch();

                            if ($user) {
                                $image = $user['image'] ?: 'default-profile.png';
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

                        <div class="d-flex justify-content-center mb-3">
                            <img src="<?php echo $image; ?>" alt="Foto de perfil" style="width:100px;height:100px" class="img-circle">
                        </div>
                        <h3 class="h4"><?php echo $fullName; ?></h3>

                        <h5 class="text-primary mt-2">Tienes <?php
                            $queryCount = $conn->query("
                                SELECT COUNT(*) as total_friends 
                                FROM members, friends 
                                WHERE (friends.my_friend_id = '$session_id' AND members.member_id = friends.my_id)
                                OR (friends.my_id = '$session_id' AND members.member_id = friends.my_friend_id)
                            ");
                            $count = $queryCount->fetch();
                            echo $count['total_friends'];
                        ?> amigos</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="container text-center">
    <h4 class="text-center text-primary">Amigos</h4>
    <div class="panel">
        <div class="panel-body">
            <div class="row">
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
                    $friend_image = $row['image'];
                    $id = $row['friends_id'];
                ?>
                    <div class="row mb-3">
                        <div class="col-md-2 text-center">
                            <img src="<?php echo $friend_image; ?>" alt="Friend Image" style="width:100px;height:100px" class="img-circle">
                        </div>
                        <div class="col-md-8">
                            <div class="alert">
                                <?php echo $friend_name; ?>
                            </div>
                        </div>
                        <div class="col-md-2 text-center">
                            <a href="message_friend.php?id=<?php echo $id; ?>" class="btn btn-info btn-sm">Mensaje</a>
                            <a href="delete_friend.php?id=<?php echo $id; ?>" class="btn btn-danger btn-sm">Eliminar</a>
                        </div>
                    </div>
                    <hr>
                <?php } ?>
            </div>
        </div>
    </div>
</div>


    <?php include('footer.php'); ?>
</body>
</html>
