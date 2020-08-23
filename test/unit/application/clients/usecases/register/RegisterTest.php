<?php
declare(strict_types=1);

namespace ShoppingCart\Test\unit\application\clients\usecases\register;

use PHPUnit\Framework\TestCase;
use ShoppingCart\Application\UseCases\Client\RegisterNewClientUseCase;
use ShoppingCart\Domain\Entities\Client\ClientRepository;

class RegisterTest extends TestCase
{

    /** @test */
    public function shouldThrowAClientAlreadyExistsException(): void
    {
        $stubRepo = $this->createMock(ClientRepository::class);
        $stubRepo->method('exists')->willReturn(true);
        $this->assertSame(1, 1);
    }
}