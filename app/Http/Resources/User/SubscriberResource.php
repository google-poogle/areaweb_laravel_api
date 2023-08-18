<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Subscription */
class SubscriberResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->subscriber->id,
            'name' => $this->subscriber->name,
            'email' => $this->subscriber->email,
            'login' => $this->subscriber->login,
            'avatar' => $this->subscriber->avatar,
            'isVerified' => $this->subscriber->is_verified,
            'isSubscribed' => $this->subscriber->isSubscribed(),
        ];
    }
}
