<?php

declare(strict_types=1);


namespace ShoppingCart\Services\ImageBase64;


class ImageToBase64Encoder
{
    private string $imgPath;

    public function __construct(string $imgPath)
    {
        $this->imgPath = $imgPath;
    }


    public function execute(): string
    {
        $imgData = file_get_contents($this->imgPath);
        if (!$imgData) throw CanNotLoadImageException::fromPath($this->imgPath);

        $type = pathinfo($this->imgPath, PATHINFO_EXTENSION);
        return 'data:image/' . $type . ';base64,' . base64_encode($imgData);
    }
}