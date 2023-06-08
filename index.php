<?php
// require "./data/user.php";
error_reporting(E_ALL);
ini_set('display_errors', '1');



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
    <form method="POST" class="main">
        <section class="header__container">
            <div class="header__grid">
                <div class="header__element">
                    <input name="nombre" type="text" placeholder="Nombre">
                    <input name="apellido" type="text" placeholder="Apellido">
                    <input name="direccion" type="text" placeholder="Direccion">
                </div>
                <div class="header__element">
                    <h2>Campuslands 👨‍🚀</h2>
                    <input name="edad" type="text" placeholder="Edad">
                    <input name="email" type="text" placeholder="Email">
                </div>
            </div>
        </section>

        <section class="body__container">
            <div class="body__grid">
                <div class="body__element">
                    <input name="hora_entrada" type="text" placeholder="Hora de entrada">
                    <input name="team" type="text" placeholder="Team">
                    <input name="trainer" type="text" placeholder="Trainer">
                </div>
                <div class="body__element">
                    <div class="body__crud">
                        <input name="create" type="submit" value="✅" />
                        <input name="delete" type="submit" value="💢" />
                        <input name="update" type="submit" value="🔏" />
                        <input name="read" type="submit" value="🔍" />
                    </div>
                    <input type="text" placeholder="Cedula">
                </div>
            </div>
        </section>

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
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td> <?php ?> </td>
                    <td>aaaaaaaa</td>
                    <td>aaaaaaaa</td>
                    <td>aaaaaaaa</td>
                    <td>aaaaaaaa</td>
                    <td>aaaaaaaa</td>
                    <td>aaaaaaaa</td>
                    <td>aaaaaaaa</td>
                </tr>
            </tbody>
        </table>



    </form>
</body>

</html>