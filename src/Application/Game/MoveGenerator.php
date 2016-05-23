<?php

namespace Application\Game;

interface MoveGenerator
{
    /**
     * @param Board $board
     * @return Move
     */
    public function generateMove(Board $board);
}
