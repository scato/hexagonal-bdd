<?php

namespace Application;

use Application\Game\GameRepository;
use Application\Game\Move;
use Application\Game\MoveGenerator;
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
     * @var MoveGenerator
     */
    private $moveGenerator;

    /**
     * @param GameRepository $gameRepository
     * @param UuidFactoryInterface $uuidFactory
     * @param MoveGenerator $moveGenerator
     */
    public function __construct(
        GameRepository $gameRepository,
        UuidFactoryInterface $uuidFactory,
        MoveGenerator $moveGenerator
    ) {
        $this->gameRepository = $gameRepository;
        $this->uuidFactory = $uuidFactory;
        $this->moveGenerator = $moveGenerator;
    }

    public function handle(MakeMoveCommand $command)
    {
        $gameId = $this->uuidFactory->fromString($command->gameId);
        $game = $this->gameRepository->get($gameId);
        $move = new Move($command->x, $command->y);

        $game->makeHumanMove($move, $this->moveGenerator);
    }
}
