import { Instagram, MapPin } from 'lucide-react';
import navigation from '../../data/navigation';

export default function Footer() {
    return (
        <footer id="footer" className="section-padding-x bg-light-base py-4 text-dark-base dark:bg-dark-base dark:text-light-base">
            <div className="mx-auto max-w-screen-xl">
                <div className="mb-4 flex flex-wrap justify-between gap-8 border-b border-gray-200 pb-8 dark:border-gray-700">
                    <div className="max-w-sm md:max-w-none lg:max-w-sm">
                        <a href="#" className="mb-4 block">
                            <img src="/img/logos/hmif.png" className="w-16" alt="Logo HMIF" />
                        </a>
                        <p className="mb-4 block text-gray-700 dark:text-gray-400">
                            HMIF Unsoed adalah himpunan mahasiswa yang mewadahi aspirasi mahasiswa program studi Teknik Informatika Universitas
                            Jenderal Soedirman.
                        </p>
                        <div className="flex gap-4">
                            <a href="https://www.linkedin.com/company/hmif-unsoed-himpunan-mahasiswa-informatika-unsoed" target="_blank">
                                <svg
                                    className="footer-social-media-link"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor"
                                    viewBox="0 0 448 512"
                                >
                                    <path d="M416 32H31.9C14.3 32 0 46.5 0 64.3v383.4C0 465.5 14.3 480 31.9 480H416c17.6 0 32-14.5 32-32.3V64.3c0-17.8-14.4-32.3-32-32.3zM135.4 416H69V202.2h66.5V416zm-33.2-243c-21.3 0-38.5-17.3-38.5-38.5S80.9 96 102.2 96c21.2 0 38.5 17.3 38.5 38.5 0 21.3-17.2 38.5-38.5 38.5zm282.1 243h-66.4V312c0-24.8-.5-56.7-34.5-56.7-34.6 0-39.9 27-39.9 54.9V416h-66.4V202.2h63.7v29.2h.9c8.9-16.8 30.6-34.5 62.9-34.5 67.2 0 79.7 44.3 79.7 101.9V416z" />
                                </svg>
                            </a>
                            <a href="https://www.youtube.com/@HMIFUnsoed" target="_blank">
                                <svg
                                    className="footer-social-media-link"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor"
                                    viewBox="0 0 576 512"
                                >
                                    <path d="M549.7 124.1c-6.3-23.7-24.8-42.3-48.3-48.6C458.8 64 288 64 288 64S117.2 64 74.6 75.5c-23.5 6.3-42 24.9-48.3 48.6-11.4 42.9-11.4 132.3-11.4 132.3s0 89.4 11.4 132.3c6.3 23.7 24.8 41.5 48.3 47.8C117.2 448 288 448 288 448s170.8 0 213.4-11.5c23.5-6.3 42-24.2 48.3-47.8 11.4-42.9 11.4-132.3 11.4-132.3s0-89.4-11.4-132.3zm-317.5 213.5V175.2l142.7 81.2-142.7 81.2z" />
                                </svg>
                            </a>
                            <a href="https://www.instagram.com/hmifunsoed/" target="_blank">
                                <svg
                                    className="footer-social-media-link"
                                    fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 448 512"
                                >
                                    <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" />
                                </svg>
                            </a>
                            <a href="https://www.tiktok.com/@hmifunsoed" target="_blank">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 448 512"
                                    className="footer-social-media-link"
                                    fill="currentColor"
                                >
                                    <path d="M448 209.9a210.1 210.1 0 0 1 -122.8-39.3V349.4A162.6 162.6 0 1 1 185 188.3V278.2a74.6 74.6 0 1 0 52.2 71.2V0l88 0a121.2 121.2 0 0 0 1.9 22.2h0A122.2 122.2 0 0 0 381 102.4a121.4 121.4 0 0 0 67 20.1z" />
                                </svg>
                            </a>
                        </div>
                        <div className="mt-6">
                            <h6 className="mb-3 text-sm font-semibold text-gray-700 dark:text-gray-400">Didukung oleh:</h6>
                            <div className="flex flex-wrap items-center gap-4">
                                <a href="https://www.dewaweb.com" target="_blank" rel="noopener noreferrer" className="opacity-70 hover:opacity-100 transition-opacity">
                                    <img
                                        src="data:image/webp;base64,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"
                                        alt="DewaWeb"
                                        className="h-8 w-auto grayscale hover:grayscale-0 transition-all"
                                        title="DewaWeb"
                                    />
                                </a>
                                {/* Tambahkan logo sponsor lainnya di sini */}
                                {/* Contoh: */}
                                {/* <a href="https://sponsor2.com" target="_blank" rel="noopener noreferrer" className="opacity-70 hover:opacity-100 transition-opacity">
                                    <img src="/img/sponsors/sponsor2.png" alt="Sponsor 2" className="h-8 w-auto grayscale hover:grayscale-0 transition-all" />
                                </a> */}
                            </div>
                        </div>
                    </div>
                    <div className="max-w-sm lg:max-w-sm">
                        <h5 className="mb-2 font-semibold">Tautan Cepat</h5>
                        <ul className="flex flex-col gap-1">
                            {navigation.map((route, index) => {
                                if (!route.path) return null;
                                return (
                                    <li key={index}>
                                        <a href={route.path} className="footer-link">
                                            {route.title}
                                        </a>
                                    </li>
                                );
                            })}
                        </ul>
                    </div>
                    <div className="max-w-sm md:col-span-2 md:max-w-none lg:max-w-sm">
                        <h5 className="mb-2 font-semibold">Kontak Kami</h5>
                        <div className="text-gray-700 dark:text-gray-400">
                            <div className="mb-2 grid grid-cols-[auto_1fr] items-center gap-2">
                                <Instagram className="w-4" />
                                <a href="https://www.instagram.com/hmifunsoed/" target="_blank">
                                    hmifunsoed
                                </a>
                            </div>
                            <div className="mb-2 grid grid-cols-[auto_1fr] items-center gap-2">
                                <MapPin className="w-4" />
                                <p>Jl. Raya Mayjen Sungkono No.KM.5, Dusun 2, Blater, Kec. Kalimanah, Kabupaten Purbalingga, Jawa Tengah 53371</p>
                            </div>
                            {/* <div className="mb-2 grid grid-cols-[auto_1fr] items-center gap-2">
                                <Phone className="w-4" />
                                <p>+62 812-3456-7890</p>
                            </div> */}
                        </div>
                    </div>
                </div>
                <p className="text-center text-xs text-gray-700 dark:text-gray-400">
                    © {new Date().getFullYear()} HMIF Unsoed - Informatika, Universitas Jenderal Soedirman. All rights reserved.
                </p>
            </div>
        </footer>
    );
}
