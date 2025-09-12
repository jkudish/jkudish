<?php

namespace App\Http\Controllers;

use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    public function index()
    {
        $sitemap = Sitemap::create();

        // Get actual file modification times for more accurate dates
        $viewsPath = resource_path('views/');
        
        // Home page - highest priority
        $homeModified = file_exists($viewsPath . 'home.blade.php') 
            ? \Carbon\Carbon::createFromTimestamp(filemtime($viewsPath . 'home.blade.php'))
            : now()->subDays(7);
            
        $sitemap->add(
            Url::create('/')
                ->setLastModificationDate($homeModified)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(1.0)
        );

        // Services page - high priority
        $servicesModified = file_exists($viewsPath . 'services.blade.php')
            ? \Carbon\Carbon::createFromTimestamp(filemtime($viewsPath . 'services.blade.php'))
            : now()->subDays(14);
            
        $sitemap->add(
            Url::create('/services')
                ->setLastModificationDate($servicesModified)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                ->setPriority(0.9)
        );

        // Projects page
        $projectsModified = file_exists($viewsPath . 'projects.blade.php')
            ? \Carbon\Carbon::createFromTimestamp(filemtime($viewsPath . 'projects.blade.php'))
            : now()->subDays(7);
            
        $sitemap->add(
            Url::create('/projects')
                ->setLastModificationDate($projectsModified)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.8)
        );

        // Speaking page - update when new talks are added
        $speakingModified = file_exists($viewsPath . 'speaking.blade.php')
            ? \Carbon\Carbon::createFromTimestamp(filemtime($viewsPath . 'speaking.blade.php'))
            : now()->subMonths(1);
            
        $sitemap->add(
            Url::create('/speaking')
                ->setLastModificationDate($speakingModified)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                ->setPriority(0.8)
        );

        // Contact page - rarely changes
        $contactModified = file_exists($viewsPath . 'contact.blade.php')
            ? \Carbon\Carbon::createFromTimestamp(filemtime($viewsPath . 'contact.blade.php'))
            : now()->subMonths(6);
            
        $sitemap->add(
            Url::create('/contact')
                ->setLastModificationDate($contactModified)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
                ->setPriority(0.7)
        );

        // Newsletter page
        $newsletterModified = file_exists($viewsPath . 'newsletter.blade.php')
            ? \Carbon\Carbon::createFromTimestamp(filemtime($viewsPath . 'newsletter.blade.php'))
            : now()->subMonths(2);
            
        $sitemap->add(
            Url::create('/newsletter')
                ->setLastModificationDate($newsletterModified)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                ->setPriority(0.6)
        );

        return $sitemap->toResponse(request());
    }
}
