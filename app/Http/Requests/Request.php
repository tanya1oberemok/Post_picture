<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest {
    /**
     * Default authorization rules
     *
     * @return array
     */
    public function rules() {
        return [];
    }

    public function getIncludes(): array {
        $with = $this->header('X-with') ?? $this->query->get('with');
        return $with ? $this->getArrayValue($with, ',') : [];
    }
}
