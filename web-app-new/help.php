<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>UQGO</title>
    <link href='https://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/skeleton.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/help.css">
    <link rel="stylesheet" href="./resources/font-awesome-4.4.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link href="./img/icon.png" rel="icon" type="image/png">
    <script type="text/javascript">
      function showHelp() {
        $(".help").show();
        $(".overlay").show();
      }

      function hideHelp() {
        $(".help").hide();
        $(".overlay").hide();
      }
    </script>
  </head>
  <body>
    <h1>UQGO: Startup Guide</h1>
    <div class="footer">
      <p class="footer-info"><?php include($_SERVER['DOCUMENT_ROOT'].'/v0-6/php/page-elements/footer-text.php');?></p>
      <nav>
        <a href="index.php"><i class="fa fa-arrow-circle-left fa-fw"></i> Back to login</a>
      </nav>
    </div>
    <div class="video"><iframe id="ytplayer" type="text/html" width="640" height="390" src="http://www.youtube.com/embed/6F3iLdoFM20?autoplay=0" frameborder="0"/></div>
  </body>
</html>