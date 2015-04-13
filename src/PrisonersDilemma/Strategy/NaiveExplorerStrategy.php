<?php

namespace PrisonersDilemma\Strategy;

class NaiveExplorerStrategy extends TitForTatStrategy
{
    const TRICK_PERCENTAGE = 5;

    /** @inheritdoc */
    public function decide(array $ownActions, array $competitorActions)
    {
        $rightDecision = parent::decide($ownActions, $competitorActions);

        if ($rightDecision && rand(0, 100) < self::TRICK_PERCENTAGE) {
            return false;
        }

        return $rightDecision;
    }

    /** @inheritdoc */
    public function getName()
    {
        return "Naive explorer";
    }

    /** @inheritdoc */
    public function getDescription()
    {
        return "Tit for tat that may randomly switch to defection";
    }

    /** @inheritdoc */
    public function isRandom()
    {
        return true;
    }
} 
