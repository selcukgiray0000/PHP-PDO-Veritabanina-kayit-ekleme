<?php

try
{
 $db = new PDO("mysql:host=localhost;dbname=phpgit;charset=utf8", "root", "");
}
catch(PDOException $e)
{
  echo $e->getMessage();
}


if($_POST)
{
  $cinsiyet = $_POST["cinsiyet"];
  $isim = $_POST["isim"];
  $soyisim = $_POST["soyisim"];
  $email = $_POST["email"];
  $sifre = md5($_POST["sifre"]);
  $kayit_tarihi = date("d-m-Y");

  if($isim !== "" && $soyisim !== "" && $email !=="" && $cinsiyet !== "" && $sifre!=="")
  {
    $sorgu = $db->prepare("insert into user set isim= ?, soyisim=?, email=?, sifre=?, cinsiyet=?, kayit_tarihi=?");
    $ekle = $sorgu->execute(array($isim, $soyisim, $email, $sifre, $cinsiyet, $kayit_tarihi));
  
    if($ekle)
    {
      echo "Kayıt eklendi :)";
    }
    else
    {
      echo "Kayıt eklenemedi :(";
    }
  }
  else
  {
    echo "Lütfen tüm alanları doldurunuz.";
  }

}

?>

<form action="" method="post">

<input type="text" name="isim" placeholder="İsim"><br>
<input type="text" name="soyisim" placeholder="Soyisim"><br>
<input type="text" name="email" placeholder="E-mail"><br>
<input type="text" name="sifre" placeholder="Şifre"><br>
<select name="cinsiyet" >
<option value="Erkek">Erkek</option>
<option value="Kız">Kız</option>
</select><br><br>

<input type="submit" value="Kayıt Ekle">

</form>
