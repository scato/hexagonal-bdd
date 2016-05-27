<?php

namespace Application;

use Application\Game\GameFactory;
use Application\Game\GameRepository;
use Application\Game\MoveGenerator;
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
     * @var MoveGenerator
     */
    private $moveGenerator;

    /**
     * @param GameRepository $gameRepository
     * @param UuidFactoryInterface $uuidFactory
     * @param GameFactory $gameFactory
     * @param MoveGenerator $moveGenerator
     */
    public function __construct(
        GameRepository $gameRepository,
        UuidFactoryInterface $uuidFactory,
        GameFactory $gameFactory,
        MoveGenerator $moveGenerator
    ) {
        $this->gameRepository = $gameRepository;
        $this->uuidFactory = $uuidFactory;
        $this->gameFactory = $gameFactory;
        $this->moveGenerator = $moveGenerator;
    }

    public function handle(StartGameCommand $command)
    {
        $gameId = $this->uuidFactory->fromString($command->gameId);
        $playerName = $command->playerName;

        $game = $this->gameFactory->create($gameId, $playerName);
        $game->start($this->moveGenerator);

        $this->gameRepository->add($game);
    }
}
