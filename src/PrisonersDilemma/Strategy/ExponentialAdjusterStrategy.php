<?php

namespace PrisonersDilemma\Strategy;

class ExponentialAdjusterStrategy implements StrategyInterface
{
    const ANALYZED_STACK_LENGTH = 5;

    /** @inheritdoc */
    public function decide(array $ownActions, array $competitorActions)
    {
        $stackLength = count($competitorActions);
        if ($stackLength === 0) {
            return true;
        }

        $cooperateWeight = 0;
        $defectWeight = 0;
        for ($i = 0; $i < self::ANALYZED_STACK_LENGTH &&  $i < $stackLength; $i++) {
            if ($competitorActions[$stackLength - 1 - $i]) {
                $cooperateWeight += 1 / pow(2, $i);
            } else {
                $defectWeight += 1 / pow(2, $i);
            }
        }

        $defectWeight *= 1000;
        $cooperateWeight *= 1000;

        return rand(0, $defectWeight + $cooperateWeight) > $defectWeight;
    }

    /** @inheritdoc */
    public function getName()
    {
        return "Exponential adjuster";
    }

    /** @inheritdoc */
    public function getDescription()
    {
        return "Adjusts defect rate to last opponent's action with more recent actions having more weight";
    }

    /** @inheritdoc */
    public function isRandom()
    {
        return true;
    }
} 
