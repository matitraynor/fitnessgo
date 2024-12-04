<?php include('header.php'); ?>    
<?php include('session.php'); ?>

<body>
    <?php include('navbar.php'); ?>

    <header id="masthead" class="mb-4">
        <div class="container">
            <?php include('heading.php'); ?>
        </div>
    </header>

    <main class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="top-spacer mb-4"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <br>
                            <?php
                            $query = $conn->query("select * from post LEFT JOIN members on members.member_id = post.member_id order by post_id DESC");
                            while ($row = $query->fetch()) {
                                $posted_by = $row['firstname'] . " " . $row['lastname'];
                                $posted_image = $row['image'];
                                $id = $row['post_id'];
                            ?>
                                <article class="row mb-4">
                                    <div class="col-md-2 col-sm-3 text-center">
                                        <img src="<?php echo $posted_image; ?>" alt="Imagen del usuario" style="width:100px; height:100px;" class="img-circle">
                                    </div>

                                    <div class="col-md-10 col-sm-9">
                                        <div class="alert"><?php echo $row['content']; ?></div>
                                        <div class="row">
                                            <div class="col-xs-9">
                                                <h4>
                                                    <span class="label label-info"><?php echo $row['date_posted']; ?></span>
                                                </h4>
                                                <h4>
                                                    <small class="text-muted">
                                                        Posteado por:
                                                        <a href="#" class="text-muted"><?php echo $posted_by; ?></a>
                                                    </small>
                                                </h4>
                                            </div>
                                            
                                            <div class="col-xs-3 text-end">
                                                <a href="delete_post.php<?php echo '?id=' . $id; ?>" class="btn btn-danger">
                                                    <i class="icon-trash"></i> Borrar
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                                <hr>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include('footer.php'); ?>
</body>
</html>
