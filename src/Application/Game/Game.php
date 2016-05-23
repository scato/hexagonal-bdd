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
     * @var MoveGenerator
     */
    private $moveGenerator;

    /**
     * @param UuidInterface $id
     * @param Player $humanPlayer
     * @param Board $board
     * @param Player $computerPlayer
     * @param MoveGenerator $moveGenerator
     */
    public function __construct(
        UuidInterface $id,
        Player $humanPlayer,
        Board $board,
        Player $computerPlayer,
        MoveGenerator $moveGenerator
    ) {
        $this->board = $board;
        $this->id = $id;
        $this->humanPlayer = $humanPlayer;
        $this->computerPlayer = $computerPlayer;
        $this->moveGenerator = $moveGenerator;
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
     * @return void
     */
    public function makeHumanMove(Move $move)
    {
        $this->board->makeMove($move, $this->humanPlayer);

        $this->makeComputerMove();
    }

    /**
     * @return Player
     */
    public function getComputerPlayer()
    {
        return $this->computerPlayer;
    }

    /**
     * @return void
     */
    private function makeComputerMove()
    {
        $this->board->makeMove($this->moveGenerator->generateMove($this->board), $this->computerPlayer);
    }

    /**
     * @return void
     */
    public function start()
    {
        if ($this->computerPlayer->isFirstToMove()) {
            $this->makeComputerMove();
        }
    }
}
