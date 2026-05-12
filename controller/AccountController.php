<?php
// controller/AccountController.php
/* Controller for the account management page
    - sends the account update form
    - manages the supplied data
*/

// Include any models and repositories if needed
require_once __DIR__ . "/../model/Member.php";
require_once __DIR__ . "/../repository/MemberRepository.php";

// Include the required utility modules
require_once __DIR__ . "/../database/DatabaseSingleton.php";
require_once __DIR__ . "/../utilities/Encryption.php";
require_once __DIR__ . "/../utilities/Auditer.php";

class AccountController {
    private MemberRepository $memberRepository;
    private SessionManager $sessionManager;

    public function __construct(SessionManager $sessionManager) {
        $this->sessionManager = $sessionManager;
        $db = DatabaseSingleton::getInstance();
        $this->memberRepository = new MemberRepository($db, new Auditer($db));
    }

    public function manageRequest() {
        $status = $this->sessionManager->checkLoggedIn() ? "Delete your account, View or Update your account details" : "Create a new account";

        // Step 1. Check to see if we have some changes to make
        if (count($_POST) > 0) {
            // Can we just redirect this away?
            if ($_POST["action"] === "history") {
                header("Location: index.php?page=orderHistory");
            }
            // Are we editing or creating?
            match ($this->sessionManager->checkLoggedIn()) {
                true => $status = $this->editUser(),
                false => $status = $this->createUser(),
            };
        }
        // Step 2. Serve the page
        return $this->servePage($status);
    }

    private function editUser(): string {
        $user = $this->sessionManager->getActiveUser(); // We know this is not null because this only get called if we are logged in

        // Check to see if we are going to delete the user.
        if ($_POST["action"] === "delete") {
            $status = $this->memberRepository->delete($user) ? "Account Deletion Succesful" : "Something Went Wrong, Please Try Again";
            $this->sessionManager->loggedOut("account");
            return $status;
        }
        
        $user->username = htmlspecialchars($_POST["username"]);
        $user->firstName = EncryptedData::from(htmlspecialchars($_POST["firstName"]));
        $user->lastName = EncryptedData::from(htmlspecialchars($_POST["lastName"]));
        $user->street = OptionalEncryptedData::from(htmlspecialchars($_POST["street"]));
        $user->town = OptionalEncryptedData::from(htmlspecialchars($_POST["town"]));
        $user->postcode = OptionalEncryptedData::from(htmlspecialchars($_POST["postcode"]));
        $user->phone = OptionalEncryptedData::from(htmlspecialchars($_POST["phone"]));
        $user->email = OptionalEncryptedData::from(htmlspecialchars($_POST["email"]));

        // Check to see if we need to do anything to the password
        if ($_POST["password1"] != "") {
            // Check the passwords match
            if ($_POST["password1"] === $_POST["password2"]) {
                $user->password = HashedData::from(htmlspecialchars($_POST["password1"]));
            }
            else {
                return "Password Update Failed, Passwords Do Not Match";
            };
        }
        
        return $this->memberRepository->save($user) ? "User profile successfully updated" : "Something Went Wrong, Please Try Again";
    }

    private function createUser(): string {
        // Check to make sure the passwords match
        if ($_POST["password1"] === $_POST["password2"] and $_POST["password1"] != "") {
            $password = $_POST["password1"];
        }
        else {
            return "Member Creation Failed. Passwords Do Not Match";
        };
        // Check to make sure the username is unique
        if ($this->memberRepository->checkUsername($_POST["username"])) {
            return "Member Creation Failed. Username is not Unique";
        }

        $newMember = new Member(
            null, 
            htmlspecialchars($_POST["username"]), 
            HashedData::from(htmlspecialchars($password)),
            EncryptedData::from(htmlspecialchars($_POST["firstName"])), 
            EncryptedData::from(htmlspecialchars($_POST["lastName"])), 
            Role::user, 
            OptionalEncryptedData::from(htmlspecialchars($_POST["street"])), 
            OptionalEncryptedData::from(htmlspecialchars($_POST["town"])), 
            OptionalEncryptedData::from(htmlspecialchars($_POST["postcode"])), 
            OptionalEncryptedData::from(htmlspecialchars($_POST["phone"])), 
            OptionalEncryptedData::from(htmlspecialchars($_POST["email"]))
        );

        return  $this->memberRepository->save($newMember) ? "Member Creation Successful. Please log in with your new username and password" : "Something Went Wrong, Please Try Again";
    }

    private function servePage(string $status): void {
        if ($this->sessionManager->checkLoggedIn()) {
            $user = $this->sessionManager->getActiveUser();

            $username = $user->username;
            $firstName = $user->firstName->decrypt();
            $lastName = $user->lastName->decrypt();
            $street = $user->street->decrypt() ?? "";
            $town = $user->town->decrypt() ?? "";
            $postcode = $user->postcode->decrypt() ?? "";
            $phone = $user->phone->decrypt() ?? "";
            $email = $user->email->decrypt() ?? "";
        }
        else {
            $username = "";
            $firstName = "";
            $lastName = "";
            $street = "";
            $town = "";
            $postcode = "";
            $phone = "";
            $email = "";
        }
        require_once __DIR__ . "/../view/account.php";
    }
}