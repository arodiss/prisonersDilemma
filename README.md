# "Iterated Prisoners Dilemma" game emulator

To run the game, call (you need ([composer](https://getcomposer.org) PHP package manager first)

```
composer install
php bin/game.php
```

## What is this?

Prisoner's dilemma is iconic game theory problem, where Paretto-optimality and Nash equilibrium are mutually exclusive.

Iterated prisoner's dilemma is a well-known extension of this problem, where game agents play against each other for several iterations in a row. This setting allows for more complex strategies (also known as agents) to be built. Unlike single-iteration version it generally favors conditional cooperative strategies, as shown by tournament hosted by Robert Axelrod. The conventional wisdon is that the solution for the problem is "Tit for tat" strategy. It is characterized as starting on cooperation and repeating opponent's last move ever after.

Here I added one further step, namely population dynamics. Initially population is evenly split between "contestant" strategies. On each round each population member plays iterated version against each other, earning payoff depending on his actions and opponent's actions. When round is finished, new population is generated and the shares of agent depend on how much payoff did this agent gather on previous round.

Essentially the combinations of agent shares represent a state space of a game, and playing rounds moves game between points in this space, which forms an orbit.

## Simulation parameters

The game has a number of parameters. Different parameter combination correspond to different state space topologies and will make tournament converge in different points in state space.

But even fixing parameter values does not guarantee convergence to the same point from every possible state. State space may have several fixed points, and also game has some random noise, which results in non-deterministic orbits.

Parameters are specified as constants of class `PrisonersDilemma\Game` (src\PrisonersDilemma\Game.php)

Following parameters are available:

- Game length (by default 100 iterations)
- Action payoffs (by default 3/3 for mutual cooperation, 5/0 for one-side cooperation and 1/1 for mutual defection)
- Turn error rate (by default in 5% cases strategy makes mistake and do opposite to what it intends to do)
- Replication error rate (by default 1% of total replication success is allocated randomly)
- Per-strategy properties (like grace rate for `Graceful tit for tat` or analyzed stack length for `Exponential adjuster`)

## Results

With default settings after 1000 generations most successful strategies are "Tit for tat" variations

With all errors set to 0, the winners are "Pavlov" variations ("win - stay, lose - switch")

Generally almost all simulations finish with cooperation rate close to 100%, so every strategy which managed to survive till this point behaves the same and sahres remain constant

## What else?

Interesting thing to try is genetics-based population transition.

I tried to run genetics upon neural networks, and it did not work - averaging NN weights produces nonsense results, and unconditional defectors easily dominate the field.
