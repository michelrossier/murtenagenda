<?php

namespace App\Services;

use App\Models\Event;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class EventScraperService
{
    public function scrapeMurtenEvents()
    {
        try {
            $response = Http::withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
                'Accept-Language' => 'en-US,en;q=0.5',
                'Connection' => 'keep-alive',
                'Upgrade-Insecure-Requests' => '1',
            ])->get('https://fribourg.ch/de/regionmurtensee/veranstaltungen/');
            
            // For debugging
            echo "Response status: " . $response->status() . "\n";
            echo "Response headers: " . json_encode($response->headers()) . "\n";
            
            // Use DOM parsing to extract events
            $html = $response->body();
            $dom = new \DOMDocument();
            @$dom->loadHTML($html); // Suppress warnings due to malformed HTML
            $xpath = new \DOMXPath($dom);

            // Find all event elements
            $eventElements = $xpath->query('//div[contains(@class, "fiche")]'); // Adjust this based on the actual structure

            // Debugging output to check the number of event elements found
            echo "Total event elements found: " . $eventElements->length . "\n";

            foreach ($eventElements as $eventElement) {
                // Debugging output to check the structure of eventElement
                echo "Event Element: " . $dom->saveHTML($eventElement) . "\n";

                // Extract date
                $dateDiv = $xpath->query('.//div[contains(@class, "date")]', $eventElement);
                $dateText = $dateDiv->length > 0 ? trim($dateDiv->item(0)->textContent) : '';

                // Debugging output for the extracted date
                echo "Extracted date text: '{$dateText}'\n";

                // Check if the date text is empty
                if (empty($dateText)) {
                    echo "No date found for this event.\n";
                    continue; // Skip this event if no date is found
                }

                // Extract title
                $titleDiv = $xpath->query('.//div[contains(@class, "title")]', $eventElement);
                $titleText = $titleDiv->length > 0 ? trim($titleDiv->item(0)->textContent) : '';

                // Extract description
                $descriptionDiv = $xpath->query('.//p', $eventElement); // Assuming description is in a <p> tag
                $descriptionText = $descriptionDiv->length > 0 ? trim($descriptionDiv->item(0)->textContent) : '';

                // Extract locality
                $localityDiv = $xpath->query('.//h3[contains(@class, "cc-fg cc-mo")]', $eventElement);
                $localityText = $localityDiv->length > 0 ? trim($localityDiv->item(0)->textContent) : '';

                // Format the date
                try {
                    $formattedDate = \Carbon\Carbon::createFromFormat('d. M. Y', $dateText)->format('Y-m-d');
                } catch (\Exception $e) {
                    echo "Error formatting date '{$dateText}': " . $e->getMessage() . "\n";
                    continue; // Skip this event if date formatting fails
                }

                // Prepare event data
                $event = [
                    'date' => $formattedDate,
                    'name' => $titleText,
                    'description' => $descriptionText,
                    'locality' => $localityText,
                    'source_url' => 'https://fribourg.ch/de/regionmurtensee/veranstaltungen/'
                ];

                // Save or update the event in the database
                Event::updateOrCreate(
                    [
                        'date' => $event['date'],
                        'name' => $event['name']
                    ],
                    $event
                );

                echo "Found event: {$event['name']} on {$event['date']}\n";
            }

            echo "Scraping completed successfully\n";
        } catch (\Exception $e) {
            echo "Scraping failed: " . $e->getMessage() . "\n";
            echo "Stack trace: " . $e->getTraceAsString() . "\n";
        }
    }
} 