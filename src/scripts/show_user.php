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

if ($argc < 2 || $argc > 3) {
    $fich = basename(__FILE__);
    echo <<< MARCA_FIN

    Usage: $fich <UserId> [--json]

MARCA_FIN;
    exit(0);
}

$userId     = (int) $argv[1];

/** @var User $user */
$user = $entityManager
    ->getRepository(User::class)
    ->findOneBy(['id' => $userId]);
if (null === $user) {
    echo "User $userId not found" . PHP_EOL;
    exit(0);
}

if (in_array('--json', $argv, true)) {
    echo json_encode($user, JSON_PRETTY_PRINT);
} else {
    echo PHP_EOL . sprintf(
            '  %2s: %20s %30s' . PHP_EOL,
            'Id', 'Username:', 'Email:', 'Enabled:'
        );
    /** @var User $user */
        echo sprintf(
            '- %2d: %20s %30s',
            $user->getId(),
            $user->getUsername(),
            $user->getEmail(),
        ),
        PHP_EOL;
}