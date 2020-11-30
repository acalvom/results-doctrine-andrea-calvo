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
    $rutaUpdateUser = $routes->get('ruta_update_user')->getPath();

    $rutaResultList = $routes->get('ruta_result_list')->getPath();
    $rutaResult = $routes->get('ruta_result')->getPath();
    $rutaCreateResult = $routes->get('ruta_create_result')->getPath();
    $rutaUpdateResult = $routes->get('ruta_update_result')->getPath();

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
                </form>
                <h4>_____________________________________________</h4>
                <h4>Show user</h4>
                <form action="$rutaUser" method="GET" enctype="multipart/form-data">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" size="10"/>
                    <input type="submit" value="Show"/>
                </form>
                <h4>_____________________________________________</h4>
                <h4>Delete user</h4>
                <form action="$rutaUser" method="GET" enctype="multipart/form-data">
                    <label for="deleteUsername">Username:</label>
                    <input type="text" id="deleteUsername" name="deleteUsername" size="10"/>
                    <input type="submit" value="Delete User"/>
                </form>
                <h4>_____________________________________________</h4>
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
                </form>
                <h4>_____________________________________________</h4>  
                <h4>Update user</h4>
                <form action="$rutaUpdateUser" method="POST" enctype="multipart/form-data">
                    <label for="currentUsername">Username: &nbsp;&emsp;&emsp;</label>
                    <input type="text" id="currentUsername" name="currentUsername" size="10"/></br>
                    <label for="currentPassword">Password:&emsp;&emsp;&emsp;</label>
                    <input type="text" id="currentPassword" name="currentPassword" size="10"/></br>
                    <label for="updatedUsername">New username: &nbsp;</label>
                    <input type="text" id="updatedUsername" name="updatedUsername" size="10"/></br>
                    <label for="newEmail">New email:&nbsp;&nbsp;&emsp;&emsp;</label>
                    <input type="text" id="updatedEmail" name="updatedEmail" size="10"/></br>
                    <label for="newPassword">New password:&nbsp;&nbsp;&nbsp;</label>
                    <input type="password" id="updatedPassword" name="updatedPassword" size="10"/></br>
                    <input type="submit" value="Update User"/>
                </form></br>   
              </div>
              <div class="col" >
                <h2><strong>RESULTS INFORMATION</strong></h2></br>
                <h4>List results</h4>
                <form action="$rutaResultList" method="GET" enctype="multipart/form-data">
                    <label for="resultList">Result List &nbsp;</label>
                    <input type="submit" value="List Results"/>
                </form>
                <h4>_____________________________________________</h4>
                <h4>Show result</h4>
                <form action="$rutaResult" method="GET" enctype="multipart/form-data">
                    <label for="id">Id:</label>
                    <input type="text" id="id" name="id" size="10"/>
                    <input type="submit" value="Send"/>
                </form>
                <h4>_____________________________________________</h4>
                <h4>Delete result</h4>
                <form action="$rutaResult" method="GET" enctype="multipart/form-data">
                    <label for="deleteId">Id:</label>
                    <input type="text" id="deleteId" name="deleteId" size="10"/>
                    <input type="submit" value="Delete Result"/>
                </form>
                <h4>_____________________________________________</h4>
                <h4>Create new result</h4>
                <form action="$rutaCreateResult" method="POST" enctype="multipart/form-data">
                    <label for="newUsername">Username: &nbsp;</label>
                    <input type="text" id="newUsername" name="newUsername" size="10"/></br>
                    <label for="newResult">Result:&nbsp;&emsp;&emsp;</label>
                    <input type="text" id="newResult" name="newResult" size="10"/></br>
                    <input type="submit" value="Create Result"/>
                </form></br></br></br></br>
                <h4>_____________________________________________</h4> 
                <h4>Update result</h4>
                <form action="$rutaUpdateResult" method="POST" enctype="multipart/form-data">
                    <label for="updatedId">Result Id: &emsp;</label>
                    <input type="text" id="updatedId" name="updatedId" size="10"/></br>
                    <label for="updatedResult">New result:&nbsp;</label>
                    <input type="text" id="updatedResult" name="updatedResult" size="10"/></br>
                    <input type="submit" value="Update Result"/>
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

    } catch (Throwable $exception) {
        echo "USER $newUsername ALREADY EXISTS" . PHP_EOL . PHP_EOL;
        echo $exception->getMessage() . PHP_EOL;
    }

}

function funcionUpdateUser() {
    $entityManager   = Utils::getEntityManager();

    $currentUsername = filter_input(INPUT_POST,'currentUsername');
    $currentPassword = filter_input(INPUT_POST,'currentPassword');

    $updatedUsername = filter_input(INPUT_POST,'updatedUsername');
    $updatedEmail    = filter_input(INPUT_POST,'updatedEmail');
    $updatedPassword = filter_input(INPUT_POST,'updatedPassword');

    /** @var User $user */
    $user = $entityManager
        ->getRepository(User::class)
        ->findOneBy(['username' => $currentUsername]);
    if (null === $user) {
        echo "User $currentUsername not found" . PHP_EOL;
        exit(0);
    }

    if(!$user->validatePassword($currentPassword)){
        echo "Passwords do not match" . PHP_EOL;
        exit(0);
    }

    $updatedUser = $user;

    ($updatedUsername == '') ? $updatedUser->setUsername($user->getUsername())
        : $updatedUser->setUsername($updatedUsername);
    ($updatedEmail == '') ? $updatedUser->setEmail($user->getEmail())
        : $updatedUser->setEmail($updatedEmail);
    ($updatedPassword == '') ? $updatedUser->setPassword($currentPassword)
        : $updatedUser->setPassword($updatedPassword);

    $entityManager->flush();

    echo json_encode($updatedUser, JSON_PRETTY_PRINT);
}

function funcionListadoResultados(): void
{
    $entityManager = Utils::getEntityManager();
    $resultsRepository = $entityManager->getRepository(Result::class);
    $results = $resultsRepository->findAll();

    echo json_encode($results, JSON_PRETTY_PRINT);
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
}

function funcionUpdateResult(){
    $entityManager = Utils::getEntityManager();
    $updatedId = filter_input(INPUT_POST, 'updatedId');
    $updatedResult = filter_input(INPUT_POST, 'updatedResult');

    /** @var Result $result */
    $result = $entityManager
        ->getRepository(Result::class)
        ->findOneBy(['id' => $updatedId]);
    if (null === $result) {
        echo "Result ($updatedId) not found" . PHP_EOL;
        exit(0);
    }

    $updatedResultId = $result;
    $result->setResult($updatedResult);
    $result->setTime(new DateTime('now'));
    $entityManager->flush();

    echo json_encode($updatedResultId, JSON_PRETTY_PRINT);
}