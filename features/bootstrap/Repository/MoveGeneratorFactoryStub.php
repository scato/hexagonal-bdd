<?php

namespace Repository;

use Application\Game\MoveGenerator;
use Application\Game\MoveGeneratorFactory;

class MoveGeneratorFactoryStub implements MoveGeneratorFactory
{
    /**
     * @var MoveGenerator
     */
    private $moveGenerator;

    /**
     * @param MoveGenerator $moveGenerator
     */
    public function __construct(MoveGenerator $moveGenerator)
    {
        $this->moveGenerator = $moveGenerator;
    }

    /**
     * @return MoveGenerator
     */
    public function create()
    {
        return $this->moveGenerator;
    }
}
