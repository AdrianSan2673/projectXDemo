<?php

require_once './libraries/phpqrcode/qrlib.php';

class SOIQR {
    private $black;
    private $white;
    private $gray;
    private $navy;
    private $orange;
    private $green;
    private $pink;
    private $blue;
    
    private $navyPolygon;
    private $orangePolygon;
    private $greenPolygon;
    private $blueRectangle;

    private $fontJosefina;
    private $fontJosefinaBold;
    private $fontAbhaya;
    private $fontLeague;

    public $image;

    public function credencial($candidato_datos, $vl, $perfil){
        $nombre = ($candidato_datos->Nombres.' '.$candidato_datos->Apellido_Paterno.' '.$candidato_datos->Apellido_Materno);
        $folio = $candidato_datos->Candidato;
        if (!$perfil) {
            if ($candidato_datos->Sexo == 99)
                $perfil = dirname(__FILE__).'\..\..\dist\img\user-icon-rose.png';
            else
                $perfil = dirname(__FILE__).'\..\..\dist\img\user-icon.png';
            
            $foto = imagecreatefrompng($perfil);
        }else{
            $perfil = base64_decode(str_replace('data://text/plain;base64, ', '', $perfil[0]));
            $foto = imagecreatefromstring($perfil);
        }
        

        $dir = './libraries/phpqrcode/tmp/';
        if (!file_exists($dir))
            mkdir($dir);
        $qrFile = 'qr'. uniqid() .'.png';
        $urlSOI = 'https://rrhh-ingenia.com.mx/formato/soi&candidato='.Encryption::encode($folio);

        QRcode::png($urlSOI, $dir.$qrFile, 'M', 8, 2);

        $this->image = imagecreatetruecolor(1011, 639);

        $this->black = imagecolorallocate($this->image, 0, 0, 0);
        $this->white = imagecolorallocate($this->image, 255, 255, 255);
        $this->gray = imagecolorallocate($this->image, 84, 84, 84);
        $this->navy = imagecolorallocate($this->image, 25, 25, 46);
        $this->orange = imagecolorallocate($this->image, 221, 136, 46);
        $this->green = imagecolorallocate($this->image, 172, 202, 74);
        $this->pink = imagecolorallocate($this->image, 190, 71, 149);
        $this->blue = imagecolorallocate($this->image, 70, 125, 185);
        
        $dirLogo = dirname(__FILE__).'\..\..\dist\img\imagotipo-colores-2.png';
        $logo = imagescale(imagecreatefrompng($dirLogo), 400);
        
        $dirBanner = dirname(__FILE__).'\..\..\dist\img\s.png';
        $banner = imagescale(imagecreatefrompng($dirBanner), 631);

        $this->fontJosefina = dirname(__FILE__).'\..\..\dist\fonts\JosefinSans-Regular.TTF';
        $this->fontJosefinaBold = dirname(__FILE__).'\..\..\dist\fonts\JosefinSans-Bold.TTF';
        $this->fontAbhaya = dirname(__FILE__).'\..\..\dist\fonts\AbhayaLibre-Regular.TTF';
        $this->fontLeague = dirname(__FILE__).'\..\..\dist\fonts\LeagueSpartan-Bold.TTF';
        
        $dirQR = dirname(__FILE__).'\..\..\libraries\phpqrcode\tmp\\'.$qrFile;
        $qr = imagescale(imagecreatefrompng($dirQR), 165);

        $this->navyPolygon = array(
            0, 0,
            420, 0,
            490, 160,
            0, 160
        );
        $this->orangePolygon = array(
            0, 575,
            730, 575,
            800, 610,
            0, 610
        );
        $this->greenPolygon = array(
            760, 575,
            1011, 575,
            1011, 610,
            830, 610
        );
        $this->blueRectangle = array(
            690, 50,
            940, 50,
            940, 300,
            690, 300
        );

        imagefill($this->image, 0, 0, $this->white);
        imagecopy($this->image, $banner, 400, -125, 0, 0, imagesx($banner), 280);
        imagefilledpolygon($this->image, $this->navyPolygon, 4, $this->navy);
        imagefilledpolygon($this->image, $this->orangePolygon, 4, $this->orange);
        imagefilledpolygon($this->image, $this->greenPolygon, 4, $this->green);
        imagecopy($this->image, $logo, 20, 30, 0, 0, imagesx($logo), imagesy($logo));

        imagettftext($this->image, 18.6, 0, 60, 200, $this->black, $this->fontJosefinaBold, 'CURP');
        imagettftext($this->image, 18.6, 0, 60, 240, $this->black, $this->fontJosefinaBold, 'NSS ');
        if ($vl) {
            imagettftext($this->image, 18.6, 0, 60, 280, $this->black, $this->fontJosefinaBold, 'Emisión');
            imagettftext($this->image, 18.6, 0, 60, 320, $this->black, $this->fontJosefinaBold, 'Vence');
            imagettftext($this->image, 18.6, 0, 60, 360, $this->black, $this->fontJosefinaBold, 'No. Licencia');
        }

        imagettftext($this->image, 18.6, 0, 250, 200, $this->black, $this->fontJosefina, ': '.$candidato_datos->CURP);
        imagettftext($this->image, 18.6, 0, 250, 240, $this->black, $this->fontJosefina, ': '.$candidato_datos->IMSS);
        if ($vl) {
            imagettftext($this->image, 18.6, 0, 250, 280, $this->black, $this->fontJosefina, ': '.$vl->Licencia_Vigente_Del);
            imagettftext($this->image, 18.6, 0, 250, 320, $this->black, $this->fontJosefina, ': '.$vl->Licencia_Vigente_Hasta);
            imagettftext($this->image, 18.6, 0, 250, 360, $this->black, $this->fontJosefina, ': '.$vl->Numero_Licencia);
        }
            
        if ($vl) {
            imagettftext($this->image, 18.6, 0, 230, 480, $this->black, $this->fontJosefinaBold, 'Tipo:');
            imagettftext($this->image, 33.36, 0, 330, 485, $this->pink, $this->fontLeague, (($vl->CategoriaA == 1 ? 'A ' : '').($vl->CategoriaB == 1 ? 'B ' : '').($vl->CategoriaC == 1 ? 'C ' : '').($vl->CategoriaD == 1 ? 'D ' : '').($vl->CategoriaE == 1 ? 'E ' : '').($vl->CategoriaF == 1 ? 'F ' : '')));
        }
            
        imagecopy($this->image, $qr, 25, 440, 0, 0, imagesx($qr), imagesy($qr));
        unlink($dir.$qrFile);

        imagettftext($this->image, 14.7, 0, 780, 565, $this->black, $this->fontJosefinaBold, 'FOLIO');

        imagettftext($this->image, 22.2, 0, 830, 600, $this->black, $this->fontJosefinaBold, $folio);

        imagefilledpolygon($this->image, $this->blueRectangle, 4, $this->blue);

        if (imagesx($foto) > imagesy($foto)) {
            $foto = imagescale($foto, imagesx($foto) * 230 / imagesy($foto), 230);
            imagecopy($this->image, $foto, 700, 60, (imagesx($foto) - 230) / 2, 0, 230, imagesy($foto));
        }else{
            $foto = imagescale($foto, 230);
            imagecopy($this->image, $foto, 700, 60, 0, 0, imagesx($foto), 230);
        }

        

        $bbox = imageftbbox(26.09, 0, $this->fontJosefinaBold, $nombre);
        $x = (505 - abs($bbox[2] - $bbox[0])) / 2 + 495;
        $y = 340;
        imagettftext($this->image, 26.09, 0, $x, $y, $this->black, $this->fontJosefinaBold, $nombre);

        imagettftext($this->image, 18.6, 0, 750, 375, $this->black, $this->fontJosefina, 'Operador');

        imagettftext($this->image, 22.2, 0, 550, 445, $this->gray, $this->fontAbhaya, 'SOI (Safe Operator By Ingenia)');

        imagettftext($this->image, 20, 0, 220, 600, $this->white, $this->fontJosefina, 'www.rrhh-ingenia.com.mx');
        
        //header('Content-Type: image/png');
        imagepng($this->image, './uploads/soi/'.$folio.'.png');
    }
}