<?php

namespace Application;

use Application\Game\GameRepository;
use Application\Game\Move;
use Application\Game\MoveGeneratorFactory;
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
     * @var MoveGeneratorFactory
     */
    private $moveGeneratorFactory;

    /**
     * @param GameRepository $gameRepository
     * @param UuidFactoryInterface $uuidFactory
     * @param MoveGeneratorFactory $moveGeneratorFactory
     */
    public function __construct(
        GameRepository $gameRepository,
        UuidFactoryInterface $uuidFactory,
        MoveGeneratorFactory $moveGeneratorFactory
    ) {
        $this->gameRepository = $gameRepository;
        $this->uuidFactory = $uuidFactory;
        $this->moveGeneratorFactory = $moveGeneratorFactory;
    }

    public function handle(MakeMoveCommand $command)
    {
        $gameId = $this->uuidFactory->fromString($command->gameId);
        $game = $this->gameRepository->get($gameId);
        $move = new Move($command->x, $command->y);

        $game->makeHumanMove($move, $this->moveGeneratorFactory->create());
    }
}
