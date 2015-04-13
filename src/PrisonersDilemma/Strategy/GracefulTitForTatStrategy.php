<?php

namespace PrisonersDilemma\Strategy;

class GracefulTitForTatStrategy implements StrategyInterface
{
    const GRACE_PERCENTAGE = 10;

    /** @inheritdoc */
    public function decide(array $ownActions, array $competitorActions)
    {
        if (count($ownActions) === 0) {
            return true;
        }

        if (end($competitorActions)) {
            return true;
        }

        if (rand(0, 100) < self::GRACE_PERCENTAGE) {
            return true;
        }

        return false;
    }

    /** @inheritdoc */
    public function getName()
    {
        return "Graceful Tit for tat";
    }

    /** @inheritdoc */
    public function getDescription()
    {
        return "Tit for tat with chance to cooperate after opponent's defect";
    }

    /** @inheritdoc */
    public function isRandom()
    {
        return true;
    }
} 
