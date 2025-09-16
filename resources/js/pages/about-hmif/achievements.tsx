import { motion } from 'framer-motion';
import { Trophy } from 'lucide-react';

export default function AchievementsSection() {
    const achievements = [
        { year: '2023', title: 'Juara 1 Kompetisi Programming Tingkat Regional', category: 'Prestasi Akademik' },
        { year: '2023', title: 'Best Innovation Award - Hackathon Nasional', category: 'Inovasi Teknologi' },
        { year: '2022', title: 'Outstanding Student Organization Award', category: 'Organisasi Terbaik' },
        { year: '2022', title: 'Top 3 IT Festival Competition', category: 'Kompetisi Teknologi' },
    ];

    return (
        <section className="section-padding-x bg-gray-50 py-16 text-dark-base dark:bg-gray-900 dark:text-light-base">
            <div className="mx-auto max-w-screen-xl">
                <motion.div
                    initial={{ opacity: 0, y: 30 }}
                    whileInView={{ opacity: 1, y: 0 }}
                    viewport={{ once: true }}
                    transition={{ duration: 0.8 }}
                    className="mb-12 text-center"
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
                            className="rounded-lg border border-gray-200 bg-white p-6 shadow-sm transition-shadow duration-300 hover:shadow-md dark:border-gray-700 dark:bg-gray-800"
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
                                    <h3 className="font-semibold text-dark-base dark:text-light-base">{achievement.title}</h3>
                                </div>
                            </div>
                        </motion.div>
                    ))}
                </div>
            </div>
        </section>
    );
}
