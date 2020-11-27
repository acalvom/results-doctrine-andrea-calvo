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

if ($argc !=1 ) {
    $fich = basename(__FILE__);
    echo "Usage: $fich".PHP_EOL;
    exit(0);
}

$entityManager = Utils::getEntityManager();
$userRepository = $entityManager->getRepository(User::class);
$users = $userRepository->findAll();

$items = 0;
echo PHP_EOL . sprintf(
        '  %2s: %20s %30s %7s' . PHP_EOL,
        'Id', 'Username:', 'Email:', 'Deleted:'
    );
/** @var User $user */
foreach ($users as $user) {
    echo sprintf(
        '- %2d: %20s %30s %7s',
        $user->getId(),
        $user->getUsername(),
        $user->getEmail(),
        'Done'
    ),
    PHP_EOL;
    $entityManager->remove($user);
    $entityManager->flush();
    $items++;
}

echo "\nA total of $items users have been deleted.\n\n";

$deletedUsers = $entityManager->getRepository(User::class);
$users = $userRepository->findAll();

if (null === $deletedUsers) {
    echo "User have been deleted successfully" . PHP_EOL;
}
