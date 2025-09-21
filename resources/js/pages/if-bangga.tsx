import Layout from '@/components/layout';
import { Head, Link, router } from '@inertiajs/react';
import { motion } from 'framer-motion';
import { Award, Calendar, ChevronLeft, ChevronRight, Eye, Medal, Plus, Search, Trophy, Users } from 'lucide-react';
import { useEffect, useState } from 'react';
import { useDebouncedCallback } from 'use-debounce';

interface Student {
    id: number;
    name: string;
    student_id: string;
}

interface AchievementType {
    id: number;
    name: string;
}

interface AchievementCategory {
    id: number;
    name: string;
}

interface AchievementLevel {
    id: number;
    name: string;
}

interface Achievement {
    id: number;
    name: string;
    description?: string;
    image?: string;
    proof?: string;
    awarded_at: string;
    approval: boolean;
    achievement_type_id: number;
    achievement_category_id: number;
    achievement_level_id: number;
    achievement_type: AchievementType;
    achievement_category: AchievementCategory;
    achievement_level: AchievementLevel;
    students: Student[];
}

interface PaginationLink {
    url: string | null;
    label: string;
    active: boolean;
}

interface PaginatedAchievements {
    data: Achievement[];
    current_page: number;
    last_page: number;
    per_page: number;
    total: number;
    from: number;
    to: number;
    links: PaginationLink[];
}

interface IFBanggaProps {
    achievements: PaginatedAchievements;
    types: AchievementType[];
    categories: AchievementCategory[];
    levels: AchievementLevel[];
    years: number[];
    filters: {
        search?: string;
        type?: string;
        category?: string;
        level?: string;
        year?: string;
    };
}

export default function IFBanggaPage({ achievements, types, categories, levels, years, filters }: IFBanggaProps) {
    const [searchTerm, setSearchTerm] = useState(filters.search || '');
    const [selectedType, setSelectedType] = useState(filters.type || 'all');
    const [selectedCategory, setSelectedCategory] = useState(filters.category || 'all');
    const [selectedLevel, setSelectedLevel] = useState(filters.level || 'all');
    const [selectedYear, setSelectedYear] = useState(filters.year || 'all');

    // Debounced search
    const debouncedSearch = useDebouncedCallback(() => {
        handleFilter();
    }, 500);

    useEffect(() => {
        debouncedSearch();
    }, [searchTerm]);

    const handleFilter = () => {
        router.get(
            '/if-bangga',
            {
                search: searchTerm || undefined,
                type: selectedType === 'all' ? undefined : selectedType,
                category: selectedCategory === 'all' ? undefined : selectedCategory,
                level: selectedLevel === 'all' ? undefined : selectedLevel,
                year: selectedYear === 'all' ? undefined : selectedYear,
            },
            {
                preserveState: true,
                replace: true,
            },
        );
    };

    const stats = [
        {
            icon: <Trophy className="h-6 w-6" />,
            label: 'Total Prestasi',
            value: achievements.total.toString(),
        },
        {
            icon: <Award className="h-6 w-6" />,
            label: 'Kategori',
            value: categories.length.toString(),
        },
        {
            icon: <Medal className="h-6 w-6" />,
            label: 'Tingkat',
            value: levels.length.toString(),
        },
    ];

    const formatDate = (dateString: string) => {
        return new Date(dateString).toLocaleDateString('id-ID', {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
        });
    };

    const getLevelColor = (levelName: string) => {
        const name = levelName.toLowerCase();
        if (name.includes('internasional')) return 'bg-purple-500';
        if (name.includes('nasional')) return 'bg-red-500';
        if (name.includes('regional') || name.includes('provinsi')) return 'bg-blue-500';
        if (name.includes('lokal') || name.includes('universitas')) return 'bg-green-500';
        return 'bg-gray-500';
    };

    // Pagination component
    const Pagination = () => {
        if (achievements.last_page <= 1) return null;

        return (
            <div className="flex items-center justify-between rounded-lg border-t border-gray-200 bg-white px-4 py-3 sm:px-6 dark:border-gray-700 dark:bg-gray-800">
                <div className="flex flex-1 justify-between sm:hidden">
                    {achievements.links[0]?.url && (
                        <Link
                            href={achievements.links[0].url}
                            className="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                        >
                            Previous
                        </Link>
                    )}
                    {achievements.links[achievements.links.length - 1]?.url && (
                        <Link
                            href={achievements.links[achievements.links.length - 1].url}
                            className="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                        >
                            Next
                        </Link>
                    )}
                </div>
                <div className="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                    <div>
                        <p className="text-sm text-gray-700 dark:text-gray-300">
                            Showing <span className="font-medium">{achievements.from}</span> to <span className="font-medium">{achievements.to}</span>{' '}
                            of <span className="font-medium">{achievements.total}</span> results
                        </p>
                    </div>
                    <div>
                        <nav className="isolate inline-flex -space-x-px rounded-md shadow-sm">
                            {achievements.links.map((link, index) => {
                                if (index === 0 || index === achievements.links.length - 1) {
                                    if (!link.url) return null;

                                    return (
                                        <Link
                                            key={index}
                                            href={link.url}
                                            className={`relative inline-flex items-center px-2 py-2 text-sm font-medium ${
                                                index === 0 ? 'rounded-l-md' : 'rounded-r-md'
                                            } border border-gray-300 bg-white text-gray-500 hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700`}
                                        >
                                            {index === 0 ? <ChevronLeft className="h-5 w-5" /> : <ChevronRight className="h-5 w-5" />}
                                        </Link>
                                    );
                                }

                                if (!link.url && link.label === '...') {
                                    return (
                                        <span
                                            key={index}
                                            className="relative inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700"
                                        >
                                            ...
                                        </span>
                                    );
                                }

                                return (
                                    <Link
                                        key={index}
                                        href={link.url || '#'}
                                        className={`relative inline-flex items-center border px-4 py-2 text-sm font-medium ${
                                            link.active
                                                ? 'z-10 border-blue-imphnen-base bg-blue-imphnen-base text-white'
                                                : 'border-gray-300 bg-white text-gray-500 hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700'
                                        }`}
                                    >
                                        {link.label}
                                    </Link>
                                );
                            })}
                        </nav>
                    </div>
                </div>
            </div>
        );
    };

    return (
        <Layout>
            <Head title="IF Bangga - Prestasi Mahasiswa" />

            {/* Hero Section */}
            <section className="section-padding-x relative scroll-mt-12 bg-light-base pt-32 pb-16 text-dark-base dark:bg-dark-base dark:text-light-base">
                <div className="absolute inset-0">
                    <div className="absolute top-0 left-0 -z-10 h-96 w-96 rounded-full bg-blue-400 opacity-20 blur-3xl"></div>
                    <div className="absolute right-0 bottom-0 -z-10 h-96 w-96 rounded-full bg-blue-400 opacity-20 blur-3xl"></div>
                </div>
                <div className="relative mx-auto max-w-screen-xl">
                    <motion.div initial={{ opacity: 0, y: 30 }} animate={{ opacity: 1, y: 0 }} transition={{ duration: 0.8 }} className="text-center">
                        <div className="mb-6 flex justify-center">
                            <span className="flex items-center gap-2 rounded-full bg-gradient-to-br from-blue-imphnen-base to-blue-imphnen-secondary px-4 py-2 text-white">
                                <Trophy className="h-5 w-5" />
                                <span className="text-sm font-medium">IF Bangga</span>
                            </span>
                        </div>
                        <h1 className="mb-4 font-bold">IF Bangga</h1>
                        <p className="mx-auto max-w-2xl text-gray-600 dark:text-gray-300">
                            Kumpulan prestasi membanggakan yang diraih oleh mahasiswa Informatika Unsoed di berbagai kompetisi dan kegiatan akademik
                            maupun non-akademik.
                        </p>
                    </motion.div>

                    {/* Stats */}
                    <motion.div
                        initial={{ opacity: 0, y: 30 }}
                        animate={{ opacity: 1, y: 0 }}
                        transition={{ duration: 0.8, delay: 0.2 }}
                        className="mt-12 grid gap-6 md:grid-cols-3"
                    >
                        {stats.map((stat, index) => (
                            <div
                                key={index}
                                className="rounded-lg border border-white/20 bg-white/10 p-6 text-center backdrop-blur-sm dark:border-gray-700 dark:bg-gray-800/50"
                            >
                                <div className="mb-3 flex justify-center">
                                    <div className="rounded-full bg-blue-500/20 p-3">{stat.icon}</div>
                                </div>
                                <div className="mb-1 text-2xl font-bold">{stat.value}</div>
                                <div className="text-sm text-gray-600 dark:text-gray-400">{stat.label}</div>
                            </div>
                        ))}
                    </motion.div>
                </div>
            </section>

            {/* Search and Filter Section */}
            <section className="section-padding-x bg-light-base py-8 text-dark-base dark:bg-dark-base dark:text-light-base">
                <div className="mx-auto max-w-screen-xl">
                    <motion.div
                        initial={{ opacity: 0, y: 20 }}
                        whileInView={{ opacity: 1, y: 0 }}
                        viewport={{ once: true }}
                        transition={{ duration: 0.6 }}
                        className="space-y-4"
                    >
                        {/* Search */}
                        <div className="flex justify-center">
                            <div className="relative w-full max-w-md">
                                <Search className="absolute top-1/2 left-3 h-4 w-4 -translate-y-1/2 text-gray-400" />
                                <input
                                    type="text"
                                    placeholder="Cari prestasi atau nama mahasiswa..."
                                    value={searchTerm}
                                    onChange={(e) => setSearchTerm(e.target.value)}
                                    className="w-full rounded-lg border border-gray-300 bg-white py-3 pr-4 pl-10 text-dark-base focus:border-blue-imphnen-base focus:ring-1 focus:ring-blue-imphnen-base focus:outline-none dark:border-gray-600 dark:bg-gray-800 dark:text-light-base dark:focus:border-blue-imphnen-secondary"
                                />
                            </div>
                        </div>

                        {/* Filters */}
                        <div className="flex flex-wrap justify-center gap-4">
                            {/* Type Filter */}
                            <select
                                value={selectedType}
                                onChange={(e) => {
                                    setSelectedType(e.target.value);
                                    handleFilter();
                                }}
                                className="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm text-dark-base focus:border-blue-imphnen-base focus:ring-1 focus:ring-blue-imphnen-base focus:outline-none dark:border-gray-600 dark:bg-gray-800 dark:text-light-base"
                            >
                                <option value="all">Semua Jenis</option>
                                {types.map((type) => (
                                    <option key={type.id} value={type.id}>
                                        {type.name}
                                    </option>
                                ))}
                            </select>

                            {/* Category Filter */}
                            <select
                                value={selectedCategory}
                                onChange={(e) => {
                                    setSelectedCategory(e.target.value);
                                    handleFilter();
                                }}
                                className="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm text-dark-base focus:border-blue-imphnen-base focus:ring-1 focus:ring-blue-imphnen-base focus:outline-none dark:border-gray-600 dark:bg-gray-800 dark:text-light-base"
                            >
                                <option value="all">Semua Kategori</option>
                                {categories.map((category) => (
                                    <option key={category.id} value={category.id}>
                                        {category.name}
                                    </option>
                                ))}
                            </select>

                            {/* Level Filter */}
                            <select
                                value={selectedLevel}
                                onChange={(e) => {
                                    setSelectedLevel(e.target.value);
                                    handleFilter();
                                }}
                                className="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm text-dark-base focus:border-blue-imphnen-base focus:ring-1 focus:ring-blue-imphnen-base focus:outline-none dark:border-gray-600 dark:bg-gray-800 dark:text-light-base"
                            >
                                <option value="all">Semua Tingkat</option>
                                {levels.map((level) => (
                                    <option key={level.id} value={level.id}>
                                        {level.name}
                                    </option>
                                ))}
                            </select>

                            {/* Year Filter */}
                            <select
                                value={selectedYear}
                                onChange={(e) => {
                                    setSelectedYear(e.target.value);
                                    handleFilter();
                                }}
                                className="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm text-dark-base focus:border-blue-imphnen-base focus:ring-1 focus:ring-blue-imphnen-base focus:outline-none dark:border-gray-600 dark:bg-gray-800 dark:text-light-base"
                            >
                                <option value="all">Semua Tahun</option>
                                {years.map((year) => (
                                    <option key={year} value={year}>
                                        {year}
                                    </option>
                                ))}
                            </select>
                        </div>

                        {/* Submit Achievement Button */}
                        <div className="flex justify-center">
                            <Link
                                href="/if-bangga/formulir"
                                className="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-blue-imphnen-base to-blue-imphnen-secondary px-6 py-3 font-medium text-white transition-all duration-300 hover:scale-105 hover:shadow-md"
                            >
                                <Plus className="h-4 w-4" />
                                Ajukan Prestasi
                            </Link>
                        </div>
                    </motion.div>
                </div>
            </section>

            {/* Achievements Grid */}
            <section className="section-padding-x bg-light-base py-16 text-dark-base dark:bg-dark-base dark:text-light-base">
                <div className="mx-auto max-w-screen-xl">
                    {achievements.data.length > 0 ? (
                        <>
                            <motion.div
                                initial={{ opacity: 0, x: -30 }}
                                whileInView={{ opacity: 1, x: 0 }}
                                viewport={{ once: true }}
                                transition={{ duration: 0.6 }}
                                className="mb-8"
                            >
                                <h2 className="mb-2 font-bold text-dark-base dark:text-light-base">Prestasi Mahasiswa</h2>
                                <div className="h-1 w-20 rounded bg-gradient-to-r from-blue-imphnen-base to-blue-imphnen-secondary"></div>
                                <p className="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                    Menampilkan {achievements.from}-{achievements.to} dari {achievements.total} prestasi
                                </p>
                            </motion.div>

                            <div className="mb-8 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                                {achievements.data.map((achievement, index) => (
                                    <motion.div
                                        key={achievement.id}
                                        initial={{ opacity: 0, y: 30 }}
                                        whileInView={{ opacity: 1, y: 0 }}
                                        viewport={{ once: true }}
                                        transition={{ duration: 0.6, delay: index * 0.1 }}
                                        className="group overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm transition-all duration-300 hover:shadow-lg dark:border-gray-700 dark:bg-gray-800"
                                    >
                                        {/* Achievement Image */}
                                        <div className="relative h-48 overflow-hidden">
                                            {achievement.image ? (
                                                <img
                                                    src={achievement.image ? `/storage/${achievement.image}` : '/img/placeholder/if-bangga.png'}
                                                    alt={achievement.name}
                                                    className="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105"
                                                />
                                            ) : (
                                                <div className="flex h-full w-full items-center justify-center bg-gradient-to-br from-blue-imphnen-base to-blue-imphnen-secondary">
                                                    <Trophy className="h-16 w-16 text-white/80" />
                                                </div>
                                            )}
                                            <div className="absolute top-4 left-4">
                                                <span
                                                    className={`rounded-full px-3 py-1 text-xs font-medium text-white ${getLevelColor(achievement.achievement_level.name)}`}
                                                >
                                                    {achievement.achievement_level.name}
                                                </span>
                                            </div>
                                        </div>

                                        {/* Content */}
                                        <div className="p-6">
                                            <div className="mb-3">
                                                <span className="inline-block rounded-full bg-blue-100 px-2 py-1 text-xs font-medium text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                                    {achievement.achievement_category.name}
                                                </span>
                                                <span className="ml-2 inline-block rounded-full bg-green-100 px-2 py-1 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-200">
                                                    {achievement.achievement_type.name}
                                                </span>
                                            </div>

                                            <h3 className="mb-2 line-clamp-2 text-lg font-bold text-dark-base dark:text-light-base">
                                                {achievement.name}
                                            </h3>

                                            {achievement.description && (
                                                <p className="mb-4 line-clamp-3 text-sm text-gray-600 dark:text-gray-400">
                                                    {achievement.description}
                                                </p>
                                            )}

                                            {/* Students */}
                                            <div className="mb-4">
                                                <div className="mb-2 flex items-center gap-2">
                                                    <Users className="h-4 w-4 text-gray-500" />
                                                    <span className="text-sm font-medium text-gray-700 dark:text-gray-300">Mahasiswa:</span>
                                                </div>
                                                <div className="space-y-1">
                                                    {achievement.students.slice(0, 3).map((student) => (
                                                        <div key={student.id} className="text-sm text-gray-600 dark:text-gray-400">
                                                            {student.name} ({student.student_id})
                                                        </div>
                                                    ))}
                                                    {achievement.students.length > 3 && (
                                                        <div className="text-sm text-gray-500 dark:text-gray-400">
                                                            +{achievement.students.length - 3} lainnya
                                                        </div>
                                                    )}
                                                </div>
                                            </div>

                                            {/* Date */}
                                            <div className="mb-4 flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                                                <Calendar className="h-3 w-3" />
                                                <span>{formatDate(achievement.awarded_at)}</span>
                                            </div>

                                            {/* Proof Link */}
                                            {achievement.proof && (
                                                <a
                                                    href={achievement.proof}
                                                    target="_blank"
                                                    rel="noopener noreferrer"
                                                    className="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-gradient-to-r from-blue-imphnen-base to-blue-imphnen-secondary px-4 py-2 text-sm font-medium text-white transition-all duration-300 hover:scale-105 hover:shadow-md"
                                                >
                                                    <Eye className="h-4 w-4" />
                                                    Lihat Bukti
                                                </a>
                                            )}
                                        </div>
                                    </motion.div>
                                ))}
                            </div>

                            {/* Pagination */}
                            <motion.div
                                initial={{ opacity: 0, y: 20 }}
                                whileInView={{ opacity: 1, y: 0 }}
                                viewport={{ once: true }}
                                transition={{ duration: 0.6 }}
                            >
                                <Pagination />
                            </motion.div>
                        </>
                    ) : (
                        /* Empty State */
                        <motion.div
                            initial={{ opacity: 0, y: 30 }}
                            animate={{ opacity: 1, y: 0 }}
                            transition={{ duration: 0.8 }}
                            className="py-16 text-center"
                        >
                            <div className="mx-auto mb-4 flex h-24 w-24 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800">
                                <Trophy className="h-12 w-12 text-gray-400" />
                            </div>
                            <h3 className="mb-2 font-semibold text-gray-900 dark:text-white">Tidak Ada Prestasi Ditemukan</h3>
                            <p className="mb-4 text-gray-600 dark:text-gray-400">Coba ubah filter atau kata kunci pencarian yang digunakan.</p>
                            <Link
                                href="/if-bangga/formulir"
                                className="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-blue-imphnen-base to-blue-imphnen-secondary px-6 py-3 font-medium text-white transition-all duration-300 hover:scale-105"
                            >
                                <Plus className="h-4 w-4" />
                                Ajukan Prestasi Pertama
                            </Link>
                        </motion.div>
                    )}
                </div>
            </section>

            {/* Call to Action */}
            <section className="section-padding-x bg-gradient-to-r from-blue-imphnen-base to-blue-imphnen-secondary py-16 text-white">
                <div className="mx-auto max-w-screen-xl">
                    <motion.div
                        initial={{ opacity: 0, y: 30 }}
                        whileInView={{ opacity: 1, y: 0 }}
                        viewport={{ once: true }}
                        transition={{ duration: 0.8 }}
                        className="text-center"
                    >
                        <h2 className="mb-4 font-bold">Punya Prestasi Baru?</h2>
                        <p className="mx-auto mb-8 max-w-2xl text-white/90">
                            Bagikan prestasi membanggakan Anda dengan mengisi formulir pengajuan prestasi. Mari bersama membanggakan nama Informatika
                            Unsoed!
                        </p>
                        <Link
                            href="/if-bangga/formulir"
                            className="inline-flex items-center gap-2 rounded-lg bg-white px-8 py-4 font-semibold text-blue-imphnen-base transition-all duration-300 hover:scale-105 hover:shadow-lg"
                        >
                            <Plus className="h-5 w-5" />
                            Ajukan Prestasi Sekarang
                        </Link>
                    </motion.div>
                </div>
            </section>
        </Layout>
    );
}
