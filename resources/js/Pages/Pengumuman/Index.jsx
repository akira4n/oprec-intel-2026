import { Head, useForm, usePage } from "@inertiajs/react";

export default function Index({ result }) {
    // Props 'result' datang dari Controller
    const { errors } = usePage().props;

    // Setup Form
    const { data, setData, post, processing } = useForm({
        nim: "",
    });

    const submit = (e) => {
        e.preventDefault();
        post(route("pengumuman.check"), {
            preserveScroll: true, // Biar pas submit gak scroll ke atas, tetep di hasil
        });
    };

    // --- KOMPONEN KARTU HASIL ---
    const ResultCard = ({ data }) => {
        // Logika Warna & Pesan berdasarkan Status
        let statusColor = "bg-gray-100 text-gray-800";
        let title = "Status Tidak Diketahui";
        let message = "";
        let icon = "";

        if (data.status === "pending") {
            statusColor = "bg-yellow-100 text-yellow-800 border-yellow-300";
            title = "MENUNGGU KONFIRMASI";
            message =
                "Data kamu masih dalam proses verifikasi akhir. Harap hubungi panitia jika ini berlanjut.";
            icon = "⏳";
        } else if (data.status === "ditolak") {
            statusColor = "bg-red-100 text-red-800 border-red-300";
            title = "MOHON MAAF";
            message =
                "Kamu belum lolos seleksi Oprec INTEL tahun ini. Jangan berkecil hati, tetap semangat dan coba lagi tahun depan!";
            icon = "🥀";
        } else if (data.status === "terima") {
            statusColor = "bg-green-100 text-green-800 border-green-300";
            title = "SELAMAT! KAMU DITERIMA 🎉";
            message =
                "Selamat bergabung menjadi bagian dari keluarga besar INTEL UNSRI.";
            icon = "🌟";
        }

        return (
            <div className="mt-8 animate-fade-in-up">
                <div
                    className={`border-2 rounded-xl p-8 text-center shadow-lg ${statusColor}`}
                >
                    <div className="text-6xl mb-4">{icon}</div>

                    <h2 className="text-3xl font-black mb-2 tracking-tight">
                        {title}
                    </h2>

                    {/* Tampilkan Detail Nama & NIM */}
                    <div className="bg-white/60 rounded-lg p-4 my-6 inline-block min-w-[250px]">
                        <p className="text-sm font-bold uppercase tracking-widest opacity-70">
                            Nama Lengkap
                        </p>
                        <p className="text-xl font-bold mb-3">{data.name}</p>

                        <p className="text-sm font-bold uppercase tracking-widest opacity-70">
                            NIM
                        </p>
                        <p className="text-xl font-bold">{data.nim}</p>
                    </div>

                    {/* Jika DITERIMA, Tampilkan Divisi */}
                    {data.status === "terima" && (
                        <div className="mt-2 mb-6">
                            <p className="text-sm font-bold uppercase tracking-widest opacity-70 mb-1">
                                Ditempatkan di
                            </p>
                            <div className="inline-block bg-green-600 text-white text-2xl font-extrabold px-6 py-2 rounded-full shadow-md uppercase">
                                {data.accepted_division}
                            </div>
                        </div>
                    )}

                    <p className="text-lg font-medium opacity-90 max-w-lg mx-auto leading-relaxed">
                        {message}
                    </p>
                </div>
            </div>
        );
    };

    return (
        <div className="min-h-screen bg-gray-50 flex flex-col items-center py-12 px-4 sm:px-6 lg:px-8">
            <Head title="Cek Kelulusan Oprec INTEL" />

            <div className="max-w-3xl w-full space-y-8">
                {/* Header */}
                <div className="text-center">
                    <h1 className="text-4xl font-extrabold text-blue-900 tracking-tight sm:text-5xl">
                        Pengumuman Kelulusan
                    </h1>
                    <p className="mt-2 text-lg text-gray-600">
                        Open Recruitment INTEL 2026
                    </p>
                </div>

                {/* Form Section */}
                <div className="bg-white py-8 px-6 shadow-xl rounded-2xl border border-gray-100 sm:px-10">
                    <form onSubmit={submit} className="space-y-6">
                        <div>
                            <label
                                htmlFor="nim"
                                className="block text-sm font-medium text-gray-700"
                            >
                                Masukkan NIM Kamu
                            </label>
                            <div className="mt-1">
                                <input
                                    id="nim"
                                    name="nim"
                                    type="text"
                                    required
                                    placeholder="Contoh: 09031282..."
                                    value={data.nim}
                                    onChange={(e) =>
                                        setData("nim", e.target.value)
                                    }
                                    className="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-lg"
                                />
                            </div>
                            {errors.nim && (
                                <p className="mt-2 text-sm text-red-600 font-semibold bg-red-50 p-2 rounded">
                                    ⚠️ {errors.nim}
                                </p>
                            )}
                        </div>

                        <div>
                            <button
                                type="submit"
                                disabled={processing}
                                className="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 transition-all transform hover:scale-[1.01]"
                            >
                                {processing
                                    ? "Sedang Memeriksa..."
                                    : "CEK HASIL KELULUSAN"}
                            </button>
                        </div>
                    </form>
                </div>

                {/* Result Section (Muncul hanya jika props 'result' ada) */}
                {result && <ResultCard data={result} />}
            </div>
        </div>
    );
}
