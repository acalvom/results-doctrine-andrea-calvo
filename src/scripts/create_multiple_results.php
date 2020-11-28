<?php

/**
 * PHP version 7.4
 * src/create_result.php
 *
 * @category Utils
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://www.etsisi.upm.es/ ETS de Ingeniería de Sistemas Informáticos
 */

use MiW\Results\Entity\Result;
use MiW\Results\Entity\User;
use MiW\Results\Utility\Utils;

require __DIR__ . '/../../vendor/autoload.php';

Utils::loadEnv(__DIR__ . '/../../');

$entityManager = Utils::getEntityManager();

if ($argc < 3) {
    $fich = basename(__FILE__);
    echo <<< MARCA_FIN

    Usage: $fich <NewResult> <NewResult> [--json]
    NewResult = <Result>,<UserId>,[<Timestamp>]
    At least two results required

MARCA_FIN;
    exit(0);
}

if(end($argv) === '--json'){
    $lengthArgv = $argc - 2;
} else {
    $lengthArgv = $argc - 1;
}

for ($i = 1; $i <= $lengthArgv ; $i++) {
    $parameters = explode(",", $argv[$i]);
    $newResult    = (int) $parameters[0];
    $userId       = (int) $parameters[1];
    $lengthParameters = count($parameters);

    if($lengthParameters == 2){
        $newTimestamp = new DateTime('now');
    }else {
        $newTimestamp = $parameters[2];
    }

    /** @var User $user */
    $user = $entityManager
        ->getRepository(User::class)
        ->findOneBy(['id' => $userId]);
    if (null === $user) {
        echo "User $userId not found" . PHP_EOL;
        exit(0);
    }
    $result = new Result($newResult, $user, $newTimestamp);
    $entityManager->persist($result);
    $entityManager->flush();

    if (in_array('--json', $argv)) {
        echo json_encode($result, JSON_PRETTY_PRINT);
    } else {
        echo 'Created Result with Id ' . $result->getId()
            . ' for USER ' . $user->getUsername() . PHP_EOL;
    }
}