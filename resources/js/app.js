import Alpine from 'alpinejs';

// Only make Alpine available globally if needed for inline x-data
window.Alpine = Alpine;

// Contact form component
Alpine.data('contactForm', (initialData) => ({
    subjectConfigs: initialData.subjectConfigs || {},
    currentSubject: initialData.currentSubject || 'General Question',
    serviceConfig: initialData.serviceConfig || null,
    
    get config() {
        return this.subjectConfigs[this.currentSubject] || this.subjectConfigs['General Question'] || {};
    }
}));

// Configure Alpine for production
Alpine.start();