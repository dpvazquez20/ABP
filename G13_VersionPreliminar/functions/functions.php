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

            // You can´t modify in 'Trainings'
            if ($page_name <> 'training')
            {
                echo    '&nbsp';
                echo    '<a href="' . $name . '_controller.php?id=' . $list[$i]['id'] . '&action=' . $strings['Modify'] . '" class="btn btn-sm btn-primary"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> </a>';
            }

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

        // You can't modify in 'Trainings'
        if ($page_name <> 'training')
        {
            echo       '<a href="' . $name . '_controller.php?id=' . $list[0]['id'] . '&action=' . $strings['Modify'] . '" class="btn btn-md btn-primary"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> </a>';
        }
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

            echo                '<a href="' . $name . '_controller.php?id=' . $list[$i]['id'] . '&action=' . $strings['Follow'] . '" class="btn btn-md btn-primary">' . $strings['Follow'] . '  <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> </a>';

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
    //die("Completado: " . print_r($list[0]['completado']));
    if($list[0]['completado'] == 0)
    {
        echo "<p style='font-size: medium; font-style: normal;'><b>" . $strings['State'] . ":</b> " . $strings['No complete2'] . "</p>";
    }else{
         echo "<p style='font-size: medium; font-style: normal;'><b>".  $strings['State'] . ":</b> " . $strings['Complete2'] . "</p>";
    }
}

function generateListTrainingTables ($list, $page_name, $titles)
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
			echo        '<a href="training_controller.php?id=' . $list[$i]['id'] . '&action=' . $strings['DeleteTable'] . '" class="btn btn-sm btn-danger"> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> </a>';
            
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

?>

