<?php

namespace PrisonersDilemma\Cache;

use PrisonersDilemma\Game;
use PrisonersDilemma\Strategy\StrategyInterface;

class Cache
{
    /** @var CacheItem[][] */
    protected $items;

    /**
     * @param StrategyInterface $strategy
     * @param StrategyInterface $competitorStrategy
     * @return bool
     */
    public function hasCache(StrategyInterface $strategy, StrategyInterface $competitorStrategy)
    {
        return isset($this->items[$strategy->getName()][$competitorStrategy->getName()]);
    }

    /**
     * @param StrategyInterface $strategy
     * @param StrategyInterface $competitorStrategy
     */
    public function addCache(StrategyInterface $strategy, StrategyInterface $competitorStrategy)
    {
        list ($result, $competitorResult) = $this->calculatePossibleResults($strategy, $competitorStrategy);
        $this->items[$strategy->getName()][$competitorStrategy->getName()] = $result;
        $this->items[$competitorStrategy->getName()][$strategy->getName()] = $competitorResult;
    }

    /**
     * @param StrategyInterface $strategy
     * @param StrategyInterface $competitorStrategy
     * @return float
     */
    public function getCache(StrategyInterface $strategy, StrategyInterface $competitorStrategy)
    {
        return $this->items[$strategy->getName()][$competitorStrategy->getName()]->getResult();
    }

    /**
     * @param StrategyInterface $strategy
     * @param StrategyInterface $competitorStrategy
     * @return CacheItem[]
     */
    protected function calculatePossibleResults(StrategyInterface $strategy, StrategyInterface $competitorStrategy)
    {
        $results = [];
        $competitorResults = [];
        $games = 1;
        if ($strategy->isRandom()) {
            $games *= 10;
        }
        if ($competitorStrategy->isRandom()) {
            $games *= 10;
        }
        $repeat = intval(1000 / $games);

        for ($i = 0; $i < $games; $i++) {
            list ($result, $competitorResult) = $this->playOneGame($strategy, $competitorStrategy);
            for ($j = 0; $j < $repeat; $j++) {
                $results[] = $result;
                $competitorResults[] = $competitorResult;
            }
        }

        return [
            new CacheItem($results),
            new CacheItem($competitorResults)
        ];
    }

    /**
     * @param StrategyInterface $strategy
     * @param StrategyInterface $competitorStrategy
     * @return array
     */
    protected function playOneGame(StrategyInterface $strategy, StrategyInterface $competitorStrategy)
    {
        $actions = [];
        $competitorActions = [];
        $win = 0;
        $competitorWin = 0;
        for ($i = 0; $i < Game::ITERATIONS; $i++) {
            //get initial action
            $action = $strategy->decide($actions, $competitorActions);
            $competitorAction = $competitorStrategy->decide($competitorActions, $actions);

            //introduce action noise
            if (rand(0, 100) < Game::MISTAKE_MOVE_PERCENTAGE) {
                $action = !$action;
            }
            if (rand(0, 100) < Game::MISTAKE_MOVE_PERCENTAGE) {
                $competitorAction = !$competitorAction;
            }

            //calculate payoff
            if ($action) {
                if ($competitorAction) {
                    $win += Game::COOPERATION_REWARD;
                    $competitorWin += Game::COOPERATION_REWARD;
                } else {
                    $win += Game::VICTIM_REWARD;
                    $competitorWin += Game::SUCKER_PAYOFF;
                }
            } else {
                if ($competitorAction) {
                    $win += Game::SUCKER_PAYOFF;
                    $competitorWin += Game::VICTIM_REWARD;
                } else {
                    $win += Game::DEFECT_REWARD;
                    $competitorWin += Game::DEFECT_REWARD;
                }
            }

            //remember turn actions
            $actions[] = $action;
            $competitorActions[] = $competitorAction;
        }

        return [ $win, $competitorWin ];
    }
} 
