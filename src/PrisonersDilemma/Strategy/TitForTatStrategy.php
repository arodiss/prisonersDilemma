<?php

namespace PrisonersDilemma\Strategy;

class TitForTatStrategy implements StrategyInterface
{
    /** @inheritdoc */
    public function decide(array $ownActions, array $competitorActions)
    {
        if (count($ownActions) === 0) {
            return true;
        }

        return end($competitorActions);
    }

    /** @inheritdoc */
    public function getName()
    {
        return "Tit for tat";
    }

    /** @inheritdoc */
    public function getDescription()
    {
        return "First turn cooperate, then repeat previous action of opponent";
    }

    /** @inheritdoc */
    public function isRandom()
    {
        return false;
    }
} 
