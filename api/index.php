<?php
    if (isset($_POST['download'])) {
        $imgUrl=$_POST['imgurl']; //pegando url da img do input escondido
        $ch = curl_init($imgUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $download = curl_exec($ch);
        curl_close($ch);
        header('Content-type: image/jpg');
        header('Content-Disposition: attachment; filename="thumbnail.jpg"');
        echo $download;
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download Thumbnail ou Fotos</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
</head>
<body> 
    <main class="container">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <header> <h1>Baixe sua Thumbnail ou sua Foto</h1></header>
        <div class="url-input">
            <h2 class="title">
                Cole o link aqui:
            </h2>
            <div class="field">
                <input type="text" placeholder="https://www.youtube.com/watch?v=paqPUvF3uCs" required>
                <input class="hidden-input" type="hidden" name="imgurl">
                <div class="bottom-line">

                </div>
            </div>
        </div>
        <div class="preview">
            <img class="thumbnail" src="" alt="thumbnail">
            <i class=" icon fas fa-cloud-download-alt"></i>
            <h4>Cole o link para previsão</h4>
        </div>
        <button class="download-btn" type= "submit" name="download">Download Thumbnail</button>
        
    </form>

    <footer class="container-f-hidden">
        <div class="f">
            <span class="f-text">Feito por Joaperi</span>
        </div>
    </footer>
    
    

    </main>

    
<script>
    const urlField = document.querySelector(".field input"),
    preview = document.querySelector(".preview"),
    imgTag = preview.querySelector(".thumbnail");
    hiddenInput= document.querySelector(".hidden-input");

    urlField.onkeyup = ()=> {
        let imgUrl = urlField.value; //Pegando o valor do usuario
        preview.classList.add("active");

     //   https://www.youtube.com/watch?v=paqPUvF3uCs example --paqPUvF3uCs--

        //Validação
        if(imgUrl.indexOf("https://www.youtube.com/watch?v=") != -1 ){
            let vidId = imgUrl.split("v=")[1].substring(0, 11);
            let ytThumbUrl = `https://img.youtube.com/vi/${vidId}/maxresdefault.jpg`; // Isso é um link de uma thumbanail, de onde tiraremos as thumbs dos videos.
            imgTag.src = ytThumbUrl;
            
        }else if (imgUrl.indexOf("https://youtu.be/")!= -1) {
            let vidId = imgUrl.split("be/")[1].substring(0, 11);
            let ytThumbUrl = `https://img.youtube.com/vi/${vidId}/maxresdefault.jpg`; // Isso é um link de uma thumbanail, de onde tiraremos as thumbs dos videos.
            imgTag.src = ytThumbUrl;

        } else if (imgUrl.match(/\.(jpe?g|png|gif|bmp|webp)$/i)) {
            imgTag.src = imgUrl;
        } else {
            imgTag.src = "";
            preview.classList.remove("active")
        }
        hiddenInput.value = imgTag.src;
    }
</script>
</body>
</html>