<?php

namespace Application\Game;

use InvalidArgumentException;

class Player
{
    const PLAYER_NAME_X = 'X';
    const PLAYER_NAME_O = 'O';

    /**
     * @var string
     */
    private $name;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        if ($name !== self::PLAYER_NAME_X && $name !== self::PLAYER_NAME_O) {
            throw new InvalidArgumentException("Invalid name for Player: '{$name}'");
        }

        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function isFirstToMove()
    {
        return $this->name === self::PLAYER_NAME_X;
    }
}
