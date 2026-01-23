import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, useForm, usePage } from "@inertiajs/react";

export default function Dashboard({ auth, applicant }) {
    const { oprec } = usePage().props;

    const isSubmitted = !!applicant;
    const isClosed = !oprec.is_open;

    const isFormClosed = isSubmitted || isClosed;

    // List Divisi
    const divisions = [
        "hrd",
        "pr",
        "mulmed",
        "arrait",
        "scrabble",
        "newscasting",
        "debate",
        "toastmaster",
    ];

    const { data, setData, post, processing, errors } = useForm({
        divisi_satu: applicant?.divisi_satu || "",
        divisi_dua: applicant?.divisi_dua || "",
        alasan_utama: applicant?.alasan_utama || "",
        alasan_satu: applicant?.alasan_satu || "",
        alasan_dua: applicant?.alasan_dua || "",
        file_tugas_satu: null,
        file_tugas_dua: null,
    });

    const submit = (e) => {
        e.preventDefault();
        post(route("applicant.store"));
    };

    const SubmissionInfo = () => {
        return (
            <div
                className="bg-blue-50 border-l-4 border-blue-500 text-blue-700 p-6 mb-8 rounded shadow-sm"
                role="alert"
            >
                <div className="flex items-start">
                    <div className="py-1">
                        <svg
                            className="fill-current h-8 w-8 text-blue-500 mr-4"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                        >
                            <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                        </svg>
                    </div>
                    <div>
                        <p className="font-bold text-lg">
                            Pendaftaran Berhasil Diterima! ✅
                        </p>
                        <p className="mt-2 text-md">
                            Terima kasih telah mendaftar,{" "}
                            <strong>{auth.user.name}</strong>. <br />
                            Data dan berkas tugasmu sudah berhasil kami simpan
                            di database.
                        </p>
                        <div className="mt-4 border-t border-blue-200 pt-3">
                            <p className="font-semibold text-sm text-blue-800">
                                📢 Apa selanjutnya?
                            </p>
                            <p className="text-sm mt-1">
                                Proses seleksi berkas sedang berlangsung.
                                Pengumuman tahap selanjutnya akan diinfokan
                                secara serentak. Pastikan kamu memantau
                                Instagram dan Grup WhatsApp Resmi Oprec INTEL.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        );
    };

    const LateBanner = () => (
        <div
            className="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 shadow-sm"
            role="alert"
        >
            <p className="font-bold">⏳ Pendaftaran Sudah Ditutup</p>
            <p>Maaf, kamu terlambat melakukan submit form pendaftaran.</p>
        </div>
    );

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Dashboard Pendaftaran
                </h2>
            }
        >
            <Head title="Dashboard Oprec INTEL" />

            <div className="py-12">
                <div className="max-w-4xl mx-auto sm:px-6 lg:px-8">
                    {/* tampilin banner jika sudah submit atau terlambat submit */}
                    {isSubmitted ? (
                        <SubmissionInfo />
                    ) : (
                        isClosed && <LateBanner />
                    )}

                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8 border border-gray-100">
                        <div className="mb-8 border-b pb-4">
                            <h3 className="text-2xl font-bold text-gray-800">
                                Formulir Pendaftaran
                            </h3>
                            <p className="text-sm text-gray-500 mt-1">
                                Lengkapi data diri dan motivasimu dengan jujur.
                            </p>

                            <div className="mt-4 flex gap-4 text-sm text-gray-600 bg-gray-50 p-3 rounded-md">
                                <div>
                                    <span className="font-bold block">
                                        Nama:
                                    </span>{" "}
                                    {auth.user.name}
                                </div>
                                <div>
                                    <span className="font-bold block">
                                        NIM:
                                    </span>{" "}
                                    {auth.user.nim}
                                </div>
                                <div>
                                    <span className="font-bold block">
                                        Email:
                                    </span>{" "}
                                    {auth.user.email}
                                </div>
                            </div>
                        </div>

                        <form onSubmit={submit} className="space-y-8">
                            {/* --- SECTION 1: PILIHAN DIVISI --- */}
                            <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div>
                                    <label className="block font-semibold text-sm text-gray-700 mb-2">
                                        Pilihan Divisi 1 (Wajib)
                                    </label>
                                    <select
                                        className="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:bg-gray-100 disabled:text-gray-500"
                                        value={data.divisi_satu}
                                        onChange={(e) =>
                                            setData(
                                                "divisi_satu",
                                                e.target.value,
                                            )
                                        }
                                        disabled={isFormClosed}
                                        required
                                    >
                                        <option value="">Pilih Divisi</option>
                                        {divisions.map((div) => (
                                            <option key={div} value={div}>
                                                {div.toUpperCase()}
                                            </option>
                                        ))}
                                    </select>
                                    {errors.divisi_satu && (
                                        <div className="text-red-500 text-sm mt-1">
                                            {errors.divisi_satu}
                                        </div>
                                    )}
                                </div>

                                <div>
                                    <label className="block font-semibold text-sm text-gray-700 mb-2">
                                        Pilihan Divisi 2 (Opsional)
                                    </label>
                                    <select
                                        className="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:bg-gray-100 disabled:text-gray-500"
                                        value={data.divisi_dua}
                                        onChange={(e) =>
                                            setData(
                                                "divisi_dua",
                                                e.target.value,
                                            )
                                        }
                                        disabled={isFormClosed}
                                    >
                                        <option value="">Tidak Memilih</option>
                                        {divisions.map((div) => (
                                            <option key={div} value={div}>
                                                {div.toUpperCase()}
                                            </option>
                                        ))}
                                    </select>
                                    {errors.divisi_dua && (
                                        <div className="text-red-500 text-sm mt-1">
                                            {errors.divisi_dua}
                                        </div>
                                    )}
                                </div>
                            </div>

                            <div className="border-t border-gray-100"></div>

                            {/* --- SECTION 2: MOTIVASI --- */}
                            <div>
                                <label className="block font-semibold text-sm text-gray-700 mb-2">
                                    Alasan & Motivasi Masuk INTEL{" "}
                                    <span className="text-red-500">*</span>
                                </label>
                                <textarea
                                    className="w-full h-32 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:bg-gray-100 disabled:text-gray-600"
                                    value={data.alasan_utama}
                                    onChange={(e) =>
                                        setData("alasan_utama", e.target.value)
                                    }
                                    disabled={isFormClosed}
                                    placeholder="Jelaskan motivasi terbesarmu bergabung dengan organisasi ini..."
                                    required
                                />
                                {errors.alasan_utama && (
                                    <div className="text-red-500 text-sm mt-1">
                                        {errors.alasan_utama}
                                    </div>
                                )}
                            </div>

                            <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div>
                                    <label className="block font-semibold text-sm text-gray-700 mb-2">
                                        Alasan Memilih Divisi 1
                                    </label>
                                    <textarea
                                        className="w-full h-32 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:bg-gray-100 disabled:text-gray-600"
                                        value={data.alasan_satu}
                                        onChange={(e) =>
                                            setData(
                                                "alasan_satu",
                                                e.target.value,
                                            )
                                        }
                                        disabled={isFormClosed}
                                        required
                                    />
                                    {errors.alasan_satu && (
                                        <div className="text-red-500 text-sm mt-1">
                                            {errors.alasan_satu}
                                        </div>
                                    )}
                                </div>

                                <div>
                                    <label className="block font-semibold text-sm text-gray-700 mb-2">
                                        Alasan Memilih Divisi 2
                                    </label>
                                    <textarea
                                        className="w-full h-32 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:bg-gray-100 disabled:text-gray-600"
                                        value={data.alasan_dua}
                                        onChange={(e) =>
                                            setData(
                                                "alasan_dua",
                                                e.target.value,
                                            )
                                        }
                                        disabled={isFormClosed}
                                        placeholder="Kosongkan jika tidak memilih divisi 2"
                                    />
                                    {errors.alasan_dua && (
                                        <div className="text-red-500 text-sm mt-1">
                                            {errors.alasan_dua}
                                        </div>
                                    )}
                                </div>
                            </div>

                            <div className="border-t border-gray-100"></div>

                            {/* --- SECTION 3: UPLOAD TUGAS --- */}
                            <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
                                {/* TUGAS DIVISI 1 */}
                                <div>
                                    <label className="block font-semibold text-sm text-gray-700 mb-2">
                                        File Tugas Divisi 1 (PDF/ZIP)
                                    </label>

                                    {!isFormClosed ? (
                                        // 1. Mode Input (Masih Buka & Belum Submit)
                                        <div className="mt-1">
                                            <input
                                                type="file"
                                                className="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer border border-gray-300 rounded-lg"
                                                onChange={(e) =>
                                                    setData(
                                                        "file_tugas_satu",
                                                        e.target.files[0],
                                                    )
                                                }
                                                accept=".pdf,.zip,.rar"
                                                required
                                            />
                                            <p className="text-xs text-gray-500 mt-1">
                                                Maksimal 10MB.
                                            </p>
                                        </div>
                                    ) : isSubmitted ? (
                                        // 2. Mode Read Only (Sudah Submit -> Tampilkan Link)
                                        <div className="mt-2 p-3 bg-gray-50 border border-gray-200 rounded-md flex items-center justify-between">
                                            <div className="flex items-center text-sm text-gray-600">
                                                <svg
                                                    className="w-5 h-5 mr-2 text-red-500"
                                                    fill="currentColor"
                                                    viewBox="0 0 20 20"
                                                >
                                                    <path
                                                        fillRule="evenodd"
                                                        d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                                        clipRule="evenodd"
                                                    />
                                                </svg>
                                                <span>
                                                    File Tugas 1 Terkirim
                                                </span>
                                            </div>
                                            <a
                                                href={`/storage/${applicant.path_tugas_satu}`}
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                className="text-sm font-semibold text-indigo-600 hover:underline"
                                            >
                                                Lihat File
                                            </a>
                                        </div>
                                    ) : (
                                        // 3. Mode Telat (Waktu Habis & Belum Submit -> Tampilkan Info)
                                        <div className="mt-2 text-sm text-red-500 italic border border-red-200 bg-red-50 p-2 rounded">
                                            Waktu pendaftaran habis. Tidak dapat
                                            mengupload file.
                                        </div>
                                    )}
                                    {errors.file_tugas_satu && (
                                        <div className="text-red-500 text-sm mt-1">
                                            {errors.file_tugas_satu}
                                        </div>
                                    )}
                                </div>

                                {/* TUGAS DIVISI 2 */}
                                {/* TUGAS DIVISI 1 */}
                                <div>
                                    <label className="block font-semibold text-sm text-gray-700 mb-2">
                                        File Tugas Divisi 2 (PDF/ZIP)
                                    </label>

                                    {!isFormClosed ? (
                                        // 1. Mode Input (Masih Buka & Belum Submit)
                                        <div className="mt-1">
                                            <input
                                                type="file"
                                                className="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer border border-gray-300 rounded-lg"
                                                onChange={(e) =>
                                                    setData(
                                                        "file_tugas_dua",
                                                        e.target.files[0],
                                                    )
                                                }
                                                accept=".pdf,.zip,.rar"
                                                required
                                            />
                                            <p className="text-xs text-gray-500 mt-1">
                                                Maksimal 10 MB.
                                            </p>
                                        </div>
                                    ) : isSubmitted ? (
                                        // 2. Mode Read Only (Sudah Submit -> Tampilkan Link)
                                        <div className="mt-2 p-3 bg-gray-50 border border-gray-200 rounded-md flex items-center justify-between">
                                            <div className="flex items-center text-sm text-gray-600">
                                                <svg
                                                    className="w-5 h-5 mr-2 text-red-500"
                                                    fill="currentColor"
                                                    viewBox="0 0 20 20"
                                                >
                                                    <path
                                                        fillRule="evenodd"
                                                        d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                                        clipRule="evenodd"
                                                    />
                                                </svg>
                                                <span>
                                                    File Tugas 2 Terkirim
                                                </span>
                                            </div>
                                            <a
                                                href={`/storage/${applicant.path_tugas_satu}`}
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                className="text-sm font-semibold text-indigo-600 hover:underline"
                                            >
                                                Lihat File
                                            </a>
                                        </div>
                                    ) : (
                                        // 3. Mode Telat (Waktu Habis & Belum Submit -> Tampilkan Info)
                                        <div className="mt-2 text-sm text-red-500 italic border border-red-200 bg-red-50 p-2 rounded">
                                            Waktu pendaftaran habis. Tidak dapat
                                            mengupload file.
                                        </div>
                                    )}
                                    {errors.file_tugas_dua && (
                                        <div className="text-red-500 text-sm mt-1">
                                            {errors.file_tugas_dua}
                                        </div>
                                    )}
                                </div>
                            </div>

                            {/* --- SUBMIT BUTTON --- */}
                            {!isFormClosed && (
                                <div className="flex justify-end pt-6">
                                    <button
                                        type="submit"
                                        disabled={processing}
                                        className="inline-flex items-center px-8 py-3 bg-indigo-600 border border-transparent rounded-md font-bold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 disabled:opacity-50 shadow-lg"
                                    >
                                        {processing
                                            ? "Mengirim Data..."
                                            : "Kirim Pendaftaran"}
                                    </button>
                                </div>
                            )}
                        </form>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
