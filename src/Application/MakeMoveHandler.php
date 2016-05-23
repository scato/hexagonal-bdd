<?php

namespace Application;

use Application\Game\GameRepository;
use Application\Game\Move;
use Ramsey\Uuid\UuidFactoryInterface;

class MakeMoveHandler
{
    /**
     * @var GameRepository
     */
    private $gameRepository;

    /**
     * @var UuidFactoryInterface
     */
    private $uuidFactory;

    /**
     * @param GameRepository $gameRepository
     * @param UuidFactoryInterface $uuidFactory
     */
    public function __construct(GameRepository $gameRepository, UuidFactoryInterface $uuidFactory)
    {
        $this->gameRepository = $gameRepository;
        $this->uuidFactory = $uuidFactory;
    }

    public function handle(MakeMoveCommand $command)
    {
        $gameId = $this->uuidFactory->fromString($command->gameId);
        $game = $this->gameRepository->get($gameId);
        $move = new Move($command->x, $command->y);

        $game->makeHumanMove($move);
    }
}
