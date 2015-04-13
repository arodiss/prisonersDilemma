<?php

namespace PrisonersDilemma\Strategy;

class AlwaysDefectStrategy implements StrategyInterface
{
    /** @inheritdoc */
    public function decide(array $ownActions, array $competitorActions)
    {
        return false;
    }

    /** @inheritdoc */
    public function getName()
    {
        return "Defector";
    }

    /** @inheritdoc */
    public function getDescription()
    {
        return "Always defects";
    }

    /** @inheritdoc */
    public function isRandom()
    {
        return false;
    }
} 
