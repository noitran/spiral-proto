<?php

declare(strict_types=1);

namespace App;

use App\Embedded\Signature;
use Cycle\Annotated\Annotation as ORM;
use Cycle\ORM\Command\CommandInterface;
use Cycle\ORM\Command\ContextCarrierInterface;
use Cycle\ORM\Command\Database\Update;
use Cycle\ORM\Context\ConsumerInterface;
use Cycle\ORM\Heap\Node;
use Cycle\ORM\Heap\State;

/**
 * @ORM\Table(
 *     columns={
 *         "created_at": @ORM\Column(type="datetime"),
 *         "created_by": @ORM\Column(type="json"),
 *         "updated_at": @ORM\Column(type="datetime"),
 *         "updated_by": @ORM\Column(type="json"),
 *         "deleted_at": @ORM\Column(type="datetime", nullable=true),
 *         "deleted_by": @ORM\Column(type="json", nullable=true),
 *     },
 * )
 */
final class AuthMapper extends \Cycle\ORM\Mapper\Mapper
{
    public function queueCreate($entity, Node $node, State $state): ContextCarrierInterface
    {
        $command = parent::queueCreate($entity, $node, $state);

        /** @var Signature $signature */
        $signature = $entity->created();
        $state->register('created_at', $signature->at(), true);
        $command->register('created_at', $signature->at(), true);

        $state->register('created_by', $signature->by(), true);
        $command->register('created_by', $signature->by(), true);

        /** @var Signature $signature */
        $signature = $entity->updated();
        $state->register('updated_at', $signature->at(), true);
        $command->register('updated_at', $signature->at(), true);

        $state->register('updated_by', $signature->by(), true);
        $command->register('updated_by', $signature->by(), true);

        return $command;
    }

    public function queueUpdate($entity, Node $node, State $state): ContextCarrierInterface
    {
        /** @var Signature $signature */
        $signature = $entity->updated();
        /** @var Update $command */
        $command = parent::queueUpdate($entity, $node, $state);

        $state->register('updated_at', $signature->at(), true);
        $command->registerAppendix('updated_at', $signature->at());

        return $command;
    }

    public function queueDelete($entity, Node $node, State $state): CommandInterface
    {
        // Identify entity as being "deleted"
        $state->setStatus(Node::SCHEDULED_DELETE);
        $state->decClaim();

        /** @var Signature $signature */
        $signature = $entity->deleted();
        $command = new Update(
            $this->source->getDatabase(),
            $this->source->getTable(),
            ['deleted_at' => $signature->at(), 'deleted_by' => $signature->by()]
        );

        // Forward primaryKey value from entity state
        // this sequence is only required if the entity is created and deleted
        // within one transaction
        $command->waitScope($this->primaryColumn);
        $state->forward(
            $this->primaryKey,
            $command,
            $this->primaryColumn,
            true,
            ConsumerInterface::SCOPE
        );

        return $command;
    }
}
