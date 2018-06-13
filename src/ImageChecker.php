<?php

namespace Lego\ImageChecker;

class ImageChecker{
    protected $ver;
    public function __construct($path)
    {
        $this->checkHeader($path);
    }
    
    public function checkHeader($path){
        /* Mở file hình ảnh ở chế độ nhị phân */
        if(!$fp = fopen ($path, 'rb')) return 0;

        /* Đọc 20 bytes đầu của file */
        if(!$data = fread ($fp, 20)) return 0;

        /* Khai báo định dạng */
        $header_format = 'A6version';  # Get the first 6 bytes

        /* Unpack (gỉai mã) dữ liệu header */
        $header = unpack ($header_format, $data);
        $this->ver = $header['version'];
    }
    
    public function detectFormat(){
        $class_methods = get_class_methods(self::class);
        foreach ($class_methods as $method_name) {
           if(mb_stripos($method_name,'is') !== false){
               if($this->{$method_name}()) return $method_name;
           }
        }
        return 'Khong doc duoc dinh dang nay';
    }

    public function isGIF()
    {
        return mb_stripos($this->ver,'GIF') !== false;
    }

    public function isPNG()
    {
        return mb_stripos($this->ver,"\x89\x50\x4e") !== false;
    }

    public function isJPG()
    {
        return mb_stripos($this->ver,"\xFF\xD8\xFF") !== false;
    }

    public function isBMP()
    {
        return mb_stripos($this->ver,"BM") !== false;
    }

    public function isPSD()
    {
        return mb_stripos($this->ver,"8BPS") !== false;
    }

    public function isSWF()
    {
        return mb_stripos($this->ver,"FWS") !== false;
    }
}