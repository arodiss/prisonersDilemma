<?php

namespace PrisonersDilemma\Strategy;

class TitForTwoTatsStrategy implements StrategyInterface
{
    /** @inheritdoc */
    public function decide(array $ownActions, array $competitorActions)
    {
        $stackLength = count($competitorActions);
        if ($stackLength === 0) {
            return true;
        }
        if ($stackLength === 1) {
            return $competitorActions[$stackLength - 1];
        }

        return $competitorActions[$stackLength - 1] || $competitorActions[$stackLength - 2];
    }

    /** @inheritdoc */
    public function getName()
    {
        return "Tit for two tats";
    }

    /** @inheritdoc */
    public function getDescription()
    {
        return "Tit for tat that switches to defection only after 2 opponent defections";
    }

    /** @inheritdoc */
    public function isRandom()
    {
        return false;
    }
} 
