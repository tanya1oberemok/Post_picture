<?php

namespace App\Transformers;

use Laravel\Sanctum\NewAccessToken;

class AccessTokenTransformer extends Transformer
{
    public function transform(NewAccessToken $token)
    {
        return [
            'token' => $token->plainTextToken,
            'name' => $token->accessToken->name,
            'abilities' => $token->accessToken->abilities,
        ];
    }
}
