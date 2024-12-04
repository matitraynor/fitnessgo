<?php include('index_header.php'); ?>
<?php include('dbcon.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness GO</title>
    <link rel="stylesheet" href="path_to_your_stylesheet.css">
</head>
<body>
    <div class="container">
        <div class="codrops-top">
            <div class="clr">
                <div class="title">Fitness GO</div>
            </div>
        </div>

        <section>
            <div id="container_demo">
                <a class="hiddenanchor" id="toregister"></a>
                <a class="hiddenanchor" id="tologin"></a>

                <div id="wrapper">
                    <div id="login" class="animate form">
                        <?php include('login_form.php'); ?>
                    </div>

                    <div id="register" class="animate form">
                        <?php include('sign_up_form.php'); ?>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="path_to_your_script.js"></script>
</body>
</html>
