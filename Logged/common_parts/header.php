<!DOCTYPE html>
<html lang="pt-BR" dir="ltr">
    <head>
        <!-- meta tags -->
        <meta charset="utf-8">
        <title>Home - User name</title>

        <!-- libs -->
        <script type="text/javascript" src="../front-dependencies/lib/jquery/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="../front-dependencies/lib/bootstrap/css/bootstrap.min.css">
        <script type="text/javascript" src="../front-dependencies/assets/js/master.js"></script>
        <link rel="stylesheet" href="../front-dependencies/assets/css/logged/master.css">

        <!-- assets -->
        <script type="text/javascript" src="../front-dependencies/assets/js/logged/home.js"></script>

    </head>
    <body>
        <header>
            <div class="header-warp">
                <div class="row">
                    <div class="col-6">
                        <p style="color:#fff">
                            <img src="../front-dependencies/assets/images/logoteste.svg" alt="" id="logo-header"> scaling waffle
                        </p>
                    </div>
                    <div class="col-6">
                        <div id="user-atributes-warper">
                            <table id="user_menu">
                                <tr>
                                    <td id="user_name">
                                        Username
                                    </td>
                                    <td>
                                        <img src="https://www.aatesp.com.br/resources/files/pics/nouser.png" alt="" id="user_img">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div id="user-menu">
                <ul>
                    <li>Suas pastas</li>
                    <li>Suas equipes</li>
                    <li>Configurações</li>
                    <li id="logout">logout</li>
                </ul>
            </div>
        </header>
