import { Head, Link } from "@inertiajs/react";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faBullhorn, faArrowRight } from "@fortawesome/free-solid-svg-icons";

export default function Pending() {
    return (
        <div className="relative min-h-screen flex flex-col gap-8 items-center justify-center bg-[#d4db94] px-4 text-center overflow-hidden">
            <Head title="Announcement Not Yet Open" />

            {/* Decorative circles */}
            <div className="absolute -left-24 top-0 w-64 h-64 bg-[#fffad0] rounded-full opacity-40" />
            <div className="absolute -right-32 top-40 w-80 h-80 bg-[#fdd9bc] rounded-full opacity-40" />
            <div className="absolute left-1/2 -top-60 w-80 h-80 bg-[#fdd9bc] rounded-full opacity-40" />
            <div className="absolute left-1/2 -bottom-32 w-72 h-72 bg-[#fffad0] rounded-full opacity-30 -translate-x-1/2" />

            <img
                src="assets/images/logo.png"
                alt=""
                className="rounded-xl h-28 z-20"
            />
            {/* Main content */}
            <div className="relative bg-[#fffad0] p-10 rounded-xl max-w-xl w-full shadow-md z-20">
                <FontAwesomeIcon icon={faBullhorn} className="text-2xl mb-3" />
                <h1 className="text-lg md:text-2xl font-bold text-[#d07270] mb-4">
                    Hang tight! Something cool is on the way.
                </h1>

                <div className="bg-[#fdd9bc] w-full rounded-md p-3">
                    <p className="font-semibold text-sm md:text-base mb-2">
                        Mark your calendar! <br /> We’re opening the
                        announcement on
                    </p>
                    <p className="font-bold text-xl md:text-2xl">
                        Feb 20, 2026 00:00 UTC+7
                    </p>
                </div>
            </div>

            <Link
                className="relative group text-black/50 inline-flex items-center gap-1 transition-all hover:text-black/80 h-20"
                href={route("dashboard")}
            >
                Back to Home
                <FontAwesomeIcon
                    icon={faArrowRight}
                    className="text-sm transition-all duration-300 group-hover:translate-x-1"
                />
            </Link>
        </div>
    );
}
