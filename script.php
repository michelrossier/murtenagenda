   <?php

   require 'vendor/autoload.php';

   use Facebook\WebDriver\Remote\RemoteWebDriver;
   use Facebook\WebDriver\Remote\DesiredCapabilities;
   use Facebook\WebDriver\WebDriverBy;

   // Start the Selenium server
   $host = 'http://localhost:4444'; // Adjust if necessary
   $driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());

   // Navigate to the page
   $driver->get('https://fribourg.ch/de/regionmurtensee/veranstaltungen/');

   // Wait for the page to load and render
   sleep(5); // Adjust the sleep time as necessary

   // Extract the event data
   $events = $driver->findElements(WebDriverBy::cssSelector('.fiche'));
   foreach ($events as $event) {
       $date = $event->findElement(WebDriverBy::cssSelector('.date'))->getText();
       $title = $event->findElement(WebDriverBy::cssSelector('.title'))->getText();
       $locality = $event->findElement(WebDriverBy::cssSelector('h3.cc-fg.cc-mo'))->getText();
       echo "Date: $date, Title: $title, Locality: $locality\n";
   }

   // Close the browser
   $driver->quit();
