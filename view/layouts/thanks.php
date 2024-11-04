<!DOCTYPE html>
<html lang="fr">
<head>
<title><?= $title_for_layout = 'Merci pour votre Don | '.APP_NAME  ?></title>
    <?php include('openGraphe.php') ?>
<style>
.login-main-wrapper{
  position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
}
.thankyou-wrapper{
  width:100%;
  height:auto;
  margin:auto;
  display: block;
    justify-content: center;
    align-items: center;
}
.thankyou-wrapper h1{
  text-align:center;
  color:#333333;
}
.thankyou-wrapper p{
  font:26px Arial, Helvetica, sans-serif;
  text-align:center;
  color:#333333;
  padding:5px 10px 10px;
}
.thankyou-wrapper a{
  font:26px Arial, Helvetica, sans-serif;
  text-align:center;
  color:#ffffff;
  display:block;
  text-decoration:none;
  background:#E47425;
  margin:10px auto 0px;
  padding:15px 20px 15px;
  border-bottom:5px solid #F96700;
  width:250px;
  border:none;
  border-radius:30px;
  box-shadow: 0 10px 16px 1px rgba(174, 199, 251, 1);
}
.thankyou-wrapper a:hover{
  font:26px Arial, Helvetica, sans-serif;
  text-align:center;
  color:#ffffff;
  display:block;
  border-radius:30px;
  text-decoration:none;
  width:250px;
  background:#F96700;
  margin:10px auto 0px;
  padding:15px 20px 15px;
  border-bottom:5px solid #F96700;
}
@media (max-width:360px){
  .thankyou-wrapper img{
    width:350px;
  }
  .thankyou-wrapper a{
    font:14px Arial, Helvetica, sans-serif;
    margin:5px auto 0px;
    width:200px;
  }
  .thankyou-wrapper a:hover{
    font:14px Arial, Helvetica, sans-serif;
    width:200px;
    margin:5px auto 0px;
  }
}
</style>
  
</head>

<body>
  <section class="login-main-wrapper">
      <div class="main-container">
          <div class="login-process">
              <div class="login-main-container">
                  <div class="thankyou-wrapper">
                      <h1><img src="<?= Router::webroot('assets/img/thank/thankyou.webp') ?>" alt="thanks"></h1>
                        <p>Merci <?= isset($DonateMsg) ? $DonateMsg : ''?> pour votre <strong>Don</strong> !</p>
                        <a href="<?= Router::url('faire-un-don') ?>">Retour à la page précédente</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
  
</body>
<script src="<?= Router::webroot('assets/js/confetti.min.js') ?>"></script>
<script>
    confetti.start()
</script>
</html>