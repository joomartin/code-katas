<?php

use PrimeFactors\PrimeFactors;

require 'vendor/autoload.php';

$primeFactors = new PrimeFactors;
$primeFactors->generate(12);