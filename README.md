<!-- PROJECT LOGO -->
<br />
<p align="center">
  <a href="https://github.com/piyook/csrf-utility">
    <img src="src/public/piyook.png" alt="Logo" width="200" height="160">
  </a>

  <h3 align="center">PHP CSRF Protection Utility</h3>

  <p align="center">
    Utility Class To Handle Resource Protection with CSRF Tokens and Cookies
    <br />
  </p>
</p>



<!-- TABLE OF CONTENTS -->
<details open="open">
  <summary><h2 style="display: inline-block">Table of Contents</h2></summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#usage">Usage</a></li>
    <li><a href="#contact">Contact</a></li>
  </ol>
</details>

---

<!-- ABOUT THE PROJECT -->
## About The Project
 <br>
 </p>
 A simple PHP utility class to generate csrf tokens and check these are valid on a protected resource end-points such as form handlers.<br>
 
 <br><br>
 DocBlock comments are included with the method and class descriptions visible in most IDE's.

<br>

### Built With

* PHP 8.0
* PHPUnit v9.5

---

## Getting Started

The project can be run in a local docker-container for development and test purposes.

To access the php/apache container:

```sh
    docker-compose run --rm server <command>
```

To access the composer container:

```sh
    docker-compose run --rm composer <command>
```


The src folder is bind mounted to the docker container and so local changes in an IDE will be
reflected in the container and vice-versa.

Once the src folder is created on your local system and composer installs dependencies, then ensure file permissions are correct to allow changes
(since docker creates files using the root user by default and this will be reflected in the local src folder)

```sh
  sudo chmod -R o+w src
``` 

Otherwise a local LAMP stack such as XAMMP or WAMMP can be used.
<br>

### Prerequisites

Docker and Docker-Compose need to be installed to run the container.
<br>

A. TO AVOID CORS ISSUES MAKE SURE THE PROTECTED RESOURCE IS ON THE SAME URL AS THE CSRF GENERATOR PAGE.<br>
B. Access-Control-Allow-Origin HEADERS SHOULD BE SET TO THE TARGET URL (NOT '*').<br>
C. ENSURE THAT POST REQUESTS GET SENT WITH CREDENTIALS 'INCLUDED' - SEE DOCUMENTATION FOR FETCH, AXIOS OR AJAX REQUESTS.THIS ENSURES THAT THE CSRF COOKIE IS SENT WITH EVERY POST REQUEST.<br>


### Installation

run composer to install dependencies

```sh
  docker-compose run --rm composer install
```

and then update the autoloader

```sh
  docker-compose run --rm composer dump-autoload -o
```

to start the apache server on localhost:8000

```sh
  docker-compose up -d server
```

---

## Usage

<br>

### *PHPUnit tests*
<br>
PHPUnit tests can be run with the following :

```sh
    docker-compose run --rm server ./vendor/bin/phpunit --repeat=1
```
if needed create an alias 

```sh
alias phpunit=docker-compose run --rm server ./vendor/bin/phpunit
```

then from the command line run PHPUnit tests from the tests folder with:

```sh
phpunit
``` 

to run multiple iteration tests use:


```sh
 phpunit --repeat=10
```
Any refactoring or changes to PHP version can then be tested by running the unit tests and then debugging 
according to the error messages. 
<br><br>

### *Set-up CSRF Token Generation*
<br>

 A csrf.php file needs to be created that can accept GET requests for a CSRF token.
 
 On this page the CSRFController needs to be instantiated and then the required information passed

```sh
$csrf = new \App\CSRF\CSRFController();

```
To generate a token:

```code
    $csrf->setHttpCSRFCookie();
```

This will set a CSRFToken http cookie in the broswer which will be sent with every request 

<br>

### *protect a resource with CSRF Cookie Check*
<br>


On resource to be protected, instantiate the CSRFController and call the checlHttpCSRFCookie method.

```code
  $csrf = new \App\CSRF\CSRFController();
  $csrf->checkHttpCSRFCookie();
```
BEFORE making a POST Request to a protected endpoint, send a GET request to the csrf.php page to be issued a CSRF Token Cookie. Ensure that any POST request handlers send 'with credentials' so that the CSRF cookie is included.

A 403 Forbidden Error will be sent for all POST requests that dont have a valid CSRF Cookie that matches the Session CSRFCookie.

<br>


### *Customization*

The Length of Time the CSRF Cookie is valid is set to 60 minutes (3600 seconds) or end of the Session. This can be modified in the setHttpCSRFCookie method.

The Session Cookie should be set to Samesite, Secure and HttpOnly - this can be set-up in the php.ini file or the default session_set_cookie_params included in the boostrap file - this helps prevent session cookie hijacking.

The CSRF Cookie is set to samesite by default and the 'domain' value should be set to the required value depeneding on the use .. (in this demo its set to false)



<br><br>

---

## Contact

Piyook - [@piyookD](https://twitter.com/piyookD) - email piyook@piyook.com



