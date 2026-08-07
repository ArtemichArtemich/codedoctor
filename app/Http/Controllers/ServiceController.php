<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Список всех услуг (если нужна отдельная страница /services)
     */
    public function index()
    {
        $services = Service::where('is_active', true)
            ->orderBy('sort')
            ->get();
        
        $data = [
            'services' => $services,
            'breadcrumbs' => [
                ['name' => 'Услуги', 'url' => '']
            ]
        ];
        
        return view('pages.services.index', $data);
    }
    
    /**
     * Детальная страница услуги из БД
     */
    public function show($slug)
    {
        // Ищем услугу в БД
        $service = Service::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
        
        // Получаем все услуги для меню
        $servicesMenu = Service::where('is_active', true)
            ->orderBy('sort')
            ->get();
        
        $data = [
            'title' => $service->meta_title ?? $service->title . ' | Артём',
            'description' => $service->meta_description ?? $service->short_description ?? strip_tags($service->description),
            'h1' => $service->h1 ?? $service->title,
            'service' => $service,
            'servicesMenu' => $servicesMenu,
            'breadcrumbs' => [
                ['name' => 'Услуги', 'url' => '/services'],
                ['name' => $service->title, 'url' => '']
            ]
        ];
        
        return view('pages.services.show', $data);
    }
    
    /**
     * Для обратной совместимости со старыми ссылками
     * Перенаправляет на новые URL из БД
     */
    public function redirect($oldSlug)
    {
        $map = [
            'opencart-development' => 'opencart-development',
            'website-development' => 'website-development', 
            'error-fixing' => 'error-fixing',
            'maintenance' => 'maintenance',
            'layout-integration' => 'layout-integration',
        ];
        
        $newSlug = $map[$oldSlug] ?? null;
        
        if ($newSlug) {
            return redirect()->route('services.show', $newSlug, 301);
        }
        
        abort(404);
    }
}