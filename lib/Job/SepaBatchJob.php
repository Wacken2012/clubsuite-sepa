<?php
namespace OCA\ClubSuiteSepa\Job;

use OCP\BackgroundJob\TimedJob;

class SepaBatchJob extends TimedJob {
    public function __construct() { parent::__construct(); }
    public function run($argument) {
        // placeholder: build payment batches, validate mandates, generate pain.008
    }
}
