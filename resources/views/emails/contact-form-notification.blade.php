<x-mail::message>
# New Contact Form Submission

You have received a new contact form submission.

## Contact Details

**Name:** {{ $formData['first_name'] }} {{ $formData['last_name'] }}  
**Email:** {{ $formData['email'] }}  
**Subject:** {{ $formData['subject'] }}  
**Newsletter Opt-in:** {{ $formData['newsletter_opt_in'] ? 'Yes' : 'No' }}

## Message

{{ $formData['message'] }}

<x-mail::button :url="'mailto:' . $formData['email']">
Reply to {{ $formData['first_name'] }}
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
