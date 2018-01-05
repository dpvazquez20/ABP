<!-- User's default view -->

<?php
class StatisticDefault
{
    private $data;
    private $message;

    function __construct($data, $message, $list)
    {
        $this->data = $data;
        $this->message = $message;
        $this->list = $list;
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
        <title> <?php echo $strings['Statistics']; ?> </title>

        <body>
            <!-- Main body of the page -->
            <div id="body-container" class="container">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Menu -->
                        <?php generateNavbar($_SESSION['userType']); ?>
                        <!-- End of the menu -->

                        <!-- Order and search squares -->
                        <?php
                            if ($_SESSION['userType'] == $strings['coach'])
                            {
                        ?>
                                <div class="row" id="order_search">
                                    <?php
                                        $listOrder = array('Name A-Z', 'Name Z-A', 'Surnames A-Z', 'Surnames Z-A');
                                        generateOrderAndSearch($listOrder, 'statistics');
                                    ?>
                                </div>
                        <?php
                            }
                        ?>
                        <!-- End of the squares -->

                        <div class="row">
                            <!-- Operation message -->
                            <?php showMessage($this->message); ?>
                            <!-- End of the operation message -->

                            <div class="col-md-12">
                                <!-- View -->
                                <?php
                                if ($_SESSION['userType'] == $strings['secretary'])
                                {
                                    generateSecretaryStatistics($this->data);

                                } elseif ($_SESSION['userType'] == $strings['coach']) {

                                    generateCoachStatistics($this->data);

                                    // Display button
                                    echo '<div id="showSportsmen" style="text-align: center; margin-top: 1%">
                                                <button class="btn btn-lg btn-default">' . $strings['showSportsmen'] . '</button>
                                          </div>';

                                    $titles = array('imagen', 'login', 'nombre', 'apellidos',  'dni');
                                    generateViewStatisticsCoach($this->list, 'statistics', $titles);
                                }
                                ?>
                                <!-- End of the view -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of the body -->

            <!-- Footer -->
            <?php include  '../views/footer.php'; ?>
            <!-- End of the footer -->
        </body>
    </html>
<?php
    }
}
?>



