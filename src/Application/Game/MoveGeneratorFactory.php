<?php

namespace Application\Game;

interface MoveGeneratorFactory
{
    /**
     * @return MoveGenerator
     */
    public function create();
}
