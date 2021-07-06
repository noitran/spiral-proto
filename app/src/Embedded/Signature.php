<?php

declare(strict_types=1);

namespace App\Embedded;

use DateTimeImmutable;

class Signature
{
    use Signable;

    public function __construct(DateTimeImmutable $at, Footprint $by)
    {
        $this->at = $at;
        $this->by = $by;
    }
}
