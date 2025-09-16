import { motion } from 'framer-motion';
import { Lightbulb, Rocket, Trophy, Users } from 'lucide-react';

export default function ValuesSection() {
    const values = [
        {
            icon: <Trophy className="h-8 w-8" />,
            title: 'Excelencia',
            description: 'Senantiasa mengutamakan keunggulan dalam setiap aspek kegiatan dan pencapaian prestasi terbaik.',
        },
        {
            icon: <Users className="h-8 w-8" />,
            title: 'Kolaborasi',
            description: 'Membangun kerjasama yang solid antar mahasiswa untuk mencapai tujuan bersama.',
        },
        {
            icon: <Lightbulb className="h-8 w-8" />,
            title: 'Inovasi',
            description: 'Mendorong kreativitas dan pemikiran out-of-the-box dalam menghadapi tantangan teknologi.',
        },
        {
            icon: <Rocket className="h-8 w-8" />,
            title: 'Progresif',
            description: 'Terus bergerak maju mengikuti perkembangan teknologi dan kebutuhan industri.',
        },
    ];

    return (
        <section className="section-padding-x bg-light-base py-16 text-dark-base dark:bg-dark-base dark:text-light-base">
            <div className="mx-auto max-w-screen-xl">
                <motion.div
                    initial={{ opacity: 0, y: 30 }}
                    whileInView={{ opacity: 1, y: 0 }}
                    viewport={{ once: true }}
                    transition={{ duration: 0.8 }}
                    className="mb-12 text-center"
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
                            className="group text-center"
                        >
                            <div className="mb-4 flex justify-center">
                                <div className="rounded-full bg-gradient-to-br from-blue-imphnen-base to-blue-imphnen-secondary p-4 text-white transition-transform duration-300 group-hover:scale-110">
                                    {value.icon}
                                </div>
                            </div>
                            <h3 className="mb-3 text-lg font-semibold text-dark-base dark:text-light-base">{value.title}</h3>
                            <p className="text-sm leading-relaxed text-gray-600 dark:text-gray-400">{value.description}</p>
                        </motion.div>
                    ))}
                </div>
            </div>
        </section>
    );
}
