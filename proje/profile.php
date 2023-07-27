<?php
session_start();
if(isset($_SESSION["kullanici_adi"])){
    echo "<h3>".$_SESSION["kullanici_adi"]."HOŞGELDİN</h3>";
    echo "<h3>".$_SESSION["email"]."</h3>";
}
?>