import { Head, useForm, usePage } from "@inertiajs/react";
import Snowfall from "react-snowfall";
import { useMemo } from "react";
import ResultCard from "./Partials/ResultCard";

// source gambar untuk bg starfall
const imageSource1 = "assets/particles/star_green.svg";
const imageSource2 = "assets/particles/star_pink.svg";

export default function Index({ result }) {
    // Props 'result' datang dari Controller
    const { errors } = usePage().props;

    // form
    const { data, setData, post, processing } = useForm({
        nim: "",
    });

    //  helper bitnang jatuh
    const snowfallImages = useMemo(() => {
        const img1 = document.createElement("img");
        img1.src = imageSource1;

        const img2 = document.createElement("img");
        img2.src = imageSource2;

        return [img1, img2];
    }, []);

    const submit = (e) => {
        e.preventDefault();
        post(route("pengumuman.check"), {
            preserveScroll: true,
        });
    };

    return (
        <div className="min-h-screen bg-[#fffad0] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 font-sans relative overflow-hidden">
            <Head title="Announcement" />

            {/* --- Component Starfall (React-Snowfall) --- */}
            <div className="absolute inset-0 w-full h-full pointer-events-none">
                <Snowfall
                    images={snowfallImages}
                    radius={[10, 30]}
                    snowflakeCount={30}
                    rotationSpeed={[-1.0, 1.0]}
                    speed={[0.5, 3.0]}
                />
            </div>

            <div className="w-full max-w-3xl space-y-8 transition-all duration-500 relative z-10">
                {!result && (
                    <div className="text-center mb-10 ">
                        <img
                            src="assets\images\logo.png"
                            alt=""
                            className="mx-auto mb-6 h-24 md:h-28 rounded-xl"
                        />
                        <h1 className="uppercase text-3xl md:text-5xl font-black text-[#d07270] tracking-tight mb-2">
                            Announcement
                        </h1>
                        <p className="text-lg md:text-xl font-medium text-[#b99ab2]">
                            Open Recruitment INTEL 2026
                        </p>
                    </div>
                )}

                {!result ? (
                    <div className="bg-white/80 backdrop-blur-md py-10 px-8 shadow-2xl rounded-xl border-2 border-[#fdd9bc]">
                        <form onSubmit={submit} className="space-y-6">
                            <div>
                                <label
                                    htmlFor="nim"
                                    className="block text-sm font-bold text-[#b99ab2] uppercase tracking-wider mb-2"
                                >
                                    INPUT YOUR NIM
                                </label>
                                <div className="mt-1">
                                    <input
                                        id="nim"
                                        name="nim"
                                        type="text"
                                        required
                                        placeholder="090xxxxx"
                                        value={data.nim}
                                        onChange={(e) =>
                                            setData("nim", e.target.value)
                                        }
                                        className="appearance-none block w-full px-4 py-4 border-2 border-[#c1beb9] rounded-lg shadow-sm placeholder-[#c1beb9] focus:outline-none focus:ring-2 focus:ring-[#fdd9bc] focus:border-[#d07270] text-lg text-gray-700 font-semibold transition-all"
                                    />
                                </div>
                                {errors.nim && (
                                    <div className="text-[#d07270] text-sm mt-2 mx-2 rounded-lg flex items-center">
                                        {errors.nim}
                                    </div>
                                )}
                            </div>

                            <div>
                                <button
                                    type="submit"
                                    disabled={processing}
                                    className="w-full flex justify-center py-4 px-4 border border-transparent rounded-lg shadow-lg text-lg font-black text-[#fffad0] bg-[#d07270] hover:bg-[#b99ab2] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#d07270] disabled:opacity-50 transition-all transform"
                                >
                                    {processing ? "CHECKING..." : "SUBMIT"}
                                </button>
                            </div>
                        </form>
                    </div>
                ) : (
                    <div className="flex justify-center">
                        <ResultCard data={result} />
                    </div>
                )}
            </div>
        </div>
    );
}
