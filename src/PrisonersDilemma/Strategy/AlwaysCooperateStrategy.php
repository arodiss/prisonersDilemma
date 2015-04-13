<?php

namespace PrisonersDilemma\Strategy;

class AlwaysCooperateStrategy implements StrategyInterface
{
    /** @inheritdoc */
    public function decide(array $ownActions, array $competitorActions)
    {
        return true;
    }

    /** @inheritdoc */
    public function getName()
    {
        return "Cooperator";
    }

    /** @inheritdoc */
    public function getDescription()
    {
        return "Always cooperates";
    }

    /** @inheritdoc */
    public function isRandom()
    {
        return true;
    }
} 
