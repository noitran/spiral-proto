<?php

declare(strict_types=1);

namespace App\Embedded;

use Cycle\Annotated\Annotation as ORM;
use DateTimeImmutable;

/**
 * @ORM\Embeddable(columnPrefix="deleted_")
 */
final class SignatureOnDelete extends Signature
{
    use Signable;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?DateTimeImmutable $at;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $by;

    public function __construct(DateTimeImmutable $at, Footprint $by)
    {
        parent::__construct($at, $by);

        $this->at = $at;
        $this->by = $by;
    }
}
