<?php

use PrisonersDilemma\Strategy as Strategy;
use PrisonersDilemma\Transition as Transition;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Helper\Table;
use PrisonersDilemma\Game;

$loader = require_once __DIR__.'/../vendor/autoload.php';
$loader->register(true);

$input = new ArgvInput();
$output = new ConsoleOutput();
$generations = 100;


//todo input and it's validation
$strategies = [
    new Strategy\RandomStrategy(),
    new Strategy\AlwaysCooperateStrategy(),
    new Strategy\AlwaysDefectStrategy(),
    new Strategy\UltimateVengenceStrategy(),
    new Strategy\TitForTatStrategy(),
    new Strategy\TitForTwoTatsStrategy(),
    new Strategy\GracefulTitForTatStrategy(),
    new Strategy\EvilTitForTatStrategy(),
    new Strategy\RegretingEvilTitForTatStrategy(),
    new Strategy\NaiveExplorerStrategy(),
    new Strategy\PavlovStrategy(),
    new Strategy\EvilPavlovStrategy(),
    new Strategy\AdjusterStrategy(),
    new Strategy\ExponentialAdjusterStrategy(),
];
$game = new Game(
    $strategies,
    new Transition\NoisyReplicatorDynamicsTransition()
);
$output->writeln(sprintf(
    "<info>Prisoner's dilemma simulation started for %s strategies</info>",
    count($strategies)
));

$output->writeln("<info>Participants:</info>");
$table = new Table($output);
$table->setHeaders(["Index", "Name", "Description"]);
foreach ($game->getCompetitors() as $index => $competitor) {
    $table->addRow([
        $index,
        $competitor->getStrategy()->getName(),
        $competitor->getStrategy()->getDescription()
    ]);
}
$table->render();

$output->writeln("<info>Competition flow:</info>");

$table = new Table($output);
$table->setHeaders(array_merge(
    ["round"],
    range(0, count($game->getCompetitors()) - 1)
));
$table->addRow(array_merge([0], $game->getStatus()));

for ($i=0; $i<$generations; $i++) {
    $table->addRow(array_merge([$i+1], $game->round()));
}
$table->render($output);

$output->writeln(sprintf("<info>State after %s generations:</info>", $generations));
$table = new Table($output);
$table->setHeaders(["Place", "Strategy", "Population"]);
foreach ($game->getOrderedCompetitors(0.01) as $index => $competitor) {
    $table->addRow([
        $index + 1,
        $competitor->getStrategy()->getName(),
        round($competitor->getPopulation() * 100) . "%"
    ]);
}
$table->render();

$output->writeln("<info>Simulation completed</info>");
