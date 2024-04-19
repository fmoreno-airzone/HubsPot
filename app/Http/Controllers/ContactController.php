<?php

namespace App\Http\Controllers;

use HubsDom\Services\HubsPotClient;
use Illuminate\Http\JsonResponse;


class ContactController extends Controller
{
    public function __construct(private HubsPotClient $client) {
    }
    public function list(): JsonResponse {
        $data = $this->client->getContacts();
        return new JsonResponse($data);
    }
    public function filtered(): JsonResponse {
        $data = $this->client->filterContactByEmail();
        return new JsonResponse($data);
    }
    public function creation() {
        $this->client->createContact();
    }
    public function update() {
        $this->client->updateContact();
    }
    public function archive() {
        $this->client->archiveContact();
    }
}
