<?php

namespace App\Controllers;

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;


class QrBarcode extends BaseController
{

    public function index()
    {

     $writer = new PngWriter();

        // Create QR code
     $qrCode = QrCode::create('1234567890')
     ->setEncoding(new Encoding('UTF-8'))
     ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
     ->setSize(300)
     ->setMargin(10)
     ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
     ->setForegroundColor(new Color(0, 0, 0))
     ->setBackgroundColor(new Color(255, 255, 255));

        // Create generic logo
     $logo = Logo::create('upload'.'/logo1.png')
     ->setResizeToWidth(50);

        // Create generic label
     $label = Label::create('1234567890')
     ->setTextColor(new Color(255, 0, 0));

     $result = $writer->write($qrCode, $logo, $label);
     $result->saveToFile('upload/qrcode/' .'1234567890'.'.png');

     $dataUri = $result->getDataUri();
     echo '<img src="'.$dataUri.'" alt="Sobatcoding.com" style="width: 100px">';

 }

}