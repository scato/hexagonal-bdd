<?php

namespace Application;

use Application\Game\GameFactory;
use Application\Game\GameRepository;
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
     * @param GameRepository $gameRepository
     * @param UuidFactoryInterface $uuidFactory
     * @param GameFactory $gameFactory
     */
    public function __construct(GameRepository $gameRepository, UuidFactoryInterface $uuidFactory, GameFactory $gameFactory)
    {
        $this->gameRepository = $gameRepository;
        $this->uuidFactory = $uuidFactory;
        $this->gameFactory = $gameFactory;
    }

    public function handle(StartGameCommand $command)
    {
        $gameId = $this->uuidFactory->fromString($command->gameId);
        $playerName = $command->playerName;

        $game = $this->gameFactory->create($gameId, $playerName);
        $game->start();

        $this->gameRepository->add($game);
    }
}
