<?php
ini_set("memory_limit", "400M");

function marge()
{

    $putImgSizeX = 1024;
    $putImgSizeY = 768;
    $img = imagecreatetruecolor($putImgSizeX * 7, $putImgSizeY * 5);
    
    imagecolortransparent($img, imagecolorallocate($img, 0, 0, 0));

    $imageList = glob('originalImages/*');
    $positionX = 0;
    $positionY = 0;
    $countX = 0;

    foreach ($imageList as $fn) {
        $img2 = imagecreatefromjpeg($fn);
        [$width, $height] = getimagesize($fn);

        if ($width > $height) {
            $newWidth = $width * ($putImgSizeX / $width);
            $newHeight = $height * ($putImgSizeX / $width);

            if ($newHeight > $putImgSizeY) {
                $newHeight = $height * ($putImgSizeY / $height);
                $newWidth = $width * ($putImgSizeY / $height);
            }
        } elseif ($height >= $width) {
            $newHeight = $height * ($putImgSizeY / $height);
            $newWidth = $width * ($putImgSizeY / $height);
        }

        $putCenterX = ($putImgSizeX - $newWidth) / 2;
        $putCenterY = ($putImgSizeY - $newHeight) / 2;
        $putImg = imagecreatetruecolor($putImgSizeX, $putImgSizeY);
        
        imagecopyresampled($putImg, $img2, $putCenterX, $putCenterY, 0, 0, $newWidth, $newHeight, $width, $height);

        $sx = imagesx($putImg);
        $sy = imagesy($putImg);

        imageLayerEffect($img, IMG_EFFECT_ALPHABLEND);
        imagecopy($img, $putImg, $positionX, $positionY, 0, 0, $sx, $sy);
        imagedestroy($img2);
        imagedestroy($putImg);

        $positionX += $putImgSizeX;
        $countX++;

        if ($countX % 7 == 0) {
            $positionX = 0;
            $positionY += $putImgSizeY;
        }
    }

    imagejpeg($img, "combinedImage.jpg");
    imagedestroy($img);
    echo "marge: Finish\n";
}

echo "marge: before\n";
marge();
echo "exec: before\n";

require "PHP-DeepZoomImageGenerator-master/generate_deep_image.php";
exec('php generate_deep_image.php');
echo "exec: after\n";


// list($width, $hight) = getimagesize('test.jpg'); // 元の画像名を指定してサイズを取得
//     $baseImage = imagecreatefromjpeg('test.jpg'); // 元の画像から新しい画像を作る準備
//     $image = imagecreatetruecolor(100, 100); // サイズを指定して新しい画像のキャンバスを作成
    
//     // 画像のコピーと伸縮
//     imagecopyresampled($image, $baseImage, 0, 0, 0, 0, 100, 100, $width, $hight);
    
//     // コピーした画像を出力する
//     imagejpeg($image , 'new.jpg');



// // 空の画像を作成する
// $img = imagecreatetruecolor(320, 240);
	
// // 背景を透明にする
// imagecolortransparent($img, imagecolorallocate($img, 0, 0, 0));

// // 画像ファイル名群
// $imgFns = array('toumei1.png','toumei2.png','toumei3.png','toumei4.png');

// // シンプルな画像合成
// foreach($imgFns as $fn){
//      $img2 = imagecreatefrompng($fn); // 合成する画像を取り込む

//      // 合成する画像のサイズを取得
//     $sx = imagesx($img2);
//     $sy = imagesy($img2);
    
//     imageLayerEffect($img, IMG_EFFECT_ALPHABLEND);// 合成する際、透過を考慮する
//     imagecopy($img, $img2, 0, 0, 0, 0, $sx, $sy); // 合成する
    
//     imagedestroy($img2); // 破棄
// }

// // 別名で保存
// imagejpeg( $img, "combine.jpg");
// imagedestroy($img);
