<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Page;
use App\Models\Project;
use App\Models\Service;
use Carbon\CarbonInterface;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $xml = new \SimpleXMLElement(
            '<?xml version="1.0" encoding="UTF-8"?>' .
            '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>'
        );


        // Главная
        $this->addUrl(
            $xml,
            '/',
            now(),
            'weekly',
            '1.0'
        );


        // Основные разделы
        $this->addUrl(
            $xml,
            '/services',
            now(),
            'monthly',
            '0.9'
        );

        $this->addUrl(
            $xml,
            '/cases',
            now(),
            'monthly',
            '0.8'
        );

        $this->addUrl(
            $xml,
            '/blog',
            now(),
            'weekly',
            '0.9'
        );


        // Страницы из БД
        $pages = Page::where('is_active', true)
            ->get();

        foreach ($pages as $page) {

            $this->addUrl(
                $xml,
                '/' . $page->slug,
                $page->updated_at,
                'monthly',
                '0.7'
            );
        }


        // Услуги
        $services = Service::where('is_active', true)
            ->orderBy('sort')
            ->get();

        foreach ($services as $service) {

            $this->addUrl(
                $xml,
                '/services/' . $service->slug,
                $service->updated_at,
                'monthly',
                '0.8'
            );
        }


        // Кейсы
        $projects = Project::where('is_active', true)
            ->orderBy('sort')
            ->get();

        foreach ($projects as $project) {

            $this->addUrl(
                $xml,
                '/cases/' . $project->slug,
                $project->updated_at,
                'yearly',
                '0.6'
            );
        }


        // Блог
        $articles = Article::published()
            ->orderByDesc('published_at')
            ->get();

        foreach ($articles as $article) {

            $this->addUrl(
                $xml,
                '/blog/' . $article->slug,
                $article->updated_at ?? $article->published_at,
                'monthly',
                '0.7'
            );
        }


        // Юридические страницы
        $this->addUrl(
            $xml,
            '/policy',
            null,
            'yearly',
            '0.3'
        );

        $this->addUrl(
            $xml,
            '/cookies',
            null,
            'yearly',
            '0.3'
        );


        return response(
            $xml->asXML(),
            200,
            [
                'Content-Type' => 'application/xml; charset=UTF-8',
            ]
        );
    }


    private function addUrl(
        \SimpleXMLElement $xml,
        string $url,
        $lastmod = null,
        ?string $changefreq = null,
        ?string $priority = null
    ): void {
        $urlElement = $xml->addChild('url');

        $urlElement->addChild(
            'loc',
            htmlspecialchars(
                url($url),
                ENT_XML1 | ENT_COMPAT,
                'UTF-8'
            )
        );


        if ($lastmod) {

            if ($lastmod instanceof CarbonInterface) {
                $lastmod = $lastmod->format('Y-m-d');
            } else {
                $lastmod = date(
                    'Y-m-d',
                    strtotime($lastmod)
                );
            }

            $urlElement->addChild(
                'lastmod',
                $lastmod
            );
        }


        if ($changefreq) {
            $urlElement->addChild(
                'changefreq',
                $changefreq
            );
        }


        if ($priority) {
            $urlElement->addChild(
                'priority',
                $priority
            );
        }
    }
}