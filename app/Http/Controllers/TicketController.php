<?php

namespace App\Http\Controllers;

use HubsDom\Services\HubsPotClient;
use Illuminate\Http\JsonResponse;


class TicketController extends Controller
{
    public function __construct(private HubsPotClient $client) {
    }
    public function list(): JsonResponse {
        $data = $this->client->getTickets();
        return new JsonResponse($data);
    }
    public function filtered(): JsonResponse {
        $data = $this->client->filterTicketById();
        return new JsonResponse($data);
    }
    public function creation() {
        $data = $this->client->createTicket();
    }
    public function update() {
        $this->client->updateTicket();
    }
    public function archive() {
        $this->client->archiveTicket();
    }
}
