import Checkbox from '@/Components/Checkbox';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Head, Link, useForm } from '@inertiajs/react';
import Snowfall from "react-snowfall";  
import { useMemo } from 'react'; 

const imageSource1 = "/assets/particles/star_green.svg"; 
const imageSource2 = "/assets/particles/star_pink.svg";

export default function Login({ status, canResetPassword }) {
    const { data, setData, post, processing, errors, reset } = useForm({
        email: '',
        password: '',
        remember: false,
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
        post(route('login'), {
            onFinish: () => reset('password'),
        });
    };

    const accentColorClass = "text-[#d06b72]"; 
    const buttonBgClass = "bg-[#d06b72] hover:bg-[#b85a60] transition duration-300 shadow-lg shadow-rose-200";

    return (
        <div className="min-h-screen bg-gradient-to-br from-[#f0f7da] to-[#dce8b8] flex flex-col justify-center items-center p-6 relative overflow-hidden font-sans">
            <Head title="Log in" />

            {/* --- FITUR SNOWFALL --- */}
            <Snowfall
                images={snowflakeImages}
                radius={[5, 15]}    
                snowflakeCount={40} 
                speed={[0.5, 1.5]}
                wind={[-0.5, 1.0]}  
                style={{
                    position: 'absolute',
                    width: '100%',
                    height: '100%',
                    zIndex: 5,     
                }}
            />

         
            <div className="absolute bottom-[-10%] left-[-10%] w-64 h-64 md:w-96 md:h-96 bg-green-300/30 rounded-full mix-blend-multiply filter blur-3xl opacity-70 pointer-events-none"></div>
            <div className="absolute top-[-10%] right-[-10%] w-64 h-64 md:w-96 md:h-96 bg-rose-200/40 rounded-full mix-blend-multiply filter blur-3xl opacity-70 pointer-events-none"></div>

          
            <div className="relative z-10 w-full max-w-md bg-white/90 backdrop-blur-sm rounded-2xl shadow-2xl p-8 sm:p-12 border border-white/50">
                
                {/* Logo Section */}
                <div className="flex justify-center mb-6">
                    <img
                        src="/assets/images/logo.png"
                        alt="INTEL Logo"
                        className="h-24 w-auto object-contain drop-shadow-md rounded-md"
                        onError={(e) => {
                            e.target.onerror = null;
                            e.target.src = 'https://via.placeholder.com/150?text=Logo+Not+Found';
                        }}
                    />
                </div>

                <div className="text-center mb-8">
                    <h2 className={`text-3xl font-black uppercase tracking-tight ${accentColorClass}`}>
                        Welcome Back!
                    </h2>
                    <p className="text-gray-500 text-sm mt-1 font-medium">Please login to your account</p>
                </div>

                {status && (
                    <div className="mb-4 text-sm font-medium text-green-600 text-center bg-green-50 p-2 rounded-lg">
                        {status}
                    </div>
                )}

                <form onSubmit={submit} className="space-y-5">
                    {/* Email Input */}
                    <div>
                        <InputLabel htmlFor="email" value="Email Address" className={`font-bold ml-1 ${accentColorClass}`} />
                        <TextInput
                            id="email"
                            type="email"
                            name="email"
                            value={data.email}
                            className="mt-1 block w-full rounded-2xl border-gray-200 bg-gray-50/50 focus:border-[#d06b72] focus:ring-[#d06b72] px-4 py-3"
                            autoComplete="username"
                            isFocused={true}
                            onChange={(e) => setData('email', e.target.value)}
                            placeholder="your@email.com"
                            required
                        />
                        <InputError message={errors.email} className="mt-2" />
                    </div>

                    {/* Password Input */}
                    <div>
                        <div className="flex justify-between items-center ml-1">
                            <InputLabel htmlFor="password" value="Password" className={`font-bold ${accentColorClass}`} />
                        </div>
                        <TextInput
                            id="password"
                            type="password"
                            name="password"
                            value={data.password}
                            className="mt-1 block w-full rounded-2xl border-gray-200 bg-gray-50/50 focus:border-[#d06b72] focus:ring-[#d06b72] px-4 py-3"
                            autoComplete="current-password"
                            onChange={(e) => setData('password', e.target.value)}
                            placeholder="••••••••"
                            required
                        />
                        <InputError message={errors.password} className="mt-2" />
                    </div>

                    {/* Remember Me & Forgot Password */}
                    <div className="flex items-center justify-between px-1">
                        <label className="flex items-center cursor-pointer">
                            <Checkbox
                                name="remember"
                                checked={data.remember}
                                onChange={(e) => setData('remember', e.target.checked)}
                                className="rounded border-gray-300 text-[#d06b72] focus:ring-[#d06b72]"
                            />
                            <span className="ms-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Remember
                            </span>
                        </label>

                        {canResetPassword && (
                            <Link
                                href={route('password.request')}
                                className="text-xs font-bold text-gray-400 hover:text-[#d06b72] transition-colors"
                            >
                                Forgot Password?
                            </Link>
                        )}
                    </div>

                    {/* Login Button */}
                    <div className="pt-2">
                        <PrimaryButton 
                            className={`w-full justify-center py-4 rounded-2xl text-white font-black uppercase tracking-widest border-none ${buttonBgClass}`} 
                            disabled={processing}
                        >
                            {processing ? 'Processing...' : 'Log in'}
                        </PrimaryButton>
                    </div>
                </form>

                <div className="mt-8 text-center border-t border-gray-100 pt-6">
                    <p className="text-sm text-gray-500 font-medium">
                        Don't have an account?{' '}
                        <Link
                            href={route('register')}
                            className={`font-bold hover:underline ${accentColorClass}`}
                        >
                            Join INTEL Now
                        </Link>
                    </p>
                </div>
            </div>

            <div className="mt-8 text-xs font-bold text-gray-400/70 tracking-[0.2em] uppercase relative z-10">
                #OurHomeWhereWeGrowWhatWeOwn • 2026
            </div>
        </div>
    );
}