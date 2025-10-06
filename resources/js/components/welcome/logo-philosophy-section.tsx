import { motion } from 'framer-motion';
import { Crown, Flame, Feather, Palette } from 'lucide-react';

const philosophyItems = [
    {
        icon: Crown,
        image: '/img/logo-parts/singa.png', // Upload image 3 (singa lengkap dengan api)
        title: 'Singa Yang Mengaum',
        description:
            'Melambangkan kepemimpinan yang kuat, berani, dan visioner. Aumannya mencerminkan semangat perubahan, keberanian, dan tekad.',
        color: 'from-amber-500 to-orange-600',
    },
    {
        icon: Feather,
        image: '/img/logo-parts/bulu-orange.png', // Upload image 2 (bulu orange)
        title: 'Enam Helai Bulu',
        description:
            'Bulu yang mengalir melambangkan pertumbuhan dan inovasi yang berkelanjutan. Jumlah bulu melambangkan enam misi utama himpunan.',
        color: 'from-orange-500 to-amber-600',
    },
    {
        icon: Flame,
        image: '/img/logo-parts/api-biru.png', // Upload image 1 (api/bulu biru)
        title: 'Delapan Kobaran Api Biru',
        description:
            'Melambangkan energi yang tenang namun berpengaruh besar, jumlah kobaran melambangkan delapan divisi dalam kabinet.',
        color: 'from-blue-500 to-cyan-600',
    },
    {
        icon: Palette,
        image: '/img/logo-parts/warna.png', // Upload image 4 (palet warna)
        title: 'Kombinasi Warna',
        description:
            'Biru melambangkan stabilitas dan profesionalisme. Orange melambangkan semangat, tekad, dan gairah. Coklat melambangkan kehangatan, keteguhan, dan kestabilan.',
        color: 'from-slate-600 to-gray-700',
    },
];

export default function LogoPhilosophySection() {
    return (
        <section className="section-padding-x bg-gradient-to-br from-slate-50 to-blue-50 dark:from-gray-900 dark:to-slate-800 py-16 text-dark-base dark:text-light-base">
            <div className="mx-auto max-w-screen-xl">
                {/* Header */}
                <motion.div
                    initial={{ opacity: 0, y: 30 }}
                    whileInView={{ opacity: 1, y: 0 }}
                    viewport={{ once: true }}
                    transition={{ duration: 0.8 }}
                    className="mb-12 text-center"
                >
                    <h2 className="mb-4 font-bold text-dark-base dark:text-light-base">Filosofi Logo Kabinet</h2>
                    <p className="mx-auto max-w-2xl text-gray-600 dark:text-gray-400">
                        Setiap elemen logo ARDITASENA memiliki makna dan filosofi yang mendalam
                    </p>
                </motion.div>

                {/* Grid of Philosophy Items - Similar to Values Section */}
                <div className="grid gap-8 md:grid-cols-2 lg:grid-cols-4">
                    {philosophyItems.map((item, index) => {
                        const Icon = item.icon;
                        return (
                            <motion.div
                                key={index}
                                initial={{ opacity: 0, y: 30 }}
                                whileInView={{ opacity: 1, y: 0 }}
                                viewport={{ once: true }}
                                transition={{ duration: 0.6, delay: index * 0.1 }}
                                className="group text-center"
                            >
                                {/* Circular Image/Icon Container */}
                                <div className="mb-6 flex justify-center">
                                    <div className="relative">
                                        {/* Gradient Ring/Border */}
                                        <div className={`absolute inset-0 rounded-full bg-gradient-to-br ${item.color} opacity-20 group-hover:opacity-30 transition-opacity duration-300 blur-xl`}></div>
                                        
                                        {/* White/Dark Circle Background */}
                                        <div className="relative rounded-full bg-white dark:bg-gray-800 p-0 shadow-xl border-4 border-white dark:border-gray-700 transition-transform duration-300 group-hover:scale-110">
                                            <img
                                                src={item.image}
                                                alt={item.title}
                                                className="h-44 w-44 object-contain"
                                                onError={(e) => {
                                                    // Fallback to icon if image not found
                                                    e.currentTarget.style.display = 'none';
                                                    const iconElement = e.currentTarget.nextElementSibling as HTMLElement;
                                                    if (iconElement) {
                                                        iconElement.style.display = 'block';
                                                    }
                                                }}
                                            />
                                            <Icon className={`h-40 w-40 hidden text-gray-400 dark:text-gray-500`} strokeWidth={1.5} />
                                        </div>
                                    </div>
                                </div>

                                {/* Content */}
                                <h3 className="mb-3 text-lg font-semibold text-dark-base dark:text-light-base">
                                    {item.title}
                                </h3>
                                <p className="text-sm leading-relaxed text-gray-600 dark:text-gray-400">
                                    {item.description}
                                </p>
                            </motion.div>
                        );
                    })}
                </div>
            </div>
        </section>
    );
}
