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

Utils::loadEnv(__DIR__ . '/../../');

$entityManager = Utils::getEntityManager();

if ($argc !=2 ) {
    $fich = basename(__FILE__);
    echo <<< MARCA_FIN

    Usage: $fich <UserId>

MARCA_FIN;
    exit(0);
}

$userId = (int) $argv[1];

/** @var User $user */
$user = $entityManager
    ->getRepository(User::class)
    ->findOneBy(['id' => $userId]);
if (null === $user) {
    echo "User to delete ($userId) not found" . PHP_EOL;
    exit(0);
}
$userIdToDelete = $user->getId();
$usernameToDelete = $user->getUsername();
$userEmailToDelete = $user->getEmail();

$entityManager->remove($user);
$entityManager->flush();

$deletedUser = $entityManager
    ->getRepository(User::class)
    ->findOneBy(['id' => $userId]);
if (null === $deletedUser) {
    echo "User $usernameToDelete (id: $userIdToDelete), with email: $userEmailToDelete has been deleted successfully" . PHP_EOL;
}