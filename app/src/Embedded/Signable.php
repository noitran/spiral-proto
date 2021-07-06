<?php

declare(strict_types=1);

namespace App\Embedded;

use Assert\Assert;
use Assert\AssertionFailedException;
use Cycle\Annotated\Annotation as ORM;
use DateTimeImmutable;
use Exception;
use JsonException;
use function is_string;
use function json_decode;

trait Signable
{
    /**
     * @ORM\Column(type="datetime")
     */
    private ?DateTimeImmutable $at;

    /**
     * @var string
     * @ORM\Column(type="json")
     */
    private $by;

    /**
     * @throws AssertionFailedException
     */
    public static function random(): self
    {
        return new self(new DateTimeImmutable(), Footprint::random());
    }

    /**
     * @throws Exception|AssertionFailedException
     */
    public static function fromArray(array $data): self
    {
        Assert::that($data)
            ->keyExists('at')
            ->keyExists('by')
        ;

        return new self(
            new DateTimeImmutable($data['at']),
            Footprint::fromArray($data['by']),
        );
    }

    public function defined(): bool
    {
        return isset($this->at, $this->by);
    }

    public function at(): DateTimeImmutable
    {
        return $this->at;
    }

    /**
     * @throws AssertionFailedException|JsonException
     */
    public function by(): Footprint
    {
        if (is_string($this->by)) {
            return Footprint::fromArray(
                json_decode($this->by, true, 512, JSON_THROW_ON_ERROR)
            );
        }

        return $this->by;
    }

    public function toArray(): array
    {
        return [
            'at' => $this->at->format(DateTimeImmutable::RFC3339_EXTENDED),
            'by' => $this->by->toArray(),
        ];
    }
}
