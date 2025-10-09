import Layout from '@/components/layout';
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import { Button } from '@/components/ui/button';
import { DropdownMenuCheckboxItem, DropdownMenuContent, DropdownMenuTrigger } from '@/components/ui/dropdown-menu';
import { Head } from '@inertiajs/react';
import { DropdownMenu } from '@radix-ui/react-dropdown-menu';
import { motion } from 'framer-motion';
import { Filter, GraduationCap, Mail, Phone, Search, Users } from 'lucide-react';
import { useMemo, useState } from 'react';

interface Lecturer {
    id: number;
    name: string;
    nip: string;
    image?: string;
    type: 'informatics' | 'computer_engineering';
}

interface LaborProps {
    lecturers: Lecturer[];
}

export default function Labor({ lecturers }: LaborProps) {
    const [searchTerm, setSearchTerm] = useState('');
    const [selectedType, setSelectedType] = useState<'all' | 'informatics' | 'computer_engineering'>('all');

    const typeLabels = {
        informatics: 'Teknik Informatika',
        computer_engineering: 'Teknik Komputer',
    };

    const filteredLecturers = useMemo(() => {
        return lecturers.filter((lecturer) => {
            const matchesSearch = lecturer.name.toLowerCase().includes(searchTerm.toLowerCase()) || lecturer.nip.includes(searchTerm);
            const matchesType = selectedType === 'all' || lecturer.type === selectedType;
            return matchesSearch && matchesType;
        });
    }, [lecturers, searchTerm, selectedType]);

    const lecturersByType = useMemo(() => {
        return {
            informatics: filteredLecturers.filter((l) => l.type === 'informatics'),
            computer_engineering: filteredLecturers.filter((l) => l.type === 'computer_engineering'),
        };
    }, [filteredLecturers]);

    const getInitials = (name: string) => {
        return name
            .split(' ')
            .map((word) => word.charAt(0))
            .join('')
            .substring(0, 2)
            .toUpperCase();
    };

    const stats = [
        {
            icon: <Users className="h-6 w-6" />,
            label: 'Total Dosen',
            value: lecturers.length.toString(),
        },
        {
            icon: <GraduationCap className="h-6 w-6" />,
            label: 'Teknik Informatika',
            value: lecturers.filter((l) => l.type === 'informatics').length.toString(),
        },
        {
            icon: <GraduationCap className="h-6 w-6" />,
            label: 'Teknik Komputer',
            value: lecturers.filter((l) => l.type === 'computer_engineering').length.toString(),
        },
    ];

    return (
        <Layout>
            <Head title="Tenaga Kerja - Dosen" />

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
                                <Users className="h-5 w-5" />
                                <span className="text-sm font-medium">Tenaga Kerja</span>
                            </span>
                        </div>
                        <h1 className="mb-4 font-bold">Dosen & Tenaga Pengajar</h1>
                        <p className="mx-auto max-w-2xl text-gray-600 dark:text-gray-300">
                            Berkenalan dengan para dosen berkualitas yang mengabdi di Program Studi Teknik Informatika dan Teknik Komputer Universitas
                            Jenderal Soedirman.
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
                                placeholder="Cari nama dosen atau NIP..."
                                value={searchTerm}
                                onChange={(e) => setSearchTerm(e.target.value)}
                                className="w-full rounded-lg border border-gray-300 bg-white py-3 pr-4 pl-10 text-dark-base focus:border-blue-imphnen-base focus:ring-1 focus:ring-blue-imphnen-base focus:outline-none dark:border-gray-600 dark:bg-gray-800 dark:text-light-base dark:focus:border-blue-imphnen-secondary"
                            />
                        </div>

                        {/* Filter */}
                        <div className="flex items-center gap-2">
                            <Filter className="h-4 w-4 text-gray-500" />
                            {/* Shadcn Dropdown */}
                            <DropdownMenu>
                                <DropdownMenuTrigger asChild>
                                    <Button variant="outline" className="min-w-[180px] justify-between">
                                        {selectedType === 'all' ? 'Semua Program Studi' : typeLabels[selectedType]}
                                    </Button>
                                </DropdownMenuTrigger>
                                <DropdownMenuContent>
                                    <DropdownMenuCheckboxItem checked={selectedType === 'all'} onCheckedChange={() => setSelectedType('all')}>
                                        Semua Program Studi
                                    </DropdownMenuCheckboxItem>
                                    <DropdownMenuCheckboxItem
                                        checked={selectedType === 'informatics'}
                                        onCheckedChange={() => setSelectedType('informatics')}
                                    >
                                        Teknik Informatika
                                    </DropdownMenuCheckboxItem>
                                    <DropdownMenuCheckboxItem
                                        checked={selectedType === 'computer_engineering'}
                                        onCheckedChange={() => setSelectedType('computer_engineering')}
                                    >
                                        Teknik Komputer
                                    </DropdownMenuCheckboxItem>
                                </DropdownMenuContent>
                            </DropdownMenu>
                        </div>
                    </motion.div>
                </div>
            </section>

            {/* Lecturers Section */}
            <section className="section-padding-x bg-light-base py-16 text-dark-base dark:bg-dark-base dark:text-light-base">
                <div className="mx-auto max-w-screen-xl">
                    {selectedType === 'all' ? (
                        // Show by department when "all" is selected
                        <>
                            {Object.entries(lecturersByType).map(
                                ([type, lecturerList]) =>
                                    lecturerList.length > 0 && (
                                        <div key={type} className="mb-16">
                                            <motion.div
                                                initial={{ opacity: 0, x: -30 }}
                                                whileInView={{ opacity: 1, x: 0 }}
                                                viewport={{ once: true }}
                                                transition={{ duration: 0.6 }}
                                                className="mb-8"
                                            >
                                                <h2 className="mb-2 font-bold text-dark-base dark:text-light-base">
                                                    {typeLabels[type as keyof typeof typeLabels]}
                                                </h2>
                                                <div className="h-1 w-20 rounded bg-gradient-to-r from-blue-imphnen-base to-blue-imphnen-secondary"></div>
                                            </motion.div>

                                            <div className="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                                                {lecturerList.map((lecturer, index) => (
                                                    <motion.div
                                                        key={lecturer.id}
                                                        initial={{ opacity: 0, y: 30 }}
                                                        whileInView={{ opacity: 1, y: 0 }}
                                                        viewport={{ once: true }}
                                                        transition={{ duration: 0.6, delay: index * 0.1 }}
                                                        className="group flex flex-col items-center rounded-lg border border-gray-200 bg-white p-6 shadow-sm transition-all duration-300 hover:shadow-lg dark:border-gray-700 dark:bg-gray-800"
                                                    >
                                                        {/* Gambar di tengah atas */}
                                                        <div className="mb-4 flex justify-center">
                                                            {lecturer.image ? (
                                                                <Avatar className="h-24 w-24">
                                                                    <AvatarImage
                                                                        src={`/storage/${lecturer.image}`}
                                                                        alt={lecturer.name}
                                                                        className="h-full w-full rounded-full object-cover"
                                                                    />
                                                                    <AvatarFallback className="flex h-full w-full items-center justify-center rounded-full bg-gradient-to-br from-blue-imphnen-base to-blue-imphnen-secondary font-semibold text-white">
                                                                        {getInitials(lecturer.name)}
                                                                    </AvatarFallback>
                                                                </Avatar>
                                                            ) : (
                                                                <div className="flex h-24 w-24 items-center justify-center rounded-full bg-gradient-to-br from-blue-imphnen-base to-blue-imphnen-secondary font-semibold text-white">
                                                                    {getInitials(lecturer.name)}
                                                                </div>
                                                            )}
                                                        </div>

                                                        {/* Konten teks */}
                                                        <div className="text-center">
                                                            <h3 className="mb-1 font-semibold text-dark-base transition-colors duration-300 group-hover:text-blue-imphnen-base dark:text-light-base">
                                                                {lecturer.name}
                                                            </h3>
                                                            <p className="mb-2 text-sm text-gray-600 dark:text-gray-400">NIP: {lecturer.nip}</p>
                                                            <span className="inline-block rounded-full bg-blue-imphnen-base/10 px-2 py-1 text-xs font-medium text-blue-imphnen-base">
                                                                {typeLabels[lecturer.type]}
                                                            </span>
                                                        </div>
                                                    </motion.div>
                                                ))}
                                            </div>
                                        </div>
                                    ),
                            )}
                        </>
                    ) : (
                        // Show filtered results
                        <div>
                            <motion.div
                                initial={{ opacity: 0, x: -30 }}
                                animate={{ opacity: 1, x: 0 }}
                                transition={{ duration: 0.6 }}
                                className="mb-8"
                            >
                                <h2 className="mb-2 font-bold text-dark-base dark:text-light-base">{typeLabels[selectedType]}</h2>
                                <div className="h-1 w-20 rounded bg-gradient-to-r from-blue-imphnen-base to-blue-imphnen-secondary"></div>
                                <p className="mt-2 text-sm text-gray-600 dark:text-gray-400">Menampilkan {filteredLecturers.length} dosen</p>
                            </motion.div>

                            {filteredLecturers.length > 0 ? (
                                <div className="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                                    {filteredLecturers.map((lecturer, index) => (
                                        <motion.div
                                            key={lecturer.id}
                                            initial={{ opacity: 0, y: 30 }}
                                            whileInView={{ opacity: 1, y: 0 }}
                                            viewport={{ once: true }}
                                            transition={{ duration: 0.6, delay: index * 0.1 }}
                                            className="group flex flex-col items-center rounded-lg border border-gray-200 bg-white p-6 shadow-sm transition-all duration-300 hover:shadow-lg dark:border-gray-700 dark:bg-gray-800"
                                        >
                                            {/* Gambar di tengah atas */}
                                            <div className="mb-4 flex justify-center">
                                                {lecturer.image ? (
                                                    <Avatar className="h-24 w-24">
                                                        <AvatarImage
                                                            src={`/storage/${lecturer.image}`}
                                                            alt={lecturer.name}
                                                            className="h-full w-full rounded-full object-cover"
                                                        />
                                                        <AvatarFallback className="flex h-full w-full items-center justify-center rounded-full bg-gradient-to-br from-blue-imphnen-base to-blue-imphnen-secondary font-semibold text-white">
                                                            {getInitials(lecturer.name)}
                                                        </AvatarFallback>
                                                    </Avatar>
                                                ) : (
                                                    <div className="flex h-24 w-24 items-center justify-center rounded-full bg-gradient-to-br from-blue-imphnen-base to-blue-imphnen-secondary font-semibold text-white">
                                                        {getInitials(lecturer.name)}
                                                    </div>
                                                )}
                                            </div>

                                            {/* Konten teks */}
                                            <div className="text-center">
                                                <h3 className="mb-1 font-semibold text-dark-base transition-colors duration-300 group-hover:text-blue-imphnen-base dark:text-light-base">
                                                    {lecturer.name}
                                                </h3>
                                                <p className="mb-2 text-sm text-gray-600 dark:text-gray-400">NIP: {lecturer.nip}</p>
                                                <span className="inline-block rounded-full bg-blue-imphnen-base/10 px-2 py-1 text-xs font-medium text-blue-imphnen-base">
                                                    {typeLabels[lecturer.type]}
                                                </span>
                                            </div>
                                        </motion.div>
                                    ))}
                                </div>
                            ) : (
                                <motion.div
                                    initial={{ opacity: 0, y: 30 }}
                                    animate={{ opacity: 1, y: 0 }}
                                    transition={{ duration: 0.8 }}
                                    className="py-16 text-center"
                                >
                                    <div className="mx-auto mb-4 flex h-24 w-24 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800">
                                        <Users className="h-12 w-12 text-gray-400" />
                                    </div>
                                    <h3 className="mb-2 font-semibold text-gray-900 dark:text-white">Tidak Ada Dosen Ditemukan</h3>
                                    <p className="text-gray-600 dark:text-gray-400">Coba ubah kata kunci pencarian atau filter yang digunakan.</p>
                                </motion.div>
                            )}
                        </div>
                    )}
                </div>
            </section>

            {/* Contact Information */}
            <section className="section-padding-x bg-gray-50 py-16 text-dark-base dark:bg-gray-900 dark:text-light-base">
                <div className="mx-auto max-w-screen-xl">
                    <motion.div
                        initial={{ opacity: 0, y: 30 }}
                        whileInView={{ opacity: 1, y: 0 }}
                        viewport={{ once: true }}
                        transition={{ duration: 0.8 }}
                        className="text-center"
                    >
                        <h2 className="mb-4 font-bold text-dark-base dark:text-light-base">Informasi Kontak</h2>
                        <p className="mx-auto mb-8 max-w-2xl text-gray-600 dark:text-gray-400">
                            Untuk informasi lebih lanjut mengenai dosen dan staff pengajar, silakan hubungi kami melalui kontak di bawah ini.
                        </p>

                        <div className="flex flex-col gap-4 sm:flex-row sm:justify-center">
                            <div className="flex items-center gap-2 rounded-lg bg-white px-6 py-3 shadow-sm dark:bg-gray-800">
                                <Mail className="h-5 w-5 text-blue-imphnen-base" />
                                <span className="text-sm">ft@unsoed.ac.id</span>
                            </div>
                            <div className="flex items-center gap-2 rounded-lg bg-white px-6 py-3 shadow-sm dark:bg-gray-800">
                                <Phone className="h-5 w-5 text-blue-imphnen-base" />
                                <span className="text-sm">(0281) 6596700</span>
                            </div>
                        </div>
                    </motion.div>
                </div>
            </section>
        </Layout>
    );
}
