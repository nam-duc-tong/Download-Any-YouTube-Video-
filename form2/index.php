<?php
    if(isset($_POST['download']))
    {
        $imgUrl = $_POST['imgurl'];
        $ch = curl_init($imgUrl);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        $download = curl_exec($ch);
        curl_close($ch);
        header('Content-type: image/jpg');
        header('Content-Disposition: attachment; filename="thumnnail.jpg"');
        echo $download;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download Any YouTube Video Thumbnail using HTML CSS JavaScript & PHP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
        <header>Download Thumbnail</header>
        <div class="url-input">
            <span class="title">Paster Video Url: </span>
            <div class="field">
                <input type="text" placeholder="https://www.youtube.com/watch?v=FucPPCPDd2Y&list=PLpwngcHZlPaf1aw42OGyitm4jh2Dlmi9c&index=2" required>
                <input class="hidden-input" type="hidden" name="imgurl">
                <div class="bottom-line"></div>
            </div>
        </div>
        <div class="preview-area">
            <img src="" alt="thumbnail" class="thumbnail">
            <i class="icon fas fa-cloud-download-alt"></i>
            <span>Paste video url to see preview</span>
        </div>
        <button class="download-btn" type="submit" name="download">Download Thumbnail</button>
    </form>
    <script>
        const urlField = document.querySelector(".field input"),
        previewArea = document.querySelector(".preview-area"),
        imgTag = previewArea.querySelector(".thumbnail");
        hiddenInput = document.querySelector(".hidden-input");
        urlField.onkeyup = ()=>{
            let imgUrl = urlField.value;
            // console.log(imgUrl);
            previewArea.classList.add("active");
            if(imgUrl.indexOf("https://www.youtube.com/watch?v=") != -1)
                {
                    let videoId = imgUrl.split("v=")[1].substring(0,11);
                    // console.log(videoId);
                    let youImg = `https://img.youtube.com/vi/${videoId}/maxresdefault.jpg`;
                    // console.log(youImg);
                    imgTag.src=youImg;
                }
            else if(imgUrl.indexOf("https://youtu.be/") != -1)
                {
                    let videoId = imgUrl.split(".be/")[1].substring(0,11);
                    // console.log(videoId);
                    let youImg = `https://img.youtube.com/vi/${videoId}/maxresdefault.jpg`;
                    // console.log(youImg);
                    imgTag.src = youImg;
                }
            else if(imgUrl.match(/\.(jpe?g|png|gif|bmp|webp)$/i))
                {
                    imgTag.src = imgUrl;
                }
            else{
                imgTag.src = "";
                previewArea.classList.remove("active");
            }
            hiddenInput.value = imgTag.src;
        }
    </script>
</body>
</html>