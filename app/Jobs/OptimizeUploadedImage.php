<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Spatie\ImageOptimizer\OptimizerChainFactory;

class OptimizeUploadedImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 120; // 2 минуты на обработку
    public $tries = 3; // Количество попыток

    /**
     * Путь к загруженному изображению (относительно диска)
     */
    public function __construct(
        protected string $imagePath,
        protected string $disk = 'public',
        protected array $sizes = [400, 800, 1200, 1920]
    ) {}

    public function handle(): void
    {
        $disk = Storage::disk($this->disk);
        $fullPath = $disk->path($this->imagePath);
        
        // 1. Оптимизируем оригинал
        $this->optimizeOriginal($fullPath);
        
        // 2. Создаем WebP версии разных размеров
        $this->createWebPVersions($fullPath, $disk);
        
        // 3. Создаем превью для админки (опционально)
        $this->createThumbnail($fullPath, $disk);
    }
    
    /**
     * Оптимизация оригинального изображения
     */
    protected function optimizeOriginal(string $path): void
    {
        $optimizerChain = OptimizerChainFactory::create();
        $optimizerChain->optimize($path);
        
        // Дополнительно: если это PNG, конвертируем в JPG для фотографий
        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
        
        if ($extension === 'png' && $this->isPhotographicImage($path)) {
            $jpgPath = str_replace('.png', '.jpg', $path);
            
            Image::make($path)
                ->encode('jpg', 85)
                ->save($jpgPath);
            
            // Удаляем оригинальный PNG если JPG создан успешно
            if (file_exists($jpgPath)) {
                unlink($path);
                // Обновляем путь для дальнейшей обработки
                $this->imagePath = str_replace('.png', '.jpg', $this->imagePath);
            }
        }
    }
    
    /**
     * Создание WebP версий разных размеров
     */
    protected function createWebPVersions(string $originalPath, $disk): void
    {
        $originalImage = Image::make($originalPath);
        $filename = pathinfo($this->imagePath, PATHINFO_FILENAME);
        $directory = dirname($this->imagePath);
        
        foreach ($this->sizes as $width) {
            // Пропускаем если исходное изображение меньше
            if ($originalImage->width() < $width) continue;
            
            // Ресайзим с сохранением пропорций
            $resized = Image::make($originalPath)
                ->resize($width, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize(); // Не увеличивать маленькие изображения
                });
            
            // Формируем имя файла: photo-800w.webp
            $webpFilename = "{$filename}-{$width}w.webp";
            $webpPath = "{$directory}/webp/{$webpFilename}";
            
            // Сохраняем WebP с качеством 80%
            $resized->encode('webp', 80)
                ->save($disk->path($webpPath));
            
            // Освобождаем память
            $resized->destroy();
        }
        
        $originalImage->destroy();
    }
    
    /**
     * Создание миниатюры для админки
     */
    protected function createThumbnail(string $originalPath, $disk): void
    {
        $filename = pathinfo($this->imagePath, PATHINFO_FILENAME);
        $extension = pathinfo($this->imagePath, PATHINFO_EXTENSION);
        $directory = dirname($this->imagePath);
        
        $thumbnailPath = "{$directory}/thumbnails/{$filename}-thumb.{$extension}";
        
        Image::make($originalPath)
            ->resize(300, 200, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })
            ->save($disk->path($thumbnailPath));
    }
    
    /**
     * Проверка, является ли изображение фотографией (а не логотипом/иконкой)
     */
    protected function isPhotographicImage(string $path): bool
    {
        $image = Image::make($path);
        $width = $image->width();
        $height = $image->height();
        $image->destroy();
        
        // Если изображение квадратное и небольшое — скорее всего иконка
        if ($width === $height && $width < 500) {
            return false;
        }
        
        return true;
    }
    
    /**
     * Обработка неудачи
     */
    public function failed(\Throwable $exception): void
    {
        // Логируем ошибку
        \Log::error('Ошибка оптимизации изображения', [
            'path' => $this->imagePath,
            'error' => $exception->getMessage()
        ]);
        
        // Можно отправить уведомление админу
        // Notification::send($admin, new ImageOptimizationFailed($this->imagePath));
    }
}