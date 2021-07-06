<?php
/**
 * {project-name}
 *
 * @author {author-name}
 */
declare(strict_types=1);

namespace App\Database;

use App\Embedded\Signature;
use App\Embedded\SignatureOnDelete;
use Cycle\Annotated\Annotation as Cycle;

/**
 * @Cycle\Entity(
 *     table="currency_pairs",
 *     mapper="App\AuthMapper"
 * )
 */
class CurrencyPair
{
    /**
     * @Cycle\Column(type="primary")
     */
    private $incrementalId = null;

    /**
     * @Cycle\Column(type="uuid", unique=true)
     */
    private $id;

    /**
     * @Cycle\Column(type="string(8)")
     */
    private $baseCurrency;

    /**
     * @Cycle\Column(type="string(8)")
     */
    private $quoteCurrency;

    /**
     * @Cycle\Relation\Embedded(target="App\Embedded\SignatureOnCreate")
     */
    private Signature $created;

    /**
     * @Cycle\Relation\Embedded(target="App\Embedded\SignatureOnUpdate")
     */
    private Signature $updated;

    /**
     * @Cycle\Relation\Embedded(target="App\Embedded\SignatureOnDelete")
     */
    private ?SignatureOnDelete $deleted = null;
}
