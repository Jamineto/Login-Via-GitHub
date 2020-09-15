<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
</head>
<body>
    <button class='connect'>Conectar</button>
</body>
<script>
$(".connect").click(function(){
    location.replace("https://github.com/login/oauth/authorize?client_id=d1eef707a6568ef48440")
})

</script>
</html>