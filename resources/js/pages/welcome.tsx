import Layout from '@/components/layout';
import HeroSection from '@/components/welcome/hero';
import ValuesSection from '@/components/welcome/values';
import YouTubeVideosSection from '@/components/welcome/youtube-videos';
// import AchievementsSection from './about-hmif/achievements';

export default function Welcome() {
    return (
        <Layout>
            <HeroSection />
            <ValuesSection />
            {/* <AchievementsSection /> */}
            <YouTubeVideosSection />
        </Layout>
    );
}
