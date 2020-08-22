<?php

declare(strict_types=1);


namespace ShoppingCart\Services;


class CanNotLoadImageException extends \Exception
{
    private const MESSAGE = 'Can not load the file %s';

    public static function fromPath(string $imagePath): self
    {
        return new static (\sprintf(self::MESSAGE, $imagePath));
    }
}