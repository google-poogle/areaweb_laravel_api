<?php

namespace App\Services\Post\Data;

use Spatie\LaravelData\Data;

class AddCommentData extends Data
{
    public function __construct(
        public int $user_id,
        public string $comment
    ) {
    }
}
