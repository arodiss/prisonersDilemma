<?php

namespace PrisonersDilemma;

use PrisonersDilemma\Cache\Cache;
use PrisonersDilemma\Strategy\StrategyInterface;
use PrisonersDilemma\Transition\TransitionInterface;

class Game
{
    const ITERATIONS = 100;

    const MISTAKE_MOVE_PERCENTAGE = 5;

    const COOPERATION_REWARD = 3;
    const SUCKER_PAYOFF = 5;
    const VICTIM_REWARD = 0;
    const DEFECT_REWARD = 1;

    /** @var Competitor[] */
    protected $population = [];

    /** @var Transition\TransitionInterface */
    protected $transition;

    protected $cache;

    /**
     * @param StrategyInterface[] $strategies
     * @param TransitionInterface $transition
     */
    public function __construct($strategies, TransitionInterface $transition)
    {
        $this->cache = new Cache();
        $this->transition = $transition;
        $startPopulation = 1 / count($strategies);
        $competitors = [];

        foreach ($strategies as $strategy) {
            $competitors[] = new Competitor($strategy, $startPopulation);
        }

        $this->population = $competitors;
    }

    /** @return Competitor[] */
    public function getCompetitors()
    {
        return $this->population;
    }

    /** @return Competitor[] */
    public function getOrderedCompetitors($threshold)
    {
        $orderedCompetitors = [];

        foreach ($this->getCompetitors()as $potentialCompetitor) {
            if ($potentialCompetitor->getPopulation() >= $threshold) {
                $orderedCompetitors[] = $potentialCompetitor;
            }
        }

        usort(
            $orderedCompetitors,
            function (Competitor $competitor, Competitor $otherCompetitor) {
                return $competitor->getPopulation() < $otherCompetitor->getPopulation();
            }
        );

        return $orderedCompetitors;
    }

    public function round()
    {
        $strategyResults = [];
        foreach ($this->population as $competitor) {
            $strategyResults[] = $this->calculateStrategyPerformance($competitor->getStrategy()) *
                $competitor->getPopulation();
        }
        $this->population = $this->transition->getNextPopulation($this->population, $strategyResults);

        return $this->getStatus();
    }

    /** @return array */
    public function getStatus()
    {
        $return = [];
        foreach ($this->population as $competitor) {
            $return[] = round($competitor->getPopulation(), 2);
        }

        return $return;
    }

    /**
     * @param StrategyInterface $strategy
     * @return int
     */
    protected function calculateStrategyPerformance(StrategyInterface $strategy)
    {
        $result = 0;
        foreach ($this->population as $competitor) {
            $result += ($this->playAgainst($strategy, $competitor->getStrategy())) * $competitor->getPopulation();
        }

        return $result;
    }

    /**
     * @param StrategyInterface $strategy
     * @param StrategyInterface $competitorStrategy
     * @return int
     */
    protected function playAgainst(StrategyInterface $strategy, StrategyInterface $competitorStrategy)
    {

        if (false === $this->cache->hasCache($strategy, $competitorStrategy)) {
            $this->cache->addCache($strategy, $competitorStrategy);
        }

        return $this->cache->getCache($strategy, $competitorStrategy);
    }
} 
