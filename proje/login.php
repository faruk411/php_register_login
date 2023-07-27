<?php
include("baglanti.php");

$username_err = "";
$parola_err = "";


if(isset($_POST["giris"])){
    // kullanıcı adı doğrulama
    if(empty($_POST["kullaniciadi"])){

        $username_err="kullanıcı adı boş geçilemez";

    }
    
    else{
        $username = $_POST["kullaniciadi"];
    }
    
   
    
    // Parola doğrulama
    if(empty($_POST["parola"])){
        $parola_err = "Parola boş geçilemez";
    }
    else{
        $parola =($_POST["parola"]);
    }
    
  
    if(isset($username)&&isset($parola)){
    $secim = "SELECT * FROM kullanicilar WHERE kullanici_adi='$username'";
    $calistir = mysqli_query($baglanti,$secim);
    $kayitsayisi = mysqli_num_rows($calistir);//ya 0 ya 1
    if($kayitsayisi>0){

        $ilgilikayit = mysqli_fetch_assoc($calistir);
        $hashlisifre = $ilgilikayit["parola"];
        if(password_verify($parola,$hashlisifre)){

            session_start();
            $_SESSION["kullanici_adi"]=$ilgilikayit["kullanici_adi"];
            $_SESSION["email"]=$ilgilikayit["email"];
            header("location:profile.php");

        }
        else{
            echo '<div class="alert alert-danger" role="alert">
            Parola adı yanlış.
          </div>';
        }

    }
    else{
        echo '<div class="alert alert-danger" role="alert">
        Kullanıcı adı yanlış.
      </div>';
    }


    mysqli_close($baglanti);
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Üye Giriş</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" />
</head>
<body>
    <div  class="container p-5">
        <h3 style="color:brown;">Üye Giriş </h3>
        <div style="background-color:grey;" class="card p-5">
                <form action="login.php" method="POST">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">kullanıcı adı</label>
                        <input type="text" class="form-control <?php 
                        if(!empty($username_err)){
                            echo "is-invalid";
                        }?>"  id="exampleInputEmail1" name="kullaniciadi">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?php echo $username_err;?>
                        </div>
                    </div>
                  
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Parola</label>
                        <input type="password" class="form-control 
                        <?php
                        if(!empty($parola_err)){
                            echo "is-invalid";
                        }
                        ?>
                        " id="exampleInputPassword1" name="parola">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                         <?php echo $parola_err;?>
                        </div>
                    </div>
                   
                   
                    <button  type="submit" name="giris" class="btn btn-primary" >Giriş Yap</button>
                </form>
        </div>
    </div>
</body>
</html>