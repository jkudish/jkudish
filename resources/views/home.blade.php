<x-layout>
    {{-- Hero Section with gradient mesh background --}}
    <x-ui.section background="gradient-mesh" spacing="large">
        <x-home.hero />
    </x-ui.section>
    
    {{-- About Section with frost background --}}
    <x-ui.section background="frost" spacing="normal">
        <x-home.about />
    </x-ui.section>
    
    {{-- Current Projects with pattern background --}}
    <x-ui.section background="pattern" spacing="normal">
        <x-home.current-projects />
    </x-ui.section>
    
    {{-- Services Preview with white background --}}
    <x-ui.section background="white" spacing="normal">
        <x-home.services-preview />
    </x-ui.section>
    
    {{-- Social Proof with gradient background --}}
    <x-ui.section background="gradient" spacing="normal">
        <x-home.social-proof />
    </x-ui.section>
</x-layout>