import { useEffect, useState } from 'react';

interface YouTubeVideo {
    id: string;
    title: string;
    publishedAt: string;
    thumbnail: string;
}

export default function YouTubeVideosSection() {
    const [videos, setVideos] = useState<YouTubeVideo[]>([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState<string | null>(null);

    useEffect(() => {
        fetchYouTubeVideos();
    }, []);

    const fetchYouTubeVideos = async () => {
        try {
            setLoading(true);
            const response = await fetch('/api/youtube-videos');
            
            if (!response.ok) {
                throw new Error('Failed to fetch videos');
            }
            
            const data = await response.json();
            setVideos(data.videos || []);
        } catch (err) {
            setError(err instanceof Error ? err.message : 'An error occurred');
        } finally {
            setLoading(false);
        }
    };

    if (loading) {
        return (
            <section className="py-16 bg-gray-50">
                <div className="container mx-auto px-4">
                    <h2 className="text-3xl font-bold text-center mb-12">
                        Video Terbaru Kami
                    </h2>
                    <div className="flex justify-center items-center min-h-[300px]">
                        <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-gray-900"></div>
                    </div>
                </div>
            </section>
        );
    }

    if (error) {
        return (
            <section className="py-16 bg-gray-50">
                <div className="container mx-auto px-4">
                    <h2 className="text-3xl font-bold text-center mb-12">
                        Video Terbaru Kami
                    </h2>
                    <div className="text-center text-red-600">
                        <p>Gagal memuat video: {error}</p>
                    </div>
                </div>
            </section>
        );
    }

    return (
        <section className="py-16 bg-gray-50">
            <div className="container mx-auto px-4">
                <h2 className="text-3xl font-bold text-center mb-4">
                    Video Terbaru Kami
                </h2>
                <p className="text-center text-gray-600 mb-12 max-w-2xl mx-auto">
                    Tonton video terbaru dari channel YouTube kami untuk mendapatkan update terkini
                </p>
                
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    {videos.map((video) => (
                        <div 
                            key={video.id} 
                            className="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300"
                        >
                            <div className="relative aspect-video">
                                <iframe
                                    src={`https://www.youtube.com/embed/${video.id}`}
                                    title={video.title}
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowFullScreen
                                    className="w-full h-full"
                                />
                            </div>
                            <div className="p-4">
                                <h3 className="font-semibold text-lg mb-2 line-clamp-2">
                                    {video.title}
                                </h3>
                                <p className="text-sm text-gray-500">
                                    {new Date(video.publishedAt).toLocaleDateString('id-ID', {
                                        year: 'numeric',
                                        month: 'long',
                                        day: 'numeric'
                                    })}
                                </p>
                            </div>
                        </div>
                    ))}
                </div>
                
                {videos.length === 0 && (
                    <div className="text-center text-gray-600">
                        <p>Belum ada video tersedia</p>
                    </div>
                )}
            </div>
        </section>
    );
}
