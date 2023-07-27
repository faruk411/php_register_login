<?php
include("baglanti.php");

$username_err = "";
$email_err  = "";
$parola_err = "";
$parolatkr_err = "";

if(isset($_POST["kaydet"])){
    // kullanıcı adı doğrulama
    if(empty($_POST["kullaniciadi"])){

        $username_err="kullanıcı adı boş geçilemez";

    }
    elseif(strlen($_POST["kullaniciadi"])<6){
        $username_err="Kullanıcı adı en az 6 karakter olmalı ";
    }
    else if (!preg_match('/^[a-z\d_]{5,20}$/i', $_POST["kullaniciadi"])) {
        $username_err ="Kullanıcı adı büyü küçük harf ve rakamdan oluşmalı";
    }
    else{
        $username = $_POST["kullaniciadi"];
    }
    
    // email doğrulama
    if(empty($_POST["email"])){
        $email_err = "Email alanı boş geçilemez";
    }
    else{
        $email = $_POST["email"];
    }
    
    // Parola doğrulama
    if(empty($_POST["parola"])){
        $parola_err = "Parola boş geçilemez";
    }
    else{
        $parola = password_hash($_POST["parola"],PASSWORD_DEFAULT);
    }
    
    // Parola tekrar
    if(empty($_POST["parolatkr"])){
        $parolatkr_err = "Parola tekrar boş geçilemez";
    }
    elseif($_POST["parola"]!=$_POST["parolatkr"]){
        $parolatkr_err="Parolaral eşleşmiyor";
    }
    else{
        $parolatkr = $_POST["parolatkr"];
    }

   
    

  
    
    if(isset($username)&&isset($email)&&isset($parola)){
    $ekle ="INSERT INTO kullanicilar (kullanici_adi, email, parola) VALUES ('$username','$email','$parola')";
    
    $calistirekle = mysqli_query($baglanti,$ekle);
    if($calistirekle) {
        echo '<div class="alert alert-success" role="alert">
        Kayıt başarılı bir şekilde eklendi.
      </div>';
    }
    else{
        echo '<div class="alert alert-danger" role="alert">
        Kayıt eklenirken bir sorun oluştu.
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
    <title>Üye Kayıt</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" />
</head>
<body>
    <div class="container p-5">
        <h3 style="color:brown;">Üye kayıt formu</h3>
        <div style="background-color: grey;" class="card p-5">
                <form action="kayit.php" method="POST">
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
                        <label for="exampleInputEmail1" class="form-label">Email adresi</label>
                        <input type="email" class="form-control
                        <?php
                        if(!empty($email_err)){
                            echo "is-invalid";
                        }
                        ?>
                        " id="exampleInputEmail1" name="email" >
                        <div id="validationServer03Feedback" class="invalid-feedback">
                          <?php echo $email_err; ?>
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
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Parola</label>
                        <input type="password" class="form-control 
                        <?php
                        if(!empty($parolatkr_err)){
                            echo "is-invalid";
                        }
                        ?>
                        " id="exampleInputPassword1" name="parolatkr">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                        <?php echo $parolatkr_err;?>
                        </div>
                    </div>
                   
                    <button type="submit" name="kaydet" class="btn btn-success" >Kaydet</button>
                </form>
        </div>
    </div>
</body>
</html>