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

// Carga las variables de entorno
Utils::loadEnv(__DIR__ . '/../../');

$entityManager = Utils::getEntityManager();

if ($argc < 3 || $argc > 4) {
    $fich = basename(__FILE__);
    echo <<< MARCA_FIN

    Usage: $fich <Result> <UserId> [<Timestamp>] [--json]

MARCA_FIN;
    exit(0);
}

$newResult    = (int) $argv[1];
$userId       = (int) $argv[2];

switch ($argc){
    case 3:
        $newTimestamp = new DateTime('now');
        break;

    case 4:
        if($argv[3] == '--json'){
            $newTimestamp = new DateTime('now');
        } else{
            $newTimestamp = $argv[3];
        }
        break;

    case 5:
        $newTimestamp = $argv[3];
        break;
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
try {
    $entityManager->persist($result);
    $entityManager->flush();
    if (in_array('--json', $argv)) {
        echo json_encode($result, JSON_PRETTY_PRINT);
    } else {
        echo 'Created Result with Id ' . $result->getId()
            . ' for USER ' . $user->getUsername() . PHP_EOL;
    }
} catch (Throwable $exception) {
    echo $exception->getMessage();
}
