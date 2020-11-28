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

if($argc < 3 || $argc > 7){
    $fich = basename(__FILE__);
    //Todos los campos son obligatorios pero si se desea mantener alguno de los campos, añadir N
    echo <<< MARCA_FIN

    Usage: $fich <UserId> <Password> <NewUserName> <NewEmail> <NewPassword> [--json]
    Description: All fields are required in the specific order.
    To keep a parameter, add N.

MARCA_FIN;
    exit(0);
}

$userId = (int) $argv[1];
$password = $argv[2];
$newUsername = $argv[3];
$newEmail = $argv[4];
$newPassword = $argv[5];

/** @var User $user */
$user = $entityManager
    ->getRepository(User::class)
    ->findOneBy(['id' => $userId]);
if (null === $user) {
    echo "User $userId not found" . PHP_EOL;
    exit(0);
}

if(!$user->validatePassword($password)){
    echo "Passwords do not match" . PHP_EOL;
    //echo $password . '==' . $user->getPassword();
    exit(0);
}

echo "Passwords match" . PHP_EOL;
$updatedUser = $user;

($newUsername == 'N') ? $updatedUser->setUsername($user->getUsername())
                  : $updatedUser->setUsername($newUsername);
($newEmail == 'N') ? $updatedUser->setEmail($user->getEmail())
                  : $updatedUser->setEmail($newEmail);
($newPassword == 'N') ? $updatedUser->setPassword($password)
                  : $updatedUser->setPassword($newPassword);

$entityManager->flush();

if (in_array('--json', $argv)) {
    echo json_encode($updatedUser, JSON_PRETTY_PRINT);
} else {
    echo "Updated User ". $updatedUser->__toString() . PHP_EOL;
}
