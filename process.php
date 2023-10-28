<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") { // kalo requestnya bukan post
    exit("POST request method required");
}

print_r($_FILES);  // cek apa aja sih properti $_FILES


// [name] => 5f76248a92a1975c578d70a7_WestStudio-Valorant-47-3790074522.jpg                 << NAMA FILE
// [full_path] => 5f76248a92a1975c578d70a7_WestStudio-Valorant-47-3790074522.jpg            << PATH
// [type] => image/jpeg                                                                     << TIPE FILE
// [tmp_name] => D:\Proggraming\xampp\tmp\php9109.tmp                                       << PENYIMPANAN FILE SEMENTARA dan nama random
// [error] => 0
// [size] => 320763                                                                         << UKURAN
//

//Validate upload error based error code

if ($_FILES["image"]["error"] !== UPLOAD_ERR_OK) { // jika upload tidak ok

    switch ($_FILES["image"]["error"]) {
        case UPLOAD_ERR_PARTIAL:                //
            exit("File Only partially uploaded");
            break;

        case UPLOAD_ERR_NO_FILE:   // tidak ada file yg di upload
            exit("NO FILE WAS UPLOADED");
            break;
        case UPLOAD_ERR_EXTENSION:
            exit("FIle upload stopped by a PHP extension");
            break;
        case UPLOAD_ERR_NO_TMP_DIR:                // tidak ada folder temp
            exit("Temporary folder not found!");
        case UPLOAD_ERR_CANT_WRITE:                // Jika disk penuh
            exit("Failed to w");
        default;
            exit("Unknown upload error");
            break;
    }


    if ($_FILES["image"]["size"] > 1048576) { //jika ukuran file lebih dari 1 mb
        exit("File too large (Max 1MB)"); //code error
    }

    $mime_types = ["image/gif", "image/png", "image/jpeg"]; // yg diperbolehkan upload
    if (!in_array($_FILES["image"]["type"], $mime_types)) { //jika upload file nya selain yg diatas
        exit("Invalid file type");
    }
}
// jika file yg diupload mempunyai special character,dan menghilangkan special character setelah diupload
$pathinfo = pathinfo($_FILES["image"]["name"]); //split file name 
$base = $pathinfo["filename"]; // mendapatkan filename tanpa exstension nya
$base = preg_replace("/[^\W-]/", "_", $base);
$filename = $base . "." . $pathinfo["extension"];



$destination = __DIR__ . "/uploads/" . $filename;  // set lokasi yg mau kita simpan + menambahkan nama file
$hasil =  move_uploaded_file($_FILES["image"]["tmp_name"], $destination); //syntax  untuk memindahkan file dari tmp

//validasi kalo file name nya already exist di destination folder
$i = 1;

while (file_exists($destination)) {
    $filename = $base . "($i)." . $pathinfo["extension"];
    $destination = __DIR__ . "/uploads/" . $filename;

    $i++;
    // jadi akan menambahkan angka 1,2,3
    // contoh fish(1)
    // fish(2)
}



if (!$hasil) { // kalo tidak bisa pindah
    exit("Cant move uploaded file");
} else {
    echo "success";
}
