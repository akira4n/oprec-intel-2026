import { Head, Link } from "@inertiajs/react";
import Snowfall from "react-snowfall";
import { useMemo } from "react";

const imageSource1 = "/assets/particles/star_green.svg";
const imageSource2 = "/assets/particles/star_pink.svg";

export default function RegisterClosed() {
    
    const snowflakeImages = useMemo(() => {
        if (typeof window === 'undefined') return [];
        const img1 = new Image();
        img1.src = imageSource1;
        const img2 = new Image();
        img2.src = imageSource2;
        return [img1, img2];
    }, []);

    const accentColorClass = "text-[#d06b72]";

    return (
        <div className="min-h-screen bg-gradient-to-br from-[#f0f7da] to-[#dce8b8] flex flex-col justify-center items-center p-6 relative overflow-hidden font-sans">
            <Head title="Registration Closed" />

            {/* --- EFEK SNOWFALL BINTANG --- */}
            <Snowfall
                images={snowflakeImages}
                radius={[5, 15]}
                snowflakeCount={30}
                speed={[0.5, 1.5]}
                style={{
                    position: 'absolute',
                    width: '100%',
                    height: '100%',
                    zIndex: 5,
                }}
            />

            {/* Elemen Dekorasi Latar Belakang (Orbs Blur) */}
            <div className="absolute bottom-[-10%] left-[-10%] w-64 h-64 md:w-96 md:h-96 bg-green-300/30 rounded-full mix-blend-multiply filter blur-3xl opacity-70 pointer-events-none"></div>
            <div className="absolute top-[-10%] right-[-10%] w-64 h-64 md:w-96 md:h-96 bg-rose-200/40 rounded-full mix-blend-multiply filter blur-3xl opacity-70 pointer-events-none"></div>

            {/* Kartu Pesan Utama */}
            <div className="relative z-10 w-full max-w-lg bg-white/90 backdrop-blur-sm rounded-2xl shadow-2xl p-8 sm:p-12 border border-white/50 text-center">
                
                {/* Logo Section */}
                <div className="flex justify-center mb-8">
                    <img
                        src="/assets/images/logo.png"
                        alt="INTEL Logo"
                        className="h-20 w-auto object-contain drop-shadow-sm rounded-md"
                        onError={(e) => {
                            e.target.onerror = null;
                            e.target.src = 'https://via.placeholder.com/150x80?text=INTEL+Logo';
                        }}
                    />
                </div>

                {/* Ikon Pengumuman (Opsional) */}
                <div className="mb-6 flex justify-center">
                    <div className="bg-rose-50 p-4 rounded-full">
                        <svg className={`w-12 h-12 ${accentColorClass}`} fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>

                <h2 className={`text-3xl font-black uppercase tracking-tight mb-4 ${accentColorClass}`}>
                    Registration Closed
                </h2>
                
                <p className="text-gray-600 mb-8 leading-relaxed font-medium">
                    Thank you for your interest in joining us. Unfortunately, registration for INTEL 2026 Open Recruitment has ended as of February 12.
                </p>

                <div className="pt-4 border-t border-gray-100">
                    <Link
                        href={route("login")}
                        className={`inline-block px-8 py-3 rounded-full border-2 border-[#d06b72] ${accentColorClass} font-bold hover:bg-[#d06b72] hover:text-white transition duration-300 shadow-md`}
                    >
                        Back to Login
                    </Link>
                </div>
            </div>

            {/* Footer Tagline */}
            <div className="mt-8 text-xs font-bold text-gray-400/70 tracking-[0.2em] uppercase relative z-10 text-center">
                #IntelCanDoIt • 2026
            </div>
        </div>
    );
}