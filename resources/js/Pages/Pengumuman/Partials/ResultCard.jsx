import {
    faArrowLeft,
    faDownload,
    faArrowRightFromBracket,
    faArrowRightToBracket,
} from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";

export default function ResultCard({ data }) {
    const handleReset = () => {
        window.location.href = route("pengumuman.index");
    };

    let cardStyle = "";
    let titleStyle = "";
    let title = "";
    let message = "";
    let badgeStyle = "";

    if (data.status === "pending") {
        cardStyle = "bg-[#fdd9bc] border-white text-[#d07270]";
        titleStyle = "text-[#d07270]";
        title = "Waiting For Confirmation";
        message =
            "Your data is still under final verification. Please contact the committee if this persists.";
    } else if (data.status === "ditolak") {
        cardStyle = "bg-[#f1b2ba] border-[#d07270] text-[#d07270]";
        titleStyle = "text-[#8a3c3c]";
        title =
            "We're Sorry, you were not selected for INTEL Member this year T_T";
        message =
            "We truly appreciate your interest and effort. Don’t be discouraged, and we hope to see you again next year!";
    } else if (data.status === "terima") {
        cardStyle = "bg-[#d4db94] border-white text-[#5f6338]";
        titleStyle = "text-[#4a4d2b]";
        title = "Congratulations, You Have Been Accepted!";
        message =
            "Welcome to the INTEL FASILKOM UNSRI family! We’re excited to have you join us.";
        badgeStyle = "bg-[#b99ab2] text-white";
    }

    return (
        <div className="animate-fade-in-up w-full max-w-3xl">
            <img
                src="assets\images\logo.png"
                alt=""
                className="h-28 mb-4 mx-auto rounded-xl"
            />

            <div
                className={`border-2 rounded-2xl p-8 md:p-10 text-center shadow-xl ${cardStyle}`}
            >
                <h2
                    className={`text-3xl md:text-4xl font-black mb-4 tracking-tight ${titleStyle}`}
                >
                    {title}
                </h2>

                {/* Detail Nama & NIM */}
                <div className="bg-white/50 backdrop-blur-sm rounded-lg p-6 my-6 inline-block shadow-sm">
                    <p className="text-xs font-bold uppercase tracking-widest opacity-70 mb-1">
                        Full Name
                    </p>
                    <p className="text-xl md:text-2xl font-bold mb-4">
                        {data.name}
                    </p>

                    <p className="text-xs font-bold uppercase tracking-widest opacity-70 mb-1">
                        NIM
                    </p>
                    <p className="text-xl md:text-2xl font-bold">{data.nim}</p>
                </div>

                {/* Divisi (Jika Diterima) */}
                {data.status === "terima" && (
                    <div className="mt-2 mb-8 flex flex-col items-center justify-center">
                        <p className="text-sm font-bold uppercase tracking-widest opacity-80 mb-2">
                            Assigned to the Division
                        </p>
                        <div
                            className={`mb-8 inline-block text-xl md:text-2xl font-extrabold px-8 py-3 rounded-lg shadow-lg uppercase tracking-wider ${badgeStyle}`}
                        >
                            {data.accepted_division}
                        </div>

                        <a
                            className={`mb-4 inline-block text-sm md:text-base px-6 py-2 rounded-lg shadow-lg bg-sky-800 text-white hover:bg-transparent border-sky-800 border-2 hover:shadow-none hover:text-sky-800 transition-all duration-300 ease-in-out`}
                            href="https://drive.google.com/drive/folders/1iXiNP3VEZ2o8inUtx2ND7vFi-vSR0oU4?usp=sharing"
                            target="_blank"
                        >
                            <FontAwesomeIcon icon={faDownload} /> Download
                            Commitment Letter
                        </a>

                        <a
                            className={`inline-block text-sm md:text-base px-8 py-4 rounded-lg shadow-lg text-white bg-[#25D366] hover:bg-transparent border-[#25D366] border-2 hover:shadow-none hover:text-[#25D366] transition-all duration-300 ease-in-out`}
                            href="https://forms.gle/cpzegUZh2PzSwyHq6"
                            target="_blank"
                        >
                            <FontAwesomeIcon icon={faArrowRightToBracket} />{" "}
                            Submit Here
                        </a>
                        <p className="mt-8 text-sm">
                            * Don't forget to submit your commitment letter and
                            join the WhatsApp Group!{" "}
                        </p>
                    </div>
                )}

                <p className="text-lg font-medium opacity-90 max-w-lg mx-auto leading-relaxed mb-8">
                    {message}
                </p>

                <button
                    onClick={handleReset}
                    className="group text-sm font-bold underline opacity-70 hover:opacity-100 transition-opacity"
                >
                    <FontAwesomeIcon
                        icon={faArrowLeft}
                        className="text-sm transition-all duration-300 group-hover:-translate-x-2 -translate-x-1"
                    />
                    Back
                </button>
            </div>
        </div>
    );
}
