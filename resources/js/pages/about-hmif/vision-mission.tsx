import Layout from '@/components/layout';
import { Head } from '@inertiajs/react';
import { motion } from 'framer-motion';
import { Target, Eye, Lightbulb, Users, Trophy, Rocket, CheckCircle } from 'lucide-react';

export default function VisionMission() {
    const values = [
        {
            icon: <Trophy className="w-8 h-8" />,
            title: "Excelencia",
            description: "Senantiasa mengutamakan keunggulan dalam setiap aspek kegiatan dan pencapaian prestasi terbaik."
        },
        {
            icon: <Users className="w-8 h-8" />,
            title: "Kolaborasi",
            description: "Membangun kerjasama yang solid antar mahasiswa untuk mencapai tujuan bersama."
        },
        {
            icon: <Lightbulb className="w-8 h-8" />,
            title: "Inovasi",
            description: "Mendorong kreativitas dan pemikiran out-of-the-box dalam menghadapi tantangan teknologi."
        },
        {
            icon: <Rocket className="w-8 h-8" />,
            title: "Progresif",
            description: "Terus bergerak maju mengikuti perkembangan teknologi dan kebutuhan industri."
        }
    ];

    const missions = [
        "Menyelenggarakan kegiatan akademik dan non-akademik yang mendukung pengembangan kompetensi mahasiswa Informatika",
        "Memfasilitasi wadah diskusi, sharing knowledge, dan networking antar mahasiswa, alumni, dan industri",
        "Mengembangkan soft skills dan hard skills mahasiswa melalui pelatihan, workshop, dan kompetisi",
        "Menjalin kerjasama dengan berbagai pihak untuk membuka peluang magang, kerja, dan pengembangan karir",
        "Menjadi jembatan komunikasi antara mahasiswa dengan pihak program studi dan universitas",
        "Menciptakan environment yang kondusif untuk pembelajaran dan pengembangan diri mahasiswa"
    ];

    const achievements = [
        { year: "2023", title: "Juara 1 Kompetisi Programming Tingkat Regional", category: "Prestasi Akademik" },
        { year: "2023", title: "Best Innovation Award - Hackathon Nasional", category: "Inovasi Teknologi" },
        { year: "2022", title: "Outstanding Student Organization Award", category: "Organisasi Terbaik" },
        { year: "2022", title: "Top 3 IT Festival Competition", category: "Kompetisi Teknologi" }
    ];

    return (
        <Layout>
            <Head title="Visi & Misi HMIF Unsoed" />

            {/* Hero Section */}
            <section className="section-padding-x relative scroll-mt-12 bg-light-base pt-32 pb-16 text-dark-base dark:bg-dark-base dark:text-light-base">
                <div className="absolute inset-0">
                    <div className="absolute top-0 left-0 -z-10 h-96 w-96 rounded-full bg-blue-400 opacity-20 blur-3xl"></div>
                    <div className="absolute bottom-0 right-0 -z-10 h-96 w-96 rounded-full bg-purple-400 opacity-20 blur-3xl"></div>
                </div>
                <div className="relative mx-auto max-w-screen-xl">
                    <motion.div
                        initial={{ opacity: 0, y: 30 }}
                        animate={{ opacity: 1, y: 0 }}
                        transition={{ duration: 0.8 }}
                        className="text-center"
                    >
                        <div className="mb-6 flex justify-center">
                            <span className="flex items-center gap-2 rounded-full bg-gradient-to-br from-blue-imphnen-base to-blue-imphnen-secondary px-4 py-2 text-white">
                                <Target className="w-5 h-5" />
                                <span className="text-sm font-medium">Visi & Misi HMIF Unsoed</span>
                            </span>
                        </div>
                        <h1 className="mb-4 font-bold">Menuju Informatika Unggul dan Berprestasi</h1>
                        <p className="mx-auto max-w-3xl text-gray-600 dark:text-gray-300">
                            Mengenal lebih dalam tentang visi, misi, dan nilai-nilai yang menjadi landasan HMIF Unsoed 
                            dalam mengembangkan potensi mahasiswa Informatika menuju masa depan yang gemilang.
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
                        className="text-center mb-12"
                    >
                        <div className="flex justify-center mb-4">
                            <div className="p-3 rounded-full bg-gradient-to-br from-blue-imphnen-base to-blue-imphnen-secondary">
                                <Eye className="w-8 h-8 text-white" />
                            </div>
                        </div>
                        <h2 className="mb-6 font-bold text-dark-base dark:text-light-base">Visi HMIF Unsoed</h2>
                        <div className="mx-auto max-w-4xl">
                            <blockquote className="text-xl md:text-2xl font-semibold text-gray-700 dark:text-gray-300 italic leading-relaxed">
                                "Menjadi himpunan mahasiswa yang unggul, inovatif, dan berperan aktif dalam mengembangkan 
                                teknologi informasi untuk kemajuan bangsa dan negara."
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
                        className="text-center mb-12"
                    >
                        <div className="flex justify-center mb-4">
                            <div className="p-3 rounded-full bg-gradient-to-br from-blue-imphnen-base to-blue-imphnen-secondary">
                                <Target className="w-8 h-8 text-white" />
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
                                className="flex gap-4 p-6 bg-white rounded-lg shadow-sm border border-gray-200 dark:bg-gray-800 dark:border-gray-700"
                            >
                                <div className="flex-shrink-0">
                                    <div className="flex h-8 w-8 items-center justify-center rounded-full bg-blue-imphnen-base/10">
                                        <CheckCircle className="h-5 w-5 text-blue-imphnen-base" />
                                    </div>
                                </div>
                                <div>
                                    <p className="text-gray-700 dark:text-gray-300 leading-relaxed">
                                        {mission}
                                    </p>
                                </div>
                            </motion.div>
                        ))}
                    </div>
                </div>
            </section>

            {/* Values Section */}
            {/* <section className="section-padding-x bg-light-base py-16 text-dark-base dark:bg-dark-base dark:text-light-base">
                <div className="mx-auto max-w-screen-xl">
                    <motion.div
                        initial={{ opacity: 0, y: 30 }}
                        whileInView={{ opacity: 1, y: 0 }}
                        viewport={{ once: true }}
                        transition={{ duration: 0.8 }}
                        className="text-center mb-12"
                    >
                        <h2 className="mb-4 font-bold text-dark-base dark:text-light-base">Nilai-Nilai Kami</h2>
                        <p className="mx-auto max-w-2xl text-gray-600 dark:text-gray-400">
                            Prinsip-prinsip fundamental yang menjadi pedoman dalam setiap aktivitas dan pencapaian HMIF Unsoed
                        </p>
                    </motion.div>

                    <div className="grid gap-8 md:grid-cols-2 lg:grid-cols-4">
                        {values.map((value, index) => (
                            <motion.div
                                key={index}
                                initial={{ opacity: 0, y: 30 }}
                                whileInView={{ opacity: 1, y: 0 }}
                                viewport={{ once: true }}
                                transition={{ duration: 0.6, delay: index * 0.1 }}
                                className="text-center group"
                            >
                                <div className="flex justify-center mb-4">
                                    <div className="p-4 rounded-full bg-gradient-to-br from-blue-imphnen-base to-blue-imphnen-secondary text-white transition-transform duration-300 group-hover:scale-110">
                                        {value.icon}
                                    </div>
                                </div>
                                <h3 className="mb-3 font-semibold text-lg text-dark-base dark:text-light-base">
                                    {value.title}
                                </h3>
                                <p className="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">
                                    {value.description}
                                </p>
                            </motion.div>
                        ))}
                    </div>
                </div>
            </section> */}

            {/* Achievements Section */}
            {/* <section className="section-padding-x bg-gray-50 py-16 text-dark-base dark:bg-gray-900 dark:text-light-base">
                <div className="mx-auto max-w-screen-xl">
                    <motion.div
                        initial={{ opacity: 0, y: 30 }}
                        whileInView={{ opacity: 1, y: 0 }}
                        viewport={{ once: true }}
                        transition={{ duration: 0.8 }}
                        className="text-center mb-12"
                    >
                        <h2 className="mb-4 font-bold text-dark-base dark:text-light-base">Prestasi & Pencapaian</h2>
                        <p className="mx-auto max-w-2xl text-gray-600 dark:text-gray-400">
                            Beberapa prestasi membanggakan yang telah diraih oleh anggota HMIF Unsoed
                        </p>
                    </motion.div>

                    <div className="grid gap-6 md:grid-cols-2">
                        {achievements.map((achievement, index) => (
                            <motion.div
                                key={index}
                                initial={{ opacity: 0, scale: 0.9 }}
                                whileInView={{ opacity: 1, scale: 1 }}
                                viewport={{ once: true }}
                                transition={{ duration: 0.6, delay: index * 0.1 }}
                                className="p-6 bg-white rounded-lg shadow-sm border border-gray-200 dark:bg-gray-800 dark:border-gray-700 hover:shadow-md transition-shadow duration-300"
                            >
                                <div className="flex items-start gap-4">
                                    <div className="flex-shrink-0">
                                        <div className="flex h-12 w-12 items-center justify-center rounded-full bg-gradient-to-br from-blue-imphnen-base to-blue-imphnen-secondary">
                                            <Trophy className="h-6 w-6 text-white" />
                                        </div>
                                    </div>
                                    <div className="flex-1">
                                        <div className="mb-2 flex items-center gap-2">
                                            <span className="rounded-full bg-blue-imphnen-base/10 px-2 py-1 text-xs font-medium text-blue-imphnen-base">
                                                {achievement.year}
                                            </span>
                                            <span className="rounded-full bg-gray-100 px-2 py-1 text-xs text-gray-600 dark:bg-gray-700 dark:text-gray-300">
                                                {achievement.category}
                                            </span>
                                        </div>
                                        <h3 className="font-semibold text-dark-base dark:text-light-base">
                                            {achievement.title}
                                        </h3>
                                    </div>
                                </div>
                            </motion.div>
                        ))}
                    </div>
                </div>
            </section> */}

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
                            Mari berkontribusi dalam mewujudkan visi dan misi HMIF Unsoed. 
                            Bersama-sama kita bangun masa depan teknologi informasi yang lebih baik.
                        </p>
                        <div className="flex flex-col gap-4 sm:flex-row sm:justify-center">
                            <a
                                href="https://instagram.com/hmifunsoed"
                                target="_blank"
                                className="rounded-lg bg-white px-6 py-3 font-semibold text-blue-imphnen-base transition-transform duration-300 hover:scale-105"
                            >
                                Follow Instagram Kami
                            </a>
                            <a
                                href="https://discord.gg/W4XyRAmPSD"
                                target="_blank"
                                className="rounded-lg border-2 border-white px-6 py-3 font-semibold text-white transition-all duration-300 hover:bg-white hover:text-blue-imphnen-base"
                            >
                                Join Discord Community
                            </a>
                        </div>
                    </motion.div>
                </div>
            </section>
        </Layout>
    );
}