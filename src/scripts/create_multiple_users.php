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

if ($argc < 3) {
    $fich = basename(__FILE__);
    echo <<< MARCA_FIN

    Usage: $fich <NewUser> <NewUser> [--json]
    NewUser = <Username>,<Email>,<Password>
    At least two users required

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
    $newUser = new User();
    $newUser->setUsername($parameters[0]);
    $newUser->setEmail((string) ($parameters[1]));
    $newUser->setPassword((string) $parameters[2]);
    $newUser->setEnabled(false);
    $newUser->setIsAdmin(false);
    $entityManager->persist($newUser);
    $entityManager->flush();
    if (in_array('--json', $argv, true)) {
        echo json_encode($newUser, JSON_PRETTY_PRINT);
    } else {
        echo "Created New User ". $newUser->__toString() . PHP_EOL;
    }
}


