<?php

namespace App\Services\Google;

use Google;
use Google_Service_Indexing_UrlNotification;

class IndexingService
{
    private $indexing;

    public function __construct()
    {
        $this->indexing = Google::make('indexing');
    }

    public function status(string $url)
    {
        $responce = $this->indexing->urlNotifications->getMetadata([
            "url" => urlencode($url)
        ]);

        return $responce;
    }

    public function publish(string $url, string $action)
    {
        $urlNotification = new Google_Service_Indexing_UrlNotification();
        $urlNotification->setUrl($url);
        $urlNotification->setType($action);

        $responce = $this->indexing->urlNotifications->publish($urlNotification);

        return $responce;
    }
}