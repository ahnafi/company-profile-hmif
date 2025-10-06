<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class YouTubeController extends Controller
{
    public function getLatestVideos()
    {
        try {
            // Cache the result for 1 hour to avoid hitting YouTube API too frequently
            $videos = Cache::remember('youtube_latest_videos', 3600, function () {
                $channelId = 'UC4k7Wr4OpOvkMuhyneYRaqg';
                $feedUrl = "https://www.youtube.com/feeds/videos.xml?channel_id={$channelId}";
                
                $response = Http::timeout(10)->get($feedUrl);
                
                if (!$response->successful()) {
                    throw new \Exception('Failed to fetch YouTube feed');
                }
                
                $xml = simplexml_load_string($response->body());
                
                if ($xml === false) {
                    throw new \Exception('Failed to parse XML');
                }
                
                // Register namespaces
                $xml->registerXPathNamespace('atom', 'http://www.w3.org/2005/Atom');
                $xml->registerXPathNamespace('yt', 'http://www.youtube.com/xml/schemas/2015');
                $xml->registerXPathNamespace('media', 'http://search.yahoo.com/mrss/');
                
                $entries = $xml->xpath('//atom:entry');
                $videos = [];
                
                // Get only the first 3 videos
                $count = 0;
                foreach ($entries as $entry) {
                    if ($count >= 3) {
                        break;
                    }
                    
                    $entry->registerXPathNamespace('atom', 'http://www.w3.org/2005/Atom');
                    $entry->registerXPathNamespace('yt', 'http://www.youtube.com/xml/schemas/2015');
                    $entry->registerXPathNamespace('media', 'http://search.yahoo.com/mrss/');
                    
                    $videoId = (string) $entry->xpath('yt:videoId')[0];
                    $title = (string) $entry->xpath('atom:title')[0];
                    $published = (string) $entry->xpath('atom:published')[0];
                    
                    $thumbnail = "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg";
                    
                    $videos[] = [
                        'id' => $videoId,
                        'title' => $title,
                        'publishedAt' => $published,
                        'thumbnail' => $thumbnail,
                    ];
                    
                    $count++;
                }
                
                return $videos;
            });
            
            return response()->json([
                'success' => true,
                'videos' => $videos,
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch YouTube videos',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
