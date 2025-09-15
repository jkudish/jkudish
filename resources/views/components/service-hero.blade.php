@if($serviceConfig)
    <header class="max-w-2xl mx-auto text-center">
        <div class="flex justify-center mb-6">
            <div class="p-3 rounded-2xl bg-gradient-to-br {{ $serviceConfig['border_gradient'] }} shadow-lg">
                <div class="p-3 bg-white dark:bg-zinc-900 rounded-xl">
                    <x-icon name="{{ $serviceConfig['icon'] }}" class="w-12 h-12" style="color: {{ $serviceConfig['icon_color'] }}" />
                </div>
            </div>
        </div>
        
        <x-ui.typography variant="h1">
            {{ $serviceConfig['name'] }}
        </x-ui.typography>
        
        <x-ui.typography variant="lead" class="mt-6 {{ $serviceConfig['text_color'] }}">
            {{ $serviceConfig['hero_message'] }}
        </x-ui.typography>
    </header>
@else
    <header class="max-w-2xl mx-auto text-center">
        <x-ui.typography variant="h1">
            Get in Touch
        </x-ui.typography>
        <x-ui.typography variant="lead" color="muted" class="mt-6">Have a project in mind? Let's discuss how I can help.</x-ui.typography>
    </header>
@endif