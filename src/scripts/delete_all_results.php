<?php
/**
 * PHP version 7.4
 * src/create_user_admin.php
 *
 * @category Utils
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://www.etsisi.upm.es/ ETS de Ingeniería de Sistemas Informáticos
 */

use MiW\Results\Entity\Result;
use MiW\Results\Utility\Utils;

require __DIR__ . '/../../vendor/autoload.php';

Utils::loadEnv(__DIR__ . '/../../');

if ($argc !=1 ) {
    $fich = basename(__FILE__);
    echo "Usage: $fich".PHP_EOL;
    exit(0);
}

$entityManager = Utils::getEntityManager();
$resultRepository = $entityManager->getRepository(Result::class);
$results = $resultRepository->findAll();

$items = 0;

/** @var Result $results */
foreach ($results as $result) {
    echo $result->__toString() . PHP_EOL;

    $entityManager->remove($result);
    $entityManager->flush();
    $items++;
}

echo "\nA total of $items results have been deleted.\n\n";
