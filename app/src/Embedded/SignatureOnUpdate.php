<?php

declare(strict_types=1);

namespace App\Embedded;

use Cycle\Annotated\Annotation as ORM;
use DateTimeImmutable;

/**
 * @ORM\Embeddable(columnPrefix="updated_")
 */
final class SignatureOnUpdate extends Signature
{
    use Signable;

    public function __construct(DateTimeImmutable $at, Footprint $by)
    {
        parent::__construct($at, $by);

        $this->at = $at;
        $this->by = $by;
    }
}
