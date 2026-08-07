<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Page;
use App\Models\Service;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"/>');
        
        // Главная страница
        $this->addUrl($xml, '/', now(), 'weekly', '1.0');
        
        // Страницы из БД (Page)
        $pages = Page::where('is_active', true)->get();
        foreach ($pages as $page) {
            $this->addUrl($xml, '/' . $page->slug, $page->updated_at ?? now(), 'monthly', '0.8');
        }
        
        // Услуги из БД (Service) — динамически
        $services = Service::where('is_active', true)->get();
        foreach ($services as $service) {
            $this->addUrl($xml, '/services/' . $service->slug, $service->updated_at ?? now(), 'monthly', '0.8');
        }
        
        // Кейсы из БД
        $projects = Project::where('is_active', true)->get();
        foreach ($projects as $project) {
            $this->addUrl($xml, '/cases/' . $project->slug, $project->updated_at ?? now(), 'yearly', '0.6');
        }
        
        // Политика и cookies
        $this->addUrl($xml, '/policy', now()->subDays(17), 'yearly', '0.3');
        $this->addUrl($xml, '/cookies', now()->subDays(18), 'yearly', '0.3');
        
        return response($xml->asXML(), 200, [
            'Content-Type' => 'text/xml'
        ]);
    }
    
    private function addUrl($xml, $url, $lastmod, $changefreq, $priority)
    {
        $urlElement = $xml->addChild('url');
        $urlElement->addChild('loc', url($url));
        $urlElement->addChild('lastmod', $lastmod instanceof \Carbon\Carbon ? $lastmod->format('Y-m-d') : date('Y-m-d', strtotime($lastmod)));
        $urlElement->addChild('changefreq', $changefreq);
        $urlElement->addChild('priority', $priority);
    }
}