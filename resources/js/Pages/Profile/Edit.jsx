import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";
// import DeleteUserForm from "./Partials/DeleteUserForm";
import UpdatePasswordForm from "./Partials/UpdatePasswordForm";
import UpdateProfileInformationForm from "./Partials/UpdateProfileInformationForm";

export default function Edit({ mustVerifyEmail, status }) {
    return (
        <AuthenticatedLayout>
            <Head title="Profile" />

            <div className="pb-20">
                <div className="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">
                    {/* Header Title */}
                    <div className="text-center pt-10 pb-2">
                        <h2 className="text-3xl font-black text-gray-800 tracking-tight">
                            Account Settings
                        </h2>
                        <p className="text-gray-500 mt-2 text-sm">
                            Manage your profile information and security
                            settings.
                        </p>
                    </div>

                    {/* Profile Information Section */}
                    <div className="bg-white p-8 sm:p-10 shadow-xl shadow-gray-200/50 sm:rounded-2xl border border-gray-100">
                        <UpdateProfileInformationForm
                            mustVerifyEmail={mustVerifyEmail}
                            status={status}
                            className="max-w-2xl"
                        />
                    </div>

                    {/* Update Password Section */}
                    <div className="bg-white p-8 sm:p-10 shadow-xl shadow-gray-200/50 sm:rounded-2xl border border-gray-100">
                        <UpdatePasswordForm className="max-w-2xl" />
                    </div>

                    {/* <div className="bg-white p-8 sm:p-10 shadow-xl shadow-gray-200/50 sm:rounded-2xl border border-gray-100">
                        <DeleteUserForm className="max-w-2xl" />
                    </div> */}
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
