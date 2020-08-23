<?php

declare(strict_types=1);


namespace ShoppingCart\Services\ImageBase64;


class CanNotLoadImageException extends \Exception
{
    private const MESSAGE = 'Can not load the file %s';

    /**
     * @param string $imagePath
     * @return static
     */
    public static function fromPath(string $imagePath): self
    {
        return new static (\sprintf(self::MESSAGE, $imagePath));
    }
}