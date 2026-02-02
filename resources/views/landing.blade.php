<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Open Recruitment INTEL FASILKOM UNSRI 2026</title>

    @vite(['resources/js/app.jsx'])

    <style>
        /* --- SHAPES & SEPARATORS --- */
        .triangle-separator {
            width: 0;
            height: 0;
            border-left: 50vw solid transparent;
            border-right: 50vw solid transparent;
            border-bottom: 200px solid white;
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 20;
        }

        .sharp-line {
            clip-path: polygon(50% 0%, 100% 20px, 100% calc(100% - 20px), 50% 100%, 0% calc(100% - 20px), 0% 20px);
        }

        /* --- BACKGROUNDS --- */
        .notebook-bg {
            background-color: #f8f9fa;
            background-image: linear-gradient(#e5e7eb 1px, transparent 1px);
            background-size: 100% 32px;
            line-height: 32px;
        }

        .top-section {
            background-color: #d4db95;
            position: relative;
            padding-bottom: 200px;
        }

        /* --- TEXT EFFECTS --- */
        .text-gradient-intel {
            background: linear-gradient(to right, #d4db95, #d07270);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
        }

        .text-gradient-divisions {
            background: linear-gradient(to right, #8a9a5b, #c28575, #d07270);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
        }

        .text-gradient-custom {
            background: linear-gradient(90deg, #d4db95 0%, #d07270 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            color: transparent;
        }

        /* --- CARDS & BLURS --- */
        .division-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .division-card:hover {
            transform: translateY(-12px);
            background: rgba(255, 255, 255, 1);
            box-shadow: 0 25px 50px -12px rgba(208, 114, 112, 0.15);
        }

        /* --- FILTERS (SVG) --- */
        .filter-inner-shadow {
            filter: url(#inner-shadow-strong);
        }

        .filter-drop-shadow {
            filter: url(#drop-shadow-strong);
        }

        .filter-blur {
            filter: url(#blur-effect);
        }
    </style>
</head>

<body class="text-gray-800">
    <header class="bg-bgGreen absolute w-full z-50">
        <nav
            class="fixed w-full top-0 z-50 bg-gradient-to-r from-[#FCD9BB] to-white rounded-b-3xl transition-all duration-300">
            <div class="max-w-7xl mx-auto px-6 py-4">

                <div class="flex justify-between items-center">
                    <h1 class="font-bold text-xl md:text-3xl">
                        <span class="bg-gradient-to-r from-[#D07270] to-[#6A3A39] text-transparent bg-clip-text">
                            INTEL
                        </span>
                        <span class="bg-gradient-to-r from-white to-[#FFFAD0] text-transparent bg-clip-text">
                            UNSRI
                        </span>
                    </h1>

                    <ul class="hidden md:flex gap-6 font-medium items-center justify-center">
                        <li class="font-semibold cursor-pointer hover:text-[#D07270] transition"><a
                                href="#home">HOME</a></li>
                        <li class="font-semibold cursor-pointer hover:text-[#D07270] transition"><a
                                href="#timeline">TIMELINE</a></li>
                        <li class="font-semibold cursor-pointer hover:text-[#D07270] transition"><a
                                href="#division">DIVISION</a></li>
                        <li class="font-semibold cursor-pointer hover:text-[#D07270] transition"><a
                                href="#faq">FAQ</a></li>

                        <li>
                            @auth
                                <a href="{{ route('dashboard') }}"
                                    class="font-semibold text-white rounded-3xl py-2 px-4 bg-[#D07270] hover:bg-[#9c5655] transition cursor-pointer">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('register') }}"
                                    class="font-semibold text-white rounded-3xl py-2 px-4 bg-[#D07270] hover:bg-[#9c5655] transition cursor-pointer">
                                    Join Us!
                                </a>
                            @endauth
                        </li>
                    </ul>

                    <div class="md:hidden flex items-center">
                        <button id="mobile-menu-btn" class="text-[#D07270] focus:outline-none">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <div id="mobile-menu" class="hidden md:hidden mt-4 pt-4 border-t border-[#D07270]/20">
                    <ul class="flex flex-col gap-4 font-medium text-center pb-2">
                        <li class="font-semibold cursor-pointer hover:text-[#D07270] transition"><a
                                href="#home">HOME</a></li>
                        <li class="font-semibold cursor-pointer hover:text-[#D07270] transition"><a
                                href="#timeline">TIMELINE</a></li>
                        <li class="font-semibold cursor-pointer hover:text-[#D07270] transition"><a
                                href="#division">DIVISION</a></li>
                        <li class="font-semibold cursor-pointer hover:text-[#D07270] transition"><a
                                href="#faq">FAQ</a></li>

                        <li>
                            @auth
                                <a href="{{ route('dashboard') }}"
                                    class="block font-semibold text-white rounded-3xl py-2 px-4 bg-[#D07270] hover:bg-[#D07270]/70 w-full cursor-pointer">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('register') }}"
                                    class="block font-semibold text-white rounded-3xl py-2 px-4 bg-[#D07270] hover:bg-[#D07270]/70 w-full cursor-pointer">
                                    Join Us!
                                </a>
                            @endauth
                        </li>
                    </ul>
                </div>

            </div>
        </nav>
    </header>

    <div class="pt-24 bg-bgGreen" id="home">
        <div class="flex flex-col md:flex-row gap-6 mx-auto max-w-7xl px-4 py-2">

            <div class="w-full md:w-3/4 order-2 md:order-1 bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <h2 class="text-2xl font-bold mb-4">Konten Utama (75%)</h2>
                <p class="text-gray-600">
                    Bagian ini lebarnya 75%. Di layar desktop posisinya di KIRI.
                    Tapi kalau di layar HP, dia akan turun ke BAWAH karena kita set <code>order-2</code>.
                </p>
            </div>

            <div
                class="w-full md:w-1/4 order-1 md:order-2 bg-[#FFFAD0] p-6 rounded-xl shadow-sm border border-[#D4DB95] h-fit">
                <h3 class="text-lg font-bold text-[#6A3A39] mb-2">Info (25%)</h3>
                <p class="text-sm text-gray-700">
                    Bagian ini lebarnya 25%. Di layar HP, dia akan naik ke ATAS (urutan pertama)
                    karena kita set <code>order-1</code>.
                </p>
            </div>

        </div>
        <div id="countdown-container" class="py-8 flex flex-col items-center animate-fade-in-up">
            <p class="text-gray-500 mb-2 text-[10px] uppercase tracking-[0.2em] font-semibold">
                Registration Closes In
            </p>

            <div id="countdown"
                class="inline-flex items-center justify-center bg-white/80 backdrop-blur-sm border border-gray-200 shadow-sm rounded-full px-5 py-2">
                <span class="text-xs text-gray-400">Loading timer...</span>
            </div>
        </div>
    </div>


    <svg style="position: absolute; width: 0; height: 0; overflow: hidden" aria-hidden="true">
        <defs>
            <filter id="inner-shadow-strong" x="-50%" y="-50%" width="200%" height="200%">
                <feFlood flood-color="#a85d65" flood-opacity="0.8" />
                <feComposite operator="out" in2="SourceGraphic" />
                <feGaussianBlur stdDeviation="4" />
                <feComposite operator="atop" in2="SourceGraphic" />
            </filter>
            <filter id="drop-shadow-strong" x="-50%" y="-50%" width="200%" height="200%">
                <feDropShadow dx="2" dy="4" stdDeviation="2" flood-color="rgba(0,0,0,0.3)" />
            </filter>
            <filter id="blur-effect" x="-100%" y="-100%" width="300%" height="300%">
                <feGaussianBlur stdDeviation="3" result="blur" />
            </filter>
            <symbol id="icon-star-solid" viewBox="0 0 24 24">
                <path
                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
            </symbol>
            <symbol id="icon-star-outline" viewBox="0 0 84 86">
                <path fill="none"
                    d="M4.71334 40.3008C2.55707 39.2949 2.98456 36.1092 5.32972 35.7072L30.2962 31.429C32.121 31.1162 33.6672 29.9089 34.4136 28.2146L44.7454 4.76215C45.7265 2.53507 49.0097 2.9756 49.369 5.38256L53.1529 30.7291C53.4263 32.5603 54.5994 34.1324 56.2773 34.9152L79.2318 45.6236C81.3882 46.6295 80.9608 49.8153 78.6155 50.2172L53.6499 54.4956C51.825 54.8083 50.279 56.0156 49.5325 57.7099L39.2007 81.1624C38.2196 83.3895 34.9364 82.9489 34.5771 80.542L30.7933 55.1955C30.5199 53.3643 29.3466 51.7922 27.6689 51.0094L4.71334 40.3008Z"
                    stroke="currentColor" stroke-width="3" />
            </symbol>
            <symbol id="icon-star-blob" viewBox="0 0 222 287">
                <path
                    d="M105.4 9.01727C131.927 -13.6788 172.241 9.61622 165.824 43.9325L159.582 77.312C156.698 92.7347 163.855 108.299 177.44 116.149L203.124 130.991C234.791 149.289 223.541 197.541 187.047 199.947L164.676 201.422C147.814 202.534 133.847 214.929 130.741 231.54L126.141 256.136C119.6 291.118 72.2733 297.598 56.5691 265.663L40.293 232.564C33.6802 219.117 19.6092 210.986 4.65624 211.972L-32.1476 214.398C-67.6581 216.74 -85.6767 172.5 -58.6358 149.365L-39.6227 133.097C-26.782 122.111 -23.0168 103.82 -30.4741 88.6557L-40.3671 68.5377C-56.5064 35.7176 -20.3197 1.87563 11.3473 20.1742L37.0318 35.0158C50.6169 42.8658 67.6758 41.294 79.5977 31.0938L105.4 9.01727Z"
                    fill="currentColor" />
            </symbol>
        </defs>
    </svg>
    <div class="top-section min-h-screen relative overflow-hidden">
        <div
            class="absolute top-52 right-0 w-[250px] h-[250px] bg-[#FFFBD6] rounded-full blur-[120px] z-0 pointer-events-none opacity-60">
        </div>
        <div class="triangle-separator"></div>

        <div
            class="absolute left-8 md:left-1/2 transform md:-translate-x-1/2 top-[180px] bottom-0 w-1 bg-lineColor sharp-line z-10">
        </div>

        <div class="absolute top-16 left-1/2 transform -translate-x-1/2 text-pillPink z-20">
            <svg class="w-12 h-12 filter-inner-shadow overflow-visible" fill="currentColor">
                <use href="#icon-star-solid" />
            </svg>
        </div>

        <div class="absolute top-12 right-6 md:right-16 z-20">
            <svg class="w-16 h-16 md:w-24 md:h-24 text-starYellow filter-drop-shadow overflow-visible transform rotate-45 animate-float"
                fill="currentColor">
                <use href="#icon-star-solid" />
            </svg>
        </div>

        <div class="pt-32 text-center relative z-20" id="timeline">
            <span
                class="bg-pillPink text-white text-xl font-bold px-8 py-2 rounded-xl shadow-2xl inline-block tracking-wide">
                Time<span class="text-textRed">Line</span>
            </span>
        </div>

        <div class="max-w-4xl mx-auto mt-12 relative px-4 z-20">
            <div class="relative flex flex-col md:flex-row items-center justify-between mb-12 w-full">
                <div class="hidden md:block w-5/12"></div>
                <div
                    class="absolute left-8 md:left-1/2 w-4 h-4 bg-starYellow border-2 border-white rounded-full transform -translate-x-1/2 z-20 mt-6">
                </div>
                <div class="w-full md:w-5/12 pl-16 md:pl-0 md:ml-8 text-right relative">
                    <div class="absolute -top-6 -right-4 text-textRed opacity-80 animate-spin-slow">
                        <svg class="w-8 h-8" fill="currentColor">
                            <use href="#icon-star-outline" />
                        </svg>
                    </div>
                    <div class="bg-white p-4 rounded-xl shadow-lg relative">
                        <span
                            class="bg-textRed text-white text-xs font-bold px-3 py-1 rounded-full mb-2 inline-block">2-9
                            February</span>
                        <h3 class="font-bold text-lg text-gradient-custom">Online Registration</h3>
                        <p class="text-xs text-textRed">Fill Out the Form and Submit Your Documents Online.</p>
                    </div>
                </div>
            </div>

            <div class="relative flex flex-col md:flex-row items-center justify-between mb-12 w-full">
                <div class="w-full md:w-5/12 pl-16 md:pl-0 md:mr-8 text-left relative">
                    <div class="absolute -bottom-4 -left-4 text-pillPink opacity-90 hidden md:block animate-float"
                        style="animation-delay: 1s">
                        <svg class="w-10 h-10 filter-drop-shadow" fill="currentColor">
                            <use href="#icon-star-solid" />
                        </svg>
                    </div>
                    <div class="bg-white p-4 rounded-xl shadow-lg relative">
                        <div class="absolute -right-3 -top-3 text-starYellow rotate-12">
                            <svg class="w-12 h-12 filter-drop-shadow" fill="currentColor">
                                <use href="#icon-star-solid" />
                            </svg>
                        </div>
                        <span
                            class="bg-textRed text-white text-xs font-bold px-3 py-1 rounded-full mb-2 inline-block">14
                            February</span>
                        <h3 class="font-bold text-lg text-gradient-custom">INDRALAYA Interview</h3>
                        <p class="text-xs text-textRed">Indralaya Direct Interview Session</p>
                    </div>
                </div>
                <div
                    class="absolute left-8 md:left-1/2 w-4 h-4 bg-starYellow border-2 border-white rounded-full transform -translate-x-1/2 z-20 mt-6">
                </div>
                <div class="hidden md:block w-5/12"></div>
            </div>

            <div class="relative flex flex-col md:flex-row items-center justify-between mb-12 w-full">
                <div class="hidden md:block w-5/12 relative">
                    <div class="absolute top-1/2 right-10 text-white opacity-40">
                        <svg class="w-6 h-6" fill="currentColor">
                            <use href="#icon-star-solid" />
                        </svg>
                    </div>
                </div>
                <div
                    class="absolute left-8 md:left-1/2 w-4 h-4 bg-starYellow border-2 border-white rounded-full transform -translate-x-1/2 z-20 mt-6">
                </div>
                <div class="w-full md:w-5/12 pl-16 md:pl-0 md:ml-8 text-right relative">
                    <div class="bg-white p-4 rounded-xl shadow-lg relative">
                        <div class="absolute -left-2 -bottom-2 text-workGreen animate-bounce"
                            style="animation-duration: 3s">
                            <svg class="w-6 h-6" fill="currentColor">
                                <use href="#icon-star-solid" />
                            </svg>
                        </div>
                        <span
                            class="bg-textRed text-white text-xs font-bold px-3 py-1 rounded-full mb-2 inline-block">15
                            February</span>
                        <h3 class="font-bold text-lg text-gradient-custom">PALEMBANG Interview</h3>
                        <p class="text-xs text-textRed">Palembang Direct Interview Session</p>
                    </div>
                </div>
            </div>

            <div class="relative flex flex-col md:flex-row items-center justify-between mb-24 w-full">
                <div class="w-full md:w-5/12 pl-16 md:pl-0 md:mr-8 text-left relative">
                    <div class="absolute top-0 right-full mr-0 md:mr-4 w-0 h-0 visible">
                        <div
                            class="absolute -top-10 -left-[150px] w-[300px] h-[300px] bg-[#FFFBD6] rounded-full blur-[80px] -z-10 opacity-70">
                        </div>
                        {{-- <div
                            class="absolute top-[-40px] right-[-40px] md:right-[-60px] text-starYellow pointer-events-none z-0 transform -rotate-12 scale-110">
                            <svg class="w-32 md:w-48 h-auto overflow-visible opacity-90" viewBox="-150 -150 262 327"
                                fill="currentColor">
                                <use href="#icon-star-blob" />
                            </svg>
                        </div> --}}
                    </div>
                    <div class="bg-white p-4 rounded-xl shadow-lg relative z-20">
                        <span
                            class="bg-textRed text-white text-xs font-bold px-3 py-1 rounded-full mb-2 inline-block">20
                            February</span>
                        <h3 class="font-bold text-lg text-gradient-custom">Announcement</h3>
                        <p class="text-xs text-textRed">Final Announcement The Big Day!</p>
                    </div>
                </div>
                <div
                    class="absolute left-8 md:left-1/2 w-4 h-4 bg-starYellow border-2 border-white rounded-full transform -translate-x-1/2 z-20 mt-6">
                </div>
                <div class="hidden md:block w-5/12"></div>
            </div>
        </div>
    </div>

    <div class="bg-white relative pt-4 pb-20 px-4 overflow-hidden">
        <div class="text-center mb-16 relative">
            <div class="flex items-center justify-center relative">
                <div class="transform -translate-y-4 translate-x-2 md:translate-x-0 text-textRed">
                    <svg class="w-16 h-16 md:w-20 md:h-20 transform -rotate-12 overflow-visible">
                        <use href="#icon-star-outline" />
                    </svg>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold px-4 z-10 relative">
                    <span class="text-workGreen">Work</span><span class="text-flowRed">Flow</span>
                </h2>
                <div class="transform translate-y-4 -translate-x-2 md:translate-x-0 text-textRed">
                    <svg class="w-16 h-16 md:w-20 md:h-20 transform rotate-12 overflow-visible">
                        <use href="#icon-star-outline" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 px-4 md:px-0 relative z-10">
            <div
                class="relative bg-white border-2 border-cardBorder rounded-3xl p-6 text-center pt-10 group hover:shadow-xl transition-shadow duration-300">
                <div
                    class="absolute -top-6 left-1/2 transform -translate-x-1/2 bg-flowRed text-white w-12 h-12 rounded-full flex items-center justify-center text-3xl shadow-md font-porter">
                    1</div>
                <div class="flex justify-center mb-4">
                    <svg class="w-20 h-20 md:w-24 md:h-24" viewBox="0 0 127 132" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g filter="url(#filter0_i_281_3710)">
                            <path d="M110.803 7.75H35.0889V96.5133H110.803V7.75Z" stroke="#D4DB95" stroke-width="10"
                                stroke-miterlimit="10" />
                            <path d="M91.911 96.5132V116.25H16.1973V27.4866H35.0885" stroke="#D4DB95"
                                stroke-width="10" stroke-miterlimit="10" />
                            <path d="M49.3193 32.395H96.6218" stroke="#D4DB95" stroke-width="8"
                                stroke-miterlimit="10" />
                            <path d="M49.3193 52.1316H96.6218" stroke="#D4DB95" stroke-width="8"
                                stroke-miterlimit="10" />
                            <path d="M49.3193 71.8684H77.681" stroke="#D4DB95" stroke-width="8"
                                stroke-miterlimit="10" />
                        </g>
                    </svg>
                </div>
                <h3 class="text-textGreen font-bold text-lg mb-2">Register First</h3>
                <p class="text-s text-textGreen">Register using your active E-mail and Fill the personal data.</p>
            </div>

            <div
                class="relative bg-white border-2 border-cardBorder rounded-3xl p-6 text-center pt-10 group hover:shadow-xl transition-shadow duration-300">
                <div
                    class="absolute -top-6 left-1/2 transform -translate-x-1/2 bg-flowRed text-white w-12 h-12 rounded-full flex items-center justify-center text-3xl shadow-md font-porter">
                    2</div>
                <div class="flex justify-center mb-4">
                    <svg class="w-20 h-20 md:w-24 md:h-24" viewBox="0 0 120 120" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g filter="url(#filter0_i_281_3710)">
                            <path
                                d="M50.45 102.95C74.1706 102.95 93.4 83.7207 93.4 60C93.4 36.2794 74.1706 17.05 50.45 17.05C26.7294 17.05 7.5 36.2794 7.5 60C7.5 83.7207 26.7294 102.95 50.45 102.95Z"
                                stroke="#D4DB95" stroke-width="10" stroke-miterlimit="10" />
                            <path
                                d="M50.4496 83.8499C63.6216 83.8499 74.2996 73.1719 74.2996 59.9999C74.2996 46.8279 63.6216 36.1499 50.4496 36.1499C37.2776 36.1499 26.5996 46.8279 26.5996 59.9999C26.5996 73.1719 37.2776 83.8499 50.4496 83.8499Z"
                                stroke="#D4DB95" stroke-width="10" stroke-miterlimit="10" />
                            <path d="M50.4502 60H102.95" stroke="#D4DB95" stroke-width="10" stroke-miterlimit="10" />
                            <path d="M112.5 50.45L102.95 60" stroke="#D4DB95" stroke-width="10"
                                stroke-miterlimit="10" />
                            <path d="M112.5 69.55L102.95 60" stroke="#D4DB95" stroke-width="10"
                                stroke-miterlimit="10" />
                            <path
                                d="M50.4502 64.75C53.0735 64.75 55.2002 62.6234 55.2002 60C55.2002 57.3766 53.0735 55.25 50.4502 55.25C47.8268 55.25 45.7002 57.3766 45.7002 60C45.7002 62.6234 47.8268 64.75 50.4502 64.75Z"
                                stroke="#D4DB95" stroke-width="10" stroke-miterlimit="10" />
                        </g>
                        <defs>
                            <filter id="filter0_i_281_3710" x="0" y="0" width="120" height="124"
                                filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix"
                                    result="shape" />
                                <feColorMatrix in="SourceAlpha" type="matrix"
                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                <feOffset dy="4" />
                                <feGaussianBlur stdDeviation="2" />
                                <feComposite in2="hardAlpha" operator="arithmetic" k2="-1" k3="1" />
                                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
                                <feBlend mode="normal" in2="shape" result="effect1_innerShadow_281_3710" />
                            </filter>
                        </defs>
                    </svg>
                </div>
                <h3 class="text-textGreen font-bold text-lg mb-2">Choose Your Division</h3>
                <p class="text-s text-textGreen">Choose up to 2 division you are interested.</p>
            </div>

            <div
                class="relative bg-white border-2 border-cardBorder rounded-3xl p-6 text-center pt-10 group hover:shadow-xl transition-shadow duration-300">
                <div
                    class="absolute -top-6 left-1/2 transform -translate-x-1/2 bg-flowRed text-white w-12 h-12 rounded-full flex items-center justify-center text-3xl shadow-md font-porter">
                    3</div>
                <div class="flex justify-center mb-4">
                    <svg class="w-20 h-20 md:w-24 md:h-24" viewBox="0 0 128 128" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g filter="url(#filter0_i_281_3710)">
                            <path
                                d="M23.3504 31.4C29.9502 31.4 35.3004 26.0498 35.3004 19.45C35.3004 12.8502 29.9502 7.5 23.3504 7.5C16.7506 7.5 11.4004 12.8502 11.4004 19.45C11.4004 26.0498 16.7506 31.4 23.3504 31.4Z"
                                stroke="#D4DB95" stroke-width="10" stroke-miterlimit="10" />
                            <path
                                d="M104.65 31.4C111.25 31.4 116.6 26.0498 116.6 19.45C116.6 12.8502 111.25 7.5 104.65 7.5C98.0504 7.5 92.7002 12.8502 92.7002 19.45C92.7002 26.0498 98.0504 31.4 104.65 31.4Z"
                                stroke="#D4DB95" stroke-width="10" stroke-miterlimit="10" />
                            <path
                                d="M35.3004 60V52.95C35.3004 49.7807 34.0414 46.7411 31.8003 44.5001C29.5593 42.259 26.5197 41 23.3504 41C20.1811 41 17.1415 42.259 14.9005 44.5001C12.6594 46.7411 11.4004 49.7807 11.4004 52.95V84H44.8504V117.5"
                                stroke="#D4DB95" stroke-width="10" stroke-miterlimit="10" />
                            <path
                                d="M92.7004 60V52.95C92.7004 49.7807 93.9594 46.7411 96.2005 44.5001C98.4415 42.259 101.481 41 104.65 41C107.82 41 110.859 42.259 113.1 44.5001C115.341 46.7411 116.6 49.7807 116.6 52.95V84H83.1504V117.5"
                                stroke="#D4DB95" stroke-width="10" stroke-miterlimit="10" />
                            <path d="M30.5 69.6499H97.5" stroke="#D4DB95" stroke-width="10" stroke-miterlimit="10" />
                            <path d="M64 117.5V69.6499" stroke="#D4DB95" stroke-width="10" stroke-miterlimit="10" />
                        </g>
                    </svg>
                </div>
                <h3 class="text-textGreen font-bold text-lg mb-2">Attend Interview</h3>
                <p class="text-s text-textGreen">Conduct interviews according to the schedule provided</p>
            </div>

            <div
                class="relative bg-white border-2 border-cardBorder rounded-3xl p-6 text-center pt-10 group hover:shadow-xl transition-shadow duration-300">
                <div
                    class="absolute -top-6 left-1/2 transform -translate-x-1/2 bg-flowRed text-white w-12 h-12 rounded-full flex items-center justify-center text-3xl shadow-md font-porter">
                    4</div>
                <div class="flex justify-center mb-4">
                    <svg class="w-20 h-20 md:w-24 md:h-24 overflow-visible" viewBox="-10 -10 128 128" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g filter="url(#filter0_i_281_3710)">
                            <path
                                d="M102.95 74.3V50.45C102.937 39.063 98.4074 28.1462 90.3556 20.0944C82.3038 12.0426 71.387 7.51323 60 7.5C48.613 7.51323 37.6962 12.0426 29.6444 20.0944C21.5926 28.1462 17.0632 39.063 17.05 50.45V74.3L7.5 83.85V93.4H112.5V83.85L102.95 74.3Z"
                                stroke="#D4DB95" stroke-width="10" stroke-miterlimit="10" />
                            <path
                                d="M73.4498 93.3999C74.0651 94.9928 74.3542 96.6931 74.2998 98.3999C74.2998 102.192 72.7932 105.83 70.1114 108.512C67.4297 111.193 63.7924 112.7 59.9998 112.7C56.2072 112.7 52.57 111.193 49.8882 108.512C47.2064 105.83 45.6998 102.192 45.6998 98.3999C45.6455 96.6931 45.9345 94.9928 46.5498 93.3999"
                                stroke="#D4DB95" stroke-width="10" stroke-miterlimit="10" />
                        </g>
                    </svg>
                </div>
                <h3 class="text-textGreen font-bold text-lg mb-2">Waiting For The Announcement</h3>
                <p class="text-s text-textGreen">Check the announcement on this dashboard</p>
            </div>
        </div>

        <div class="absolute -right-5 -bottom-5 transform rotate-[-18deg] opacity-80 pointer-events-none z-0">
            <svg class="w-32 h-32 filter-blur overflow-visible text-textRed">
                <use href="#icon-star-outline" />
            </svg>
        </div>
    </div>

    <section class="notebook-bg py-20 px-6 md:px-10 relative overflow-hidden bg-[#fafafa]">
        <div class="absolute inset-0 opacity-10 pointer-events-none"
            style="background-image: linear-gradient(#9ca3af 1px, transparent 1px); background-size: 100% 3rem;"></div>
        <div class="absolute top-20 right-10 w-64 h-64 bg-[#D4DB95] opacity-10 blur-[100px] rounded-full"></div>
        <div class="absolute top-1/2 left-1/4 w-96 h-96 bg-[#8A9A5B] opacity-5 blur-[120px] rounded-full"></div>

        <div class="absolute top-10 left-6 md:left-16 z-0 opacity-40 rotate-[-15deg]">
            <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="#8A9A5B"
                stroke-width="2">
                <path d="M12 2L14.8 9.2L22 12L14.8 14.8L12 22L9.2 14.8L2 12L9.2 9.2L12 2Z" />
            </svg>
        </div>

        <div class="absolute bottom-[55%] left-4 md:left-10 z-0 opacity-30 rotate-[20deg] scale-125">
            <svg width="120" height="120" viewBox="0 0 24 24" fill="#D4DB95">
                <path d="M12 2L14.8 9.2L22 12L14.8 14.8L12 22L9.2 14.8L2 12L9.2 9.2L12 2Z" />
            </svg>
        </div>

        <div class="absolute top-10 right-6 md:right-16 z-0 opacity-40 rotate-[-15deg]">
            <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="#FF5F5F"
                stroke-width="2">
                <path
                    d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
            </svg>
        </div>

        <div class="container mx-auto relative z-10 mt-24">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-7xl font-black tracking-widest uppercase">
                    <span class="text-gradient-intel">Intel Profile</span>
                </h2>
            </div>

            <div class="flex flex-col md:flex-row justify-center items-center gap-8 md:gap-4 mb-16">
                <div
                    class="w-2/3 md:w-1/4 h-56 md:h-64 bg-white rounded-[40px] p-3 shadow-lg transform -rotate-3 hover:rotate-0 transition-all duration-300 border border-gray-100">
                    <div
                        class="w-full h-full rounded-[30px] overflow-hidden grayscale opacity-80 hover:grayscale-0 hover:opacity-100 transition-all">
                        <img src="{{ asset('assets\images\foto2.jpeg') }}" class="w-full h-full object-cover"
                            alt="Profile Kiri" />
                    </div>
                </div>

                <div
                    class="w-full md:w-2/5 h-72 md:h-96 bg-white rounded-[50px] p-4 shadow-2xl border-[12px] md:border-[18px] border-white relative z-20 scale-105 md:scale-110">
                    <div class="w-full h-full rounded-[35px] overflow-hidden shadow-inner">
                        <img src="{{ asset('assets\images\foto1.jpeg') }}" class="w-full h-full object-cover"
                            alt="Profile Tengah" />
                    </div>
                </div>

                <div
                    class="w-2/3 md:w-1/4 h-56 md:h-64 bg-white rounded-[40px] p-3 shadow-lg transform rotate-3 hover:rotate-0 transition-all duration-300 border border-gray-100">
                    <div
                        class="w-full h-full rounded-[30px] overflow-hidden grayscale opacity-80 hover:grayscale-0 hover:opacity-100 transition-all">
                        <img src="{{ asset('assets\images\foto3.jpeg') }}" class="w-full h-full object-cover"
                            alt="Profile Kanan" />
                    </div>
                </div>
            </div>

            <div class="relative max-w-4xl mx-auto text-center">
                <p
                    class="font-bold text-gray-800 text-base md:text-lg italic leading-relaxed px-4 md:px-12 bg-white/60 backdrop-blur-sm py-6 rounded-3xl shadow-sm">
                    "The Autonomous Body of Ilkom’s Community of English Lovers (BO INTEL), established in 2008, is an
                    organization within the Faculty of Computer Science that focuses on the field of English
                    linguistics... <span class="text-[#D07270]">#IntelCanDoIt</span>."
                </p>
            </div>
        </div>

        <div class="pt-36 relative z-20" id="division">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-20 relative">
                    <h2 class="text-5xl md:text-6xl font-black tracking-tight uppercase relative z-10">
                        <span class="text-gradient-divisions">Our Divisions</span>
                    </h2>
                    <div class="w-24 h-1.5 bg-[#D4DB95] mx-auto mt-4 rounded-full opacity-50"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 items-stretch">
                    <div class="relative group flex">
                        <div
                            class="absolute -inset-1 bg-gradient-to-r from-[#D4DB95] to-[#8A9A5B] rounded-[45px] blur opacity-25 group-hover:opacity-60 transition duration-500">
                        </div>
                        <div
                            class="relative w-full division-card bg-white/80 backdrop-blur-md p-8 rounded-3xl shadow-xl border border-white flex flex-col items-center text-center transition-all duration-300 hover:-translate-y-2">
                            <h3 class="text-2xl font-black text-[#6F8746] mb-4">MEDINFO</h3>
                            <div
                                class="w-20 h-20 bg-[#FCD9BB]/40 rounded-3xl flex items-center justify-center mb-6 shadow-inner">
                                <svg class="w-10 h-10 text-[#D07270]" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" stroke-width="2">
                                    <path
                                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                                    </path>
                                </svg>
                            </div>
                            <div
                                class="flex flex-wrap justify-center gap-2 mb-6 text-[9px] font-extrabold uppercase min-h-[40px]">
                                <span
                                    class="border-2 border-[#D4DB95] text-[#8A9A5B] px-3 py-1 rounded-full">Mulmed</span>
                                <span
                                    class="border-2 border-[#D4DB95] text-[#8A9A5B] px-3 py-1 rounded-full">Videography</span>
                                <span class="border-2 border-[#D07270]/30 text-[#D07270] px-3 py-1 rounded-full">Public
                                    Relation</span>
                            </div>
                            <p class="text-sm text-gray-500 font-semibold mt-auto">Managing information media and
                                organizational visual design, while ensuring that all organizational information is
                                conveyed in an engaging and widespread manner.</p>
                        </div>
                    </div>

                    <div class="relative group flex">
                        <div
                            class="absolute -inset-1 bg-gradient-to-r from-[#D4DB95] to-[#8A9A5B] rounded-[45px] blur opacity-25 group-hover:opacity-60 transition duration-500">
                        </div>
                        <div
                            class="relative w-full division-card bg-white/80 backdrop-blur-md p-8 rounded-3xl shadow-xl border border-white flex flex-col items-center text-center transition-all duration-300 hover:-translate-y-2">
                            <h3 class="text-2xl font-black text-[#6F8746] mb-4">COMPETITION</h3>
                            <div
                                class="w-20 h-20 bg-[#FCD9BB]/40 rounded-3xl flex items-center justify-center mb-6 shadow-inner">
                                <svg class="w-10 h-10 text-[#D07270]" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" stroke-width="2">
                                    <path
                                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <div
                                class="grid grid-cols-2 gap-1.5 mb-6 text-[7px] font-extrabold uppercase min-h-[40px]">
                                <span
                                    class="border-2 border-[#D4DB95] text-[#8A9A5B] px-1 py-1 rounded-full text-center">Debate</span>
                                <span
                                    class="border-2 border-[#D07270]/30 text-[#D07270] px-1 py-1 rounded-full text-center">Scrabble</span>
                                <span
                                    class="border-2 border-[#D4DB95] text-[#8A9A5B] px-1 py-1 rounded-full text-center">Toastmaster</span>
                                <span
                                    class="border-2 border-[#D07270]/30 text-[#D07270] px-1 py-1 rounded-full text-center">Newscasting</span>
                            </div>
                            <p class="text-sm text-gray-500 font-semibold mt-auto">Preparing delegates to participate
                                in English competitions, which include Debate, Scrabble, Toastmasters, and Newscasting.
                            </p>
                        </div>
                    </div>

                    <div class="relative group flex">
                        <div
                            class="absolute -inset-1 bg-gradient-to-r from-[#D4DB95] to-[#8A9A5B] rounded-[45px] blur opacity-25 group-hover:opacity-60 transition duration-500">
                        </div>
                        <div
                            class="relative w-full division-card bg-white/80 backdrop-blur-md p-8 rounded-3xl shadow-xl border border-white flex flex-col items-center text-center transition-all duration-300 hover:-translate-y-2">
                            <h3 class="text-2xl font-black text-[#6F8746] mb-4">ARRAIT</h3>
                            <div
                                class="w-20 h-20 bg-[#FCD9BB]/40 rounded-3xl flex items-center justify-center mb-6 shadow-inner">
                                <svg class="w-10 h-10 text-[#D07270]" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" stroke-width="2">
                                    <path
                                        d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <div
                                class="flex flex-wrap justify-center gap-2 mb-6 text-[9px] font-extrabold uppercase min-h-[40px]">
                                <span
                                    class="border-2 border-[#D07270]/30 text-[#D07270] px-3 py-1 rounded-full">Arrait</span>
                            </div>
                            <p class="text-sm text-gray-500 font-semibold mt-auto">A platform for potential development
                                that focuses on facilitating members' interests and talents through various training
                                programs and self-appreciation activities.</p>
                        </div>
                    </div>

                    <div class="relative group flex">
                        <div
                            class="absolute -inset-1 bg-gradient-to-r from-[#D4DB95] to-[#8A9A5B] rounded-[45px] blur opacity-25 group-hover:opacity-60 transition duration-500">
                        </div>
                        <div
                            class="relative w-full division-card bg-white/80 backdrop-blur-md p-8 rounded-3xl shadow-xl border border-white flex flex-col items-center text-center transition-all duration-300 hover:-translate-y-2">
                            <h3 class="text-2xl font-black text-[#6F8746] mb-4">HRD</h3>
                            <div
                                class="w-20 h-20 bg-[#FCD9BB]/40 rounded-3xl flex items-center justify-center mb-6 shadow-inner">
                                <svg class="w-10 h-10 text-[#D07270]" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" stroke-width="2">
                                    <path
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                    </path>
                                </svg>
                            </div>
                            <div
                                class="flex flex-wrap justify-center gap-2 mb-6 text-[9px] font-extrabold uppercase min-h-[40px]">
                                <span
                                    class="border-2 border-[#D07270]/30 text-[#D07270] px-3 py-1 rounded-full">HRD</span>
                            </div>
                            <p class="text-sm text-gray-500 font-semibold mt-auto">Developing human resources and
                                internal bonding, as well as maintaining the effectiveness of organizational performance
                                from a human resources perspective.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="absolute -bottom-16 -left-16 opacity-10 rotate-45 z-0">
            <svg width="300" height="300" viewBox="0 0 24 24" fill="#8A9A5B">
                <path
                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
            </svg>
        </div>
    </section>

    <div class="max-w-full max-w7xl mt-16 py-26 px-4 flex flex-col gap-8 items-center justify-center">
        <div
            className="absolute -top-20 -left-20 w-96 h-96 bg-[#BADD7F] rounded-full blur-[100px] opacity-60 pointer-events-none z-10">
        </div>
        <p
            class="text-3xl md:text-4xl font-semibold text-center bg-gradient-to-r from-[#BADD7F] to to-[#647744] bg-clip-text text-transparent">
            IF YOU JOIN
            INTEL, YOU WILL GET:
        </p>
        <div>
            <p
                class="text-center text-8xl md:text-9xl tracking-tight font-bold bg-gradient-to-r from-[#6F8746] via-[#F1B2BA] to-[#FFFAD0] bg-clip-text text-transparent">
                PATH
            </p>
            <p class="text-center text-sm text-[#647744]">#OurHomeWhereWeGrowWhatWeOwn</p>
        </div>

        <div class="relative w-full max-w-3xl mx-auto p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <div
                    class="bg-[#D4DB95] p-8 rounded-3xl md:rounded-none md:rounded-tr-[80px] md:rounded-bl-[80px] shadow-sm h-48 flex items-center justify-center">
                    <p class="font-bold text-center text-[#38402B]"><span
                            class="text-[#D07270] text-6xl">P</span>ositive <br>
                        Environtment</p>
                </div>

                <div
                    class="bg-[#FFE5E8]  p-8 rounded-3xl md:rounded-none md:rounded-tl-[80px] md:rounded-br-[80px] shadow-sm h-48 flex items-center justify-center">
                    <p class="font-bold text-center text-[#D07270]"><span
                            class="text-[#6F8746] text-6xl">A</span>ctive <br> English
                    </p>
                </div>

                <div
                    class="bg-[#FFE5E8] order-last md:order-none p-8 rounded-3xl md:rounded-none md:rounded-tl-[80px] md:rounded-br-[80px] shadow-sm h-48 flex items-center justify-center">
                    <p class="font-bold text-center text-[#D07270]"><span
                            class="text-[#6F8746] text-6xl">T</span>alent <br> Development
                    </p>
                </div>

                <div
                    class="bg-[#D4DB95]  p-8 rounded-3xl md:rounded-none md:rounded-tr-[80px] md:rounded-bl-[80px] shadow-sm h-48 flex items-center justify-center">
                    <p class="font-bold text-center text-[#38402B]"><span
                            class="text-[#D07270] text-6xl">H</span>armony
                        in<br>Teamwork</p>
                </div>

            </div>

            <div
                class="hidden md:flex absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-[#8EC28E] p-10 rounded-full z-10 pointer-events-none">
                <div class="w-20 h-20 rounded-full overflow-hidden flex items-center justify-center">
                    <img src="assets\images\logo.png" alt="Logo Center" class="w-full h-full object-cover" />
                </div>
            </div>

        </div>
    </div>

    <div class="max-w-full sm:max-w-xl md:max-w-2xl lg:max-w-3xl mx-auto space-y-3 md:space-y-4 py-24 px-4"
        id="faq">
        <div class="mb-6 md:mb-8 text-center px-2">
            <h2 class="text-3xl sm:text-4xl md:text-4xl font-bold text-textGreen mb-1 md:mb-2">FAQs</h2>
            <p class="text-sm sm:text-base text-textRed">Frequently asked questions about INTEL Recruitment</p>
        </div>

        <details
            class="group rounded-xl sm:rounded-2xl border-2 border-cardBorder overflow-hidden bg-white shadow-sm hover:shadow-md transition-all duration-300 ease-out">
            <summary
                class="flex cursor-pointer list-none items-center justify-between px-4 py-4 sm:px-5 sm:py-4 md:px-6 md:py-5 font-semibold text-sm sm:text-base text-gray-800 hover:bg-bgGreen/10 transition-colors duration-200 ease-out group-open:bg-bgGreen/20 group-open:border-b-2 group-open:border-cardBorder">
                <span class="flex items-center gap-2 sm:gap-3 flex-1 min-w-0">
                    <span
                        class="flex h-7 w-7 sm:h-8 sm:w-8 flex-shrink-0 items-center justify-center rounded-lg bg-bgGreen/30 text-textGreen font-bold text-xs sm:text-sm">1</span>
                    <span class="truncate sm:whitespace-normal">What is INTEL?</span>
                </span>
                <svg class="h-5 w-5 sm:h-6 sm:w-6 flex-shrink-0 ml-2 text-textRed transition-transform duration-300 ease-out group-open:rotate-180"
                    fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </summary>
            <div
                class="px-4 py-4 sm:px-5 sm:py-4 md:px-6 md:py-5 text-sm sm:text-base text-gray-600 leading-relaxed bg-white">
                INTEL (Ilkom’s Community of English Lovers) is an autonomous body in the Faculty of Computer Science,
                Sriwijaya University, that focuses on developing English skills, linguistics, and soft skills through
                various divisions and activities.
            </div>
        </details>

        <details
            class="group rounded-xl sm:rounded-2xl border-2 border-cardBorder overflow-hidden bg-white shadow-sm hover:shadow-md transition-all duration-300 ease-out">
            <summary
                class="flex cursor-pointer list-none items-center justify-between px-4 py-4 sm:px-5 sm:py-4 md:px-6 md:py-5 font-semibold text-sm sm:text-base text-gray-800 hover:bg-bgGreen/10 transition-colors duration-200 ease-out group-open:bg-bgGreen/20 group-open:border-b-2 group-open:border-cardBorder">
                <span class="flex items-center gap-2 sm:gap-3 flex-1 min-w-0">
                    <span
                        class="flex h-7 w-7 sm:h-8 sm:w-8 flex-shrink-0 items-center justify-center rounded-lg bg-bgGreen/30 text-textGreen font-bold text-xs sm:text-sm">2</span>
                    <span class="truncate sm:whitespace-normal">How can I join INTEL 2026?</span>
                </span>
                <svg class="h-5 w-5 sm:h-6 sm:w-6 flex-shrink-0 ml-2 text-textRed transition-transform duration-300 ease-out group-open:rotate-180"
                    fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </summary>
            <div
                class="px-4 py-4 sm:px-5 sm:py-4 md:px-6 md:py-5 text-sm sm:text-base text-gray-600 leading-relaxed bg-white">
                INTEL is currently opening its recruitment. You can join by following the registration process all the
                way through the interview stage according to the provided timeline. For FASILKOM UNSRI students from
                batch of 2024 and 2025, this is your chance, secure your seat and join us!
            </div>
        </details>

        <details
            class="group rounded-xl sm:rounded-2xl border-2 border-cardBorder overflow-hidden bg-white shadow-sm hover:shadow-md transition-all duration-300 ease-out">
            <summary
                class="flex cursor-pointer list-none items-center justify-between px-4 py-4 sm:px-5 sm:py-4 md:px-6 md:py-5 font-semibold text-sm sm:text-base text-gray-800 hover:bg-bgGreen/10 transition-colors duration-200 ease-out group-open:bg-bgGreen/20 group-open:border-b-2 group-open:border-cardBorder">
                <span class="flex items-center gap-2 sm:gap-3 flex-1 min-w-0">
                    <span
                        class="flex h-7 w-7 sm:h-8 sm:w-8 flex-shrink-0 items-center justify-center rounded-lg bg-bgGreen/30 text-textGreen font-bold text-xs sm:text-sm">3</span>
                    <span class="truncate sm:whitespace-normal">What divisions are available in INTEL?
                    </span>
                </span>
                <svg class="h-5 w-5 sm:h-6 sm:w-6 flex-shrink-0 ml-2 text-textRed transition-transform duration-300 ease-out group-open:rotate-180"
                    fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </summary>
            <div
                class="px-4 py-4 sm:px-5 sm:py-4 md:px-6 md:py-5 text-sm sm:text-base text-gray-600 leading-relaxed bg-white">
                INTEL offers a wide variety of divisions, INdies!. You can choose from HRD, Arait, Medinfo (Public
                Relations, Multimedia, Videography & Documentation), and Competition (Newscasting, Toastmaster, Debate,
                and Scrabble). Perfect for boosting both your academic and organizational skills. exciting, right?
            </div>
        </details>

        <details
            class="group rounded-xl sm:rounded-2xl border-2 border-cardBorder overflow-hidden bg-white shadow-sm hover:shadow-md transition-all duration-300 ease-out">
            <summary
                class="flex cursor-pointer list-none items-center justify-between px-4 py-4 sm:px-5 sm:py-4 md:px-6 md:py-5 font-semibold text-sm sm:text-base text-gray-800 hover:bg-bgGreen/10 transition-colors duration-200 ease-out group-open:bg-bgGreen/20 group-open:border-b-2 group-open:border-cardBorder">
                <span class="flex items-center gap-2 sm:gap-3 flex-1 min-w-0">
                    <span
                        class="flex h-7 w-7 sm:h-8 sm:w-8 flex-shrink-0 items-center justify-center rounded-lg bg-bgGreen/30 text-textGreen font-bold text-xs sm:text-sm">4</span>
                    <span class="truncate sm:whitespace-normal">Can I choose more than one division?</span>
                </span>
                <svg class="h-5 w-5 sm:h-6 sm:w-6 flex-shrink-0 ml-2 text-textRed transition-transform duration-300 ease-out group-open:rotate-180"
                    fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </summary>
            <div
                class="px-4 py-4 sm:px-5 sm:py-4 md:px-6 md:py-5 text-sm sm:text-base text-gray-600 leading-relaxed bg-white">
                Absolutely yes, INdies! 🫵🏻 For this recruitment period, you are allowed to choose <span
                    class="font-bold text-textGreen">up to two divisions</span> you’re interested in. So don’t
                hesitate, go apply now!
            </div>
        </details>

        <details
            class="group rounded-xl sm:rounded-2xl border-2 border-cardBorder overflow-hidden bg-white shadow-sm hover:shadow-md transition-all duration-300 ease-out">
            <summary
                class="flex cursor-pointer list-none items-center justify-between px-4 py-4 sm:px-5 sm:py-4 md:px-6 md:py-5 font-semibold text-sm sm:text-base text-gray-800 hover:bg-bgGreen/10 transition-colors duration-200 ease-out group-open:bg-bgGreen/20 group-open:border-b-2 group-open:border-cardBorder">
                <span class="flex items-center gap-2 sm:gap-3 flex-1 min-w-0">
                    <span
                        class="flex h-7 w-7 sm:h-8 sm:w-8 flex-shrink-0 items-center justify-center rounded-lg bg-bgGreen/30 text-textGreen font-bold text-xs sm:text-sm">5</span>
                    <span class="truncate sm:whitespace-normal">Do I need to be fluent in English to join INTEL?
                    </span>
                </span>
                <svg class="h-5 w-5 sm:h-6 sm:w-6 flex-shrink-0 ml-2 text-textRed transition-transform duration-300 ease-out group-open:rotate-180"
                    fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </summary>
            <div
                class="px-4 py-4 sm:px-5 sm:py-4 md:px-6 md:py-5 text-sm sm:text-base text-gray-600 leading-relaxed bg-white">
                Not at all, INdies! At INTEL, we learn English together and continuously upgrade your language skills.
                So no worries, everyone starts somewhere!
            </div>
        </details>

        <details
            class="group rounded-xl sm:rounded-2xl border-2 border-cardBorder overflow-hidden bg-white shadow-sm hover:shadow-md transition-all duration-300 ease-out">
            <summary
                class="flex cursor-pointer list-none items-center justify-between px-4 py-4 sm:px-5 sm:py-4 md:px-6 md:py-5 font-semibold text-sm sm:text-base text-gray-800 hover:bg-bgGreen/10 transition-colors duration-200 ease-out group-open:bg-bgGreen/20 group-open:border-b-2 group-open:border-cardBorder">
                <span class="flex items-center gap-2 sm:gap-3 flex-1 min-w-0">
                    <span
                        class="flex h-7 w-7 sm:h-8 sm:w-8 flex-shrink-0 items-center justify-center rounded-lg bg-bgGreen/30 text-textGreen font-bold text-xs sm:text-sm">6</span>
                    <span class="truncate sm:whitespace-normal">If I’m not confident speaking English, can I still join
                        INTEL?

                    </span>
                </span>
                <svg class="h-5 w-5 sm:h-6 sm:w-6 flex-shrink-0 ml-2 text-textRed transition-transform duration-300 ease-out group-open:rotate-180"
                    fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </summary>
            <div
                class="px-4 py-4 sm:px-5 sm:py-4 md:px-6 md:py-5 text-sm sm:text-base text-gray-600 leading-relaxed bg-white">
                Of course you can, INdies! We grow together here, including learning English public speaking step by
                step. For daily communication among members, we still mostly use <span class="font-bold">Bahasa
                    Indonesia</span>, so you’ll feel right at home.

            </div>
        </details>

        <details
            class="group rounded-xl sm:rounded-2xl border-2 border-cardBorder overflow-hidden bg-white shadow-sm hover:shadow-md transition-all duration-300 ease-out">
            <summary
                class="flex cursor-pointer list-none items-center justify-between px-4 py-4 sm:px-5 sm:py-4 md:px-6 md:py-5 font-semibold text-sm sm:text-base text-gray-800 hover:bg-bgGreen/10 transition-colors duration-200 ease-out group-open:bg-bgGreen/20 group-open:border-b-2 group-open:border-cardBorder">
                <span class="flex items-center gap-2 sm:gap-3 flex-1 min-w-0">
                    <span
                        class="flex h-7 w-7 sm:h-8 sm:w-8 flex-shrink-0 items-center justify-center rounded-lg bg-bgGreen/30 text-textGreen font-bold text-xs sm:text-sm">7</span>
                    <span class="truncate sm:whitespace-normal">What kind of activities does INTEL have?
                    </span>
                </span>
                <svg class="h-5 w-5 sm:h-6 sm:w-6 flex-shrink-0 ml-2 text-textRed transition-transform duration-300 ease-out group-open:rotate-180"
                    fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </summary>
            <div
                class="px-4 py-4 sm:px-5 sm:py-4 md:px-6 md:py-5 text-sm sm:text-base text-gray-600 leading-relaxed bg-white">
                INTEL activities are super fun and engaging, INdies!
                We have PROTEIN (Proficiency TOEFL/SILUET Test with INTEL), IGTS (INTEL Goes To School), and Weekly
                Meetings to catch up, learn English, and bond with friends, most of weekly meetings activities are held
                online, so it’s super flexible!
            </div>
        </details>

        <details
            class="group rounded-xl sm:rounded-2xl border-2 border-cardBorder overflow-hidden bg-white shadow-sm hover:shadow-md transition-all duration-300 ease-out">
            <summary
                class="flex cursor-pointer list-none items-center justify-between px-4 py-4 sm:px-5 sm:py-4 md:px-6 md:py-5 font-semibold text-sm sm:text-base text-gray-800 hover:bg-bgGreen/10 transition-colors duration-200 ease-out group-open:bg-bgGreen/20 group-open:border-b-2 group-open:border-cardBorder">
                <span class="flex items-center gap-2 sm:gap-3 flex-1 min-w-0">
                    <span
                        class="flex h-7 w-7 sm:h-8 sm:w-8 flex-shrink-0 items-center justify-center rounded-lg bg-bgGreen/30 text-textGreen font-bold text-xs sm:text-sm">8</span>
                    <span class="truncate sm:whitespace-normal">Will we learn organizational skills, or is it only
                        about learning English?
                    </span>
                </span>
                <svg class="h-5 w-5 sm:h-6 sm:w-6 flex-shrink-0 ml-2 text-textRed transition-transform duration-300 ease-out group-open:rotate-180"
                    fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </summary>
            <div
                class="px-4 py-4 sm:px-5 sm:py-4 md:px-6 md:py-5 text-sm sm:text-base text-gray-600 leading-relaxed bg-white">
                Definitely both, INdies! At INTEL, you’ll gain organizational experience through various programs while
                also expanding your English skills and vocabulary. Double the benefits, right?

            </div>
        </details>

        <details
            class="group rounded-xl sm:rounded-2xl border-2 border-cardBorder overflow-hidden bg-white shadow-sm hover:shadow-md transition-all duration-300 ease-out">
            <summary
                class="flex cursor-pointer list-none items-center justify-between px-4 py-4 sm:px-5 sm:py-4 md:px-6 md:py-5 font-semibold text-sm sm:text-base text-gray-800 hover:bg-bgGreen/10 transition-colors duration-200 ease-out group-open:bg-bgGreen/20 group-open:border-b-2 group-open:border-cardBorder">
                <span class="flex items-center gap-2 sm:gap-3 flex-1 min-w-0">
                    <span
                        class="flex h-7 w-7 sm:h-8 sm:w-8 flex-shrink-0 items-center justify-center rounded-lg bg-bgGreen/30 text-textGreen font-bold text-xs sm:text-sm">9</span>
                    <span class="truncate sm:whitespace-normal">Do applicants need prior organizational experience?
                    </span>
                </span>
                <svg class="h-5 w-5 sm:h-6 sm:w-6 flex-shrink-0 ml-2 text-textRed transition-transform duration-300 ease-out group-open:rotate-180"
                    fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </summary>
            <div
                class="px-4 py-4 sm:px-5 sm:py-4 md:px-6 md:py-5 text-sm sm:text-base text-gray-600 leading-relaxed bg-white">
                No experience required, INdies! INTEL can be your first step into the organizational world. Don’t be
                afraid or hesitant, start your journey with the INTEL family!.
            </div>
        </details>

        <details
            class="group rounded-xl sm:rounded-2xl border-2 border-cardBorder overflow-hidden bg-white shadow-sm hover:shadow-md transition-all duration-300 ease-out">
            <summary
                class="flex cursor-pointer list-none items-center justify-between px-4 py-4 sm:px-5 sm:py-4 md:px-6 md:py-5 font-semibold text-sm sm:text-base text-gray-800 hover:bg-bgGreen/10 transition-colors duration-200 ease-out group-open:bg-bgGreen/20 group-open:border-b-2 group-open:border-cardBorder">
                <span class="flex items-center gap-2 sm:gap-3 flex-1 min-w-0">
                    <span
                        class="flex h-7 w-7 sm:h-8 sm:w-8 flex-shrink-0 items-center justify-center rounded-lg bg-bgGreen/30 text-textGreen font-bold text-xs sm:text-sm">10</span>
                    <span class="truncate sm:whitespace-normal">Do all tasks have to be answered in English?
                    </span>
                </span>
                <svg class="h-5 w-5 sm:h-6 sm:w-6 flex-shrink-0 ml-2 text-textRed transition-transform duration-300 ease-out group-open:rotate-180"
                    fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </summary>
            <div
                class="px-4 py-4 sm:px-5 sm:py-4 md:px-6 md:py-5 text-sm sm:text-base text-gray-600 leading-relaxed bg-white">
                Not necessarily, INdies! The language used depends on each division’s task requirements. However… if you
                answer in English, you might just get an A+
            </div>
        </details>

        <details
            class="group rounded-xl sm:rounded-2xl border-2 border-cardBorder overflow-hidden bg-white shadow-sm hover:shadow-md transition-all duration-300 ease-out">
            <summary
                class="flex cursor-pointer list-none items-center justify-between px-4 py-4 sm:px-5 sm:py-4 md:px-6 md:py-5 font-semibold text-sm sm:text-base text-gray-800 hover:bg-bgGreen/10 transition-colors duration-200 ease-out group-open:bg-bgGreen/20 group-open:border-b-2 group-open:border-cardBorder">
                <span class="flex items-center gap-2 sm:gap-3 flex-1 min-w-0">
                    <span
                        class="flex h-7 w-7 sm:h-8 sm:w-8 flex-shrink-0 items-center justify-center rounded-lg bg-bgGreen/30 text-textGreen font-bold text-xs sm:text-sm">11</span>
                    <span class="truncate sm:whitespace-normal"> Is it okay if applicants don’t complete the assigned
                        tasks?
                    </span>
                </span>
                <svg class="h-5 w-5 sm:h-6 sm:w-6 flex-shrink-0 ml-2 text-textRed transition-transform duration-300 ease-out group-open:rotate-180"
                    fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </summary>
            <div
                class="px-4 py-4 sm:px-5 sm:py-4 md:px-6 md:py-5 text-sm sm:text-base text-gray-600 leading-relaxed bg-white">
                Hmm… better not, INdies.
                It would be such a waste! Tasks are an important part of our assessment during the recruitment process.
                So do your best and stay motivated—good luck!
            </div>
        </details>

    </div>

    <footer class="bg-[#FCD9BB] pt-12 pb-8">
        <div class="max-w-7xl mx-auto px-6">

            <div class="flex flex-col md:flex-row justify-between items-center gap-8 text-center md:text-left">

                <div class="md:w-1/3">
                    <h2 class="text-2xl font-extrabold text-[#6A3A39] tracking-tight">
                        INTEL FASILKOM UNSRI
                    </h2>
                    <p class="text-sm text-[#8c5e5d] mt-2">
                        Ilkom's Community of English Lovers
                    </p>
                </div>

                <div class="md:w-1/3">
                    <ul class="flex flex-wrap justify-center gap-6 font-semibold text-[#6A3A39]">
                        <li>
                            <a href="#home" class="hover:text-[#D07270] transition-colors">HOME</a>
                        </li>
                        <li>
                            <a href="#timeline" class="hover:text-[#D07270] transition-colors">TIMELINE</a>
                        </li>
                        <li>
                            <a href="#division" class="hover:text-[#D07270] transition-colors">DIVISION</a>
                        </li>
                        <li>
                            <a href="#faq" class="hover:text-[#D07270] transition-colors">FAQ</a>
                        </li>
                    </ul>
                </div>

                <div class="md:w-1/3 flex justify-center md:justify-end gap-4">

                    <a href="https://instagram.com/intelunsri" target="_blank"
                        class="w-10 h-10 bg-white/50 rounded-full flex items-center justify-center text-[#6A3A39] hover:bg-white hover:text-[#D07270] transition-all shadow-sm">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 014.185 3.362c.636-.247 1.363-.416 2.427-.465C7.674 2.013 8.027 2 12.315 2zm-3.192 1.956c-.529 0-.96.43-.96.958 0 .528.431.959.96.959.528 0 .959-.43.959-.959 0-.528-.431-.958-.959-.958zm3.287 3.565c-2.474 0-4.48 2.006-4.48 4.48 0 2.474 2.006 4.48 4.48 4.48 2.474 0 4.48-2.006 4.48-4.48 0-2.474-2.006-4.48-4.48-4.48z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>

                    <a href="https://linkedin.com/company/intel-fasilkom-unsri" target="_blank"
                        class="w-10 h-10 bg-white/50 rounded-full flex items-center justify-center text-[#6A3A39] hover:bg-white hover:text-[#D07270] transition-all shadow-sm">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>

                </div>
            </div>

            <div class="border-t border-[#6A3A39]/20 my-8"></div>

            <div class="text-center text-[#6A3A39] text-sm font-medium">
                <p>&copy; 2026 INTEL UNSRI. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>

<script>
    const btn = document.getElementById('mobile-menu-btn');
    const menu = document.getElementById('mobile-menu');

    btn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });

    // Ambil deadline dari Controller Laravel
    const deadline = new Date("{{ $deadline }}").getTime();

    // Fungsi helper untuk menambah angka 0 di depan (misal: 5 jadi 05) biar rapi
    function pad(n) {
        return (n < 10 ? '0' : '') + n;
    }

    const x = setInterval(function() {
        const now = new Date().getTime();
        const distance = deadline - now;

        if (distance < 0) {
            clearInterval(x);
            document.getElementById("countdown").innerHTML =
                '<span class="text-red-500 font-bold text-xs uppercase tracking-wider">Registration Closed</span>';
            // Opsional: Sembunyikan tombol daftar jika sudah tutup
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Styling untuk Angka dan Label
        const itemClass = "flex items-baseline mx-1";
        const numberClass = "text-lg font-bold text-blue-600 font-mono leading-none";
        const labelClass = "text-[10px] text-gray-400 uppercase ml-0.5 font-medium";
        const separator = '<span class="text-gray-300 text-xs mx-1 font-light">|</span>';

        document.getElementById("countdown").innerHTML = `
            <div class="${itemClass}">
                <span class="${numberClass}">${days}</span>
                <span class="${labelClass}">d</span>
            </div>
            ${separator}
            <div class="${itemClass}">
                <span class="${numberClass}">${pad(hours)}</span>
                <span class="${labelClass}">h</span>
            </div>
            ${separator}
            <div class="${itemClass}">
                <span class="${numberClass}">${pad(minutes)}</span>
                <span class="${labelClass}">m</span>
            </div>
            ${separator}
            <div class="${itemClass}">
                <span class="${numberClass}">${pad(seconds)}</span>
                <span class="${labelClass}">s</span>
            </div>
        `;
    }, 1000);
</script>

</html>
