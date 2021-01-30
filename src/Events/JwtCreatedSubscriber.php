<?php

namespace App\Events;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class JwtCreatedSubscriber
{
    public function updateJwtData(JWTCreatedEvent $event)
    {
        // Récupérer les données du dentiste qui se connecte
        $dentist = $event->getUser();

        // Enrichir les données du JWT afin de les récupérer dans l'application React Native
        $data = $event->getData();

        $data['id'] = $dentist->getId();
        $data['name'] = $dentist->getName();
        $data['surname'] = $dentist->getSurname();
        $data['address'] = $dentist->getAddress();
        $data['postalCode'] = $dentist->getPostalCode();
        $data['city'] = $dentist->getCity();
        $data['phone'] = $dentist->getPhone();
        $data['mail'] = $dentist->getMail();
        $data['tradename'] = $dentist->getTradename();
        $data['siret'] = $dentist->getSiret();

        // Envoyer le nouveau token enrichi
        $event->setData($data);
    }
}
