<?php include('header.php'); ?>    
<?php include('session.php'); ?>    
<?php $search = isset($_POST['search']) ? htmlspecialchars($_POST['search']) : ''; ?>
<body>
    <?php include('navbar.php'); ?>

    <div id="masthead">  
        <div class="container">
            <?php include('heading.php'); ?>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="top-spacer"></div>
                </div>
            </div> 
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12"> 
                <div class="panel">
                    <div class="panel-body">
                        <div class="row">    
                            <br>
                            <?php
                            if (!empty($search)) {
                                $stmt = $conn->prepare("SELECT * FROM members WHERE firstname LIKE :search OR lastname LIKE :search");
                                $stmt->execute(['search' => '%' . $search . '%']);
                                $count = $stmt->rowCount();

                                if ($count > 0) { 
                                    while ($row = $stmt->fetch()) {
                                        $posted_by = htmlspecialchars($row['firstname'] . " " . $row['lastname']);
                                        $posted_image = htmlspecialchars($row['image']);
                                        $friend_id = $row['member_id'];
                            ?>
                            <div class="col-md-2 col-sm-3 text-center">
                                <img src="<?php echo $posted_image; ?>" style="width:100px;height:100px" class="img-circle" alt="Profile Image">
                            </div>
                            <div class="col-md-10 col-sm-9">
                                <div class="alert"><?php echo $posted_by; ?></div>
                                <div class="row">
                                    <div class="col-xs-9">
                                        <form method="post" action="add_friend.php">
                                            <div class="col-xs-3">
                                                <input type="hidden" name="my_friend_id" value="<?php echo $friend_id; ?>">
                                                <?php
                                                $query1 = $conn->prepare("SELECT * FROM friends WHERE my_friend_id = :friend_id");
                                                $query1->execute(['friend_id' => $friend_id]);
                                                $count1 = $query1->rowCount();
                                                
                                                if ($count1 > 0) {
                                                    echo 'All Ready Friend';
                                                } else {
                                                ?>
                                                <button class="btn btn-info"><i class="icon-plus-sign"></i> Add as Friend</button>
                                                <?php } ?>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <br><br>
                            </div>
                            <?php 
                                    }
                                } else {
                                    echo '&nbsp;&nbsp;&nbsp;&nbsp;No Result Found.';
                                }
                            }
                            ?>		
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('footer.php'); ?>
</body>
</html>
