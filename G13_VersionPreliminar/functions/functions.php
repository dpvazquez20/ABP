<?php

/** Function to generate automatically the navbar
*  Example => generateNavbar('Entrenador');
*/
function generateNavbar ($user_type)
{   
    include '../languages/spanish.php';

    // Array with the use's cases of each actor
    if (strcmp($user_type, 'Administrador') == 0)
    {
        $funcionalities = array('User');
    }

    if (strcmp($user_type, 'Secretario') == 0)
    {
        $funcionalities = array('Activity', 'Event', 'Inscription', 'Notification', 'Resource', 'Statistics', 'User');
    }

    if (strcmp($user_type, 'Entrenador') == 0)
    {
        $funcionalities = array('Assistance', 'Exercise', 'Notification', 'Table', 'Statistics', 'Tracing', 'Training', 'User');
    }

    if (strcmp($user_type, 'Deportista') == 0)
    {
        $funcionalities = array('Inscription', 'Statistics', 'Tracing');
    }

    if (strcmp($user_type, 'unregistered') == 0)
    {
        $funcionalities = array();
    }


    // Make the navbar
    echo    '<nav class="navbar navbar-default" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="../views/home.php"> <span class="glyphicon glyphicon-home" aria-hidden="true"></span> </a>';
    echo            '</div>

                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav">';

                        // Print buttons in the navbar
                        foreach ($funcionalities as $funcionality) 
                        {
                            $func = strtolower($funcionality);
                            echo '<li><a href="../controllers/' . $func . '_controller.php">' . $strings[$funcionality] . '</a></li>'; 
                        } 

    echo                '</ul>

                        <ul class="nav navbar-nav navbar-right">';

                        if (isset($_SESSION['userLogin']))
                        {
                            $word = $_SESSION['userLogin'];
                            echo '<li><a href="../controllers/profile_controller.php"> ' . $word .  ' <span class="glyphicon glyphicon-user" aria-hidden="true" id="offButton"></span> </a></li>';
                        }
                        else
                        {
                            /*if(isset($_SESSION['show']))
                            {
                                $word = $_SESSION['userLogin'];
                                echo '<li><a href="../controllers/profile_controller.php"> ' . $word .  ' <span class="glyphicon glyphicon-user" aria-hidden="true" id="offButton"></span> </a></li>';
                            }
                            else
                            {*/
                                $word = $strings['log in'];
                                echo '<li><a href="../views/index.php?redirect=true"> ' . $word .  ' <span class="glyphicon glyphicon-log-in" aria-hidden="true" id="offButton"></span></a></li>';
                            //}
                        }

    echo                    '<li><a href="../functions/logout_functions.php"> <span class="glyphicon glyphicon-off" aria-hidden="true" id="offButton"></span> </a></li>
                        </ul>
                    </div>
                </div>
            </nav>';
}




/** Function to automatically generate the order and search squares
*  Example => generateOrderAndSearch($listOrder, 'user');
*/
function generateOrderAndSearch ($listOrder, $page_name)
{
    include '../languages/spanish.php';

    $name = strtolower($page_name);
    $cont = 1;

    //echo '<div class="col-md-12" id="order_search">';
	// Order by...
	echo    '<div class="col-md-5 col-md-offset-1">';
	echo        '<form class="form-horizontal" action="'. $name . '_controller.php?action=' . $strings['Order'] . '" method="post">';
	echo            '<div class="form-group">';
	echo        	    '<label for="order" class="col-md-2 control-label">' . $strings['Order'] . '</label>';
    echo                '<div class="col-md-10">';
    echo                    '<select class="selectpicker form-control" name="orderfield" id="order" onchange="this.form.submit()">
                                <option data-hidden="true">' . $strings['Nothing selected'] . '</option>';

                                // Print the order by options
                                for ($i = 0; $i < count($listOrder); $i++)
                                {
                                    echo '<option value="' . $cont . '">' . $strings[$listOrder[$i]] . '</option>';
                                    $cont++;
                                }
    echo                     '</select>
                        </div>
                    </div>
                </form>
            </div>';
    //End order by

    // Search square
    echo    '<div class="col-md-5 col-md-offset-1">';
    echo        '<form class="form-inline" action="' . $name . '_controller.php" method="post">';
    echo           '<div class="form-group">';
    echo                '<input type="text" class="form-control" name="searchfield" placeholder="' . $strings['Search'] . '">';
    echo           '</div>';
    echo           '<button type="submit" name="action" value="' . $strings['Search'] . '" id="search" class="btn btn-md btn-default"> <span class="glyphicon glyphicon-search" aria-hidden="true" id="searchButton"></span> </button>';
    echo        '</form>
            </div>';
    // End of the square
    //</div>
}




/** Function to automatically generate a list of elements
*  Example => generateList($lista_usuarios, 'user', $titles);
*/
function generateList ($list, $page_name, $titles)
{
    include '../languages/spanish.php';

    $name = strtolower($page_name);

    // Select the images directory
    if ($page_name == 'user')
    {
        $directory = '../images/profiles/';

    } else {
        $directory = '../images/exercises/';
    }

    // Print the table if data aren't a string
    if (!is_string($list))
    {
        // Table
        echo '<div class="table-responsive">
                <table class="table table-hover">';

        // Attribute's titles
        echo '<thead>
                            <tr>';

        foreach ($titles as $title)
        {
            echo '<th>' . $strings[$title] . '</th>';
        }

        echo     '</tr>
                        </thead>';

        // Attribute's values
        echo '<tbody>';

        for ($i = 0; $i < count($list); $i++)
        {
            echo '<tr>';

            for ($j = 0; $j < count($titles); $j++)
            {
                // Check if the attribute is an image
                if ($titles[$j] == 'imagen')
                {
                    if ($list[$i]["$titles[$j]"] <> '')
                    {
                        echo '<td> <img src="' . $directory . $list[$i]["$titles[$j]"] . '" alt="' . $list[$i]["$titles[$j]"] . '" height="150" width="150"> </td>';

                    } else {
                        echo '<td> <img src="' . $directory . 'default.png" alt="default.png" height="150" width="150"> </td>';
                    }

                } else {
                    echo '<td>' . $list[$i]["$titles[$j]"] . '</td>';
                }
            }

            // Print the buttons for each element
            echo '<td>
                                <div class="pull-right action-buttons">';

            echo        '<a href="' . $name . '_controller.php?id=' . $list[$i]['id'] . '&action=' . $strings['See'] . '" class="btn btn-sm btn-info"> <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> </a>';
            echo        '&nbsp';
            echo        "<button class='btn btn-sm btn-danger' onclick=delete_elem('" . $name . "'," . $list[$i]['id'] . ")> <span class='glyphicon glyphicon-trash' aria-hidden='true'></span> </button>";
            echo    '&nbsp';
            echo    '<a href="' . $name . '_controller.php?id=' . $list[$i]['id'] . '&action=' . $strings['Modify'] . '" class="btn btn-sm btn-primary"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> </a>';

            echo    '</div>
                             </td>';
            echo '</tr>';
        }

        echo '</tbody>
                </table>
             </div>';
    }
}




/** Function to automatically generate the view of something
*  Example => generateView($user_data, 'user', $titles);
*/
function generateView ($list, $page_name, $titles)
{
    include '../languages/spanish.php';

    $name = strtolower($page_name);

    // Select the images directory
    if ($page_name == 'user')
    {
        $directory = '../images/profiles/';

    } else {
        $directory = '../images/exercises/';
    }

    // Print the table if the data aren't a string
    if (!is_string($list))
    {
        // Title
        echo    '<br>';
        echo    '<h2 id="headname">' . $strings['Consult '. $name] . '</h2>';

        // Table
        echo    '<div class="table-responsive">
                    <table class="table table-hover">';

        // Attribute's titles
        echo            '<thead>
                             <tr>';

                        foreach ($titles as $title)
                        {
                            echo '<th>' . $strings[$title] . '</th>';
                        }

        echo                '</tr>
                         </thead>';

        // Attribute's values
        echo            '<tbody>
                            </tr>';

                        for ($j = 0; $j < count($titles); $j++)
                        {
                            // Check if the attribute is an image
                            if ($titles[$j] == 'imagen')
                            {
                                if ($list[0]["$titles[$j]"] <> '')
                                {
                                    echo '<td> <img src="' . $directory . $list[0]["$titles[$j]"] . '" alt="' . $list[0]["$titles[$j]"] . '" height="150" width="150"> </td>';

                                } else {
                                    echo '<td> <img src="' . $directory . 'default.png" alt="default.png" height="150" width="150"> </td>';
                                }

                            } else {
                                echo '<td>' . $list[0]["$titles[$j]"] . '</td>';
                            }

                        }

        echo                '</tr>
                        </tbody>

                    </table>
                </div>';


        // Modify and Delete buttons
        echo    '<div class="col-md-12" id="single-buttons">';
        echo        "<button class='btn btn-md btn-danger' onclick=delete_elem('" . $name . "'," . $list[0]['id'] . ")> <span class='glyphicon glyphicon-trash' aria-hidden='true'></span> </button>";
        echo        '&nbsp';
        echo       '<a href="' . $name . '_controller.php?id=' . $list[0]['id'] . '&action=' . $strings['Modify'] . '" class="btn btn-md btn-primary"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> </a>';
        echo    '</div>';
    }
}




/** Function for showing a message when you complete an operation
*  Example => showMessage($this->message);
*/
function showMessage ($message)
{
    include '../languages/spanish.php';

    if ($message <> '')
    {
        // Print an alert success message if 'success' appears in the message
        if (strpos($message, $strings['success']))
        {
            echo    '<div class="col-md-12" id="operation-message">
                        <div class="alert alert-success alert-dismissable" id="messageAlert">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
            echo            '<strong>' . $strings['Ok'] . '!</strong>&nbsp' . $message;
            echo        '</div>
                    </div>';
        }
        // Print an info danger message if 'success' doesn't appear in the message and if $strings['UpdateNoModify'] appear
        else {
            if($message == $strings['UpdateNoModify'])
            {
                echo    '<div class="col-md-12" id="operation-message">
                        <div class="alert alert-info alert-dismissable" id="messageAlert">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                echo            '<strong>' . $strings['Info'] . '!</strong>&nbsp' . $message;
                echo        '</div>
                    </div>';
                // Print an alert danger message if 'success' and '$strings['UpdateNoModify']' doesn't appear in the message
            } else {
                echo    '<div class="col-md-12" id="operation-message">
                        <div class="alert alert-danger alert-dismissable" id="messageAlert">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                echo            '<strong>' . $strings['Failure'] . '!</strong>&nbsp' . $message;
                echo        '</div>
                    </div>';
            }
        }
    }
}




/** Function to automatically generate a <select>
*  Example => generateSelect ($this->data, 'nombre', 'Recurso');
*/
function generateSelect ($list, $col, $labelName)
{
    include '../languages/spanish.php';

    // $list is the exercise list, $col is the column name in the DB, $labelName is the field name in the form
    echo '<div class="form-group">';
    echo    '<label for="idChild"class="col-md-2 control-label">' . $labelName . '</label>';
    echo        '<div class="col-md-10">
                    <select class="selectpicker form-control" name="idChild" id="idChild" required>';
    echo            '<option data-hidden="true">' . $strings['Nothing selected'] . '</option>';

                    // Print options
                    for ($i = 0; $i < count($list); $i++)
                    {
                        echo '<option value="' . $list[$i]['id'] . '">' . $list[$i][$col]. '</option>';
                    }

    echo            '</select>';
    echo        '</div>';
    echo '</div>';
}




/** Function to automatically generate a <select>
 *  Example => generateSelect ($this->data, 'nombre', 'Recurso');
 */
function generateSelect2 ($list, $col, $labelName)
{
    include '../languages/spanish.php';

    // $list is the exercise list, $col is the column name in the DB, $labelName is the field name in the form
    echo '<div class="form-group">';
    echo    '<label for="idChild"class="col-md-2 control-label">' . $labelName . '*</label>';
    echo        '<div class="col-md-10">
                    <select class="selectpicker form-control" name="'. $labelName .'" id="' . $labelName . '" required>';

                    // Print options
                    for ($i = 0; $i < count($list); $i++)
                    {
                        echo '<option value="' . $list[$i]['id'] . '">' . $list[$i][$col]. '</option>';
                    }

    echo            '</select>';
    echo        '</div>';
    echo '</div>';
}




/** Function to automatically generate a <select>
 *  Example => generateSelect ($this->data, 'nombre', 'Recurso', $default_field);
 */
function generateSelect3 ($list, $col, $labelName,$default)
{
    include '../languages/spanish.php';

    echo '<div class="form-group">';
    echo    '<label for="idChild"class="col-md-2 control-label">' . $labelName . '*</label>';
    echo        '<div class="col-md-10">
                    <select class="selectpicker form-control" name="'. $labelName .'" id="' . $labelName . '" required>';

                    // Print options
                    for ($i = 0; $i < count($list); $i++)
                    {
                        if($default == $list[$i]['id']){

                            echo '<option value="' . $list[$i]['id'] . '" selected>' . $list[$i][$col]. ' </option>';
                        }else{
                            echo '<option value="' . $list[$i]['id'] . '">' . $list[$i][$col]. '</option>';
                        }
                    }

    echo            '</select>';
    echo        '</div>';
    echo '</div>';
}

/** Function to automatically generate a <select> for training tables
 *  Example => generateSelect ($this->data, 'nombre', 'Recurso');
 */
function generateSelect4 ($list, $col, $labelName)
{
    include '../languages/spanish.php';

    // $list is the exercise list, $col is the column name in the DB, $labelName is the field name in the form
    echo '<div class="form-group">';
    echo    '<label for="idChild"class="col-md-2 control-label">Tabla*</label>';
    echo        '<div class="col-md-10">
                    <select class="selectpicker form-control" name="'. $labelName .'" id="' . $labelName . '" required>';

                    // Print options
                    for ($i = 0; $i < count($list); $i++)
                    {
                        echo '<option value="' . $list[$i]['id'] . '">' . $list[$i][$col]. '</option>';
                    }

    echo            '</select>';
    echo        '</div>';
    echo '</div>';
}


/** Function to automatically generate a list of elements
 *  Example => generateList($lista_usuarios, 'user', $titles, $idTabla);
 */
function generateList2 ($list, $page_name, $titles, $idTabla)
{
    include '../languages/spanish.php';

    $name = strtolower($page_name); 

    if (!is_string($list))
    {
        // Table
        echo '<div class="table-responsive" style="margin-top:18%;">
                <table class="table table-hover">';

                    // Attribute's titles
                    echo '<thead>
                            <tr>';

                    foreach ($titles as $title)
                    {
                        echo '<th>' . $strings[$title] . '</th>';
                    }

                    echo     '</tr>
                        </thead>';

                    // Attribute's values
                    echo '<tbody>';

                    for ($i = 0; $i < count($list); $i++)
                    {
                        echo '<tr>';
                        
                        for ($j = 0; $j < count($titles); $j++)
                        {
                            // Check if the attribute is an image
                            if ($titles[$j] == 'imagen')
                            {
                                echo '<td> <img src="../images/exercises/' . $list[$i]["$titles[$j]"] . '" alt="' . $list[$i]["$titles[$j]"] . '" height="150" width="150"> </td>';

                            } else {
                                if ($titles[$j] == 'descanso')
                                {
                                     echo '<td>' . $list[$i]["$titles[$j]"] . '</td>';

                                } else {
                                    echo '<td>' . $list[$i]["$titles[$j]"] . '</td>';
                                }
                            }
                            //echo '<td>' . $list[$i]["$titles[$j]"] . '</td>';
                        }
                        
                        // Print the buttons for each element
                        echo '<td>
                                <div class="pull-right action-buttons">';

                        echo        "<button class='btn btn-sm btn-danger' onclick=delete_elem2('" . $page_name . "'," . $list[$i]['id'] . "," . $idTabla . ")> <span class='glyphicon glyphicon-trash' aria-hidden='true'></span> </button>";
                        echo        '&nbsp';
                        echo        '<a href="' . $name . '_controller.php?id=' . $list[$i]['id'] . '&action=' . $strings['Modify'] . '" class="btn btn-sm btn-primary"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> </a>';

                        echo    '</div>
                             </td>

                            </tr>';
                        echo '</tr>';
                    }

                    echo '</tbody>

                </table>
             </div>';
    }                     
}




/**
 * @param $data
 */
function getIdTabla($data)
{
    echo $data[0]['id'];
}

function getIdEntrenamiento($data)
{
    echo $data[0]['id'];
}


/** Function to automatically generate a list of elements (list-group)
 *  Example => generateListGroup($user_list, 'user', $titles, true, $strings['Insert'], $strings['See']);
 */
function generateListGroup ($list, $page_name, $titles, $make_form, $action_checkBox, $action_href)
{
    include '../languages/spanish.php';

    $name = strtolower($page_name);

    // Print the list if data aren't a string
    if (!is_string($list))
    {
        // List-group
        echo '<div class="list-group">';

        // If $make_form is false, a normal list will be printed
        if ($make_form == false)
        {
            // If the management is 'Inscriptions'
            if ($page_name == 'inscription')
            {
                for ($i = 0; $i < count($list); $i++)
                {
                    echo '<a class="list-group-item">';
                    $text = '';

                    for ($j = 0; $j < count($titles); $j++)
                    {
                        $text = $text . ' ' .  $list[$i]["$titles[$j]"];
                    }

                    echo    '<strong>'. $text . '</strong>';

                    echo    '<div class="pull-right action-buttons">';

                    echo        "<button class='btn btn-sm btn-danger' onclick=delete_elem('" . $name . "'," . $list[$i]['id'] . ")> <span class='glyphicon glyphicon-trash' aria-hidden='true'></span> </button>";

                    echo    '</div>
                         </a>';
                }

            } else {
                for ($i = 0; $i < count($list); $i++)
                {
                    echo '<a href="../controllers/' . $name . '_controller.php?id=' . $list[$i]['id'] . '&action=' . $action_href . '" class="list-group-item">';
                    $text = '';

                    for ($j = 0; $j < count($titles); $j++)
                    {
                        $text = $text . ' ' .  $list[$i]["$titles[$j]"];
                    }

                    echo    '<strong>'. $text . '</strong>';
                    echo '</a>';
                }
            }

            // If not, a list with checboxes will be printed
        } else {
            for ($i = 0; $i < count($list); $i++)
            {
                echo '<a class="list-group-item">';
                $text = '';

                for ($j = 0; $j < count($titles); $j++)
                {
                    $text = $text . ' ' .  $list[$i]["$titles[$j]"];
                }

                // Print the checkbox
                echo    '<form class="form-horizontal" action="../controllers/' . $name . '_controller.php?id=' . $list[$i]['id'] . '&action=' . $action_checkBox . '" method="post">
                            <div class="form-group">
                                <div class="checkbox">';

                echo                '<label> <strong>' . $text . '</strong> </label> 
                                     <div class="pull-right action-buttons">
                                        <input type="checkbox" name="checkvalue" id="checkButton" value="1" onchange="this.form.submit()">
                                     </div>';

                echo            '</div>
                            </div>    
                        </form>';

                echo '</a>';

            }
        }

        echo '</div>';


    }
}




/** Function to automatically generate a list of elements (table) in the tracing (for the sportsman)
 *  Example => generateViewTracingSportsman($list, 'tracing', $titles, $strings['See']);
 */
function generateViewTracingSportsman ($list, $page_name, $titles, $action_checkBox)
{
    include '../languages/spanish.php';

    $name = strtolower($page_name);
    $num = 0;

    // Select the images directory
    $directory = '../images/exercises/';

    // Print the table if data aren't a string
    if (!is_string($list))
    {
        // Table
        echo '<div class="table-responsive">
                <table class="table table-bordered">';

        // Attribute's titles
        echo        '<thead>
                        <tr>';

        foreach ($titles as $title)
        {
            echo            '<th>' . $strings[$title] . '</th>';
        }

        echo            '</tr>
                    </thead>';

        // Attribute's values
        echo        '<tbody>';

        for ($i = 0; $i < count($list); $i++)
        {
            echo        '<tr>';

            for ($j = 0; $j < count($titles); $j++)
            {
                // Check if the attribute is an image
                if ($titles[$j] == 'imagen')
                {
                    echo    '<td> <img src="' . $directory . $list[$i]["$titles[$j]"] . '" alt="' . $list[$i]["$titles[$j]"] . '" height="150" width="150"> </td>';

                } else {
                    // If this exercise is complete, print it
                    if ($titles[$j] == 'completado')
                    {
                        if ($list[$i]['completado'] == 1)
                        {
                            echo $strings['Complete'];
                            //echo    '<td>' . $list[$i]["$titles[$j]"] . '</td>';
                            $num = 1;
                        }

                    }  else {
                        echo    '<td>' . $list[$i]["$titles[$j]"] . '</td>';
                    }
                }
            }
            //echo '<td>' . $list[$i]["$titles[$j]"] . '</td>';


            // Print the checkbox if the exercise isn't complete
            if ($num == 0)
            {
                echo            '<td>';

                echo                '<form class="form-horizontal" action="../controllers/' . $name . '_controller.php?id=' . $list[$i]['id'] . '&action=' . $action_checkBox . '" method="post">
                                        <div class="form-group">
                                            <div class="checkbox">';

                echo                           '<div class="pull-right action-buttons">
                                                    <input type="checkbox" name="checkvalue" id="checkButton" value="1" onchange="this.form.submit()">
                                                </div>';

                echo                        '</div>
                                        </div>    
                                    </form>';

                echo            '</td>';
            }
            echo        '</tr>';
        }

        echo        '</tbody>
                </table>
             </div>';


    }
}




/** Function to automatically generate a list of elements (table) in the tracing (for the coach)
 *  Example => generateView3($list, 'tracing', $titles);
 */
function generateViewTracingCoach ($list, $page_name, $titles)
{
    include '../languages/spanish.php';

    $name = strtolower($page_name);


    // Select the images directory
    $directory = '../images/exercises/';

    // Print the table if data aren't a string
    if (!is_string($list))
    {
        // Table
        echo '<div class="table-responsive">
                <table class="table table-bordered">';

        // Attribute's titles
        echo        '<thead>
                        <tr>';

        foreach ($titles as $title)
        {
            echo            '<th>' . $strings[$title] . '</th>';
        }

        echo            '</tr>
                    </thead>';

        // Attribute's values
        echo        '<tbody>';

        for ($i = 0; $i < count($list); $i++)
        {
            echo        '<tr>';

            for ($j = 0; $j < count($titles); $j++)
            {
                // Check if the attribute is an image
                if ($titles[$j] == 'imagen')
                {
                    echo    '<td> <img src="' . $directory . $list[$i]["$titles[$j]"] . '" alt="' . $list[$i]["$titles[$j]"] . '" height="150" width="150"> </td>';

                } else {
                    if ($titles[$j] == 'completado')
                    {
                        if ($list[$i]['completado'] == 1)
                        {
                            echo $strings['Complete'];
                            //echo    '<td>' . $list[$i]["$titles[$j]"] . '</td>';

                        } else {
                            echo $strings['No complete'];
                        }

                    }  else {
                        echo    '<td>' . $list[$i]["$titles[$j]"] . '</td>';
                    }
                }
            }
            //echo '<td>' . $list[$i]["$titles[$j]"] . '</td>';

            echo        '</tr>';
        }

        echo        '</tbody>
                </table>
             </div>';

    }
}


/** Function to automatically generate a list of elements for assigning training to users
 *  Example => generateListCoach($lista_usuarios, 'training', $titles);
 */
function generateListCoach ($list, $page_name, $titles)
{
    include '../languages/spanish.php';

    $name = strtolower($page_name);

    // Select the images directory
    $directory = '../images/profiles/';


    // Print the table if data aren't a string
    if (!is_string($list))
    {
        // Table
        echo '<div class="table-responsive">
                <table class="table table-hover">';

        // Attribute's titles
        echo '<thead>
                            <tr>';

        foreach ($titles as $title)
        {
            echo '<th>' . $strings[$title] . '</th>';
        }

        echo     '</tr>
                        </thead>';

        // Attribute's values
        echo '<tbody>';

        for ($i = 0; $i < count($list); $i++)
        {
            echo '<tr>';

            for ($j = 0; $j < count($titles); $j++)
            {
                // Check if the attribute is an image
                if ($titles[$j] == 'imagen')
                {
                    if ($list[$i]["$titles[$j]"] <> '')
                    {
                        echo '<td> <img src="' . $directory . $list[$i]["$titles[$j]"] . '" alt="' . $list[$i]["$titles[$j]"] . '" height="150" width="150"> </td>';

                    } else {
                        echo '<td> <img src="' . $directory . 'default.png" alt="default.png" height="150" width="150"> </td>';
                    }

                } else {
                    echo '<td>' . $list[$i]["$titles[$j]"] . '</td>';
                }
            }

            // Print the buttons for each element
            echo        '<td>
                            <div class="pull-right action-buttons">';

            echo                '<a id="assignButton" href="' . $name . '_controller.php?user_id=' . $list[$i]['id'] . '&action=' . $strings['Assign'] . '" class="btn btn-md btn-default">' . $strings['Assign'] . '  <span class="glyphicon glyphicon-scale" aria-hidden="true"></span> </a>';

            echo            '</div>
                         </td>';
            echo '</tr>';
        }

        echo '</tbody>
                </table>
             </div>';
    }
}




/** Function to automatically generate the profile view
 *  Example => generateProfile($user_data, $titles);
 */
function generateProfile ($list, $titles)
{
    include '../languages/spanish.php';

    // Select the images directory
    $directory = '../images/profiles/';

    // Print the table if the data aren't a string
    if (!is_string($list))
    {
        echo '<div class="row">
                <div class="col-md-12" style="margin-top: 3%; text-align: center;">';

            for ($j = 0; $j < count($titles); $j++)
            {
                // Check if the attribute is an image
                if ($titles[$j] == 'imagen')
                {
                    if ($list[0]["$titles[$j]"] <> '')
                    {
                        echo '<img src="' . $directory . $list[0]["$titles[$j]"] . '" alt="' . $list[0]["$titles[$j]"] . '" height="150" width="150"><br><br>';

                    } else {
                        echo '<img src="' . $directory . 'default.png" alt="default.png" height="150" width="150"><br><br>';
                    }

                } else {
                    echo '<br><strong>' . $strings[$titles[$j]] . ':</strong>&nbsp&nbsp' . $list[0]["$titles[$j]"] . '<br>';
                }
            }
        echo    '</div>
             </div>';

            // Modify button
            echo    '<div class="col-md-12" id="single-buttons">';
            echo       '<button class="btn btn-md btn-primary" id="modifyEP"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> </button>';
            echo    '</div>';
    }
}

function generateListCoach2 ($list, $page_name, $titles)
{
    include '../languages/spanish.php';

    $name = strtolower($page_name);

    // Select the images directory
    $directory = '../images/profiles/';


    // Print the table if data aren't a string
    if (!is_string($list))
    {
        // Table
        echo '<div class="table-responsive">
                <table class="table table-hover">';

        // Attribute's titles
        echo '<thead>
                            <tr>';

        foreach ($titles as $title)
        {
            echo '<th>' . $strings[$title] . '</th>';
        }

        echo     '</tr>
                        </thead>';

        // Attribute's values
        echo '<tbody>';

        for ($i = 0; $i < count($list); $i++)
        {
            echo '<tr>';

            for ($j = 0; $j < count($titles); $j++)
            {
                // Check if the attribute is an image
                if ($titles[$j] == 'imagen')
                {
                    if ($list[$i]["$titles[$j]"] <> '')
                    {
                        echo '<td> <img src="' . $directory . $list[$i]["$titles[$j]"] . '" alt="' . $list[$i]["$titles[$j]"] . '" height="150" width="150"> </td>';

                    } else {
                        echo '<td> <img src="' . $directory . 'default.png" alt="default.png" height="150" width="150"> </td>';
                    }

                } else {
                    echo '<td>' . $list[$i]["$titles[$j]"] . '</td>';
                }
            }

            // Print the buttons for each element
            echo        '<td>
                            <div class="pull-right action-buttons">';

            //echo                '<a href="' . $name . '_controller.php?id=' . $list[$i]['id'] . '&action=' . $strings['Follow'] . '" class="btn btn-md btn-primary">' . $strings['Follow'] . '  <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> </a>';
            echo                '<a href="' . $name . '_controller.php?id=' . $list[$i]['id'] . '&action=' . $strings['List'] . '" class="btn btn-md btn-primary">' . $strings['Follow'] . '  <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> </a>';

            echo            '</div>
                         </td>';
            echo '</tr>';
        }

        echo '</tbody>
                </table>
             </div>';
    }
}

function generateViewTracingCoach2 ($list, $page_name, $titles)
{
    include '../languages/spanish.php';

    $name = strtolower($page_name);


    // Select the images directory
    $directory = '../images/exercises/';

    // Print the table if data aren't a string
    if (!is_string($list))
    {
        // Table
        echo '<div class="table-responsive">
                <table class="table table-bordered">';

        // Attribute's titles
        echo        '<thead>
                        <tr>';

        foreach ($titles as $title)
        {
            echo            '<th>' . $strings[$title] . '</th>';
        }

        echo            '</tr>
                    </thead>';

        // Attribute's values
        echo        '<tbody>';

        for ($i = 0; $i < count($list); $i++)
        {
            echo        '<tr>';

            for ($j = 0; $j < count($titles); $j++)
            {
                // Check if the attribute is an image
                if ($titles[$j] == 'imagen')
                {
                    echo    '<td> <img src="' . $directory . $list[$i]["$titles[$j]"] . '" alt="' . $list[$i]["$titles[$j]"] . '" height="150" width="150"> </td>';
                } else {
                    if ($titles[$j] == 'completado')
                    {
                        if ($list[$i]['completado'] == 1)
                        {
                            //echo '<td>' . $strings['Complete'] . '</td>';
                            //echo '<td> <span class="glyphicon glyphicon-ok-circle text-success"></span> </td>';
                            echo '<td> <span class="glyphicon glyphicon-ok-circle" style="color:#32CD32; font-size: 20px"></span> </td>';

                        } else {
                            //echo '<td>' . $strings['No complete'] . '</td>';
                            echo '<td> <span class="glyphicon glyphicon-ban-circle" style="color:#708090; font-size: 20px"></span> </td>';
                        }

                    }  else {
                        echo    '<td>' . $list[$i]["$titles[$j]"] . '</td>';
                    }
                }
            }
            //echo '<td>' . $list[$i]["$titles[$j]"] . '</td>';

            echo        '</tr>';
        }

        echo        '</tbody>
                </table>
             </div>';

    }
}


function generateViewTracingSportsman2 ($list, $page_name, $titles, $action_checkBox)
{
    include '../languages/spanish.php';

    $name = strtolower($page_name);
    $num = 0;

    // Select the images directory
    $directory = '../images/exercises/';

    // Print the table if data aren't a string
    if (!is_string($list))
    {
        // Table
        echo '<div class="table-responsive">
                <table class="table table-bordered">';

        // Attribute's titles
        echo        '<thead>
                        <tr>';

        foreach ($titles as $title)
        {
            echo            '<th>' . $strings[$title] . '</th>';
        }

        echo            '</tr>
                    </thead>';

        // Attribute's values
        echo        '<tbody>';

        for ($i = 0; $i < count($list); $i++)
        {
            echo        '<tr>';

            for ($j = 0; $j < count($titles); $j++)
            {
                $num = 0;
                // Check if the attribute is an image
                if ($titles[$j] == 'imagen')
                {
                    echo    '<td> <img src="' . $directory . $list[$i]["$titles[$j]"] . '" alt="' . $list[$i]["$titles[$j]"] . '" height="150" width="150"> </td>';

                } else {
                    // If this exercise is complete, print it
                    if ($titles[$j] == 'completado')
                    {
                        if ($list[$i]['completado'] == 1)
                        {
                            //echo '<td> <span class="glyphicon glyphicon-ok-circle" style="color:#32CD32; font-size: 20px"></span> </td>';   
                            //echo    '<td>' . $list[$i]["$titles[$j]"] . '</td>';
                            $num = 1;
                        }

                    }  else {
                        if($titles[$j] <> 'lineaSesionesId')
                        {
                            echo    '<td>' . $list[$i]["$titles[$j]"] . '</td>';
                        }
                    }
                }
            }
            //echo '<td>' . $list[$i]["$titles[$j]"] . '</td>';


            // Print the checkbox if the exercise isn't complete
            if ($num == 0)
            {
                echo            '<td>';

                echo                '<form class="form-horizontal" action="../controllers/' . $name . '_controller.php?id=' . $list[$i]['id'] . '&lineaSesionesId=' . $list[$i]['lineaSesionesId'] . '&action=' . $action_checkBox . '" method="post">
                                        <div class="form-group">
                                            <div class="checkbox">';

                echo                           '<div class="pull-right action-buttons">
                                                    <input type="checkbox" name="checkvalue" id="checkButton" value="1" onchange="this.form.submit()">
                                                </div>';

                echo                        '</div>
                                        </div>    
                                    </form>';

                echo            '</td>';
            }else{
                echo            '<td>';

                echo                '<form class="form-horizontal" action="../controllers/' . $name . '_controller.php?id=' . $list[$i]['id'] . '&lineaSesionesId=' . $list[$i]['lineaSesionesId'] . '&action=' . $action_checkBox . '" method="post">
                                        <div class="form-group">
                                            <div class="checkbox">';

                echo                           '<div class="pull-right action-buttons">
                                                    <input type="checkbox" name="checkvalue" id="checkButton" value="0" onchange="this.form.submit()" checked>
                                                </div>';

                echo                        '</div>
                                        </div>    
                                    </form>';

                echo            '</td>';
            }
            echo        '</tr>';
        }

        echo        '</tbody>
                </table>
             </div>';


    }
}

function generateViewTracingTitle($list,$coach)
{
    include '../languages/spanish.php';

    if($coach)
    {
        echo "<p style='font-size: medium; font-style: normal;'><b>" . $strings['Name'] . ":</b> " . $list[0]['nombre'] . " " . $list[0]['apellidos'] . "</p>";
    }
    
    if($list[0]['completado'] == '0')
    {
        echo "<p style='font-size: medium; font-style: normal;'><b>" . $strings['State'] . ":</b> " . $strings['No complete2'] . "</p>";
    }else{
         echo "<p style='font-size: medium; font-style: normal;'><b>".  $strings['State'] . ":</b> " . $strings['Complete2'] . "</p>";
    }
}

function generateListTrainingTables ($list, $page_name, $titles, $training)
{
    include '../languages/spanish.php';

    $name = strtolower($page_name);

    // Select the images directory
    if ($page_name == 'user')
    {
        $directory = '../images/profiles/';

    } else {
        $directory = '../images/exercises/';
    }

    // Print the table if data aren't a string
    if (!is_string($list))
    {
        // Table
        echo '<div class="table-responsive">
                <table class="table table-hover">';

        // Attribute's titles
        echo '<thead>
                            <tr>';

        foreach ($titles as $title)
        {
            echo '<th>' . $strings[$title] . '</th>';
        }

        echo     '</tr>
                        </thead>';

        // Attribute's values
        echo '<tbody>';

        for ($i = 0; $i < count($list); $i++)
        {
            echo '<tr>';

            for ($j = 0; $j < count($titles); $j++)
            {
                // Check if the attribute is an image
                if ($titles[$j] == 'imagen')
                {
                    if ($list[$i]["$titles[$j]"] <> '')
                    {
                        echo '<td> <img src="' . $directory . $list[$i]["$titles[$j]"] . '" alt="' . $list[$i]["$titles[$j]"] . '" height="150" width="150"> </td>';

                    } else {
                        echo '<td> <img src="' . $directory . 'default.png" alt="default.png" height="150" width="150"> </td>';
                    }

                } else {
                    echo '<td>' . $list[$i]["$titles[$j]"] . '</td>';
                }
            }

            // Print the buttons for each element
            echo '<td>
                                <div class="pull-right action-buttons">';

            echo        '<a href="' . $name . '_controller.php?id=' . $list[$i]['id'] . '&action=' . $strings['See'] . '" class="btn btn-sm btn-info"> <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> </a>';
            echo        '&nbsp';
			echo        '<a href="training_controller.php?id_entrenamiento=' . $training[0]['id'] .'&id=' . $list[$i]['id'] . '&action=' . $strings['DeleteTable'] . '" class="btn btn-sm btn-danger"> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> </a>';
            
            echo    '</div>
                             </td>';
            echo '</tr>';
        }

        echo '</tbody>
                </table>
             </div>';
    }
}

/** Function to automatically generate a list of elements
 *  Example => generateList($lista_usuarios, 'user', $titles);
 */
function generateAssistanceUsersList ($list, $page_name, $titles)
{
    include '../languages/spanish.php';

    $name = strtolower($page_name);

    // Select the images directory
    $directory = '../images/profiles/';


    // Print the table if data aren't a string
    if (!is_string($list))
    {
        // Table
        echo '<div class="table-responsive">
                <table class="table table-hover">';

        // Attribute's titles
        echo '<thead>
                            <tr>';

        foreach ($titles as $title)
        {
            echo '<th>' . $strings[$title] . '</th>';
        }

        echo     '</tr>
                        </thead>';

        // Attribute's values
        echo '<tbody>';

        for ($i = 0; $i < count($list); $i++)
        {
            echo '<tr>';

            for ($j = 0; $j < count($titles); $j++)
            {
                // Check if the attribute is an image
                if ($titles[$j] == 'imagen')
                {
                    if ($list[$i]["$titles[$j]"] <> '')
                    {
                        echo '<td> <img src="' . $directory . $list[$i]["$titles[$j]"] . '" alt="' . $list[$i]["$titles[$j]"] . '" height="150" width="150"> </td>';

                    } else {
                        echo '<td> <img src="' . $directory . 'default.png" alt="default.png" height="150" width="150"> </td>';
                    }

                } else {
                    echo '<td>' . $list[$i]["$titles[$j]"] . '</td>';
                }
            }


        }

        echo '</tbody>
                </table>
             </div>';
    }
}

/** Function to automatically generate a list of elements (list-group)
 *  Example => generateListGroup($user_list, 'user', $titles, true, $strings['Insert'], $strings['See']);
 */
function generateInscriptionList ($list, $page_name, $titles, $make_form, $action_checkBox, $action_href)
{
    include '../languages/spanish.php';

    $name = strtolower($page_name);

    // Print the list if data aren't a string
    if (!is_string($list))
    {
        // List-group
        echo '<div class="list-group">';

        // If $make_form is false, a normal list will be printed
        if ($make_form == false)
        {
            // If the management is 'Inscriptions'
            if ($page_name == 'inscription')
            {
                for ($i = 0; $i < count($list); $i++)
                {
                    echo '<a class="list-group-item">';
                    $text = '';

                    for ($j = 0; $j < count($titles); $j++)
                    {
                        $text = $text . ' - ' .  $list[$i]["$titles[$j]"];
                    }

                    echo    '<strong>'. $text . '</strong>';

                    echo    '<div class="pull-right action-buttons">';

                    echo        "<button class='btn btn-sm btn-danger' onclick=delete_elem('" . $name . "'," . $list[$i]['id'] . ")> <span class='glyphicon glyphicon-trash' aria-hidden='true'></span> </button>";

                    echo    '</div>
                         </a>';
                }

            } else {
                for ($i = 0; $i < count($list); $i++)
                {
                    echo '<a href="../controllers/' . $name . '_controller.php?id=' . $list[$i]['id'] . '&action=' . $action_href . '" class="list-group-item">';
                    $text = '';

                    for ($j = 0; $j < count($titles); $j++)
                    {
                        $text = $text . ' ' .  $list[$i]["$titles[$j]"];
                    }

                    echo    '<strong>'. $text . '</strong>';
                    echo '</a>';
                }
            }

            // If not, a list with checboxes will be printed
        } else {
            for ($i = 0; $i < count($list); $i++)
            {
                echo '<a class="list-group-item">';
                $text = '';

                for ($j = 0; $j < count($titles); $j++)
                {
                    $text = $text . ' - ' .  $list[$i]["$titles[$j]"];
                }

                // Print the checkbox
                echo    '<form class="form-horizontal" action="../controllers/' . $name . '_controller.php?id=' . $list[$i]['id'] . '&action=' . $action_checkBox . '" method="post">
                            <div class="form-group">
                                <div class="checkbox">';

                echo                '<label> <strong>' . $text . '</strong> </label> 
                                     <div class="pull-right action-buttons">
                                        <input type="checkbox" name="checkvalue" id="checkButton" value="1" onchange="this.form.submit()">
                                     </div>';

                echo            '</div>
                            </div>    
                        </form>';

                echo '</a>';

            }
        }

        echo '</div>';


    }
}

/** Function to automatically generate a <select>
 *  Example => generateSelect ($this->data, 'nombre', 'Recurso');
 */
function generateActivitiesSelect ($list, $col, $labelName,$idname,$pred)
{
    include '../languages/spanish.php';

    // $list is the exercise list, $col is the column name in the DB, $labelName is the field name in the form
    echo '<div class="form-group">';
    echo    '<label for="idChild"class="col-md-2 control-label">' . $labelName . '*</label>';
    echo        '<div class="col-md-10">
                    <select class="selectpicker form-control" name="'. $idname .'" id="' . $idname . '" required>';
    if($pred == ''){
        echo            '<option data-hidden="true">' . $strings['Nothing selected'] . '</option>';
    }else{
        echo            '<option data-hidden="true">' . $pred . '</option>';
    }

    // Print options
    for ($i = 0; $i < count($list); $i++)
    {
        echo '<option value="' . $list[$i]['id'] . '">' . $list[$i][$col]. '</option>';
    }

    echo            '</select>';
    echo        '</div>';
    echo '</div>';
}

/** Function to automatically generate a <select>
 *  Example => generateSelect ($this->data, 'nombre', 'Recurso');
 */
function generateActivitiesDisabledSelect ($list, $col, $labelName,$idname,$pred)
{
    include '../languages/spanish.php';

    // $list is the exercise list, $col is the column name in the DB, $labelName is the field name in the form
    echo '<div class="form-group">';
    echo    '<label for="idChild"class="col-md-2 control-label">' . $labelName . '*</label>';
    echo        '<div class="col-md-10">
                    <select class="selectpicker form-control" name="'. $idname .'" id="' . $idname . '" required disabled>';
    if($pred == ''){
        echo            '<option data-hidden="true">' . $strings['Nothing selected'] . '</option>';
    }else{
        echo            '<option data-hidden="true">' . $pred . '</option>';
    }

    // Print options
    for ($i = 0; $i < count($list); $i++)
    {
        echo '<option value="' . $list[$i]['id'] . '">' . $list[$i][$col]. '</option>';
    }

    echo            '</select>';
    echo        '</div>';
    echo '</div>';
}




/** Function to automatically generate the secretary's statistic
 *  Example => generateSecretaryStatistics ($this->data);
 */
function generateSecretaryStatistics($data)
{
    include '../languages/spanish.php';

    $activities = getActivitiesPerDays();       // Get the amount of activities per day
    $users = getUsersPerActivity();             // Get the amount of users per activity
    $users2 = getUsersPerActivity2();
    $result = mergeList($users,$users2);

    // View
    echo '<div class="row" style="margin-top: 1%">
            <!-- Showing activities per day -->
            <div class="col-md-4">
                <h3 style="text-align: center">' . $strings['days'] . '</h3>
                    <div class="list-group">
                        <a class="list-group-item">' . $strings['monday'] . '<span class="badge">' . $activities['monday'] . '</span></a>
                        <a class="list-group-item">' . $strings['tuesday'] . '<span class="badge">' . $activities['tuesday'] . '</span></a>
                        <a class="list-group-item">' . $strings['wednesday'] . '<span class="badge">' . $activities['wednesday'] . '</span></a>
                        <a class="list-group-item">' . $strings['thursday'] . '<span class="badge">' . $activities['thursday'] . '</span></a>
                        <a class="list-group-item">' . $strings['friday'] . '<span class="badge">' . $activities['friday'] . '</span></a>
                    </div>
            </div>
            <!-- End -->';
            
    echo    '<!-- Showing users per activity -->
            <div class="col-md-4">
                <h3 style="text-align: center">' . $strings['activitiesUsers'] . '</h3>
                    <div class="list-group">';

                    foreach ($result as $row)
                    {
                        echo '<a class="list-group-item">' . $row['nombre'] . '<span class="badge">' . $row['num'] . '</span></a>';
                    }

        echo        '</div> 
            </div>
            <!-- End -->
            
            <!-- Showing the amount of users -->
            <div class="col-md-4">
                <h3 style="text-align: center">' . $strings['amountUsers'] . $data['numUsers'] . '</h3>
                    <div class="list-group">
                        <a class="list-group-item">' . $strings['TDUUsers'] . '<span class="badge">' . $data['TDUUsers'] . '</span></a>
                        <a class="list-group-item">' . $strings['PEFUsers'] . '<span class="badge">' . $data['PEFUsers'] . '</span></a>
                    </div>           
            </div>
            <!--End -->
          </div>';
}




/** Function to get the amount of activities per day
 *  Example => $data = getActivitiesPerDays();
 */
function getActivitiesPerDays()
{
    include '../languages/spanish.php';

    $mysqli = connect();
    $sql = "SELECT * FROM actividades";

    // Checking the DB connection
    if (!$result = $mysqli->query($sql))
    {
        $toret = $strings['ConnectionDBError'];

    } else { //Obtaining the amount of activities per day
        $sql = "SELECT * FROM actividades WHERE frecuencia LIKE '%Lunes%'";
        $toret['monday'] = $mysqli->query($sql)->num_rows;

        $sql = "SELECT * FROM actividades WHERE frecuencia LIKE '%Martes%'";
        $toret['tuesday'] = $mysqli->query($sql)->num_rows;

        $sql = "SELECT * FROM actividades WHERE frecuencia LIKE '%Miercoles%'";
        $toret['wednesday'] = $mysqli->query($sql)->num_rows;

        $sql = "SELECT * FROM actividades WHERE frecuencia LIKE '%Jueves%'";
        $toret['thursday'] = $mysqli->query($sql)->num_rows;

        $sql = "SELECT * FROM actividades WHERE frecuencia LIKE '%Viernes%'";
        $toret['friday'] = $mysqli->query($sql)->num_rows;

        // I suppose that the coachs in charge of activities like, for example, Zumba, don't work at weekends
    }

    return $toret;
}




/** Function to get the amount of users per activities
 *  Example => $data = getUsersPerActivity();
 */
function getUsersPerActivity()
{
    include '../languages/spanish.php';

    $mysqli = connect();
    $sql = "SELECT * FROM inscripciones";

    // Checking the DB connection
    if (!$result = $mysqli->query($sql))
    {
        $toret = $strings['ConnectionDBError'];

    } else {

        $sql = "SELECT COUNT(inscripciones.usuario_id) AS num, actividades.nombre AS nombre 
                FROM inscripciones 
                INNER JOIN inscripciones_has_actividades ON inscripciones.id = inscripciones_has_actividades.inscripciones_id AND inscripciones.borrado ='0'
                INNER JOIN actividades ON inscripciones_has_actividades.actividades_id = actividades.id
                GROUP BY actividades.nombre
                ORDER BY actividades.nombre";

        $result = $mysqli->query($sql); // getting hard data

        $toret=[];
        $i=0;

        // introducing all rows into an array
        while ($row = $result->fetch_array())
        {
            $toret[$i] = $row;
            $i++;
        }
    }

    return $toret;
}




/** Function to get the amount of users per activities (activities that don't have users)
 *  Example => $data = getUsersPerActivity2();
 */
function getUsersPerActivity2()
{
    include '../languages/spanish.php';

    $mysqli = connect();
    $sql = "SELECT * FROM inscripciones";

    // Checking the DB connection
    if (!$result = $mysqli->query($sql))
    {
        $toret = $strings['ConnectionDBError'];

    } else {

        $sql = "SELECT nombre FROM actividades ORDER BY nombre";

        $result = $mysqli->query($sql); // getting hard data

        $toret=[];
        $i=0;

        // introducing all rows into an array
        while ($row = $result->fetch_array())
        {
            $toret[$i] = $row;
            $i++;
        }
    }

    return $toret;
}



/** Function to merge two arrays
 *  Example => $data = mergeList($array1,$array2);
 */
function mergeList($array1, $array2)
{
    $cont = 0;

    foreach ($array2 as $row2)
    {
        foreach ($array1 as $row1)
        {
            if ($row2['nombre'] == $row1['nombre'])
            {
                $cont = 1;
            }
        }

        if ($cont == 1)
        {
            $cont = 0;

        } else {

            $row2['num'] = 0;
            array_push($array1, $row2);
        }
    }

    return $array1;
}




/** Function to automatically generate the coach's statistics
 *  Example => generateCoachStatistics ($this->data);
 */
function generateCoachStatistics($data)
{
    include '../languages/spanish.php';

    $mExercises = getMostUsedExercise();

    // View
    echo '<div class="row" style="margin-top: 1%">
            <!-- Showing amount of exercises -->
            <div class="col-md-4">
                <h3 style="text-align: center">' . $strings['numExercises'] . $data['numExercises'] . '</h3>
                    <div class="list-group">
                        <a class="list-group-item">' . $strings['numMuscular'] . '<span class="badge">' . $data['numMuscular'] . '</span></a>
                        <a class="list-group-item">' . $strings['numCardio'] . '<span class="badge">' . $data['numCardio'] . '</span></a>
                        <a class="list-group-item">' . $strings['numStretching'] . '<span class="badge">' . $data['numStretching'] . '</span></a>
                    </div>
            </div>
            <!-- End -->';

    echo    '<!-- Showing the most used exercise -->
            <div class="col-md-4">
                <h3 style="text-align: center">' . $strings['mostUsedExercise'] . '</h3>
                    <div class="list-group">';

                    foreach ($mExercises as $row)
                    {
                        echo '<a class="list-group-item">' . $row['nombre'] . '<span class="badge">' . $row['num'] . '</span></a>';
                    }

    echo            '</div>
            </div>
            <!-- End -->';
      
    echo    '<!-- Showing the percentage of men/women -->
            <div class="col-md-4">
                <h3 style="text-align: center">' . $strings['menWomen'] . '</h3>
                    <div class="list-group">
                       <a class="list-group-item">' . $strings['men'] . '<span class="badge"> 0% </span></a>
                       <a class="list-group-item">' . $strings['women'] . '<span class="badge"> 0% </span></a>
                       <a class="list-group-item">Los métodos de modelo ya están hechos, falta que descomenteis lo de generateCoach() en el modelo y pongáis estas 2 badges bien<span class="badge"> 0% </span></a>
                    </div>
            </div>
            <!-- End -->
          </div>';
   
}




/** Function to obtain de most used exercise
 *  Example => generateCoachStatistics ($this->data);
 */
function getMostUsedExercise()
{
    include '../languages/spanish.php';

    $mysqli = connect();
    $sql = "SELECT * FROM tablas";

    // Checking the DB connection
    if (!$result = $mysqli->query($sql))
    {
        $toret = $strings['ConnectionDBError'];

    } else {

        $sql = "SELECT MAX(lineaid) AS num, nom AS nombre 
                FROM (SELECT COUNT(lineasdetabla.ejercicio_id) AS lineaid, ejercicios.nombre AS nom
                      FROM lineasdetabla
                      INNER JOIN ejercicios ON lineasdetabla.ejercicio_id = ejercicios.id WHERE ejercicios.borrado = '0'
                      GROUP BY lineasdetabla.ejercicio_id) AS aux";

        $result = $mysqli->query($sql); // getting hard data

        $toret=[];
        $i=0;

        // introducing all rows into an array
        while ($row = $result->fetch_array())
        {
            $toret[$i] = $row;
            $i++;
        }
    }

    return $toret;
}




/** Function to automatically generate a list of elements (statistics)
 *  Example => generateViewStatisticsCoach($lista_usuarios, 'statistics', $titles);
 */
function generateViewStatisticsCoach($list, $page_name,$titles)
{
    include '../languages/spanish.php';

    $name = strtolower($page_name);

    // Select the images directory
    $directory = '../images/profiles/';

    // Print the table if data aren't a string
    if (!is_string($list))
    {
        // Table
        echo '<div class="table-responsive" style="display: none" id="viewSporstmen">
                <table class="table table-hover">';

        // Attribute's titles
        echo '<thead>
                  <tr>';

        foreach ($titles as $title)
        {
            echo '<th>' . $strings[$title] . '</th>';
        }

        echo     '</tr>
               </thead>';

        // Attribute's values
        echo '<tbody>';

        for ($i = 0; $i < count($list); $i++)
        {
            echo '<tr>';

            for ($j = 0; $j < count($titles); $j++)
            {
                // Check if the attribute is an image
                if ($titles[$j] == 'imagen')
                {
                    if ($list[$i]["$titles[$j]"] <> '')
                    {
                        echo '<td> <img src="' . $directory . $list[$i]["$titles[$j]"] . '" alt="' . $list[$i]["$titles[$j]"] . '" height="150" width="150"> </td>';

                    } else {
                        echo '<td> <img src="' . $directory . 'default.png" alt="default.png" height="150" width="150"> </td>';
                    }

                } else {
                        echo '<td>' . $list[$i]["$titles[$j]"] . '</td>';
                }
            }

            // Print the buttons for each element
                        echo '<td>
                                  <div class="pull-right action-buttons">';
                        echo         '<a href="' . $name . '_controller.php?id=' . $list[$i]['id'] . '&action=' . $strings['See'] . '" class="btn btn-sm btn-primary">' . $strings['Statistics'] . '&nbsp<span class="glyphicon glyphicon-signal" aria-hidden="true"></span> </a>';
                        echo     '</div>
                            </td>';
            echo '</tr>';
        }

        echo '  </tbody>
              </table>
              
              <!-- Hide button -->
              <div id="hideSportsmen" style="text-align: center; margin-top: 1%">
                    <button class="btn btn-lg btn-default">' . $strings['hideSportsmen'] . '</button>
              </div>
                
             </div>';
    }
}

function generateEvents ()
{
    include '../languages/spanish.php';
	include '../functions/connectDB.php';	
	
	$cnn = new stdClass;
	
	$cnn->mysqli = connect();
	
	// show only the 3 newest events
        $sql = "SELECT * FROM eventos WHERE borrado = '0' ORDER BY fecha LIMIT 3";

        // checking DB connection
		if (!$result = $cnn->mysqli->query($sql))
		{
			$list = $strings['connectionDBError'];
		}else {
			
			// checking that at least one resource exists
			if ($result->num_rows != 0)
			{

				$list=[];
				$i=0;

				// introducing all resources into an array
				while ($row = $result->fetch_array())
                {

					$list[$i] = $row;
					$i++;
				}						

			}else {
				$list = $strings['ListErrorNotExist'];
			}
		}	

		echo '<div class="col-md-12">
			<div id="events-container" class="container">
        
        <h2>Eventos</h2>
  
		</div>
        <hr>';

		for ($i = 0; $i < count($list); $i++)
		{
  
			echo '<div id="jumbo1" class="jumbotron">
                <div class="media-body">
					<h2 class="media-heading">' . $list[$i]['nombre'] . '</h3>
					<p>' . $list[$i]['descripcion'] . '</p>
					<p> <b>Día: </b>' . $list[$i]['fecha'] . '</p>
      
					<p> <b>Horario:</b> De ' . $list[$i]['horaInicio'] . ' a ' . $list[$i]['horaFin'] . '</p>
				</div>
			</div>  
		<hr>';
	}
	
	echo '</div>';

}

function generateViewTracingList ($list, $titles, $idUser)
{
    include '../languages/spanish.php';

    $name = 'tracing';


    // Select the images directory
    $directory = '../images/exercises/';

    // Print the table if data aren't a string
    if (!is_string($list))
    {
        // Table
        echo '<div class="table-responsive">
                <table class="table table-bordered">';

        // Attribute's titles
        echo        '<thead>
                        <tr>';

        foreach ($titles as $title)
        {
            echo            '<th>' . $strings[$title] . '</th>';
        }

        echo            '</tr>
                    </thead>';

        // Attribute's values
        echo        '<tbody>';

        for ($i = 0; $i < count($list); $i++)
        {
            echo        '<tr>';

            for ($j = 0; $j < count($titles); $j++)
            {
                // Check if the attribute is a date
                if ($titles[$j] == 'fecha' || $titles[$j] == 'inicio' || $titles[$j] == 'fin')
                {
                    $dato = $list[$i]["$titles[$j]"];
                    $toecho = '-';

                    if($dato <> '')
                    {
                        $fech = new DateTime($dato);
                        $toecho = $fech->format('d-m-Y H:i:s');
                    }
                    echo    '<td>' . $toecho  . '</td>';
                } else {
                    if($titles[$j] == 'completado')
                    {
                        if($list[$i]["$titles[$j]"] == '0')
                        {
                            $toecho = '<span class="glyphicon glyphicon-ban-circle" style="color:#708090; font-size: 20px"></span> ';
                        }else{
                            $toecho = '<span class="glyphicon glyphicon-ok-circle" style="color:#32CD32; font-size: 20px"></span>';
                        }
                        echo    '<td>' . $toecho . '</td>';
                    }else{
                        if($titles[$j] == 'enlace')
                        {
                            $var1 = $list[$i]['id'];
                            $var2 = $strings['SeeSession'];
                            $var3 = $strings['Consult'];
                            $toecho = "<a href='tracing_controller.php?sesionId=$var1&action=$var2' class='btn btn-md btn-info' id='newButton'> $var3</a>";
                            /*$toecho = "<a href='tracing_controller.php?id=<?php echo $list[$i]['id']; ?>&action=<?php echo $strings['SeeSession']; ?>' class='btn btn-md btn-info' id='newButton'> <?php echo $strings['List']; ?></a>";*/
                            
                            echo    '<td>' . $toecho . '</td>';
                        }else{
                            echo    '<td>' . $list[$i]["$titles[$j]"] . '</td>';
                        }
                    }
                }
                //echo    '<td>' . $list[$i]["$titles[$j]"] . '</td>';
            }

            echo        '</tr>';
        }

        echo        '</tbody>
                </table>
             </div>';

    }
}


?>

