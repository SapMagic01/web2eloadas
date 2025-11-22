<?php
// Hibaüzenetek bekapcsolása
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h3>Kicsomagoló script indítása...</h3>";

// 1. Ellenőrizzük, hogy a ZIP bővítmény létezik-e
if (!class_exists('ZipArchive')) {
    die("<b style='color:red'>HIBA: A szerveren nincs bekapcsolva a PHP ZIP kiegészítő! Emiatt nem tud kicsomagolni.</b>");
}

// 2. Ellenőrizzük, hogy a fájl ott van-e
if (!file_exists('vendor.zip')) {
    die("<b style='color:red'>HIBA: Nem találom a 'vendor.zip' fájlt! Biztosan feltöltötted ide, a gyökérbe?</b>");
}

$zip = new ZipArchive;
$res = $zip->open('vendor.zip');

if ($res === TRUE) {
  // Megpróbáljuk kicsomagolni
  $extract = $zip->extractTo('./');
  $zip->close();
  
  if ($extract) {
      echo "<b style='color:green'>SIKER! A vendor mappa ki lett csomagolva.</b><br>";
      echo "Most már törölheted a vendor.zip-et és ezt a fájlt.";
  } else {
      echo "<b style='color:red'>HIBA: Nem sikerült kicsomagolni (jogosultsági hiba lehet).</b>";
  }
} else {
  echo "<b style='color:red'>Hiba történt a megnyitáskor. Hibakód: " . $res . "</b>";
}
?>