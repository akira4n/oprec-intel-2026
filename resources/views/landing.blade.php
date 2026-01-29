<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Open Recruitment INTEL FASILKOM UNSRI 2026</title>
    @vite(['resources/js/app.jsx'])
</head>

<body class="bg-gray-100 font-sans antialiased text-gray-900">
    <div class="min-h-screen flex flex-col justify-center items-center relative overflow-hidden">

        <div class="absolute top-0 left-0 w-full h-full bg-white opacity-40 z-[-1]"></div>

        <div class="z-10 text-center px-4">
            <h1 class="text-5xl md:text-6xl font-extrabold text-blue-700 mb-2 tracking-tight">
                Open Recruitment
            </h1>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">
                INTEL 2026
            </h2>

            <div id="countdown-container" class="mb-10">
                <p class="text-gray-500 mb-2 text-sm uppercase tracking-widest">Pendaftaran Ditutup Dalam</p>
                <div id="countdown" class="flex flex-wrap justify-center gap-4 text-center">
                    <div class="loading text-gray-400">Memuat waktu...</div>
                </div>
            </div>

            <div class="space-x-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="px-8 py-3 bg-blue-600 text-white font-semibold rounded-full shadow-lg hover:bg-blue-700 transition transform hover:scale-105">
                            Ke Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="px-6 py-3 bg-white text-gray-800 font-semibold rounded-full shadow border border-gray-300 hover:bg-gray-50 transition">
                            Login
                        </a>
                        <a href="{{ route('register') }}"
                            class="px-8 py-3 bg-blue-600 text-white font-semibold rounded-full shadow-lg hover:bg-blue-700 transition transform hover:scale-105">
                            Daftar Sekarang
                        </a>
                    @endauth
                @endif
            </div>

            <p class="mt-8 text-sm text-gray-500">
                Batas Akhir: {{ \Carbon\Carbon::parse($deadline)->translatedFormat('d F Y, H:i') }} WIB
            </p>
        </div>
    </div>

    <script>
        // Ambil deadline dari Controller Laravel
        const deadline = new Date("{{ $deadline }}").getTime();

        const x = setInterval(function() {
            const now = new Date().getTime();
            const distance = deadline - now;

            if (distance < 0) {
                clearInterval(x);
                document.getElementById("countdown").innerHTML =
                    '<span class="text-red-600 font-bold text-xl">PENDAFTARAN DITUTUP</span>';
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Template Kotak Waktu
            const boxClass =
                "flex flex-col items-center bg-white p-3 rounded-lg shadow-sm border border-gray-200 min-w-[80px]";
            const numberClass = "text-3xl font-bold text-blue-600";
            const labelClass = "text-xs text-gray-500 uppercase mt-1";

            document.getElementById("countdown").innerHTML = `
                <div class="${boxClass}">
                    <span class="${numberClass}">${days}</span>
                    <span class="${labelClass}">Hari</span>
                </div>
                <div class="${boxClass}">
                    <span class="${numberClass}">${hours}</span>
                    <span class="${labelClass}">Jam</span>
                </div>
                <div class="${boxClass}">
                    <span class="${numberClass}">${minutes}</span>
                    <span class="${labelClass}">Menit</span>
                </div>
                <div class="${boxClass}">
                    <span class="${numberClass}">${seconds}</span>
                    <span class="${labelClass}">Detik</span>
                </div>
            `;
        }, 1000);
    </script>
</body>

</html>
