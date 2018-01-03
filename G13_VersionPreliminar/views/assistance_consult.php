<!-- Assistance consult view -->

<?php
class AssistanceConsult
{
    private $data;

    function __construct($data1,$reply)
    {
        $this->data1 = $data1;
        $this->message = $reply;
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
        <title> <?php echo $strings['Consult assistance']; ?> </title>

        <body>
            <!-- Main body of the page -->
            <div id="body-container" class="container">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Menu -->
                        <?php generateNavbar($_SESSION['userType']); ?>
                        <!-- End of the menu -->
                        <!-- Order and search squares -->
                        <div class="row" id="order_search">
                            <?php
                            $listOrder = array('Name A-Z', 'Name Z-A');
                            generateOrderAndSearch($listOrder, 'assistance');
                            ?>
                        </div>
                        <!-- End of the squares -->

                        <?php showMessage($this->message); ?>

                        <!-- End of the squares -->

                        <div class="col-md-12" id="def">

                            <?php
                            $titles = array('imagen', 'nombre', 'apellidos', 'dni');
                            generateAssistanceUsersList($this->data1,'assistance',$titles);
                            ?>
                        </div>


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
