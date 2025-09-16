import Layout from '@/components/layout';
import { Button } from '@/components/ui/button';
import { DropdownMenu, DropdownMenuCheckboxItem, DropdownMenuContent, DropdownMenuTrigger } from '@/components/ui/dropdown-menu';
import { Head } from '@inertiajs/react';
import { motion } from 'framer-motion';
import { ArrowDown, Calendar, Download as DownloadIcon, ExternalLink, FileText, Filter, Search } from 'lucide-react';
import { useMemo, useState } from 'react';

interface Download {
    id: number;
    name: string;
    description?: string;
    file?: string;
    link?: string;
    created_at: string;
    updated_at: string;
}

interface DownloadProps {
    downloads: Download[];
}

const typeLabels = {
    file: 'File Download',
    link: 'Link Eksternal',
};

// Data dummy - ganti dengan data dari props
const dummyDownloads: Download[] = [
    {
        id: 1,
        name: 'Panduan Akademik Teknik Informatika 2024',
        description:
            'Buku panduan lengkap untuk mahasiswa baru Teknik Informatika tahun 2024, berisi informasi kurikulum, mata kuliah, dan ketentuan akademik.',
        file: '/downloads/panduan-akademik-2024.pdf',
        link: null,
        created_at: '2024-01-15T10:30:00.000000Z',
        updated_at: '2024-01-15T10:30:00.000000Z',
    },
    {
        id: 2,
        name: 'Template Laporan Tugas Akhir',
        description: 'Template resmi untuk penulisan laporan tugas akhir/skripsi sesuai dengan format yang ditetapkan oleh program studi.',
        file: '/downloads/template-ta.docx',
        link: null,
        created_at: '2024-02-01T14:15:00.000000Z',
        updated_at: '2024-02-01T14:15:00.000000Z',
    },
    {
        id: 3,
        name: 'Formulir Pendaftaran Seminar Proposal',
        description: 'Formulir yang harus diisi untuk mendaftar seminar proposal tugas akhir.',
        file: '/downloads/form-seminar-proposal.pdf',
        link: null,
        created_at: '2024-02-10T09:45:00.000000Z',
        updated_at: '2024-02-10T09:45:00.000000Z',
    },
    {
        id: 4,
        name: 'Link Repository GitHub HMIF',
        description: 'Akses ke repository GitHub resmi HMIF Unsoed yang berisi berbagai project dan kode sumber.',
        file: null,
        link: 'https://github.com/hmif-unsoed',
        created_at: '2024-01-20T16:20:00.000000Z',
        updated_at: '2024-01-20T16:20:00.000000Z',
    },
    {
        id: 5,
        name: 'Silabus Mata Kuliah Semester Genap 2024',
        description: 'Dokumen silabus lengkap untuk semua mata kuliah yang dibuka pada semester genap 2024.',
        file: '/downloads/silabus-genap-2024.pdf',
        link: null,
        created_at: '2024-01-30T11:00:00.000000Z',
        updated_at: '2024-01-30T11:00:00.000000Z',
    },
    {
        id: 6,
        name: 'E-Learning Portal Unsoed',
        description: 'Akses langsung ke portal e-learning Universitas Jenderal Soedirman untuk mengakses materi kuliah online.',
        file: null,
        link: 'https://elearning.unsoed.ac.id',
        created_at: '2024-01-10T08:30:00.000000Z',
        updated_at: '2024-01-10T08:30:00.000000Z',
    },
];

export default function DownloadPage({ downloads = dummyDownloads }: DownloadProps) {
    const [searchTerm, setSearchTerm] = useState('');
    const [selectedType, setSelectedType] = useState<'all' | 'file' | 'link'>('all');

    const filteredDownloads = useMemo(() => {
        return downloads.filter((download) => {
            const matchesSearch =
                download.name.toLowerCase().includes(searchTerm.toLowerCase()) ||
                (download.description && download.description.toLowerCase().includes(searchTerm.toLowerCase()));

            let matchesType = true;
            if (selectedType === 'file') {
                matchesType = download.file !== null;
            } else if (selectedType === 'link') {
                matchesType = download.link !== null;
            }

            return matchesSearch && matchesType;
        });
    }, [downloads, searchTerm, selectedType]);

    const stats = [
        {
            icon: <DownloadIcon className="h-6 w-6" />,
            label: 'Total Download',
            value: downloads.length.toString(),
        },
        {
            icon: <FileText className="h-6 w-6" />,
            label: 'File Dokumen',
            value: downloads.filter((d) => d.file).length.toString(),
        },
        {
            icon: <ExternalLink className="h-6 w-6" />,
            label: 'Link Eksternal',
            value: downloads.filter((d) => d.link).length.toString(),
        },
    ];

    const formatDate = (dateString: string) => {
        return new Date(dateString).toLocaleDateString('id-ID', {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
        });
    };

    const getFileExtension = (filename: string) => {
        return filename.split('.').pop()?.toUpperCase() || '';
    };

    const getFileIcon = (filename?: string) => {
        if (!filename) return <ExternalLink className="h-5 w-5" />;

        const ext = filename.split('.').pop()?.toLowerCase();
        switch (ext) {
            case 'pdf':
                return <FileText className="h-5 w-5 text-red-500" />;
            case 'doc':
            case 'docx':
                return <FileText className="h-5 w-5 text-blue-500" />;
            case 'xls':
            case 'xlsx':
                return <FileText className="h-5 w-5 text-green-500" />;
            case 'ppt':
            case 'pptx':
                return <FileText className="h-5 w-5 text-orange-500" />;
            default:
                return <FileText className="h-5 w-5 text-gray-500" />;
        }
    };

    const handleDownload = (download: Download) => {
        if (download.file) {
            // Create a link and trigger download
            const link = document.createElement('a');
            link.href = download.file;
            link.download = download.name;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        } else if (download.link) {
            // Open external link in new tab
            window.open(download.link, '_blank');
        }
    };

    return (
        <Layout>
            <Head title="Download & Unduhan" />

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
                                <DownloadIcon className="h-5 w-5" />
                                <span className="text-sm font-medium">Download & Unduhan</span>
                            </span>
                        </div>
                        <h1 className="mb-4 font-bold">Pusat Download HMIF Unsoed</h1>
                        <p className="mx-auto max-w-2xl text-gray-600 dark:text-gray-300">
                            Temukan berbagai dokumen penting, template, formulir, dan resource lainnya yang dibutuhkan untuk kegiatan akademik dan
                            organisasi di HMIF Unsoed.
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
                                placeholder="Cari nama file atau deskripsi..."
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
                                        {selectedType === 'all' ? 'Semua Program Studi' : typeLabels[selectedType]}
                                    </Button>
                                </DropdownMenuTrigger>
                                <DropdownMenuContent>
                                    <DropdownMenuCheckboxItem checked={selectedType === 'all'} onCheckedChange={() => setSelectedType('all')}>
                                        Semua Program Studi
                                    </DropdownMenuCheckboxItem>
                                    <DropdownMenuCheckboxItem checked={selectedType === 'file'} onCheckedChange={() => setSelectedType('file')}>
                                        Teknik Informatika
                                    </DropdownMenuCheckboxItem>
                                    <DropdownMenuCheckboxItem checked={selectedType === 'link'} onCheckedChange={() => setSelectedType('link')}>
                                        Teknik Komputer
                                    </DropdownMenuCheckboxItem>
                                </DropdownMenuContent>
                            </DropdownMenu>
                        </div>
                    </motion.div>
                </div>
            </section>

            {/* Downloads Section */}
            <section className="section-padding-x bg-light-base py-16 text-dark-base dark:bg-dark-base dark:text-light-base">
                <div className="mx-auto max-w-screen-xl">
                    {filteredDownloads.length > 0 ? (
                        <>
                            <motion.div
                                initial={{ opacity: 0, x: -30 }}
                                whileInView={{ opacity: 1, x: 0 }}
                                viewport={{ once: true }}
                                transition={{ duration: 0.6 }}
                                className="mb-8"
                            >
                                <h2 className="mb-2 font-bold text-dark-base dark:text-light-base">File & Link Download</h2>
                                <div className="h-1 w-20 rounded bg-gradient-to-r from-blue-imphnen-base to-blue-imphnen-secondary"></div>
                                <p className="mt-2 text-sm text-gray-600 dark:text-gray-400">Menampilkan {filteredDownloads.length} item</p>
                            </motion.div>

                            <div className="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                                {filteredDownloads.map((download, index) => (
                                    <motion.div
                                        key={download.id}
                                        initial={{ opacity: 0, y: 30 }}
                                        whileInView={{ opacity: 1, y: 0 }}
                                        viewport={{ once: true }}
                                        transition={{ duration: 0.6, delay: index * 0.1 }}
                                        className="group rounded-lg border border-gray-200 bg-white p-6 shadow-sm transition-all duration-300 hover:shadow-lg dark:border-gray-700 dark:bg-gray-800"
                                    >
                                        {/* Header */}
                                        <div className="mb-4 flex items-start gap-3">
                                            <div className="flex-shrink-0 rounded-lg bg-gray-50 p-2 dark:bg-gray-700">
                                                {getFileIcon(download.file || undefined)}
                                            </div>
                                            <div className="min-w-0 flex-1">
                                                <h3 className="mb-1 line-clamp-2 font-semibold text-dark-base transition-colors duration-300 group-hover:text-blue-imphnen-base dark:text-light-base">
                                                    {download.name}
                                                </h3>
                                                {download.file && (
                                                    <span className="inline-block rounded-full bg-blue-imphnen-base/10 px-2 py-1 text-xs font-medium text-blue-imphnen-base">
                                                        {getFileExtension(download.file)}
                                                    </span>
                                                )}
                                                {download.link && (
                                                    <span className="inline-block rounded-full bg-green-500/10 px-2 py-1 text-xs font-medium text-green-600 dark:text-green-400">
                                                        LINK
                                                    </span>
                                                )}
                                            </div>
                                        </div>

                                        {/* Description */}
                                        {download.description && (
                                            <p className="mb-4 line-clamp-3 text-sm text-gray-600 dark:text-gray-400">{download.description}</p>
                                        )}

                                        {/* Meta Info */}
                                        <div className="mb-4 flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                                            <Calendar className="h-3 w-3" />
                                            <span>{formatDate(download.created_at)}</span>
                                        </div>

                                        {/* Download Button */}
                                        <button
                                            onClick={() => handleDownload(download)}
                                            className="flex w-full items-center justify-center gap-2 rounded-lg bg-gradient-to-r from-blue-imphnen-base to-blue-imphnen-secondary px-4 py-3 text-sm font-medium text-white transition-all duration-300 hover:scale-105 hover:shadow-md focus:ring-2 focus:ring-blue-imphnen-base focus:ring-offset-2 focus:outline-none"
                                        >
                                            {download.file ? (
                                                <>
                                                    <ArrowDown className="h-4 w-4" />
                                                    Download File
                                                </>
                                            ) : (
                                                <>
                                                    <ExternalLink className="h-4 w-4" />
                                                    Buka Link
                                                </>
                                            )}
                                        </button>
                                    </motion.div>
                                ))}
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
                                <DownloadIcon className="h-12 w-12 text-gray-400" />
                            </div>
                            <h3 className="mb-2 font-semibold text-gray-900 dark:text-white">Tidak Ada File Ditemukan</h3>
                            <p className="text-gray-600 dark:text-gray-400">Coba ubah kata kunci pencarian atau filter yang digunakan.</p>
                        </motion.div>
                    )}
                </div>
            </section>

            {/* Info Section */}
            <section className="section-padding-x bg-gray-50 py-16 text-dark-base dark:bg-gray-900 dark:text-light-base">
                <div className="mx-auto max-w-screen-xl">
                    <motion.div
                        initial={{ opacity: 0, y: 30 }}
                        whileInView={{ opacity: 1, y: 0 }}
                        viewport={{ once: true }}
                        transition={{ duration: 0.8 }}
                        className="text-center"
                    >
                        <h2 className="mb-4 font-bold text-dark-base dark:text-light-base">Informasi Penting</h2>
                        <div className="mx-auto max-w-3xl">
                            <div className="grid gap-6 md:grid-cols-2">
                                <div className="rounded-lg bg-white p-6 shadow-sm dark:bg-gray-800">
                                    <div className="mb-3 flex items-center gap-3">
                                        <div className="rounded-full bg-blue-imphnen-base/10 p-2">
                                            <FileText className="h-5 w-5 text-blue-imphnen-base" />
                                        </div>
                                        <h3 className="font-semibold">File Download</h3>
                                    </div>
                                    <p className="text-sm text-gray-600 dark:text-gray-400">
                                        File akan otomatis terdownload ke perangkat Anda. Pastikan browser mengizinkan download file.
                                    </p>
                                </div>
                                <div className="rounded-lg bg-white p-6 shadow-sm dark:bg-gray-800">
                                    <div className="mb-3 flex items-center gap-3">
                                        <div className="rounded-full bg-green-500/10 p-2">
                                            <ExternalLink className="h-5 w-5 text-green-600" />
                                        </div>
                                        <h3 className="font-semibold">Link Eksternal</h3>
                                    </div>
                                    <p className="text-sm text-gray-600 dark:text-gray-400">
                                        Link akan membuka halaman baru di browser. Beberapa link mungkin memerlukan login.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </motion.div>
                </div>
            </section>

            {/* Help Section */}
            <section className="section-padding-x bg-light-base py-12 text-dark-base dark:bg-dark-base dark:text-light-base">
                <div className="mx-auto max-w-screen-xl">
                    <motion.div
                        initial={{ opacity: 0, y: 30 }}
                        whileInView={{ opacity: 1, y: 0 }}
                        viewport={{ once: true }}
                        transition={{ duration: 0.8 }}
                        className="text-center"
                    >
                        <p className="mb-4 text-sm text-gray-600 dark:text-gray-400">
                            Mengalami masalah dengan download? Butuh file yang tidak tersedia?
                        </p>
                        <a
                            href="https://instagram.com/hmifunsoed"
                            target="_blank"
                            className="inline-flex items-center gap-2 rounded-lg bg-blue-imphnen-base px-6 py-3 font-medium text-white transition-transform duration-300 hover:scale-105"
                        >
                            <ExternalLink className="h-4 w-4" />
                            Hubungi Kami
                        </a>
                    </motion.div>
                </div>
            </section>
        </Layout>
    );
}
