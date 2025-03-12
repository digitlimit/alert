@if($circled)
    <svg class="size-6 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle cx="12" cy="12" r="11" stroke="#0080F1" stroke-opacity="0.25" stroke-width="2"></circle>
        <path stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v5"></path>
        <path fill="#fff" stroke="#fff" d="M12.5 16.5a.5.5 0 11-1 0 .5.5 0 011 0z"></path>
    </svg>
@else
    <svg class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
    </svg>
@endif