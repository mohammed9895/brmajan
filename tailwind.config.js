import preset from './vendor/filament/support/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/**/*.php',
        './resources/views/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
    theme: {
        container: {
            center: true,
            padding: '1rem',
        },
        extend: {
            colors: {
                'primary': {
                    '50': '#f3f5fb',
                    '100': '#e3e9f6',
                    '200': '#cdd9f0',
                    '300': '#aac0e6',
                    '400': '#82a0d8',
                    '500': '#6481cd',
                    '600': '#5167bf',
                    '700': '#4150a2',
                    '800': '#3e488f',
                    '900': '#363f72',
                    '950': '#242847',
                },
                'brand-sky': '#58c3e3',
                'brand-pink': '#e9446e',
                'brand-dark': '#2c2051',
                "brand-dark-level": {
                    50: "oklch(96.69% 0.009 292.95 / <alpha-value>)",
                    100: "oklch(92.29% 0.022 294.64 / <alpha-value>)",
                    200: "oklch(84.77% 0.044 294.06 / <alpha-value>)",
                    300: "oklch(78.02% 0.065 293.82 / <alpha-value>)",
                    400: "oklch(70.51% 0.089 292.25 / <alpha-value>)",
                    500: "oklch(63.05% 0.112 292.08 / <alpha-value>)",
                    600: "oklch(55.44% 0.132 291.56 / <alpha-value>)",
                    700: "oklch(47.77% 0.144 291.4 / <alpha-value>)",
                    800: "oklch(40.89% 0.122 290.92 / <alpha-value>)",
                    900: "oklch(32.8% 0.1 291.65 / <alpha-value>)",
                    950: "oklch(28.66% 0.086 291.3 / <alpha-value>)"
                },
                "brand-pink-level": {
                    50: "oklch(95.85% 0.016 8.28 / <alpha-value>)",
                    100: "oklch(92.6% 0.029 7.19 / <alpha-value>)",
                    200: "oklch(85.19% 0.063 8.58 / <alpha-value>)",
                    300: "oklch(78.02% 0.102 8.82 / <alpha-value>)",
                    400: "oklch(70.76% 0.147 9.29 / <alpha-value>)",
                    500: "oklch(63.48% 0.202 10.13 / <alpha-value>)",
                    600: "oklch(54.01% 0.175 10.07 / <alpha-value>)",
                    700: "oklch(43.95% 0.142 10.06 / <alpha-value>)",
                    800: "oklch(34.3% 0.111 10.31 / <alpha-value>)",
                    900: "oklch(24.35% 0.079 10.46 / <alpha-value>)",
                    950: "oklch(18.37% 0.06 10.27 / <alpha-value>)"
                },
                "brand-sky-level": {
                    50: "oklch(96.41% 0.018 227.22 / <alpha-value>)",
                    100: "oklch(91.9% 0.043 224.92 / <alpha-value>)",
                    200: "oklch(84.67% 0.087 222.28 / <alpha-value>)",
                    300: "oklch(76.69% 0.108 220.53 / <alpha-value>)",
                    400: "oklch(67.45% 0.094 220.35 / <alpha-value>)",
                    500: "oklch(58.82% 0.083 220.52 / <alpha-value>)",
                    600: "oklch(49.51% 0.069 219.89 / <alpha-value>)",
                    700: "oklch(40.83% 0.058 221.1 / <alpha-value>)",
                    800: "oklch(31.6% 0.044 219.48 / <alpha-value>)",
                    900: "oklch(22.93% 0.032 223.82 / <alpha-value>)",
                    950: "oklch(17.54% 0.024 220.55 / <alpha-value>)"
                }
            },
        },
    },
}
