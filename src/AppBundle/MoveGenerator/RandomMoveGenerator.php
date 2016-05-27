<?php

namespace AppBundle\MoveGenerator;

use Application\Game\Board;
use Application\Game\Move;
use Application\Game\MoveGenerator;

class RandomMoveGenerator implements MoveGenerator
{
    /**
     * @param Board $board
     * @return Move
     */
    public function generateMove(Board $board)
    {
        // TODO: avoid occupied positions
        
        return new Move(rand(0, 2), rand(0, 2));
    }
}
