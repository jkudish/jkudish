<x-layout title="Services - Joey Kudish">
    <x-ui.section background="gradient-mesh" spacing="large">
        <header class="max-w-3xl mx-auto text-center">
            <x-ui.typography variant="h1">
                How I Can Help Your Business
            </x-ui.typography>
            <p class="mt-6 text-lg text-zinc-600 dark:text-zinc-400">
                Focused, results-driven services to transform your technology challenges into competitive advantages.
            </p>
        </header>
    </x-ui.section>
    
    <x-ui.section background="white" spacing="normal">
        <div class="space-y-20">
            @php
            $services = [
                [
                    'id' => 'code-cleanup',
                    'icon' => 'code',
                    'name' => 'Code Cleanup & Refactoring',
                    'tagline' => 'Transform your legacy codebase into maintainable, scalable software',
                    'description' => 'Your codebase has become a tangled mess. Technical debt is slowing everything down. Your team is struggling with bugs and slow development. I\'ll dive in, clean it up, establish best practices, and get your team back on track.',
                    'ideal_for' => [
                        'Teams struggling with legacy code',
                        'Products experiencing performance issues',
                        'Companies preparing for scale',
                        'Organizations needing code modernization',
                    ],
                    'deliverables' => [
                        'Comprehensive code audit report',
                        'Refactored, clean codebase',
                        'Performance optimizations (typically 50-75% improvement)',
                        'Updated documentation and best practices guide',
                        'Knowledge transfer sessions with your team',
                    ],
                    'process' => [
                        'Code audit and analysis',
                        'Priority roadmap creation',
                        'Incremental refactoring sprints',
                        'Testing and validation',
                        'Team training and handoff',
                    ],
                    'pricing' => 'Starting at $3,000/week',
                    'duration' => '2-8 weeks typical',
                    'cta' => 'Fix My Code',
                ],
                [
                    'id' => 'mvp-development',
                    'icon' => 'rocket',
                    'name' => 'MVP Development',
                    'tagline' => 'Ship your product idea in 30 days',
                    'description' => 'You have a validated idea and need to get to market fast. I\'ll help you build and ship a working MVP using Laravel, modern JavaScript, and proven architectural patterns. Get real user feedback quickly.',
                    'ideal_for' => [
                        'Startups needing their first product',
                        'Enterprises testing new ideas',
                        'Founders validating concepts',
                        'Companies entering new markets',
                    ],
                    'deliverables' => [
                        'Fully functional MVP application',
                        'Responsive web interface',
                        'Database design and implementation',
                        'Core feature set implementation',
                        'Deployment and launch support',
                    ],
                    'process' => [
                        'Requirements workshop',
                        'Technical architecture design',
                        'Sprint planning and prioritization',
                        'Rapid development cycles',
                        'Launch preparation and deployment',
                    ],
                    'pricing' => 'Fixed-price from $15,000',
                    'duration' => '30-day sprints',
                    'cta' => 'Build My MVP',
                ],
                [
                    'id' => 'automation',
                    'icon' => 'sparkles',
                    'name' => 'AI Automation',
                    'tagline' => 'Eliminate repetitive work with intelligent automation',
                    'description' => 'Stop wasting hours on repetitive tasks. Using AI (GPT-4, Claude) and workflow automation (n8n, Zapier), I\'ll build custom solutions that save your team time and create new revenue opportunities.',
                    'ideal_for' => [
                        'Teams drowning in manual processes',
                        'Companies needing customer service automation',
                        'Organizations seeking operational efficiency',
                        'Businesses wanting AI-powered features',
                    ],
                    'deliverables' => [
                        'Process analysis and optimization report',
                        'Custom automation workflows',
                        'AI model integration and training',
                        'Documentation and SOPs',
                        'Team training and support',
                    ],
                    'process' => [
                        'Process discovery workshop',
                        'Automation opportunity analysis',
                        'Workflow design and development',
                        'Testing and refinement',
                        'Training and handover',
                    ],
                    'pricing' => 'Custom pricing from $5,000',
                    'duration' => '1-4 weeks typical',
                    'cta' => 'Automate My Workflow',
                ],
            ];
            @endphp
            
            @foreach($services as $index => $service)
            <div id="{{ $service['id'] }}" class="scroll-mt-20">
                <div class="grid gap-12 lg:grid-cols-5">
                    <div class="lg:col-span-3">
                        <div class="flex items-start gap-4">
                            <x-ui.animated-icon 
                                icon="{{ $service['icon'] }}" 
                                size="w-10 h-10" 
                                animation="none" 
                                color="#06b6d4" 
                            />
                            <div>
                                <x-ui.typography variant="h2">
                                    {{ $service['name'] }}
                                </x-ui.typography>
                                <p class="mt-2 text-lg text-teal-600 dark:text-teal-400 font-medium">
                                    {{ $service['tagline'] }}
                                </p>
                            </div>
                        </div>
                        
                        <p class="mt-6 text-zinc-600 dark:text-zinc-400 leading-relaxed">
                            {{ $service['description'] }}
                        </p>
                        
                        <div class="mt-8">
                            <x-ui.typography variant="small" weight="semibold" class="uppercase tracking-wider" color="muted">
                                Ideal For
                            </x-ui.typography>
                            <ul class="mt-4 space-y-2">
                                @foreach($service['ideal_for'] as $item)
                                <li class="flex gap-3 text-zinc-600 dark:text-zinc-400">
                                    <svg class="w-5 h-5 flex-shrink-0 text-teal-600 dark:text-teal-400 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    {{ $item }}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    
                    <div class="lg:col-span-2">
                        <x-ui.gradient-border variant="primary" hover="false">
                            <div class="p-6 space-y-6">
                                <div>
                                    <x-ui.typography variant="small" weight="semibold" class="uppercase tracking-wider" color="muted">
                                        What You Get
                                    </x-ui.typography>
                                    <ul class="mt-3 space-y-2">
                                        @foreach($service['deliverables'] as $deliverable)
                                        <li class="text-sm text-zinc-600 dark:text-zinc-400 flex gap-2">
                                            <span class="text-teal-600 dark:text-teal-400">→</span>
                                            {{ $deliverable }}
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                
                                <div>
                                    <x-ui.typography variant="small" weight="semibold" class="uppercase tracking-wider" color="muted">
                                        Process
                                    </x-ui.typography>
                                    <ol class="mt-3 space-y-2">
                                        @foreach($service['process'] as $step => $process)
                                        <li class="text-sm text-zinc-600 dark:text-zinc-400 flex gap-2">
                                            <span class="text-teal-600 dark:text-teal-400 font-semibold">{{ $step + 1 }}.</span>
                                            {{ $process }}
                                        </li>
                                        @endforeach
                                    </ol>
                                </div>
                                
                                <div class="pt-4 border-t border-zinc-200 dark:border-zinc-700">
                                    <div class="flex justify-between items-center mb-4">
                                        <div>
                                            <div class="text-sm text-zinc-500 dark:text-zinc-400">Investment</div>
                                            <div class="font-semibold text-zinc-900 dark:text-zinc-100">{{ $service['pricing'] }}</div>
                                        </div>
                                        <div class="text-right">
                                            <div class="text-sm text-zinc-500 dark:text-zinc-400">Timeline</div>
                                            <div class="font-semibold text-zinc-900 dark:text-zinc-100">{{ $service['duration'] }}</div>
                                        </div>
                                    </div>
                                    
                                    <x-ui.gradient-button 
                                        variant="primary" 
                                        href="{{ route('contact') }}" 
                                        icon="true"
                                        class="w-full justify-center"
                                    >
                                        {{ $service['cta'] }}
                                    </x-ui.gradient-button>
                                </div>
                            </div>
                        </x-ui.gradient-border>
                    </div>
                </div>
                
                @if(!$loop->last)
                <div class="mt-20 border-b border-zinc-200 dark:border-zinc-800"></div>
                @endif
            </div>
            @endforeach
        </div>
    </x-ui.section>
    
    <x-ui.section background="gradient" spacing="normal">
        <div class="max-w-3xl mx-auto text-center">
            <x-ui.typography variant="h2">
                Not Sure Which Service You Need?
            </x-ui.typography>
            <p class="mt-4 text-lg text-zinc-600 dark:text-zinc-400">
                Let's have a conversation about your challenges and goals. I'll help you identify the best path forward.
            </p>
            
            <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
                <x-ui.gradient-button variant="primary" href="{{ route('contact') }}" icon="true">
                    Schedule a Free Consultation
                </x-ui.gradient-button>
                <x-ui.gradient-button variant="outline" href="mailto:joey@jkudish.com">
                    Email Me Directly
                </x-ui.gradient-button>
            </div>
            
            <p class="mt-6 text-sm text-zinc-500 dark:text-zinc-400">
                Response within 24 hours • No obligation • NDA available
            </p>
        </div>
    </x-ui.section>
    
    <x-ui.section background="white" spacing="normal">
        <div class="grid gap-8 lg:grid-cols-3">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-teal-100 dark:bg-teal-900/30 mb-4">
                    <svg class="w-6 h-6 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <x-ui.typography variant="h4">Fast Response</x-ui.typography>
                <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">
                    Initial consultation within 24-48 hours
                </p>
            </div>
            
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-teal-100 dark:bg-teal-900/30 mb-4">
                    <svg class="w-6 h-6 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <x-ui.typography variant="h4">Guaranteed Quality</x-ui.typography>
                <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">
                    15+ years of proven expertise
                </p>
            </div>
            
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-teal-100 dark:bg-teal-900/30 mb-4">
                    <svg class="w-6 h-6 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <x-ui.typography variant="h4">Results Focused</x-ui.typography>
                <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">
                    Measurable impact on your business
                </p>
            </div>
        </div>
    </x-ui.section>
    
    {{-- Payment Terms --}}
    <x-ui.section background="gray" spacing="normal">
        <div class="max-w-3xl mx-auto text-center">
            <x-ui.typography variant="h2">
                Payment Terms & Process
            </x-ui.typography>
            <x-ui.typography variant="lead" color="muted" class="mt-4">
                Simple, transparent pricing with flexible payment options
            </x-ui.typography>
            
            <div class="mt-12 grid gap-8 md:grid-cols-3">
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-gradient-to-br from-cyan-100 to-blue-100 dark:from-cyan-900/30 dark:to-blue-900/30 mb-4">
                        <span class="text-2xl">💳</span>
                    </div>
                    <x-ui.typography variant="h4">Payment Methods</x-ui.typography>
                    <x-ui.typography variant="small" color="muted" class="mt-2">
                        Bank transfer, credit card, or your company's preferred payment method
                    </x-ui.typography>
                </div>
                
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-gradient-to-br from-cyan-100 to-blue-100 dark:from-cyan-900/30 dark:to-blue-900/30 mb-4">
                        <span class="text-2xl">📊</span>
                    </div>
                    <x-ui.typography variant="h4">Payment Schedule</x-ui.typography>
                    <x-ui.typography variant="small" color="muted" class="mt-2">
                        50% upfront, 50% on completion. Larger projects can use milestone payments
                    </x-ui.typography>
                </div>
                
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-gradient-to-br from-cyan-100 to-blue-100 dark:from-cyan-900/30 dark:to-blue-900/30 mb-4">
                        <span class="text-2xl">🤝</span>
                    </div>
                    <x-ui.typography variant="h4">Contracts</x-ui.typography>
                    <x-ui.typography variant="small" color="muted" class="mt-2">
                        Simple service agreement with clear deliverables and timelines
                    </x-ui.typography>
                </div>
            </div>
            
            <div class="mt-12 p-6 rounded-2xl bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700">
                <x-ui.typography variant="body" weight="semibold">
                    Money-Back Guarantee
                </x-ui.typography>
                <x-ui.typography variant="body" color="muted" class="mt-2">
                    If you're not satisfied with the work within the first week, I'll refund your deposit in full. No questions asked.
                </x-ui.typography>
            </div>
        </div>
    </x-ui.section>
    
    {{-- FAQ Section --}}
    <x-ui.section background="white" spacing="normal">
        <x-services.faq />
    </x-ui.section>
</x-layout>