<?php

namespace PrisonersDilemma\Strategy;

class RandomStrategy implements StrategyInterface
{
    /** @inheritdoc */
    public function decide(array $ownActions, array $competitorActions)
    {
        return rand(0, 100) > 50;
    }

    /** @inheritdoc */
    public function getName()
    {
        return "Random";
    }

    /** @inheritdoc */
    public function getDescription()
    {
        return "Acts randomly";
    }

    /** @inheritdoc */
    public function isRandom()
    {
        return true;
    }
} 
