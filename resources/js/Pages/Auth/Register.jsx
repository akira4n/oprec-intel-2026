import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import PrimaryButton from "@/Components/PrimaryButton";
import TextInput from "@/Components/TextInput";
import { Head, Link, useForm } from "@inertiajs/react";
import Snowfall from "react-snowfall";  
import { useMemo } from 'react'; // Pastikan useMemo di-import

const imageSource1 = "/assets/particles/star_green.svg";
const imageSource2 = "/assets/particles/star_pink.svg";

export default function Register() {
    const { data, setData, post, processing, errors, reset } = useForm({
        name: "",
        email: "",
        nim: "",
        no_hp: "",
        password: "",
        password_confirmation: "",
    });

    // Inisialisasi gambar partikel bintang
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
        post(route("register"), {
            onFinish: () => reset("password", "password_confirmation"),
        });
    };

    const accentColorClass = "text-[#d06b72]";
    const buttonBgClass = "bg-[#d06b72] hover:bg-[#b85a60] transition duration-300 shadow-lg shadow-rose-200";

    return (
        <div className="min-h-screen bg-gradient-to-br from-[#f0f7da] to-[#dce8b8] flex flex-col justify-center items-center p-6 relative overflow-hidden font-sans">
            <Head title="Register" />

            {/* --- EFEK SNOWFALL BINTANG --- */}
            <Snowfall
                images={snowflakeImages}
                radius={[5, 15]}
                snowflakeCount={30} // Lebih sedikit agar tidak terlalu menutupi form yang panjang
                speed={[0.5, 1.5]}
                style={{
                    position: 'absolute',
                    width: '100%',
                    height: '100%',
                    zIndex: 5,
                }}
            />

            {/* Elemen Dekorasi Latar Belakang */}
            <div className="absolute bottom-[-10%] left-[-10%] w-64 h-64 md:w-96 md:h-96 bg-green-300/30 rounded-full mix-blend-multiply filter blur-3xl opacity-70 pointer-events-none"></div>
            <div className="absolute top-[-10%] right-[-10%] w-64 h-64 md:w-96 md:h-96 bg-rose-200/40 rounded-full mix-blend-multiply filter blur-3xl opacity-70 pointer-events-none"></div>

            <div className="relative z-10 w-full max-w-2xl bg-white/90 backdrop-blur-sm rounded-[2.5rem] shadow-2xl p-8 sm:p-12 border border-white/50">
                
                <div className="flex justify-center mb-6">
                    <img
                        src="/assets/images/logo.png" 
                        alt="INTEL Logo"
                        className="h-16 w-auto object-contain drop-shadow-sm"
                        onError={(e) => {
                            e.target.onerror = null;
                            e.target.src = 'https://via.placeholder.com/150x80?text=INTEL+Logo';
                        }}
                    />
                </div>

                <div className="text-center mb-10">
                    <h2 className={`text-3xl font-black uppercase tracking-tight ${accentColorClass}`}>
                        Create Account
                    </h2>
                    <p className="text-gray-500 text-sm mt-1 font-medium">Join our community and grow together</p>
                </div>

                <form onSubmit={submit} className="space-y-6">
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {/* Nama Lengkap */}
                        <div>
                            <InputLabel htmlFor="name" value="Full Name" className={`font-bold ml-1 ${accentColorClass}`} />
                            <TextInput
                                id="name"
                                name="name"
                                value={data.name}
                                className="mt-1 block w-full rounded-2xl border-gray-200 bg-gray-50/50 focus:border-[#d06b72] focus:ring-[#d06b72] px-4 py-3"
                                onChange={(e) => setData("name", e.target.value)}
                                placeholder="Enter your full name"
                                required
                            />
                            <InputError message={errors.name} className="mt-2" />
                        </div>

                        {/* NIM */}
                        <div>
                            <InputLabel htmlFor="nim" value="NIM" className={`font-bold ml-1 ${accentColorClass}`} />
                            <TextInput
                                id="nim"
                                name="nim"
                                value={data.nim}
                                className="mt-1 block w-full rounded-2xl border-gray-200 bg-gray-50/50 focus:border-[#d06b72] focus:ring-[#d06b72] px-4 py-3"
                                onChange={(e) => setData("nim", e.target.value)}
                                placeholder="09031xxxxxx"
                                required
                            />
                            <InputError message={errors.nim} className="mt-2" />
                        </div>

                        {/* Email */}
                        <div>
                            <InputLabel htmlFor="email" value="Email Address" className={`font-bold ml-1 ${accentColorClass}`} />
                            <TextInput
                                id="email"
                                type="email"
                                name="email"
                                value={data.email}
                                className="mt-1 block w-full rounded-2xl border-gray-200 bg-gray-50/50 focus:border-[#d06b72] focus:ring-[#d06b72] px-4 py-3"
                                onChange={(e) => setData("email", e.target.value)}
                                placeholder="name@student.unsri.ac.id"
                                required
                            />
                            <InputError message={errors.email} className="mt-2" />
                        </div>

                        {/* No HP */}
                        <div>
                            <InputLabel htmlFor="no_hp" value="Phone Number" className={`font-bold ml-1 ${accentColorClass}`} />
                            <TextInput
                                id="no_hp"
                                name="no_hp"
                                value={data.no_hp}
                                className="mt-1 block w-full rounded-2xl border-gray-200 bg-gray-50/50 focus:border-[#d06b72] focus:ring-[#d06b72] px-4 py-3"
                                onChange={(e) => setData("no_hp", e.target.value)}
                                placeholder="08xxxxxxxxxx"
                                required
                            />
                            <InputError message={errors.no_hp} className="mt-2" />
                        </div>

                        {/* Password */}
                        <div>
                            <InputLabel htmlFor="password" value="Password" className={`font-bold ml-1 ${accentColorClass}`} />
                            <TextInput
                                id="password"
                                type="password"
                                name="password"
                                value={data.password}
                                className="mt-1 block w-full rounded-2xl border-gray-200 bg-gray-50/50 focus:border-[#d06b72] focus:ring-[#d06b72] px-4 py-3"
                                onChange={(e) => setData("password", e.target.value)}
                                placeholder="••••••••"
                                required
                            />
                            <InputError message={errors.password} className="mt-2" />
                        </div>

                        {/* Konfirmasi Password */}
                        <div>
                            <InputLabel htmlFor="password_confirmation" value="Confirm Password" className={`font-bold ml-1 ${accentColorClass}`} />
                            <TextInput
                                id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                value={data.password_confirmation}
                                className="mt-1 block w-full rounded-2xl border-gray-200 bg-gray-50/50 focus:border-[#d06b72] focus:ring-[#d06b72] px-4 py-3"
                                onChange={(e) => setData("password_confirmation", e.target.value)}
                                placeholder="••••••••"
                                required
                            />
                            <InputError message={errors.password_confirmation} className="mt-2" />
                        </div>
                    </div>

                    <div className="flex flex-col items-center space-y-4 pt-4">
                        <PrimaryButton 
                            className={`w-full md:w-2/3 justify-center py-4 rounded-2xl text-white font-black uppercase tracking-widest border-none ${buttonBgClass}`} 
                            disabled={processing}
                        >
                            {processing ? 'Registering...' : 'Register Now'}
                        </PrimaryButton>

                        <Link
                            href={route("login")}
                            className="text-sm font-bold text-gray-500 hover:text-[#d06b72] transition-colors"
                        >
                            Already registered? <span className={accentColorClass}>Log in</span>
                        </Link>
                    </div>
                </form>
            </div>

            <div className="mt-8 mb-4 text-xs font-bold text-gray-400/70 tracking-[0.2em] uppercase relative z-10 text-center">
                #OurHomeWhereWeGrowWhatWeOwn • 2026
            </div>
        </div>
    );
}