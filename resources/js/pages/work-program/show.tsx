import Layout from '@/components/layout';
import { Head, Link } from '@inertiajs/react';
import { motion } from 'framer-motion';
import { ArrowLeft, Calendar, ChevronLeft, ChevronRight, Image as ImageIcon, Mail, Phone, Users } from 'lucide-react';
import { useState } from 'react';

interface Administrator {
    id: number;
    name: string;
    position: string;
    email?: string;
    phone?: string;
}

interface Division {
    id: number;
    name: string;
    slug: string;
}

interface WorkProgramAdministrator {
    id: number;
    position: string;
    work_program_id: number;
    administrator_id: number;
    administrator: Administrator;
}

interface WorkProgram {
    id: number;
    name: string;
    description?: string;
    images?: string[];
    division_id: number;
    division: Division;
    work_program_administrators: WorkProgramAdministrator[];
    created_at: string;
    updated_at: string;
}

interface WorkPlanShowProps {
    workProgram: WorkProgram;
}

// Data dummy untuk development
const dummyWorkProgram: WorkProgram = {
    id: 1,
    name: 'HMIF Tech Talk Series 2024',
    description:
        'HMIF Tech Talk Series 2024 adalah program unggulan yang dirancang untuk memberikan wawasan mendalam tentang perkembangan teknologi terkini kepada mahasiswa Informatika. Program ini menghadirkan para praktisi industri, akademisi terkemuka, dan peneliti dari berbagai bidang teknologi untuk berbagi pengalaman dan pengetahuan mereka.\n\nMelalui serangkaian webinar, workshop hands-on, dan sesi diskusi interaktif, peserta akan mendapatkan pemahaman yang komprehensif tentang tren teknologi seperti Artificial Intelligence, Machine Learning, Cloud Computing, Blockchain, Cybersecurity, dan Internet of Things.\n\nProgram ini tidak hanya fokus pada aspek teknis, tetapi juga membahas aspek bisnis dan implementasi praktis di industri. Peserta akan mendapatkan kesempatan untuk networking dengan para profesional dan membuka peluang magang atau karir di masa depan.',
    images: [
        '/img/work-programs/tech-talk-1.jpg',
        '/img/work-programs/tech-talk-2.jpg',
        '/img/work-programs/tech-talk-3.jpg',
        '/img/work-programs/tech-talk-4.jpg',
    ],
    division_id: 1,
    division: { id: 1, name: 'Humas dan Kemitraan', slug: 'humas-kemitraan' },
    work_program_administrators: [
        {
            id: 1,
            position: 'Ketua Pelaksana',
            work_program_id: 1,
            administrator_id: 1,
            administrator: {
                id: 1,
                name: 'Ahmad Santoso',
                position: 'Koordinator Humas',
                email: 'ahmad.santoso@hmif.unsoed.ac.id',
                phone: '+62 812-3456-7890',
            },
        },
        {
            id: 2,
            position: 'Wakil Ketua Pelaksana',
            work_program_id: 1,
            administrator_id: 2,
            administrator: {
                id: 2,
                name: 'Siti Rahma Dewi',
                position: 'Staff Humas',
                email: 'siti.rahma@hmif.unsoed.ac.id',
                phone: '+62 813-4567-8901',
            },
        },
        {
            id: 3,
            position: 'Koordinator Acara',
            work_program_id: 1,
            administrator_id: 3,
            administrator: {
                id: 3,
                name: 'Budi Prasetyo',
                position: 'Staff Acara',
                email: 'budi.prasetyo@hmif.unsoed.ac.id',
            },
        },
        {
            id: 4,
            position: 'Koordinator Sponsorship',
            work_program_id: 1,
            administrator_id: 4,
            administrator: {
                id: 4,
                name: 'Maria Ulfah',
                position: 'Staff Sponsorship',
                email: 'maria.ulfah@hmif.unsoed.ac.id',
            },
        },
    ],
    created_at: '2024-01-15T10:30:00.000000Z',
    updated_at: '2024-01-15T10:30:00.000000Z',
};

export default function WorkPlanShow({ workProgram = dummyWorkProgram }: WorkPlanShowProps) {
    const [currentImageIndex, setCurrentImageIndex] = useState(0);
    const [showImageModal, setShowImageModal] = useState(false);

    const formatDate = (dateString: string) => {
        return new Date(dateString).toLocaleDateString('id-ID', {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
        });
    };

    const getInitials = (name: string) => {
        return name
            .split(' ')
            .map((word) => word.charAt(0))
            .join('')
            .substring(0, 2)
            .toUpperCase();
    };

    const nextImage = () => {
        if (workProgram.images && workProgram.images.length > 0) {
            setCurrentImageIndex((prev) => (prev === workProgram.images!.length - 1 ? 0 : prev + 1));
        }
    };

    const prevImage = () => {
        if (workProgram.images && workProgram.images.length > 0) {
            setCurrentImageIndex((prev) => (prev === 0 ? workProgram.images!.length - 1 : prev - 1));
        }
    };

    const openImageModal = (index: number) => {
        setCurrentImageIndex(index);
        setShowImageModal(true);
    };

    return (
        <Layout>
            <Head title={`${workProgram.name} - Program Kerja HMIF Unsoed`} />

            {/* Hero Section */}
            <section className="section-padding-x relative scroll-mt-12 bg-light-base pt-32 pb-16 text-dark-base dark:bg-dark-base dark:text-light-base">
                <div className="absolute inset-0">
                    <div className="absolute top-0 left-0 -z-10 h-96 w-96 rounded-full bg-blue-400 opacity-20 blur-3xl"></div>
                    <div className="absolute right-0 bottom-0 -z-10 h-96 w-96 rounded-full bg-purple-400 opacity-20 blur-3xl"></div>
                </div>
                <div className="relative mx-auto max-w-screen-xl">
                    <motion.div initial={{ opacity: 0, y: 30 }} animate={{ opacity: 1, y: 0 }} transition={{ duration: 0.8 }}>
                        {/* Breadcrumb */}
                        <div className="mb-6">
                            <Link
                                href="/work-plan"
                                className="inline-flex items-center gap-2 text-blue-imphnen-base transition-colors duration-300 hover:text-blue-imphnen-secondary"
                            >
                                <ArrowLeft className="h-4 w-4" />
                                <span className="text-sm font-medium">Kembali ke Program Kerja</span>
                            </Link>
                        </div>

                        {/* Title and Division */}
                        <div className="mb-6">
                            <span className="mb-4 inline-block rounded-full bg-gradient-to-br from-blue-imphnen-base to-blue-imphnen-secondary px-4 py-2 text-sm font-medium text-white">
                                {workProgram.division.name}
                            </span>
                            <h1 className="mb-4 font-bold">{workProgram.name}</h1>
                        </div>

                        {/* Meta Information */}
                        <div className="flex flex-wrap gap-6 text-sm text-gray-600 dark:text-gray-400">
                            <div className="flex items-center gap-2">
                                <Calendar className="h-4 w-4" />
                                <span>Dibuat: {formatDate(workProgram.created_at)}</span>
                            </div>
                            <div className="flex items-center gap-2">
                                <Users className="h-4 w-4" />
                                <span>{workProgram.work_program_administrators.length} Administrator</span>
                            </div>
                            {workProgram.images && workProgram.images.length > 0 && (
                                <div className="flex items-center gap-2">
                                    <ImageIcon className="h-4 w-4" />
                                    <span>{workProgram.images.length} Foto</span>
                                </div>
                            )}
                        </div>
                    </motion.div>
                </div>
            </section>

            {/* Content Section */}
            <section className="section-padding-x bg-light-base py-16 text-dark-base dark:bg-dark-base dark:text-light-base">
                <div className="mx-auto max-w-screen-xl">
                    <div className="grid gap-12 lg:grid-cols-3">
                        {/* Main Content */}
                        <div className="lg:col-span-2">
                            {/* Image Gallery */}
                            {workProgram.images && workProgram.images.length > 0 && (
                                <motion.div
                                    initial={{ opacity: 0, y: 30 }}
                                    whileInView={{ opacity: 1, y: 0 }}
                                    viewport={{ once: true }}
                                    transition={{ duration: 0.8 }}
                                    className="mb-8"
                                >
                                    <h2 className="mb-4 text-xl font-bold">Galeri Foto</h2>

                                    {/* Main Image */}
                                    <div className="relative mb-4 overflow-hidden rounded-lg">
                                        <img
                                            src={workProgram.images[currentImageIndex]}
                                            alt={`${workProgram.name} - Foto ${currentImageIndex + 1}`}
                                            className="h-96 w-full cursor-pointer object-cover"
                                            onClick={() => openImageModal(currentImageIndex)}
                                        />

                                        {workProgram.images.length > 1 && (
                                            <>
                                                <button
                                                    onClick={prevImage}
                                                    className="absolute top-1/2 left-4 -translate-y-1/2 rounded-full bg-black/50 p-2 text-white transition-colors duration-300 hover:bg-black/70"
                                                >
                                                    <ChevronLeft className="h-5 w-5" />
                                                </button>
                                                <button
                                                    onClick={nextImage}
                                                    className="absolute top-1/2 right-4 -translate-y-1/2 rounded-full bg-black/50 p-2 text-white transition-colors duration-300 hover:bg-black/70"
                                                >
                                                    <ChevronRight className="h-5 w-5" />
                                                </button>
                                            </>
                                        )}

                                        <div className="absolute right-4 bottom-4 rounded-full bg-black/50 px-3 py-1 text-sm text-white">
                                            {currentImageIndex + 1} / {workProgram.images.length}
                                        </div>
                                    </div>

                                    {/* Thumbnail Grid */}
                                    {workProgram.images.length > 1 && (
                                        <div className="grid grid-cols-4 gap-2 md:grid-cols-6 lg:grid-cols-8">
                                            {workProgram.images.map((image, index) => (
                                                <button
                                                    key={index}
                                                    onClick={() => setCurrentImageIndex(index)}
                                                    className={`relative aspect-square overflow-hidden rounded ${
                                                        currentImageIndex === index ? 'ring-2 ring-blue-imphnen-base' : 'hover:opacity-80'
                                                    }`}
                                                >
                                                    <img src={image} alt={`Thumbnail ${index + 1}`} className="h-full w-full object-cover" />
                                                </button>
                                            ))}
                                        </div>
                                    )}
                                </motion.div>
                            )}

                            {/* Description */}
                            <motion.div
                                initial={{ opacity: 0, y: 30 }}
                                whileInView={{ opacity: 1, y: 0 }}
                                viewport={{ once: true }}
                                transition={{ duration: 0.8 }}
                                className="mb-8"
                            >
                                <h2 className="mb-4 text-xl font-bold">Deskripsi Program</h2>
                                {workProgram.description ? (
                                    <div className="prose prose-gray dark:prose-invert max-w-none">
                                        {workProgram.description.split('\n').map(
                                            (paragraph, index) =>
                                                paragraph.trim() && (
                                                    <p key={index} className="mb-4 leading-relaxed text-gray-700 dark:text-gray-300">
                                                        {paragraph}
                                                    </p>
                                                ),
                                        )}
                                    </div>
                                ) : (
                                    <p className="text-gray-500 italic dark:text-gray-400">Deskripsi program belum tersedia.</p>
                                )}
                            </motion.div>
                        </div>

                        {/* Sidebar */}
                        <div className="lg:col-span-1">
                            {/* Program Info */}
                            <motion.div
                                initial={{ opacity: 0, x: 30 }}
                                whileInView={{ opacity: 1, x: 0 }}
                                viewport={{ once: true }}
                                transition={{ duration: 0.8 }}
                                className="mb-6 rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800"
                            >
                                <h3 className="mb-4 text-lg font-bold">Informasi Program</h3>
                                <div className="space-y-4">
                                    <div>
                                        <label className="text-sm font-medium text-gray-600 dark:text-gray-400">Divisi</label>
                                        <p className="text-dark-base dark:text-light-base">{workProgram.division.name}</p>
                                    </div>
                                    <div>
                                        <label className="text-sm font-medium text-gray-600 dark:text-gray-400">Dibuat</label>
                                        <p className="text-dark-base dark:text-light-base">{formatDate(workProgram.created_at)}</p>
                                    </div>
                                    <div>
                                        <label className="text-sm font-medium text-gray-600 dark:text-gray-400">Terakhir Diperbarui</label>
                                        <p className="text-dark-base dark:text-light-base">{formatDate(workProgram.updated_at)}</p>
                                    </div>
                                </div>
                            </motion.div>

                            {/* Administrators */}
                            <motion.div
                                initial={{ opacity: 0, x: 30 }}
                                whileInView={{ opacity: 1, x: 0 }}
                                viewport={{ once: true }}
                                transition={{ duration: 0.8, delay: 0.2 }}
                                className="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800"
                            >
                                <h3 className="mb-4 text-lg font-bold">Tim Administrator</h3>
                                <div className="space-y-4">
                                    {workProgram.work_program_administrators.map((admin, index) => (
                                        <motion.div
                                            key={admin.id}
                                            initial={{ opacity: 0, y: 20 }}
                                            whileInView={{ opacity: 1, y: 0 }}
                                            viewport={{ once: true }}
                                            transition={{ duration: 0.6, delay: index * 0.1 }}
                                            className="flex items-start gap-3 rounded-lg bg-gray-50 p-3 dark:bg-gray-700"
                                        >
                                            <div className="flex-shrink-0">
                                                <div className="flex h-12 w-12 items-center justify-center rounded-full bg-gradient-to-br from-blue-imphnen-base to-blue-imphnen-secondary font-semibold text-white">
                                                    {getInitials(admin.administrator.name)}
                                                </div>
                                            </div>
                                            <div className="min-w-0 flex-1">
                                                <h4 className="font-semibold text-dark-base dark:text-light-base">{admin.administrator.name}</h4>
                                                <p className="text-sm font-medium text-blue-imphnen-base">{admin.position}</p>
                                                <p className="text-xs text-gray-600 dark:text-gray-400">{admin.administrator.position}</p>

                                                {/* Contact Info */}
                                                <div className="mt-2 space-y-1">
                                                    {admin.administrator.email && (
                                                        <div className="flex items-center gap-1 text-xs text-gray-600 dark:text-gray-400">
                                                            <Mail className="h-3 w-3" />
                                                            <a
                                                                href={`mailto:${admin.administrator.email}`}
                                                                className="transition-colors duration-300 hover:text-blue-imphnen-base"
                                                            >
                                                                {admin.administrator.email}
                                                            </a>
                                                        </div>
                                                    )}
                                                    {admin.administrator.phone && (
                                                        <div className="flex items-center gap-1 text-xs text-gray-600 dark:text-gray-400">
                                                            <Phone className="h-3 w-3" />
                                                            <a
                                                                href={`tel:${admin.administrator.phone}`}
                                                                className="transition-colors duration-300 hover:text-blue-imphnen-base"
                                                            >
                                                                {admin.administrator.phone}
                                                            </a>
                                                        </div>
                                                    )}
                                                </div>
                                            </div>
                                        </motion.div>
                                    ))}
                                </div>
                            </motion.div>
                        </div>
                    </div>
                </div>
            </section>

            {/* Image Modal */}
            {showImageModal && workProgram.images && (
                <motion.div
                    initial={{ opacity: 0 }}
                    animate={{ opacity: 1 }}
                    exit={{ opacity: 0 }}
                    className="fixed inset-0 z-50 flex items-center justify-center bg-black/90 p-4"
                    onClick={() => setShowImageModal(false)}
                >
                    <div className="relative max-h-full max-w-4xl">
                        <img
                            src={workProgram.images[currentImageIndex]}
                            alt={`${workProgram.name} - Foto ${currentImageIndex + 1}`}
                            className="max-h-full max-w-full object-contain"
                            onClick={(e) => e.stopPropagation()}
                        />

                        {workProgram.images.length > 1 && (
                            <>
                                <button
                                    onClick={(e) => {
                                        e.stopPropagation();
                                        prevImage();
                                    }}
                                    className="absolute top-1/2 left-4 -translate-y-1/2 rounded-full bg-black/50 p-3 text-white transition-colors duration-300 hover:bg-black/70"
                                >
                                    <ChevronLeft className="h-6 w-6" />
                                </button>
                                <button
                                    onClick={(e) => {
                                        e.stopPropagation();
                                        nextImage();
                                    }}
                                    className="absolute top-1/2 right-4 -translate-y-1/2 rounded-full bg-black/50 p-3 text-white transition-colors duration-300 hover:bg-black/70"
                                >
                                    <ChevronRight className="h-6 w-6" />
                                </button>
                            </>
                        )}

                        <button
                            onClick={() => setShowImageModal(false)}
                            className="absolute top-4 right-4 rounded-full bg-black/50 p-2 text-white transition-colors duration-300 hover:bg-black/70"
                        >
                            ✕
                        </button>

                        <div className="absolute bottom-4 left-1/2 -translate-x-1/2 rounded-full bg-black/50 px-4 py-2 text-sm text-white">
                            {currentImageIndex + 1} / {workProgram.images.length}
                        </div>
                    </div>
                </motion.div>
            )}
        </Layout>
    );
}
