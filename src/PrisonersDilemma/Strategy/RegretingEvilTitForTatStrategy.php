<?php

namespace PrisonersDilemma\Strategy;

class RegretingEvilTitForTatStrategy implements StrategyInterface
{
    /** @inheritdoc */
    public function decide(array $ownActions, array $competitorActions)
    {
        $stackLength = count($ownActions);
        if ($stackLength === 0) {
            return false;
        }

        if ($stackLength >= 2 && $competitorActions[$stackLength-1] === false && $ownActions[$stackLength-2] === false) {
            return true;
        }

        return $competitorActions[$stackLength-1];
    }

    /** @inheritdoc */
    public function getName()
    {
        return "Regreting evil Tit for tat";
    }

    /** @inheritdoc */
    public function getDescription()
    {
        return "Evil Tit for tat that will switch back to cooperation if opponent switched";
    }

    /** @inheritdoc */
    public function isRandom()
    {
        return false;
    }
} 
