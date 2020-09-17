<?php
  require_once 'var.php';
  session_start();
?>

<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
    <title>Hello, world!</title>
  </head>
  <body>
  <div class="container text-center">
  <?php
    
    if(isset($_SESSION['nome']))
    {
      echo '
            <div class="row">
              <div class="col">
              <h1>Hello, '.$_SESSION['nome'].'</h1> <br>
              <img src="'.$_SESSION['foto'].'" class="rounded img-thumbnail" style="width: 120px; height: 120px">
              </div>
            </div>
            <div class="row">
              <div class="col">
                <a href="'.$_SESSION['link'].'" class="btn btn-primary" role="button">Acessar perfil</a>
              </div>
              <div class="col">
                <a href="logout.php" class="btn btn-danger" role="button">Sair</a>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <a class="btn btn-dark btn-lg" id="load">List repositories</a>
              </div>
            </div>
            <div class="row">
                <div class="col-md-12 results"><hr></div>
            </div>
            ';
    }else
    echo
      '
      <div class="row">
        <h1>Welcome</h1>
      </div>
      <div class="row">
        <a href="https://github.com/login/oauth/authorize?client_id='.CLIENT_ID.'" class="btn btn-dark btn-lg" role="button"><i class="fab fa-github"></i> | Login via GitHub</a>
      </div>
      ';
      
    ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script>
    $( document ).ready(function() {
        $('#load').on('click',function(e){
        e.preventDefault
        $.ajax({
            url: 'https://api.github.com/user/repos',
            type: 'GET',
            data: {visibility : "all"},
            headers: {
              "Authorization" : "token <?php echo $_SESSION['token'] ?>",
              "Accept" : "application/vnd.github.v3+json"
            },
            dataType: 'json',
            beforeSend: function (){
              $('#load').addClass('disabled')
              $('#load').html('<i class="fas fa-spinner fa-spin" id="loading"></i>')
            } ,
            success: function (data) {
                $('#load').fadeOut();
                data.forEach(element => {
                  $('.results').append("<a href='" + element.html_url + "'>" + element.full_name + "</a><br>Description: " + element.description + "<hr>" )
                });
            },
            error: function(data){
              console.info(data.statusText);
            }
        });
      })
    });  
    
      
    </script>
  </body>
</html>