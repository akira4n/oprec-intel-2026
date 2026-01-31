<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INTEL Recruitment 2026</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&family=Quicksand:wght@500;600;700&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.cdnfonts.com/css/porter-sans-block" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                        porter: ['Porter Sans Block', 'sans-serif']
                    },
                    colors: {
                        bgGreen: '#D4DB95',
                        pillPink: '#F1B2BA',
                        textRed: '#D07270',
                        lineColor: '#D07270',
                        cardBorder: '#eab3bb',
                        starYellow: '#FFFAD0',
                        workGreen: '#BADD7F',
                        flowRed: '#d06b72',
                        glowYellow: '#FFFBD6',
                        textGreen: '#6f8746'
                    },
                    animation: {
                        "spin-slow": "spin 8s linear infinite",
                        float: "float 3s ease-in-out infinite",
                    },
                    keyframes: {
                        float: {
                            "0%, 100%": {
                                transform: "translateY(0)"
                            },
                            "50%": {
                                transform: "translateY(-10px)"
                            },
                        },
                    },
                }
            }
        }
    </script>

    <style>
        /* --- GLOBAL STYLES --- */
        body {
            font-family: "Poppins", sans-serif;
            background-color: #ffffff;
            overflow-x: hidden;
        }

        .font-porter {
            font-family: "Porter Sans Block", cursive, sans-serif;
            letter-spacing: 1px;
        }

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
            class="absolute top-0 right-0 w-[500px] h-[500px] bg-[#FFFBD6] rounded-full blur-[120px] z-0 pointer-events-none opacity-60">
        </div>
        <div class="triangle-separator"></div>

        <div
            class="absolute left-8 md:left-1/2 transform md:-translate-x-1/2 top-[180px] bottom-0 w-1 bg-lineColor sharp-line z-10">
        </div>

        <div class="absolute top-10 left-1/2 transform -translate-x-1/2 text-pillPink z-20">
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

        <div class="pt-24 text-center relative z-20">
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
                        <div
                            class="absolute top-[-40px] right-[-40px] md:right-[-60px] text-starYellow pointer-events-none z-0 transform -rotate-12 scale-110">
                            <svg class="w-32 md:w-48 h-auto overflow-visible opacity-90" viewBox="-150 -150 262 327"
                                fill="currentColor">
                                <use href="#icon-star-blob" />
                            </svg>
                        </div>
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

        <div class="container mx-auto relative z-10">
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
                        <img src="{{ asset('asset/foto2.jpeg') }}" class="w-full h-full object-cover"
                            alt="Profile Kiri" />
                    </div>
                </div>

                <div
                    class="w-full md:w-2/5 h-72 md:h-96 bg-white rounded-[50px] p-4 shadow-2xl border-[12px] md:border-[18px] border-white relative z-20 scale-105 md:scale-110">
                    <div class="w-full h-full rounded-[35px] overflow-hidden shadow-inner">
                        <img src="{{ asset('asset/foto1.jpeg') }}" class="w-full h-full object-cover"
                            alt="Profile Tengah" />
                    </div>
                </div>

                <div
                    class="w-2/3 md:w-1/4 h-56 md:h-64 bg-white rounded-[40px] p-3 shadow-lg transform rotate-3 hover:rotate-0 transition-all duration-300 border border-gray-100">
                    <div
                        class="w-full h-full rounded-[30px] overflow-hidden grayscale opacity-80 hover:grayscale-0 hover:opacity-100 transition-all">
                        <img src="{{ asset('asset/foto3.jpeg') }}" class="w-full h-full object-cover"
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

        <div class="mt-44 relative z-20">
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
                            class="relative w-full division-card bg-white/80 backdrop-blur-md p-8 rounded-[45px] shadow-xl border border-white flex flex-col items-center text-center transition-all duration-300 hover:-translate-y-2">
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
                                <span
                                    class="border-2 border-[#D07270]/30 text-[#D07270] px-3 py-1 rounded-full">PR</span>
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
                            class="relative w-full division-card bg-white/80 backdrop-blur-md p-8 rounded-[45px] shadow-xl border border-white flex flex-col items-center text-center transition-all duration-300 hover:-translate-y-2">
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
                            class="relative w-full division-card bg-white/80 backdrop-blur-md p-8 rounded-[45px] shadow-xl border border-white flex flex-col items-center text-center transition-all duration-300 hover:-translate-y-2">
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
                                <span class="border-2 border-[#D07270]/30 text-[#D07270] px-3 py-1 rounded-full">IT -
                                    Study</span>
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
                            class="relative w-full division-card bg-white/80 backdrop-blur-md p-8 rounded-[45px] shadow-xl border border-white flex flex-col items-center text-center transition-all duration-300 hover:-translate-y-2">
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

    <div class="max-w-full sm:max-w-xl md:max-w-2xl lg:max-w-3xl mx-auto space-y-3 md:space-y-4 py-20 px-4">
        <div class="mb-6 md:mb-8 text-center px-2">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-textGreen mb-1 md:mb-2">FAQ</h2>
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
                    <span class="truncate sm:whitespace-normal">Who can join INTEL?</span>
                </span>
                <svg class="h-5 w-5 sm:h-6 sm:w-6 flex-shrink-0 ml-2 text-textRed transition-transform duration-300 ease-out group-open:rotate-180"
                    fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </summary>
            <div
                class="px-4 py-4 sm:px-5 sm:py-4 md:px-6 md:py-5 text-sm sm:text-base text-gray-600 leading-relaxed bg-white">
                INTEL recruitment is open to all active students of the Faculty of Computer Science (Fasilkom),
                Sriwijaya University, who have an interest in English and organizational development.
            </div>
        </details>

        <details
            class="group rounded-xl sm:rounded-2xl border-2 border-cardBorder overflow-hidden bg-white shadow-sm hover:shadow-md transition-all duration-300 ease-out">
            <summary
                class="flex cursor-pointer list-none items-center justify-between px-4 py-4 sm:px-5 sm:py-4 md:px-6 md:py-5 font-semibold text-sm sm:text-base text-gray-800 hover:bg-bgGreen/10 transition-colors duration-200 ease-out group-open:bg-bgGreen/20 group-open:border-b-2 group-open:border-cardBorder">
                <span class="flex items-center gap-2 sm:gap-3 flex-1 min-w-0">
                    <span
                        class="flex h-7 w-7 sm:h-8 sm:w-8 flex-shrink-0 items-center justify-center rounded-lg bg-bgGreen/30 text-textGreen font-bold text-xs sm:text-sm">3</span>
                    <span class="truncate sm:whitespace-normal">Do I need to be fluent in English?</span>
                </span>
                <svg class="h-5 w-5 sm:h-6 sm:w-6 flex-shrink-0 ml-2 text-textRed transition-transform duration-300 ease-out group-open:rotate-180"
                    fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </summary>
            <div
                class="px-4 py-4 sm:px-5 sm:py-4 md:px-6 md:py-5 text-sm sm:text-base text-gray-600 leading-relaxed bg-white">
                <span class="font-bold text-textRed">Not necessarily!</span> INTEL is a place to learn. We welcome
                everyone from beginners to advanced speakers. The most important thing is your commitment and
                willingness to learn and grow together.
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
                Yes! As stated in the workflow, you can select up to <span class="font-bold text-textGreen">2
                    divisions</span> that you are interested in during the registration process.
            </div>
        </details>
    </div>
</body>

</html>
