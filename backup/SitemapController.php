<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Генерация sitemap.xml
     */
    public function index(): Response
    {
        $pages = [
            '/' => now()->subDays(1),
            '/#services' => now()->subDays(2),
            '/#cases' => now()->subDays(3),
            '/#prices' => now()->subDays(4),
            '/#process' => now()->subDays(5),
            '/#contacts' => now()->subDays(6),
            '/services/opencart-development' => now()->subDays(7),
            '/services/website-development' => now()->subDays(8),
            '/services/error-fixing' => now()->subDays(9),
            '/services/maintenance' => now()->subDays(10),
            '/cases/artoftea' => now()->subDays(11),
            '/cases/berkano' => now()->subDays(12),
            '/cases/tesseract' => now()->subDays(13),
            '/cases/lat' => now()->subDays(14),
            '/cases/seka' => now()->subDays(15),
            '/cases/sad-mechty' => now()->subDays(16),
            '/policy' => now()->subDays(17),
            '/cookies' => now()->subDays(18),
        ];
        
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"/>');
        
        foreach ($pages as $url => $lastmod) {
            $urlElement = $xml->addChild('url');
            $urlElement->addChild('loc', url($url));
            $urlElement->addChild('lastmod', $lastmod->format('Y-m-d'));
            $urlElement->addChild('changefreq', 'monthly');
            $urlElement->addChild('priority', $url === '/' ? '1.0' : '0.8');
        }
        
        return response($xml->asXML(), 200, [
            'Content-Type' => 'text/xml'
        ]);
    }
}