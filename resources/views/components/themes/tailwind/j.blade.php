<template x-for="toast in toasts" :key="toast.id">
    <li
        :id="toast.id"
        x-data="{toastHovered: false}"
        x-init="
            if(position.includes('bottom')){
                $el.firstElementChild.classList.add('toast-bottom');
                $el.firstElementChild.classList.add('opacity-0', 'translate-y-full');
            } else {
                $el.firstElementChild.classList.add('opacity-0', '-translate-y-full');
            }

            setTimeout(function(){
                setTimeout(function(){
                    if(position.includes('bottom')){
                        $el.firstElementChild.classList.remove('opacity-0', 'translate-y-full');
                    } else {
                        $el.firstElementChild.classList.remove('opacity-0', '-translate-y-full');
                    }
                    $el.firstElementChild.classList.add('opacity-100', 'translate-y-0');

                    setTimeout(function(){
                        stackToasts();
                    }, 10);
                }, 5);
            }, 50);

            setTimeout(function(){
                setTimeout(function(){
                    $el.firstElementChild.classList.remove('opacity-100');
                    $el.firstElementChild.classList.add('opacity-0');
                    if(toasts.length == 1){
                        $el.firstElementChild.classList.remove('translate-y-0');
                        $el.firstElementChild.classList.add('-translate-y-full');
                    }
                    setTimeout(function(){
                        deleteToastWithId(toast.id)
                    }, 300);
                }, 5);
            }, 4000);
        "
        @mouseover="toastHovered=true"
        @mouseout="toastHovered=false"
        class="absolute w-full duration-300 ease-out select-none sm:max-w-xs"
        :class="{ 'toast-no-description': !toast.description }"
    >
        <span
            class="relative flex flex-col items-start shadow-[0_5px_15px_-3px_rgb(0_0_0_/_0.08)] w-full transition-all duration-300 ease-out bg-white border border-gray-100 sm:rounded-md sm:max-w-xs group"
            :class="{ 'p-4' : !toast.html, 'p-0' : toast.html }"
        >
            <template x-if="!toast.html">
                <div class="relative">
                    <div class="flex items-center"
                         :class="{ 'text-green-500' : toast.type=='success', 'text-blue-500' : toast.type=='info', 'text-orange-400' : toast.type=='warning', 'text-red-500' : toast.type=='danger', 'text-gray-800' : toast.type=='default' }">

                        <svg x-show="toast.type=='success'" class="w-[18px] h-[18px] mr-1.5 -ml-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2ZM16.7744 9.63269C17.1238 9.20501 17.0604 8.57503 16.6327 8.22559C16.2051 7.87615 15.5751 7.93957 15.2256 8.36725L10.6321 13.9892L8.65936 12.2524C8.24484 11.8874 7.61295 11.9276 7.248 12.3421C6.88304 12.7566 6.92322 13.3885 7.33774 13.7535L9.31046 15.4903C10.1612 16.2393 11.4637 16.1324 12.1808 15.2547L16.7744 9.63269Z" fill="currentColor"></path></svg>
                        <svg x-show="toast.type=='info'" class="w-[18px] h-[18px] mr-1.5 -ml-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2ZM12 9C12.5523 9 13 8.55228 13 8C13 7.44772 12.5523 7 12 7C11.4477 7 11 7.44772 11 8C11 8.55228 11.4477 9 12 9ZM13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12V16C11 16.5523 11.4477 17 12 17C12.5523 17 13 16.5523 13 16V12Z" fill="currentColor"></path></svg>
                        <svg x-show="toast.type=='warning'" class="w-[18px] h-[18px] mr-1.5 -ml-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M9.44829 4.46472C10.5836 2.51208 13.4105 2.51168 14.5464 4.46401L21.5988 16.5855C22.7423 18.5509 21.3145 21 19.05 21L4.94967 21C2.68547 21 1.25762 18.5516 2.4004 16.5862L9.44829 4.46472ZM11.9995 8C12.5518 8 12.9995 8.44772 12.9995 9V13C12.9995 13.5523 12.5518 14 11.9995 14C11.4473 14 10.9995 13.5523 10.9995 13V9C10.9995 8.44772 11.4473 8 11.9995 8ZM12.0009 15.99C11.4486 15.9892 11.0003 16.4363 10.9995 16.9886L10.9995 16.9986C10.9987 17.5509 11.4458 17.9992 11.9981 18C12.5504 18.0008 12.9987 17.5537 12.9995 17.0014L12.9995 16.9914C13.0003 16.4391 12.5532 15.9908 12.0009 15.99Z" fill="currentColor"></path></svg>
                        <svg x-show="toast.type=='danger'" class="w-[18px] h-[18px] mr-1.5 -ml-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12ZM11.9996 7C12.5519 7 12.9996 7.44772 12.9996 8V12C12.9996 12.5523 12.5519 13 11.9996 13C11.4474 13 10.9996 12.5523 10.9996 12V8C10.9996 7.44772 11.4474 7 11.9996 7ZM12.001 14.99C11.4488 14.9892 11.0004 15.4363 10.9997 15.9886L10.9996 15.9986C10.9989 16.5509 11.446 16.9992 11.9982 17C12.5505 17.0008 12.9989 16.5537 12.9996 16.0014L12.9996 15.9914C13.0004 15.4391 12.5533 14.9908 12.001 14.99Z" fill="currentColor"></path></svg>
                        <p class="text-[13px] font-medium leading-none text-gray-800" x-text="toast.message"></p>
                    </div>
                    <p x-show="toast.description"
                       :class="{ 'pl-5' : toast.type!='default' }"
                       class="mt-1.5 text-xs leading-none opacity-70" x-text="toast.description">
                    </p>
                </div>
            </template>

            <template x-if="toast.html">
                <div x-html="toast.html"></div>
            </template>
                <span
                    @click="burnToast(toast.id)"
                    class="absolute right-0 p-1.5 mr-2.5 text-gray-400 duration-100 ease-in-out rounded-full opacity-0 cursor-pointer hover:bg-gray-50 hover:text-gray-500"
                    :class="{
                        'top-1/2 -translate-y-1/2' : !toast.description && !toast.html,
                        'top-0 mt-2.5' : (toast.description || toast.html),
                        'opacity-100' : toastHovered,
                        'opacity-0' : !toastHovered
                    }"
                >
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd">
                        </path>
                    </svg>
                </span>
        </span>
    </li>
</template>
