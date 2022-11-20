<!DOCTYPE html>
<html>

<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="inc/css/signuplogin.css">
</head>

<body>
    <div class="bg-modal2">

        <div class="modal-content">

            <div class="close2">
                +
            </div>
            <!--close-->

            <h1>LOGIN</h1>
            <form action="index.php" method="post">

                <label>YOUR EMAIL:</label>
                <input type="text" name="email" placeholder="  Email">
                <label>PASSWORD:</label>
                <input type="password" name="password" placeholder="  Password">


                <div class="log"><button name="log" id="log">LOG IN</button></div>
                <h5>Or else</h5>
                <div class="log-by">
                    <button class="log-fb clearfix" name="log-fb"><i class="fab fa-facebook-f"></i> FACEBOOK</button>
                    <button class="log-twitter clearfix" name="log-twitter"><i class="fab fa-twitter"></i>
                        TWITTER</button>
                </div>
                <div class="hint">
                    <input type="submit" name="fogottenpasword" value="Fogotten password">
                    <input type="submit" name="notamember" value="Not a member">
                </div>
                <!--hint-->

            </form>

        </div>
        <!--modal-content-->



    </div>
    <!--bg-modal-->

    <script type="text/javascript">
    document.getElementById('login').addEventListener('click', function() {
        document.querySelector('.bg-modal2').style.display = 'flex';
    });

    document.getElementById('loginresponsive').addEventListener('click', function() {
        document.querySelector('.bg-modal2').style.display = 'flex';
    });

    document.querySelector('.close2').addEventListener('click', function() {
        document.querySelector('.bg-modal2').style.display = 'none';
    });
    </script>

    </div>
    <!--login signup-->
</body>

</html>