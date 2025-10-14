// Make the callback functions available globally for Turnstile
window.turnstileCallback = function(token) {
    console.log('Turnstile token received:', token);
    window.currentTurnstileToken = token;
};

window.turnstileExpiredCallback = function() {
    console.log('Turnstile token expired');
    window.currentTurnstileToken = '';
    // Optionally reset the widget
    const widget = document.querySelector('.cf-turnstile');
    if (widget && window.turnstile) {
        window.turnstile.reset(widget);
    }
};

export default () => ({
    email: '',
    loading: false,
    message: '',
    messageType: '',

    get turnstileToken() {
        return window.currentTurnstileToken || '';
    },

    async submitNewsletter() {
        console.log('Submitting newsletter form, current token:', this.turnstileToken);
        if (!this.email) return;

        // Ensure we have a token
        if (!this.turnstileToken) {
            this.message = 'Please complete the security check.';
            this.messageType = 'error';
            setTimeout(() => { this.message = ''; }, 5000);
            return;
        }

        this.loading = true;
        this.message = '';

        try {
            const response = await fetch(window.newsletterRoutes?.store || '/newsletter', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': window.csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    email: this.email,
                    'cf-turnstile-response': this.turnstileToken
                })
            });

            const data = await response.json();

            if (response.ok) {
                this.message = data.message || 'Welcome to Human in the Loop! You\'ll receive the first issue right away.';
                this.messageType = 'success';
                this.email = '';

                // Track Fathom event
                if (window.fathom && data.track_event) {
                    window.fathom.trackEvent('newsletter_signup');
                }
            } else {
                // Handle validation errors
                if (response.status === 422 && data.errors) {
                    if (data.errors['cf-turnstile-response']) {
                        this.message = data.errors['cf-turnstile-response'][0];
                    } else if (data.errors.email) {
                        this.message = data.errors.email[0];
                    } else {
                        this.message = data.message || 'Something went wrong. Please try again.';
                    }
                } else {
                    this.message = data.message || 'Something went wrong. Please try again.';
                }
                this.messageType = 'error';
                // Reset Turnstile on error
                if (window.turnstile) {
                    const widget = document.querySelector('.cf-turnstile');
                    if (widget) window.turnstile.reset(widget);
                }
            }
        } catch (error) {
            this.message = 'Something went wrong. Please try again.';
            this.messageType = 'error';
        } finally {
            this.loading = false;
            setTimeout(() => {
                this.message = '';
            }, 5000);
        }
    }
})