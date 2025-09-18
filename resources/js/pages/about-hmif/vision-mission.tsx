import Layout from '@/components/layout';
import { Head } from '@inertiajs/react';
import { motion } from 'framer-motion';
import { CheckCircle, Eye, Target } from 'lucide-react';

export default function VisionMission() {
    const vision =
        'Visi HMIF Unsoed mengusahakan terwujudnya mahasiswa yang bertakwa kepada Tuhan Yang Maha Esa, berwawasan luas, cendekia bermoral, berintefritas, berpikir kritis, berpribadian baik, bertanggung jawab serta berkepedulian sosial untuk terciptanya kehidupan kampus yang ilmiah dan bermanfaat dalam satu kesatuan organisasi yang terstruktur.';

    const missions = [
        'Berperan aktif dalam mengembangkan dan memajukan HMIF Unsoed.',
        'Menghidupkan budaya ilmiah yang bertanggung jawab.',
        'Mempererat tali persaudaraan antar mahasiswa dalam satu wadah himpunan mahasiswa.',
        'Meningkatkan wacana akademik sebagai sarana bagi pengembangan dan perkembangan teknologi informasi.',
    ];

    return (
        <Layout>
            <Head title="Visi & Misi HMIF Unsoed" />

            {/* Hero Section */}
            <section className="section-padding-x relative scroll-mt-12 bg-light-base pt-32 pb-16 text-dark-base dark:bg-dark-base dark:text-light-base">
                <div className="absolute inset-0">
                    <div className="absolute top-0 left-0 -z-10 h-96 w-96 rounded-full bg-blue-400 opacity-20 blur-3xl"></div>
                    <div className="absolute right-0 bottom-0 -z-10 h-96 w-96 rounded-full bg-purple-400 opacity-20 blur-3xl"></div>
                </div>
                <div className="relative mx-auto max-w-screen-xl">
                    <motion.div initial={{ opacity: 0, y: 30 }} animate={{ opacity: 1, y: 0 }} transition={{ duration: 0.8 }} className="text-center">
                        <div className="mb-6 flex justify-center">
                            <span className="flex items-center gap-2 rounded-full bg-gradient-to-br from-blue-imphnen-base to-blue-imphnen-secondary px-4 py-2 text-white">
                                <Target className="h-5 w-5" />
                                <span className="text-sm font-medium">Visi & Misi HMIF Unsoed</span>
                            </span>
                        </div>
                        <h1 className="mb-4 font-bold">Menuju Informatika Unggul dan Berprestasi</h1>
                        <p className="mx-auto max-w-3xl text-gray-600 dark:text-gray-300">
                            Mengenal lebih dalam tentang visi, misi, dan nilai-nilai yang menjadi landasan HMIF Unsoed dalam mengembangkan potensi
                            mahasiswa Informatika menuju masa depan yang gemilang.
                        </p>
                    </motion.div>
                </div>
            </section>

            {/* Vision Section */}
            <section className="section-padding-x bg-light-base py-16 text-dark-base dark:bg-dark-base dark:text-light-base">
                <div className="mx-auto max-w-screen-xl">
                    <motion.div
                        initial={{ opacity: 0, y: 30 }}
                        whileInView={{ opacity: 1, y: 0 }}
                        viewport={{ once: true }}
                        transition={{ duration: 0.8 }}
                        className="mb-12 text-center"
                    >
                        <div className="mb-4 flex justify-center">
                            <div className="rounded-full bg-gradient-to-br from-blue-imphnen-base to-blue-imphnen-secondary p-3">
                                <Eye className="h-8 w-8 text-white" />
                            </div>
                        </div>
                        <h2 className="mb-6 font-bold text-dark-base dark:text-light-base">Visi HMIF Unsoed</h2>
                        <div className="mx-auto max-w-4xl">
                            <blockquote className="text-xl leading-relaxed font-semibold text-gray-700 italic md:text-2xl dark:text-gray-300">
                                "{vision}"
                            </blockquote>
                        </div>
                    </motion.div>
                </div>
            </section>

            {/* Mission Section */}
            <section className="section-padding-x bg-gray-50 py-16 text-dark-base dark:bg-gray-900 dark:text-light-base">
                <div className="mx-auto max-w-screen-xl">
                    <motion.div
                        initial={{ opacity: 0, y: 30 }}
                        whileInView={{ opacity: 1, y: 0 }}
                        viewport={{ once: true }}
                        transition={{ duration: 0.8 }}
                        className="mb-12 text-center"
                    >
                        <div className="mb-4 flex justify-center">
                            <div className="rounded-full bg-gradient-to-br from-blue-imphnen-base to-blue-imphnen-secondary p-3">
                                <Target className="h-8 w-8 text-white" />
                            </div>
                        </div>
                        <h2 className="mb-6 font-bold text-dark-base dark:text-light-base">Misi HMIF Unsoed</h2>
                        <p className="mx-auto max-w-2xl text-gray-600 dark:text-gray-400">
                            Langkah-langkah strategis yang kami lakukan untuk mewujudkan visi HMIF Unsoed
                        </p>
                    </motion.div>

                    <div className="grid gap-6 md:grid-cols-2">
                        {missions.map((mission, index) => (
                            <motion.div
                                key={index}
                                initial={{ opacity: 0, x: index % 2 === 0 ? -30 : 30 }}
                                whileInView={{ opacity: 1, x: 0 }}
                                viewport={{ once: true }}
                                transition={{ duration: 0.6, delay: index * 0.1 }}
                                className="flex gap-4 rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800"
                            >
                                <div className="flex-shrink-0">
                                    <div className="flex h-8 w-8 items-center justify-center rounded-full bg-blue-imphnen-base/10">
                                        <CheckCircle className="h-5 w-5 text-blue-imphnen-base" />
                                    </div>
                                </div>
                                <div>
                                    <p className="leading-relaxed text-gray-700 dark:text-gray-300">{mission}</p>
                                </div>
                            </motion.div>
                        ))}
                    </div>
                </div>
            </section>

            {/* Call to Action Section */}
            <section className="section-padding-x bg-gradient-to-r from-blue-imphnen-base to-blue-imphnen-secondary py-16 text-white">
                <div className="mx-auto max-w-screen-xl text-center">
                    <motion.div
                        initial={{ opacity: 0, y: 30 }}
                        whileInView={{ opacity: 1, y: 0 }}
                        viewport={{ once: true }}
                        transition={{ duration: 0.8 }}
                    >
                        <h2 className="mb-4 font-bold">Bergabunglah Bersama Kami</h2>
                        <p className="mx-auto mb-8 max-w-2xl">
                            Mari berkontribusi dalam mewujudkan visi dan misi HMIF Unsoed. Bersama-sama kita bangun masa depan teknologi informasi
                            yang lebih baik.
                        </p>
                        <div className="flex flex-col gap-4 sm:flex-row sm:justify-center">
                            <a
                                href="https://instagram.com/hmifunsoed"
                                target="_blank"
                                className="rounded-lg bg-white px-6 py-3 font-semibold text-blue-imphnen-base transition-transform duration-300 hover:scale-105"
                            >
                                Follow Instagram Kami
                            </a>
                        </div>
                    </motion.div>
                </div>
            </section>
        </Layout>
    );
}
