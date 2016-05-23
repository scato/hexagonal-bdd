<?php

namespace Application;

use Application\Game\Game;
use Application\Game\GameRepository;
use Ramsey\Uuid\UuidFactoryInterface;

class GetGameHandler
{
    /**
     * @var UuidFactoryInterface
     */
    private $uuidFactory;

    /**
     * @var GameRepository
     */
    private $gameRepository;

    /**
     * @param UuidFactoryInterface $uuidFactory
     * @param GameRepository $gameRepository
     */
    public function __construct(UuidFactoryInterface $uuidFactory, GameRepository $gameRepository)
    {
        $this->uuidFactory = $uuidFactory;
        $this->gameRepository = $gameRepository;
    }

    /**
     * @param GetGameQuery $query
     * @return Game
     */
    public function handle(GetGameQuery $query)
    {
        $gameId = $this->uuidFactory->fromString($query->gameId);

        return $this->gameRepository->get($gameId);
    }
}
