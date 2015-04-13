<?php

namespace PrisonersDilemma\Strategy;

class UltimateVengenceStrategy implements StrategyInterface
{
    /** @inheritdoc */
    public function decide(array $ownActions, array $competitorActions)
    {
        return false === in_array(false, $competitorActions);
    }

    /** @inheritdoc */
    public function getName()
    {
        return "Vendicator";
    }

    /** @inheritdoc */
    public function getDescription()
    {
        return "Defects if opponents have ever defected";
    }

    /** @inheritdoc */
    public function isRandom()
    {
        return false;
    }
} 
