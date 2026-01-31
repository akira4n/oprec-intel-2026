import InputError from "@/Components/InputError";
import { Transition } from "@headlessui/react";
import { useForm } from "@inertiajs/react";
import { useRef } from "react";

export default function UpdatePasswordForm({ className = "" }) {
    const passwordInput = useRef();
    const currentPasswordInput = useRef();

    const {
        data,
        setData,
        errors,
        put,
        reset,
        processing,
        recentlySuccessful,
    } = useForm({
        current_password: "",
        password: "",
        password_confirmation: "",
    });

    const updatePassword = (e) => {
        e.preventDefault();

        put(route("password.update"), {
            preserveScroll: true,
            onSuccess: () => reset(),
            onError: (errors) => {
                if (errors.password) {
                    reset("password", "password_confirmation");
                    passwordInput.current.focus();
                }

                if (errors.current_password) {
                    reset("current_password");
                    currentPasswordInput.current.focus();
                }
            },
        });
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
                <h2 className={sectionTitleClass}>Update Password</h2>
                <p className="mt-1 text-sm text-gray-500 mb-6">
                    Ensure your account is using a long, random password to stay
                    secure.
                </p>
            </header>

            <form onSubmit={updatePassword} className="space-y-6">
                <div>
                    <label htmlFor="current_password" className={labelClass}>
                        Current Password
                    </label>
                    <input
                        id="current_password"
                        ref={currentPasswordInput}
                        value={data.current_password}
                        onChange={(e) =>
                            setData("current_password", e.target.value)
                        }
                        type="password"
                        className={inputClass}
                        autoComplete="current-password"
                    />
                    <InputError
                        message={errors.current_password}
                        className="mt-2"
                    />
                </div>

                <div>
                    <label htmlFor="password" className={labelClass}>
                        New Password
                    </label>
                    <input
                        id="password"
                        ref={passwordInput}
                        value={data.password}
                        onChange={(e) => setData("password", e.target.value)}
                        type="password"
                        className={inputClass}
                        autoComplete="new-password"
                    />
                    <InputError message={errors.password} className="mt-2" />
                </div>

                <div>
                    <label
                        htmlFor="password_confirmation"
                        className={labelClass}
                    >
                        Confirm Password
                    </label>
                    <input
                        id="password_confirmation"
                        value={data.password_confirmation}
                        onChange={(e) =>
                            setData("password_confirmation", e.target.value)
                        }
                        type="password"
                        className={inputClass}
                        autoComplete="new-password"
                    />
                    <InputError
                        message={errors.password_confirmation}
                        className="mt-2"
                    />
                </div>

                <div className="flex items-center gap-4 pt-4">
                    <button
                        type="submit"
                        disabled={processing}
                        className="px-6 py-3 bg-[#D4DB95] text-white font-bold rounded-lg shadow-md shadow-[#D4DB95]/30 hover:bg-[#c0c785] transition-all disabled:opacity-70 uppercase tracking-wide text-xs"
                    >
                        Update Password
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
