import GuestLayout from "@/Layouts/GuestLayout";
import { Head, Link } from "@inertiajs/react";

export default function RegisterClosed() {
    return (
        <GuestLayout>
            <Head title="Pendaftaran Ditutup" />

            <div className="text-center py-8">
                <h2 className="text-2xl font-bold text-gray-800 mb-2">
                    Pendaftaran Ditutup
                </h2>
                <p className="text-gray-600 mb-6">
                    Mohon maaf, periode pendaftaran Open Recruitment INTEL 2026
                    telah berakhir pada tanggal 12 Februari.
                </p>

                <Link
                    href={route("login")}
                    className="text-indigo-600 hover:underline font-semibold"
                >
                    Kembali ke Login
                </Link>
            </div>
        </GuestLayout>
    );
}
