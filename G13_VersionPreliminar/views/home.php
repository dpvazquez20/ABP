<!-- Application's main page -->

<html lang="es">
    <?php
        include '../views/head.php';
        include '../languages/spanish.php';
        include '../functions/functions.php';
        session_start();
    ?>
    <title> <?php echo $strings['Home Page'] ?> </title>

    <body>
        <!-- Main body -->
        <div id="body-container" class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Menu -->
                    <?php
                        if (isset($_SESSION['userType'])){
                            generateNavbar($_SESSION['userType']);
                        }
                        else {
                            generateNavbar('unregistered');
                        }
                    ?>
                    <!-- End of the menu -->

                    <!-- Jumbotron -->
                    <div class="col-md-12">
                        <div class="jumbotron">
                            <h1> <?php echo $strings['ActiFit'] ?> </h1>
                            <h2> <?php echo $strings['Welcome'] ?> </h2>
                        </div>
                    </div>
                    <!-- End of the jumbotron -->
                </div>
            </div>
        </div>
        <!-- End of the main body -->
		
		<!-- Footer -->
        <?php include '../views/footer.php'; ?>
		<!-- End of the footer -->
    </body>
</html>