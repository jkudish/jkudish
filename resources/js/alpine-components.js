// Alpine components used across the site
// Separated for better code organization and tree-shaking

export function dualRowCarousel() {
    return {
        init() {
            // Carousel initialization logic
            // This will be loaded only where needed
        }
    };
}

export function newsletterForm() {
    return {
        email: '',
        loading: false,
        message: null,
        async submit() {
            // Newsletter submission logic
        }
    };
}

export function testimonialCarousel() {
    return {
        currentIndex: 0,
        testimonials: [],
        visibleTestimonials: [],
        next() {
            // Next testimonial logic
        },
        prev() {
            // Previous testimonial logic  
        }
    };
}