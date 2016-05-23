<?php

namespace Application\Game;

class Board
{
    /**
     * @var string[][]
     */
    private $pieces = array();

    /**
     * @return int
     */
    public function getNumberOfSymbols()
    {
        return array_sum(array_map(function (array $column) {
            return count($column);
        }, $this->pieces));
    }

    /**
     * @param Move $move
     * @param Player $player
     */
    public function makeMove(Move $move, Player $player)
    {
        $this->pieces[$move->getX()][$move->getY()] = $player;
    }
}
