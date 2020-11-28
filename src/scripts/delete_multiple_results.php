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

$entityManager = Utils::getEntityManager();

if ($argc < 3) {
    $fich = basename(__FILE__);
    echo <<< MARCA_FIN

    Usage: $fich <ResultId> <ResultId> [--json]
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
    $resultId = (int)$argv[$i];

    /** @var Result $result */
    $result = $entityManager
        ->getRepository(Result::class)
        ->findOneBy(['id' => $resultId]);
    if (null === $result) {
        echo "Result ($resultId) not found" . PHP_EOL;
        exit(0);
    }

    $entityManager->remove($result);
    $entityManager->flush();

    $deletedResult = $entityManager
        ->getRepository(Result::class)
        ->findOneBy(['id' => $resultId]);
    if (null === $deletedResult) {
        echo "Result $resultId has been deleted successfully" . PHP_EOL;
    }
}
echo "A total of $lengthArgv results have been deleted" . PHP_EOL;
