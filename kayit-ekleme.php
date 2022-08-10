<?php

//burada pdo ile veritabanına bağlantı sağlıyoruz.
try
{
$db = new PDO("mysql:host=localhost;dbname=php;charset=utf8", "VERİTABANI KULLANICI ADI", "VERİTABANI ŞİFRESİ");

}
catch(PDOException $hata)
{
  echo $hata->getMessage();
}



//kayıt ekleme işlemleri
if($_POST)
{
//text inputundan gelen verileri post ediyorum.
$isim = $_POST["isim"];
$soyisim = $_POST["soyisim"];
$email = $_POST["email"];
$sifre = md5($_POST["sifre"]);
$cinsiyet = $_POST["cinsiyet"];
$kayit_tarihi = date("Y-m-D");

if($isim != "" && $soyisim !="" && $email != "" && $sifre != "" && $cinsiyet != "") //burada boş alan var mı onu kontrol ediyorum.
{

  $sorgu = $db->prepare("insert into user set isim = ?, soyisim = ?, email = ?, sifre= ?, cinsiyet= ?, kayit_tarihi= ?");
  $insert = $sorgu->execute(array($isim, $soyisim, $email, $sifre, $cinsiyet, $kayit_tarihi));
  
  if($insert) //veriler başarılı bir şekilde eklendi mi onu kontrol ediyorum.
  {
  echo "Kayıt başarılı";
  }
  else
  {
  echo "Kayıt başarısız";
  }

}
else
  {
    echo "Lütfen tüm alanları doldurun.";
  }
  
}

?>

<form action="" method="post">

<input type="text" name="isim" placeholder="İsim"> <br/>
<input type="text" name="soyisim" placeholder="Soyisim"> <br/>
<input type="text" name="email" placeholder="Email"> <br/>
<input type="text" name="sifre" placeholder="Şifre"> <br/>
<input type="text" name="cinsiyet" placeholder="Cinsiyet"> <br/><br/>

<input type="submit" value="Oluştur">

</form>
