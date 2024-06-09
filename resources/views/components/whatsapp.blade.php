@props([
    'size' => '60',
    'logo' => 'green',
    'style' => 'round'
])

@php
    $phone = Helpers::settings('social_whatsapp');
    
    // Delete the leading zero from the phone number, if it exists.
    if (strpos($phone, '0') === 0) {
        $phone = substr($phone, 1);
    }
    
    $greeting = 'Salam,';
    
    $message = "J'ai une Question/Demande d'nformation";
    // Construct the message text.
    $message = "$greeting $message";
    
    // Encode the message text for use in the URL.
    $message = urlencode($message);
    
    // Construct the WhatsApp API endpoint URL.
    $url = "https://api.whatsapp.com/send?phone=+212$phone&text=$message";
@endphp


<div class="fixed z-[100] bottom-10 right-10 flex justify-center items-center text-white">
    <a href="{{ $url }}" target="_blank" class="shadow-md w-{{ $size }} h-{{ $size }}">
        @if($logo == 'transparent')
        <svg width="{{ $size }}" height="{{ $size }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 478.165 478.165" style="enable-background:new 0 0 478.165 478.165;" 
        xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" >
            <g>
                <path id="WhatsApp" d="M478.165,232.946c0,128.567-105.057,232.966-234.679,232.966c-41.102,0-79.814-10.599-113.445-28.969   L0,478.165l42.437-125.04c-21.438-35.065-33.77-76.207-33.77-120.159C8.667,104.34,113.763,0,243.485,0   C373.108,0,478.165,104.34,478.165,232.946z M243.485,37.098c-108.802,0-197.422,87.803-197.422,195.868   c0,42.915,13.986,82.603,37.576,114.879l-24.586,72.542l75.849-23.968c31.121,20.481,68.457,32.296,108.583,32.296   c108.723,0,197.323-87.843,197.323-195.908C440.808,124.921,352.208,37.098,243.485,37.098z M361.931,286.62   c-1.395-2.331-5.22-3.746-10.898-6.814c-5.917-2.849-34.089-16.497-39.508-18.37c-5.16-1.913-8.986-2.849-12.811,2.829   c-4.005,5.638-14.903,18.629-18.23,22.354c-3.546,3.785-6.854,4.264-12.552,1.435c-5.618-2.809-24.267-8.866-46.203-28.391   c-17.055-15.042-28.67-33.711-31.997-39.508c-3.427-5.758-0.398-8.826,2.471-11.635c2.69-2.59,5.778-6.734,8.627-10.041   c2.969-3.287,3.905-5.638,5.798-9.424c1.913-3.905,0.936-7.192-0.478-10.141c-1.415-2.849-13.01-30.881-17.752-42.337   c-4.841-11.416-9.543-9.523-12.871-9.523c-3.467,0-7.212-0.478-11.117-0.478c-3.785,0-10.041,1.395-15.381,7.192   c-5.2,5.658-20.123,19.465-20.123,47.597c0,28.052,20.601,55.308,23.55,59.053c2.869,3.785,39.747,63.197,98.303,86.07   c58.476,22.872,58.476,15.321,69.115,14.365c10.38-0.956,34.069-13.867,38.811-27.096   C363.345,300.307,363.345,288.991,361.931,286.62z" fill="#2DB742"/>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            </svg>
        @elseif($logo == 'gray')
        <svg width="{{ $size }}" height="{{ $size }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 478.165 478.165" style="enable-background:new 0 0 478.165 478.165;" 
        xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve">
            <g>
                <path id="WhatsApp" d="M478.165,232.946c0,128.567-105.057,232.966-234.679,232.966c-41.102,0-79.814-10.599-113.445-28.969   L0,478.165l42.437-125.04c-21.438-35.065-33.77-76.207-33.77-120.159C8.667,104.34,113.763,0,243.485,0   C373.108,0,478.165,104.34,478.165,232.946z M243.485,37.098c-108.802,0-197.422,87.803-197.422,195.868   c0,42.915,13.986,82.603,37.576,114.879l-24.586,72.542l75.849-23.968c31.121,20.481,68.457,32.296,108.583,32.296   c108.723,0,197.323-87.843,197.323-195.908C440.808,124.921,352.208,37.098,243.485,37.098z M361.931,286.62   c-1.395-2.331-5.22-3.746-10.898-6.814c-5.917-2.849-34.089-16.497-39.508-18.37c-5.16-1.913-8.986-2.849-12.811,2.829   c-4.005,5.638-14.903,18.629-18.23,22.354c-3.546,3.785-6.854,4.264-12.552,1.435c-5.618-2.809-24.267-8.866-46.203-28.391   c-17.055-15.042-28.67-33.711-31.997-39.508c-3.427-5.758-0.398-8.826,2.471-11.635c2.69-2.59,5.778-6.734,8.627-10.041   c2.969-3.287,3.905-5.638,5.798-9.424c1.913-3.905,0.936-7.192-0.478-10.141c-1.415-2.849-13.01-30.881-17.752-42.337   c-4.841-11.416-9.543-9.523-12.871-9.523c-3.467,0-7.212-0.478-11.117-0.478c-3.785,0-10.041,1.395-15.381,7.192   c-5.2,5.658-20.123,19.465-20.123,47.597c0,28.052,20.601,55.308,23.55,59.053c2.869,3.785,39.747,63.197,98.303,86.07   c58.476,22.872,58.476,15.321,69.115,14.365c10.38-0.956,34.069-13.867,38.811-27.096   C363.345,300.307,363.345,288.991,361.931,286.62z" fill="#CBCFD5"/>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
        </svg>
        @elseif($logo == 'green')
        <svg width="{{ $size }}" height="{{ $size }}" viewBox="-2.73 0 1225.016 1225.016" xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink">
            <path fill="#E0E0E0"
                d="M1041.858 178.02C927.206 63.289 774.753.07 612.325 0 277.617 0 5.232 272.298 5.098 606.991c-.039 106.986 27.915 211.42 81.048 303.476L0 1225.016l321.898-84.406c88.689 48.368 188.547 73.855 290.166 73.896h.258.003c334.654 0 607.08-272.346 607.222-607.023.056-162.208-63.052-314.724-177.689-429.463zm-429.533 933.963h-.197c-90.578-.048-179.402-24.366-256.878-70.339l-18.438-10.93-191.021 50.083 51-186.176-12.013-19.087c-50.525-80.336-77.198-173.175-77.16-268.504.111-278.186 226.507-504.503 504.898-504.503 134.812.056 261.519 52.604 356.814 147.965 95.289 95.36 147.728 222.128 147.688 356.948-.118 278.195-226.522 504.543-504.693 504.543z" />
            <linearGradient id="a" gradientUnits="userSpaceOnUse" x1="609.77" y1="1190.114" x2="609.77"
                y2="21.084">
                <stop offset="0" stop-color="#20b038" />
                <stop offset="1" stop-color="#60d66a" />
            </linearGradient>
            <path fill="url(#a)"
                d="M27.875 1190.114l82.211-300.18c-50.719-87.852-77.391-187.523-77.359-289.602.133-319.398 260.078-579.25 579.469-579.25 155.016.07 300.508 60.398 409.898 169.891 109.414 109.492 169.633 255.031 169.57 409.812-.133 319.406-260.094 579.281-579.445 579.281-.023 0 .016 0 0 0h-.258c-96.977-.031-192.266-24.375-276.898-70.5l-307.188 80.548z" />
            <image overflow="visible" opacity=".08" width="682" height="639" xlink:href="FCC0802E2AF8A915.png"
                transform="translate(270.984 291.372)" />
            <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFF"
                d="M462.273 349.294c-11.234-24.977-23.062-25.477-33.75-25.914-8.742-.375-18.75-.352-28.742-.352-10 0-26.25 3.758-39.992 18.766-13.75 15.008-52.5 51.289-52.5 125.078 0 73.797 53.75 145.102 61.242 155.117 7.5 10 103.758 166.266 256.203 226.383 126.695 49.961 152.477 40.023 179.977 37.523s88.734-36.273 101.234-71.297c12.5-35.016 12.5-65.031 8.75-71.305-3.75-6.25-13.75-10-28.75-17.5s-88.734-43.789-102.484-48.789-23.75-7.5-33.75 7.516c-10 15-38.727 48.773-47.477 58.773-8.75 10.023-17.5 11.273-32.5 3.773-15-7.523-63.305-23.344-120.609-74.438-44.586-39.75-74.688-88.844-83.438-103.859-8.75-15-.938-23.125 6.586-30.602 6.734-6.719 15-17.508 22.5-26.266 7.484-8.758 9.984-15.008 14.984-25.008 5-10.016 2.5-18.773-1.25-26.273s-32.898-81.67-46.234-111.326z" />
            <path fill="#FFF"
                d="M1036.898 176.091C923.562 62.677 772.859.185 612.297.114 281.43.114 12.172 269.286 12.039 600.137 12 705.896 39.633 809.13 92.156 900.13L7 1211.067l318.203-83.438c87.672 47.812 186.383 73.008 286.836 73.047h.255.003c330.812 0 600.109-269.219 600.25-600.055.055-160.343-62.328-311.108-175.649-424.53zm-424.601 923.242h-.195c-89.539-.047-177.344-24.086-253.93-69.531l-18.227-10.805-188.828 49.508 50.414-184.039-11.875-18.867c-49.945-79.414-76.312-171.188-76.273-265.422.109-274.992 223.906-498.711 499.102-498.711 133.266.055 258.516 52 352.719 146.266 94.195 94.266 146.031 219.578 145.992 352.852-.118 274.999-223.923 498.749-498.899 498.749z" />
        </svg>
        @endif
    </a>
</div>