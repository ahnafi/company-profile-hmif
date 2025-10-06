import { motion } from 'framer-motion';
import { Calendar, Trophy, Rocket, Cake } from 'lucide-react';

const majorEvents = [
    {
        icon: Calendar,
        title: 'Maskrab Makrab',
        description:
            'Kegiatan ini merupakan kegiatan tahunan yang bertujuan untuk mengakrabkan angkatan, khususnya angkatan yang baru saja diterima dalam keluarga besar Informatika.',
        color: 'from-blue-500 to-cyan-600',
        bgColor: 'bg-blue-50 dark:bg-blue-900/20',
        borderColor: 'border-blue-200 dark:border-blue-800',
    },
    {
        icon: Trophy,
        title: 'Informatics Championship',
        description:
            'Kegiatan ini merupakan perlombaan olahraga yang diselenggarakan untuk seluruh angkatan dan dosen.',
        color: 'from-orange-500 to-amber-600',
        bgColor: 'bg-orange-50 dark:bg-orange-900/20',
        borderColor: 'border-orange-200 dark:border-orange-800',
    },
    {
        icon: Rocket,
        title: 'Soedirman Technophoria',
        description:
            'Soedirman Technoporia merupakan kegiatan bertaraf Nasional yang dibuat untuk seluruh masyarakat Indonesia, baik dalam bidang Informatika atau yang lainnya.',
        color: 'from-purple-500 to-pink-600',
        bgColor: 'bg-purple-50 dark:bg-purple-900/20',
        borderColor: 'border-purple-200 dark:border-purple-800',
    },
    {
        icon: Cake,
        title: 'Dies Natalis',
        description: 'Kegiatan yang dilaksanakan untuk memperingati hari ulang tahun Informatika setiap tahunnya.',
        color: 'from-green-500 to-emerald-600',
        bgColor: 'bg-green-50 dark:bg-green-900/20',
        borderColor: 'border-green-200 dark:border-green-800',
    },
];

export default function MajorEventsSection() {
    return (
        <section className="section-padding-x bg-white dark:bg-gray-900 py-16 text-dark-base dark:text-light-base">
            <div className="mx-auto max-w-screen-xl">
                {/* Header */}
                <motion.div
                    initial={{ opacity: 0, y: 30 }}
                    whileInView={{ opacity: 1, y: 0 }}
                    viewport={{ once: true }}
                    transition={{ duration: 0.8 }}
                    className="mb-12 text-center"
                >
                    <h2 className="mb-4 font-bold text-dark-base dark:text-light-base">Event Besar HMIF</h2>
                    <p className="mx-auto max-w-2xl text-gray-600 dark:text-gray-400">
                        Kegiatan-kegiatan besar yang rutin diselenggarakan oleh HMIF UNSOED untuk mengembangkan potensi
                        dan mempererat kebersamaan
                    </p>
                </motion.div>

                {/* Grid of Event Cards - 4 Columns */}
                <div className="grid gap-8 grid-cols-1 sm:grid-cols-2 lg:grid-cols-4">
                    {majorEvents.map((event, index) => {
                        const Icon = event.icon;
                        return (
                            <motion.div
                                key={index}
                                initial={{ opacity: 0, y: 30 }}
                                whileInView={{ opacity: 1, y: 0 }}
                                viewport={{ once: true }}
                                transition={{ duration: 0.6, delay: index * 0.1 }}
                                className="group"
                            >
                                <div className="relative h-full rounded-3xl bg-white dark:bg-gray-800 shadow-xl hover:shadow-2xl transition-all duration-500 overflow-hidden border-2 border-gray-100 dark:border-gray-700 group-hover:-translate-y-2">
                                    {/* Gradient Glow Effect */}
                                    <div className={`absolute -inset-0.5 bg-gradient-to-br ${event.color} opacity-0 group-hover:opacity-20 blur-xl transition-opacity duration-500`}></div>
                                    
                                    <div className="relative">
                                        {/* Image/Icon Container */}
                                        <div className="relative h-56 overflow-hidden">
                                            {/* Gradient Overlay */}
                                            <div className={`absolute inset-0 bg-gradient-to-br ${event.color} opacity-90 group-hover:opacity-80 transition-opacity duration-300`}></div>
                                            
                                            {/* Animated Background Pattern */}
                                            <div className="absolute inset-0 opacity-20">
                                                <div className="absolute inset-0 bg-gradient-to-tr from-transparent via-white to-transparent group-hover:translate-x-full transition-transform duration-1000"></div>
                                            </div>
                                            
                                            {/* Icon Container */}
                                            <div className="relative z-10 h-full flex items-center justify-center">
                                                <img
                                                    src={`/img/events/${event.title.toLowerCase().replace(/\s+/g, '-')}.jpg`}
                                                    alt={event.title}
                                                    className="absolute inset-0 h-full w-full object-cover opacity-30 group-hover:opacity-40 group-hover:scale-110 transition-all duration-500"
                                                    onError={(e) => {
                                                        e.currentTarget.style.display = 'none';
                                                    }}
                                                />
                                                
                                                {/* Icon with backdrop */}
                                                <div className="relative">
                                                    <div className="absolute inset-0 bg-white/20 rounded-2xl blur-2xl"></div>
                                                    <div className="relative rounded-2xl bg-white/10 backdrop-blur-md p-5 border border-white/20 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                                                        <Icon className="h-16 w-16 text-white drop-shadow-lg" strokeWidth={1.5} />
                                                    </div>
                                                </div>
                                            </div>

                                            {/* Decorative Corner */}
                                            <div className="absolute top-4 right-4">
                                                <div className="w-10 h-10 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center">
                                                    <span className="text-white font-bold text-sm">{index + 1}</span>
                                                </div>
                                            </div>
                                        </div>

                                        {/* Card Content */}
                                        <div className="p-6">
                                            {/* Title with Icon Badge */}
                                            <div className="mb-4">
                                                <h3 className="text-xl font-bold text-gray-900 dark:text-white mb-2 text-center group-hover:text-transparent group-hover:bg-clip-text group-hover:bg-gradient-to-r group-hover:from-blue-600 group-hover:to-purple-600 dark:group-hover:from-blue-400 dark:group-hover:to-purple-400 transition-all duration-300">
                                                    {event.title}
                                                </h3>
                                                <div className={`h-1 w-16 mx-auto bg-gradient-to-r ${event.color} rounded-full`}></div>
                                            </div>
                                            
                                            {/* Description */}
                                            <p className="text-gray-600 dark:text-gray-300 leading-relaxed text-sm text-center line-clamp-4">
                                                {event.description}
                                            </p>
                                        </div>

                                        {/* Bottom Gradient Bar */}
                                        {/* <div className="absolute bottom-0 left-0 right-0">
                                            <div className={`h-1.5 bg-gradient-to-r ${event.color}`}></div>
                                        </div> */}
                                    </div>
                                </div>
                            </motion.div>
                        );
                    })}
                </div>
            </div>
        </section>
    );
}
