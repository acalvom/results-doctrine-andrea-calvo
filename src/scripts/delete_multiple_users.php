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

if ($argc < 2) {
    $fich = basename(__FILE__);
    echo <<< MARCA_FIN

    Usage: $fich <UserId> <UserId> [--json]
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
    $userId = (int) $argv[$i];

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
}
echo "A total of $lengthArgv users have been deleted" . PHP_EOL;
