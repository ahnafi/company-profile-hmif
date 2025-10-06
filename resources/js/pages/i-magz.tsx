import Layout from '@/components/layout';
import { Head } from '@inertiajs/react';
import { motion } from 'framer-motion';
import { BookOpen, Calendar, ChevronLeft, ChevronRight, Download, Eye, Search, X, ZoomIn, ZoomOut } from 'lucide-react';
import { useMemo, useState } from 'react';
import { Document, Page, pdfjs } from 'react-pdf';
import 'react-pdf/dist/Page/AnnotationLayer.css';
import 'react-pdf/dist/Page/TextLayer.css';

// Set up PDF.js worker
pdfjs.GlobalWorkerOptions.workerSrc = `//unpkg.com/pdfjs-dist@${pdfjs.version}/build/pdf.worker.min.js`;

interface Magazine {
    id: number;
    title: string;
    slug: string;
    description?: string;
    file: string;
    created_at: string;
    updated_at: string;
}

interface IMagzProps {
    magazines: Magazine[];
}

// Data dummy untuk development
const dummyMagazines: Magazine[] = [
    {
        id: 1,
        title: 'I-Magz Edisi 1 - Welcome to HMIF',
        slug: 'i-magz-edisi-1-welcome-to-hmif',
        description:
            'Edisi perdana I-Magz yang membahas tentang perkenalan HMIF Unsoed, visi misi, dan program-program unggulan yang akan dilaksanakan.',
        file: '/magazines/i-magz-vol-1.pdf',
        created_at: '2024-01-15T10:30:00.000000Z',
        updated_at: '2024-01-15T10:30:00.000000Z',
    },
    {
        id: 2,
        title: 'I-Magz Edisi 2 - Tech Innovation',
        slug: 'i-magz-edisi-2-tech-innovation',
        description: 'Membahas perkembangan teknologi terkini, inovasi yang dilakukan mahasiswa, dan tips & tricks dalam dunia pemrograman.',
        file: '/magazines/i-magz-vol-2.pdf',
        created_at: '2024-02-15T14:20:00.000000Z',
        updated_at: '2024-02-15T14:20:00.000000Z',
    },
    {
        id: 3,
        title: 'I-Magz Edisi 3 - Career Guide',
        slug: 'i-magz-edisi-3-career-guide',
        description: 'Panduan karir untuk mahasiswa Informatika, tips interview, portfolio building, dan pengalaman alumni di dunia industri.',
        file: '/magazines/i-magz-vol-3.pdf',
        created_at: '2024-03-15T09:45:00.000000Z',
        updated_at: '2024-03-15T09:45:00.000000Z',
    },
    {
        id: 4,
        title: 'I-Magz Edisi 4 - Research Spotlight',
        slug: 'i-magz-edisi-4-research-spotlight',
        description: 'Menampilkan penelitian-penelitian menarik dari dosen dan mahasiswa, serta perkembangan riset teknologi di Unsoed.',
        file: '/magazines/i-magz-vol-4.pdf',
        created_at: '2024-04-15T16:30:00.000000Z',
        updated_at: '2024-04-15T16:30:00.000000Z',
    },
];

export default function IMagzPage({ magazines = dummyMagazines }: IMagzProps) {
    const [searchTerm, setSearchTerm] = useState('');
    const [selectedMagazine, setSelectedMagazine] = useState<Magazine | null>(null);
    const [showPDFViewer, setShowPDFViewer] = useState(false);
    const [numPages, setNumPages] = useState<number | null>(null);
    const [pageNumber, setPageNumber] = useState(1);
    const [scale, setScale] = useState(1.0);
    const [loading, setLoading] = useState(false);

    const filteredMagazines = useMemo(() => {
        return magazines.filter(
            (magazine) =>
                magazine.title.toLowerCase().includes(searchTerm.toLowerCase()) ||
                (magazine.description && magazine.description.toLowerCase().includes(searchTerm.toLowerCase())),
        );
    }, [magazines, searchTerm]);

    const stats = [
        {
            icon: <BookOpen className="h-6 w-6" />,
            label: 'Total Edisi',
            value: magazines.length.toString(),
        },
        {
            icon: <Calendar className="h-6 w-6" />,
            label: 'Edisi Terbaru',
            value: new Date().getFullYear().toString(),
        },
        {
            icon: <Download className="h-6 w-6" />,
            label: 'Format',
            value: 'PDF',
        },
    ];

    const formatDate = (dateString: string) => {
        return new Date(dateString).toLocaleDateString('id-ID', {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
        });
    };

    const openPDFViewer = (magazine: Magazine) => {
        setSelectedMagazine(magazine);
        setShowPDFViewer(true);
        setPageNumber(1);
        setScale(1.0);
        setLoading(true);
    };

    const closePDFViewer = () => {
        setShowPDFViewer(false);
        setSelectedMagazine(null);
        setNumPages(null);
        setPageNumber(1);
        setLoading(false);
    };

    const onDocumentLoadSuccess = ({ numPages }: { numPages: number }) => {
        setNumPages(numPages);
        setLoading(false);
    };

    const onDocumentLoadError = (error: Error) => {
        console.error('Error loading PDF:', error);
        setLoading(false);
    };

    const previousPage = () => {
        setPageNumber((prev) => Math.max(prev - 1, 1));
    };

    const nextPage = () => {
        setPageNumber((prev) => Math.min(prev + 1, numPages || 1));
    };

    const zoomIn = () => {
        setScale((prev) => Math.min(prev + 0.25, 3.0));
    };

    const zoomOut = () => {
        setScale((prev) => Math.max(prev - 0.25, 0.5));
    };

    const downloadMagazine = (magazine: Magazine) => {
        const link = document.createElement('a');
        link.href = `/storage/${magazine.file}`;
        link.download = `${magazine.title}.pdf`;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    };

    return (
        <Layout>
            <Head title="I-Magz HMIF Unsoed" />

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
                                <BookOpen className="h-5 w-5" />
                                <span className="text-sm font-medium">I-Magz Digital</span>
                            </span>
                        </div>
                        <h1 className="mb-4 font-bold">I-Magz HMIF Unsoed</h1>
                        <p className="mx-auto max-w-2xl text-gray-600 dark:text-gray-300">
                            Majalah digital HMIF Unsoed yang menghadirkan informasi terkini tentang teknologi, karir, penelitian, dan kegiatan
                            mahasiswa Informatika.
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

            {/* Search Section */}
            <section className="section-padding-x bg-light-base py-8 text-dark-base dark:bg-dark-base dark:text-light-base">
                <div className="mx-auto max-w-screen-xl">
                    <motion.div
                        initial={{ opacity: 0, y: 20 }}
                        whileInView={{ opacity: 1, y: 0 }}
                        viewport={{ once: true }}
                        transition={{ duration: 0.6 }}
                        className="flex justify-center"
                    >
                        <div className="relative w-full max-w-md">
                            <Search className="absolute top-1/2 left-3 h-4 w-4 -translate-y-1/2 text-gray-400" />
                            <input
                                type="text"
                                placeholder="Cari edisi I-Magz..."
                                value={searchTerm}
                                onChange={(e) => setSearchTerm(e.target.value)}
                                className="w-full rounded-lg border border-gray-300 bg-white py-3 pr-4 pl-10 text-dark-base focus:border-blue-imphnen-base focus:ring-1 focus:ring-blue-imphnen-base focus:outline-none dark:border-gray-600 dark:bg-gray-800 dark:text-light-base dark:focus:border-blue-imphnen-secondary"
                            />
                        </div>
                    </motion.div>
                </div>
            </section>

            {/* Magazines Grid */}
            <section className="section-padding-x bg-light-base py-16 text-dark-base dark:bg-dark-base dark:text-light-base">
                <div className="mx-auto max-w-screen-xl">
                    {filteredMagazines.length > 0 ? (
                        <>
                            <motion.div
                                initial={{ opacity: 0, x: -30 }}
                                whileInView={{ opacity: 1, x: 0 }}
                                viewport={{ once: true }}
                                transition={{ duration: 0.6 }}
                                className="mb-8"
                            >
                                <h2 className="mb-2 font-bold text-dark-base dark:text-light-base">Koleksi I-Magz</h2>
                                <div className="h-1 w-20 rounded bg-gradient-to-r from-blue-imphnen-base to-blue-imphnen-secondary"></div>
                                <p className="mt-2 text-sm text-gray-600 dark:text-gray-400">Menampilkan {filteredMagazines.length} edisi</p>
                            </motion.div>

                            <div className="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                                {filteredMagazines.map((magazine, index) => (
                                    <motion.div
                                        key={magazine.id}
                                        initial={{ opacity: 0, y: 30 }}
                                        whileInView={{ opacity: 1, y: 0 }}
                                        viewport={{ once: true }}
                                        transition={{ duration: 0.6, delay: index * 0.1 }}
                                        className="group overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm transition-all duration-300 hover:shadow-lg dark:border-gray-700 dark:bg-gray-800"
                                    >
                                        {/* Magazine Cover Placeholder */}
                                        <div className="relative flex h-64 items-center justify-center bg-gradient-to-br from-blue-imphnen-base to-blue-imphnen-secondary">
                                            <BookOpen className="h-16 w-16 text-white/80" />
                                            <div className="absolute inset-0 bg-black/20"></div>
                                            <div className="absolute right-4 bottom-4 left-4">
                                                <h3 className="text-lg leading-tight font-bold text-white">{magazine.title}</h3>
                                            </div>
                                        </div>

                                        {/* Content */}
                                        <div className="p-6">
                                            {magazine.description && (
                                                <p className="mb-4 line-clamp-3 text-sm text-gray-600 dark:text-gray-400">{magazine.description}</p>
                                            )}

                                            {/* Meta Info */}
                                            <div className="mb-4 flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                                                <Calendar className="h-3 w-3" />
                                                <span>{formatDate(magazine.created_at)}</span>
                                            </div>

                                            {/* Action Buttons */}
                                            <div className="flex gap-2">
                                                <button
                                                    onClick={() => openPDFViewer(magazine)}
                                                    className="flex flex-1 items-center justify-center gap-2 rounded-lg bg-gradient-to-r from-blue-imphnen-base to-blue-imphnen-secondary px-4 py-3 text-sm font-medium text-white transition-all duration-300 hover:scale-105 hover:shadow-md"
                                                >
                                                    <Eye className="h-4 w-4" />
                                                    Baca Online
                                                </button>
                                                <button
                                                    onClick={() => downloadMagazine(magazine)}
                                                    className="flex items-center justify-center gap-2 rounded-lg border-2 border-blue-imphnen-base px-4 py-3 text-sm font-medium text-blue-imphnen-base transition-all duration-300 hover:bg-blue-imphnen-base hover:text-white"
                                                >
                                                    <Download className="h-4 w-4" />
                                                </button>
                                            </div>
                                        </div>
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
                                <BookOpen className="h-12 w-12 text-gray-400" />
                            </div>
                            <h3 className="mb-2 font-semibold text-gray-900 dark:text-white">Tidak Ada I-Magz Ditemukan</h3>
                            <p className="text-gray-600 dark:text-gray-400">Coba ubah kata kunci pencarian yang digunakan.</p>
                        </motion.div>
                    )}
                </div>
            </section>

            {/* PDF Viewer Modal */}
            {showPDFViewer && selectedMagazine && (
                <motion.div
                    initial={{ opacity: 0 }}
                    animate={{ opacity: 1 }}
                    exit={{ opacity: 0 }}
                    className="fixed inset-0 z-50 flex flex-col bg-black/90"
                >
                    {/* Header */}
                    <div className="flex items-center justify-between border-b border-gray-200 bg-white p-4 dark:border-gray-700 dark:bg-gray-800">
                        <div className="flex-1">
                            <h3 className="font-semibold text-dark-base dark:text-light-base">{selectedMagazine.title}</h3>
                            {numPages && (
                                <p className="text-sm text-gray-600 dark:text-gray-400">
                                    Halaman {pageNumber} dari {numPages}
                                </p>
                            )}
                        </div>

                        {/* Controls */}
                        <div className="flex items-center gap-2">
                            {/* Navigation */}
                            <button
                                onClick={previousPage}
                                disabled={pageNumber <= 1}
                                className="rounded bg-gray-100 p-2 hover:bg-gray-200 disabled:cursor-not-allowed disabled:opacity-50 dark:bg-gray-700 dark:hover:bg-gray-600"
                            >
                                <ChevronLeft className="h-4 w-4" />
                            </button>

                            <span className="px-2 text-sm text-dark-base dark:text-light-base">
                                {pageNumber} / {numPages || 0}
                            </span>

                            <button
                                onClick={nextPage}
                                disabled={pageNumber >= (numPages || 0)}
                                className="rounded bg-gray-100 p-2 hover:bg-gray-200 disabled:cursor-not-allowed disabled:opacity-50 dark:bg-gray-700 dark:hover:bg-gray-600"
                            >
                                <ChevronRight className="h-4 w-4" />
                            </button>

                            {/* Zoom Controls */}
                            <div className="ml-2 border-l border-gray-300 pl-2 dark:border-gray-600">
                                <button
                                    onClick={zoomOut}
                                    disabled={scale <= 0.5}
                                    className="rounded bg-gray-100 p-2 hover:bg-gray-200 disabled:cursor-not-allowed disabled:opacity-50 dark:bg-gray-700 dark:hover:bg-gray-600"
                                >
                                    <ZoomOut className="h-4 w-4" />
                                </button>

                                <span className="px-2 text-sm text-dark-base dark:text-light-base">{Math.round(scale * 100)}%</span>

                                <button
                                    onClick={zoomIn}
                                    disabled={scale >= 3.0}
                                    className="rounded bg-gray-100 p-2 hover:bg-gray-200 disabled:cursor-not-allowed disabled:opacity-50 dark:bg-gray-700 dark:hover:bg-gray-600"
                                >
                                    <ZoomIn className="h-4 w-4" />
                                </button>
                            </div>

                            {/* Download */}
                            <button
                                onClick={() => downloadMagazine(selectedMagazine)}
                                className="rounded bg-blue-imphnen-base p-2 text-white hover:bg-blue-imphnen-secondary"
                            >
                                <Download className="h-4 w-4" />
                            </button>

                            {/* Close */}
                            <button onClick={closePDFViewer} className="rounded bg-red-500 p-2 text-white hover:bg-red-600">
                                <X className="h-4 w-4" />
                            </button>
                        </div>
                    </div>

                    {/* PDF Content */}
                    <div className="flex flex-1 items-start justify-center overflow-auto bg-gray-100 p-4 dark:bg-gray-900">
                        {loading && (
                            <div className="flex h-full items-center justify-center">
                                <div className="text-white">Loading PDF...</div>
                            </div>
                        )}

                        <Document
                            file={selectedMagazine.file}
                            onLoadSuccess={onDocumentLoadSuccess}
                            onLoadError={onDocumentLoadError}
                            loading={
                                <div className="flex h-full items-center justify-center text-white">
                                    <div className="h-8 w-8 animate-spin rounded-full border-b-2 border-white"></div>
                                </div>
                            }
                            className="max-w-full"
                        >
                            <Page
                                pageNumber={pageNumber}
                                scale={scale}
                                className="shadow-lg"
                                loading={
                                    <div className="flex h-96 items-center justify-center bg-white">
                                        <div className="h-8 w-8 animate-spin rounded-full border-b-2 border-blue-500"></div>
                                    </div>
                                }
                            />
                        </Document>
                    </div>
                </motion.div>
            )}

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
                        <h2 className="mb-4 font-bold text-dark-base dark:text-light-base">Tentang I-Magz</h2>
                        <div className="mx-auto max-w-3xl">
                            <p className="mb-6 text-gray-600 dark:text-gray-400">
                                I-Magz adalah majalah digital resmi HMIF Unsoed yang terbit secara berkala. Majalah ini berisi artikel-artikel menarik
                                seputar teknologi, tips karir, penelitian, dan berbagai kegiatan mahasiswa Informatika.
                            </p>
                            <div className="grid gap-6 md:grid-cols-3">
                                <div className="text-center">
                                    <div className="mb-3 flex justify-center">
                                        <BookOpen className="h-8 w-8 text-blue-imphnen-base" />
                                    </div>
                                    <h3 className="mb-2 font-semibold">Konten Berkualitas</h3>
                                    <p className="text-sm text-gray-600 dark:text-gray-400">Artikel dan konten yang informatif dan relevan</p>
                                </div>
                                <div className="text-center">
                                    <div className="mb-3 flex justify-center">
                                        <Download className="h-8 w-8 text-blue-imphnen-base" />
                                    </div>
                                    <h3 className="mb-2 font-semibold">Akses Mudah</h3>
                                    <p className="text-sm text-gray-600 dark:text-gray-400">Baca online atau download untuk dibaca offline</p>
                                </div>
                                <div className="text-center">
                                    <div className="mb-3 flex justify-center">
                                        <Calendar className="h-8 w-8 text-blue-imphnen-base" />
                                    </div>
                                    <h3 className="mb-2 font-semibold">Terbit Berkala</h3>
                                    <p className="text-sm text-gray-600 dark:text-gray-400">Edisi baru terbit secara rutin setiap periode</p>
                                </div>
                            </div>
                        </div>
                    </motion.div>
                </div>
            </section>
        </Layout>
    );
}
