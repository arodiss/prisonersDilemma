<?php

namespace PrisonersDilemma\Strategy;

class AdjusterStrategy implements StrategyInterface
{
    const ANALYZED_STACK_LENGTH = 5;

    /** @inheritdoc */
    public function decide(array $ownActions, array $competitorActions)
    {
        $stackLength = count($competitorActions);
        if ($stackLength === 0) {
            return true;
        }

        if ($stackLength <= self::ANALYZED_STACK_LENGTH) {
            return $competitorActions[array_rand($competitorActions)];
        }

        $analyzedActions = array_slice(
            $competitorActions,
            $stackLength - self::ANALYZED_STACK_LENGTH,
            self::ANALYZED_STACK_LENGTH
        );

        return $analyzedActions[array_rand($analyzedActions)];
    }

    /** @inheritdoc */
    public function getName()
    {
        return "Adjuster";
    }

    /** @inheritdoc */
    public function getDescription()
    {
        return "Adjusts defect rate to last 5 opponent's action";
    }

    /** @inheritdoc */
    public function isRandom()
    {
        return true;
    }
} 
