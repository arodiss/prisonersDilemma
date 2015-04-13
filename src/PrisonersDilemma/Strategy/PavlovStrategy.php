<?php

namespace PrisonersDilemma\Strategy;

class PavlovStrategy implements StrategyInterface
{
    /** @inheritdoc */
    public function decide(array $ownActions, array $competitorActions)
    {
        $stackLength = count($competitorActions);
        if ($stackLength === 0) {
            return true;
        }

        return $ownActions[$stackLength-1] === $competitorActions[$stackLength-1];
    }

    /** @inheritdoc */
    public function getName()
    {
        return "Pavlov";
    }

    /** @inheritdoc */
    public function getDescription()
    {
        return "Win - stay, loose - switch";
    }

    /** @inheritdoc */
    public function isRandom()
    {
        return false;
    }
} 
