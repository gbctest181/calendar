<?php

//INCLUDE THE GOOGLE API PHP CLIENT LIBRARY FOUND HERE
//https://github.com/google/google-api-php-client
//DOWNLOAD IT AND PUT IT ON YOUR WEBSERVER IN THE ROOT FOLDER.
include(__DIR__ . '/google-api-php-client-master/src/Google/autoload.php');
require_once(__DIR__ . '/google-api-php-client-master/src/Google/Client.php');
require_once(__DIR__ . '/google-api-php-client-master/src/Google/Service/Calendar.php');
$client = new Google_Client();
//    $client->setUseObjects(true);
$client->setApplicationName("mycalendar");
$client->setClientId("107735788077-lvfqi19urr771tc1qhnbo2ngmclgtdv6.apps.googleusercontent.com");
$client->setDeveloperKey('mr2Ws6bLZG3A09S31P4-IC8d'); //GET AT AT DEVELOPERS.GOOGLE.COM
//
$service = new Google_Service_Calendar($client);
//
$event = new Google_Service_Calendar_Event();
$event->setSummary('Event 1');
$event->setLocation('Somewhere');
$start = new Google_Service_Calendar_EventDateTime();
$start->setDateTime('2015-05-26T19:00:00.000+01:00');
$start->setTimeZone('Europe/Paris');
$event->setStart($start);
$end = new Google_Service_Calendar_EventDateTime();
$end->setDateTime('2015-05-26T19:25:00.000+01:00');
$end->setTimeZone('Europe/Paris');
$event->setEnd($end);
//
$calendar_id = "cgbtest181@gmail.com";
//
$new_event = null;
//
try {
    $new_event = $service->events->insert($calendar_id, $event);
    //
    $new_event_id = $new_event->getId();
} catch (Google_ServiceException $e) {
    syslog(LOG_ERR, $e->getMessage());
}
?>


L'instruction $new_event = $service->events->insert($calendar_id, $event); fait appel à la fonction insert de Calendar.php.
Ci dessous une copie de cette fonction avec l'ajout d'instructions echo pour afficher certaines variables.


public function insert($calendarId, Google_Service_Calendar_Event $postBody, $optParams = array())
{

$params = array('calendarId' => $calendarId, 'postBody' => $postBody);

$params = array_merge($params, $optParams);


echo "Calendar insert00 : $calendarId<br>";


echo "<br><br><br>";
print_r($params);


$Id = $this->call('insert', array($params), "Google_Service_Calendar_Event");

echo "<br><br>Calendar insert01 : ID : ";

print_r($Id);

return $Id;

//    return $this->call('insert', array($params), "Google_Service_Calendar_Event");

}