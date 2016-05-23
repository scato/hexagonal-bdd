Feature: Play against the computer
  In order to practice by myself
  As a player
  I want to play against the computer

  Scenario: Choose to go second
    Given I have not started a game yet
    When I start a game as player "O"
    Then I should see a board with one symbol on it

  Scenario: Computer makes the second move
    Given I have started a game as player "X"
    When I make a move
    Then I should see a board with two symbols on it
