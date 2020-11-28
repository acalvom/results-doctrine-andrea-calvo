<?php

/**
 * PHP version 7.4
 * ResultsDoctrine - controllers.php
 *
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://www.etsisi.upm.es/ ETS de Ingeniería de Sistemas Informáticos
 */

use MiW\Results\Entity\User;
use MiW\Results\Utility\Utils;
use MiW\Results\Entity\Result;

function funcionHomePage()
{
    global $routes;

    $rutaUserList = $routes->get('ruta_user_list')->getPath();
    $rutaResultList = $routes->get('ruta_result_list')->getPath();
    echo <<< ____MARCA_FIN
    <ul>
        <li><a href="$rutaUserList">User List</a></li>
        <li><a href="$rutaResultList">Result List</a></li>
    </ul>
____MARCA_FIN;
}

function funcionListadoUsuarios(): void
{
    $entityManager = Utils::getEntityManager();

    $userRepository = $entityManager->getRepository(User::class);
    $users = $userRepository->findAll();

    echo json_encode($users, JSON_PRETTY_PRINT);
    $items = 0;
    echo PHP_EOL . sprintf(
            '- %2s: %15s %25s %15s' . PHP_EOL,
            'Id', 'Username:', 'Email:', 'Enabled:'
        );
    /** @var User $user */

   foreach ($users as $user) {
        echo sprintf(
            '- %2d: %15s %25s %15s',
            $user->getId(),
            $user->getUsername(),
            $user->getEmail(),
            ($user->isEnabled()) ? 'true' : 'false'
        ),
        PHP_EOL;
        $items++;
    }


}

function funcionUsuario(string $name)
{
    $entityManager = Utils::getEntityManager();
    /** @var User $user */
    $user = $entityManager
        ->getRepository(User::class)
        ->findOneBy(['username' => $name]);
    if (null === $user) {
        echo "User $name not found" . PHP_EOL;
        exit(0);
    }

    echo json_encode($user, JSON_PRETTY_PRINT);

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

function funcionListadoResultados(): void
{
    $entityManager = Utils::getEntityManager();
    $resultsRepository = $entityManager->getRepository(Result::class);
    $results = $resultsRepository->findAll();

    echo json_encode($results, JSON_PRETTY_PRINT);
    echo PHP_EOL
        . sprintf('%3s - %3s - %22s - %s', 'Id', 'res', 'username', 'time')
        . PHP_EOL;
    $items = 0;
    /* @var Result $result */
    foreach ($results as $result) {
        echo  $result . PHP_EOL;
        $items++;
    }
    echo PHP_EOL . "Total: $items results.";


}