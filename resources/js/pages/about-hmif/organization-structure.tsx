import Layout from '@/components/layout';
import { Head } from '@inertiajs/react';
import { motion } from 'framer-motion';
import { ChevronLeft, ChevronRight, X, Instagram } from 'lucide-react';
import { useEffect, useState, useRef } from 'react';
import committees from '@/data/structure-organization';

interface CommitteeMember {
    id: number;
    name: string;
    leader: string;
    description: string;
    image: string;
    imageBackground: string;
    instagram?: string;
    staff?: string[];
}

export default function OrganizationStructure() {
    const [activeIndex, setActiveIndex] = useState(0);
    const [showStaffModal, setShowStaffModal] = useState(false);
    const [selectedCommittee, setSelectedCommittee] = useState<CommitteeMember | null>(null);
    const [currentPage, setCurrentPage] = useState(1);
    const [elementsVisible, setElementsVisible] = useState({
        slider: false,
        thumbnails: false,
        arrows: false
    });
    
    const sliderRef = useRef<HTMLDivElement>(null);
    const autoSlideRef = useRef<NodeJS.Timeout>();
    const staffPerPage = 20;

    // Intersection Observer for animations
    useEffect(() => {
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        // Staggered animations
                        setTimeout(() => setElementsVisible(prev => ({ ...prev, slider: true })), 300);
                        setTimeout(() => setElementsVisible(prev => ({ ...prev, arrows: true })), 800);
                        setTimeout(() => setElementsVisible(prev => ({ ...prev, thumbnails: true })), 1200);

                        // Start auto slide after animations
                        setTimeout(() => {
                            startAutoSlide();
                        }, 500);
                    }
                });
            },
            {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            }
        );

        if (sliderRef.current) {
            observer.observe(sliderRef.current);
        }

        return () => {
            if (sliderRef.current) {
                observer.unobserve(sliderRef.current);
            }
            if (autoSlideRef.current) {
                clearInterval(autoSlideRef.current);
            }
        };
    }, []);

    const startAutoSlide = () => {
        if (autoSlideRef.current) return;
        autoSlideRef.current = setInterval(() => {
            setActiveIndex(prev => (prev + 1) % committees.length);
        }, 5000);
    };

    const stopAutoSlide = () => {
        if (autoSlideRef.current) {
            clearInterval(autoSlideRef.current);
            autoSlideRef.current = undefined;
        }
    };

    const restartAutoSlide = () => {
        stopAutoSlide();
        startAutoSlide();
    };

    const nextSlide = () => {
        setActiveIndex(prev => (prev + 1) % committees.length);
        restartAutoSlide();
    };

    const prevSlide = () => {
        setActiveIndex(prev => prev === 0 ? committees.length - 1 : prev - 1);
        restartAutoSlide();
    };

    const goToSlide = (index: number) => {
        setActiveIndex(index);
        restartAutoSlide();
    };

    const openStaffModal = (committee: CommitteeMember) => {
        setSelectedCommittee(committee);
        setShowStaffModal(true);
        setCurrentPage(1);
        stopAutoSlide();
    };

    const closeStaffModal = () => {
        setShowStaffModal(false);
        setSelectedCommittee(null);
        setCurrentPage(1);
        restartAutoSlide();
    };

    const paginatedStaff = selectedCommittee?.staff 
        ? selectedCommittee.staff.slice((currentPage - 1) * staffPerPage, currentPage * staffPerPage)
        : [];

    const totalPages = selectedCommittee?.staff 
        ? Math.ceil(selectedCommittee.staff.length / staffPerPage)
        : 0;

    const getVisiblePages = () => {
        const pages = [];
        const maxVisible = 3;

        if (totalPages <= maxVisible) {
            for (let i = 1; i <= totalPages; i++) {
                pages.push(i);
            }
        } else {
            if (currentPage <= 2) {
                for (let i = 1; i <= maxVisible; i++) {
                    pages.push(i);
                }
            } else if (currentPage >= totalPages - 1) {
                for (let i = totalPages - maxVisible + 1; i <= totalPages; i++) {
                    pages.push(i);
                }
            } else {
                for (let i = currentPage - 1; i <= currentPage + 1; i++) {
                    pages.push(i);
                }
            }
        }
        return pages;
    };

    const visiblePages = getVisiblePages();
    const showStartEllipsis = totalPages > 3 && visiblePages[0] > 1;
    const showEndEllipsis = totalPages > 3 && visiblePages[visiblePages.length - 1] < totalPages;

    return (
        <Layout>
            <Head title="Struktur Organisasi" />
            
            <div 
                ref={sliderRef}
                className="slider relative min-h-screen text-light-base pb-36 md:pb-46 xl:pb-49"
            >
                {/* Main Slider Items */}
                {elementsVisible.slider && (
                    <motion.div 
                        className="list"
                        initial={{ opacity: 0 }}
                        animate={{ opacity: 1 }}
                        transition={{ duration: 0.8 }}
                    >
                        {committees.map((committee, index) => (
                            <div 
                                key={committee.id}
                                className={`item absolute inset-0 overflow-hidden transition-opacity duration-800 ${
                                    activeIndex === index ? 'opacity-100 z-10' : 'opacity-0 z-1'
                                }`}
                            >
                                <img
                                    src={committee.imageBackground}
                                    alt={`Background ${committee.name}`}
                                    className={`profile-background w-full h-full object-cover transition-transform duration-800 ${
                                        activeIndex === index ? 'scale-100' : 'scale-110'
                                    }`}
                                />
                                
                                {/* Gradient Overlay */}
                                <div className={`absolute inset-0 bg-gradient-to-t from-blue-imphnen-base/80 via-transparent to-transparent transition-opacity duration-800 ${
                                    activeIndex === index ? 'opacity-100' : 'opacity-0'
                                }`} />

                                {/* Content */}
                                <div className="content absolute left-[10%] top-[30%] w-full max-w-3xl z-3">
                                    <motion.p 
                                        className="position uppercase tracking-wider text-base mb-2 text-white/80"
                                        initial={{ opacity: 0, y: 50, filter: 'blur(10px)' }}
                                        animate={activeIndex === index ? { 
                                            opacity: 1, 
                                            y: 0, 
                                            filter: 'blur(0px)' 
                                        } : { 
                                            opacity: 0, 
                                            y: 50, 
                                            filter: 'blur(10px)' 
                                        }}
                                        transition={{ duration: 1, delay: 0.2, ease: [0.4, 0, 0.2, 1] }}
                                    >
                                        {committee.name}
                                    </motion.p>
                                    
                                    <motion.h2 
                                        className="profile-name text-5xl font-black mb-4 text-white leading-tight"
                                        initial={{ opacity: 0, y: 50, filter: 'blur(10px)' }}
                                        animate={activeIndex === index ? { 
                                            opacity: 1, 
                                            y: 0, 
                                            filter: 'blur(0px)' 
                                        } : { 
                                            opacity: 0, 
                                            y: 50, 
                                            filter: 'blur(10px)' 
                                        }}
                                        transition={{ duration: 1, delay: 0.4, ease: [0.4, 0, 0.2, 1] }}
                                    >
                                        {committee.leader}
                                    </motion.h2>
                                    
                                    <motion.p 
                                        className="paragraph text-sm leading-relaxed mb-4 text-white/90 max-w-2xl"
                                        initial={{ opacity: 0, y: 50, filter: 'blur(10px)' }}
                                        animate={activeIndex === index ? { 
                                            opacity: 1, 
                                            y: 0, 
                                            filter: 'blur(0px)' 
                                        } : { 
                                            opacity: 0, 
                                            y: 50, 
                                            filter: 'blur(10px)' 
                                        }}
                                        transition={{ duration: 1, delay: 0.6, ease: [0.4, 0, 0.2, 1] }}
                                    >
                                        {committee.description}
                                    </motion.p>
                                    
                                    <motion.div 
                                        className="button-group flex gap-2 flex-wrap"
                                        initial={{ opacity: 0, y: 50, filter: 'blur(10px)' }}
                                        animate={activeIndex === index ? { 
                                            opacity: 1, 
                                            y: 0, 
                                            filter: 'blur(0px)' 
                                        } : { 
                                            opacity: 0, 
                                            y: 50, 
                                            filter: 'blur(10px)' 
                                        }}
                                        transition={{ duration: 1, delay: 0.8, ease: [0.4, 0, 0.2, 1] }}
                                    >
                                        {committee.staff && committee.staff.length > 0 && (
                                            <button
                                                onClick={() => openStaffModal(committee)}
                                                className="staff inline-block px-4 py-2 bg-white/10 text-white border border-white/20 rounded-md text-xs transition-all duration-300 hover:bg-white/20 hover:border-white/40 hover:-translate-y-0.5"
                                            >
                                                Lihat Staff
                                            </button>
                                        )}
                                        {committee.instagram && (
                                            <a
                                                href={`https://instagram.com/${committee.instagram}`}
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                className="instagram inline-flex items-center gap-2 px-4 py-2 bg-white/10 text-white border border-white/20 rounded-md text-xs transition-all duration-300 hover:bg-white/20 hover:border-white/40 hover:-translate-y-0.5"
                                            >
                                                <Instagram className="w-4 h-4" />
                                                Instagram
                                            </a>
                                        )}
                                    </motion.div>
                                    
                                    <motion.img
                                        src={committee.image}
                                        alt={committee.leader}
                                        className="profile-image w-74 h-auto absolute -right-96 -bottom-37.5 -z-1 rounded-lg"
                                        initial={{ opacity: 0, x: 100 }}
                                        animate={activeIndex === index ? { 
                                            opacity: 1, 
                                            x: 0,
                                            scale: 1.05
                                        } : { 
                                            opacity: 0, 
                                            x: 100,
                                            scale: 1
                                        }}
                                        transition={{ duration: 1, delay: 0.3, ease: [0.4, 0, 0.2, 1] }}
                                    />
                                </div>
                            </div>
                        ))}
                    </motion.div>
                )}

                {/* Navigation Arrows */}
                {elementsVisible.arrows && (
                    <motion.div 
                        className="arrows absolute top-1/2 -translate-y-1/2 right-5 z-60 flex flex-col gap-2.5"
                        initial={{ scale: 0.8 }}
                        animate={{ scale: 1 }}
                        transition={{ duration: 0.6 }}
                    >
                        <button
                            className="arrow-btn bg-white/10 border-2 border-white/30 w-12.5 h-12.5 rounded-full text-white transition-all duration-300 cursor-pointer flex items-center justify-center backdrop-blur-sm hover:bg-white/20 hover:border-white/50 hover:scale-110 hover:shadow-lg active:scale-95"
                            onClick={prevSlide}
                            aria-label="Previous slide"
                        >
                            <ChevronLeft className="w-6 h-6" />
                        </button>
                        <button
                            className="arrow-btn bg-white/10 border-2 border-white/30 w-12.5 h-12.5 rounded-full text-white transition-all duration-300 cursor-pointer flex items-center justify-center backdrop-blur-sm hover:bg-white/20 hover:border-white/50 hover:scale-110 hover:shadow-lg active:scale-95"
                            onClick={nextSlide}
                            aria-label="Next slide"
                        >
                            <ChevronRight className="w-6 h-6" />
                        </button>
                    </motion.div>
                )}

                {/* Thumbnail Navigation */}
                {elementsVisible.thumbnails && (
                    <motion.div 
                        className="thumbnail absolute z-11 flex gap-2.5 w-full h-auto px-12.5 py-7.5 box-border justify-start -bottom-12 overflow-x-scroll scrollbar-hide"
                        initial={{ y: 100 }}
                        animate={{ y: 0 }}
                        transition={{ duration: 0.8 }}
                    >
                        {committees.map((committee, index) => (
                            <motion.button
                                key={committee.id}
                                className={`item w-37.5 h-55 flex-shrink-0 cursor-pointer border-none bg-none relative rounded-lg overflow-hidden mb-7.5 transition-all duration-400 ${
                                    activeIndex === index 
                                        ? 'brightness-120 saturate-120 -translate-y-5 shadow-2xl' 
                                        : 'brightness-50 saturate-80 hover:-translate-y-2.5 hover:brightness-80 hover:saturate-100 hover:shadow-lg'
                                }`}
                                onClick={() => goToSlide(index)}
                                aria-label={`Go to ${committee.name} slide`}
                                initial={{ scale: 0.8 }}
                                animate={{ scale: 1 }}
                                transition={{ duration: 0.4, delay: index * 0.1 }}
                            >
                                <img
                                    src={committee.imageBackground}
                                    alt={committee.name}
                                    className={`w-full h-full object-cover rounded-lg transition-transform duration-400 ${
                                        activeIndex === index ? 'scale-110' : 'hover:scale-105'
                                    }`}
                                />
                                <div className={`content absolute bottom-2.5 left-2.5 right-2.5 text-xs font-semibold text-white text-center bg-blue-imphnen-base px-1.25 py-2 rounded-md backdrop-blur-sm transition-all duration-300 ${
                                    activeIndex === index ? 'bg-blue-imphnen-secondary -translate-y-0.5' : 'hover:bg-blue-imphnen-secondary hover:-translate-y-0.5'
                                }`}>
                                    {committee.name}
                                </div>
                            </motion.button>
                        ))}
                    </motion.div>
                )}
            </div>

            {/* Staff Modal */}
            {showStaffModal && selectedCommittee && (
                <motion.div 
                    className="modal-overlay fixed inset-0 bg-black/90 flex justify-center items-center z-1000 backdrop-blur-lg"
                    onClick={(e) => e.target === e.currentTarget && closeStaffModal()}
                    initial={{ opacity: 0 }}
                    animate={{ opacity: 1 }}
                    exit={{ opacity: 0 }}
                    transition={{ duration: 0.3 }}
                >
                    <motion.div 
                        className="modal-content bg-gradient-to-br from-gray-800 to-gray-900 rounded-3xl w-[90%] max-w-4xl max-h-[85vh] overflow-hidden shadow-2xl border border-white/10"
                        initial={{ scale: 0.9 }}
                        animate={{ scale: 1 }}
                        exit={{ scale: 0.9 }}
                        transition={{ duration: 0.4 }}
                    >
                        <div className="modal-header flex justify-between items-center px-8 py-6 border-b border-white/10 bg-white/5">
                            <motion.h3 
                                className="text-white text-2xl font-semibold"
                                initial={{ x: -20 }}
                                animate={{ x: 0 }}
                                transition={{ duration: 0.4, delay: 0.2 }}
                            >
                                Staff {selectedCommittee.name}
                            </motion.h3>
                            <motion.button
                                className="close-btn bg-none border-none text-white cursor-pointer p-2 rounded-full transition-all duration-300 flex items-center justify-center hover:bg-white/10 hover:scale-110"
                                onClick={closeStaffModal}
                                initial={{ scale: 0.8 }}
                                animate={{ scale: 1 }}
                                transition={{ duration: 0.3, delay: 0.3 }}
                            >
                                <X className="w-6 h-6" />
                            </motion.button>
                        </div>

                        <div className="modal-body px-8 py-8 overflow-y-auto max-h-[calc(85vh-120px)]">
                            {selectedCommittee.staff && selectedCommittee.staff.length > 0 ? (
                                <>
                                    <div className="staff-grid grid grid-cols-[repeat(auto-fill,minmax(200px,1fr))] gap-6 mb-8">
                                        {paginatedStaff.map((staff, index) => (
                                            <motion.div
                                                key={index}
                                                className="staff-card bg-white/5 border border-white/10 rounded-2xl p-6 text-center transition-all duration-300 cursor-pointer hover:-translate-y-2 hover:bg-white/10 hover:shadow-lg"
                                                initial={{ scale: 0.8 }}
                                                animate={{ scale: 1 }}
                                                transition={{ duration: 0.3, delay: index * 0.05 }}
                                            >
                                                <div className="staff-avatar w-15 h-15 rounded-full bg-gradient-to-br from-blue-imphnen-base to-pink-500 flex items-center justify-center mx-auto mb-4 font-bold text-xl text-white transition-transform duration-300 hover:scale-110">
                                                    {staff.charAt(0).toUpperCase()}
                                                </div>
                                                <p className="staff-name text-white font-medium">
                                                    {staff}
                                                </p>
                                            </motion.div>
                                        ))}
                                    </div>

                                    {totalPages > 1 && (
                                        <motion.div 
                                            className="pagination flex justify-center items-center gap-4 flex-wrap"
                                            initial={{ y: 20 }}
                                            animate={{ y: 0 }}
                                            transition={{ duration: 0.4, delay: 0.5 }}
                                        >
                                            <button
                                                className="pagination-btn bg-white/10 border border-white/20 text-white px-5 py-3 rounded-lg cursor-pointer transition-all duration-300 font-medium flex items-center gap-2 hover:bg-white/20 hover:-translate-y-0.5 hover:shadow-lg disabled:opacity-50 disabled:cursor-not-allowed"
                                                onClick={() => setCurrentPage(prev => Math.max(prev - 1, 1))}
                                                disabled={currentPage === 1}
                                            >
                                                <ChevronLeft className="w-4 h-4" />
                                                Previous
                                            </button>

                                            <div className="page-numbers flex items-center gap-2">
                                                {showStartEllipsis && (
                                                    <>
                                                        <button
                                                            className="page-btn bg-white/10 border border-white/20 text-white px-3 py-2 rounded-lg cursor-pointer transition-all duration-300 min-w-11.25 font-medium hover:bg-white/20 hover:-translate-y-0.5 hover:shadow-lg"
                                                            onClick={() => setCurrentPage(1)}
                                                        >
                                                            1
                                                        </button>
                                                        <span className="ellipsis text-white/60 font-bold px-1.5 py-2 select-none text-xl flex items-center justify-center min-w-7.5">
                                                            ...
                                                        </span>
                                                    </>
                                                )}

                                                {visiblePages.map(page => (
                                                    <button
                                                        key={page}
                                                        className={`page-btn px-3 py-2 rounded-lg cursor-pointer transition-all duration-300 min-w-11.25 font-medium ${
                                                            currentPage === page
                                                                ? 'bg-gradient-to-br from-blue-imphnen-base to-pink-500 border-blue-imphnen-base text-white -translate-y-0.5 shadow-lg'
                                                                : 'bg-white/10 border border-white/20 text-white hover:bg-white/20 hover:-translate-y-0.5 hover:shadow-lg'
                                                        }`}
                                                        onClick={() => setCurrentPage(page)}
                                                    >
                                                        {page}
                                                    </button>
                                                ))}

                                                {showEndEllipsis && (
                                                    <>
                                                        <span className="ellipsis text-white/60 font-bold px-1.5 py-2 select-none text-xl flex items-center justify-center min-w-7.5">
                                                            ...
                                                        </span>
                                                        <button
                                                            className="page-btn bg-white/10 border border-white/20 text-white px-3 py-2 rounded-lg cursor-pointer transition-all duration-300 min-w-11.25 font-medium hover:bg-white/20 hover:-translate-y-0.5 hover:shadow-lg"
                                                            onClick={() => setCurrentPage(totalPages)}
                                                        >
                                                            {totalPages}
                                                        </button>
                                                    </>
                                                )}
                                            </div>

                                            <button
                                                className="pagination-btn bg-white/10 border border-white/20 text-white px-5 py-3 rounded-lg cursor-pointer transition-all duration-300 font-medium flex items-center gap-2 hover:bg-white/20 hover:-translate-y-0.5 hover:shadow-lg disabled:opacity-50 disabled:cursor-not-allowed"
                                                onClick={() => setCurrentPage(prev => Math.min(prev + 1, totalPages))}
                                                disabled={currentPage === totalPages}
                                            >
                                                Next
                                                <ChevronRight className="w-4 h-4" />
                                            </button>
                                        </motion.div>
                                    )}
                                </>
                            ) : (
                                <motion.p 
                                    className="no-staff text-center text-white/70 italic my-12 text-lg"
                                    initial={{ opacity: 0 }}
                                    animate={{ opacity: 1 }}
                                    transition={{ duration: 0.4, delay: 0.3 }}
                                >
                                    Belum ada staff yang terdaftar
                                </motion.p>
                            )}
                        </div>
                    </motion.div>
                </motion.div>
            )}

            <style>{`
                .scrollbar-hide {
                    scrollbar-width: none;
                    -ms-overflow-style: none;
                }
                .scrollbar-hide::-webkit-scrollbar {
                    display: none;
                }

                @media screen and (max-width: 1200px) {
                    .profile-image {
                        width: 64rem;
                        bottom: -24rem;
                        right: -25rem;
                    }
                }

                @media screen and (max-width: 768px) {
                    .slider {
                        max-height: 100vh;
                    }
                    
                    .arrows {
                        right: 0.625rem;
                    }
                    
                    .arrow-btn {
                        width: 2.5rem;
                        height: 2.5rem;
                    }
                    
                    .thumbnail {
                        bottom: -4.5rem;
                        padding: 1.25rem 1.25rem 5rem;
                    }
                    
                    .thumbnail .item {
                        width: 7.5rem;
                        height: 11.25rem;
                        margin-bottom: 1.5625rem;
                    }
                    
                    .profile-name {
                        font-size: 2rem !important;
                    }
                    
                    .position {
                        font-size: 0.8rem !important;
                    }
                    
                    .content {
                        width: 90% !important;
                        top: 40% !important;
                    }
                    
                    .paragraph {
                        font-size: 0.8rem !important;
                    }
                    
                    .staff, .instagram {
                        font-size: 0.7rem !important;
                        padding: 0.4rem 0.8rem !important;
                    }
                    
                    .profile-image {
                        width: 12.25rem !important;
                        bottom: 0 !important;
                        right: -6.25rem !important;
                    }
                    
                    .modal-content {
                        width: 95% !important;
                        max-height: 90vh !important;
                    }
                    
                    .staff-grid {
                        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)) !important;
                        gap: 1rem !important;
                    }
                }

                @media screen and (max-width: 480px) {
                    .content {
                        bottom: 30% !important;
                        top: auto !important;
                        left: 5% !important;
                        width: 90% !important;
                    }
                    
                    .profile-name {
                        font-size: 1.5rem !important;
                    }
                    
                    .position {
                        font-size: 0.7rem !important;
                    }
                    
                    .paragraph {
                        font-size: 0.75rem !important;
                    }
                    
                    .staff, .instagram {
                        font-size: 0.65rem !important;
                        padding: 0.3rem 0.6rem !important;
                    }
                    
                    .profile-image {
                        width: 9.375rem !important;
                        right: -1.875rem !important;
                        bottom: -3.125rem !important;
                    }
                    
                    .thumbnail {
                        bottom: -4rem !important;
                        padding: 1.25rem 1.25rem 3.75rem !important;
                    }
                    
                    .thumbnail .item {
                        width: 6.25rem !important;
                        height: 9.375rem !important;
                        margin-bottom: 1.25rem !important;
                    }
                    
                    .staff-grid {
                        grid-template-columns: 1fr 1fr !important;
                    }
                }
            `}</style>
        </Layout>
    );
}