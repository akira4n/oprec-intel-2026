import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import { Transition } from "@headlessui/react";
import { Link, useForm, usePage } from "@inertiajs/react";

export default function UpdateProfileInformation({
    mustVerifyEmail,
    status,
    className = "",
}) {
    const user = usePage().props.auth.user;

    const { data, setData, patch, errors, processing, recentlySuccessful } =
        useForm({
            name: user.name,
            email: user.email,
            nim: user.nim || "", // Tambahan Field NIM
            no_hp: user.no_hp || "", // Tambahan Field No HP
        });

    const submit = (e) => {
        e.preventDefault();
        patch(route("profile.update"));
    };

    // Style Helpers
    const inputClass =
        "w-full border-gray-200 bg-gray-50/50 rounded-lg px-4 py-3 text-sm focus:bg-white focus:border-[#D4DB95] focus:ring-[#D4DB95] transition-all";
    const labelClass =
        "block font-semibold text-xs text-gray-500 uppercase tracking-wider mb-2";
    const sectionTitleClass =
        "text-xl font-bold text-gray-800 border-l-4 border-[#D4DB95] pl-3 mb-6";

    return (
        <section className={className}>
            <header>
                <h2 className={sectionTitleClass}>Profile Information</h2>
                <p className="mt-1 text-sm text-gray-500 mb-6">
                    Update your account's profile information, student ID, and
                    contact details.
                </p>
            </header>

            <form onSubmit={submit} className="space-y-6">
                {/* Grid Layout untuk Nama & Email */}
                <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label htmlFor="name" className={labelClass}>
                            Full Name
                        </label>
                        <input
                            id="name"
                            className={inputClass}
                            value={data.name}
                            onChange={(e) => setData("name", e.target.value)}
                            required
                            autoComplete="name"
                        />
                        <InputError className="mt-2" message={errors.name} />
                    </div>

                    <div>
                        <label htmlFor="email" className={labelClass}>
                            Email Address
                        </label>
                        <input
                            id="email"
                            type="email"
                            className={inputClass}
                            value={data.email}
                            onChange={(e) => setData("email", e.target.value)}
                            required
                            autoComplete="username"
                        />
                        <InputError className="mt-2" message={errors.email} />
                    </div>
                </div>

                {/* Grid Layout untuk NIM & No HP (BARU) */}
                <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label htmlFor="nim" className={labelClass}>
                            NIM (Student ID)
                        </label>
                        <input
                            id="nim"
                            className={inputClass}
                            value={data.nim}
                            onChange={(e) => setData("nim", e.target.value)}
                            required
                            placeholder="e.g. 0902128..."
                        />
                        <InputError className="mt-2" message={errors.nim} />
                    </div>

                    <div>
                        <label htmlFor="no_hp" className={labelClass}>
                            Phone Number (WA)
                        </label>
                        <input
                            id="no_hp"
                            className={inputClass}
                            value={data.no_hp}
                            onChange={(e) => setData("no_hp", e.target.value)}
                            required
                            placeholder="e.g. 0812..."
                        />
                        <InputError className="mt-2" message={errors.no_hp} />
                    </div>
                </div>

                {mustVerifyEmail && user.email_verified_at === null && (
                    <div className="bg-yellow-50 border border-yellow-200 p-4 rounded-lg mt-4">
                        <p className="text-sm text-yellow-800">
                            Your email address is unverified.
                            <Link
                                href={route("verification.send")}
                                method="post"
                                as="button"
                                className="underline font-bold hover:text-yellow-900 ml-1"
                            >
                                Click here to re-send the verification email.
                            </Link>
                        </p>

                        {status === "verification-link-sent" && (
                            <div className="mt-2 text-sm font-medium text-green-600">
                                A new verification link has been sent to your
                                email address.
                            </div>
                        )}
                    </div>
                )}

                <div className="flex items-center gap-4 pt-4">
                    <button
                        type="submit"
                        disabled={processing}
                        className="px-6 py-3 bg-[#D4DB95] text-white font-bold rounded-lg shadow-md shadow-[#D4DB95]/30 hover:bg-[#c0c785] transition-all disabled:opacity-70 uppercase tracking-wide text-xs"
                    >
                        Save Changes
                    </button>

                    <Transition
                        show={recentlySuccessful}
                        enter="transition ease-in-out"
                        enterFrom="opacity-0"
                        leave="transition ease-in-out"
                        leaveTo="opacity-0"
                    >
                        <p className="text-sm text-gray-400 font-medium">
                            Saved.
                        </p>
                    </Transition>
                </div>
            </form>
        </section>
    );
}
