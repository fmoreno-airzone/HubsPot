<?php

namespace HubsDom\Services;

use \HubSpot\Factory as HubsFactory;
use \HubSpot\Discovery\Discovery as Client;
use \HubSpot\Client\Crm\Tickets\Model as TicketModel;
use \HubSpot\Client\Crm\Contacts\Model as ContactModel; //tiene que estAr así, o sinó la ruta completa delante de los métodos, filter, y publicObjectSearchRequest.

class HubsPotClient
{

    private Client $client;
    //ESTE CONTRUCTOR CONTIENE EL KEY CREANDO EL CLIENTE.
    public function __construct() {
        $this->client = HubsFactory::createWithAccessToken(config('services.hubspot.apikey'));
    }


    //DEVUELVE TODOS LOS CONTACTOS.
    public function getContacts() {
        $response = $this->client->crm()->contacts()->basicApi()->getPage(10, false);
        return $response->getResults();
    }
    //DEVUELVE UN CONTACTO FILTRADO POR EMAIL.
    public function filterContactByEmail() {

        $contact = $this->client->crm()->contacts()->basicApi()->getById('6660841437', null, null, null, false, null); //('ddominguez@altracorporacion.com', null, null, null, false, 'email');

        /*      OTRA FORMA DE HACERLO

        $filter = new ContactModel\Filter();
        //FILTRO QUE CONTIENE EL OPERADOR, EL VALOR, Y LA PROPIEDAD A BUSCAR
        $filter
            ->setOperator('EQ')
            ->setPropertyName('email')
            ->setValue('ddominguez@altracorporacion.com');

        $filterGroup = new ContactModel\FilterGroup();
        $filterGroup->setFilters([$filter]);

        $searchRequest = new ContactModel\PublicObjectSearchRequest();
        $searchRequest->setFilterGroups([$filterGroup]);
        // PROPIEDADES QUE QUEREMOS OBTENER
        $searchRequest->setProperties(['firstname', 'lastname', 'date_of_birth', 'email']);

        $contactsPage = $this->client->crm()->contacts()->searchApi()->doSearch($searchRequest);

        return $contactsPage->getResults();*/
        return $contact;
    }
    //CREAMOS UN CONTACTO DATOS HARDCODED.
    public function createContact() {
        $contactInput = new ContactModel\SimplePublicObjectInput();
        $contactInput->setProperties([
            'email' => 'example@exampl1.com',
            'firstname' => 'Juan Domingo1',
            'lastname' => 'Portada1'
        ]);

        $this->client->crm()->contacts()->basicApi()->create($contactInput);
        return ('Contacto creado');
    }
    //CAMBIA LOS DATOS DEL CONTACTO ASOCIADO AL ID.
    public function updateContact() {
        $newProperties = new ContactModel\SimplePublicObjectInput();
        $newProperties->setProperties([
            'email' => 'example@domingo.com',
            'lastname' => 'Portada1'
        ]);

        $this->client->crm()->contacts()->basicApi()->update(6660841437, $newProperties);
        dd('Cambios guardados');
    }
    //ARCHIVA UN CONTACTO MEDIANTE UN ID.
    public function archiveContact() {
        $this->client->crm()->contacts()->basicApi()->archive(8582495966);
        dd('Contacto archivado');
    }


    //DEVUELVE TODOS LOS TICKETS.
    public function getTickets() {
        $response = $this->client->crm()->tickets()->basicApi()->getPage(100, false);
        return $response->getResults();
    }
    //DEVUELVE UN TICKET FILTRADO.
    public function filterTicketById() {

        $ticket = $this->client->crm()->tickets()->basicApi()->getById('2815482867', null, null, null, false, null);
        return $ticket;
        /*
         $filter = new TicketModel\Filter();
         $filter
             ->setOperator('EQ')
             ->setPropertyName('hs_object_id')
             ->setValue('2815482867');

         $filterGroup = new TicketModel\FilterGroup();
         $filterGroup->setFilters([$filter]);

         $searchRequest = new TicketModel\PublicObjectSearchRequest();
         $searchRequest->setFilterGroups([$filterGroup]);

         // Get specific properties
         $searchRequest->setProperties(['hs_object_id','hs_pipeline_stage','hs_ticket_priority','subject','content']);

         // @var CollectionResponseWithTotalSimplePublicObject $contactsPage
         $contactsPage = $this->client->crm()->tickets()->searchApi()->doSearch($searchRequest);
         return $contactsPage->getResults();*/
    }
    //CREAMOS UN TICKET DATOS HARDCODED.
    public function createTicket() {
        $ticketInput = new TicketModel\SimplePublicObjectInput();
        $ticketInput->setProperties([
            'content' => 'Example description 1',
            'hs_pipeline' => '0',
            'hs_pipeline_stage' => '2',
            'hs_ticket_priority' => 'HIGH',
            'subject' => 'This is the subject'
        ]);

        $this->client->crm()->tickets()->basicApi()->create($ticketInput);
        dd('hi');
    }
    //CAMBIA LOS DATOS AL TICKET ASOCIADO AL ID.
    public function updateTicket() {
        $newProperties = new TicketModel\SimplePublicObjectInput();
        $newProperties->setProperties([
            'content' => 'Example description 1',
            'hs_pipeline' => '0',
            'hs_pipeline_stage' => '2',
            'hs_ticket_priority' => 'LOW',
            'subject' => 'This is the subject'
        ]);

        $this->client->crm()->tickets()->basicApi()->update(2888270269, $newProperties);
        dd('Cambios guardados');
    }
    //ARCHIVA UN TICKET MEDIANTE UN ID.
    public function archiveTicket() {
        $this->client->crm()->tickets()->basicApi()->archive(2825356518);
        dd('Ticket archivado');
    }


}
