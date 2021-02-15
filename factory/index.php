<?php
namespace phpDesignPatterns;

require_once '../vendor/autoload.php';

abstract class SocialNetworkPoster {
    abstract public function getSocialNetwork(): SocialNetworkConnector;

    public function post($content): void {
        $network = $this->getSocialNetwork();
        $network->login();
        $network->createPost($content);
        $network->logout();
    }
}

class FacebookPoster extends SocialNetworkPoster {
    private $login, $password;
    public function __construct(string $login, string $password) {
        $this->login = $login;
        $this->password = $password;
    }

    public function getSocialNetwork(): SocialNetworkConnector {
        return new FacebookConnector($this->login, $this->password);
    }
}

class LinkedInPoster extends SocialNetworkPoster {
    private $email, $password;
    public function __construct(string $email, string $password) {
        $this->email = $email;
        $this->password = $password;
    }

    public function getSocialNetwork(): SocialNetworkConnector {
        return new LinkedInConnector($this->email, $this->password);
    }
}

interface SocialNetworkConnector {
    public function login(): void;
    public function logout(): void;
    public function createPost($content): void;
}

class FacebookConnector implements SocialNetworkConnector {
    private $login, $password;

    public function __construct(string $login, string $password) {
        $this->login = $login;
        $this->password = $password;
    }

    public function login(): void {
        echo "send http api request to log in Facebook $this->login <br/>";
    }
    public function logout(): void {
        echo "send http api request to log out Facebook $this->login<br/>";
    }
    public function createPost($content): void {
        echo "send http api request to create post in Facebook<br/>";
    }
}

class LinkedInConnector implements SocialNetworkConnector {
    private $email, $password;

    public function __construct(string $email, string $password) {
        $this->email = $email;
        $this->password = $password;
    }

    public function login(): void {
        echo "send http api request to log in LinkedIn $this->email<br/>";
    }
    public function logout(): void {
        echo "send http api request to log out LinkedIn $this->email<br/>";
    }
    public function createPost($content): void {
        echo "send http api request to create post in LinkedIn<br/>";
    }
}

function clientCode(SocialNetworkPoster $creator) {
    $creator->post("Hello World<br/>");
}

echo "Testing ConcreteCreator1:<br/>";
clientCode(new FacebookPoster("john_doe", "*****"));
echo "\n\n";
echo "Testing ConcreteCreator2:<br/>";
clientCode(new LinkedInPoster("john_doe@test.com", "*****"));

