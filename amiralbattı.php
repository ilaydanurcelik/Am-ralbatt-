<?php

// Oyun tahtasının boyutları
$tahta_x = 20; // Tahtanın genişliği
$tahta_y = 10; // Tahtanın yüksekliği

// Oyun tahtasını oluştur
for ($y = 0; $y < $tahta_y; $y++) {
    //$satir = array(); // Her satır için boş bir dizi oluştur
    for ($x = 0; $x < $tahta_x; $x++) {
        $satir[] = '-'; // Her hücreye '-' karakteri ekle
    }
    $tahta[] = $satir; // Oluşturulan satırı tahtaya ekle
}

// Gemilerin boyutları
$gemiler = array_merge(array_fill(0, 4, 2), array_fill(0, 6, 3)); // 4 adet 2 birimlik ve 6 adet 3 birimlik gemi

// Gemileri tahtaya yerleştir
foreach ($gemiler as $gemi) {
    $gemiYerlesti = false;
    while (!$gemiYerlesti) {
        $y = rand(0, $tahta_y - 1); // Rastgele bir satır seç
        $x = rand(0, $tahta_x - 1); // Rastgele bir sütun seç
        $yon = rand(0, 1); // Yatay mı dikey mi olacağını belirle (0: yatay, 1: dikey)

        // Yatay yerleştirme
        if ($yon == 0 && $x + $gemi <= $tahta_x) {
            $gecerli = true;
            for ($i = $x; $i < $x + $gemi; $i++) {
                if ($tahta[$y][$i] != '-') {
                    $gecerli = false;
                    break;
                }
            }
            if ($gecerli) {
                for ($i = $x; $i < $x + $gemi; $i++) {
                    $tahta[$y][$i] = 'X'; // Gemiyi tahtaya yerleştir
                }
                $gemiYerlesti = true;
            } else {
                echo "Hata: Gemiler çakışıyor. Yeniden yerleştiriliyor...\n";
            }
        } 
        // Dikey yerleştirme
        elseif ($yon == 1 && $y + $gemi <= $tahta_y) {
            $gecerli = true;
            for ($i = $y; $i < $y + $gemi; $i++) {
                if ($tahta[$i][$x] != '-') {
                    $gecerli = false;
                    break;
                }
            }
            if ($gecerli) {
                for ($i = $y; $i < $y + $gemi; $i++) {
                    $tahta[$i][$x] = 'X'; // Gemiyi tahtaya yerleştir
                }
                $gemiYerlesti = true;
            } else {
                echo "Hata: Gemiler çakışıyor. Yeniden yerleştirme işlemi yapınız...\n";
            }
        }
    }
}

// Tahtayı yazdır
echo "   ";
for ($x = 0; $x < $tahta_x; $x++) {
    echo ($x < 10 ? " $x" : ($x < 20 ? "$x" : $x % 10)) . " ";
}
echo "\n";

for ($y = 0; $y < $tahta_y; $y++)  {

    echo ($y < 10 ? " $y" : $y % 10) . " "; // İndeksleri yazdır
    for ($x = 0; $x < $tahta_x; $x++) {
        echo " " . $tahta[$y][$x] . " "; // Tahtanın her bir karesini yazdır
    }

    echo "\n"; // Yeni bir satıra geç
}

