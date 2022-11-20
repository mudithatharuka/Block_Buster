<!DOCTYPE html>
<html>

<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="inc/css/signuplogin.css">
</head>

<body>
    <div class="bg-modal">

        <div class="modal-content">

            <div class="close">
                +
            </div>
            <!--close-->

            <h1>SIGN UP</h1>
            <form action="index.php" method="post" enctype="multipart/form-data">
                <label>Name:</label>
                <input type="text" name="name" placeholder="  Name">
                <label>YOUR EMAIL:</label>
                <input type="text" name="email" placeholder="  Email">
                <label>PASSWORD:</label>
                <input type="text" name="password" placeholder="  Password">

                <label>PROFILE PHOTO:</label>
                <input type="file" name="profile_photo" accept="image/*">

                <div class="sign"><button name="sign" id="sign">SIGN UP</button></div>
            </form>

        </div>
        <!--modal-content-->


    </div>
    <!--bg-modal-->

    <script type="text/javascript">
    document.getElementById('signup').addEventListener('click', function() {
        document.querySelector('.bg-modal').style.display = 'flex';
    });

    document.getElementById('signupresponsive').addEventListener('click', function() {
        document.querySelector('.bg-modal').style.display = 'flex';
    });

    document.querySelector('.close').addEventListener('click', function() {
        document.querySelector('.bg-modal').style.display = 'none';
    });
    </script>
</body>

</html>