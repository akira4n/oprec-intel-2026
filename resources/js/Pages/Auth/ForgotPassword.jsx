import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Head, Link, useForm } from '@inertiajs/react';
import Snowfall from "react-snowfall";
import { useMemo } from 'react';

const imageSource1 = "/assets/particles/star_green.svg";
const imageSource2 = "/assets/particles/star_pink.svg";

export default function ForgotPassword({ status }) {
    const { data, setData, post, processing, errors } = useForm({
        email: '',
    });

  
    const snowflakeImages = useMemo(() => {
        if (typeof window === 'undefined') return [];
        const img1 = new Image();
        img1.src = imageSource1;
        const img2 = new Image();
        img2.src = imageSource2;
        return [img1, img2];
    }, []);

    const submit = (e) => {
        e.preventDefault();
        post(route('password.email'));
    };

    const accentColorClass = "text-[#d06b72]";
    const buttonBgClass = "bg-[#d06b72] hover:bg-[#b85a60] transition duration-300 shadow-lg shadow-rose-200";

    return (
        <div className="min-h-screen bg-gradient-to-br from-[#f0f7da] to-[#dce8b8] flex flex-col justify-center items-center p-6 relative overflow-hidden font-sans">
            <Head title="Forgot Password" />

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

            {/* Kartu Forgot Password Utama */}
            <div className="relative z-10 w-full max-w-md bg-white/90 backdrop-blur-sm rounded-2xl shadow-2xl p-8 sm:p-12 border border-white/50">
                
                {/* Logo Section */}
                <div className="flex justify-center mb-6">
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

                <div className="text-center mb-8">
                    <h2 className={`text-2xl font-black uppercase tracking-tight mb-3 ${accentColorClass}`}>
                        Reset Password
                    </h2>
                    <p className="text-gray-500 text-sm leading-relaxed font-medium">
                        Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.
                    </p>
                </div>

                {status && (
                    <div className="mb-6 text-sm font-bold text-green-600 text-center bg-green-50 p-3 rounded-xl border border-green-100">
                        {status}
                    </div>
                )}

                <form onSubmit={submit} className="space-y-6">
                    <div>
                        <InputLabel htmlFor="email" value="Email Address" className={`font-bold ml-1 ${accentColorClass}`} />
                        <TextInput
                            id="email"
                            type="email"
                            name="email"
                            value={data.email}
                            className="mt-1 block w-full rounded-2xl border-gray-200 bg-gray-50/50 focus:border-[#d06b72] focus:ring-[#d06b72] px-4 py-3"
                            isFocused={true}
                            onChange={(e) => setData('email', e.target.value)}
                            placeholder="your@email.com"
                            required
                        />
                        <InputError message={errors.email} className="mt-2" />
                    </div>

                    <div className="pt-2">
                        <PrimaryButton 
                            className={`w-full justify-center py-4 rounded-2xl text-white font-black uppercase tracking-widest border-none ${buttonBgClass}`} 
                            disabled={processing}
                        >
                            {processing ? 'Sending...' : 'Send Reset Link'}
                        </PrimaryButton>
                    </div>
                </form>

                {/* Back to Login Link */}
                <div className="mt-8 text-center pt-6 border-t border-gray-100">
                    <Link
                        href={route("login")}
                        className="text-sm font-bold text-gray-400 hover:text-[#d06b72] transition-colors flex items-center justify-center gap-2"
                    >
                        <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
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