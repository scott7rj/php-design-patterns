<?php
namespace phpDesignPatterns;

require_once '../vendor/autoload.php';

interface IBandeira {
    public function process();
}

class NoBandeira implements IBandeira {
    public function process() {
        print("Inside NoBandeira::process() method.\n");
     }
}

class Master implements IBandeira {
    public function process() {
       print("Inside Master::process() method.\n");
    }
 }

 class Visa implements IBandeira {
    public function process() {
       print("Inside Visa::process() method.\n");
    }
 }

 class AmericanExpress implements IBandeira {
    public function process() {
       print("Inside AmericanExpress::process() method.\n");
    }
 }

 class BandeiraFactory {

    public function getBandeira(string $bandeira) : ?IBandeira {
       if(strcasecmp($bandeira,"MASTER") == 0) {
          return new Master();
       } else if(strcasecmp($bandeira, "VISA") == 0) {
          return new Visa();
       } else if(strcasecmp($bandeira, "AMERICANEXPRESS") == 0) {
          return new AmericanExpress();
       }
       return new NoBandeira();
    }
 }

 $factory = new BandeiraFactory();
 $bandeira = $factory->getBandeira("master");
 $bandeira->process();
 $bandeira = $factory->getBandeira("visa");
 $bandeira->process();
 $bandeira = $factory->getBandeira("americanexpress");
 $bandeira->process();
 $bandeira = $factory->getBandeira("nubank");
 $bandeira->process();

