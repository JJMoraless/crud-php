<?php
// require "./data/user.php";
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once("./src/models/UserModel.php");



function create_user()
{
    global $user;
    $data = json_encode(
        [
            "nombre" => $_POST["nombre"],
            "apellido" => $_POST["apellido"],
            "direccion" => $_POST["direccion"],
            "edad" => $_POST["edad"],
            "email" => $_POST["email"],
            "hora_entrada" => $_POST["hora_entrada"],
            "team" => $_POST["team"],
            "trainer" => $_POST["trainer"],
            "cedula" => $_POST["cedula"],
        ]
    );
    $user->add($data);
}

function get_users()
{
    global $user;
    $users = json_decode($user->get_all());
    foreach ($users as $user_data) {
        echo <<<HTML
            <tr>
                <td>$user_data->nombre</td>
                <td>$user_data->apellido</td>
                <td>$user_data->direccion</td>
                <td>$user_data->edad</td>
                <td>$user_data->email</td>
                <td>$user_data->hora_entrada</td>
                <td>$user_data->team</td>
                <td>$user_data->trainer</td>
                <td><button name="registro" type="submit" value="$user_data->id">🚀</button></td>
            </tr>
        HTML;
    }
}

// buscar por cc
function get_by_cc($cc)
{
    global $user;
    return json_decode($user->get_by_cc($cc))[0];
}

$user_form = null;
if (isset($_POST["read"])) {
    $user_form = get_by_cc($_POST["cedula"]);
}

// anañir
if (isset($_POST["create"])) {
    create_user();
    header("Location: index.php");
    exit();
}

// borrar
if(isset($_POST["delete"])){
    $user_id = json_decode($user->get_by_cc($_POST["cedula"]))[0]->id;
    $user->delete_by_id($user_id);
}

// actualizar
if(isset($_POST["update"])){
    $user_id = json_decode($user->get_by_cc($_POST["cedula"]))[0]->id;
    $data = json_encode(
        [
            "nombre" => $_POST["nombre"],
            "apellido" => $_POST["apellido"],
            "direccion" => $_POST["direccion"],
            "edad" => $_POST["edad"],
            "email" => $_POST["email"],
            "hora_entrada" => $_POST["hora_entrada"],
            "team" => $_POST["team"],
            "trainer" => $_POST["trainer"],
            "cedula" => $_POST["cedula"],
        ]
    );
    $user->update_by_id($user_id,$data);
}

if(isset($_POST["registro"])){
    $user_form = json_decode($user->get_by_id($_POST["registro"]));
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>crud campuslands</title>
    <link rel="stylesheet" href="./css/styles.css">
</head>

<body>
    <form method="POST" class="main" action="index.php">
        <section class="header__container">
            <div class="header__grid">
                <div class="header__element">
                    <input name="nombre" type="text" placeholder="Nombre" value="<?php echo $user_form?->nombre ?>">
                    <input name="apellido" type="text" placeholder="Apellido" value="<?php echo  $user_form?->apellido ?>">
                    <input name="direccion" type="text" placeholder="Direccion" value="<?php echo $user_form?->direccion ?>">
                </div>
                <div class="header__element">
                    <h2>Campuslands 👨‍🚀</h2>
                    <input name="edad" type="text" placeholder="Edad" value="<?php echo $user_form?->edad ?>">
                    <input name="email" type="text" placeholder="Email" value="<?php echo $user_form?->email ?>">
                </div>
            </div>
        </section>

        <section class="body__container">
            <div class="body__grid">

                <div class="body__element">
                    <input name="hora_entrada" type="text" placeholder="Hora de entrada" value="<?php echo $user_form?->hora_entrada ?>">
                    <input name="team" type="text" placeholder="Team" value="<?php echo $user_form?->team ?>">
                    <input name="trainer" type="text" placeholder="Trainer" value="<?php echo $user_form?->trainer ?>">
                </div>

                <div class="body__element">
                    <div class="body__crud">
                        <input name="create" type="submit" value="✅" />
                        <input name="delete" type="submit" value="💢" />
                        <input name="update" type="submit" value="🔏" />
                        <input name="read" type="submit" value="🔍" />
                    </div>
                    <input required name="cedula" type="text" placeholder="Cedula" value="<?php echo $user_form?->cedula ?>">
                </div>
            </div>
        </section>
    </form>

    <form method="POST">
        <table class="tabla__container">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Direccion</th>
                    <th>Edad</th>
                    <th>Email</th>
                    <th>Horario de entrada</th>
                    <th>Team</th>
                    <th>Trainer</th>
                    <th>editar</th>
                </tr>
            </thead>
            <tbody>
                <?php get_users();  ?>
            </tbody>
        </table>
    </form>
</body>

</html>