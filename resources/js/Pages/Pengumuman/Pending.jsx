import { Head } from "@inertiajs/react";

export default function Pending() {
    return (
        <div className="min-h-screen flex flex-col items-center justify-center bg-gray-100 px-4 text-center">
            <Head title="Pengumuman Belum Dibuka" />

            <div className="bg-white p-10 rounded-2xl shadow-xl max-w-md w-full border border-gray-200">
                <div className="mb-6">
                    <span className="text-6xl">🔒</span>
                </div>

                <h1 className="text-3xl font-extrabold text-blue-800 mb-2">
                    Belum Waktunya!
                </h1>
 
                <p className="text-gray-600 mb-6 text-lg">
                    Pengumuman kelulusan Oprec INTEL 2026 belum dibuka.
                </p>

                <div className="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <p className="text-sm text-blue-800 font-semibold uppercase tracking-wider mb-1">
                        Jadwal Pengumuman
                    </p>
                    <p className="text-2xl font-bold text-blue-900">
                        20 Februari 2026
                    </p>
                    <p className="text-sm text-blue-600 mt-1">
                        Pukul 00:00 WIB
                    </p>
                </div>

                <p className="mt-8 text-sm text-gray-400">
                    Silakan kembali lagi pada waktu yang ditentukan.
                </p>
            </div>
        </div>
    );
}
