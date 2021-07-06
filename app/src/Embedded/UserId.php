<?php

declare(strict_types=1);

namespace App\Embedded;

use Assert\Assertion;
use Assert\AssertionFailedException;
use EventSauce\EventSourcing\AggregateRootId;
use Ramsey\Uuid\Uuid;

class UserId implements AggregateRootId
{
    protected string $id;

    /**
     * @throws AssertionFailedException
     */
    public static function create(): self
    {
        return new self(Uuid::uuid4()->toString());
    }

    /**
     * @throws AssertionFailedException
     */
    public static function fromString(string $aggregateRootId): AggregateRootId
    {
        return new self($aggregateRootId);
    }

    public function equals(self $entityId): bool
    {
        return $this->id === $entityId->id;
    }

    public function toString(): string
    {
        return $this->id;
    }

    #[Pure]
    public function __toString(): string
    {
        return $this->toString();
    }

    /**
     * @throws AssertionFailedException
     */
    protected function assertValidId(string $id): void
    {
        Assertion::uuid($id);
    }

    /**
     * @throws AssertionFailedException
     */
    private function __construct(string $id)
    {
        $this->assertValidId($id);

        $this->id = $id;
    }
}
