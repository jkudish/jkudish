<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Joey Kudish</title>
    <link rel="preload" href="{{ url('fonts/Telegraf UltraBold 800.woff') }}" as="font"/>
    <link rel="preload" href="{{ url('fonts/muli-regular-webfont.woff2') }}" as="font"/>
    <link rel="preload" href="{{ url('fonts/muli-regular-webfont.woff') }}" as="font"/>
    <link rel="preload" href="{{ url('img/grid.svg') }}" as="image"/>
    @vite('resources/css/app.css')
</head>
<body class="dark:bg-zinc-800">
<div class="max-w-2xl mx-auto space-y-12 mt-24">
    <picture>
        <source srcset="{{ url('img/joey.webp') }}" type="image/webp">
        <source srcset="{{ url('img/joey.png') }}" type="image/png">
        <img
            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABkAAAAZCAYAAADE6YVjAAAHQElEQVR4AW2WA5wlSdZH/4GM1HOZbXf1h65pjW2ubdvefWubvbZt2zusto1y1WNmZGBjzDTj/O65IYIHLOdVq/yP1aoCgCd8+eVxTxheHXnkCkHtOp+YAZ+aDqh02iPqBDNyjJrk53py+sfPetZPWgBQrZ7Hq9U/KtxnuR9k/dZnejc969MZADztq697ZU7wl/R0FXtjj4FkKZhR4FbBZwahZxEwDdWuozk7d5oa+cHHP+Ib7wGAra6cZ7ly7oE8EHDVp16xrOCL7/X2VkZyhMABMp9YOAD1iKYhJyTgsFCpoTY1RLcdWHqRpzA3ObeNQj7s4Q//3r4bXXmjd4HofQFnvfd5Gxll2+NCbsQmmeSEacE9T3DhhUHIQj8ivgjBiCCcChb4keexwIPlWqZcdnaURqjl23/2w0dvvB1we0QAQO7OwcYPv2KZb9T2no6C6MxFshgIUfA85AOB2OPwYOARi9r4JPb/c6cDUfQsLGFwuIA4BCDbgEqkR1KR1OvSps21Vz/up/v+4HJ0j65NH3jpWLEYjXQEvuwp5UWeeygID7Hg8Akg3C4bDdz84z9j4sApFDqKqM+3UOiKMXrWIixcUABUG1a1ZexpUZud3XblI7+77h5dI+944StZHI14hKbC9wUFAacUTh2E54MzD1oaHL11H+aOTSDuLMISi66+Ejxw/OOXB7B72yR8PwdfREJmXHaUCyO//NYNrwQA0vPyJ8TdHeX95VK+txwK05mPaNkXKIcRAm3QOjWBuePjmD0xjuP7DiBgHEZrTNbrSI3Bgq5OCOFBZcDa/+3DmtWd6Ov0NFSLyWbtdDnYv4QXC+Wr/UK+lwKKM8aJBShhqJ2YwL9+8BucvulWZCYD9UI849rrsbK/H4wztHWG3UeO4bt//wdmnMYgCrB/13H8sauC665bztavK2W5OOidnB24hoPiCnq7GgbrzqAggNJoztUxdct2dK5aiX8cP4oXjG7BuavXIBK+KzAHyinWDi9EWwKv+vQXce7G1SiWxR05/OrX9kCwZdi4Lgel7BWs84LNbwp94Rqc51Qw6nYwB4kjp6u7C6dvHEOiLTYtWYr1S5eDeAK/H9uO8VoDZffN0u4OTDaa+PnfbkIptghyMcp5gVOTCVYtzVGtErDuCza91ecsChghDkQij0OAgCiFfKUAr1SAODWNMF8ESVMs6Sk7TQcx2U7QV4mwuL8PM9PTuHbjJrzqgodhbP8+jJs2qGZk6aKIcCI5p4R0MGPBiaMAsMYAlN6hwyqLniVD8DjF/9aAFYUibLONTf1DYNRDieWhEoVlgwPoLnahW+QRCx/Ts1Po7skRYwykNJ2UGExTSkEsjJIZtNLQ7qUlgKM6VRkGi0X8T9cAeru60Wyld4CGFq5EZXgpmvUGSuUS+jsr2HXsED6y+88o6wBrVxesEAza0inWd+Hmx4ah3+vBGgZLOQB3BtEKNlPIpIRoJijU2th9+jRm2xINxnFs/CQqxRgtIzHXbqI2U8M3//UPxF0Rzt08iKGhvHEMlxO1j8LabZRQwDhRSkNlGZJWG223J8470gxHswSzvnb3Tawc3YC+pUuhswbm2/PI5QtQSuF3J3agvijBBWcsRqkSIsusAQiUoWOUWvJznWVwAOKokEmKNEkcKHHnFFkq3TuDva0Guis51A7uxQIObF6zGn4QYOexIxifm8Oqrn5YJZBKhXarhjRtQWYGWtufM7v+rEN5mjxVcFZg1mhqDLUyA9Ua1sFlmsK02zg130KvJRiudLrCBSZVhuOz0/jH9m0Yde2n4nPYuoEpj4CQnCYWvFGbPp2n2fNZ8+9/z4bOP4O5FnsxkTIjxnAHgM4kMpnASy16eAkdcTeytA1iFP51fAKHZqaQyhQjSxdj0eAgYBL09fRgWvQ4XcPKj/pZKv23PeeVX/wDuWfYfduLxnKRGGHtRFqTCT+V6NUh8iQEZxwiiqCbDYx4daTWQxTlsXRo0CW/BEsA4VMcazHcOG1lQI2o1+e2P/e5zxoBAH73eGKEfZhqJtsVUSKfKPm/8bCAIVBWweMCwvMhixFaQTe29AZgIgbnAUQYwotjpArYfnhcFosVwYiVlUruYQBQdeUTAFj/TDcyfvrT2flveeZG3s7+fGH3ShFYkUqjPY8zKmUKIXzkohzqqcYQT3H+iiEUO3sBP4RWmfn9v27LZnN9fiHyZRCH5158/ln/3Lp1qxvrn5Xdo+uZ7sGn3YPnVV+6fE3v8u/lc/m1tdo8skypKAqt1pq6hko9zkmiiS1ZadZ25ozwBTky2+IzfhkwevvBA7c8rFp9594bb7zRGx0dzR40W3mmi+jTLiIA+PRnv/AqreSLGaO9HvdACIXWCkppG/g+kYbBGo0saUFxb7wzX/jg4x73iHcDwN0RPOSU6G6HblcA8PGPfzzHBLtaa1zhQCPO3FCWZRVG2YyS6hhh3jY/H/+8uXfXT55XrTYe8P89y38BHaNlTZwr11AAAAAASUVORK5CYII="
            class="mx-auto h-24 w-24 rounded-full"
            loading="lazy"
            width="612"
            height="612"
            alt="Joey Kudish">
    </picture>

    <h1 class="text-4xl font-title tracking-tight text-zinc-800 sm:text-5xl dark:text-zinc-100">Hey, I'm Joey. 👋</h1>
    <h2 class="text-2xl font-sans tracking-tight text-zinc-800 sm:text-3xl dark:text-zinc-100">I'm a ✈️ Digital Nomad,
        Friendly World Explorer 🌏, Software Engineer 👨🏻‍💻 and Entrepreneur 💼.</h2>

    <div class="mt-6 flex gap-6">
        <a class="group -m-1 p-1" aria-label="Follow on Twitter / X" href="https://twitter.com/jkudish">
            <svg viewBox="0 0 24 24" aria-hidden="true"
                 class="h-6 w-6 fill-zinc-500 transition group-hover:fill-teal-400 dark:fill-zinc-100">
                <path
                    d="M13.3174 10.7749L19.1457 4H17.7646L12.7039 9.88256L8.66193 4H4L10.1122 12.8955L4 20H5.38119L10.7254 13.7878L14.994 20H19.656L13.3171 10.7749H13.3174ZM11.4257 12.9738L10.8064 12.0881L5.87886 5.03974H8.00029L11.9769 10.728L12.5962 11.6137L17.7652 19.0075H15.6438L11.4257 12.9742V12.9738Z"></path>
            </svg>
        </a>
        <a class="group -m-1 p-1" aria-label="Follow on GitHub" href="https://github.com/jkudish">
            <svg viewBox="0 0 24 24" aria-hidden="true"
                 class="h-6 w-6 fill-zinc-500 transition group-hover:fill-teal-400 dark:fill-zinc-100">
                <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M12 2C6.475 2 2 6.588 2 12.253c0 4.537 2.862 8.369 6.838 9.727.5.09.687-.218.687-.487 0-.243-.013-1.05-.013-1.91C7 20.059 6.35 18.957 6.15 18.38c-.113-.295-.6-1.205-1.025-1.448-.35-.192-.85-.667-.013-.68.788-.012 1.35.744 1.538 1.051.9 1.551 2.338 1.116 2.912.846.088-.666.35-1.115.638-1.371-2.225-.256-4.55-1.14-4.55-5.062 0-1.115.387-2.038 1.025-2.756-.1-.256-.45-1.307.1-2.717 0 0 .837-.269 2.75 1.051.8-.23 1.65-.346 2.5-.346.85 0 1.7.115 2.5.346 1.912-1.333 2.75-1.05 2.75-1.05.55 1.409.2 2.46.1 2.716.637.718 1.025 1.628 1.025 2.756 0 3.934-2.337 4.806-4.562 5.062.362.32.675.936.675 1.897 0 1.371-.013 2.473-.013 2.82 0 .268.188.589.688.486a10.039 10.039 0 0 0 4.932-3.74A10.447 10.447 0 0 0 22 12.253C22 6.588 17.525 2 12 2Z"></path>
            </svg>
        </a>
        <a class="group -m-1 p-1" aria-label="Follow on Pinkary" href="https://pinkary.com/@jkudish">
            <svg viewBox="0 0 24 24" aria-hidden="true"
                 class="h-6 w-6 fill-zinc-500 transition group-hover:fill-teal-400 dark:fill-zinc-100 border-2 border-zinc-500 dark:border-zinc-100 rounded-full group-hover:border-teal-400">
                <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M8.79 18.35h0.248l0.069 -0.238q0.341 -1.186 0.741 -2.637v-0.001a324 324 0 0 1 0.746 -2.69 13.44 13.44 0 0 0 1.893 -0.209 9.12 9.12 0 0 0 1.412 -0.368 5.904 5.904 0 0 0 1.331 -0.657 3.408 3.408 0 0 0 1.044 -1.046c0.276 -0.436 0.406 -0.948 0.406 -1.522 0 -0.543 -0.145 -1.03 -0.444 -1.446 -0.276 -0.407 -0.643 -0.739 -1.093 -0.997a4.992 4.992 0 0 0 -1.417 -0.583 5.856 5.856 0 0 0 -1.501 -0.203q-0.685 0 -1.368 0.14 -0.669 0.137 -1.254 0.336l-0.001 0 -0.001 0q-0.555 0.195 -0.982 0.378l-0.199 0.085v0.217c0 0.176 0.085 0.325 0.173 0.439a1.68 1.68 0 0 0 0.294 0.294l0.007 0.005 0.007 0.005c0.059 0.041 0.119 0.078 0.179 0.106 0.056 0.026 0.137 0.057 0.231 0.057s0.186 -0.025 0.263 -0.053c0.081 -0.029 0.168 -0.07 0.261 -0.119l0.007 -0.003 0.006 -0.004q0.229 -0.135 0.618 -0.309l0.005 -0.002 0.004 -0.002a2.88 2.88 0 0 1 0.232 -0.099q-0.398 0.903 -0.739 1.752l0 0.002 0 0.002a107.52 107.52 0 0 0 -0.861 2.285l0 0.001 0 0.001q-0.401 1.128 -0.802 2.36a1027.68 1027.68 0 0 0 -0.858 2.619l-0.001 0.003 -0.001 0.003a18.72 18.72 0 0 1 -0.131 0.407l-0.003 0.01 -0.002 0.01a1.92 1.92 0 0 0 -0.07 0.499c0 0.387 0.212 0.684 0.541 0.887l0.002 0.001 0.002 0.001a1.968 1.968 0 0 0 1.011 0.283m5.645 -8.413c-0.236 0.349 -0.558 0.647 -0.973 0.891q-0.624 0.36 -1.414 0.573 -0.561 0.15 -1.119 0.223 0.38 -1.278 0.79 -2.46l0 -0.001q0.439 -1.275 0.907 -2.224 0.511 0.039 0.97 0.219l0.001 0 0.001 0c0.368 0.14 0.655 0.341 0.871 0.6l0.002 0.002 0.002 0.002c0.204 0.234 0.319 0.551 0.319 0.983 0 0.461 -0.12 0.853 -0.355 1.188l-0.001 0.002z"/>
                <path d="M13.147 17.423a0.984 0.984 0 1 1 -1.968 0 0.984 0.984 0 0 1 1.968 0"/>
            </svg>
        </a>
        <a class="group -m-1 p-1" aria-label="Follow on LinkedIn" href="https://www.linkedin.com/in/jkudish/">
            <svg viewBox="0 0 24 24" aria-hidden="true"
                 class="h-6 w-6 fill-zinc-500 transition group-hover:fill-teal-400 dark:fill-zinc-100">
                <path
                    d="M18.335 18.339H15.67v-4.177c0-.996-.02-2.278-1.39-2.278-1.389 0-1.601 1.084-1.601 2.205v4.25h-2.666V9.75h2.56v1.17h.035c.358-.674 1.228-1.387 2.528-1.387 2.7 0 3.2 1.778 3.2 4.091v4.715zM7.003 8.575a1.546 1.546 0 01-1.548-1.549 1.548 1.548 0 111.547 1.549zm1.336 9.764H5.666V9.75H8.34v8.589zM19.67 3H4.329C3.593 3 3 3.58 3 4.297v15.406C3 20.42 3.594 21 4.328 21h15.338C20.4 21 21 20.42 21 19.703V4.297C21 3.58 20.4 3 19.666 3h.003z"></path>
            </svg>
        </a>
    </div>
</div>
</body>
</html>
