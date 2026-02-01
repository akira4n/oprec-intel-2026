export default function PrimaryButton({
    className = "",
    disabled,
    children,
    ...props
}) {
    return (
        <button
            {...props}
            className={
                `inline-flex items-center rounded-md border border-transparent bg-[#d06b72] hover:bg-[#b85a60] px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out  focus:outline-none focus:ring-2 focus:ring-[#d06b72] focus:ring-offset-2 active:bg-[#e04a54] ${
                    disabled && "opacity-25"
                } ` + className
            }
            disabled={disabled}
        >
            {children}
        </button>
    );
}
