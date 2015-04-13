<?php

namespace PrisonersDilemma\Transition;

use PrisonersDilemma\Competitor;

class ReplicatorDynamicsTransition implements TransitionInterface
{
    /** {@inheritdoc} */
    public function getNextPopulation(array $currentPopulation, array $results)
    {
        $newPopulation = [];
        $totalResult = array_sum($results);
        foreach ($currentPopulation as $index => $competitor) {
            $newPopulation[] = new Competitor(
                $competitor->getStrategy(),
                $results[$index] / $totalResult
            );
        }

        return $newPopulation;
    }
} 
