<?php

namespace App\Http\Services\Client;

use App\Models\Client as ClientInterface;

class Client
{

    protected $client;
    protected $file_path = 'users';

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function getData()
    {
        return $this->client->all();
    }

    public function createData($request)
    {

        return $this->client->create($request->all());
    }

    public function paginate(object $filters, ?int $quantity_per_page = 5)
    {
        return $this->client->indexFilter($filters, $quantity_per_page);
    }

    public function findOrFail($id)
    {
        $client = $this->client->findOrFail($id);
        return $client;
    }

    public function update($id, $request)
    {
        $client = $this->findOrFail($id, false);
        return $client->update($request->all());
    }
    public function destroy($id)
    {
        $client = $this->findOrFail($id);
        return $client->delete();
    }

    public function getMaritalStatus()
    {
        return $this->client->getMaritalStatus();
    }

    public function removePrefix($value)
    {
        return $this->client->removePrefix($value);
    }
}
