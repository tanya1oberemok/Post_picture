<?php

namespace App\Transformers;

use App\Models\User;

class UserTransformer extends Transformer {

    protected $availableIncludes = [
        'access_token',
        ];

    public function transform(User $user) {


        return [
            'id'         => $user->id,
            'name'       => $user->name,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
        ];
    }

    public function includeAccessToken(User $user) {
        return $this->itemOrNull($user->currentAccessToken(), new AccessTokenTransformer());
    }
}
