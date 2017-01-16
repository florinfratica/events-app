<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Events App</title>
        <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="assets/css/theme.css" rel="stylesheet">
        <link href="assets/css/font-awesome.min.css" rel="stylesheet">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Comută navigarea</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">Events App</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <?php if (isset($_SESSION['auth_id'])): ?>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="/?page=events&action=index"><span class="glyphicon glyphicon-list" style="vertical-align:-1px;"></span> Evenimentele mele</a></li>
                            <li><a href="/?page=users&action=profile"><span class="glyphicon glyphicon-user" style="vertical-align:-1px;"></span> Profil</a></li>
                            <li><a href="/?page=pages&action=tweets"><i class="fa fa-twitter"></i> Tweet-uri</a></li>
                            <li><a href="/?page=pages&action=contact"><span class="glyphicon glyphicon-comment" style="vertical-align:-1px;"></span> Contact</a></li>
                            <?php if ($_SESSION['auth']['admin'] == 'Y'): ?>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class="glyphicon glyphicon-font" style="vertical-align:-1px;"></span> Admin <span class="caret" style="vertical-align:3px;"></span></a>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-header">Evenimente</li>
                                        <li><a href="/?page=events&action=admin"><span class="glyphicon glyphicon-list" style="vertical-align:-1px;"></span> Toate evenimentele</a></li>
                                        <li><a href="/?page=events&action=create"><span class="glyphicon glyphicon-plus-sign" style="vertical-align:-1px;"></span> Adaugă eveniment</a></li>
                                        <li class="divider"></li>
                                        <li class="dropdown-header">Utilizatori</li>
                                        <li><a href="/?page=users&action=index"><span class="glyphicon glyphicon-user" style="vertical-align:-1px;"></span> Toți utilizatorii</a></li>
                                        <li class="divider"></li>
                                        <li class="dropdown-header">Statistici</li>
                                        <li><a href="/?page=pages&action=stats"><span class="glyphicon glyphicon-stats" style="vertical-align:-1px;"></span> Statistici generale</a></li>
                                    </ul>
                                </li>
                            <?php endif;?>
                            <li><a href="/?page=users&action=logout"><span class="glyphicon glyphicon-log-out" style="vertical-align:-1px;"></span> Deconectare</a></li>
                        </ul>
                    <?php else: ?>
                        <form class="navbar-form navbar-right" action="/?page=users&action=login" method="POST">
                            <div class="form-group">
                                <input type="text" placeholder="Username" class="form-control" name="username">
                            </div>
                            <div class="form-group">
                                <input type="password" placeholder="Parolă" class="form-control" name="password">
                            </div>
                            <button type="submit" class="btn btn-success">Conectare</button>
                        </form>
                    <?php endif;?>
                </div>
            </div>
        </nav>
        <?php if (isset($_SESSION['flash'])): ?>
            <div class="container" id="alert-container">
                <br/>
                <div class="alert alert-<?=$_SESSION['flash']['class']?> alert-dismissable" style="margin:0;">
                    <a href="#" class="close" data-target="#alert-container" data-dismiss="alert" aria-label="close">&times;</a>
                    <?=$_SESSION['flash']['message']?>
                </div>
            </div>
        <?php unset($_SESSION['flash']);endif;?>
        <?php require_once 'routes.php';?>
        <div class="container">
            <hr>
            <footer>
                <p class="pull-left">&copy; <?=date('Y');?> Events App</p>
            </footer>
        </div>
        <script src="/assets/js/jquery.min.js"></script>
        <script src="/assets/js/bootstrap.min.js"></script>
        <script src="/assets/js/ie10-viewport-bug-workaround.js"></script>
    </body>
</html>
