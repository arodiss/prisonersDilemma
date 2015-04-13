<?php

namespace PrisonersDilemma;

use PrisonersDilemma\Strategy\StrategyInterface;

class Competitor
{
    /** @var Strategy\StrategyInterface */
    protected $strategy;

    /** @var float */
    protected $population;

    /**
     * @param StrategyInterface $strategy
     * @param $population
     */
    public function __construct(StrategyInterface $strategy, $population)
    {
        $this->strategy = $strategy;
        $this->population = $population;
    }

    /** @return Strategy\StrategyInterface */
    public function getStrategy()
    {
        return $this->strategy;
    }

    /** @return float */
    public function getPopulation()
    {
        return $this->population;
    }
} 
