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


    public function filtered($id): JsonResponse {
        $data = $this->client->filterTicketById($id);
        return new JsonResponse($data);
    }


    public function creation($content,$hs_pipeline,$hs_pipeline_stage,$hs_ticket_priority,$subject) {
        $data = $this->client->createTicket($content,$hs_pipeline,$hs_pipeline_stage,$hs_ticket_priority,$subject);
    }


    public function update($id,$content,$hs_pipeline,$hs_pipeline_stage,$hs_ticket_priority,$subject) {
        $this->client->updateTicket($id,$content,$hs_pipeline,$hs_pipeline_stage,$hs_ticket_priority,$subject);
    }


    public function archive($id) {
        $this->client->archiveTicket($id);
    }
}
