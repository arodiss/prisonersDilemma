# "Iterational Prisoners Dilemma" game emulator

To run game, just call

```
php bin/game.php
```

# Simulation

You can edit following game parameters which will give advantage to different strategies:
- Game length (by default 100 actions)
- Action payoffs (by default 3/3 for mutual cooperation, 5/0 for one-side cooperation and 1/1 for mutual defection)
- Turn error rate (by default in 5% cases strategy makes mistake and do opposite to what it should do)
- Replication error rate (by default 1% of total win is allocated randomly)
- Per-strategy properties (like grace rate for `Graceful tit for tat` or analyzed stack length for `Exponential adjuster`)

With default settings after 1000 generations most successful strategies are: `Regretting evil tit for tat`, `Graceful tit for tat`, `Tit for two tats`

If you set all errors to 0, then winners will be: `Pavlov`, `Graceful tit for tat`, `Adjuster`

# What else?

Interesting thing to try is genetics-based population transition
