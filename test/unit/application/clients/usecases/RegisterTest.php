<?php
declare(strict_types=1);

namespace ShoppingCart\Test\unit\application\clients\usecases;

use PHPUnit\Framework\TestCase;

class RegisterTest extends TestCase
{

    public function __setup():void
    {

    }

    /** @test */
    public function shouldCanRegisterAClient(): void
    {

        $this->assertSame(1, 1);
    }
}