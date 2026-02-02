import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, useForm, usePage } from "@inertiajs/react";
import { useState, useEffect } from "react";

export default function Dashboard({ auth, applicant }) {
    const { oprec, task } = usePage().props;

    // --- LOGIC STATUS ---
    const isSubmitted = !!applicant;
    const isRegClosed = !oprec.is_open;

    // Form Registrasi jadi Read-Only jika: Sudah Submit ATAU Pendaftaran Tutup
    const isFormClosed = isSubmitted || isRegClosed;

    // Cek Status Tugas
    const isTaskSubmitted = applicant?.path_tugas_satu != null;
    const isTaskClosed = !task.is_open;

    // Form Tugas jadi Read-Only jika Sudah Submit Tugas ATAU Deadline Tugas Lewat
    const isTaskFormClosed = isTaskSubmitted || isTaskClosed;

    // Tampilkan Section Tugas
    const showTaskSection = isSubmitted;

    // --- DATA LIST ---
    const divisionOptions = [
        { id: "hrd", label: "HRD" },
        { id: "arrait", label: "ARRAIT" },
        { id: "mulmed", label: "Multimedia" },
        { id: "pr", label: "Public Relation" },
        { id: "videography", label: "Videography" },
        { id: "newscasting", label: "Newscasting" },
        { id: "toastmaster", label: "Toastmaster" },
        { id: "debate", label: "Debate" },
        { id: "scrabble", label: "Scrabble" },
    ];

    const batches = ["2024", "2025"];

    const majors = [
        { id: "si", name: "Information Systems" },
        { id: "sk", name: "Computer Systems" },
        { id: "ti", name: "Informatics Engineering" },
        { id: "ka", name: "Computerized Accounting" },
        { id: "mi", name: "Information Management" },
        { id: "tk", name: "Computer Engineering" },
    ];

    // --- FORM 1: REGISTRASI DATA DIRI ---
    const { data, setData, post, processing, errors } = useForm({
        major: applicant?.major || "",
        batch: applicant?.batch || "",
        divisi_satu: applicant?.divisi_satu || "",
        divisi_dua: applicant?.divisi_dua || "",
        alasan_utama: applicant?.alasan_utama || "",
        alasan_satu: applicant?.alasan_satu || "",
        alasan_dua: applicant?.alasan_dua || "",

        capaian: applicant?.capaian || "",
        org_sebelum:
            applicant?.org_sebelum !== undefined
                ? String(applicant.org_sebelum)
                : "",
        komitmen_tanggungjawab:
            applicant?.komitmen_tanggungjawab !== undefined
                ? String(applicant.komitmen_tanggungjawab)
                : "",

        file_tiktok: null,
        file_instagram: null,
        file_pamflet: null,
        file_twibbon: null,
    });

    const submitRegistration = (e) => {
        e.preventDefault();
        post(route("applicant.store"));
    };

    // --- FORM 2: UPLOAD TUGAS (ASSIGNMENT) ---
    const {
        data: taskData,
        setData: setTaskData,
        post: postTask,
        processing: processingTask,
        errors: taskErrors,
    } = useForm({
        file_tugas_satu: null,
        file_tugas_dua: null,
    });

    const submitTask = (e) => {
        e.preventDefault();
        postTask(route("applicant.store_tasks"));
    };

    // --- COMPONENT: COUNTDOWN ---
    const CountdownTimer = ({ deadline, label = "Time Remaining" }) => {
        const calculateTimeLeft = () => {
            const difference = +new Date(deadline) - +new Date();
            let timeLeft = {};

            if (difference > 0) {
                timeLeft = {
                    d: Math.floor(difference / (1000 * 60 * 60 * 24)),
                    h: Math.floor((difference / (1000 * 60 * 60)) % 24),
                    m: Math.floor((difference / 1000 / 60) % 60),
                    s: Math.floor((difference / 1000) % 60),
                };
            }
            return timeLeft;
        };

        const [timeLeft, setTimeLeft] = useState(calculateTimeLeft());

        useEffect(() => {
            const timer = setInterval(() => {
                setTimeLeft(calculateTimeLeft());
            }, 1000);
            return () => clearInterval(timer);
        }, [deadline]);

        const timerComponents = [];
        Object.keys(timeLeft).forEach((interval) => {
            if (!timeLeft[interval] && timeLeft[interval] !== 0) return;
            timerComponents.push(
                <span
                    key={interval}
                    className="font-mono font-bold text-gray-700"
                >
                    {timeLeft[interval]}
                    <span className="text-[10px] text-gray-400 mr-1 uppercase">
                        {interval}
                    </span>
                </span>,
            );
        });

        return (
            <div className="flex justify-center py-2 mb-4">
                {timerComponents.length ? (
                    <div className="bg-white px-3 py-1 rounded-full shadow-sm border border-gray-100 flex items-center gap-1 text-xs">
                        <span className="text-gray-400 mr-1">{label}:</span>
                        {timerComponents}
                    </div>
                ) : (
                    <span className="text-red-500 font-bold text-xs bg-red-50 px-3 py-1 rounded-full">
                        Time is Up!
                    </span>
                )}
            </div>
        );
    };

    // --- NOTIFICATIONS ---
    const SubmissionInfo = () => (
        <div className="bg-green-50/50 border border-green-200 text-green-800 p-6 mb-8 rounded-xl shadow-sm flex items-start gap-4">
            <div className="bg-green-100 p-2 rounded-full text-green-600">
                <svg
                    className="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        strokeLinecap="round"
                        strokeLinejoin="round"
                        strokeWidth="2"
                        d="M5 13l4 4L19 7"
                    />
                </svg>
            </div>
            <div>
                <h3 className="font-bold text-lg">
                    Registration Data Received!
                </h3>
                <p className="mt-1 text-sm text-green-700 leading-relaxed mb-2">
                    Thank you, <strong>{auth.user.name}</strong>. Your personal
                    data has been saved
                    {!isTaskSubmitted
                        ? ". Please continue to upload your tasks below."
                        : " and your submission has been sent. Good luck!"}
                </p>
                <a
                    href="https://chat.whatsapp.com/C5rERVrt3joJkKug6HIupR"
                    target="_blank"
                    className="mt-1 text-sm text-sky-700 font-bold"
                >
                    [Join WhatsApp Group]
                </a>
            </div>
        </div>
    );

    const LateBanner = () => (
        <div className="bg-red-50 border border-red-200 text-red-700 p-4 mb-6 rounded-xl text-center shadow-sm">
            <p className="font-bold">Registration Closed</p>
            <p className="text-sm">
                We are sorry, the submission period has ended.
            </p>
        </div>
    );

    // --- STYLES ---
    const inputClass =
        "w-full border-gray-200 bg-gray-50/50 rounded-lg px-4 py-3 text-sm focus:bg-white focus:border-[#D4DB95] focus:ring-[#D4DB95] transition-all disabled:opacity-60 disabled:cursor-not-allowed";
    const labelClass =
        "block font-semibold text-xs text-gray-500 uppercase tracking-wider mb-2";
    const sectionTitleClass =
        "text-xl font-bold text-gray-800 border-l-4 border-[#D4DB95] pl-3 mb-6";

    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title="Registration Dashboard" />

            <div className="pb-20 pt-8">
                <div className="max-w-5xl mx-auto sm:px-6 lg:px-8">
                    {/* 1. Countdown Global (Muncul jika belum daftar & Oprec masih buka) */}
                    {!isSubmitted && !isRegClosed && (
                        <CountdownTimer
                            deadline={oprec.deadline}
                            label="Registration Deadline"
                        />
                    )}

                    {/* 2. Status Banners */}
                    {isSubmitted ? (
                        <SubmissionInfo />
                    ) : (
                        isRegClosed && <LateBanner />
                    )}

                    {/* 3. FORM ASSIGNMENT (Muncul Jika Sudah Regis) */}
                    {showTaskSection && (
                        <>
                            {!isTaskSubmitted && !isTaskClosed && (
                                <CountdownTimer
                                    deadline={task.deadline}
                                    label="Task Deadline"
                                />
                            )}

                            <div
                                className={`bg-white shadow-xl shadow-gray-200/50 rounded-lg sm:rounded-2xl overflow-hidden mb-10 border-2 border-[#D4DB95]/20`}
                            >
                                <div className="px-8 pt-8 pb-4 border-b border-gray-100">
                                    <h2 className="text-2xl font-black text-gray-800 tracking-tight">
                                        {isTaskSubmitted
                                            ? "Task Submitted"
                                            : "Task Submission"}
                                    </h2>
                                    <p className="text-gray-500 mt-1 text-sm">
                                        Tasks for division:
                                        <span className="font-bold text-[#D4DB95] uppercase ml-1">
                                            {applicant.divisi_satu}
                                        </span>
                                        {applicant.divisi_dua && (
                                            <span className="mx-1">&</span>
                                        )}
                                        <span className="font-bold text-[#D4DB95] uppercase">
                                            {applicant.divisi_dua}
                                        </span>
                                    </p>
                                    <a
                                        href=""
                                        target="_blank"
                                        className="mt-6 text-blue-800 text-sm font-bold"
                                    >
                                        [ View Submission ]
                                    </a>
                                </div>

                                <form
                                    onSubmit={submitTask}
                                    className="p-8 space-y-8"
                                >
                                    <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        {/* Task 1 */}
                                        <div>
                                            <label className={labelClass}>
                                                Task for {applicant.divisi_satu}{" "}
                                                <span className="text-red-400">
                                                    *
                                                </span>
                                            </label>

                                            {!isTaskFormClosed ? (
                                                <div className="mt-1">
                                                    <input
                                                        type="file"
                                                        className="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-gray-100 file:text-gray-700 hover:file:bg-[#D4DB95] hover:file:text-white transition-all cursor-pointer border border-gray-300 rounded-lg"
                                                        onChange={(e) =>
                                                            setTaskData(
                                                                "file_tugas_satu",
                                                                e.target
                                                                    .files[0],
                                                            )
                                                        }
                                                        accept=".pdf,.zip,.rar,.docx,.doc"
                                                        required
                                                    />
                                                    <p className="text-[10px] text-gray-400 mt-1">
                                                        Max: 10MB (PDF, ZIP,
                                                        RAR, DOCX).
                                                    </p>
                                                </div>
                                            ) : isTaskSubmitted ? (
                                                <div className="mt-1 p-3 bg-gray-50 border border-gray-200 rounded-lg flex items-center justify-between">
                                                    <span className="text-sm text-gray-600 font-medium">
                                                        Task Submitted
                                                    </span>
                                                    <a
                                                        href={`/storage/${applicant.path_tugas_satu}`}
                                                        target="_blank"
                                                        rel="noopener noreferrer"
                                                        className="text-xs font-bold text-[#b8bf76] hover:underline"
                                                    >
                                                        View File
                                                    </a>
                                                </div>
                                            ) : (
                                                <div className="text-sm text-red-400 italic">
                                                    Submission Closed
                                                </div>
                                            )}

                                            {taskErrors.file_tugas_satu && (
                                                <p className="text-red-500 text-xs mt-1">
                                                    {taskErrors.file_tugas_satu}
                                                </p>
                                            )}
                                        </div>

                                        {/* Task 2 */}
                                        <div>
                                            <label className={labelClass}>
                                                Task for {applicant.divisi_dua}{" "}
                                                <span className="text-red-400">
                                                    *
                                                </span>
                                            </label>

                                            {!isTaskFormClosed ? (
                                                <div className="mt-1">
                                                    <input
                                                        type="file"
                                                        className="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-gray-100 file:text-gray-700 hover:file:bg-[#D4DB95] hover:file:text-white transition-all cursor-pointer border border-gray-300 rounded-lg"
                                                        onChange={(e) =>
                                                            setTaskData(
                                                                "file_tugas_dua",
                                                                e.target
                                                                    .files[0],
                                                            )
                                                        }
                                                        accept=".pdf,.zip,.rar,.docx,.doc"
                                                        required
                                                    />
                                                    <p className="text-[10px] text-gray-400 mt-1">
                                                        Max: 10MB (PDF, ZIP,
                                                        RAR, DOCX).
                                                    </p>
                                                </div>
                                            ) : isTaskSubmitted ? (
                                                applicant.path_tugas_dua ? (
                                                    <div className="mt-1 p-3 bg-gray-50 border border-gray-200 rounded-lg flex items-center justify-between">
                                                        <span className="text-sm text-gray-600 font-medium">
                                                            Task Submitted
                                                        </span>
                                                        <a
                                                            href={`/storage/${applicant.path_tugas_dua}`}
                                                            target="_blank"
                                                            rel="noopener noreferrer"
                                                            className="text-xs font-bold text-[#b8bf76] hover:underline"
                                                        >
                                                            View File
                                                        </a>
                                                    </div>
                                                ) : (
                                                    <div className="text-sm text-gray-400 italic p-3 text-center bg-gray-50 rounded-lg">
                                                        No 2nd task submitted
                                                    </div>
                                                )
                                            ) : (
                                                <div className="text-sm text-red-400 italic">
                                                    Submission Closed
                                                </div>
                                            )}

                                            {taskErrors.file_tugas_dua && (
                                                <p className="text-red-500 text-xs mt-1">
                                                    {taskErrors.file_tugas_dua}
                                                </p>
                                            )}
                                        </div>
                                    </div>

                                    {!isTaskFormClosed && (
                                        <div className="flex justify-end pt-2">
                                            <button
                                                type="submit"
                                                disabled={processingTask}
                                                className="w-full sm:w-auto px-8 py-3 bg-[#D4DB95] text-white font-bold rounded-lg shadow-lg shadow-[#D4DB95]/30 hover:bg-[#c0c785] hover:shadow-xl hover:-translate-y-0.5 transition-all duration-200 disabled:opacity-70 disabled:cursor-not-allowed uppercase tracking-wide text-xs"
                                            >
                                                {processingTask
                                                    ? "Uploading..."
                                                    : "Submit Tasks"}
                                            </button>
                                        </div>
                                    )}
                                </form>
                            </div>
                        </>
                    )}

                    {/* 4. FORM REGISTRASI (READ ONLY IF SUBMITTED) */}
                    <div
                        className={
                            "bg-white shadow-xl shadow-gray-200/50 rounded-lg sm:rounded-2xl overflow-hidden"
                        }
                    >
                        {/* Header Form */}
                        <div className="px-8 pt-10 pb-6 text-center max-w-2xl mx-auto">
                            <h2 className="text-3xl font-black text-gray-800 tracking-tight">
                                {isSubmitted
                                    ? "Your Application Data"
                                    : "INTEL 2026 Member Recruitment"}
                            </h2>
                            <p className="text-gray-500 mt-2 text-sm leading-relaxed">
                                {isSubmitted
                                    ? "Below is the data you have submitted."
                                    : "Please fill out the form below carefully. All fields marked with (*) are mandatory."}
                            </p>
                        </div>

                        <form
                            onSubmit={submitRegistration}
                            className="p-8 sm:p-10 space-y-10"
                        >
                            {/* --- DATA USER --- */}
                            <div>
                                <h3 className={sectionTitleClass}>
                                    Student Information
                                </h3>
                                <div className="grid grid-cols-1 sm:grid-cols-2 gap-6 bg-gray-50 p-6 rounded-xl border border-gray-100">
                                    <div>
                                        <span className={labelClass}>
                                            Full Name
                                        </span>
                                        <div className="font-medium text-gray-800">
                                            {auth.user.name}
                                        </div>
                                    </div>
                                    <div>
                                        <span className={labelClass}>
                                            NIM (Student ID)
                                        </span>
                                        <div className="font-medium text-gray-800">
                                            {auth.user.nim}
                                        </div>
                                    </div>
                                    <div>
                                        <span className={labelClass}>
                                            Email Address
                                        </span>
                                        <div className="font-medium text-gray-800">
                                            {auth.user.email}
                                        </div>
                                    </div>
                                    <div>
                                        <span className={labelClass}>
                                            Phone Number
                                        </span>
                                        <div className="font-medium text-gray-800">
                                            {auth.user.no_hp}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {/* --- ACADEMIC DATA --- */}
                            <div>
                                <h3 className={sectionTitleClass}>
                                    Academic Details
                                </h3>
                                <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label className={labelClass}>
                                            Major{" "}
                                            <span className="text-red-400">
                                                *
                                            </span>
                                        </label>
                                        <select
                                            className={inputClass}
                                            value={data.major}
                                            onChange={(e) =>
                                                setData("major", e.target.value)
                                            }
                                            disabled={isFormClosed}
                                            required
                                        >
                                            <option value="">
                                                Select your Major
                                            </option>
                                            {majors.map((m) => (
                                                <option key={m.id} value={m.id}>
                                                    {m.name}
                                                </option>
                                            ))}
                                        </select>
                                        {errors.major && (
                                            <p className="text-red-500 text-xs mt-1">
                                                {errors.major}
                                            </p>
                                        )}
                                    </div>

                                    <div>
                                        <label className={labelClass}>
                                            Batch{" "}
                                            <span className="text-red-400">
                                                *
                                            </span>
                                        </label>
                                        <select
                                            className={inputClass}
                                            value={data.batch}
                                            onChange={(e) =>
                                                setData("batch", e.target.value)
                                            }
                                            disabled={isFormClosed}
                                            required
                                        >
                                            <option value="">
                                                Select Batch
                                            </option>
                                            {batches.map((b) => (
                                                <option key={b} value={b}>
                                                    {b}
                                                </option>
                                            ))}
                                        </select>
                                        {errors.batch && (
                                            <p className="text-red-500 text-xs mt-1">
                                                {errors.batch}
                                            </p>
                                        )}
                                    </div>
                                </div>
                            </div>

                            {/* --- DIVISION PREFERENCES --- */}
                            <div>
                                <h3 className={sectionTitleClass}>
                                    Division Preferences
                                </h3>
                                <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label className={labelClass}>
                                            1st Division Choice{" "}
                                            <span className="text-red-400">
                                                *
                                            </span>
                                        </label>
                                        <select
                                            className={inputClass}
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
                                            <option value="">
                                                Select 1st Division
                                            </option>
                                            {divisionOptions.map((div) => (
                                                <option
                                                    key={div.id}
                                                    value={div.id}
                                                >
                                                    {div.label}
                                                </option>
                                            ))}
                                        </select>
                                        {errors.divisi_satu && (
                                            <p className="text-red-500 text-xs mt-1">
                                                {errors.divisi_satu}
                                            </p>
                                        )}
                                    </div>

                                    <div>
                                        <label className={labelClass}>
                                            2nd Division Choice{" "}
                                            <span className="text-red-400">
                                                *
                                            </span>
                                        </label>
                                        <select
                                            className={inputClass}
                                            value={data.divisi_dua}
                                            onChange={(e) =>
                                                setData(
                                                    "divisi_dua",
                                                    e.target.value,
                                                )
                                            }
                                            disabled={isFormClosed}
                                            required
                                        >
                                            <option value="">
                                                Select 2nd Division
                                            </option>
                                            {divisionOptions.map((div) => (
                                                <option
                                                    key={div.id}
                                                    value={div.id}
                                                >
                                                    {div.label}
                                                </option>
                                            ))}
                                        </select>
                                        {errors.divisi_dua && (
                                            <p className="text-red-500 text-xs mt-1">
                                                {errors.divisi_dua}
                                            </p>
                                        )}
                                    </div>
                                </div>
                            </div>

                            {/* --- MOTIVATION & COMMITMENT (UPDATED SECTION) --- */}
                            <div>
                                <h3 className={sectionTitleClass}>
                                    Motivation & Commitment
                                </h3>
                                <div className="space-y-6">
                                    <div>
                                        <label className={labelClass}>
                                            Why do you want to join INTEL?{" "}
                                            <span className="text-red-400">
                                                *
                                            </span>
                                        </label>
                                        <textarea
                                            className={`${inputClass} min-h-[120px]`}
                                            value={data.alasan_utama}
                                            onChange={(e) =>
                                                setData(
                                                    "alasan_utama",
                                                    e.target.value,
                                                )
                                            }
                                            disabled={isFormClosed}
                                            placeholder="Explain your biggest motivation..."
                                            required
                                        />
                                        {errors.alasan_utama && (
                                            <p className="text-red-500 text-xs mt-1">
                                                {errors.alasan_utama}
                                            </p>
                                        )}
                                    </div>

                                    <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label className={labelClass}>
                                                Reason and why we should choose
                                                you for 1st Division Choice{" "}
                                                <span className="text-red-400">
                                                    *
                                                </span>
                                            </label>
                                            <textarea
                                                className={`${inputClass} min-h-[100px]`}
                                                value={data.alasan_satu}
                                                onChange={(e) =>
                                                    setData(
                                                        "alasan_satu",
                                                        e.target.value,
                                                    )
                                                }
                                                disabled={isFormClosed}
                                                placeholder="Why you choose this division? Why should we accept you?"
                                                required
                                            />
                                            {errors.alasan_satu && (
                                                <p className="text-red-500 text-xs mt-1">
                                                    {errors.alasan_satu}
                                                </p>
                                            )}
                                        </div>
                                        <div>
                                            <label className={labelClass}>
                                                Reason and why we should choose
                                                you for 2nd Division Choice{" "}
                                                <span className="text-red-400">
                                                    *
                                                </span>
                                            </label>
                                            <textarea
                                                className={`${inputClass} min-h-[100px]`}
                                                value={data.alasan_dua}
                                                onChange={(e) =>
                                                    setData(
                                                        "alasan_dua",
                                                        e.target.value,
                                                    )
                                                }
                                                disabled={isFormClosed}
                                                placeholder="Why you choose this division? Why should we accept you?"
                                                required
                                            />
                                            {errors.alasan_dua && (
                                                <p className="text-red-500 text-xs mt-1">
                                                    {errors.alasan_dua}
                                                </p>
                                            )}
                                        </div>
                                    </div>

                                    {/* --- 1. CAPAIAN (FULL WIDTH) --- */}
                                    <div>
                                        <label className={labelClass}>
                                            What do you hope to achieve by being
                                            part of INTEL?{" "}
                                            <span className="text-red-400">
                                                *
                                            </span>
                                        </label>
                                        <textarea
                                            className={`${inputClass} min-h-[120px]`}
                                            value={data.capaian}
                                            onChange={(e) =>
                                                setData(
                                                    "capaian",
                                                    e.target.value,
                                                )
                                            }
                                            disabled={isFormClosed}
                                            placeholder="Your goals and expectations..."
                                            required
                                        />
                                        {errors.capaian && (
                                            <p className="text-red-500 text-xs mt-1">
                                                {errors.capaian}
                                            </p>
                                        )}
                                    </div>

                                    {/* --- ADDITIONAL QUESTIONS --- */}
                                    <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        {/* Organisasi Sebelumnya */}
                                        <div>
                                            <label className={labelClass}>
                                                Have you ever been part of
                                                organization before?{" "}
                                                <span className="text-red-400">
                                                    *
                                                </span>
                                            </label>
                                            <div className="flex gap-4 mt-3">
                                                <label className="inline-flex items-center">
                                                    <input
                                                        type="radio"
                                                        name="org_sebelum"
                                                        value="1"
                                                        checked={
                                                            data.org_sebelum ===
                                                            "1"
                                                        }
                                                        onChange={(e) =>
                                                            setData(
                                                                "org_sebelum",
                                                                e.target.value,
                                                            )
                                                        }
                                                        disabled={isFormClosed}
                                                        className="text-[#D4DB95] focus:ring-[#D4DB95] w-5 h-5"
                                                        required
                                                    />
                                                    <span className="ml-2 text-sm text-gray-700 font-medium">
                                                        Yes
                                                    </span>
                                                </label>
                                                <label className="inline-flex items-center">
                                                    <input
                                                        type="radio"
                                                        name="org_sebelum"
                                                        value="0"
                                                        checked={
                                                            data.org_sebelum ===
                                                            "0"
                                                        }
                                                        onChange={(e) =>
                                                            setData(
                                                                "org_sebelum",
                                                                e.target.value,
                                                            )
                                                        }
                                                        disabled={isFormClosed}
                                                        className="text-[#D4DB95] focus:ring-[#D4DB95] w-5 h-5"
                                                    />
                                                    <span className="ml-2 text-sm text-gray-700 font-medium">
                                                        No
                                                    </span>
                                                </label>
                                            </div>
                                            {errors.org_sebelum && (
                                                <p className="text-red-500 text-xs mt-1">
                                                    {errors.org_sebelum}
                                                </p>
                                            )}
                                        </div>

                                        {/* Komitmen */}
                                        <div>
                                            <label className={labelClass}>
                                                Are you willing to commit to the
                                                responsibilities of being an
                                                active member?{" "}
                                                <span className="text-red-400">
                                                    *
                                                </span>
                                            </label>
                                            <div className="flex gap-4 mt-3">
                                                <label className="inline-flex items-center">
                                                    <input
                                                        type="radio"
                                                        name="komitmen_tanggungjawab"
                                                        value="1"
                                                        checked={
                                                            data.komitmen_tanggungjawab ===
                                                            "1"
                                                        }
                                                        onChange={(e) =>
                                                            setData(
                                                                "komitmen_tanggungjawab",
                                                                e.target.value,
                                                            )
                                                        }
                                                        disabled={isFormClosed}
                                                        className="text-[#D4DB95] focus:ring-[#D4DB95] w-5 h-5"
                                                        required
                                                    />
                                                    <span className="ml-2 text-sm text-gray-700 font-medium">
                                                        Yes
                                                    </span>
                                                </label>
                                                <label className="inline-flex items-center">
                                                    <input
                                                        type="radio"
                                                        name="komitmen_tanggungjawab"
                                                        value="0"
                                                        checked={
                                                            data.komitmen_tanggungjawab ===
                                                            "0"
                                                        }
                                                        onChange={(e) =>
                                                            setData(
                                                                "komitmen_tanggungjawab",
                                                                e.target.value,
                                                            )
                                                        }
                                                        disabled={isFormClosed}
                                                        className="text-[#D4DB95] focus:ring-[#D4DB95] w-5 h-5"
                                                    />
                                                    <span className="ml-2 text-sm text-gray-700 font-medium">
                                                        No
                                                    </span>
                                                </label>
                                            </div>
                                            {errors.komitmen_tanggungjawab && (
                                                <p className="text-red-500 text-xs mt-1">
                                                    {
                                                        errors.komitmen_tanggungjawab
                                                    }
                                                </p>
                                            )}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {/* --- PROOF UPLOAD --- */}
                            <div>
                                <h3 className={sectionTitleClass}>
                                    Proof of Requirements
                                </h3>
                                <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    {[
                                        {
                                            id: "file_tiktok",
                                            label: "Tiktok Follow Proof",
                                            path: applicant?.path_tiktok,
                                        },
                                        {
                                            id: "file_instagram",
                                            label: "Instagram Follow Proof",
                                            path: applicant?.path_instagram,
                                        },
                                        {
                                            id: "file_pamflet",
                                            label: "Pamphlet Share Proof",
                                            path: applicant?.path_pamflet,
                                        },
                                        {
                                            id: "file_twibbon",
                                            label: "Twibbon Upload Proof",
                                            path: applicant?.path_twibbon,
                                        },
                                    ].map((field) => (
                                        <div key={field.id}>
                                            <label className={labelClass}>
                                                {field.label}{" "}
                                                <span className="text-red-400">
                                                    *
                                                </span>
                                            </label>
                                            {!isFormClosed ? (
                                                <div className="mt-1">
                                                    <input
                                                        type="file"
                                                        className="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-gray-100 file:text-gray-700 hover:file:bg-[#D4DB95] hover:file:text-white transition-all cursor-pointer border border-gray-300 rounded-lg"
                                                        onChange={(e) =>
                                                            setData(
                                                                field.id,
                                                                e.target
                                                                    .files[0],
                                                            )
                                                        }
                                                        accept="image/*"
                                                        required
                                                    />
                                                    <p className="text-[10px] text-gray-400 mt-1">
                                                        Max: 5MB
                                                    </p>
                                                </div>
                                            ) : isSubmitted ? (
                                                <div className="mt-1 p-3 bg-gray-50 border border-gray-200 rounded-lg flex items-center justify-between">
                                                    <span className="text-sm text-gray-600 font-medium">
                                                        Uploaded
                                                    </span>
                                                    <a
                                                        href={`/storage/${field.path}`}
                                                        target="_blank"
                                                        rel="noopener noreferrer"
                                                        className="text-xs font-bold text-[#b8bf76] hover:underline"
                                                    >
                                                        View Image
                                                    </a>
                                                </div>
                                            ) : (
                                                <div className="text-sm text-red-400 italic">
                                                    Closed
                                                </div>
                                            )}
                                            {errors[field.id] && (
                                                <p className="text-red-500 text-xs mt-1">
                                                    {errors[field.id]}
                                                </p>
                                            )}
                                        </div>
                                    ))}
                                </div>
                                <p className="mt-10 text-gray-600 text-sm">
                                    * By submitting this form, you confirm that
                                    all information is accurate. You’ll be taken
                                    to the task submission form next.
                                </p>
                                <a
                                    href=""
                                    target="_blank"
                                    className="mt-6 text-blue-800 font-bold"
                                >
                                    [ View Submission ]
                                </a>
                            </div>

                            {/* --- SUBMIT BUTTON --- */}
                            {!isFormClosed && (
                                <div className=" flex justify-end">
                                    <button
                                        type="submit"
                                        disabled={processing}
                                        className="w-full sm:w-auto px-6 py-4 bg-[#D4DB95] text-white font-bold rounded-lg shadow-lg shadow-[#D4DB95]/30 hover:bg-[#c0c785] hover:shadow-xl hover:-translate-y-0.5 transition-all duration-200 disabled:opacity-70 disabled:cursor-not-allowed disabled:transform-none uppercase tracking-wide text-sm"
                                    >
                                        {processing
                                            ? "Sending Registration..."
                                            : "Submit Application"}
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
