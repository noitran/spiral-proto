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
 *     table="rates",
 *     mapper="App\AuthMapper"
 * )
 */
class Rate
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
     * @Cycle\Column(type="decimal(28,14)")
     */
    private $avgRate;

    /**
     * @Cycle\Column(type="decimal(28,14)")
     */
    private $askRate;

    /**
     * @Cycle\Column(type="decimal(28,14)")
     */
    private $bidRate;

    /**
     * @Cycle\Column(type="string(64)", nullable=true)
     */
    private $service;

    /**
     * @Cycle\Column(type="string(64)")
     */
    private $provider;

    /**
     * @Cycle\Column(type="date")
     */
    private $date;

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
