<?php

namespace AppBundle\Repository;

use Application\Game\Game;
use Application\Game\GameRepository;
use Doctrine\ORM\EntityRepository;
use Ramsey\Uuid\UuidInterface;
use RuntimeException;

class DoctrineGameRepository extends EntityRepository implements GameRepository
{
    /**
     * @param UuidInterface $id
     * @return Game
     * @throws RuntimeException if game is not found
     */
    public function get(UuidInterface $id)
    {
        $game = $this->find($id->toString());

        if ($game === null) {
            throw new RuntimeException("Game with ID '{$id}' could not be found");
        }

        return $game;
    }

    /**
     * @param Game $game
     * @return void
     */
    public function add(Game $game)
    {
        $this->getEntityManager()->persist($game);
    }
}
