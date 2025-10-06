import Layout from '@/components/layout';
import { Button } from '@/components/ui/button';
import { DropdownMenu, DropdownMenuCheckboxItem, DropdownMenuContent, DropdownMenuTrigger } from '@/components/ui/dropdown-menu';
import { Head, Link } from '@inertiajs/react';
import { motion } from 'framer-motion';
import { ArrowRight, Briefcase, Calendar, Eye, Filter, Search, Users } from 'lucide-react';
import { useMemo, useState } from 'react';

interface Administrator {
    id: number;
    name: string;
    position: string;
    email?: string;
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

interface WorkPlanIndexProps {
    workPrograms: WorkProgram[];
    divisions: Division[];
}

// Data dummy untuk development
const dummyDivisions: Division[] = [
    { id: 1, name: 'Humas dan Kemitraan', slug: 'humas-kemitraan' },
    { id: 2, name: 'Pengembangan SDM', slug: 'pengembangan-sdm' },
    { id: 3, name: 'Riset dan Teknologi', slug: 'riset-teknologi' },
    { id: 4, name: 'Kegiatan Mahasiswa', slug: 'kegiatan-mahasiswa' },
];

const dummyWorkPrograms: WorkProgram[] = [
    {
        id: 1,
        name: 'HMIF Tech Talk Series 2024',
        description:
            'Seri webinar dan workshop teknologi terkini yang menghadirkan praktisi industri dan akademisi untuk berbagi pengetahuan dengan mahasiswa Informatika.',
        images: ['/img/work-programs/tech-talk-1.jpg', '/img/work-programs/tech-talk-2.jpg'],
        division_id: 1,
        division: { id: 1, name: 'Humas dan Kemitraan', slug: 'humas-kemitraan' },
        work_program_administrators: [
            {
                id: 1,
                position: 'Ketua Pelaksana',
                work_program_id: 1,
                administrator_id: 1,
                administrator: { id: 1, name: 'Ahmad Santoso', position: 'Koordinator Humas', email: 'ahmad@hmif.unsoed.ac.id' },
            },
            {
                id: 2,
                position: 'Wakil Ketua',
                work_program_id: 1,
                administrator_id: 2,
                administrator: { id: 2, name: 'Siti Rahma', position: 'Staff Humas', email: 'siti@hmif.unsoed.ac.id' },
            },
        ],
        created_at: '2024-01-15T10:30:00.000000Z',
        updated_at: '2024-01-15T10:30:00.000000Z',
    },
    {
        id: 2,
        name: 'Pelatihan Competitive Programming',
        description:
            'Program pelatihan intensif untuk meningkatkan kemampuan problem solving dan algoritma mahasiswa dalam menghadapi kompetisi programming.',
        images: ['/img/work-programs/competitive-1.jpg'],
        division_id: 2,
        division: { id: 2, name: 'Pengembangan SDM', slug: 'pengembangan-sdm' },
        work_program_administrators: [
            {
                id: 3,
                position: 'Koordinator',
                work_program_id: 2,
                administrator_id: 3,
                administrator: { id: 3, name: 'Budi Prasetyo', position: 'Ketua Divisi SDM' },
            },
        ],
        created_at: '2024-02-01T14:15:00.000000Z',
        updated_at: '2024-02-01T14:15:00.000000Z',
    },
    {
        id: 3,
        name: 'Research Festival HMIF 2024',
        description:
            'Festival penelitian tahunan yang menampilkan hasil riset mahasiswa dan dosen, serta mengundang peneliti dari universitas lain untuk sharing session.',
        images: ['/img/work-programs/research-1.jpg', '/img/work-programs/research-2.jpg', '/img/work-programs/research-3.jpg'],
        division_id: 3,
        division: { id: 3, name: 'Riset dan Teknologi', slug: 'riset-teknologi' },
        work_program_administrators: [
            {
                id: 4,
                position: 'Ketua Panitia',
                work_program_id: 3,
                administrator_id: 4,
                administrator: { id: 4, name: 'Maria Ulfah', position: 'Koordinator Riset' },
            },
        ],
        created_at: '2024-03-10T09:45:00.000000Z',
        updated_at: '2024-03-10T09:45:00.000000Z',
    },
];

export default function WorkPlanIndex({ workPrograms = dummyWorkPrograms, divisions = dummyDivisions }: WorkPlanIndexProps) {
    const [searchTerm, setSearchTerm] = useState('');
    const [selectedDivision, setSelectedDivision] = useState<number | 'all'>('all');

    const filteredWorkPrograms = useMemo(() => {
        return workPrograms.filter((program) => {
            const matchesSearch =
                program.name.toLowerCase().includes(searchTerm.toLowerCase()) ||
                (program.description && program.description.toLowerCase().includes(searchTerm.toLowerCase()));

            const matchesDivision = selectedDivision === 'all' || program.division_id === selectedDivision;

            return matchesSearch && matchesDivision;
        });
    }, [workPrograms, searchTerm, selectedDivision]);

    const stats = [
        {
            icon: <Briefcase className="h-6 w-6" />,
            label: 'Total Program',
            value: workPrograms.length.toString(),
        },
        {
            icon: <Users className="h-6 w-6" />,
            label: 'Divisi Aktif',
            value: divisions.length.toString(),
        },
        {
            icon: <Calendar className="h-6 w-6" />,
            label: 'Tahun Aktif',
            value: '2024',
        },
    ];

    const formatDate = (dateString: string) => {
        return new Date(dateString).toLocaleDateString('id-ID', {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
        });
    };

    const getMainAdministrator = (administrators: WorkProgramAdministrator[]) => {
        return (
            administrators.find((admin) => admin.position.toLowerCase().includes('ketua') || admin.position.toLowerCase().includes('koordinator')) ||
            administrators[0]
        );
    };

    return (
        <Layout>
            <Head title="Program Kerja HMIF Unsoed" />

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
                                <Briefcase className="h-5 w-5" />
                                <span className="text-sm font-medium">Program Kerja</span>
                            </span>
                        </div>
                        <h1 className="mb-4 font-bold">Program Kerja HMIF Unsoed</h1>
                        <p className="mx-auto max-w-2xl text-gray-600 dark:text-gray-300">
                            Jelajahi berbagai program kerja dan kegiatan yang diselenggarakan oleh HMIF Unsoed untuk mengembangkan potensi mahasiswa
                            dan memajukan organisasi.
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
                                    <div className="rounded-full bg-blue-imphnen-base/20 p-3">{stat.icon}</div>
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
                        className="flex flex-col gap-4 md:flex-row md:items-center md:justify-between"
                    >
                        {/* Search */}
                        <div className="relative max-w-md flex-1">
                            <Search className="absolute top-1/2 left-3 h-4 w-4 -translate-y-1/2 text-gray-400" />
                            <input
                                type="text"
                                placeholder="Cari program kerja..."
                                value={searchTerm}
                                onChange={(e) => setSearchTerm(e.target.value)}
                                className="w-full rounded-lg border border-gray-300 bg-white py-3 pr-4 pl-10 text-dark-base focus:border-blue-imphnen-base focus:ring-1 focus:ring-blue-imphnen-base focus:outline-none dark:border-gray-600 dark:bg-gray-800 dark:text-light-base dark:focus:border-blue-imphnen-secondary"
                            />
                        </div>

                        {/* Filter */}
                        <div className="flex items-center gap-2">
                            <Filter className="h-4 w-4 text-gray-500" />
                            <DropdownMenu>
                                <DropdownMenuTrigger asChild>
                                    <Button variant="outline" className="min-w-[180px] justify-between">
                                        {selectedDivision === 'all'
                                            ? 'Semua Divisi'
                                            : divisions.find((d) => d.id === selectedDivision)?.name}
                                    </Button>
                                </DropdownMenuTrigger>
                                <DropdownMenuContent>
                                    <DropdownMenuCheckboxItem
                                        checked={selectedDivision === 'all'}
                                        onCheckedChange={() => setSelectedDivision('all')}
                                    >
                                        Semua Divisi
                                    </DropdownMenuCheckboxItem>
                                    {divisions.map((division) => (
                                        <DropdownMenuCheckboxItem
                                            key={division.id}
                                            checked={selectedDivision === division.id}
                                            onCheckedChange={() => setSelectedDivision(division.id)}
                                        >
                                            {division.name}
                                        </DropdownMenuCheckboxItem>
                                    ))}
                                </DropdownMenuContent>
                            </DropdownMenu>
                        </div>
                    </motion.div>
                </div>
            </section>

            {/* Work Programs Section */}
            <section className="section-padding-x bg-light-base py-16 text-dark-base dark:bg-dark-base dark:text-light-base">
                <div className="mx-auto max-w-screen-xl">
                    {filteredWorkPrograms.length > 0 ? (
                        <>
                            <motion.div
                                initial={{ opacity: 0, x: -30 }}
                                whileInView={{ opacity: 1, x: 0 }}
                                viewport={{ once: true }}
                                transition={{ duration: 0.6 }}
                                className="mb-8"
                            >
                                <h2 className="mb-2 font-bold text-dark-base dark:text-light-base">Daftar Program Kerja</h2>
                                <div className="h-1 w-20 rounded bg-gradient-to-r from-blue-imphnen-base to-blue-imphnen-secondary"></div>
                                <p className="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                    Menampilkan {filteredWorkPrograms.length} program kerja
                                </p>
                            </motion.div>

                            <div className="grid gap-8 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                                {filteredWorkPrograms.map((program, index) => {
                                    const mainAdmin = getMainAdministrator(program.work_program_administrators);

                                    return (
                                        <motion.div
                                            key={program.id}
                                            initial={{ opacity: 0, y: 30 }}
                                            whileInView={{ opacity: 1, y: 0 }}
                                            viewport={{ once: true }}
                                            transition={{ duration: 0.6, delay: index * 0.1 }}
                                            className="group overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm transition-all duration-300 hover:shadow-lg dark:border-gray-700 dark:bg-gray-800"
                                        >
                                            {/* Image */}
                                            <div className="relative h-48 overflow-hidden">
                                                {program.images && program.images.length > 0 ? (
                                                    <img
                                                        src={`/storage/${program.images[0]}`}
                                                        alt={program.name}
                                                        className="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105"
                                                    />
                                                ) : (
                                                    <div className="flex h-full w-full items-center justify-center bg-gradient-to-br from-blue-imphnen-base to-blue-imphnen-secondary">
                                                        <Briefcase className="h-12 w-12 text-white/80" />
                                                    </div>
                                                )}
                                                <div className="absolute top-4 left-4">
                                                    <span className="rounded-full bg-white/90 px-3 py-1 text-xs font-medium text-gray-800 backdrop-blur-sm">
                                                        {program.division.name}
                                                    </span>
                                                </div>
                                            </div>

                                            {/* Content */}
                                            <div className="p-6">
                                                <h3 className="mb-2 line-clamp-2 text-lg font-bold text-dark-base transition-colors duration-300 group-hover:text-blue-imphnen-base dark:text-light-base">
                                                    {program.name}
                                                </h3>

                                                {program.description && (
                                                    <p className="mb-4 line-clamp-2 text-sm text-gray-600 dark:text-gray-400">
                                                        {program.description}
                                                    </p>
                                                )}

                                                {/* Administrator Info */}
                                                {mainAdmin && (
                                                    <div className="mb-4 flex items-center gap-3">
                                                        <div className="flex-shrink-0">
                                                            <div className="flex h-10 w-10 items-center justify-center rounded-full bg-gradient-to-br from-blue-imphnen-base to-blue-imphnen-secondary text-sm font-semibold text-white">
                                                                {mainAdmin.administrator.name.charAt(0).toUpperCase()}
                                                            </div>
                                                        </div>
                                                        <div className="min-w-0 flex-1">
                                                            <p className="text-sm font-medium text-dark-base dark:text-light-base">
                                                                {mainAdmin.administrator.name}
                                                            </p>
                                                            <p className="text-xs text-gray-500 dark:text-gray-400">{mainAdmin.position}</p>
                                                        </div>
                                                    </div>
                                                )}

                                                {/* Meta Info */}
                                                <div className="mb-4 flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                                                    <div className="flex items-center gap-1">
                                                        <Calendar className="h-3 w-3" />
                                                        <span>{formatDate(program.created_at)}</span>
                                                    </div>
                                                    <div className="flex items-center gap-1">
                                                        <Users className="h-3 w-3" />
                                                        <span>{program.work_program_administrators.length} Admin</span>
                                                    </div>
                                                </div>

                                                {/* View Details Button */}
                                                <Link
                                                    href={`/proker-divisi/${program.id}`}
                                                    className="group/btn flex w-full items-center justify-center gap-2 rounded-lg bg-gradient-to-r from-blue-imphnen-base to-blue-imphnen-secondary px-4 py-3 text-sm font-medium text-white transition-all duration-300 hover:scale-105 hover:shadow-md"
                                                >
                                                    <Eye className="h-4 w-4" />
                                                    <span>Lihat Detail</span>
                                                    <ArrowRight className="h-4 w-4 transition-transform duration-300 group-hover/btn:translate-x-1" />
                                                </Link>
                                            </div>
                                        </motion.div>
                                    );
                                })}
                            </div>
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
                                <Briefcase className="h-12 w-12 text-gray-400" />
                            </div>
                            <h3 className="mb-2 font-semibold text-gray-900 dark:text-white">Tidak Ada Program Kerja Ditemukan</h3>
                            <p className="text-gray-600 dark:text-gray-400">Coba ubah kata kunci pencarian atau filter yang digunakan.</p>
                        </motion.div>
                    )}
                </div>
            </section>

            {/* Division Overview */}
            <section className="section-padding-x bg-gray-50 py-16 text-dark-base dark:bg-gray-900 dark:text-light-base">
                <div className="mx-auto max-w-screen-xl">
                    <motion.div
                        initial={{ opacity: 0, y: 30 }}
                        whileInView={{ opacity: 1, y: 0 }}
                        viewport={{ once: true }}
                        transition={{ duration: 0.8 }}
                        className="mb-12 text-center"
                    >
                        <h2 className="mb-4 font-bold text-dark-base dark:text-light-base">Divisi HMIF Unsoed</h2>
                        <p className="mx-auto max-w-2xl text-gray-600 dark:text-gray-400">
                            Berbagai divisi yang menjalankan program kerja untuk kemajuan HMIF Unsoed
                        </p>
                    </motion.div>

                    <div className="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                        {divisions.map((division, index) => {
                            const divisionPrograms = workPrograms.filter((p) => p.division_id === division.id);

                            return (
                                <motion.div
                                    key={division.id}
                                    initial={{ opacity: 0, y: 30 }}
                                    whileInView={{ opacity: 1, y: 0 }}
                                    viewport={{ once: true }}
                                    transition={{ duration: 0.6, delay: index * 0.1 }}
                                    className="rounded-lg bg-white p-6 text-center shadow-sm dark:bg-gray-800"
                                >
                                    <div className="mb-4 flex justify-center">
                                        <div className="rounded-full bg-gradient-to-br from-blue-imphnen-base to-blue-imphnen-secondary p-3">
                                            <Briefcase className="h-6 w-6 text-white" />
                                        </div>
                                    </div>
                                    <h3 className="mb-2 font-semibold text-dark-base dark:text-light-base">{division.name}</h3>
                                    <p className="text-sm text-gray-600 dark:text-gray-400">{divisionPrograms.length} Program Aktif</p>
                                </motion.div>
                            );
                        })}
                    </div>
                </div>
            </section>
        </Layout>
    );
}
