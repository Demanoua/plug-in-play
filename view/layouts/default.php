<!DOCTYPE html>
<html lang="fr">

<head>
<title><?= isset($title_for_layout) ? $title_for_layout: 'Accueil | '.APP_NAME  ?></title>
    <?php include('openGraphe.php') ?>
    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link rel="stylesheet" href="<?= Router::webroot('assets/css/style.css') ?>">

</head>

<body class="">

        <!--=========== Chargement du layout ===========-->
                      <?= $CONTENT_FOR_LAYOUT?>
        <!-- ===============================================-->


    <script src="<?= Router::webroot('assets/js/main.js') ?>"></script>
        <?php if($this->request->action == 'faire-un-don') :?>
        <?php endif ?>

</body>

</html>