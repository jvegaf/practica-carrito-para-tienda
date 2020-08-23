<?php


namespace ShoppingCart\Application\UseCases\Client;

use ShoppingCart\Application\Clients\Exceptions\ClientAlreadyExists;
use ShoppingCart\Domain\Entities\Client\Client;
use ShoppingCart\Domain\Entities\Client\ClientRepository;

class RegisterNewClientUseCase
{

    private ClientRepository $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function execute(Client $client): void
    {
        if ($this->clientRepository->exists($client->getEmail()) === true) {
            throw new ClientAlreadyExists();
        }
        $this->clientRepository->add($client);
    }
}