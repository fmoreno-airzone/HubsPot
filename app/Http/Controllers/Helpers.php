<?php

use App\Models\HubspotContact;
use HubSpot\Client\Crm\Contacts\Model\SimplePublicObjectInput;
use HubSpot\Factory;
use HubSpot\Client\Crm\Contacts\ApiException;


if (!function_exists('getContact')) {

    function getContact()
    {
        $client = Factory::createWithAccessToken(env('HUBSPOT_ACCESS_TOKEN'));
        try {
            $apiResponse = $client->crm()->contacts()->basicApi()->getPage(100,true);
            return $apiResponse['results'];
        } catch (ApiException $e) {
            echo "Exception when calling basic_api->get_page: ", $e->getMessage();
        }
    }
}

