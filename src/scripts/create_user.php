<?php
/**
 * PHP version 7.4
 * src/create_user_admin.php
 *
 * @category Utils
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://www.etsisi.upm.es/ ETS de Ingeniería de Sistemas Informáticos
 */

use MiW\Results\Entity\User;
use MiW\Results\Utility\Utils;

require __DIR__ . '/../../vendor/autoload.php';

// Carga las variables de entorno
Utils::loadEnv(__DIR__ . '/../../');

$entityManager = Utils::getEntityManager();
if($argc < 4 || $argc > 5){
    echo PHP_EOL . "There are not enough arguments (required 5)\n";
    echo sprintf(
            '%2s %2s %7s' . PHP_EOL,
            'Username ', 'Email ','Password '
        );
} else {
    $newUser = new User();
    $newUser->setUsername($argv[1]);
    $newUser->setEmail($argv[2]);
    $newUser->setPassword($argv[3]);
    $newUser->setEnabled(false);
    $newUser->setIsAdmin(false);

    try {
        $entityManager->persist($newUser);
        $entityManager->flush();
        if (in_array('--json', $argv)) {
            echo json_encode($newUser, JSON_PRETTY_PRINT);
        } else {
            echo "Created New User ". $newUser->__toString() . PHP_EOL;
        }
    } catch (Throwable $exception) {
        echo $exception->getMessage() . PHP_EOL;
    }

}
