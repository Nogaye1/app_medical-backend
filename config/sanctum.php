<?php

use Laravel\Sanctum\Sanctum;

return [

    /*
    |--------------------------------------------------------------------------
    | Stateful Domains
    |--------------------------------------------------------------------------
    |
    | Les requêtes provenant des domaines ou hôtes suivants recevront des cookies
    | d'authentification API de type "stateful". Incluez ici les domaines de votre
    | application frontend Angular en développement et en production.
    |
    */

    'stateful' => explode(',', env('SANCTUM_STATEFUL_DOMAINS', sprintf(
        '%s%s',
        'localhost,localhost:4200,127.0.0.1,127.0.0.1:8000,::1',
        Sanctum::currentApplicationUrlWithPort()
    ))),

    /*
    |--------------------------------------------------------------------------
    | Sanctum Guards
    |--------------------------------------------------------------------------
    |
    | Ce tableau contient les gardes d'authentification qui seront vérifiés lorsque
    | Sanctum essaie d'authentifier une requête. Le garde "web" est utilisé par défaut.
    |
    */

    'guard' => ['web'],

    /*
    |--------------------------------------------------------------------------
    | Expiration Minutes
    |--------------------------------------------------------------------------
    |
    | Ce paramètre contrôle le nombre de minutes avant l'expiration d'un token émis.
    | Cela affecte les tokens de type "personal access tokens". Pour une expiration
    | automatique, définissez une durée (par exemple, 60 pour une heure).
    |
    */

    'expiration' => 60, // Par exemple, 60 minutes

    /*
    |--------------------------------------------------------------------------
    | Token Prefix
    |--------------------------------------------------------------------------
    |
    | Sanctum peut ajouter un préfixe aux nouveaux tokens pour renforcer la sécurité.
    | Ce préfixe est utile pour repérer facilement les tokens liés à votre projet.
    |
    */

    'token_prefix' => env('SANCTUM_TOKEN_PREFIX', 'myapp'), // Exemple de préfixe

    /*
    |--------------------------------------------------------------------------
    | Sanctum Middleware
    |--------------------------------------------------------------------------
    |
    | Lors de l'authentification de votre SPA Angular avec Sanctum, vous pouvez
    | personnaliser certains des middlewares utilisés par Sanctum pour traiter
    | les requêtes. Utilisez ceux-ci par défaut, sauf besoin spécifique.
    |
    */

    'middleware' => [
        'authenticate_session' => Laravel\Sanctum\Http\Middleware\AuthenticateSession::class,
        'encrypt_cookies' => Illuminate\Cookie\Middleware\EncryptCookies::class,
        'validate_csrf_token' => Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class,
  

    ],
];   