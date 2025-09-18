import Layout from '@/components/layout';
import { Head, Link } from '@inertiajs/react';
import { motion } from 'framer-motion';
import { ArrowRight, Calendar, ChevronLeft, ChevronRight, User } from 'lucide-react';

interface Article {
    id: number;
    title: string;
    slug: string;
    thumbnail?: string;
    content: string;
    created_at: string;
    author?: {
        id: number;
        name: string;
    };
    category?: {
        id: number;
        name: string;
    };
}

interface PaginationLink {
    url: string | null;
    label: string;
    active: boolean;
}

interface ArticlesProps {
    articles: {
        data: Article[];
        current_page: number;
        last_page: number;
        per_page: number;
        total: number;
        links: PaginationLink[];
    };
}

const articles: ArticlesProps['articles'] = {
    data: [
        {
            id: 1,
            title: 'Artikel Pertama',
            slug: 'artikel-pertama',
            thumbnail: 'https://placehold.co/600x400',
            content: '<p>Ini adalah konten artikel pertama.</p>',
            created_at: '2023-01-01',
            author: {
                id: 1,
                name: 'Penulis 1',
            },
            category: {
                id: 1,
                name: 'Kategori 1',
            },
        },
        {
            id: 2,
            title: 'Artikel Kedua',
            slug: 'artikel-kedua',
            thumbnail: 'https://placehold.co/600x400',
            content: '<p>Ini adalah konten artikel kedua.</p>',
            created_at: '2023-01-02',
            author: {
                id: 2,
                name: 'Penulis 2',
            },
            category: {
                id: 2,
                name: 'Kategori 2',
            },
        },
    ],
    current_page: 1,
    last_page: 1,
    per_page: 10,
    total: 2,
    links: [
        {
            url: null,
            label: 'Previous',
            active: false,
        },
        {
            url: null,
            label: 'Next',
            active: false,
        },
    ],
};

// { articles }: ArticlesProps
export default function ArticlesIndex() {
    const formatDate = (dateString: string) => {
        return new Date(dateString).toLocaleDateString('id-ID', {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
        });
    };

    const truncateContent = (content: string, maxLength: number = 150) => {
        const textContent = content.replace(/<[^>]*>/g, ''); // Remove HTML tags
        if (textContent.length <= maxLength) return textContent;
        return textContent.substring(0, maxLength) + '...';
    };

    return (
        <Layout>
            <Head title="Berita & Artikel" />

            {/* Hero Section */}
            <section className="section-padding-x relative scroll-mt-12 bg-light-base pt-32 pb-16 text-dark-base dark:bg-dark-base dark:text-light-base">
                <div className="absolute inset-0">
                    <div className="absolute top-0 left-0 -z-10 h-96 w-96 rounded-full bg-blue-400 opacity-20 blur-3xl"></div>
                    <div className="absolute right-0 bottom-0 -z-10 h-96 w-96 rounded-full bg-purple-400 opacity-20 blur-3xl"></div>
                </div>
                <div className="relative mx-auto max-w-screen-xl">
                    <motion.div initial={{ opacity: 0, y: 30 }} animate={{ opacity: 1, y: 0 }} transition={{ duration: 0.8 }} className="text-center">
                        <h1 className="mb-4 font-bold">Berita & Artikel</h1>
                        <p className="mx-auto max-w-2xl text-gray-600 dark:text-gray-300">
                            Ikuti perkembangan terbaru seputar kegiatan HMIF Unsoed, berita teknologi, dan artikel informatif lainnya yang bermanfaat
                            untuk pengembangan diri mahasiswa Informatika.
                        </p>
                    </motion.div>
                </div>
            </section>

            {/* Articles Section */}
            <section className="section-padding-x bg-light-base py-16 text-dark-base dark:bg-dark-base dark:text-light-base">
                <div className="mx-auto max-w-screen-xl">
                    {articles.data.length > 0 ? (
                        <>
                            {/* Articles Grid */}
                            <div className="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                                {articles.data.map((article, index) => (
                                    <motion.article
                                        key={article.id}
                                        initial={{ opacity: 0, y: 30 }}
                                        animate={{ opacity: 1, y: 0 }}
                                        transition={{ duration: 0.6, delay: index * 0.1 }}
                                        className="group overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm transition-all duration-300 hover:shadow-md dark:border-gray-700 dark:bg-gray-800"
                                    >
                                        {/* Thumbnail */}
                                        <div className="relative h-48 overflow-hidden">
                                            {article.thumbnail ? (
                                                <img
                                                    src={article.thumbnail}
                                                    alt={article.title}
                                                    className="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105"
                                                />
                                            ) : (
                                                <div className="flex h-full w-full items-center justify-center bg-gradient-to-br from-blue-imphnen-base to-blue-imphnen-secondary">
                                                    <svg className="h-12 w-12 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                        <path
                                                            fillRule="evenodd"
                                                            d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                                            clipRule="evenodd"
                                                        />
                                                    </svg>
                                                </div>
                                            )}
                                            {article.category && (
                                                <div className="absolute top-3 left-3">
                                                    <span className="rounded-full bg-blue-imphnen-base px-3 py-1 text-xs font-medium text-white">
                                                        {article.category.name}
                                                    </span>
                                                </div>
                                            )}
                                        </div>

                                        {/* Content */}
                                        <div className="p-6">
                                            {/* Meta Info */}
                                            <div className="mb-3 flex flex-wrap gap-3 text-sm text-gray-500 dark:text-gray-400">
                                                <div className="flex items-center gap-1">
                                                    <Calendar className="h-4 w-4" />
                                                    <span>{formatDate(article.created_at)}</span>
                                                </div>
                                                {article.author && (
                                                    <div className="flex items-center gap-1">
                                                        <User className="h-4 w-4" />
                                                        <span>{article.author.name}</span>
                                                    </div>
                                                )}
                                            </div>

                                            {/* Title */}
                                            <h3 className="mb-3 leading-tight font-semibold text-gray-900 dark:text-white">{article.title}</h3>

                                            {/* Content Preview */}
                                            <p className="mb-4 text-gray-600 dark:text-gray-300">{truncateContent(article.content)}</p>

                                            {/* Read More Button */}
                                            <Link
                                                href={`/articles/${article.slug}`}
                                                className="inline-flex items-center gap-2 text-blue-imphnen-base transition-colors duration-200 hover:text-blue-imphnen-secondary"
                                            >
                                                Baca Selengkapnya
                                                <ArrowRight className="h-4 w-4" />
                                            </Link>
                                        </div>
                                    </motion.article>
                                ))}
                            </div>

                            {/* Pagination */}
                            {articles.last_page > 1 && (
                                <motion.div
                                    initial={{ opacity: 0, y: 20 }}
                                    animate={{ opacity: 1, y: 0 }}
                                    transition={{ duration: 0.6, delay: 0.3 }}
                                    className="mt-12 flex justify-center"
                                >
                                    <nav className="flex items-center gap-2">
                                        {articles.links.map((link, index) => {
                                            if (link.label.includes('Previous')) {
                                                return (
                                                    <Link
                                                        key={index}
                                                        href={link.url || '#'}
                                                        className={`flex items-center gap-1 rounded-lg px-3 py-2 text-sm transition-colors duration-200 ${
                                                            link.url
                                                                ? 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700'
                                                                : 'cursor-not-allowed text-gray-400 dark:text-gray-600'
                                                        }`}
                                                        preserveScroll
                                                    >
                                                        <ChevronLeft className="h-4 w-4" />
                                                        Sebelumnya
                                                    </Link>
                                                );
                                            }

                                            if (link.label.includes('Next')) {
                                                return (
                                                    <Link
                                                        key={index}
                                                        href={link.url || '#'}
                                                        className={`flex items-center gap-1 rounded-lg px-3 py-2 text-sm transition-colors duration-200 ${
                                                            link.url
                                                                ? 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700'
                                                                : 'cursor-not-allowed text-gray-400 dark:text-gray-600'
                                                        }`}
                                                        preserveScroll
                                                    >
                                                        Selanjutnya
                                                        <ChevronRight className="h-4 w-4" />
                                                    </Link>
                                                );
                                            }

                                            // Regular page numbers
                                            if (!link.label.includes('...')) {
                                                return (
                                                    <Link
                                                        key={index}
                                                        href={link.url || '#'}
                                                        className={`rounded-lg px-3 py-2 text-sm transition-colors duration-200 ${
                                                            link.active
                                                                ? 'bg-blue-imphnen-base text-white'
                                                                : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700'
                                                        }`}
                                                        preserveScroll
                                                    >
                                                        {link.label}
                                                    </Link>
                                                );
                                            }

                                            // Ellipsis
                                            return (
                                                <span key={index} className="px-3 py-2 text-sm text-gray-400 dark:text-gray-600">
                                                    {link.label}
                                                </span>
                                            );
                                        })}
                                    </nav>
                                </motion.div>
                            )}

                            {/* Articles Info */}
                            <motion.div
                                initial={{ opacity: 0, y: 20 }}
                                animate={{ opacity: 1, y: 0 }}
                                transition={{ duration: 0.6, delay: 0.4 }}
                                className="mt-8 text-center text-sm text-gray-600 dark:text-gray-400"
                            >
                                Menampilkan {(articles.current_page - 1) * articles.per_page + 1} -{' '}
                                {Math.min(articles.current_page * articles.per_page, articles.total)} dari {articles.total} artikel
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
                                <svg className="h-12 w-12 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        fillRule="evenodd"
                                        d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                        clipRule="evenodd"
                                    />
                                </svg>
                            </div>
                            <h3 className="mb-2 font-semibold text-gray-900 dark:text-white">Belum Ada Artikel</h3>
                            <p className="text-gray-600 dark:text-gray-400">Saat ini belum ada artikel yang tersedia. Silakan kembali lagi nanti.</p>
                        </motion.div>
                    )}
                </div>
            </section>
        </Layout>
    );
}
