<?php

namespace Repository;

use Application\Game\Board;
use Application\Game\Move;
use Application\Game\MoveGenerator;
use RuntimeException;

class MoveGeneratorStub implements MoveGenerator
{
    /**
     * @var Move[]
     */
    private $moves;

    /**
     * @param Move[] $moves
     */
    public function __construct(array $moves)
    {
        $this->moves = $moves;
    }

    /**
     * @param Board $board
     * @return Move
     */
    public function generateMove(Board $board)
    {
        if (empty($this->moves)) {
            throw new RuntimeException("No more moves left in MoveGeneratorStub");
        }

        return array_shift($this->moves);
    }
}
