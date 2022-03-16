<?php

namespace App\Repositories;

use App\Models\Client;
use App\Repositories\Contracts\ClientRepositoryInterface;

class ClientRepository implements ClientRepositoryInterface
{

    protected $client;
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function createNewClient($data)
    {
        $data['password'] = bcrypt($data['password']);
        return $this->client->create($data);
    }
    public function getClient(int $id)
    {
        
    }
}