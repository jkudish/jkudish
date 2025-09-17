import Alpine from 'alpinejs';

// Only make Alpine available globally if needed for inline x-data
window.Alpine = Alpine;

// Contact form component
Alpine.data('contactForm', (initialData) => ({
    subjectConfigs: initialData.subjectConfigs || {},
    currentSubject: initialData.currentSubject || 'General Question',
    serviceConfig: initialData.serviceConfig || null,
    initialConfig: initialData.initialConfig || null,
    
    get config() {
        // If we have a service config (from URL params), use it initially
        if (this.serviceConfig && this.currentSubject === this.serviceConfig.default_subject) {
            return this.serviceConfig;
        }
        // Otherwise use the subject configs
        return this.subjectConfigs[this.currentSubject] || this.subjectConfigs['General Question'] || {};
    }
}));

// Configure Alpine for production
Alpine.start();