import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Head, useForm } from '@inertiajs/react';
import Snowfall from "react-snowfall";
import { useMemo } from 'react';

const imageSource1 = "/assets/particles/star_green.svg";
const imageSource2 = "/assets/particles/star_pink.svg";

export default function ResetPassword({ token, email }) {
    const { data, setData, post, processing, errors, reset } = useForm({
        token: token,
        email: email,
        password: '',
        password_confirmation: '',
    });

    // Inisialisasi gambar partikel bintang untuk Snowfall
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

        post(route('password.store'), {
            onFinish: () => reset('password', 'password_confirmation'),
        });
    };

    const accentColorClass = "text-[#d06b72]";
    const buttonBgClass = "bg-[#d06b72] hover:bg-[#b85a60] transition duration-300 shadow-lg shadow-rose-200";

    return (
        <div className="min-h-screen bg-gradient-to-br from-[#f0f7da] to-[#dce8b8] flex flex-col justify-center items-center p-6 relative overflow-hidden font-sans">
            <Head title="Reset Password" />

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

            {/* Kartu Reset Password Utama */}
            <div className="relative z-10 w-full max-w-md bg-white/90 backdrop-blur-sm rounded-[2.5rem] shadow-2xl p-8 sm:p-12 border border-white/50">
                
                {/* Logo Section */}
                <div className="flex justify-center mb-6">
                    <img
                        src="/assets/images/logo.png"
                        alt="INTEL Logo"
                        className="h-20 w-auto object-contain drop-shadow-sm"
                        onError={(e) => {
                            e.target.onerror = null;
                            e.target.src = 'https://via.placeholder.com/150x80?text=INTEL+Logo';
                        }}
                    />
                </div>

                <div className="text-center mb-8">
                    <h2 className={`text-2xl font-black uppercase tracking-tight mb-2 ${accentColorClass}`}>
                        New Password
                    </h2>
                    <p className="text-gray-500 text-sm font-medium">Set your new secure password below</p>
                </div>

                <form onSubmit={submit} className="space-y-5">
                    {/* Email Input (Biasanya readonly dari token email) */}
                    <div>
                        <InputLabel htmlFor="email" value="Email Address" className={`font-bold ml-1 ${accentColorClass}`} />
                        <TextInput
                            id="email"
                            type="email"
                            name="email"
                            value={data.email}
                            className="mt-1 block w-full rounded-2xl border-gray-200 bg-gray-100/50 cursor-not-allowed px-4 py-3"
                            autoComplete="username"
                            onChange={(e) => setData('email', e.target.value)}
                            required
                        />
                        <InputError message={errors.email} className="mt-2" />
                    </div>

                    {/* Password Input */}
                    <div>
                        <InputLabel htmlFor="password" value="New Password" className={`font-bold ml-1 ${accentColorClass}`} />
                        <TextInput
                            id="password"
                            type="password"
                            name="password"
                            value={data.password}
                            className="mt-1 block w-full rounded-2xl border-gray-200 bg-gray-50/50 focus:border-[#d06b72] focus:ring-[#d06b72] px-4 py-3"
                            autoComplete="new-password"
                            isFocused={true}
                            onChange={(e) => setData('password', e.target.value)}
                            placeholder="••••••••"
                            required
                        />
                        <InputError message={errors.password} className="mt-2" />
                    </div>

                    {/* Confirm Password Input */}
                    <div>
                        <InputLabel htmlFor="password_confirmation" value="Confirm New Password" className={`font-bold ml-1 ${accentColorClass}`} />
                        <TextInput
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            value={data.password_confirmation}
                            className="mt-1 block w-full rounded-2xl border-gray-200 bg-gray-50/50 focus:border-[#d06b72] focus:ring-[#d06b72] px-4 py-3"
                            autoComplete="new-password"
                            onChange={(e) => setData('password_confirmation', e.target.value)}
                            placeholder="••••••••"
                            required
                        />
                        <InputError message={errors.password_confirmation} className="mt-2" />
                    </div>

                    <div className="pt-2">
                        <PrimaryButton 
                            className={`w-full justify-center py-4 rounded-2xl text-white font-black uppercase tracking-widest border-none ${buttonBgClass}`} 
                            disabled={processing}
                        >
                            {processing ? 'Updating...' : 'Update Password'}
                        </PrimaryButton>
                    </div>
                </form>
            </div>

            {/* Footer Tagline */}
            <div className="mt-8 text-xs font-bold text-gray-400/70 tracking-[0.2em] uppercase relative z-10 text-center">
                #IntelCanDoIt • 2026
            </div>
        </div>
    );
}