@if($circled)
    <svg class="size-6 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle cx="12" cy="12" r="11" stroke="#FF9500" stroke-opacity="0.25" stroke-width="2"></circle>
        <path stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v5"></path>
        <path fill="#fff" stroke="#fff" d="M12.5 16.5a.5.5 0 11-1 0 .5.5 0 011 0z"></path>
    </svg>
@else
    <svg class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
    </svg>
@endif