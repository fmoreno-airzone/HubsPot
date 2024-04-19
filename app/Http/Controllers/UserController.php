<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;

class UserController extends Controller
{
    /**
     * This function is used to fetch contact list from hubspot
     *
     * @param Request $request
     * @return JsonResponse
     **/
    public function userList(Request $request)//: JsonResponse
    {
        try {
            $contacts = collect(getContact());
            $datatablesData = $contacts->map(function ($contact) {
                return [
                    'id' => $contact['id'],
                    'first_name' => $contact['properties']['firstname'] ?? '',
                    'last_name' => $contact['properties']['lastname'] ?? '',
                    'email' => $contact['properties']['email'] ?? '',
                    'createdate' => $contact['properties']['createdate'] ?? '',
                    'lastmodifieddate' => $contact['properties']['lastmodifieddate'] ?? ''
                ];
            });

            if ($request->ajax()) {
               //return DataTables::of($datatablesData)->addIndexColumn()->make(true);
               return 'hasta aquí';
            }
        } catch (\Exception $e) {
            echo 'Error : ' . $e->getMessage();
        }
    }

    /**
     * This function is used to display contact list from hubspot
     *
     * @return View
     **/
    public function displayUser(): View
    {
        return view('home');
    }

    /**
     * This function is used to display signup form for contact
     *
     * @return View
     **/
    public function signupUser(): View
    {
        return view('singup_news');
    }
}

