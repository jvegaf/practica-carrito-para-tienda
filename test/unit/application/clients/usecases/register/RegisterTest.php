<?php
declare(strict_types=1);

namespace ShoppingCart\Test\unit\application\clients\usecases\register;

use PHPUnit\Framework\TestCase;
use ShoppingCart\Application\Clients\Exceptions\ClientAlreadyExists;
use ShoppingCart\Application\UseCases\Client\RegisterNewClientUseCase;
use ShoppingCart\Domain\Entities\Client\Client;
use ShoppingCart\Domain\Entities\Client\ClientRepository;

class RegisterTest extends TestCase
{

    /** @test */
    public function ShouldThrowAClientAlreadyExistsException(): void
    {
        $stubRepo = $this->createMock(ClientRepository::class);
        $stubRepo->method('exists')->willReturn(true);
        $registerNewClientUC = new RegisterNewClientUseCase($stubRepo);
        $client = new Client('pp@api.com','pp','pp','','');
        $this->expectException(ClientAlreadyExists::class);
        $registerNewClientUC->execute($client);
    }

    /** @test */
    public function ShouldCanRegisterAClient(): void
    {
        $stubRepo = $this->createMock(ClientRepository::class);
        $stubRepo->method('exists')->willReturn(false);
        $registerNewClientUC = new RegisterNewClientUseCase($stubRepo);
        $client = new Client('pp@api.com','pp','pp','asdas','1235432');
        $result = $registerNewClientUC->execute($client);
        $this->assertEquals(true, $result);
    }

}