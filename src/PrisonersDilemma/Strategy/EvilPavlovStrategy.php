<?php

namespace PrisonersDilemma\Strategy;

class EvilPavlovStrategy implements StrategyInterface
{
    /** @inheritdoc */
    public function decide(array $ownActions, array $competitorActions)
    {
        $stackLength = count($competitorActions);
        if ($stackLength === 0) {
            return false;
        }

        return $ownActions[$stackLength-1] === $competitorActions[$stackLength-1];
    }

    /** @inheritdoc */
    public function getName()
    {
        return "Evil Pavlov";
    }

    /** @inheritdoc */
    public function getDescription()
    {
        return "Pavlov that starts with defection";
    }

    /** @inheritdoc */
    public function isRandom()
    {
        return false;
    }
} 
