<?php

namespace Application;

use Application\Game\GameFactory;
use Application\Game\GameRepository;
use Application\Game\MoveGeneratorFactory;
use Ramsey\Uuid\UuidFactoryInterface;

class StartGameHandler
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
     * @var GameFactory
     */
    private $gameFactory;

    /**
     * @var MoveGeneratorFactory
     */
    private $moveGeneratorFactory;

    /**
     * @param GameRepository $gameRepository
     * @param UuidFactoryInterface $uuidFactory
     * @param GameFactory $gameFactory
     * @param MoveGeneratorFactory $moveGeneratorFactory
     */
    public function __construct(
        GameRepository $gameRepository,
        UuidFactoryInterface $uuidFactory,
        GameFactory $gameFactory,
        MoveGeneratorFactory $moveGeneratorFactory
    ) {
        $this->gameRepository = $gameRepository;
        $this->uuidFactory = $uuidFactory;
        $this->gameFactory = $gameFactory;
        $this->moveGeneratorFactory = $moveGeneratorFactory;
    }

    public function handle(StartGameCommand $command)
    {
        $gameId = $this->uuidFactory->fromString($command->gameId);
        $playerName = $command->playerName;

        $game = $this->gameFactory->create($gameId, $playerName);
        $game->start($this->moveGeneratorFactory->create());

        $this->gameRepository->add($game);
    }
}
