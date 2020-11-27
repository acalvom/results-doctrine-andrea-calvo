<?php
/**
 * PHP version 7.4
 * src/list_users.php
 *
 * @category Scripts
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
    $fich = basename(__FILE__);
    echo <<< MARCA_FIN

    Usage: $fich <UserId> <UserName> <Email> <Password> [--json]
    Description: All fields are required in the specific order

MARCA_FIN;
    exit(0);
}

$userId = (int) $argv[1];
$username = $argv[2];
$email = $argv[3];
$password = $argv[4];

/** @var User $user */
$user = $entityManager
    ->getRepository(User::class)
    ->findOneBy(['id' => $userId]);
if (null === $user) {
    echo "User $userId not found" . PHP_EOL;
    exit(0);
}

$updatedUser = $user;
$updatedUser->setUsername($argv[2]);
$updatedUser->setEmail($argv[3]);
$updatedUser->setPassword($argv[4]);
$entityManager->flush();

if (in_array('--json', $argv)) {
    echo json_encode($updatedUser, JSON_PRETTY_PRINT);
} else {
    echo "Updated User ". $updatedUser->__toString() . PHP_EOL;
}
