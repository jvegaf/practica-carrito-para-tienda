<?php


namespace ShoppingCart\Application\UseCases\Client;

use ShoppingCart\Domain\Entities\Client\Client;
use ShoppingCart\Domain\Entities\Client\ClientRepository;
use ShoppingCart\Application\Clients\Exceptions\ClientAlreadyExists;

class RegisterNewClientUseCase
{

    private ClientRepository $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    /**
     * @param Client $client
     * @return bool
     * @throws ClientAlreadyExists
     */
    public function execute(Client $client): bool
    {
        if ($this->clientRepository->exists($client->getEmail()) !== false) {
            throw new ClientAlreadyExists();
        }
        $this->clientRepository->add($client);
        return true;
    }
}