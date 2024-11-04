
<!DOCTYPE html>
<html lang="en-US" dir="ltr">

  <head>
    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>Erreur 404 | <?= APP_NAME ?></title>
    <?php include('openGraphe.php') ?>
    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link rel="stylesheet" href="<?= Router::webroot('assets/css/vendor/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= Router::webroot('assets/css/plugins/feather.css') ?>">
    <link rel="stylesheet" href="<?= Router::webroot('assets/css/plugins/fontawesome.min.css') ?>">
    <link rel="stylesheet" href="<?= Router::webroot('assets/css/plugins/euclid-circulara.css') ?>">
    <link rel="stylesheet" href="<?= Router::webroot('assets/css/style.css') ?>">

  </head>


  <body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
        <!--=========== Chargement du layout ===========-->
        <?= $CONTENT_FOR_LAYOUT?>
        <!-- ===============================================-->
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->

  </body>

</html>