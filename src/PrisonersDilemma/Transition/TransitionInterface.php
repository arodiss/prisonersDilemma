<?php

namespace PrisonersDilemma\Transition;

use PrisonersDilemma\Competitor;

interface TransitionInterface
{
    /**
     * @param Competitor[] $currentPopulation
     * @param array $results
     * @return Competitor[]
     */
    public function getNextPopulation(array $currentPopulation, array $results);
} 
