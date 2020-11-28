<?php
/**
 * PHP version 7.4
 * src/list_users.php
 *
 * @category Scripts
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://www.etsisi.upm.es/ ETS de Ingeniería de Sistemas Informáticos
 */

use MiW\Results\Entity\Result;
use MiW\Results\Utility\Utils;

require __DIR__ . '/../../vendor/autoload.php';

// Carga las variables de entorno
Utils::loadEnv(__DIR__ . '/../../');
$entityManager = Utils::getEntityManager();

if ($argc < 2 || $argc > 3) {
    $fich = basename(__FILE__);
    echo <<< MARCA_FIN

    Usage: $fich <ResultId> [--json]

MARCA_FIN;
    exit(0);
}

$resultId = (int) $argv[1];

/** @var Result $result */
$result = $entityManager
    ->getRepository(Result::class)
    ->findOneBy(['id' => $resultId]);
if (null === $result) {
    echo "Result $resultId not found" . PHP_EOL;
    exit(0);
}

if (in_array('--json', $argv, true)) {
    echo json_encode($result, JSON_PRETTY_PRINT);
}else {
    echo "Result ". $result->__toString() . PHP_EOL;
}