<?php

namespace PrisonersDilemma\Transition;

use PrisonersDilemma\Competitor;

class NoisyReplicatorDynamicsTransition implements TransitionInterface
{
    const DISTORT_RATE = 0.01;

    /** {@inheritdoc} */
    public function getNextPopulation(array $currentPopulation, array $results)
    {
        $newPopulation = [];
        $results = $this->distortResults($results);
        $totalResult = array_sum($results);
        foreach ($currentPopulation as $index => $competitor) {
            $newPopulation[] = new Competitor(
                $competitor->getStrategy(),
                $results[$index] / $totalResult
            );
        }

        return $newPopulation;
    }

    /**
     * @param array $results
     * @return array
     */
    protected function distortResults(array $results)
    {
        $distortion = array_sum($results) * self::DISTORT_RATE;

        for ($i = 0; $i < $distortion; $i++) {
            $results[array_rand($results)] += 1;
        }

        return $results;
    }
}
