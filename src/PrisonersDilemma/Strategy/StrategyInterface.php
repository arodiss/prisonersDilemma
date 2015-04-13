<?php

namespace PrisonersDilemma\Strategy;

interface StrategyInterface
{
    /**
     * @param array $ownActions
     * @param array $competitorActions
     * @return bool
     */
    public function decide (array $ownActions, array $competitorActions);

    /** @return string */
    public function getName();

    /** @return string */
    public function getDescription();

    /** @return bool */
    public function isRandom();
}
