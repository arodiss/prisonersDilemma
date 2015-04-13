<?php

namespace PrisonersDilemma\Strategy;

class EvilTitForTatStrategy implements StrategyInterface
{
    /** @inheritdoc */
    public function decide(array $ownActions, array $competitorActions)
    {
        if (count($ownActions) === 0) {
            return false;
        }

        return end($competitorActions);
    }

    /** @inheritdoc */
    public function getName()
    {
        return "Evil Tit for tat";
    }

    /** @inheritdoc */
    public function getDescription()
    {
        return "Tit for tat that starts with defection";
    }

    /** @inheritdoc */
    public function isRandom()
    {
        return false;
    }
} 
