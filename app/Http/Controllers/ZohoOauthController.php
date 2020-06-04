<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use zcrmsdk\crm\setup\restclient\ZCRMRestClient;
use zcrmsdk\oauth\ZohoOAuth;

class ZohoOauthController extends Controller
{
    /**
     * Handle the OAuth for Zoho.
     * @param  string  $grant_token
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|View
     */
    public function __invoke(string $grant_token)
    {
        $configuration = [
            "client_id"			=> 	'1000.A17M9ZGQRZEFDIFEM9TQ378I3NF9PH',
            "client_secret"		=> 	'b76bd9cb9e10d4982762c7c1812ded35cb54d5404f',
            "redirect_uri"		=>	'http://dummy_address',
            "currentUserEmail"	=>	'p.golon@blowstack.com',
            "token_persistence_path" =>"/home/blowstack/Projects/boilerplates/zoho_crm_laravel/config/Zoho"
        ];

        try {
            ZCRMRestClient::initialize($configuration);
            $oAuthClient = ZohoOAuth::getClientInstance();
            $grantToken = $grant_token;
            $oAuthTokens = $oAuthClient->generateAccessToken($grantToken);
            $result = 'success';
        }
        catch (\Exception $exception) {
            $result = $exception;
        }

        return view('zoho_oauth', ['result' => $result]);
    }
}
