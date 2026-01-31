import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Head, useForm } from '@inertiajs/react';

// Asumsi: Anda punya file logo di public/images/intel-logo.png
// Jika tidak, hapus bagian tag <img> nanti.

export default function ConfirmPassword() {
    const { data, setData, post, processing, errors, reset } = useForm({
        password: '',
    });

    const submit = (e) => {
        e.preventDefault();

        post(route('password.confirm'), {
            onFinish: () => reset('password'),
        });
    };

    // Warna aksen merah muda/pink dari desain (contoh diambil dari gambar)
    const accentColorClass = "text-[#d06b72]"; // Atau gunakan text-rose-500 jika ingin standar tailwind
    const buttonBgClass = "bg-[#d06b72] hover:bg-[#b85a60] focus:bg-[#b85a60] active:bg-[#a34d53]"; // Atau bg-rose-500 dst.

    return (
        /* Wrapper Utama: Latar belakang gradien hijau lembut dan posisi tengah */
        <div className="min-h-screen bg-gradient-to-br from-[#f0f7da] to-[#dce8b8] flex flex-col justify-center items-center p-6 relative overflow-hidden">
            <Head title="Confirm Password" />

            {/* Elemen Dekorasi Latar Belakang (Orbs Blur) */}
            {/* Orb Hijau Kiri Bawah */}
            <div className="absolute bottom-[-10%] left-[-10%] w-64 h-64 md:w-96 md:h-96 bg-green-300/30 rounded-full mix-blend-multiply filter blur-3xl opacity-70 pointer-events-none"></div>
            {/* Orb Pink Kanan Atas */}
            <div className="absolute top-[-10%] right-[-10%] w-64 h-64 md:w-96 md:h-96 bg-rose-200/40 rounded-full mix-blend-multiply filter blur-3xl opacity-70 pointer-events-none"></div>

            {/* Kartu Form Utama */}
            <div className="relative z-10 w-full max-w-md bg-white rounded-2xl shadow-xl p-8 sm:p-10">
                {/* Logo Section */}
                <div className="flex justify-center mb-8">
                    {/* GANTI src ini dengan path logo Anda yang sebenarnya */}
                    <img
                        src="assets/images/logo.png"
                        alt="INTEL Logo"
                        className="h-20 w-auto object-contain rounded-md"
                        // Placeholder jika gambar belum ada, agar tidak rusak tampilannya
                        onError={(e) => {
                            e.target.onerror = null;
                            e.target.src = 'https://via.placeholder.com/150x80?text=INTEL+Logo';
                        }}
                    />
                </div>

                {/* Judul Halaman */}
                <h2 className={`text-center text-2xl font-bold mb-2 ${accentColorClass}`}>
                    Secure Area
                </h2>

                <div className="mb-8 text-sm text-center text-gray-600">
                    This is a secure area. Please confirm your password before continuing.
                </div>

                <form onSubmit={submit} className="space-y-6">
                    <div>
                        {/* Label dengan warna aksen */}
                        <InputLabel htmlFor="password" value="Password" className={`text-base font-semibold ${accentColorClass}`} />

                        <TextInput
                            id="password"
                            type="password"
                            name="password"
                            value={data.password}
                            // Input field yang lebih bulat (rounded-xl) dan ring fokus warna pink/merah
                            className="mt-2 block w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 focus:border-[#d06b72] focus:ring-[#d06b72]"
                            isFocused={true}
                            onChange={(e) => setData('password', e.target.value)}
                            placeholder="Enter your password"
                        />

                        <InputError message={errors.password} className="mt-2" />
                    </div>

                    <div className="flex items-center justify-center mt-4">
                        {/* Tombol dibuat lebar penuh (w-full), lebih bulat, dan warna kustom */}
                        <PrimaryButton
                            className={`w-full justify-center py-3 rounded-xl text-base font-bold border-none ${buttonBgClass}`}
                            disabled={processing}
                        >
                            {processing ? 'Confirming...' : 'Confirm Password'}
                        </PrimaryButton>
                    </div>
                </form>
            </div>

            {/* Footer kecil (opsional, seperti di image_2.png) */}
            <div className="mt-8 text-sm text-gray-500 relative z-10">
                &copy; 2026 INTEL Community.
            </div>
        </div>
    );
}