<?php

namespace Application\Game;

use Ramsey\Uuid\UuidInterface;

class Game
{
    /**
     * @var Board
     */
    private $board;

    /**
     * @var UuidInterface
     */
    private $id;

    /**
     * @var Player
     */
    private $humanPlayer;
    
    /**
     * @var Player
     */
    private $computerPlayer;

    /**
     * @param UuidInterface $id
     * @param Player $humanPlayer
     * @param Board $board
     * @param Player $computerPlayer
     */
    public function __construct(
        UuidInterface $id,
        Player $humanPlayer,
        Board $board,
        Player $computerPlayer
    ) {
        $this->board = $board;
        $this->id = $id;
        $this->humanPlayer = $humanPlayer;
        $this->computerPlayer = $computerPlayer;
    }

    /**
     * @return Board
     */
    public function getBoard()
    {
        return $this->board;
    }

    /**
     * @return UuidInterface
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Player
     */
    public function getHumanPlayer()
    {
        return $this->humanPlayer;
    }

    /**
     * @param Move $move
     * @param MoveGenerator $moveGenerator
     */
    public function makeHumanMove(Move $move, MoveGenerator $moveGenerator)
    {
        $this->board->makeMove($move, $this->humanPlayer);

        $this->makeComputerMove($moveGenerator);
    }

    /**
     * @return Player
     */
    public function getComputerPlayer()
    {
        return $this->computerPlayer;
    }

    /**
     * @param MoveGenerator $moveGenerator
     */
    private function makeComputerMove(MoveGenerator $moveGenerator)
    {
        $this->board->makeMove($moveGenerator->generateMove($this->board), $this->computerPlayer);
    }

    /**
     * @param MoveGenerator $moveGenerator
     */
    public function start(MoveGenerator $moveGenerator)
    {
        if ($this->computerPlayer->isFirstToMove()) {
            $this->makeComputerMove($moveGenerator);
        }
    }
}
