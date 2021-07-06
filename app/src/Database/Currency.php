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
 *     table="currencies",
 *     mapper="App\AuthMapper"
 * )
 */
class Currency
{
    /**
     * @Cycle\Column(type="primary")
     */
    private $incrementalId;

    /**
     * @Cycle\Column(type="uuid", unique=true)
     */
    private $id;

    /**
     * @Cycle\Column(type="string(8)")
     */
    private $code;

    /**
     * @Cycle\Column(type="string(32)")
     */
    private $symbol;

    /**
     * @Cycle\Column(type="string(128)")
     */
    private $name;

    /**
     * @Cycle\Column(type="tinyInteger")
     */
    private $decimalDigits;

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
