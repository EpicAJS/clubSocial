<?php

include 'includes/permissions.php';
include 'includes/db.php';

?>

<!doctype html>
<html lang="en">
<head>

    <title>ZBOOK</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

</head>
<body id="search">

    <?php include 'includes/profile-login-nav.php'; ?>

    <div class="search-results">
    <div class="container">

        <?php

            $user_id = $_SESSION['user_id'];
            $sql = "SELECT * FROM friend_requests WHERE requested_id={$user_id}";
            $result = mysqli_query($conn, $sql);

        ?>

        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="search-results__single">
                <img src="img/profile-photo.jpg" alt="">

                <?php
                    $requester_id = $row['requester_id'];
                    $name_sql = "SELECT * FROM users WHERE id={$requester_id} LIMIT 1";
                    $name_result = mysqli_query($conn, $name_sql);
                    $name_row = mysqli_fetch_assoc($name_result);
                ?>

                <a><?php echo $name_row['first_name'] . ' ' . $name_row['last_name']; ?></a>

                <form action="process/friend-accept.php" method="POST">
                    <input type="hidden" name="requester_id" value="<?php echo $requester_id; ?>">
                    <button>
                        <i class="fa fa-user-plus" aria-hidden="true"></i>
                        <span>Accept Request</span>
                    </button>
                </form>
            </div>
        <?php endwhile; ?>

    </div>


</div>







</body>
</html>