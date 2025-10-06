import { motion } from 'framer-motion';

export default function CabinetSection() {

    const date = new Date().getFullYear();

    return (
        <section className="py-16 px-4 md:py-24 bg-gradient-to-br from-slate-50 to-blue-50 dark:from-gray-900 dark:to-slate-800">
            <div className="container mx-auto max-w-6xl">
                <motion.div
                    initial={{ opacity: 0, y: 20 }}
                    whileInView={{ opacity: 1, y: 0 }}
                    viewport={{ once: true }}
                    transition={{ duration: 0.6 }}
                    className="grid md:grid-cols-2 gap-8 md:gap-12 items-center"
                >
                    {/* Content Section */}
                    <div className="space-y-6">
                        <motion.div
                            initial={{ opacity: 0, x: -20 }}
                            whileInView={{ opacity: 1, x: 0 }}
                            viewport={{ once: true }}
                            transition={{ duration: 0.6, delay: 0.2 }}
                        >
                            <p className="text-sm font-semibold text-blue-600 dark:text-blue-400 uppercase tracking-wider mb-2">
                                HMIF UNSOED {date}
                            </p>
                            <h2 className="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-4">
                                KABINET ARDITASENA
                            </h2>
                        </motion.div>

                        <motion.p
                            initial={{ opacity: 0, x: -20 }}
                            whileInView={{ opacity: 1, x: 0 }}
                            viewport={{ once: true }}
                            transition={{ duration: 0.6, delay: 0.3 }}
                            className="text-lg text-gray-600 dark:text-gray-300 leading-relaxed"
                        >
                            <span className="font-bold text-gray-900 dark:text-white">ARDITASENA</span> berasal dari gabungan kata:
                        </motion.p>

                        <motion.div
                            initial={{ opacity: 0, x: -20 }}
                            whileInView={{ opacity: 1, x: 0 }}
                            viewport={{ once: true }}
                            transition={{ duration: 0.6, delay: 0.4 }}
                            className="space-y-4"
                        >
                            <div className="flex items-start gap-4 p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-blue-100 dark:border-blue-900 hover:shadow-md transition-shadow">
                                <div className="flex-shrink-0 w-12 h-12 bg-blue-600 dark:bg-blue-500 rounded-lg flex items-center justify-center">
                                    <span className="text-white font-bold text-xl">A</span>
                                </div>
                                <div>
                                    <h3 className="font-bold text-gray-900 dark:text-white text-lg">Arganta</h3>
                                    <p className="text-gray-600 dark:text-gray-300">Pemimpin</p>
                                </div>
                            </div>

                            <div className="flex items-start gap-4 p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-orange-100 dark:border-orange-900 hover:shadow-md transition-shadow">
                                <div className="flex-shrink-0 w-12 h-12 bg-orange-600 dark:bg-orange-500 rounded-lg flex items-center justify-center">
                                    <span className="text-white font-bold text-xl">P</span>
                                </div>
                                <div>
                                    <h3 className="font-bold text-gray-900 dark:text-white text-lg">Phandita</h3>
                                    <p className="text-gray-600 dark:text-gray-300">Berpendidikan tinggi</p>
                                </div>
                            </div>

                            <div className="flex items-start gap-4 p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-blue-100 dark:border-blue-900 hover:shadow-md transition-shadow">
                                <div className="flex-shrink-0 w-12 h-12 bg-blue-600 dark:bg-blue-500 rounded-lg flex items-center justify-center">
                                    <span className="text-white font-bold text-xl">N</span>
                                </div>
                                <div>
                                    <h3 className="font-bold text-gray-900 dark:text-white text-lg">Nawasena</h3>
                                    <p className="text-gray-600 dark:text-gray-300">Pembawa masa depan yang cerah</p>
                                </div>
                            </div>
                        </motion.div>
                    </div>

                    {/* Logo Section */}
                    <motion.div
                        initial={{ opacity: 0, scale: 0.9 }}
                        whileInView={{ opacity: 1, scale: 1 }}
                        viewport={{ once: true }}
                        transition={{ duration: 0.6, delay: 0.3 }}
                        className="flex justify-center items-center"
                    >
                        <div className="relative">
                            <div className="absolute inset-0 bg-gradient-to-br from-blue-400 to-orange-400 rounded-full blur-3xl opacity-20 animate-pulse"></div>
                            <img
                                src="/img/logos/kabinet.png"
                                alt="Logo Kabinet Arditasena"
                                className="relative w-full max-w-md h-auto drop-shadow-2xl hover:scale-105 transition-transform duration-300"
                            />
                        </div>
                    </motion.div>
                </motion.div>
            </div>
        </section>
    );
}
