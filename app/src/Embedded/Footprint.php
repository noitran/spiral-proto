<?php

declare(strict_types=1);

namespace App\Embedded;

use Assert\AssertionFailedException;
use JsonSerializable;
use function json_encode;

final class Footprint implements JsonSerializable
{
    private UserId $id;

    private string $party;

    private string $realm;

    /**
     * @throws AssertionFailedException
     */
    public static function random(): self
    {
        return new self(UserId::create(), 'random-party', 'random-realm');
    }

    /**
     * @throws AssertionFailedException
     */
    public static function fromArray(array $data): self
    {
        $userId = UserId::fromString($data['id']);

        return new self($userId, $data['party'], $data['realm']);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id->toString(),
            'party' => $this->party,
            'realm' => $this->realm,
        ];
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function party(): string
    {
        return $this->party;
    }

    public function realm(): string
    {
        return $this->realm;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function __toString()
    {
        return json_encode($this->toArray(), JSON_THROW_ON_ERROR);
    }

    private function __construct(UserId $id, string $party, string $realm)
    {
        $this->id = $id;
        $this->party = $party;
        $this->realm = $realm;
    }
}
