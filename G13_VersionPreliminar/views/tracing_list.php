<!-- User's consult view -->

<?php
class TracingList
{
    private $data;

    function __construct($data1,$idUser)
    {
        $this->data1 = $data1;
        $this->idUser = $idUser;
        $this->render();
    }

    function render()
    {
?>
    <html lang="es">
        <?php
            include '../views/head.php';
            include '../languages/spanish.php';
            include '../functions/functions.php';
        ?>

        <title> <?php echo $strings['Consult user']; ?> </title>

        <body>
            <!-- Main body of the page -->
            <div id="body-container" class="container">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Menu -->
                        <?php generateNavbar($_SESSION['userType']); 

                            $titles = array('fecha', 'inicio', 'fin', 'completado','enlace');
                            generateViewTracingList($this->data1,$titles,$this->idUser);

                        ?>

                        <!-- End of the view -->
                    </div>
                </div>
            </div>
            <!-- End of the body -->

            <!-- Footer -->
            <?php include '../views/footer.php'; ?>
            <!-- End of the footer -->
        </body>
    </html>
<?php
    }
}
?>