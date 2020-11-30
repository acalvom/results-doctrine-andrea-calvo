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
    $rutaUser = $routes->get('ruta_user')->getPath();
    $rutaCreateUser = $routes->get('ruta_create_user')->getPath();
    $rutaResultList = $routes->get('ruta_result_list')->getPath();
    $rutaResult = $routes->get('ruta_result')->getPath();
    $rutaCreateResult = $routes->get('ruta_create_result')->getPath();

    echo <<< ____MARCA_FIN
   <!DOCTYPE html>
    <html lang="es">
        <head>
          <title>Results Doctrine</title>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </head>
        <body>
          <div class="container">
            <div class="row">
              <div class="col" >
                <h2><strong>USERS INFORMATION</strong></h2></br>
                <h4>List users</h4>
                <form action="$rutaUserList" method="GET" enctype="multipart/form-data">
                    <label for="userList">User List &nbsp;</label>
                    <input type="submit" value="List Users"/>
                </form></br>
                <h4>Show user</h4>
                <form action="$rutaUser" method="GET" enctype="multipart/form-data">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" size="10"/>
                    <input type="submit" value="Show"/>
                </form></br>
                <h4>Delete user</h4>
                <form action="$rutaUser" method="GET" enctype="multipart/form-data">
                    <label for="deleteUsername">Username:</label>
                    <input type="text" id="deleteUsername" name="deleteUsername" size="10"/>
                    <input type="submit" value="Delete User"/>
                </form></br>
                <h4>Create new user</h4>
                <form action="$rutaCreateUser" method="POST" enctype="multipart/form-data">
                    <label for="newUsername">Username: &nbsp;</label>
                    <input type="text" id="newUsername" name="newUsername" size="10"/></br>
                    <label for="newEmail">Email:&nbsp;&nbsp;&emsp;&emsp;</label>
                    <input type="text" id="newEmail" name="newEmail" size="10"/></br>
                    <label for="newPassword">Password:&nbsp;&nbsp;&nbsp;</label>
                    <input type="password" id="newPassword" name="newPassword" size="10"/></br>
                    <label for="isEnabled">Enabled user?</label>
                    <input type="checkbox" id="isEnabled" name="isEnabled" value="1"/></br>
                    <label for="isAdmin">Admin user?</label>
                    <input type="checkbox" id="isAdmin" name="isAdmin" value="1"/></br>
                    <input type="submit" value="Create User"/>
                </form></br>    
              </div>
              <div class="col" >
                <h2><strong>RESULTS INFORMATION</strong></h2></br>
                <h4>List results</h4>
                <form action="$rutaResultList" method="GET" enctype="multipart/form-data">
                    <label for="resultList">Result List &nbsp;</label>
                    <input type="submit" value="List Results"/>
                </form></br>
                <h4>Show result</h4>
                <form action="$rutaResult" method="GET" enctype="multipart/form-data">
                    <label for="id">Id:</label>
                    <input type="text" id="id" name="id" size="10"/>
                    <input type="submit" value="Send"/>
                </form></br>
                <h4>Delete result</h4>
                <form action="$rutaResult" method="GET" enctype="multipart/form-data">
                    <label for="deleteId">Id:</label>
                    <input type="text" id="deleteId" name="deleteId" size="10"/>
                    <input type="submit" value="Delete Result"/>
                </form></br>
                <h4>Create new result</h4>
                <form action="$rutaCreateResult" method="POST" enctype="multipart/form-data">
                    <label for="newUsername">Username: &nbsp;</label>
                    <input type="text" id="newUsername" name="newUsername" size="10"/></br>
                    <label for="newResult">Result:&nbsp;&emsp;&emsp;</label>
                    <input type="text" id="newResult" name="newResult" size="10"/></br>
                    <input type="submit" value="Create Result"/>
                </form></br>  
              </div>
            </div>
          </div>
        </body>
    </html>
   
    
    
    
____MARCA_FIN;
}

function funcionListadoUsuarios(): void
{
    $entityManager = Utils::getEntityManager();
    $userRepository = $entityManager->getRepository(User::class);
    $users = $userRepository->findAll();

    echo json_encode($users, JSON_PRETTY_PRINT);
//    $items = 0;
//    echo PHP_EOL . sprintf(
//            '- %2s: %15s %25s %15s' . PHP_EOL,
//            'Id', 'Username:', 'Email:', 'Enabled:'
//        );
//    /** @var User $user */
//
//    foreach ($users as $user) {
//        echo sprintf(
//            '- %2d: %15s %25s %15s',
//            $user->getId(),
//            $user->getUsername(),
//            $user->getEmail(),
//            ($user->isEnabled()) ? 'true' : 'false'
//        ),
//        PHP_EOL;
//        $items++;
//    }
}

function funcionUsuario() :void
{
    (filter_has_var(INPUT_GET, 'username')) ? $name = $_GET['username']
        : $name = $_GET['deleteUsername'];

    $entityManager = Utils::getEntityManager();
    /** @var User $user */
    $user = $entityManager
        ->getRepository(User::class)
        ->findOneBy(['username' => $name]);
    if (null === $user) {
        echo "User $name not found" . PHP_EOL;
        exit(0);
    }

    if (filter_has_var(INPUT_GET, 'username')) {
         echo json_encode($user, JSON_PRETTY_PRINT);
//        echo PHP_EOL . sprintf(
//                '  %2s: %20s %30s' . PHP_EOL,
//                'Id', 'Username:', 'Email:', 'Enabled:'
//            );
//
//        /** @var User $user */
//        echo sprintf(
//            '- %2d: %20s %30s',
//            $user->getId(),
//            $user->getUsername(),
//            $user->getEmail(),
//        ),
//        PHP_EOL;

    } elseif (filter_has_var(INPUT_GET, 'deleteUsername')) {
        $userIdToDelete = $user->getId();
        $usernameToDelete = $user->getUsername();
        $userEmailToDelete = $user->getEmail();

        $entityManager->remove($user);
        $entityManager->flush();

        $deletedUser = $entityManager
            ->getRepository(User::class)
            ->findOneBy(['username' => $name]);
        if (null === $deletedUser) {
            echo "User $usernameToDelete (id: $userIdToDelete), with email: $userEmailToDelete has been deleted successfully" . PHP_EOL;
        }
    }
}

function funcionCreateUser()
{
    $entityManager = Utils::getEntityManager();
    $newUsername = filter_input(INPUT_POST,'newUsername');
    $newEmail    = filter_input(INPUT_POST,'newEmail');
    $newPassword = filter_input(INPUT_POST,'newPassword');

    $enabled = isset($_POST['isEnabled']);
    $admin = isset($_POST['isAdmin']);

    try{
    $newUser = new User();
    $newUser->setUsername($newUsername);
    $newUser->setEmail($newEmail);
    $newUser->setPassword($newPassword);
    $newUser->setEnabled($enabled);
    $newUser->setIsAdmin($admin);

    $entityManager->persist($newUser);
    $entityManager->flush();

    echo json_encode($newUser, JSON_PRETTY_PRINT);
    //echo "Created New User ". $newUser->__toString() . PHP_EOL;
    } catch (Throwable $exception) {
        echo "USER $newUsername ALREADY EXISTS" . PHP_EOL . PHP_EOL;
        echo $exception->getMessage() . PHP_EOL;
    }

}

function funcionListadoResultados(): void
{
    $entityManager = Utils::getEntityManager();
    $resultsRepository = $entityManager->getRepository(Result::class);
    $results = $resultsRepository->findAll();

    echo json_encode($results, JSON_PRETTY_PRINT);
//    echo PHP_EOL
//        . sprintf('%3s - %3s - %22s - %s', 'Id', 'res', 'username', 'time')
//        . PHP_EOL;
//    $items = 0;
//    /* @var Result $result */
//    foreach ($results as $result) {
//        echo $result . PHP_EOL;
//        $items++;
//    }
//    echo PHP_EOL . "Total: $items results.";
}


function funcionResultado()
{
    (filter_has_var(INPUT_GET, 'id')) ? $id = $_GET['id']
        : $id = $_GET['deleteId'];

    $entityManager = Utils::getEntityManager();

    /** @var Result $result */
    $result = $entityManager
        ->getRepository(Result::class)
        ->findOneBy(['id' => $id]);
    if (null === $result) {
        echo "Result $id not found" . PHP_EOL;
        exit(0);
    }

    if ((filter_has_var(INPUT_GET, 'id'))) {
        echo json_encode($result, JSON_PRETTY_PRINT);
        //echo "Result ". $result->__toString() . PHP_EOL;

    } elseif ((filter_has_var(INPUT_GET, 'deleteId'))) {
        $entityManager->remove($result);
        $entityManager->flush();
        $deletedResult = $entityManager
            ->getRepository(Result::class)
            ->findOneBy(['id' => $id]);
        if (null === $deletedResult) {
            echo "Result $id has been deleted successfully" . PHP_EOL;
        }
    }
}

function funcionCreateResult()
{
    $entityManager = Utils::getEntityManager();
    $newUsername = filter_input(INPUT_POST, 'newUsername');
    $newResult = filter_input(INPUT_POST, 'newResult');
    $newTimestamp = new DateTime('now');

    /** @var User $user */
    $user = $entityManager
        ->getRepository(User::class)
        ->findOneBy(['username' => $newUsername]);
    if (null === $user) {
        echo "User $newUsername not found" . PHP_EOL;
        exit(0);
    }
    $result = new Result($newResult, $user, $newTimestamp);
    $entityManager->persist($result);
    $entityManager->flush();

    echo json_encode($result, JSON_PRETTY_PRINT);
//    echo 'Created Result with Id ' . $result->getId()
//        . ' for USER ' . $user->getUsername() . PHP_EOL;
}
